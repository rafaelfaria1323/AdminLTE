<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
} else {
    include_once('../api/bd.php');
    if ($rC = $connect->query('SELECT COUNT(*) FROM responsaveis_cacifos WHERE id_responsavel = "' . $_SESSION['user']['id'] . '"')->fetchColumn() <= 0) {
        header("location: ../404.php");
    }
}
?>

<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisições Cacifos</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- Theme style -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <!-- DataTables -->
    <link href="//cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

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
                            <div class="card card-outline card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Requisições</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-requi-admin" class="table table-hover table-bordered dt-responsive nowrap" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Número da Requisição</th>
                                                <th>Número do Requisitante</th>
                                                <th>Nome do Requisitante</th>
                                                <th>Turma do Requisitante</th>
                                                <th>Parceiro do Requisitante</th>
                                                <th>Número Cacifo</th>
                                                <th>Piso do cacifo:</th>
                                                <th>Data da Requisição:</th>
                                                <th>Estado Liquidação da Requisição:</th>
                                                <th>Estado da Requisição:</th>
                                                <th>Estado de Devolução de dinheiro:</th>
                                                <th>Ano-Letivo da Requisição:</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" card card-outline card-dark" id="caci-card">
                        <div class="card-header">
                            <h3 class="card-title">Cacifos</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table-mat-admin" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Número do Cacifo</th>
                                        <th>Piso do Cacifo</th>
                                        <th>Estado do Cacifo</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class=" card card-outline card-dark" id="add-caci">
                        <div class="card-header">
                            <h3 class="card-title">Inserir novo Cacifo</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="" id="caci-form" method="POST">
                                <input type="hidden" name="action" value="addCaci">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sM">Piso do Cacifo</label>
                                        <select id="sM" name="sM" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="input_caci_quant">Número do Cacifo</label>
                                        <input type="number" class="form-control" id="input_caci_quant" name="input_caci_quant" min="1" max="50" value="1" required>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-secondary" value="Inserir">
                            </form>
                        </div>
                    </div>
                    <div class=" card card-outline card-dark" id="turmas-card">
                        <div class="card-header">
                            <h3 class="card-title">Turmas com acesso Piso 0</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table-turmas-admin" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nome da Turma</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class=" card card-outline card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Nova Requisição</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="requi-form">
                                <input type="hidden" name="action" value="addReqCaciAdmin">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="input_user_id">Número do Aluno</label>
                                        <input type="text" class="form-control" id="input_user_id" name="input_user_id" placeholder="Ex: a2776" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="input_parceiro_id">Número do Parceiro</label>
                                        <input type="text" class="form-control" id="input_parceiro_id" name="input_parceiro_id" placeholder="Ex: a2776">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sort">Piso Cacifo</label>
                                        <select id="sort" name="sort" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="text_date">Data de Requisição</label>
                                        <input id="date" name="date" type="text" class="form-control" readonly>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-secondary" value="Inserir">
                            </form>
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

    <script src="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Alerts -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script>
        $(function() {

            loadTableInfo();
            loadConfigs();
            loadDate();

            $("#caci-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                            $('#input_caci_quant').val(1);
                        } else alertify.notify(res.message, 'error', 5);
                    }, 'json'
                );
            });

            $("#requi-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                            $('#input_user_id').val('');
                            $('#input_parceiro_id').val('');
                        } else alertify.notify(res.message, 'error', 5);
                    }, 'json'
                );
            });

            function loadDate() {
                var now = new Date();
                $('#date').val(now.getFullYear() + "-" + (("0" + (now.getMonth() + 1)).slice(-2)) + "-" + (("0" + now.getDate()).slice(-2)));
            }

            function loadConfigs() {
                alertify.set('notifier', 'position', 'top-right');

                $('#caci-card').CardWidget('toggle');
                $('#add-caci').CardWidget('toggle');
                $('#turmas-card').CardWidget('toggle');

                $.post("../api/api.php", {
                        "action": "showFloorCaci",
                        "userId": "<?php echo $_SESSION['user']['id'] ?>"
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_cacifo_piso + "</option>";
                        });
                        $("#sM").append(html);
                        $('#sort').append(html);

                        $('#sM').selectpicker('refresh');
                        $('#sort').selectpicker('refresh');

                    }, "json"
                );
            }

            function loadTableInfo() {
                var tableR = $('#table-requi-admin').DataTable({
                    "dom": 'Bfrtip',
                    "processing": true,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [7, "desc"]
                    ],
                    "columnDefs": [{
                        targets: [0, 1, 2, 3, 4, 5],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showRequiAdminCaci",
                            userId: "<?php echo $_SESSION['user']['id'] ?>"
                        }
                    },
                    "columns": [{
                            "data": "id"
                        }, {
                            "data": "id_requisitante"
                        }, {
                            "data": "nome_user"
                        }, {
                            "data": "user_departamento"
                        }, {
                            "data": "id_parceiro"
                        }, {
                            "data": "id_proprio"
                        }, {
                            "data": "descricao_cacifo_piso",
                            "className": "none"
                        }, {
                            "data": "data",
                            "className": "none"
                        }, {
                            "data": "descricao_estado_req_cacifos",
                            "className": "none"

                        }, {
                            "data": "descricao_estado_req_cacifos_",
                            "className": "none"
                        },
                        {
                            "data": "descricao_estado_dinheiro_cacifo",
                            "className": "none"
                        },
                        {
                            "data": "descricao_ano_letivo",
                            "className": "none"
                        }
                    ],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableR.ajax.reload(null, false);
                            tableR.button(3).disable();
                            tableR.button(4).disable();
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
                        text: '<i class="fas fa-euro-sign"></i>',
                        titleAttr: 'Liquidar Requisição',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo Liquidar esta requisição?', function() {
                                $.post("../api/api.php", {
                                        "action": "liquiReqCaci",
                                        "reqId": tableR.rows({
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
                                tableR.button(4).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-check"></i>',
                        titleAttr: 'Finalizar Requisição',
                        action: function(e, dt, node, config) {

                            alertify.prompt('Requisições ESCO - Finalizar Requisição')
                                .setContent("<span>Entrega caução: </span><select style='width: 50%'><option value='1'>Sim</option><option value='2'>Não</option></select>")
                                .set('onok', function(closeEvent) {
                                    $.post("../api/api.php", {
                                            "action": "finishReqCaci",
                                            "reqId": tableR.rows({
                                                selected: true
                                            }).data()[0].id,
                                            "caciId": tableR.rows({
                                                selected: true
                                            }).data()[0].id_cacifo,
                                            "refundId": this.elements.content.querySelector('select').value,
                                        },
                                        function(data) {
                                            if (data.status == 1) {
                                                alertify.notify(data.message, 'success', 5);
                                                tableR.ajax.reload(null, false);
                                            } else alertify.notify(data.message, 'error', 5);
                                            tableR.row({
                                                selected: true
                                            }).deselect();
                                            alertify.prompt().destroy();
                                        }, 'json'
                                    );
                                }).set('oncancel', function(closeEvent) {
                                    tableR.row({
                                        selected: true
                                    }).deselect();
                                    tableR.button(3).disable();
                                    tableR.button(4).disable();
                                    alertify.prompt().destroy();
                                }).set('labels', {
                                    ok: 'Ok',
                                    cancel: 'Cancelar'
                                }).show();
                        },
                        enabled: false
                    }]
                });

                tableR.on('select deselect', function() {
                    var selectedRows = tableR.rows({
                        selected: true
                    }).count();

                    tableR.button(3).enable(selectedRows === 1);
                    tableR.button(4).enable(selectedRows === 1);
                });

                var tableM = $('#table-mat-admin').DataTable({
                    "dom": "Bfrtip",
                    "processing": true,
                    "serverSide": true,
                    "serverMethod": 'post',
                    "select": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [0, "desc"]
                    ],
                    "ajax": {
                        url: "../api/api.php",
                        data: {
                            action: "showCaciAdmin",
                            userId: "<?php echo $_SESSION['user']['id'] ?>"
                        },
                    },
                    "columns": [{
                        "data": "id_proprio"
                    }, {
                        "data": "descricao_cacifo_piso"
                    }, {
                        "data": "descricao_estado_cacifo"
                    }],
                    "buttons": [{
                            text: '<i class="fas fa-sync"></i>',
                            titleAttr: 'Atualizar Tabela',
                            action: function(e, dt, node, config) {
                                tableM.ajax.reload(null, false);
                                tableM.button(3).disable();
                                tableM.button(4).disable();
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
                            text: '<i class="fas fa-wrench"></i>',
                            titleAttr: 'Editar material',
                            action: function(e, dt, node, config) {
                                alertify.prompt('Requisições ESCO')
                                    .setContent("<span>Estado do Cacifo: </span><select style='width: 50%'><option value='1'>Disponível</option><option value='3'>Avariado</option></select>")
                                    .set('onok', function(closeEvent) {
                                        $.post("../api/api.php", {
                                                "action": "changeStatusCaci",
                                                "caciId": tableM.rows({
                                                    selected: true
                                                }).data()[0].id,
                                                "statusId": this.elements.content.querySelector('select').value,
                                            },
                                            function(data) {
                                                if (data.status == 1) {
                                                    alertify.notify(data.message, 'success', 5);
                                                    tableM.ajax.reload(null, false);
                                                } else alertify.notify(data.message, 'error', 5);
                                                tableM.row({
                                                    selected: true
                                                }).deselect();
                                                alertify.prompt().destroy();
                                            }, 'json'
                                        );


                                    }).set('oncancel', function(closeEvent) {
                                        tableM.row({
                                            selected: true
                                        }).deselect();
                                        tableM.button(3).disable();
                                        tableM.button(4).disable();
                                        alertify.prompt().destroy();
                                    }).set('labels', {
                                        ok: 'Ok',
                                        cancel: 'Cancelar'
                                    }).show();
                            },
                            enabled: false
                        },
                        {
                            text: '<i class="fas fa-trash-alt"></i>',
                            titleAttr: 'Eliminar material',
                            action: function(e, dt, node, config) {
                                alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar este cacifo?', function() {
                                    $.post("../api/api.php", {
                                            "action": "deleteCaci",
                                            "caciId": tableM.rows({
                                                selected: true
                                            }).data()[0].id,
                                        },
                                        function(data) {
                                            if (data.status == 1) {
                                                alertify.notify(data.message, 'success', 5);
                                                tableM.ajax.reload(null, false);
                                            } else alertify.notify(data.message, 'error', 5);
                                            tableM.row({
                                                selected: true
                                            }).deselect();
                                        }, 'json'
                                    );
                                }, function() {
                                    tableM.row({
                                        selected: true
                                    }).deselect();
                                    tableM.button(3).disable();
                                    tableM.button(4).disable();
                                }).set('labels', {
                                    ok: 'Sim',
                                    cancel: 'Cancelar'
                                });
                            },
                            enabled: false
                        }
                    ]
                });

                tableM.on('select deselect', function() {
                    var selectedRows = tableM.rows({
                        selected: true
                    }).count();

                    tableM.button(3).enable(selectedRows === 1);
                    tableM.button(4).enable(selectedRows === 1);
                });

                var tableRS = $('#table-turmas-admin').DataTable({
                    "dom": 'Bfrtip',
                    "processing": true,
                    "serverSide": true,
                    "select": true,
                    "responsive": true,
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
                            action: "showClassAcess",
                        }
                    },
                    "columns": [{
                        "data": "descricao_nome_turma"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableRS.ajax.reload(null, false);
                            tableRS.button(4).disable();
                            tableRS.button(5).disable();
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
                        titleAttr: 'Adicionar acesso a Turma',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Sigla da Turma', '', function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "addClassAccess",
                                        "className": value
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
                        text: '<i class="fas fa-wrench"></i>',
                        titleAttr: 'Editar sigla turma',
                        action: function(e, dt, node, config) {
                            alertify.prompt('Requisições ESCO', 'Sigla da turma', tableRS.rows({
                                selected: true
                            }).data()[0].descricao_nome_turma, function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "editClassAcess",
                                        "accessId": tableRS.rows({
                                            selected: true
                                        }).data()[0].id,
                                        "className": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableRS.ajax.reload(null, false);
                                            tableRS.button(4).disable();
                                            tableRS.button(5).disable();
                                        } else alertify.notify(data.message, 'error', 5);
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {});
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar previlégio turma',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar esta turma?', function() {
                                $.post("../api/api.php", {
                                        "action": "deleteAcessClass",
                                        "accesspId": tableRS.rows({
                                            selected: true
                                        }).data()[0].id,
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableRS.ajax.reload(null, false);
                                            tableRS.button(4).disable();
                                            tableRS.button(5).disable();
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
                                tableRS.button(5).disable();
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
                    tableRS.button(5).enable(selectedRows === 1);
                });
            }
        });
    </script>

</body>

</html>