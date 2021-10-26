<?php
ob_start();
session_start();
require "../dao/conexao.php";


$id_grupo = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($id_grupo)) {
		
		$sql = "DELETE FROM grupos where id='$id_grupo'";
		$resultado = mysqli_query($conexao,$sql);
			if(mysqli_affected_rows($conexao) == 0){
				$_SESSION['grupo_nao_deletado'] = true;
				header('Location:../view/lista_grupos.php');
			}else{
				$_SESSION['grupo_deletado'] = true;
				header('Location:../view/lista_grupos.php');	
			}
	}else{
		$_SESSION['selecione_grupo'] = true;
		header('Location:../view/lista_grupos.php');	
	}
?>





