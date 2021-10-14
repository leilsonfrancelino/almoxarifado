<?php
ob_start();
session_start();
require "../dao/conexao.php";


$cod_prod = filter_input(INPUT_POST, 'cod_prod', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($cod_prod)) {
		
		$sql = "DELETE FROM produto where codigo='$cod_prod'";
		$resultado = mysqli_query($conexao,$sql);
			if(mysqli_affected_rows($conexao) == 0){
				$_SESSION['prod_nao_deletado'] = true;
				header('Location:../view/lista_produtos.php');
			}else{
				$_SESSION['prod_deletado'] = true;
				header('Location:../view/lista_produtos.php');	
			}
	}else{
		$_SESSION['selecione_prod'] = true;
		header('Location:../view/lista_produtos.php');	
	}
?>





