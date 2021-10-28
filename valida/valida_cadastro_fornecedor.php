<?php
ob_start();
session_start();
require "../dao/conexao.php";

	if (isset($_POST['cadastrar'])) {

		$nome_fornecedor = ($_POST['nome_fornecedor']);
		$cnpj = ($_POST['cnpj']);
		$uf = ($_POST['uf']);
		$estabelecimento = ($_POST['tipo_estabelecimento']);
		
		$sql = "SELECT 0 FROM fornecedores where cnpj='$cnpj'";
		$resultado1 = mysqli_query($conexao,$sql);
				if(mysqli_affected_rows($conexao) == 0){
					//inserir no banco.
					$sql = "INSERT INTO fornecedores (nome,cnpj,uf,tipo_estabelecimento)
						  VALUE ('$nome_fornecedor','$cnpj','$uf','$estabelecimento')";

					//Incluir
					$resultado = mysqli_query($conexao, $sql);

					if (!isset($resultado)){
						$_SESSION['fornec_nao_cadastrado'] = true;
						header('Location:../view/lista_fornecedores.php');

					} else {
						$_SESSION['fornec_cadastrado'] = true;
						header('Location:../view/lista_fornecedores.php');
						exit();						
					}
					}else{
					$_SESSION['fornecedor_ja_existe'] = true;
					header('Location:../view/lista_fornecedores.php');
				}
	} else {
		echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}
