<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Painel Principal</title>

  <script src="../js/sweetalert.min.js"></script>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">
  <style>
    .cursor {
      cursor: pointer;
    }

    .preload {
      position: fixed;
      z-index: 99999;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.50;
      -moz-opacity: 0.50;
      filter: alpha(opacity=50);
      background: black;
      background-image: url('../imagens/loader.gif');
      background-size: 60px 60px;
      background-position: center;
      background-repeat: no-repeat;
      overflow: hidden;
    }
  </style>

</head>

<body id="page-top">
  <div id="preload" class="preload"></div>

  <!--Incluindo o nav-->
  <?php
  include_once "nav.php";
  ?>
  
   <!-- Incluindo o menu -->
    <?php
    include_once "menu.php";
    ?>

  <div id="wrapper">
    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Painel Principal</a>
          </li>
          <li class="breadcrumb-item active">Visão global</li>
        </ol>        

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Projeto Integrador Univesp © Almoxarifado 2021</span>
            </div>
          </div>
        </footer>

      </div>

    </div>

  </div>

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
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

 

  <script>
    $(document).ready(function() {

      $('.toast').toast('show');

    });
  </script>
  <script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 500);
    });
  </script>


</body>

</html>