<?php session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisição Materiais</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/jquery-ui.min.js">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href="//cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css" rel="stylesheet" />

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
                                    <h3 class="card-title">As suas Requisições</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-requi" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Material Requisitado</th>
                                                <th>Área do Material Requisitado</th>
                                                <th>Data da Requisição</th>
                                                <th>Estado da Requisição</th>
                                                <th>Ano-Letivo da Requisição</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="card card-outline card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Nova Requisição</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="" id="requi-form" method="POST">
                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['user']['id'] ?>">
                                        <input type="hidden" name="action" value="addReqMat">
                                        <input type="hidden" name="date" id="date">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sort">Área do Material</label>
                                                <select id="sort" name="sort" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tM">Tipo de Material</label>
                                                <select id="tM" name="tM" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div id='calendar'>
                                            </div>
                                        </div>
                                        <br>
                                        <input type="submit" class="btn btn-secondary" value="Concluir">
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

    <!-- DataTables -->
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script src="//cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <script src="//cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>

    <script src="//cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script src="//cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Alerts -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

    <script src="//smtpjs.com/v3/smtp.js"></script>

    <script>
        $(function() {
            setFormInfo();

            alertify.set('notifier', 'position', 'top-right');

            var table = $('#table-requi').DataTable({
                "dom": 'frtip',
                "processing": true,
                "serverSide": true,
                "fixedHeader": true,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                },
                "order": [
                    [3, "desc"]
                ],
                "ajax": {
                    url: "../api/api.php",
                    type: "POST",
                    data: {
                        action: "showRequiUser",
                        userId: "<?php echo $_SESSION['user']['id'] ?>"
                    }
                },
                "columns": [{
                    "data": "descricao_materiais"
                }, {
                    "data": "descricao_categoria"
                }, {
                    "data": "data"
                }, {
                    "data": "descricao_estado"
                }, {
                    "data": "descricao_ano_letivo"
                }]
            });


            // Detetar quando o select muda para esconder ou aparecer componentes
            var change = $('#sort').on('change', function() {

                $('#tM').find('option').remove().end();

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
                        $("#tM").append(html);
                        $('#tM').selectpicker('refresh');
                    }, "json"
                );
            });

            var change2 = $('#tM').on('change', function() {
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


            $("#requi-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                            table.ajax.reload(null, false);

                            $("form")[0].reset();
                            $('#sort').selectpicker('render');
                            $('#tM').selectpicker('render');

                            $.post("../api/api.php", {
                                    action: 'sendEmailMat',
                                    userId: res.userId,
                                    tM: res.tM,
                                    info_id: res.info_id,
                                    date: res.date
                                },
                                function(res) {
                                    if (res != '1') {
                                        alertify.notify(res, 'error', 5);
                                    }
                                }
                            );
                        } else alertify.notify(res.message, 'error', 5);
                    }, 'json'
                );
            });

            function setFormInfo() {

                // Preencher campos com os dados do usuário
                $('#input_user_name').attr('placeholder', "<?php echo $_SESSION['user']['nome'] ?>");
                $('#input_user_class').attr('placeholder', "<?php echo $_SESSION['user']['descricao_turma'] ?>");
                $('#input_user_email').attr('placeholder', "<?php echo $_SESSION['user']['email'] ?>");
                $('#input_user_number').attr('placeholder', "<?php echo $_SESSION['user']['id'] ?>");

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
                        "action": "showCategory",
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_categoria + "</option>";
                        });
                        $("#sort").append(html);
                        $('#sort').selectpicker('refresh');
                    }, "json"
                );
            }
        });
    </script>

</body>

</html>