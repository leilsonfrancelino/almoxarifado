<?php
ob_start();
session_start();
require "../dao/conexao.php";


$id_cliente = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($id_cliente)) {
		
		$sql = "DELETE FROM clientes where id_cli='$id_cliente'";
		$resultado = mysqli_query($conexao,$sql);			
				if(mysqli_affected_rows($conexao) == 0){
					$_SESSION['cliente_nao_deletado'] = true;
					header('Location:../view/lista_clientes.php');
				}else{
					$_SESSION['cliente_deletado'] = true;
					header('Location:../view/lista_clientes.php');	
				}
         	
	}else{
		$_SESSION['selecione_cliente'] = true;
		header('Location:../view/lista_clientes.php');	
	}

?>