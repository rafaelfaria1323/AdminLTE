<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function count_all_data_user($connect, $uId)
{
  $query = 'SELECT tipo_materiais.descricao_materiais, categorias_materiais.descricao_categoria, req_materiais.data, estados_req_materiais.descricao_estado, ano_letivo.descricao_ano_letivo
                FROM req_materiais 
                    JOIN materiais ON materiais.id = req_materiais.id_material
                    JOIN estados_req_materiais ON estados_req_materiais.id = req_materiais.id_estado_req
                    JOIN ano_letivo ON ano_letivo.id = req_materiais.id_ano_letivo 
                    JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo
                    JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material
                        WHERE req_materiais.id_requisitante = "' . $uId . '"';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_resp_buy($connect)
{
  $query = 'SELECT responsaveis_compras.id, responsaveis_compras.id_responsavel, users.nome_user, areas_compras.descricao_area_compra FROM responsaveis_compras JOIN users ON users.id = responsaveis_compras.id_responsavel JOIN areas_compras ON areas_compras.id = responsaveis_compras.id_area_compras';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_area_setor($connect)
{
  $query = 'SELECT area_setor.id, areas_compras.descricao_area_compra, setores_compras.descricao_setor_compra FROM area_setor JOIN setores_compras ON setores_compras.id = area_setor.id_setor_compra JOIN areas_compras ON areas_compras.id = area_setor.id_area_compra';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_area_buy($connect)
{
  $query = 'SELECT * FROM `areas_compras`';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_req_user_buy($connect, $uId)
{
  $query = 'SELECT req_compras.id,req_compras.data_requerido,req_compras.data_requisicao, req_compras.id_decisao,decisoes_req.descricao_decisao_req,ano_letivo.descricao_ano_letivo FROM req_compras JOIN decisoes_req ON decisoes_req.id = req_compras.id_decisao JOIN ano_letivo ON ano_letivo.id = req_compras.id_ano_letivo WHERE req_compras.id_requisitante = "' . $uId . '"';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}


function count_all_data_admin_req($connect, $rId)
{
  $query = "SELECT users.nome_user, users.user_departamento, req_materiais.id_requisitante, req_materiais.id, req_materiais.id_material, tipo_materiais.descricao_materiais, materiais.id_proprio, materiais.id_tipo,req_materiais.data, estados_req_materiais.descricao_estado, ano_letivo.descricao_ano_letivo 
                FROM req_materiais 
                    JOIN materiais ON materiais.id = req_materiais.id_material  
                    JOIN estados_req_materiais ON estados_req_materiais.id = req_materiais.id_estado_req 
                    JOIN ano_letivo ON ano_letivo.id = req_materiais.id_ano_letivo 
                    JOIN tipo_materiais ON tipo_materiais.id = materiais.id_tipo 
                    JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material
                    JOIN users ON users.id = req_materiais.id_requisitante
                    JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id
                        WHERE responsaveis_area.id_responsavel_area = '" . $rId . "'";

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_mat_admin_req($connect, $rId)
{
  $query = "SELECT materiais.id, materiais.id_tipo, materiais.id_proprio, tipo_materiais.descricao_materiais, estados_materiais.descricao 
                    FROM materiais 
                            JOIN tipo_materiais ON materiais.id_tipo = tipo_materiais.id 
                            JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material 
                            JOIN estados_materiais ON estados_materiais.id = materiais.id_estado 
                            JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id
                                    WHERE responsaveis_area.id_responsavel_area = '" . $rId . "' AND materiais.id_status = 1";

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_matType_admin_req($connect, $rId)
{
  $query = 'SELECT tipo_materiais.id, tipo_materiais.descricao_materiais
                    FROM tipo_materiais 
                            JOIN categorias_materiais ON categorias_materiais.id = tipo_materiais.id_categoria_material 
                            JOIN responsaveis_area ON responsaveis_area.id_area_material = categorias_materiais.id
                                    WHERE responsaveis_area.id_responsavel_area = "' . $rId . '"';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_data_user_caci($connect, $uId)
{
  $query = 'SELECT cacifos.id_proprio, cacifo_piso.descricao_cacifo_piso, req_cacifos.data , req_cacifos.id_parceiro, estados_liq_req_cacifos.descricao_estado_req_cacifos, estados_req_cacifos.descricao_estado_req_cacifos_, ano_letivo.descricao_ano_letivo
                FROM req_cacifos
                    JOIN cacifos ON cacifos.id = req_cacifos.id_cacifo
                    JOIN cacifo_piso ON cacifo_piso.id = cacifos.id_piso
                    JOIN estados_liq_req_cacifos ON estados_liq_req_cacifos.id = req_cacifos.id_estado_req
                    JOIN estados_req_cacifos ON estados_req_cacifos.id = req_cacifos.id_estado_req_cacifo
                    JOIN ano_letivo ON ano_letivo.id = req_cacifos.id_ano_letivo
                        WHERE (req_cacifos.id_requisitante =  "' . $uId . '" OR req_cacifos.id_parceiro = "' . $uId . '")';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}


function count_all_data_admin_caci($connect, $uId)
{
  $query = "SELECT req_cacifos.id, req_cacifos.id_requisitante, users.nome_user, users.user_departamento ,req_cacifos.id_parceiro, req_cacifos.id_cacifo, cacifos.id_proprio, cacifo_piso.descricao_cacifo_piso, req_cacifos.data, estados_liq_req_cacifos.descricao_estado_req_cacifos, estados_req_cacifos.descricao_estado_req_cacifos_, estados_dinheiro_cacifo.descricao_estado_dinheiro_cacifo, ano_letivo.descricao_ano_letivo
                FROM req_cacifos
                    JOIN users ON users.id = req_cacifos.id_requisitante
                    JOIN cacifos ON cacifos.id = req_cacifos.id_cacifo
                    JOIN cacifo_piso ON cacifo_piso.id = cacifos.id_piso
                    JOIN estados_liq_req_cacifos ON estados_liq_req_cacifos.id = req_cacifos.id_estado_req
                    JOIN estados_req_cacifos ON estados_req_cacifos.id = req_cacifos.id_estado_req_cacifo
                    JOIN estados_dinheiro_cacifo ON estados_dinheiro_cacifo.id = req_cacifos.id_estado_dinheiro_cacifo
                    JOIN ano_letivo ON ano_letivo.id = req_cacifos.id_ano_letivo
                    JOIN responsaveis_cacifos ON responsaveis_cacifos.id_piso = cacifo_piso.id
    	                WHERE responsaveis_cacifos.id_responsavel = '" . $uId . "'";

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}


function count_all_caci_admin_caci($connect, $rId)
{
  $query = 'SELECT cacifos.id, cacifos.id_proprio, cacifo_piso.descricao_cacifo_piso, estados_cacifos.descricao_estado_cacifo
                    FROM cacifos
                        JOIN cacifo_piso ON cacifo_piso.id = cacifos.id_piso
                        JOIN estados_cacifos ON estados_cacifos.id = cacifos.id_estado_cacifo
                        JOIN responsaveis_cacifos ON responsaveis_cacifos.id_piso = cacifo_piso.id
    	                    WHERE (responsaveis_cacifos.id_responsavel = "' . $rId . '" AND id_status = 1)';

  $statement = $connect->query($query);

  return $statement->rowCount();
}


function count_all_caci_class_acess($connect)
{
  $query = 'SELECT `id`, `descricao_nome_turma` FROM `turmas_acesso` WHERE 1';

  $statement = $connect->query($query);

  return $statement->rowCount();
}


function count_all_letiv_year($connect)
{
  $query = 'SELECT ano_letivo.id, ano_letivo.descricao_ano_letivo, estados_ano_letivo.descricao_estado_ano_letivo FROM ano_letivo JOIN estados_ano_letivo ON estados_ano_letivo.id = ano_letivo.id_estado_ano_letivo';

  $statement = $connect->query($query);

  return $statement->rowCount();
}

function checkUser($code, $authdata, $uId, $connect)
{
  $client_id = "93aaf16b-4edb-40ba-89df-a4f3565c5bca";  //Application (client) ID
  $ad_tenant = "";  //Azure Active Directory Tenant ID, with Multitenant apps you can use "common" as Tenant ID, but using specific endpoint is recommended when possible
  $client_secret = "d-E5OM68_5MT8IImlgd_IsRm9aR2-ce37X";  //Client Secret, remember that this expires someday unless you haven't set it not to do so
  $redirect_uri = "http://localhost/AdminLTE/api/Azure.php";  //This needs to match 100% what is set in Azure
  $error_email = "erroremail@hotmail.com"; //Debug print
  //Verifying the received tokens with Azure and finalizing the authentication part
  $content = "grant_type=authorization_code";
  $content .= "&client_id=" . $client_id;
  $content .= "&redirect_uri=" . urlencode($redirect_uri);
  $content .= "&code=" . $code;
  $content .= "&client_secret=" . urlencode($client_secret);
  $options = array(
    "http" => array(  //Use "http" even if you send the request with https
      "method"  => "POST",
      "header"  => "Content-Type: application/x-www-form-urlencoded\r\n" .
        "Content-Length: " . strlen($content) . "\r\n",
      "content" => $content
    )
  );
  //Fetching the basic user information that is likely needed by your application
  $options = array(
    "http" => array(  //Use "http" even if you send the request with https
      "method" => "GET",
      "header" => "Accept: application/json\r\n" .
        "Authorization: Bearer " . $authdata["access_token"] . "\r\n"
    )
  );
  $context = stream_context_create($options);

  if (preg_match('~[0-9]+~', $uId)) {
    $json = file_get_contents("https://graph.microsoft.com/v1.0/users/" . $uId . "@alunos.sefo.pt", false, $context);
    $user = json_decode($json, true);  //This should now contain your logged on user information

    $json = file_get_contents("https://graph.microsoft.com/v1.0/users/" . $uId . "@alunos.sefo.pt/department", false, $context);
    $userDepart = json_decode($json, true);  //This should now contain your logged on user information
  } else {
    $json = file_get_contents("https://graph.microsoft.com/v1.0/users/" . $uId . "@sefo.pt", false, $context);
    $user = json_decode($json, true);  //This should now contain your logged on user information

    $json = file_get_contents("https://graph.microsoft.com/v1.0/users/" . $uId . "@sefo.pt/department", false, $context);
    $userDepart = json_decode($json, true);  //This should now contain your logged on user informationss
  }

  if (!empty($user['mail'])) {

    $result = $connect->query('SELECT * FROM users WHERE email_user = "' . $user['mail'] . '"');

    if ($result->rowCount() == 0) {
      try {
        $connect->query('INSERT INTO `users`(`id`, `nome_user`, `email_user`, `user_departamento`) VALUES ("' . explode('@', trim($user['mail']))[0] . '","' . $user['displayName'] . '","' . $user['mail'] . '","' . $userDepart['value'] . '")');
        $connect->query('DELETE FROM users WHERE id = ""');
      } catch (Exception $e) {
        echo ($e->getMessage());
      }
    }

    $resp = "1";
  } else {
    $resp = "0";
  }

  return $resp;
}

function count_all_resp_mat($connect)
{
  $query = 'SELECT responsaveis_area.id, responsaveis_area.id_responsavel_area, users.nome_user, categorias_materiais.descricao_categoria FROM responsaveis_area 
                    JOIN categorias_materiais ON responsaveis_area.id_area_material = categorias_materiais.id 
                    JOIN users ON users.id = responsaveis_area.id_responsavel_area';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_resp_caci($connect)
{
  $query = 'SELECT responsaveis_cacifos.id, responsaveis_cacifos.id_responsavel, users.nome_user, cacifo_piso.descricao_cacifo_piso FROM responsaveis_cacifos 
                    JOIN cacifo_piso ON responsaveis_cacifos.id_piso = cacifo_piso.id 
                    JOIN users ON users.id = responsaveis_cacifos.id_responsavel';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_mat_area($connect)
{
  $query = 'SELECT * FROM `categorias_materiais`';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_caci_piso($connect)
{
  $query = 'SELECT * FROM cacifo_piso';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_resp_site($connect)
{
  $query = 'SELECT responsaveis_site.id, users.nome_user, users.email_user FROM responsaveis_site JOIN users ON users.id = responsaveis_site.id_responsavel_site';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function count_all_req_buy($connect, $rId)
{
  $query = 'SELECT req_compras.id, users.nome_user, req_compras.data_requerido, areas_compras.descricao_area_compra, req_compras.id_decisao, req_compras.id_devolvedor, req_compras.id_estado_req, setores_compras.descricao_setor_compra, decisoes_req.descricao_decisao_req, req_compras.data_requisicao, req_compras.data_decisao, req_compras.atividade, req_compras.disciplina, req_compras.modulo, req_compras.turma, req_compras.data_devolver, ano_letivo.descricao_ano_letivo FROM req_compras JOIN users ON users.id = req_compras.id_requisitante JOIN areas_compras ON areas_compras.id = req_compras.id_area JOIN setores_compras ON setores_compras.id = req_compras.id_setor JOIN decisoes_req ON decisoes_req.id = req_compras.id_decisao JOIN responsaveis_compras ON responsaveis_compras.id_area_compras = areas_compras.id JOIN ano_letivo ON ano_letivo.id = req_compras.id_ano_letivo WHERE responsaveis_compras.id_responsavel =  "' . $rId . '"';

  $statement = $connect->prepare($query);

  $statement->execute();

  return $statement->rowCount();
}

function sendEmail($to, $subject, $message, $action, $number)
{
  //Load Composer's autoloader
  require '../vendor/autoload.php';

  //Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->SMTPDebug = 0;                    //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.office365.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'youremail';                     //SMTP username
    $mail->Password   = 'yourpass';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;
    $mail->CharSet = 'UTF-8';                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above


    //Recipients
    $mail->setFrom('requisicoes@sefo.pt', 'Requisições ESCO');
    $mail->addAddress($to);     //Add a recipient              //Name is optional

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message . '<br><div style="position:absolute; bottom:0;"><div class="rps_fda3" data-ogsc="" style="color: rgb(255, 255, 255) !important; --darkreader-inline-color:#f9f8f5;"data-darkreader-inline-color = "" ><div lang = "PT" link = "#0563C1" vlink = "#954F72" style = "word-wrap:break-word" ><table class = "x_MsoNormalTable" border = "0" cellspacing = "3" cellpadding = "0" width = "586" style = "width: 439.5pt; transform: scale(0.422222, 0.422222); transform-origin: left top;" min-scale = "0.4222222222222222"><tbody><tr style = "height:69.75pt"><td width = "474" style = "width:355.5pt; padding:.75pt .75pt .75pt .75pt; height:69.75pt"><p class = "x_MsoNormal" align = "center" style = "text-align:center"><b><span style = "" ><img data-imagetype = "External" src = "http://www.sefo.pt/wp-content/uploads/assinatura.png" border = "0" width = "467" height = "110" id = "x__x0000_i1029" style = "width:4.8666in; height:1.15in" ></span></b><b><span style = "" ></span></b></p></td><td width = "96" style = "width:72.0pt; padding:.75pt .75pt .75pt .75pt; height:69.75pt"><p class = "x_MsoNormal"><a href = "https://pt-pt.facebook.com/ESCOTVedras" target = "_blank" rel = "noopener noreferrer" data-auth = "NotApplicable" data-linkindex = "1"><span style = "color: rgb(222, 152, 255) !important; text-decoration: none; --darkreader-inline-color:#ea9cff;" data-ogsc = "blue" data-darkreader-inline-color = "" ><img data-imagetype = "External" src = "http://www.sefo.pt/wp-content/uploads/facebook-square.png" border = "0" width = "45" height = "45" id = "x__x0000_i1028" alt = "" style = "width:.4666in; height:.4666in"></span></a><span style = "">&nbsp;</span><a href="https://twitter.com/ESCOTVedras" target="_blank" rel = "noopener noreferrer" data-auth = "NotApplicable" data-linkindex = "2"><span style = "color: rgb(222, 152, 255) !important; text-decoration: none; --darkreader-inline-color:#ea9cff;" data-ogsc = "blue" data-darkreader-inline-color = ""><img data-imagetype = "External" src = "http://www.sefo.pt/wp-content/uploads/Twitter-square.png" border = "0" width = "45" height = "45" id = "x__x0000_i1027" alt = "" style = "width:.4666in; height:.4666in"></span></a><a href = "https://www.linkedin.com/company/ESCOTVedras" target = "_blank" rel = "noopener noreferrer" data-auth = "NotApplicable" data-linkindex = "3"><span style = "color: rgb(222, 152, 255) !important; text-decoration: none; --darkreader-inline-color:#ea9cff;" data-ogsc = "blue" data-darkreader-inline-color = ""><img data-imagetype = "External" src = "http://www.sefo.pt/wp-content/uploads/Linkedin-square.png" border = "0" width = "45" height = "45" id = "x__x0000_i1026" alt = "" style = "width:.4666in; height:.4666in"></span></a><span style = "">&nbsp;</span><a href="https://www.instagram.com/escotvedras/" target = "_blank" rel = "noopener noreferrer" data-auth = "NotApplicable" data-linkindex = "4"><span style = "color: rgb(222, 152, 255) !important; text-decoration: none; --darkreader-inline-color:#ea9cff;" data-ogsc = "blue" data-darkreader-inline-color = ""><img data-imagetype = "External" src = "http://www.sefo.pt/wp-content/uploads/Instagram-square.png" border = "0" width = "45" height = "45" id = "x__x0000_i1025" alt = "" style = "width:.4666in; height:.4666in"></span></a><span style = "" ></span></p></td></tr></tbody></table></div><p class = "x_MsoNormal"><span style = "">&nbsp;</span></p><p class = "x_MsoNormal" >&nbsp;</p></div></div><div></div>';

    if ($action == 'sendEmailBuy') {
      $attachment = '../docs/reqs/Requisicao-' . $number . '.xlsx';
      $mail->AddAttachment($attachment, 'Requisicao-' . $number . '.xlsx');
    }

    $mail->send();
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}

function makeXLSX($class, $pedido, $dateNecessi, $nameUser, $sC, $dis, $mod, $nMod, $ati, $reqNumber)
{
  require  '../vendor/autoload.php';

  $start = 21;

  //load spreadsheet
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../docs/reqs/Modelo_Requisicao.xlsx');

  //change it
  $sheet = $spreadsheet->getActiveSheet();
  $spreadsheet->setActiveSheetIndex(0);

  $sheet->setCellValue('E7', !empty($dis) ? $dis : $ati);
  $sheet->setCellValue('B9', !empty($dis) ? $nMod : '');
  $sheet->setCellValue('D9', !empty($dis) ? $mod : '');
  $sheet->setCellValue('D11', $dateNecessi);
  $sheet->setCellValue('K7', $class);
  $sheet->setCellValue('C13', $nameUser);
  $sheet->setCellValue('K13', date("Y-m-d"));

  if ($sC == 1) {
    $sheet->setCellValue('J9', 'X');
  } elseif ($sC == 2) {
    $sheet->setCellValue('J10', 'X');
  } else $sheet->setCellValue('J11', 'X');

  foreach ($pedido as $key => $value) {
    $sheet->setCellValue('A' . $start, $value['quant']);
    $sheet->setCellValue('E' . $start, $value['name']);
    $sheet->setCellValue('I' . $start, $value['obser']);
    ++$start;
  }

  $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
  $writer->save('../docs/reqs/Requisicao-' . $reqNumber . '.xlsx');
}

function reSaveXLSX($fileNumber, $action, $userName)
{
  require  '../vendor/autoload.php';

  //load spreadsheet
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../docs/reqs/Requisicao-' . $fileNumber . '.xlsx');

  //change it
  $sheet = $spreadsheet->getActiveSheet();
  $spreadsheet->setActiveSheetIndex(0);

  if ($action == 'deciSet') {
    $sheet->setCellValue('F15', $userName);
    $sheet->setCellValue('K15', date("Y-m-d"));
  } else {
    $sheet->setCellValue('F17', $userName);
    $sheet->setCellValue('K17', date("Y-m-d"));
  }


  $writer = new Xlsx($spreadsheet);
  $writer->save('../docs/reqs/Requisicao-' . $fileNumber . '.xlsx');
}


function reMakeXLSX($fileNumber, $class, $pedido, $data_requerido, $data_requisicao, $data_decisao, $data_devolver, $atividade, $id_setor, $id_devolvedor, $nome_user, $id_modulo, $descricao_modulo, $descricao_disciplina, $id_decisao)
{
  require  '../vendor/autoload.php';

  //load spreadsheet
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('../docs/reqs/Requisicao-' . $fileNumber . '.xlsx');

  //change it
  $sheet = $spreadsheet->getActiveSheet();
  $spreadsheet->setActiveSheetIndex(0);

  $sheet->setCellValue('E7', empty($descricao_disciplina) || $descricao_disciplina == null ? $atividade : $descricao_disciplina);
  $sheet->setCellValue('B9', empty($descricao_disciplina) || $descricao_disciplina == null ? '' : $id_modulo);
  $sheet->setCellValue('D9', empty($descricao_disciplina) || $descricao_disciplina == null ? '' : $descricao_modulo);
  $sheet->setCellValue('D11', $data_requerido);
  $sheet->setCellValue('K7', $class);
  $sheet->setCellValue('C13', $nome_user);
  $sheet->setCellValue('K13', $data_requisicao);
  $sheet->setCellValue('F15', $id_decisao != 3 ? 'name of who accept or decline reqs' : '');
  $sheet->setCellValue('K15', $id_decisao != 3 ? $data_decisao : '');
  $sheet->setCellValue('F17', $id_devolvedor);
  $sheet->setCellValue('K17', $data_devolver);

  if ($id_setor == 1) {
    $sheet->setCellValue('J9', 'X');
  } elseif ($id_setor == 2) {
    $sheet->setCellValue('J10', 'X');
  } else $sheet->setCellValue('J11', 'X');


  $start = 21;

  foreach ($pedido as $key => $value) {
    $sheet->setCellValue('A' . $start, $value['quant']);
    $sheet->setCellValue('E' . $start, $value['name']);
    $sheet->setCellValue('I' . $start, $value['obser']);
    ++$start;
  }

  $writer = new Xlsx($spreadsheet);
  $writer->save('../docs/reqs/Requisicao-' . $fileNumber . '.xlsx');
}
