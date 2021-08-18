<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
} else {
    include_once('../api/bd.php');
    if ($respS = $connect->query('SELECT COUNT(*) FROM responsaveis_site WHERE id_responsavel_site = "' . $_SESSION['user']['id'] . '"')->fetchColumn() <= 0) {
        header("location: ../404.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset=" utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestão</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- Theme style -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- DataTables -->
    <link href="//cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" rel="stylesheet" />

    <!-- Alerts -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />


</head>

<body class="hold-transition sidebar-mini layout-footer-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include_once '../components/navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include_once '../components/sidebar.php' ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <br>
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <!-- Default box -->
                            <div class="card card-outline card-dark" id="buy-card">
                                <div class="card-header">
                                    <h3 class="card-title">Compras</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label for="table-resp-compra">
                                        <h5>Responsáveis Compras</h5>
                                    </label>
                                    <table id="table-resp-compra" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID do Responsável</th>
                                                <th>Nome do Responsável</th>
                                                <th>Área das Compras</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="table-buy-area">
                                        <h5>Áreas Compras</h5>
                                    </label>
                                    <table id="table-buy-area" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nome da área</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="table-area-buy">
                                        <h5>Associação Área a Setor de Compras</h5>
                                    </label>
                                    <table id="table-area-buy" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nome da área</th>
                                                <th>Nome do setor</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="respBuy-form">
                                        <h5>Adicionar Responsável Compras</h5>
                                    </label>
                                    <form id="respBuy-form">
                                        <input type="hidden" name="action" value="addRespBuy">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="input_userCaci_id">Id do responsável</label>
                                                <input type="text" class="form-control" id="input_userBuy_id" name="input_userBuy_id" placeholder="Ex: pedroalmeida" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sortB">Áreas compras</label>
                                                <select id="sortB" name="sortB" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-secondary" value="Confirmar">
                                    </form>
                                    <br>
                                    <label for="area-setor-form">
                                        <h5>Associar Área a Setor</h5>
                                    </label>
                                    <form id="area-setor-form">
                                        <input type="hidden" name="action" value="addAreaSetor">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sortBA">Áreas compras</label>
                                                <select id="sortBA" name="sortBA" class="form-control">
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sortBS">Setor compras</label>
                                                <select id="sortBS" name="sortBS" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-secondary" value="Confirmar">
                                    </form>
                                </div>
                            </div>
                            <div class="card card-outline card-dark" id="mats-card">
                                <div class="card-header">
                                    <h3 class="card-title">Materiais</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label for="table-resp-mat">
                                        <h5>Responsáveis materiais</h5>
                                    </label>
                                    <table id="table-resp-mat" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID do Responsável</th>
                                                <th>Nome do Responsável</th>
                                                <th>Área dos Materiais</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="table-resp-mat">
                                        <h5>Áreas de Materiais</h5>
                                    </label>
                                    <table id="table-area-mat" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nome da área</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="resp-form">
                                        <h5>Adicionar Responsável Materiais</h5>
                                    </label>
                                    <form id="resp-form">
                                        <input type="hidden" name="action" value="addResp">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="input_user_id">Id do responsável</label>
                                                <input type="text" class="form-control" id="input_user_id" name="input_user_id" placeholder="Ex: pedroalmeida" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sort">Áreas disponíveis</label>
                                                <select id="sort" name="sort" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-secondary" value="Confirmar">
                                    </form>
                                </div>
                            </div>
                            <div class="card card-outline card-dark" id="caci-card">
                                <div class="card-header">
                                    <h3 class="card-title">Cacifos</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label for="table-resp-caci">
                                        <h5>Responsáveis Cacifos</h5>
                                    </label>
                                    <table id="table-resp-caci" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID do Responsável</th>
                                                <th>Nome do Responsável</th>
                                                <th>Piso dos cacifo</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="table-piso-Caci">
                                        <h5>Pisos de cacifos</h5>
                                    </label>
                                    <table id="table-piso-Caci" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nome do piso</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="respCaci-form">
                                        <h5>Adicionar Responsável Cacifos</h5>
                                    </label>
                                    <form id="respCaci-form">
                                        <input type="hidden" name="action" value="addRespCaci">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="input_userCaci_id">Id do responsável</label>
                                                <input type="text" class="form-control" id="input_userCaci_id" name="input_userCaci_id" placeholder="Ex: pedroalmeida" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sortP">Pisos disponíveis</label>
                                                <select id="sortP" name="sortP" class="form-control">
                                                </select>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-secondary" value="Confirmar">
                                    </form>
                                </div>
                            </div>
                            <div class="card card-outline card-dark" id="others-card">
                                <div class="card-header">
                                    <h3 class="card-title">Outros</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <label for="table-piso-Caci">
                                        <h5>Ano-Letivos</h5>
                                    </label>
                                    <table id="table-letiv-year" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Ano-Letivo</th>
                                                <th>Estado do Ano-Letivo</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <br>
                                    <label for="table-resp-site">
                                        <h5>Responsáveis Site</h5>
                                    </label>
                                    <table id="table-resp-site" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Nome do responsável</th>
                                                <th>Email do responsável</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include_once '../components/footer.php' ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Bootstrap 4 -->
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- AdminLTE App -->
    <script src="//cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.bootstrap4.min.js"></script>
    <script src="//cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

    <!-- Alerts -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(function() {

            loadTablesInfo();
            loadConfigs();

            $("#resp-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                        } else alertify.notify(res.message, 'error', 5);
                        $('#input_user_id').val("")
                    }, 'json'
                );
            });


            $("#respCaci-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                        } else alertify.notify(res.message, 'error', 5);
                        $('#input_userCaci_id').val("")
                    }, 'json'
                );
            });

            $("#respBuy-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                        } else alertify.notify(res.message, 'error', 5);
                        $('#input_userBuy_id').val("")
                    }, 'json'
                );
            });

            $("#area-setor-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                        } else alertify.notify(res.message, 'error', 5);
                    }, 'json'
                );
            });

            function loadConfigs() {
                alertify.set('notifier', 'position', 'top-right');

                $('#mats-card').CardWidget('toggle')
                $('#caci-card').CardWidget('toggle')
                $('#buy-card').CardWidget('toggle')
                $('#others-card').CardWidget('toggle')


                $.post("../api/api.php", {
                        "action": "showCategory",
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_categoria + "</option>";
                        });
                        $("#sort").append(html);
                    }, "json"
                );

                $.post("../api/api.php", {
                        "action": "showAllPisos",
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_cacifo_piso + "</option>";
                        });
                        $("#sortP").append(html);
                    }, "json"
                );

                $.post("../api/api.php", {
                        "action": "showBuyArea",
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_area_compra + "</option>";
                        });
                        $("#sortB").append(html);
                        $("#sortBA").append(html);
                    }, "json"
                );

                $.post("../api/api.php", {
                        "action": "showBuySetors",
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_setor_compra + "</option>";
                        });
                        $("#sortBS").append(html);
                    }, "json"
                );
            }

            function loadTablesInfo() {
                var tableLY = $('#table-letiv-year').DataTable({
                    "dom": 'Bfrtip',
                    "processing": false,
                    "serverSide": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    "columnDefs": [{
                        targets: [0, 1],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showLetivYear",
                        }
                    },
                    "columns": [{
                        "data": "descricao_ano_letivo"
                    }, {
                        "data": "descricao_estado_ano_letivo"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableLY.ajax.reload(null, false);
                            tableLY.button(3).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-plus"></i>',
                        titleAttr: 'Adicionar Ano-Letivo',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo iniciar um novo Ano-Letivo?', function() {
                                $.post("../api/api.php", {
                                        "action": "activeLetivYear",
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableLY.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                    }, 'json'
                                );
                            }, function() {}).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                    }]
                });

                var tableR = $('#table-resp-mat').DataTable({
                    "dom": 'Bfrtip',
                    "processing": false,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    "columnDefs": [{
                        targets: [0, 1, 2],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showRespMat",
                        }
                    },
                    "columns": [{
                        "data": "id_responsavel_area"
                    }, {
                        "data": "nome_user"
                    }, {
                        "data": "descricao_categoria"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableR.ajax.reload(null, false);
                            tableR.button(3).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar responsável',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo retirar este responsável?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteResp",
                                        "respId": tableR.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableR.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableR.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableR.row({
                                    selected: true
                                }).deselect();
                                tableR.button(3).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableR.on('select deselect', function() {
                    var selectedRows = tableR.rows({
                        selected: true
                    }).count();

                    tableR.button(3).enable(selectedRows === 1);
                });

                var tableRC = $('#table-resp-caci').DataTable({
                    "dom": 'Bfrtip',
                    "processing": false,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    "columnDefs": [{
                        targets: [0, 1, 2],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showRespCaci",
                        }
                    },
                    "columns": [{
                        "data": "id_responsavel"
                    }, {
                        "data": "nome_user"
                    }, {
                        "data": "descricao_cacifo_piso"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableRC.ajax.reload(null, false);
                            tableRC.button(3).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar responsável',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo retirar este responsável?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteRespCaci",
                                        "respId": tableRC.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableRC.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableRC.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableRC.row({
                                    selected: true
                                }).deselect();
                                tableRC.button(3).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableRC.on('select deselect', function() {
                    var selectedRows = tableRC.rows({
                        selected: true
                    }).count();

                    tableRC.button(3).enable(selectedRows === 1);
                });

                var tableMA = $('#table-area-mat').DataTable({
                    "dom": 'Bfrtip',
                    "processing": false,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "searching": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [],
                    "columnDefs": [{
                        targets: [0],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showMatAreas",
                        }
                    },
                    "columns": [{
                        "data": "descricao_categoria"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableMA.ajax.reload(null, false);
                            tableMA.button(4).disable();
                            tableMA.button(5).disable();
                            tableMA.button(6).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-plus"></i>',
                        titleAttr: 'Adicionar Área',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Nome da área', '', function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "addMatArea",
                                        "areaName": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableMA.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                    }, {
                        text: '<i class="fas fa-wrench"></i>',
                        titleAttr: 'Editar Área',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Nome da área', tableMA.rows({
                                selected: true
                            }).data()[0].descricao_categoria, function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "editMatArea",
                                        "matAreaId": tableMA.rows({
                                            selected: true
                                        }).data()[0].id,
                                        "areaName": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableMA.ajax.reload(null, false);
                                            tableMA.button(4).disable();
                                            tableMA.button(5).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-box"></i>',
                        titleAttr: 'Ver stock',
                        action: function(e, dt, node, config) {
                            $.post("../api/api.php", {
                                    "action": "getRespMatNumber",
                                    "matAreaId": tableMA.rows({
                                        selected: true
                                    }).data()[0].id
                                },
                                function(data) {
                                    if (data.status == 1) {
                                        alertify.notify(data.message, 'success', 5);
                                    } else alertify.notify(data.message, 'error', 5);
                                    tableMA.row({
                                        selected: true
                                    }).deselect();
                                }, 'json'
                            );
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar área',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar esta área?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteMatArea",
                                        "matAreaId": tableMA.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableMA.ajax.reload(null, false);
                                            tableMA.button(4).disable();
                                            tableMA.button(5).disable();
                                            tableMA.button(6).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableMA.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableMA.row({
                                    selected: true
                                }).deselect();
                                tableMA.button(4).disable();
                                tableMA.button(5).disable();
                                tableMA.button(6).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableMA.on('select deselect', function() {
                    var selectedRows = tableMA.rows({
                        selected: true
                    }).count();

                    tableMA.button(6).enable(selectedRows === 1);
                    tableMA.button(5).enable(selectedRows === 1);
                    tableMA.button(4).enable(selectedRows === 1);
                });


                var tableBuy = $('#table-buy-area').DataTable({
                    "dom": 'Bfrtip',
                    "processing": true,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "searching": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [0, 'asc']
                    ],
                    "columnDefs": [{
                        targets: [0],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showBA",
                        }
                    },
                    "columns": [{
                        "data": "descricao_area_compra"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableBuy.ajax.reload(null, false);
                            tableBuy.button(4).disable();
                            tableBuy.button(5).disable();
                            tableBuy.button(6).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-plus"></i>',
                        titleAttr: 'Adicionar Piso',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Nome da área', '', function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "addBuyArea",
                                        "areaName": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableBuy.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                    }, {
                        text: '<i class="fas fa-wrench"></i>',
                        titleAttr: 'Editar Piso',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Nome da área', tableBuy.rows({
                                selected: true
                            }).data()[0].descricao_area_compra, function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "editAreaBuy",
                                        "areaId": tableBuy.rows({
                                            selected: true
                                        }).data()[0].id,
                                        "areaName": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableBuy.ajax.reload(null, false);
                                            tableBuy.button(4).disable();
                                            tableBuy.button(5).disable();
                                            tableBuy.button(6).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-box"></i>',
                        titleAttr: 'Ver stock',
                        action: function(e, dt, node, config) {
                            $.post("../api/api.php", {
                                    "action": "getRespAreaNumber",
                                    "areaId": tableBuy.rows({
                                        selected: true
                                    }).data()[0].id
                                },
                                function(data) {
                                    if (data.status == 1) {
                                        alertify.notify(data.message, 'success', 5);
                                    } else alertify.notify(data.message, 'error', 5);
                                    tableBuy.row({
                                        selected: true
                                    }).deselect();
                                }, 'json'
                            );
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar Piso',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar este piso?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteAreaBuy",
                                        "areaId": tableBuy.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableBuy.ajax.reload(null, false);
                                            tableBuy.button(4).disable();
                                            tableBuy.button(5).disable();
                                            tableBuy.button(6).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableBuy.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableBuy.row({
                                    selected: true
                                }).deselect();
                                tableBuy.button(4).disable();
                                tableBuy.button(5).disable();
                                tableBuy.button(6).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableBuy.on('select deselect', function() {
                    var selectedRows = tableBuy.rows({
                        selected: true
                    }).count();

                    tableBuy.button(6).enable(selectedRows === 1);
                    tableBuy.button(5).enable(selectedRows === 1);
                    tableBuy.button(4).enable(selectedRows === 1);
                });

                var tablePC = $('#table-piso-Caci').DataTable({
                    "dom": 'Bfrtip',
                    "processing": false,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "searching": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [0, 'asc']
                    ],
                    "columnDefs": [{
                        targets: [0],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showPisoCaci",
                        }
                    },
                    "columns": [{
                        "data": "descricao_cacifo_piso"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tablePC.ajax.reload(null, false);
                            tablePC.button(4).disable();
                            tablePC.button(5).disable();
                            tablePC.button(6).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-plus"></i>',
                        titleAttr: 'Adicionar Piso',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Nome do Piso', '', function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "addPisoCaci",
                                        "pisoName": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tablePC.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                    }, {
                        text: '<i class="fas fa-wrench"></i>',
                        titleAttr: 'Editar Piso',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Nome do Piso', tablePC.rows({
                                selected: true
                            }).data()[0].descricao_cacifo_piso, function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "editPisoCaci",
                                        "pisoCaciId": tablePC.rows({
                                            selected: true
                                        }).data()[0].id,
                                        "pisoName": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tablePC.ajax.reload(null, false);
                                            tablePC.button(4).disable();
                                            tablePC.button(5).disable();
                                            tablePC.button(6).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-box"></i>',
                        titleAttr: 'Ver stock',
                        action: function(e, dt, node, config) {
                            $.post("../api/api.php", {
                                    "action": "getRespCaciNumber",
                                    "pisoCaciId": tablePC.rows({
                                        selected: true
                                    }).data()[0].id
                                },
                                function(data) {
                                    if (data.status == 1) {
                                        alertify.notify(data.message, 'success', 5);
                                    } else alertify.notify(data.message, 'error', 5);
                                    tablePC.row({
                                        selected: true
                                    }).deselect();
                                }, 'json'
                            );
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar Piso',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar este piso?', function() {
                                $.post("../api/api.php", {
                                        "action": "deletePisoCaci",
                                        "pisoCaciId": tablePC.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tablePC.ajax.reload(null, false);
                                            tablePC.button(4).disable();
                                            tablePC.button(5).disable();
                                            tablePC.button(6).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        tablePC.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tablePC.row({
                                    selected: true
                                }).deselect();
                                tablePC.button(4).disable();
                                tablePC.button(5).disable();
                                tablePC.button(6).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tablePC.on('select deselect', function() {
                    var selectedRows = tablePC.rows({
                        selected: true
                    }).count();

                    tablePC.button(6).enable(selectedRows === 1);
                    tablePC.button(5).enable(selectedRows === 1);
                    tablePC.button(4).enable(selectedRows === 1);
                });

                var tableRS = $('#table-resp-site').DataTable({
                    "dom": 'Bfrtip',
                    "processing": false,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [],
                    "columnDefs": [{
                        targets: [0, 1],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showRespSite",
                        }
                    },
                    "columns": [{
                        "data": "nome_user"
                    }, {
                        "data": "email_user"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableRS.ajax.reload(null, false);
                            tableRS.button(4).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-plus"></i>',
                        titleAttr: 'Adicionar responsável',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'ID do responsável', '', function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "addRespSite",
                                        "respId": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableRS.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar responsável',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar este responsável?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteRespSite",
                                        "respId": tableRS.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableRS.ajax.reload(null, false);
                                            tableRS.button(4).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableRS.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableRS.row({
                                    selected: true
                                }).deselect();
                                tableRS.button(4).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableRS.on('select deselect', function() {
                    var selectedRows = tableRS.rows({
                        selected: true
                    }).count();

                    tableRS.button(4).enable(selectedRows === 1);
                });

                var tableRB = $('#table-resp-compra').DataTable({
                    "dom": 'Bfrtip',
                    "processing": true,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    "columnDefs": [{
                        targets: [0, 1, 2],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showRespCompras",
                        }
                    },
                    "columns": [{
                        "data": "id_responsavel"
                    }, {
                        "data": "nome_user"
                    }, {
                        "data": "descricao_area_compra"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableRB.ajax.reload(null, false);
                            tableRB.row({
                                selected: true
                            }).deselect();
                            tableRB.button(3).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar responsável',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo retirar este responsável?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteRespBuy",
                                        "respId": tableRB.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableRB.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableRB.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableRB.row({
                                    selected: true
                                }).deselect();
                                tableR.button(3).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableRB.on('select deselect', function() {
                    var selectedRows = tableRB.rows({
                        selected: true
                    }).count();

                    tableRB.button(3).enable(selectedRows === 1);
                });

                var tableBA = $('#table-area-buy').DataTable({
                    "dom": 'Bfrtip',
                    "processing": true,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [0, "desc"]
                    ],
                    "columnDefs": [{
                        targets: [0],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showAreasBuy",
                        }
                    },
                    "columns": [{
                        "data": "descricao_area_compra"
                    }, {
                        "data": "descricao_setor_compra"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableBA.ajax.reload(null, false);
                            tableBA.row({
                                selected: true
                            }).deselect();
                            tableBA.button(3).disable();
                        }
                    }, {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf"></i>',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        titleAttr: 'Exportar para PDF'
                    }, {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i>',
                        titleAttr: 'Imprimir Tabela'
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar responsável',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar esta união?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteAreaSetor",
                                        "id_area_setor": tableBA.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableBA.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableBA.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableBA.row({
                                    selected: true
                                }).deselect();
                                tableBA.button(3).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableBA.on('select deselect', function() {
                    var selectedRows = tableBA.rows({
                        selected: true
                    }).count();

                    tableBA.button(3).enable(selectedRows === 1);
                });
            }
        });
    </script>
</body>

</html>