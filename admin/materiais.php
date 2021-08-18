<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
} else {
    include_once('../api/bd.php');
    if ($rA = $connect->query('SELECT COUNT(*) FROM responsaveis_area WHERE id_responsavel_area = "' . $_SESSION['user']['id'] . '"')->fetchColumn() <= 0) {
        header("location: ../404.php");
    }
}
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisições Materiais</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel=" stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

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
                                    <table id="table-requi-admin" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Número da Requisição</th>
                                                <th>Número do Requisitante</th>
                                                <th>Nome do Requisitante</th>
                                                <th>Turma do Requisitante</th>
                                                <th>Material Requisitado</th>
                                                <th>Código do Material</th>
                                                <th>Data da Requisição</th>
                                                <th>Estado da Requisição</th>
                                                <th>Ano-Letivo da Requisição</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="card card-outline card-dark" id="mat-card">
                                <div class="card-header">
                                    <h3 class="card-title">Materiais</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-mat-admin" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Código Próprio do Material</th>
                                                <th>Tipo de Material</th>
                                                <th>Estado do Material</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="card card-outline card-dark" id="typeMat-card">
                                <div class="card-header">
                                    <h3 class="card-title">Tipo de Materiais</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-mattype-admin" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Designação</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class=" card card-outline card-dark" id="mat-status">
                                <div class="card-header">
                                    <h3 class="card-title">Estatisticas</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div id="divGraph" style="margin: 0 auto;">
                                        </div>
                                    </div>
                                    <form id="status-form">
                                        <input type="hidden" name="action" value="makeStats">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="aM">Área do Material</label>
                                                <select id="aM" name="aM" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dataStart">Data Inicial</label>
                                                <input type="date" name="dataStart" id="dataStart" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="dataEnd">Data Final</label>
                                                <input type="date" name="dataEnd" id="dataEnd" class="form-control" required>
                                            </div>
                                        </div>
                                        <input type="submit" value="Pesquisar" class="btn btn-secondary">
                                    </form>
                                </div>
                            </div>
                            <div class="card card-outline card-dark" id="newMat-card">
                                <div class="card-header">
                                    <h3 class="card-title">Inserir novo material</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form id="mat-form">
                                        <input type="hidden" name="action" value="addMat">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sM">Área do Material</label>
                                                <select id="sM" name="sM" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required></select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tM2">Tipo de Material</label>
                                                <select id="tM2" name="tM2" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required></select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="input_mat_quant">Quantidade do material</label>
                                                <input type="number" class="form-control" id="input_mat_quant" name="input_mat_quant" value="1" min="1" max="50" required>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-secondary" value="Inserir">
                                    </form>
                                </div>
                            </div>
                            <div class=" card card-outline card-dark" id="newTypeMat-card">
                                <div class="card-header">
                                    <h3 class="card-title">Inserir novo Tipo de Material</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="" id="mat-type-form" method="POST">
                                        <input type="hidden" name="action" value="addTypeMat">
                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['user']['id'] ?>">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="tM">Área do material</label>
                                                <select id="tM" name="tM" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required></select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="input_mat_name">Nome do Material</label>
                                                <input type="text" class="form-control" id="input_mat_name" name="input_mat_name" required>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-secondary" value="Inserir">
                                    </form>
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
                                        <input type="hidden" name="action" value="addReqMatAdmin">
                                        <input type="hidden" name="date" id="date">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="input_user_id">ID do requisitante</label>
                                                <input type="text" class="form-control" id="input_user_id" name="input_user_id" placeholder="Ex: a2776" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sort">Área do Material</label>
                                                <select id="sort" name="sort" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mT">Tipo de Material</label>
                                                <select id="mT" name="mT" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div id='calendar'>
                                            </div>
                                        </div>
                                        <br>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt.min.js" integrity="sha512-4xyW5eQdikpmmms6saOpjcY1VSRigZZNso0a3BlDElGqjGYVyQqSZbxBvNGAWRoIKL7BEWIhyroNtUQNvPnNFg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    <script src="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Alerts -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(function() {
            loadTableInfo();
            loadConfigs();

            $("#mat-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                            $('#input_mat_quant').val(1)
                        } else alertify.notify(res.message, 'error', 5);

                        $("form")[0].reset();
                        $('#sM').selectpicker('render');
                        $('#tM2').selectpicker('render');

                    }, 'json'
                );
            });

            $("#mat-type-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                            $('#input_mat_name').val("")
                        } else alertify.notify(res.message, 'error', 5);

                        $("form")[0].reset();
                        $('#tM').selectpicker('render');
                    }, 'json'
                );
            });


            $("#requi-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                            $('#input_user_id').val("")
                        } else alertify.notify(res.message, 'error', 5);

                        $("form")[0].reset();
                        $('#mT').selectpicker('render');
                        $('#sort').selectpicker('render');
                    }, 'json'
                );
            });


            $("#status-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(data) {
                        $('#divGraph').html(data);
                        $('#graph').Chart = new Chart($('#graph'), $('#graph').data('settings'));
                        $("#dataStart").val("");
                        $("#dataEnd").val("");
                        $('#aM').selectpicker('render');
                    }
                );
            });


            var change = $('#sort').on('change', function() {

                $('#mT').find('option').remove().end();

                $.post("../api/api.php", {
                        "action": "showItensPerCategory",
                        "id_categoria": $(this).val()
                    },
                    function(data) {
                        var html = "";
                        if (data.length !== 0) {
                            $('#mT').prop('disabled', false);

                            $.each(data, function(key, value) {
                                html += "<option value = '" + value.id + "' >" + value.descricao_materiais + "</option>";
                            });
                        }

                        $("#mT").append(html);
                        $('#mT').selectpicker('refresh');
                    }, "json"
                );
            });


            var change2 = $('#sM').on('change', function() {

                $('#tM2').find('option').remove().end();

                $.post("../api/api.php", {
                        "action": "showItensPerCategory",
                        "id_categoria": $(this).val()
                    },
                    function(data) {
                        var html = "";
                        if (data.length !== 0) {
                            $.each(data, function(key, value) {
                                html += "<option value = '" + value.id + "' >" + value.descricao_materiais + "</option>";
                            });
                        }

                        $("#tM2").append(html);
                        $('#tM2').selectpicker('refresh');
                    }, "json"
                );
            });

            var change3 = $('#mT').on('change', function() {
                $.post("../api/api.php", {
                        "action": "loadFullCalendar",
                        "typeMatId": $(this).val()
                    },
                    function(data) {
                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar('addEventSource', data);
                        $('#calendar').fullCalendar('rerenderEvents');
                    }, 'json'
                );
            });


            function loadConfigs() {
                alertify.set('notifier', 'position', 'top-right');

                $('#mat-card').CardWidget('toggle')
                $('#typeMat-card').CardWidget('toggle')
                $('#newMat-card').CardWidget('toggle')
                $('#mat-status').CardWidget('toggle')
                $('#newTypeMat-card').CardWidget('toggle')


                var now = new Date();

                $('#calendar').fullCalendar({
                    locale: 'pt',
                    height: 500,
                    editable: true,
                    selectable: true,
                    selectHelper: true,
                    validRange: {
                        start: now.getFullYear() + "-" + (("0" + (now.getMonth() + 1)).slice(-2)) + "-" + (("0" + now.getDate()).slice(-2))
                    },
                    select: function(start, end, jsEvent, view) {
                        $(".fc-highlight").css("background", "blue");
                        $('#date').val(moment(start).format())
                    }
                });

                // Carregar as opções na dropdown
                $.post("../api/api.php", {
                        "action": "showAreaResp",
                        "userId": "<?php echo $_SESSION['user']['id'] ?>"
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_categoria + "</option>";
                        });

                        $("#sort").append(html);
                        $("#aM").append(html);
                        $("#tM").append(html);
                        $("#sM").append(html);


                        $('#sort').selectpicker('refresh');
                        $('#aM').selectpicker('refresh');
                        $('#tM').selectpicker('refresh');
                        $('#sM').selectpicker('refresh');
                    }, "json"
                );
            }

            function loadTableInfo() {
                var tableR = $('#table-requi-admin').DataTable({
                    "dom": 'Bfrtip',
                    "processing": false,
                    "serverSide": true,
                    "responsive": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "select": true,
                    "order": [
                        [0, "desc"],
                    ],
                    "columnDefs": [{
                        targets: [-1, -2, -3, -4, -5, -6, -7, -8, -9],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showRequiAdminMat",
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
                        "data": "descricao_materiais"
                    }, {
                        "data": "id_proprio"
                    }, {
                        "data": "data"
                    }, {
                        "data": "descricao_estado"
                    }, {
                        "data": "descricao_ano_letivo"
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
                        text: '<i class="fas fa-check"></i>',
                        titleAttr: 'Finalizar Requisição',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo finalizar esta requisição?', function() {
                                $.post("../api/api.php", {
                                        "action": "finishReqMat",
                                        "reqId": tableR.rows({
                                            selected: true
                                        }).data()[0].id,
                                        "matId": tableR.rows({
                                            selected: true
                                        }).data()[0].id_material,
                                        "matTyId": tableR.rows({
                                            selected: true
                                        }).data()[0].id_tipo
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


                var tableM = $('#table-mat-admin').DataTable({
                    "dom": "Bfrtip",
                    "processing": false,
                    "serverSide": true,
                    "responsive": true,
                    "select": true,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [1, "asc"]
                    ],
                    "columnDefs": [{
                        targets: [-1, -2, -3],
                        className: 'text-center'
                    }, {
                        targets: -3,
                        width: "10%"
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showMatAdminMat",
                            userId: "<?php echo $_SESSION['user']['id'] ?>"
                        }
                    },
                    "columns": [{
                        "data": "id_proprio"
                    }, {
                        "data": "descricao_materiais"
                    }, {
                        "data": "descricao"
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
                                    .setContent("<span>Estado do Material: </span><select style='width: 50%'><option value='1'>Disponível</option><option value='3'>Avariado</option></select>")
                                    .set('onok', function(closeEvent) {
                                        $.post("../api/api.php", {
                                                "action": "changeStatusMat",
                                                "matId": tableM.rows({
                                                    selected: true
                                                }).data()[0].id,
                                                "statusId": this.elements.content.querySelector('select').value,
                                                "matTyId": tableM.rows({
                                                    selected: true
                                                }).data()[0].id_tipo
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
                                alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar este material?', function() {
                                    $.post("../api/api.php", {
                                            "action": "deleteMat",
                                            "matId": tableM.rows({
                                                selected: true
                                            }).data()[0].id,
                                            "matTyId": tableM.rows({
                                                selected: true
                                            }).data()[0].id_tipo
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

                var tableMT = $('#table-mattype-admin').DataTable({
                    "dom": "Bfrtip",
                    "processing": false,
                    "serverSide": true,
                    "responsive": true,
                    "select": true,
                    "searching": false,
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                    },
                    "order": [
                        [0, "asc"]
                    ],
                    "columnDefs": [{
                        targets: [0],
                        className: 'text-center'
                    }],
                    "ajax": {
                        url: "../api/api.php",
                        type: "POST",
                        data: {
                            action: "showMatTypeAdminMat",
                            userId: "<?php echo $_SESSION['user']['id'] ?>"
                        }
                    },
                    "columns": [{
                        "data": "descricao_materiais"
                    }],
                    "buttons": [{
                        text: '<i class="fas fa-sync"></i>',
                        titleAttr: 'Atualizar Tabela',
                        action: function(e, dt, node, config) {
                            tableMT.ajax.reload(null, false);
                            tableMT.button(3).disable();
                            tableMT.button(4).disable();
                            tableMT.button(5).disable();
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
                            alertify.prompt('Requisições ESCO', 'Denominação do Material', tableMT.rows({
                                selected: true
                            }).data()[0].descricao_materiais, function(evt, value) {
                                $.post("../api/api.php", {
                                        "action": "editTypeName",
                                        "typeId": tableMT.rows({
                                            selected: true
                                        }).data()[0].id,
                                        "newName": value
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableMT.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableMT.row({
                                            selected: true
                                        }).deselect();
                                        alertify.prompt().destroy();
                                    }, 'json'
                                );
                            }, function() {
                                tableMT.row({
                                    selected: true
                                }).deselect();
                                tableMT.button(3).disable();
                                tableMT.button(4).disable();
                                tableMT.button(5).disable();
                                alertify.prompt().destroy();
                            });
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-box"></i>',
                        titleAttr: 'Ver stock',
                        action: function(e, dt, node, config) {
                            $.post("../api/api.php", {
                                    "action": "getStockMat",
                                    "typeId": tableMT.rows({
                                        selected: true
                                    }).data()[0].id,

                                },
                                function(data) {
                                    if (data.status == 1) {
                                        alertify.notify(data.message, 'success', 5);
                                    } else alertify.notify(data.message, 'error', 5);
                                    tableMT.row({
                                        selected: true
                                    }).deselect();
                                }, 'json'
                            );
                        },
                        enabled: false
                    }, {
                        text: '<i class="fas fa-trash-alt"></i>',
                        titleAttr: 'Eliminar tipo de material',
                        action: function(e, dt, node, config) {
                            alertify.confirm('Requisições ESCO', 'Deseja mesmo eliminar este tipo de material?', function() {
                                $.post("../api/api.php", {
                                        "action": "deletMatType",
                                        "matTyId": tableMT.rows({
                                            selected: true
                                        }).data()[0].id
                                    },
                                    function(data) {
                                        if (data.status == 1) {
                                            alertify.notify(data.message, 'success', 5);
                                            tableMT.ajax.reload(null, false);
                                        } else alertify.notify(data.message, 'error', 5);
                                        tableMT.row({
                                            selected: true
                                        }).deselect();
                                    }, 'json'
                                );
                            }, function() {
                                tableMT.row({
                                    selected: true
                                }).deselect();
                                tableMT.button(3).disable();
                                tableMT.button(4).disable();
                                tableMT.button(5).disable();
                            }).set('labels', {
                                ok: 'Sim',
                                cancel: 'Cancelar'
                            });
                        },
                        enabled: false
                    }]
                });

                tableMT.on('select deselect', function() {
                    var selectedRows = tableMT.rows({
                        selected: true
                    }).count();

                    tableMT.button(3).enable(selectedRows === 1);
                    tableMT.button(4).enable(selectedRows === 1);
                    tableMT.button(5).enable(selectedRows === 1);
                });
            }
        });
    </script>

</body>

</html>