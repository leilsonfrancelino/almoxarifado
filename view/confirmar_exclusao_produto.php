<?php
ob_start();
session_start();
require "../dao/conexao.php";


$cod_prod = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($cod_prod)) {
		
		$sql =	"SELECT p.codigo FROM produtos as p INNER JOIN movimentacoes_estoque as m ON p.codigo = m.produto WHERE codigo=$cod_prod";
		$resultado1 = mysqli_query($conexao,$sql);
		
		if(mysqli_affected_rows($conexao) == 0) {
			$sql = "DELETE FROM produtos where codigo='$cod_prod'";
			$resultado = mysqli_query($conexao,$sql);
				if(mysqli_affected_rows($conexao) == 0){
					$_SESSION['prod_nao_deletado'] = true;
					header('Location:../view/lista_produtos.php');
				}else{
					$_SESSION['prod_deletado'] = true;
					header('Location:../view/lista_produtos.php');	
				}
			}else{
				$_SESSION['chave_estrangeira_prod'] = true;
			    header('Location:../view/lista_produtos.php');
			}
	}else{
		$_SESSION['selecione_prod'] = true;
		header('Location:../view/lista_produtos.php');	
	}
?>





