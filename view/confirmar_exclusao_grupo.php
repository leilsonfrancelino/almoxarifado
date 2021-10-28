<?php
ob_start();
session_start();
require "../dao/conexao.php";


$id_grupo = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($id_grupo)) {
		
		$sql =	"SELECT g.id FROM grupos as g INNER JOIN produtos as p ON g.id = p.grupo WHERE codigo=$id_grupo";
		$resultado1 = mysqli_query($conexao,$sql);
			
		if(mysqli_affected_rows($conexao) == 0) { 
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
				$_SESSION['chave_estrangeira_grupo'] = true;
			    header('Location:../view/lista_grupos.php');
			
		}	
	}else{
		$_SESSION['selecione_grupo'] = true;
		header('Location:../view/lista_grupos.php');	
	}

?>