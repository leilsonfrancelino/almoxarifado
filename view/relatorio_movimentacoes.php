<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

//select ultimos fornecedores
$sql_movimentacoes = "SELECT m.id,m.produto,m.quant_mov,m.motivo,m.data_mov,m.movimentacao,m.responsavel,u.id,u.usuario,p.codigo,p.descricao FROM movimentacoes_estoque as m
INNER JOIN produtos as p ON m.produto=p.codigo 
INNER JOIN usuarios as u ON m.responsavel=u.usuario";
$result_movimentacoes = mysqli_query($conexao, $sql_movimentacoes);
$row_movimentacoes = mysqli_num_rows($result_movimentacoes);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Relatório Movimentações</title>

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

  <div id="wrapper">
    <!-- Incluindo o menu -->
    <?php
    include_once "menu.php";
    ?>

    <div id="content-wrapper">
      <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">          
          <li class="breadcrumb-item">
            <a href="gerar_pdf_movimentacoes.php" target="_blank">Exportar PDF</a>
          </li>
        </ol>
    
        <h4 style="text-align:center"><strong>Relatório de Movimentações</strong></h4><br>
        

        <?php
        if ($row_movimentacoes == "0") { ?>
          <div class="alert alert-warning" role="alert">
            Não há movimentações <i class="fas fa-fw fa-exclamation-triangle"></i>
          </div>

        <?php
        } else { ?>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                    <th>Id</th>
					<th>Descrição</th>
					<th>Quantidade</th>
					<th>Motivo da movimentação</th>
					<th>Data de movimentação</th>
					<th>Tipo</th>					
					<th>Responsável</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($dados_movimentacoes = mysqli_fetch_array($result_movimentacoes)) {
					if($dados_movimentacoes['movimentacao']==0){
                                                $mov='Entrada';
                                            }
                                            else{
                                                $mov='Saída';
                                            }
                    echo "<tr>";
					echo "<td> " . $dados_movimentacoes['id'] . "</td>";
					echo "<td> " . $dados_movimentacoes['descricao'] . "</td>";
					echo "<td> " . $dados_movimentacoes['quant_mov'] . "</td>";
					echo "<td> " . $dados_movimentacoes['motivo'] . "</td>";
					echo "<td> " . date('d/m/Y', strtotime($dados_movimentacoes['data_mov'])) . "</td>";
					echo "<td> " . $mov . "</td>";
					echo "<td> " . $dados_movimentacoes['usuario'] . "</td>";
					echo "</tr>";
                  } ?>
              </tbody>
            </table>
          </div>
        <?php
        }
        ?>


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
<script>
    // Este evendo é acionado após o carregamento da página
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 1000);
    });
  </script>
</body>

</html>