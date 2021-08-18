<?php session_start();
if (!isset($_SESSION['user'])) {
    header("location: ../index.php");
}

include '../api/bd.php';

$rA = $rC = $respS = $respC = 0;

$rA = $connect->query('SELECT COUNT(*) FROM responsaveis_area WHERE id_responsavel_area = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
$rC = $connect->query('SELECT COUNT(*) FROM responsaveis_cacifos WHERE id_responsavel = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
$respS = $connect->query('SELECT COUNT(*) FROM responsaveis_site WHERE id_responsavel_site = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
$respC = $connect->query('SELECT COUNT(*) FROM responsaveis_compras WHERE id_responsavel = "' . $_SESSION['user']['id'] . '"')->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manual de utilização</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <!-- Theme style -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/jquery-ui.min.js">
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
                            <div class="card card-outline card-dark" id="user-manual-card">
                                <div class="card-header">
                                    <h3 class="card-title">Utilizador</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <br>
                                    <div class="form-row">
                                        <h4 style="margin: 0 auto;"><b>Requisição de Materiais</b></h4>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <h6 style="padding-left: 25px;">As instruções abaixo demonstram como realizar uma requisição de materiais utilizando a página de Requisições de materiais.</h6>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <ol>
                                            <li>Deve <b>selecionar</b> a página de <b>Requisições de Materiais</b> localizado no canto superior esquerdo da página</li>
                                            <li><b>Preencher</b> o formulário localizado no <b>fundo da página</b> selecionando a <b>área do material</b> desejado, o <b>tipo de material</b> e por fim o <b>dia que deseja no calendário</b></li>
                                            <li>Quando tudo <b>devidamente preenchido</b> clicar no botão <b>Concluir</b></li>
                                        </ol>
                                        <h6 style="padding-left: 25px;"><b>Notas:</b> Deve ser feita com <b>24 horas</b> de antecedência</h6>
                                    </div>
                                    <hr>
                                    <br>
                                    <br>
                                    <div class="form-row">
                                        <h4 style="margin: 0 auto;"><b>Requisição de Cacifos</b></h4>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <h6 style="padding-left: 25px;">As instruções abaixo demonstram como realizar uma requisição de cacifos utilizando a página de Requisições de Cacifos.</h6>
                                    </div>
                                    <br>
                                    <div class="form-row">
                                        <ol>
                                            <li>Deve <b>selecionar</b> a página de <b>Requisições de Cacifos</b> localizado no canto superior esquerdo da página</li>
                                            <li><b>Preencher</b> o formulário localizado no <b>fundo da página</b> selecionando o <b>piso desejado</b>, o <b>número do cacifo</b>, o <b>parceiro</b> caso possua e a <b>data</b> da requisição</li>
                                            <li>Quando tudo <b>devidamente preenchido</b> clicar no botão <b>Concluir</b></li>
                                        </ol>
                                        <h6 style="padding-left: 25px;"><b>Notas:</b> Deve ser feita com <b>24 horas</b> de antecedência</h6>
                                    </div>
                                    <?php if (!preg_match('~[0-9]+~', $_SESSION['user']['id'])) : ?>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Requisição de Compra</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como realizar uma requisição de compra utilizando a página de Requisições de Compras.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Requisições de Compras</b> localizado no canto superior esquerdo da página</li>
                                                <li><b>Preencher</b> o formulário localizado no <b>fundo da página</b> selecionando o <b>a disciplina ou atividade</b>, o <b>modulo</b>, a <b>turma</b> área de compras associada, setor de compra os produtos desejados e a data de desejo dos produtos </li>
                                                <li>Quando tudo <b>devidamente preenchido</b> clicar no botão <b>Concluir</b></li>
                                            </ol>
                                            <h6 style="padding-left: 25px;"><b>Notas:</b> Deve ser feita com <b>15 dias</b> de antecedência</h6>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Baixar arquivo de requisição</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como baixar o arquivo correspondente a uma requisição utilizando a página de Requisições de compras.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Requisições de compras</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechada a <b>tabela de As suas Requisições</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Selecionar a linha correspondente à requisição que deseja</li>
                                                <li>Clicar no botão 📥 presente em cima da tabela ao pé das restantes opções</li>
                                            </ol>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php if ($rA > 0 || $rC > 0 || $respC > 0) : ?>
                                <div class="card card-outline card-dark" id="admin-manual-card">
                                    <div class="card-header">
                                        <h3 class="card-title">Administrador</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php if ($rA > 0) : ?>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Finalizar Requisição de Materiais</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como finalizar uma requisição de materiais utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Requisições</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente há requisição que deseja finalizar</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>✔️</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Alterar estado do material</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como alterar o estado de um material utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente ao material que deseja alterar o seu estado</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>🔧</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Selecionar</b> o estado desejado para o material</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                                <h6 style="padding-left: 25px;"><b>Notas:</b> O material não pode ter uma requisição ativa associada</h6>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Eliminar um Material</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar um material utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente ao material que deseja eliminar</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>🗑</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                                <h6 style="padding-left: 25px;"><b>Notas:</b> O material não pode ter uma requisição ativa associada</h6>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Alterar nome de material</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como alterar a nomenclatura de um material utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Tipo de Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente ao material que deseja alterar a designação</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>🔧</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Modificar</b> a designação do material desejado utilizando a <b>caixa de texto</b> apresentada</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Ver stock de um material</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como visualizar o stock de um material utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Tipo de Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente ao material que deseja ver o seu stock</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>📦</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Eliminar um tipo de Material</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar um tipo de material utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Tipo de Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente ao material que deseja ver o seu stock</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>🗑</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Estatisticas de Requisições de Materiais</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como visualizar as estatisticas das Requisições de Materiais no intervalo de tempo selecionado utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Estatisticas</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Preencher</b> o formulário apresentado selecionando a <b>área de materiais</b>, a <b>data de inicio</b> e a <b>data de fim</b></li>
                                                    <li>Quando tudo <b>devidamente preenchido</b> clicar no botão <b>Pesquisar</b></li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Inserir novo Material</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como inserir novos materiais utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Inserir novo Material</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Preencher</b> o formulário apresentado selecionando a <b>área de materiais</b>, o <b>tipo de material</b> e a <b>quantidade</b> desejada</li>
                                                    <li>Quando tudo <b>devidamente preenchido</b> clicar no botão <b>Inserir</b></li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Inserir novo tipo de Material</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como inserir novos tipos de materiais utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Inserir novo Tipo de Material</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Preencher</b> o formulário apresentado selecionando a <b>área do material</b>, e a <b>designação do mesmo</b></li>
                                                    <li>Quando tudo <b>devidamente preenchido</b> clicar no botão <b>Inserir</b></li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Requisição de Material na hora</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como realizar uma requisição de material na hora utilizando a página de Administração de Requisições de materiais.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Materiais</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Nova Requisição</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Preencher</b> o formulário apresentado selecionando o <b>id do requisitante</b> a <b>área do material</b>, o <b>material desejado</b> e a <b>data</b> da requisição</li>
                                                    <li>Quando tudo <b>devidamente preenchido</b> clicar no botão <b>Inserir</b></li>
                                                </ol>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($rA > 0 && $rC > 0) : ?>
                                            <hr>
                                            <br>
                                        <?php endif ?>
                                        <?php if ($rC > 0) : ?>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Liquidar Requisição de Cacifo</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como liquidar uma requisição de cacifo utilizando a página de Administração de Requisições de Cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Requisições</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar</b> a linha da tabela <b>correspondente há requisição</b> que deseja liquidar</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>€</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Finalizar Requisição de Cacifo</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como finalizar uma requisição de cacifo utilizando a página de Administração de Requisições de Cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Requisições</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar</b> a linha da tabela <b>correspondente há requisição</b> que deseja finalizar</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>✔️</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Selecionar</b> o estado de <b>devolução da caução</bSelecionar>
                                                    </li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                                <h6 style="padding-left: 25px;"><b>Notas:</b> Deve primeiro liquidar a requisição para que seja possível a sua finalização</h6>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Alterar estado de um Cacifo</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como alterar o eatdo de um cacifo utilizando a página de Administração de Requisições de Cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente ao cacifo que deseja alterar o seu estado</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>🔧</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Selecionar</b> o estado desejado para o material</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Eliminar um Cacifo</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar um cacifo utilizando a página de Administração de Requisições de cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente ao cacifo que deseja eliminar</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>🗑</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Inserir novos cacifos</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como inserir novos cacifos utilizando a página de Administração de Requisições de cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Inserir novo cacifo</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li>Preencher o formulário selecionado o piso que deseja e a quantidade de cacifos desejados</li>
                                                    <li>Quando tudo devidamente preenchido clicar no botão Inserir</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Adicionar turmas com acesso Piso 0</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como inserir novas turmas para terem acesso ao piso 0 utilizando a página de Administração de Requisições de cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Turmas com acesso Piso 0</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li>Clicar no botão ➕ presente em cima da tabela ao pé das restantes opções</li>
                                                    <li>Colocar a sigla na caixa de texto existente</li>
                                                    <li>Clicar no botão de OK</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Alterar sigla da Turma com acesso Piso 0</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como alterar a nomenclatura de uma turma com acesso ao piso 0 utilizando a página de Administração de Requisições de cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Turmas com acesso Piso 0</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li><b>Selecionar na tabela</b> a linha correspondente há turma que deseja alterar a designação</li>
                                                    <li><b>Após</b> selecionado a linha desejado <b>clicar</b> no icon <b>🔧</b> que se encontra <b>por cima da tabela</b> com as restantes opções disponíveis</li>
                                                    <li><b>Modificar</b> a designação da turma desejado utilizando a <b>caixa de texto</b> apresentada</li>
                                                    <li><b>Responder</b> há pergunta de verificação apresentada</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Remover turmas com acesso Piso 0</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como remover turmas para terem acesso ao piso 0 utilizando a página de Administração de Requisições de cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Turmas com acesso Piso 0</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                    <li>Responder há pergunta de confirmação</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Requisitar Cacifo na hora</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como realizar uma requisição de cacifo na hora utilizando a página de Administração de Requisições de cacifos.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de cacifos</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Nova Requisição</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li>Preencher o formulário colocando o Id do requisitante, o do parceiro caso possua, o piso desejado e a data da requisição</li>
                                                    <li>Quando tudo devidamente preenchido clicar no botão Inserir</li>
                                                </ol>
                                            </div>
                                        <?php endif ?>
                                        <?php if ($respC > 0 && $rA > 0 || $rC > 0) : ?>
                                            <hr>
                                            <br>
                                        <?php endif ?>
                                        <?php if ($respC > 0) : ?>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Baixar arquivo de requisição</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como baixar o arquivo correspondente a uma requisição utilizando a página de Administração de Requisições de compras.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de compras</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Requisições</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li>Selecionar a linha correspondente à requisição que deseja</li>
                                                    <li>Clicar no botão 📥 presente em cima da tabela ao pé das restantes opções</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Salvar arquivo de requisição</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como salvar o arquivo correspondente a uma requisição utilizando a página de Administração de Requisições de compras.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de compras</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Requisições</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li>Selecionar a linha correspondente à requisição que deseja</li>
                                                    <li>Clicar no botão 💾 presente em cima da tabela ao pé das restantes opções</li>
                                                </ol>
                                            </div>
                                            <hr>
                                            <br>
                                            <div class="form-row">
                                                <h4 style="margin: 0 auto;"><b>Finalizar Requisição de Compras</b></h4>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <h6 style="padding-left: 25px;">As instruções abaixo demonstram como finalizar uma requisição de compras utilizando a página de Administração de Requisições de compras.</h6>
                                            </div>
                                            <br>
                                            <div class="form-row">
                                                <ol>
                                                    <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de compras</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                    <li><b>Expandir</b> caso fechada a <b>tabela de Requisições</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                    <li>Selecionar a linha correspondente à requisição que deseja</li>
                                                    <li>Clicar no botão ✔️ presente em cima da tabela ao pé das restantes opções</li>
                                                    <li>Responder há pergunta de confirmação</li>
                                                </ol>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>
                            <?php endif ?>
                            <?php if ($respS > 0) : ?>
                                <div class="card card-outline card-dark" id="gest-card">
                                    <div class="card-header">
                                        <h3 class="card-title">Gestão</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Ativar novo ano-letivo</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como ativar um novo ano-letivo utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Outros</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Clicar no botão ➕ presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar Responsável Área</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como retirar um responsável de uma área de material utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela de Responsáveis Materiais</li>
                                                <li>Selecionar a linha da tabela correspondente ao responsável que deseja eliminar</li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar área de material</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como adicionar uma nova área de materiais utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas de Materiais</li>
                                                <li>Clicar no botão ➕ presente em cima da tabela ao pé das restantes opções </li>
                                                <li>Colocar a designação da nova área na caixa de texto presente</li>
                                                <li>Quando tudo preenchido clicar no botão OK</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Editar nome área de material</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como editar a designação de uma área de materiais utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas de Materiais</li>
                                                <li>Selecionar a linha da tabela correspondente há área que deseja editar</li>
                                                <li>Clicar no botão 🔧 presente em cima da tabela ao pé das restantes opções </li>
                                                <li>Colocar a nova designação da área na caixa de texto presente</li>
                                                <li>Quando tudo preenchido clicar no botão OK</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Ver número responsáveis área</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como visualizar o número de responsáveis por cada área utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas de Materiais</li>
                                                <li>Selecionar a linha da tabela correspondente há área que deseja visualizar o seu número de responsáveis</li>
                                                <li>Clicar no botão 📦 presente em cima da tabela ao pé das restantes opções </li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar área de material</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar uma área de materiais utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas de Materiais</li>
                                                <li>Selecionar uma linha da tabela correspondente há área que deseja eliminar </li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar Responsável Cacifos</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como retirar um responsável de um piso de cacifos utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Responsáveis Cacifos </li>
                                                <li>Selecionar a linha da tabela correspondente ao responsável que deseja eliminar</li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar piso de cacifos</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como adicionar um nova piso de cacifos utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li><b>Visualizar</b> a tabela <b>Pisos de cacifos</b></li>
                                                <li>Clicar no botão ➕ presente em cima da tabela ao pé das restantes opções </li>
                                                <li>Colocar a designação do novo piso na caixa de texto presente</li>
                                                <li>Quando tudo preenchido clicar no botão OK</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Editar nome Piso de cacifos</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como editar a designação de um piso de cacifos utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li><b>Visualizar</b> a tabela <b>Pisos de cacifos</b></li>
                                                <li>Selecionar a linha na tabela correspondente ao piso que deseja alterar</li>
                                                <li>Clicar no botão 🔧 presente em cima da tabela ao pé das restantes opções </li>
                                                <li>Colocar a nova designação da área na caixa de texto presente</li>
                                                <li>Quando tudo preenchido clicar no botão OK</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Ver número responsáveis piso</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como visualizar o número de responsáveis por cada piso utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li><b>Visualizar</b> a tabela <b>Pisos de cacifos</b></li>
                                                <li><b>Selecionar</b> a linha correspondente ao piso que deseja visualizar o número de responsáveis</li>
                                                <li>Clicar no botão 📦 presente em cima da tabela junto das restantes opções</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar piso de cacifos</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar um piso de cacifos utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li><b>Visualizar</b> a tabela <b>Pisos de cacifos</b></li>
                                                <li>Selecionar uma linha da tabela correspondente ao piso que deseja eliminar </li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar responsável website</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como inserir um novo responsável do website utilizando a página de Administração de Requisições de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Requisições de Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechada o <b>cartão Outros</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li><b>Visualizar</b> a tabela <b>Responsáveis Site</b></li>
                                                <li>Clicar no botão ➕ presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Colocar a o identificador do novo responsável na caixa de texto existente</li>
                                                <li>Clicar no botão de OK</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar responsável site</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar um responsável do site utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechada o <b>cartão Outros</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li><b>Visualizar</b> a tabela <b>Responsáveis Site</b></li>
                                                <li>Selecionar uma linha da tabela correspondente ao piso que deseja eliminar </li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar responsável a área de material</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como adicionar um responsável a uma área de materiais utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Materiais</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar o formulário de Adicionar Responsável de Materiais</li>
                                                <li>Deve preencher o formulário apresentado introduzindo o identificador do responsável e a área do material na qual o deseja introduzir </li>
                                                <li>Quando tudo devidamente preenchido clicar no botão Confirmar</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar responsável a piso de cacifos</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como adicionar um responsável a um piso de cacifos utilizando a página de Administração de Gestão. </h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão de Cacifos</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar formulário Adicionar Responsável Cacifos</li>
                                                <li>Deve preencher o formulário apresentado introduzindo o identificador do responsável e o piso no qual o deseja introduzir </li>
                                                <li>Quando tudo devidamente preenchido clicar no botão Confirmar</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar Responsável compras</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar um responsável de compras utilizando a página de Administração de Gestão. </h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechada a <b>tabela de compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Responsáveis Compras</li>
                                                <li>Selecionar a linha correspondete ao responsável que deseja remover </li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar uma área de compras</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como adicionar uma área de compras utilizando a página de Administração de Gestão. </h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas de Compras</li>
                                                <li>Clicar no botão ➕ presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Inserir o nome da área na caixa de texto existente</li>
                                                <li>Clicar quando tudo concluido no botão OK</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Editar nome área de compras</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como editar a designação de uma área de compras utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas Compras</li>
                                                <li>Selecionar a linha da tabela correspondente há área que deseja editar</li>
                                                <li>Clicar no botão 🔧 presente em cima da tabela ao pé das restantes opções </li>
                                                <li>Colocar a nova designação da área na caixa de texto presente</li>
                                                <li>Quando tudo preenchido clicar no botão OK</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Ver número responsáveis área compras</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como visualizar o número de responsáveis por cada área de compras utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas Compras</li>
                                                <li>Selecionar a linha da tabela correspondente há área que deseja visualizar o seu número de responsáveis</li>
                                                <li>Clicar no botão 📦 presente em cima da tabela ao pé das restantes opções </li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar área de compras</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar uma área de compras utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Áreas Compras</li>
                                                <li>Selecionar uma linha da tabela correspondente há área que deseja eliminar </li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Eliminar Associação Área-Setor</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como eliminar uma associação área-setor de compras utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar a tabela Associação Área a Setor de Compras</li>
                                                <li>Selecionar uma linha da tabela correspondente há associação que deseja eliminar </li>
                                                <li>Clicar no botão 🗑 presente em cima da tabela ao pé das restantes opções</li>
                                                <li>Responder há pergunta de confirmação</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar responsável compras</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como adicionar um associação responsável a uma área de compras utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar o formulário Adicionar Responsável Compras</li>
                                                <li>Inserir o ID do responsável e a área em que o deseja inserir</li>
                                                <li>Clicar no botão Confirmar quando tudo preenchido</li>
                                            </ol>
                                        </div>
                                        <hr>
                                        <br>
                                        <div class="form-row">
                                            <h4 style="margin: 0 auto;"><b>Adicionar Associação Área-Setor</b></h4>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <h6 style="padding-left: 25px;">As instruções abaixo demonstram como adicionar uma associação de uma área a um setor de compras utilizando a página de Administração de Gestão.</h6>
                                        </div>
                                        <br>
                                        <div class="form-row">
                                            <ol>
                                                <li>Deve <b>selecionar</b> a página de <b>Administração Gestão</b> localizado no <b>canto superior esquerdo</b> da página</li>
                                                <li><b>Expandir</b> caso fechado o <b>cartão Compras</b> clicando no botão <b>➕</b> localizado no <b>lado direito</b> da aba</li>
                                                <li>Visualizar o formulário Associar Área e Setor</li>
                                                <li>Selecionar a área e o setor de compras para realizar a associação</li>
                                                <li>Clicar no botão Confirmar quando tudo preenchido</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
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


    <script>
        $(function() {
            $('#user-manual-card').CardWidget('toggle');
            $('#admin-manual-card').CardWidget('toggle');
            $('#gest-card').CardWidget('toggle');
        })
    </script>


</body>

</html>

<?php $connect = null ?>