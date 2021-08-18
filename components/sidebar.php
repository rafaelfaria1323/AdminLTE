<?php
require_once('../api/bd.php');
$rA = $rC = $respS = $respC = 0;

$rA = $connect->query('SELECT COUNT(*) FROM responsaveis_area WHERE id_responsavel_area = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
$rC = $connect->query('SELECT COUNT(*) FROM responsaveis_cacifos WHERE id_responsavel = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
$respS = $connect->query('SELECT COUNT(*) FROM responsaveis_site WHERE id_responsavel_site = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
$respC = $connect->query('SELECT COUNT(*) FROM responsaveis_compras WHERE id_responsavel = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset=" UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <!-- Alerts -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
</head>

<body>
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="data:image/png;base64,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" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <span style="color:#c2c7d0;"><?php echo $_SESSION['user']['nome'] ?></span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-header">Requisições</li>
                    <?php if (preg_match('~[0-9]+~', $_SESSION['user']['id'])) :  ?>
                        <li class="nav-item">
                            <a href="../user/compras.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Compras
                                </p>
                            </a>
                        </li>
                    <?php endif  ?>
                    <li class="nav-item">
                        <a href="../user/materiais.php" class="nav-link">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Materiais
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="../user/cacifos.php" class="nav-link">
                            <i class="nav-icon fas fa-lock"></i>
                            <p>
                                Cacifos
                            </p>
                        </a>
                    </li>
                    <?php if ($rA > 0 || $rC > 0 || $respS > 0 || $respC > 0) :  ?>
                        <li class="nav-header" id="admin-title">Administração</li>
                        <?php if ($respC > 0) : ?>
                            <li class="nav-item">
                                <a href="../admin/compras.php" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Compras
                                    </p>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if ($rA > 0) : ?>
                            <li class="nav-item" id="admin-mat">
                                <a href="../admin/materiais.php" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Materiais
                                    </p>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if ($rC > 0) : ?>
                            <li class="nav-item" id="admin-caci">
                                <a href="../admin/cacifos.php" class="nav-link">
                                    <i class="nav-icon fas fa-lock"></i>
                                    <p>
                                        Cacifos
                                    </p>
                                </a>
                            </li>
                        <?php endif ?>
                        <?php if ($respS > 0) : ?>
                            <li class="nav-item" id="admin-gest">
                                <a href="../admin/gestao.php" class="nav-link">
                                    <i class="nav-icon fas fa-cogs"></i>
                                    <p>
                                        Gestão
                                    </p>
                                </a>
                            </li>
                        <?php endif ?>
                    <?php endif ?>
                    <li class="nav-header">Ações</li>
                    <li class="nav-item" id="logout">
                        <span class="nav-link" style="color: #c2c7d0; cursor:pointer">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Sair
                            </p>
                        </span>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Alerts -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(function() {

            alertify.set('notifier', 'position', 'top-right');

            // $("#logout").click(function() {
            //     alertify.confirm('Requisições ESCO', 'Deseja mesmo sair?', function() {
            //         $.post("../api/api.php", {
            //                 "action": "logout",
            //             },
            //             function(data) {
            //                 if (data.status == 1) {
            //                     location.replace('https://login.microsoftonline.com/{0}/oauth2/logout?post_logout_redirect_uri=http://localhost/AdminLTE/api/Azure.php')
            //                 } else alertify.notify(data.message, 'error', 5);
            //             }, 'json'
            //         );

            //     }, function() {}).set('labels', {
            //         ok: 'Sim',
            //         cancel: 'Cancelar'
            //     });
            // });

        })
    </script>

</body>

</html>