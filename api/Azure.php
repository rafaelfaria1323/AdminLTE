<?php
session_start();  //Since you likely need to maintain the user session, let's start it an utilize it's ID later
ob_start();
error_reporting(-1);  //Remove from production version
ini_set("display_errors", "on");  //Remove from production version
//Configuration, needs to match with Azure app registration
$client_id = "93aaf16b-4edb-40ba-89df-a4f3565c5bca";  //Application (client) ID
$ad_tenant = "d6dfa666-1a1f-4e53-8fb1-ed688b14eff3";  //Azure Active Directory Tenant ID, with Multitenant apps you can use "common" as Tenant ID, but using specific endpoint is recommended when possible
$client_secret = "d-E5OM68_5MT8IImlgd_IsRm9aR2-ce37X";  //Client Secret, remember that this expires someday unless you haven't set it not to do so
$redirect_uri = "http://localhost/AdminLTE/api/Azure.php";  //This needs to match 100% what is set in Azure
$error_email = "your.email@your-domain.com";  //If your php.ini doesn't contain sendmail_from, use: ini_set("sendmail_from", "user@example.com");
function errorhandler($input, $email)
{
  $output = "PHP Session ID:    " . session_id() . PHP_EOL;
  $output .= "Client IP Address: " . getenv("REMOTE_ADDR") . PHP_EOL;
  $output .= "Client Browser:    " . $_SERVER["HTTP_USER_AGENT"] . PHP_EOL;
  $output .= PHP_EOL;
  ob_start();  //Start capturing the output buffer
  //This is not for debug print, this is to collect the data for the email
  $output .= ob_get_contents();  //Storing the output buffer content to $output
  ob_end_clean();  //While testing, you probably want to comment the next row out
  mb_send_mail($email, "Your Azure AD Oauth2 script faced an error!", $output, "X-Priority: 1\nContent-Transfer-Encoding: 8bit\nX-Mailer: PHP/" . phpversion());
  exit;
}
if (isset($_GET["code"])) echo "<pre>";  //This is just for easier and better looking var_dumps for debug purposes
if (!isset($_GET["code"]) and !isset($_GET["error"])) {  //Real authentication part begins
  //First stage of the authentication process; This is just a simple redirect (first load of this page)
  $url = "https://login.microsoftonline.com/" . $ad_tenant . "/oauth2/v2.0/authorize?";
  $url .= "state=" . session_id();  //This at least semi-random string is likely good enough as state identifier
  $url .= "&scope=User.ReadBasic.All";  //This scope seems to be enough, but you can try "&scope=profile+openid+email+offline_access+User.Read" if you like
  $url .= "&response_type=code";
  $url .= "&approval_prompt=auto";
  $url .= "&client_id=" . $client_id;
  $url .= "&redirect_uri=" . urlencode($redirect_uri);
  header("Location: " . $url);  //So off you go my dear browser and welcome back for round two after some redirects at Azure end
} elseif (isset($_GET["error"])) {  //Second load of this page begins, but hopefully we end up to the next elseif section...
  echo "Error handler activated:\n\n";
  var_dump($_GET);  //Debug print
  errorhandler(array("Description" => "Error received at the beginning of second stage.", "\$_GET[]" => $_GET, "\$_SESSION[]" => $_SESSION), $error_email);
} elseif (strcmp(session_id(), $_GET["state"]) == 0) {  //Checking that the session_id matches to the state for security reasons
  echo "Stage2:\n\n";  //And now the browser has returned from its various redirects at Azure side and carrying some gifts inside $_GET
  var_dump($_GET);  //Debug print
  //Verifying the received tokens with Azure and finalizing the authentication part
  $content = "grant_type=authorization_code";
  $content .= "&client_id=" . $client_id;
  $content .= "&redirect_uri=" . urlencode($redirect_uri);
  $content .= "&code=" . $_GET["code"];
  $content .= "&client_secret=" . urlencode($client_secret);
  $options = array(
    "http" => array(  //Use "http" even if you send the request with https
      "method"  => "POST",
      "header"  => "Content-Type: application/x-www-form-urlencoded\r\n" .
        "Content-Length: " . strlen($content) . "\r\n",
      "content" => $content
    )
  );
  $context  = stream_context_create($options);
  $json = file_get_contents("https://login.microsoftonline.com/" . $ad_tenant . "/oauth2/v2.0/token", false, $context);
  if ($json === false) errorhandler(array("Description" => "Error received during Bearer token fetch.", "PHP_Error" => error_get_last(), "\$_GET[]" => $_GET, "HTTP_msg" => $options), $error_email);
  $authdata = json_decode($json, true);
  if (isset($authdata["error"])) errorhandler(array("Description" => "Bearer token fetch contained an error.", "\$authdata[]" => $authdata, "\$_GET[]" => $_GET, "HTTP_msg" => $options), $error_email);
  var_dump($authdata);  //Debug print
  //Fetching the basic user information that is likely needed by your application
  $options = array(
    "http" => array(  //Use "http" even if you send the request with https
      "method" => "GET",
      "header" => "Accept: application/json\r\n" .
        "Authorization: Bearer " . $authdata["access_token"] . "\r\n"
    )
  );
  $context = stream_context_create($options);
  $json = file_get_contents("https://graph.microsoft.com/v1.0/me", false, $context);
  if ($json === false) errorhandler(array("Description" => "Error received during user data fetch.", "PHP_Error" => error_get_last(), "\$_GET[]" => $_GET, "HTTP_msg" => $options), $error_email);
  $userdata = json_decode($json, true);  //This should now contain your logged on user information
  if (isset($userdata["error"])) errorhandler(array("Description" => "User data fetch contained an error.", "\$userdata[]" => $userdata, "\$authdata[]" => $authdata, "\$_GET[]" => $_GET, "HTTP_msg" => $options), $error_email);
  var_dump($userdata); //Debug print

  $json = file_get_contents("https://graph.microsoft.com/v1.0/me/Department", false, $context);
  if ($json === false) errorhandler(array("Description" => "Error received during user data fetch.", "PHP_Error" => error_get_last(), "\$_GET[]" => $_GET, "HTTP_msg" => $options), $error_email);
  $userdepart = json_decode($json, true);  //This should now contain your logged on user information
  if (isset($userdepart["error"])) errorhandler(array("Description" => "User data fetch contained an error.", "\$userdata[]" => $userdata, "\$authdata[]" => $authdata, "\$_GET[]" => $_GET, "HTTP_msg" => $options), $error_email);
  var_dump($userdepart); //Debug print


} else {
  //If we end up here, something has obviously gone wrong... Likely a hacking attempt since sent and returned state aren't matching and no $_GET["error"] received.
  echo "Hey, please don't try to hack us!\n\n";
  echo "PHP Session ID used as state: " . session_id() . "\n";  //And for production version you likely don't want to show these for the potential hacker
  var_dump($_GET);  //But this being a test script having the var_dumps might be useful
  errorhandler(array("Description" => "Likely a hacking attempt, due state mismatch.", "\$_GET[]" => $_GET, "\$_SESSION[]" => $_SESSION), $error_email);
}

include_once './bd.php';

setcookie(
  'code',
  $_GET['code'],
  time() + (10 * 365 * 24 * 60 * 60)
);

setcookie(
  'authdata',
  serialize($authdata),
  time() + (10 * 365 * 24 * 60 * 60)
);


$_SESSION['user'] =
  array(
    "id" => explode('@', trim($userdata['mail']))[0],
    "email" => $userdata['mail'],
    "nome" => $userdata['displayName'],
    "descricao_turma" => $userdepart['value']
  );

$result = $connect->query('SELECT * FROM users WHERE email_user = "' . $_SESSION['user']['email'] . '"');

if ($result->rowCount() == 0) {
  try {
    $a = $connect->query('INSERT INTO `users`(`id`, `nome_user`, `email_user`, `user_departamento`) VALUES ("' . $_SESSION['user']['id'] . '","' . $_SESSION['user']['nome'] . '","' . $_SESSION['user']['email'] . '","' . $_SESSION['user']['descricao_turma'] . '")');
    $b = $connect->query('DELETE FROM users WHERE id = ""');
  } catch (Exception $e) {
    echo ($e->getMessage());
  }
}


if (isset($_SESSION['user']) && $_SESSION['user']['email'] != null) {
  header("location: ../user/materiais.php");
}

