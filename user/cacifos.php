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
    <title>Requisição Cacifos</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
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
                                    <h3 class="card-title">Seus Cacifos</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-cacifo" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Número do Cacifo</th>
                                                <th>Piso do Cacifo</th>
                                                <th>Parceiro do Cacifo</th>
                                                <th>Data da Requisição</th>
                                                <th>Estado liquidação da Requisição</th>
                                                <th>Estado da Requisição</th>
                                                <th>Ano-Letivo da Requisição</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="card card-outline card-dark">
                                <div class="card-header">
                                    <h3 class="card-title">Novo Cacifo</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="" id="requi-form">
                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['user']['id'] ?>">
                                        <input type="hidden" name="action" value="addReqCaci">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sort">Piso do Cacifo</label>
                                                <select id="sort" name="sort" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-width="100%" required>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nC">Número do Cacifo</label>
                                                <select id="nC" title="Nada Selecionado" name="nC" class="selectpicker border rounded" data-live-search="true" data-size="5" data-width="100%" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pC">Parceiro de Cacifo</label>
                                                <select id="pC" name="pC" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-size="5" data-width="100%" required>
                                                    <option value="0">Nenhum</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="text_date">Data de Requisição</label>
                                                <input id="date" name="date" type="text" class="form-control" required>
                                            </div>
                                        </div>
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
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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


    <script>
        $(function() {
            setFormInfo();
            loadDate();

            alertify.set('notifier', 'position', 'top-right');

            var table = $('#table-cacifo').DataTable({
                "dom": 'frtip',
                "processing": true,
                "serverSide": true,
                "fixedHeader": true,
                "responsive": true,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json"
                },
                "order": [
                    [4, "asc"]
                ],
                "columnDefs": [{
                    targets: [0, 1, 2, 3, 4, 5],
                    className: 'text-center'
                }],
                "ajax": {
                    url: "../api/api.php",
                    type: "POST",
                    data: {
                        action: "showCaciUser",
                        userId: "<?php echo $_SESSION['user']['id'] ?>"
                    }
                },
                "columns": [{
                    "data": "id_proprio"
                }, {
                    "data": "descricao_cacifo_piso"
                }, {
                    "data": "id_parceiro"
                }, {
                    "data": "data"
                }, {
                    "data": "descricao_estado_req_cacifos"
                }, {
                    "data": "descricao_estado_req_cacifos_"
                }, {
                    "data": "descricao_ano_letivo"
                }]
            });

            // Detetar quando o select muda para esconder ou aparecer componentes
            $('#sort').change(function() {

                $('#nC').find('option').remove().end();

                $.post("../api/api.php", {
                        "action": "showCaciPerFloor",
                        "id_piso": $(this).val()
                    },
                    function(data) {
                        var html = "";
                        if (data.length !== 0) {
                            $.each(data, function(key, value) {
                                html += "<option value = '" + value.id + "' >" + value.id_proprio + "</option>";
                            });
                        }

                        $("#nC").append(html);
                        $('#nC').selectpicker('refresh');
                    }, "json"
                );
            });

            $("#requi-form").on("submit", function(e) {
                e.preventDefault();

                $.post("../api/api.php", $(this).serialize(),
                    function(res) {
                        if (res.status == '1') {
                            alertify.notify(res.message, 'success', 5);
                            table.ajax.reload(null, false);
                            $.post("../api/api.php", {
                                    action: 'sendEmailCaci',
                                    userId: res.userId,
                                    pC: res.pC,
                                    nC: res.nC,
                                    date: res.date
                                },
                                function(res) {
                                    if (res != '1') {
                                        alertify.notify(res, 'error', 5);
                                    }
                                }
                            );
                        } else alertify.notify(res.message, 'error', 5);

                        $("form")[0].reset();
                        $('#sort').selectpicker('render');
                        $('#nC').selectpicker('render');
                        $('#pC').selectpicker('render');
                      
                        loadDate();
                    }, 'json'
                );
            });


            function loadDate() {
                var now = new Date();
                $('#date').val(now.getFullYear() + "-" + (("0" + (now.getMonth() + 1)).slice(-2)) + "-" + (("0" + now.getDate()).slice(-2)));

                $("#date").datepicker({
                    minDate: 0,
                    beforeShowDay: $.datepicker.noWeekends,
                    dateFormat: 'yy-mm-dd',
                    dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
                    dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
                })
            }


            function setFormInfo() {

                // Preencher campos com os dados do usuário
                $('#input_user_name').attr('placeholder', "<?php echo $_SESSION['user']['nome'] ?>");
                $('#input_user_class').attr('placeholder', "<?php echo $_SESSION['user']['descricao_turma'] ?>");
                $('#input_user_email').attr('placeholder', "<?php echo $_SESSION['user']['email'] ?>");
                $('#input_user_number').attr('placeholder', "<?php echo $_SESSION['user']['id'] ?>");

                var now = new Date();
                $('#date').val(now.getFullYear() + "-" + (("0" + (now.getMonth() + 1)).slice(-2)) + "-" + (("0" + now.getDate()).slice(-2)));

                $("#date").datepicker({
                    minDate: 0,
                    beforeShowDay: $.datepicker.noWeekends,
                    dateFormat: 'yy-mm-dd',
                    dayNames: ["Domingo", "Segunda", "Terça", "Quarte", "Quinta", "Sexta", "Sábado"],
                    dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sab"],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro']
                })

                // Carregar as opções na dropdown
                $.post("../api/api.php", {
                        "action": "showFloorOptions",
                        "userDepart": "<?php echo $_SESSION['user']['descricao_turma'] ?>"
                    },
                    function(data) {
                        var html = "";

                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.descricao_cacifo_piso + "</option>";
                        });
                        $("#sort").append(html);
                        $('#sort').selectpicker('refresh');
                    }, 'json'
                );

                $.post("../api/api.php", {
                        "action": "showMateCaci",
                        "userId": "<?php echo $_SESSION['user']['id'] ?>"
                    },
                    function(data) {
                        var html = "";
                        $.each(data, function(key, value) {
                            html += "<option value = '" + value.id + "' >" + value.id + " - " + value.nome_user + "</option>";
                        });

                        $("#pC").append(html);
                        $('#pC').selectpicker('refresh');
                    }, "json"
                );

                $('#nC').find('option').remove().end();

            }
        });
    </script>

</body>

</html>