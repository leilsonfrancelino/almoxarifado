<?php
session_start();
require "../dao/conexao.php";
include "../valida/verifica_login.php";

$sql_lista = "SELECT p.codigo,p.descricao,p.unidade,p.data_cadastro,p.quantidade,p.fornecedor,p.grupo,p.valor_unidade, 
f.nome AS f_nome,f.id,g.nome AS g_nome,g.id 
FROM produtos AS p 
INNER JOIN fornecedores as f ON p.fornecedor=f.id 
INNER JOIN grupos as g ON p.grupo=g.id";
$result_lista = mysqli_query($conexao, $sql_lista);
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Lista de Produtos</title>

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

   right: 0pt;

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
          <li class="breadcrumb-item active">Tabela de Produtos</li>
        </ol>

        <!-- Alerts-->
        <?php if (isset($_SESSION['prod_cadastrado'])) { ?>
          <script>
            swal("Feito", "Produto cadastrado com sucesso!", "success")
          </script>
        <?php

          unset($_SESSION['prod_cadastrado']);
        } ?>
        <?php if (isset($_SESSION['prod_nao_cadastrado'])) { ?>
          <script>
            swal("Ops", "Produto n??o p??de ser cadastrado!", "error")
          </script>
        <?php

          unset($_SESSION['prod_nao_cadastrado']);
        } ?>
        
        <?php if (isset($_SESSION['prod_alterado'])) { ?>
          <script>
            swal("Feito!", "Produto alterado com sucesso!", "success")
          </script>
        <?php
          unset($_SESSION['prod_alterado']);
        } ?>

        <?php if (isset($_SESSION['select_vazio'])) { ?>
          <script>
            swal("Ops...", "Selecione um produto!", "warning")
          </script>
        <?php
          unset($_SESSION['select_vazio']);
        } ?>

        <?php if (isset($_SESSION['prod_nao_alterado'])) { ?>
          <script>
            swal("Ops...", "Produto n??o p??de ser alterado!", "error")
          </script>
        <?php
          unset($_SESSION['prod_nao_alterado']);
        } ?>
		 <?php if (isset($_SESSION['prod_deletado'])) { ?>
          <script>
            swal("Feito...", "Produto exclu??do com sucesso!", "success")
          </script>
        <?php
          unset($_SESSION['prod_deletado']);
        } ?>
		<?php if (isset($_SESSION['prod_nao_deletado'])) { ?>
		  <script>
            swal("Ops...", "Produto n??o encontrado!", "error")
          </script>
        <?php
          unset($_SESSION['prod_nao_deletado']);
        } ?>
		<?php if (isset($_SESSION['selecione_produto'])) { ?>
		  <script>
            swal("Ops...", "Selecione um produto!", "error")
          </script>
        <?php
          unset($_SESSION['selecione_prod']);
        } ?>
		<?php if (isset($_SESSION['prod_ja_existe'])) { ?>
          <script>
            swal("Ops...", "Produto j?? cadastrado!", "error")
          </script>
        <?php
          unset($_SESSION['prod_ja_existe']);
        } ?>
		<?php if (isset($_SESSION['chave_estrangeira_prod'])) { ?>
          <script>
            swal("Ops...", "Este produto n??o pode ser exclu??do, porque esta associado as entradas e sa??das do estoque!", "error")
          </script>
        <?php
          unset($_SESSION['chave_estrangeira_prod']);
        } ?>
		
		<!-- Excluir Modal-->
			<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">            
					   <div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Realmente deseja excluir?</h5>
							<button class="close" type="button" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">??</span>
							</button>
						</div>          
						<div class="modal-body">
							<p>Selecione "Excluir" abaixo para confirmar.</p>                    
							<p class="debug-url"></p>
						</div>
					   
						<div class="modal-footer">
							<button class="btn btn-secondary" style="width:20%" type="button" data-dismiss="modal">Cancelar</button>
							<a class="btn btn-danger btn-ok">Excluir</a>
						</div>
					</div>
				</div>
			</div>
		<!-- Fim Modal-->

        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Tabela de Produtos
            <?php require "modais/modal_cadastrar_produto.php"?>
            <button style="" type="button" data-toggle="modal" data-target="#modal_cadastrar_produto" class="btn btn-outline-primary"> <i class="far fa-file" aria-hidden="true"></i> Novo</button></div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Descri????o</th>                    
                    <th>Fornecedor</th>
					<th>Grupo</th>
                    <th>Unidade</th>
                    <th>Valor unit??rio</th>
                    <th>Op????es</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Id</th>
                    <th>Descri????o</th>                    
                    <th>Fornecedor</th>
					<th>Grupo</th>
                    <th>Unidade</th>
                    <th>Valor unit??rio</th>
                    <th>Op????es</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php while ($dados_lista = mysqli_fetch_array($result_lista)) {

                   
                    $valor_unidade_formatado = number_format($dados_lista['valor_unidade'], 2, ',', '.');

                    echo "<tr>";
                    echo "<td> " . $dados_lista['codigo'] . "</td>";
                    echo "<td> " . $dados_lista['descricao'] . "</td>";                    
                    echo "<td> " . $dados_lista['f_nome'] . "</td>";
					echo "<td> " . $dados_lista['g_nome'] . "</td>";
                    echo "<td> " . $dados_lista['unidade'] . "</td>";
                    echo "<td> " . "R$ " . $valor_unidade_formatado . "</td>";
                    echo "<td> " . "<a href='select_alterar_produto.php?id=".$dados_lista['codigo']."' type='button' class='btn btn-outline-warning btn-sm 'data-toggle='tooltip' data-placement='top' title='Alterar' style='width:40%;'><i class='fas fa-pencil-alt' aria-hidden='true'></i></a>"." "."<a href='#' data-href='confirmar_exclusao_produto.php?id=".$dados_lista['codigo']."' type='button' class='btn btn-outline-danger btn-sm' data-toggle='modal' data-target='#confirm-delete' data-placement='top' title='Excluir' style='width:40%;'><i class='fas fa-trash-alt' aria-hidden='true'></i></a>"."</td>";
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
        </div>
      </div>

      
    </div>
    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
        <span>Projeto Integrador Univesp ?? Almoxarifado 2021</span>
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
  <script src="../vendor/datatables/jquery.dataTables.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="../js/demo/datatables-demo.js"></script>
  <script>
    // Este evento ?? acionado ap??s o carregamento da p??gina
    $(document).ready(function() {
      setTimeout('$("#preload").fadeOut(10)', 1000);
    });
    
    $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
  </script>
  
  <!-- Script captura o id a ser excluido-->
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));          
        });
    </script>

</body>

</html>
