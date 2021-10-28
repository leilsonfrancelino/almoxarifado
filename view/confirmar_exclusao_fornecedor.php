<?php
ob_start();
session_start();
require "../dao/conexao.php";


$id_fornec = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
	if(!empty($id_fornec)) {
		
		$sql =	"SELECT f.id FROM fornecedores as f INNER JOIN produtos as p ON f.id = p.grupo WHERE codigo=$id_fornec";
		$resultado1 = mysqli_query($conexao,$sql);
		
		if(mysqli_affected_rows($conexao) == 0) { 
			$sql = "DELETE FROM fornecedores where id='$id_fornec'";
			$resultado = mysqli_query($conexao,$sql);
				if(mysqli_affected_rows($conexao) == 0){
						$_SESSION['fornecedor_nao_deletado'] = true;
						header('Location:../view/lista_fornecedores.php');
					}else{
						$_SESSION['fornecedor_deletado'] = true;
						header('Location:../view/lista_fornecedores.php');	
					}
				}else{
					$_SESSION['chave_estrangeira_fornecedor'] = true;
					header('Location:../view/lista_fornecedores.php');
			
		}	
	}else{
		$_SESSION['selecione_fornecedor'] = true;
		header('Location:../view/lista_fornecedores.php');	
	}
?>





