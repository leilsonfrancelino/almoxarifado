<?php
ob_start();
session_start();
require "../dao/conexao.php";

	if (isset($_POST['cadastrar'])) {

			$descricao = ($_POST['descricao']);
			$quantidade = ($_POST['quantidade']);
			$unidade = ($_POST['unidade']);    
			$select_fornecedor = ($_POST['select_fornecedor']);
			$select_grupo = ($_POST['select_grupo']);
			$valor_unidade = ($_POST['valor_unidade']);
			$responsavel = $_SESSION['usuario'];

			$sql = "SELECT 0 FROM produtos where descricao='$descricao'";
			$resultado1 = mysqli_query($conexao,$sql);
				if(mysqli_affected_rows($conexao) == 0){	
					//inserir no banco.
					$sql = "INSERT INTO produtos (descricao,quantidade,unidade,fornecedor,grupo,valor_unidade,responsavel)
						  VALUE ('$descricao','$quantidade','$unidade','$select_fornecedor','$select_grupo','$valor_unidade','$responsavel')";
					//Incluir
					$resultado = mysqli_query($conexao, $sql);

						if (!isset($resultado)){							
							$_SESSION['prod_nao_cadastrado'] = true;
							header('Location:../view/lista_produtos.php');

						} else {
							$_SESSION['prod_cadastrado'] = true;
							header('Location:../view/lista_produtos.php');
							exit();							
						}
				}else{
					$_SESSION['prod_ja_existe'] = true;
					header('Location:../view/lista_produtos.php');
				}
		}else {
			echo "<script> alert('Não foi possível fazer o cadastro');</script>";
	}


 
	