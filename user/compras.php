<?php session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
} /* elseif (preg_match('~[0-9]+~', $_SESSION['user']['id'])) {
    header("location: ../404.php");
} */
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Requisição Compras</title>

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
                                    <h3 class="card-title">As suas Requisições</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="table-req" class="table table-bordered table-striped" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Número Requisição</th>
                                                <th>Data Requerido</th>
                                                <th>Data Requisição</th>
                                                <th>Decisão da Requisição</th>
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
                                    <form action="" id="requi-form">
                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['user']['id'] ?>">
                                        <input type="hidden" name="action" value="addReqBuy">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dis">Disciplina</label>
                                                <input type="text" class="form-control" name="dis" id="dis">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="ati">Atividade</label>
                                                <input type="text" class="form-control" name="ati" id="ati">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-2">
                                                <label for="nMod">Número Módulo</label>
                                                <input type="number" name="nMod" class="form-control" min="1" id="nMod" required>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="mod">Módulo</label>
                                                <input type="text" name="mod" class="form-control" id="mod" required>
                                            </div>
                                            <div class="form-group col-md-5">
                                                <label for="class">Turma</label>
                                                <input type="text" name="class" class="form-control" id="class" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="aC">Área de compras</label>
                                                <select id="aC" name="aC" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-size="5" data-width="100%" required>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="sC">Setores de compra</label>
                                                <select id="sC" name="sC" title="Nada Selecionado" class="selectpicker border rounded" data-live-search="true" data-size="5" data-width="100%" required>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="oioi">
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="prod_name">Nome Produto</label>
                                                    <input class="form-control" type="text" name="name[]" id="prod_name" required />
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="prod_quant">Quantidade necessária</label>
                                                    <input class="form-control" type="number" min="1" value="1" name="quant[]" id="prod_quant" required />
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="prod_obser">Observações/Nome Fornecedor</label>
                                                    <input class="form-control" type="text" name="obser[]" id="prod_obser" />
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <button id="btt-add" type="button" class="btn btn-success" style="margin-top: 32px;"><i class="fas fa-plus"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
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

    <script src="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Alerts -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <script>
        $(function() {
            alertify.set('notifier', 'position', 'top-right');

            loadConfigs()
            loadDate()

            var tableR = $('#table-req').DataTable({
                dom: 'Bfrtip',
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
                "columnDefs": [],
                "ajax": {
                    url: "../api/api.php",
                    type: "POST",
                    data: {
                        action: "showReqUserBuy",
                        userId: "<?php echo $_SESSION['user']['id'] ?>"
                    }
                },
                "rowCallback": function(row, data, index) {
                    if (data['id_decisao'] == 3) {
                        $(row).find('td:eq(3)').css('background-color', 'yellow');
                    } else if (data['id_decisao'] == 1) {
                        $(row).find('td:eq(3)').css('background-color', 'green');
                        $(row).find('td:eq(3)').css('color', 'white');
                    } else {
                        $(row).find('td:eq(3)').css('background-color', 'red');
                        $(row).find('td:eq(3)').css('color', 'white');
                    }

                },
                "columns": [{
                    "data": "id"
                }, {
                    "data": "data_requerido"
                }, {
                    "data": "data_requisicao"
                }, {
                    "data": "descricao_decisao_req"
                }, {
                    "data": "descricao_ano_letivo"
                }],
                buttons: [{
                    text: '<i class="fas fa-sync"></i>',
                    titleAttr: 'Atualizar Tabela',
                    action: function(e, dt, node, config) {
                        tableR.ajax.reload(null, false);
                        tableR.button(1).disable();
                    }
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
                                tableR.button(1).disable();
                            }, 'json'
                        );
                    },
                    enabled: false
                }]
            });

            tableR.on('select deselect', function() {
                var selectedRows = tableR.rows({
                    selected: true
                }).count();

                tableR.button(1).enable(selectedRows === 1);
            });

            $("#requi-form").on("submit", function(e) {
                e.preventDefault();

                if ($('#dis').val().length === 0 && $('#ati').val().length === 0) {
                    alertify.notify('Deve preencher a Disciplina ou a Atividade', 'error', 5);
                }else if ($('#dis').val().length !== 0 && $('#ati').val().length !== 0){
                    alertify.notify('Deve preencher a Disciplina ou a Atividade', 'error', 5);
                }
                else {
                    $.post("../api/api.php", $(this).serialize(),
                        function(data) {
                            if (data.status == '1') {
                                $("form")[0].reset();
                                $('#aC').selectpicker('render');
                                $('#sC').selectpicker('render');

                                loadDate()

                                alertify.notify(data.message, 'success', 5);

                                $.post("../api/api.php", {
                                        action: 'sendEmailBuy',
                                        fileNumber: data.fileNumber,
                                        userName: data.userName,
                                        dateRequi: data.dateRequi,
                                        date: data.date,
                                        areaBuy: data.areaBuy
                                    },
                                    function(data) {
                                        if (data !== '1') {
                                            alertify.notify(data, 'error', 5);
                                        }
                                    }
                                );
                            } else alertify.notify(data.message, 'error', 5);
                        }, 'json'
                    );
                }
            });

            $('#dis').on('input', function(e) {
                if ($(this).val()) {
                    $("#nMod").prop('required', true);
                    $("#nMod").prop('disabled', false);

                    $("#mod").prop('disabled', false);
                    $("#mod").prop('required', true);
                } else {
                    $("#mod").prop('disabled', true);
                    $("#mod").prop('required', false);
                    $('#mod').val('');

                    $("#nMod").prop('required', false);
                    $("#nMod").prop('disabled', true);
                    $('#nMod').val('');
                }
            });

            $("#aC").change(function() {

                $('#sC').find('option').remove().end();

                $.post("../api/api.php", {
                        "action": "showBuySetor",
                        "id_area_compra": $(this).val()
                    },
                    function(data) {
                        var html = "";
                        if (data.length !== 0) {
                            $.each(data, function(key, value) {
                                html += "<option value = '" + value.id + "' >" + value.descricao_setor_compra + "</option>";
                            });
                        }

                        $("#sC").append(html);
                        $('#sC').selectpicker('refresh');
                    }, "json"
                );
            });

            var i = 1;

            $('#btt-add').click(function() {
                i++;
                $('#oioi').append('<div class="form-row" id="div' + i + '"><div class="form-group col-md-3"><label for="prod_name">Nome Produto</label><input class="form-control" type="text" name="name[]" id="prod_name" required/></div><div class="form-group col-md-3"><label for="prod_quant">Quantidade necessária</label><input class="form-control" type="number" min="1" value="1" name="quant[]" id="prod_quant" required/></div><div class="form-group col-md-3"><label for="prod_obser">Observações/Nome Fornecedor</label><input class="form-control" type="text" name="obser[]" id="prod_obser"/></div><div class="form-group col-md-3"><button id="' + i + '"  type="button" class="btn btn-danger btt-delete" style="margin-top: 32px;"><i class="fas fa-ban"></i></button></div></div>');
            });

            $(document).on("click", ".btt-delete", function() {
                var id = $(this).attr('id');
                $('#div' + id).remove();
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

            function loadConfigs() {

                $("#mod").prop('disabled', true);
                $("#nMod").prop('disabled', true);

                $.post("../api/api.php", {
                        "action": "showBuyArea",
                    },
                    function(data) {
                        var html = "";
                        if (data.length !== 0) {
                            $.each(data, function(key, value) {
                                html += "<option value = '" + value.id + "' >" + value.descricao_area_compra + "</option>";
                            });
                        }

                        $("#aC").append(html);
                        $('#aC').selectpicker('refresh');
                    }, "json"
                );
            }

        });
    </script>

</body>

</html>