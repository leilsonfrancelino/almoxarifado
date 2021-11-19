<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

if ($_GET['id'] == "") {

  $_SESSION['select_vazio'] = true;
  header("Location:lista_clientes.php");
} else {

  $id_select = $_GET['id'];

  $sql_cliente_selecionado = "SELECT * FROM clientes where id_cli ='$id_select'";
  $result_cliente_selecionado = mysqli_query($conexao, $sql_cliente_selecionado);
  $dados_cliente_selecionado = mysqli_fetch_array($result_cliente_selecionado);

  ?>
  <!DOCTYPE html>
  <html lang="pt-BR">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="../js/sweetalert.min.js"></script>

    <title>Alteração de Cliente</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin.css" rel="stylesheet">
    <style>
      .img {
        margin-top: 10%;
        margin-left: 10%;
        width: 20%;
      }

      .cor {
        background-color: seagreen;
      }
    </style>

  </head>

  <body id="page-top">
    <?php
      include_once "nav.php";
      ?>
    <div id="wrapper">
      <?php
        include_once "menu.php";
        ?>
      <div id="content-wrapper">
        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="painel.php">Painel Principal</a>
            </li>
            <li class="breadcrumb-item active">Alteração de cliente</li>
          </ol>

          <!--Formulario-->
          <form method="POST" action="../valida/valida_alter_cliente.php">
            <div class="modal-body">
			<div class="form-row">
                <div class="form-group col-md-2">
                  <label for="data">Código:</label>
                  <input class="form-control" value="<?php echo ($dados_cliente_selecionado['id_cli']); ?>" disabled>
                  <input type="hidden" name="id_cliente" value="<?php echo $dados_cliente_selecionado['id_cli']; ?>">
                </div>
              </div>  
              <div class="form-group">
                <label for="inputAddress">Nome do cliente:</label>
                <input type="text" name="novo_nome" class="form-control" id="nome_cliente" value="<?php echo $dados_cliente_selecionado['nome_cli'] ?>">

              </div>                         
            </div>
        </div>
        <div class="modal-footer">
          <!--<button type="button" style="width:15%" class="btn btn-secondary" data-dismiss="modal">Fechar</button>-->
		  <a href="lista_clientes.php" style="width:15%" type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</a>
          <button type="submit" style="width:15%" name="alterar" class="btn btn-primary"><div style="color:white">Alterar</div></button>
        </div>
        </form>
      </div>
    </div>
    </div>
    </form>
    </div>

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span>Projeto Integrador Univesp © Almoxarifado 2021</span>
        </div>
      </div>
    </footer>

    </div>
    <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>

  </body>

  </html>
<?php } ?>