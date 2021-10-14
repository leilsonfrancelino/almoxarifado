<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

$sql_lista_grupo = "SELECT * FROM grupos";
$result_lista_grupo = mysqli_query($conexao, $sql_lista_grupo);
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Lista de Grupos de Produtos</title>

  <script src="../js/sweetalert.min.js"></script>

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
      
      .canto {

   position: fixed;

   left: 0pt;
}
    }
  </style>

</head>

<body id="page-top">
    <div id="preload" class="preload"></div>
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
          <li class="breadcrumb-item active">Tabela de Grupo de Produtos</li>
        </ol>

        <!-- Alerts-->
        <?php if (isset($_SESSION['grupo_cadastrado'])) { ?>
          <script>
            swal("Feito", "Grupo cadastrado com sucesso!", "success")
          </script>
        <?php

          unset($_SESSION['grupo_cadastrado']);
        } ?>
        <?php if (isset($_SESSION['grupo_nao_cadastrado'])) { ?>
          <script>
            swal("Ops", "Grupo não pode ser cadastrado!", "error")
          </script>
        <?php

          unset($_SESSION['grupo_nao_cadastrado']);
        } ?>
        <?php if (isset($_SESSION['grupo_alterado'])) { ?>
          <script>
            swal("Feito!", "Grupo alterado com sucesso!", "success")
          </script>
        <?php
          unset($_SESSION['grupo_alterado']);
        } ?>

        <?php if (isset($_SESSION['select_vazio'])) { ?>
          <script>
            swal("Ops...", "Selecione um grupo!", "warning")
          </script>
        <?php
          unset($_SESSION['select_vazio']);
        } ?>

        <?php if (isset($_SESSION['grupo_nao_alterado'])) { ?>
          <script>
            swal("Ops...", "Grupo não pôde ser alterado!", "error")
          </script>
        <?php
          unset($_SESSION['grupo_nao_alterado']);
        } ?>
		 <?php if (isset($_SESSION['grupo_deletado'])) { ?>
          <script>
            swal("Feito...", "Grupo excluído com sucesso!", "success")
          </script>
        <?php
          unset($_SESSION['grupo_deletado']);
        } ?>
		<?php if (isset($_SESSION['grupo_nao_deletado'])) { ?>
		  <script>
            swal("Ops...", "Grupo não encontrado!", "error")
          </script>
        <?php
          unset($_SESSION['grupo_nao_deletado']);
        } ?>
		<?php if (isset($_SESSION['selecione_grupo'])) { ?>
		  <script>
            swal("Ops...", "Selecione um grupo!", "error")
          </script>
        <?php
          unset($_SESSION['selecione_grupo']);
        } ?>
		



        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Tabela de Grupos 
            <?php require "modais/modal_cadastrar_grupo.php"?>
            <button style="" type="button" data-toggle="modal" data-target="#modal_cadastrar_grupo" class="btn btn-outline-primary fixed-right"> <i class="far fa-file" aria-hidden="true"></i> Novo</button>
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nome</th>                    
                    <th>Opções</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Nome</th>                   
                    <th>Opções</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php while ($dados_lista_grupo = mysqli_fetch_array($result_lista_grupo)) {
                
                    echo "<tr>";
                    echo "<td> " . $dados_lista_grupo['id'] . "</td>";
                    echo "<td> " . $dados_lista_grupo['nome'] . "</td>";                    
                    echo "<td> " . "<a href='select_alterar_grupo.php?id=".$dados_lista_grupo['id']."' type='button' class='btn btn-outline-warning 
					btn-sm 'data-toggle='tooltip' data-placement='top' title='Alterar' style='width:20%;'><i class='fas fa-pencil-alt' 
					aria-hidden='true'></i></a>"." "."<a href='confirmar_exclusao_grupo.php?id=".$dados_lista_grupo['id']."' 
					type='button' class='btn btn-outline-danger btn-sm' data-toggle='tooltip' data-placement='top' title='Excluir' 
					style='width:20%;'><i class='fas fa-trash-alt' aria-hidden='true'></i></a>"."</td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"> Atualizado em :
            <?php date_default_timezone_set('America/Sao_Paulo');
            $date = date('d-m-y H:i');
            echo $date; ?>
          </div>
        </div
      </div>
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

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/demo/grafico_grupo.js"></script>
  <script src="../js/demo/grafico_produtos.js"></script>
<script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 500);
    });
  </script>
  
</body>

</html>