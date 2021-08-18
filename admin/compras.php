<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
}  else {
    include_once('../api/bd.php');
    if ($rA = $connect->query('SELECT COUNT(*) FROM responsaveis_compras WHERE id_responsavel = "' . $_SESSION['user']['id'] . '"')->fetchColumn() <= 0) {
        header("location: ../404.php");
    }
} 
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisições Compras</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <!-- Theme style -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/jquery-ui.min.js">
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
                            <div class="card card-outline card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Requisições</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-requi-admin" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Número Requisição</th>
                                                <th>Nome do requerente</th>
                                                <th>Data de desejo dos materiais</th>
                                                <th>Área de compras associada</th>
                                                <th>Setor de compra associado</th>
                                                <th>Decisão acerca Requisição</th>
                                                <th>Data da Requisição</th>
                                                <th>Atividade:</th>
                                                <th>Disciplina:</th>
                                                <th>Módulo:</th>
                                                <th>Turma:</th>
                                                <th>Data de decisão:</th>
                                                <th>Nome de devolvedor:</th>
                                                <th>Data de entrega material:</th>
                                                <th>Ano-Letivo correspondente:</th>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Bootstrap 4 -->
    <script src="//cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- AdminLTE App -->
    <script src="//cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>

    <!-- Datatables -->
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

    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(function() {
            alertify.set('notifier', 'position', 'top-right');

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
                    [0, "desc"]
                ],
                "columnDefs": [{
                    targets: [0, 1, 2, 3, 4, 5],
                    className: 'text-center'
                }],
                "ajax": {
                    url: "../api/api.php",
                    type: "POST",
                    data: {
                        action: "showReqAdminBuy",
                        userId: "<?php echo $_SESSION['user']['id'] ?>"
                    }
                },
                "rowCallback": function(row, data, index) {
                    if (data['id_decisao'] == 3) {
                        $(row).find('td:eq(5)').css('background-color', 'yellow');
                    } else if (data['id_decisao'] == 1) {
                        $(row).find('td:eq(5)').css('background-color', 'green');
                        $(row).find('td:eq(5)').css('color', 'white');
                    } else {
                        $(row).find('td:eq(5)').css('background-color', 'red');
                        $(row).find('td:eq(5)').css('color', 'white');
                    }

                },
                "columns": [{
                        "data": "id"
                    }, {
                        "data": "nome_user"
                    }, {
                        "data": "data_requerido"
                    }, {
                        "data": "descricao_area_compra"
                    }, {
                        "data": "descricao_setor_compra"
                    }, {
                        "data": "descricao_decisao_req"
                    }, {
                        "data": "data_requisicao"
                    }, {
                        "data": "atividade",
                        "className": "none"
                    }, {
                        "data": "disciplina",
                        "className": "none"

                    }, {
                        "data": "modulo",
                        "className": "none"
                    },
                    {
                        "data": "turma",
                        "className": "none"
                    },
                    {
                        "data": "data_decisao",
                        "className": "none"
                    }, {
                        "data": "id_devolvedor",
                        "className": "none"
                    }, {
                        "data": "data_devolver",
                        "className": "none"
                    }, {
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
                        tableR.button(5).disable();
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
                    text: '<i class="fas fa-file-download"></i>',
                    titleAttr: 'Baixar Requisição',
                    action: function(e, dt, node, config) {
                        $.post("../api/api.php", {
                                "action": "downFile",
                                "fileId": tableR.rows({
                                    selected: true
                                }).data()[0].id,
                            },
                            function(data) {
                                if (data.status == 1) {
                                    e.preventDefault();
                                    window.location.href = data.filePath;
                                    alertify.notify(data.message, 'success', 5);
                                    tableR.ajax.reload(null, false);
                                } else alertify.notify(data.message, 'error', 5);
                                tableR.row({
                                    selected: true
                                }).deselect();
                                tableR.button(3).disable();
                                tableR.button(4).disable();
                                tableR.button(5).disable();
                            }, 'json'
                        );
                    },
                    enabled: false
                }, {
                    text: '<i class="fas fa-save"></i>',
                    titleAttr: 'Salvar Requisição',
                    action: function(e, dt, node, config) {
                        $.post("../api/api.php", {
                                "action": "reSaveFile",
                                "fileId": tableR.rows({
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
                                tableR.button(3).disable();
                                tableR.button(4).disable();
                                tableR.button(5).disable();
                            }, 'json'
                        );
                    },
                    enabled: false
                }, {
                    text: '<i class="fas fa-check"></i>',
                    titleAttr: 'Finalizar Requisição',
                    action: function(e, dt, node, config) {
                        alertify.confirm('Requisições ESCO', 'Deseja mesmo finalizar esta requisição?', function() {
                            $.post("../api/api.php", {
                                    action: 'finishReqBuy',
                                    reqId: tableR.rows({
                                        selected: true
                                    }).data()[0].id,
                                    deciId: tableR.rows({
                                        selected: true
                                    }).data()[0].id_decisao,
                                    userName: '<?php echo $_SESSION['user']['nome'] ?>'
                                },
                                function(data) {
                                    if (data.status == 1) {
                                        alertify.notify(data.message, 'success', 5);
                                        tableR.ajax.reload(null, false);
                                    } else alertify.notify(data.message, 'error', 5);
                                    tableR.row({
                                        selected: true
                                    }).deselect();
                                    tableR.button(3).disable();
                                    tableR.button(4).disable();
                                    tableR.button(5).disable();
                                }, 'json'
                            );
                        }, function() {
                            tableR.row({
                                selected: true
                            }).deselect();
                            tableR.button(3).disable();
                            tableR.button(4).disable();
                            tableR.button(5).disable();
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
                tableR.button(4).enable(selectedRows === 1);
                tableR.button(5).enable(selectedRows === 1);
            });

        });
    </script>

</body>

</html>