<?php
ob_start();
session_start();
require "../dao/conexao.php";


$id_depart = filter_input(INPUT_POST, 'id_depart', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($id_depart)) {
		
		$sql = "DELETE FROM departamentos where id='$id_depart'";
		$resultado = mysqli_query($conexao,$sql);
			if(mysqli_affected_rows($conexao) == 0){
				$_SESSION['departamento_nao_deletado'] = true;
				header('Location:../view/lista_departamentos.php');
			}else{
				$_SESSION['departamento_deletado'] = true;
				header('Location:../view/lista_departamentos.php');	
			}
	}else{
		$_SESSION['selecione_departamento'] = true;
		header('Location:../view/lista_departamentos.php');	
	}
?>





