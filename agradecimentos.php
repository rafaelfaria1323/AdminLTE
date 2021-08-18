<?php
session_start();
include './api/bd.php';
if ($data = $connect->query('SELECT COUNT(*) FROM tokens_req WHERE id_requisicao = ' . $_GET['rI'] . ' AND token = "' . $_GET['t'] . '"')->fetchColumn() <= 0) {
    header('location: ./404.php');
} elseif ($data = $connect->query('SELECT COUNT(*) FROM tokens_req WHERE id_requisicao = ' . $_GET['rI'] . ' AND token = "' . $_GET['t'] . '" AND usado = 1')->fetchColumn() > 0) {
    header('location: ./404.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Requisicoes ESCO - Obrigado pela sua resposta</title>
    <script src="https://bootstrapcreative.com/wp-bc/wp-content/themes/wp-bootstrap/codepen/bootstrapcreative.js?v=1"></script>

    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css'>
</head>

<body>

    <div class="jumbotron text-xs-center">
        <h1 class="display-3">Obrigado!</h1>
        <p class="lead"><strong>Please check your email</strong> for further instructions on how to complete your account setup.</p>
        <hr>
        <p class="lead">
            <a class="btn btn-primary btn-sm" href="http://localhost/AdminLTE/user/materiais.php" role="button">Voltar ao Início</a>
        </p>
    </div>
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src='//maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js'></script>

    <script>
        $(function() {
            $.post("./api/api.php", {
                    action: 'deciSet',
                    reqId: '<?php echo $_GET['rI'] ?>',
                    token: '<?php echo $_GET['t'] ?>',
                    deci: '<?php echo $_GET['d'] ?>'
                },
                function(data) {}
            );
        });
    </script>

</body>

</html>