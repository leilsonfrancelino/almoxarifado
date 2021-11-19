<?php
ob_start();
session_start();
require "../dao/conexao.php";

	if (isset($_POST['cadastrar'])) {

		$nome_cliente = ($_POST['nome_cliente']);
		   
		$sql = "SELECT 0 FROM clientes where nome_cli='$nome_cliente'";
		$resultado1 = mysqli_query($conexao,$sql);
				if(mysqli_affected_rows($conexao) == 0){
					//inserir no banco.
					$sql = "INSERT INTO clientes (nome_cli)
						  VALUE ('$nome_cliente')";

					//Incluir
					$resultado = mysqli_query($conexao, $sql);

					if (!isset($resultado)){
						$_SESSION['cliente_nao_cadastrado'] = true;
						header('Location:../view/lista_clientes.php');

					} else {
						$_SESSION['cliente_cadastrado'] = true;
						header('Location:../view/lista_clientes.php');
						exit();			
			        }
				}else{
					$_SESSION['cliente_ja_existe'] = true;
					header('Location:../view/lista_clientes.php');
				}
	} else {
		echo "<script> alert('Não foi possível fazer o cadastro');</script>";
	}
