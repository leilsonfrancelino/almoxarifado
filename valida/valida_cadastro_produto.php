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

    //inserir no banco.
    $sql = "INSERT INTO produtos (descricao,quantidade,unidade,fornecedor,grupo,valor_unidade,responsavel)
          VALUE ('$descricao','$quantidade','$unidade','$select_fornecedor','$select_grupo','$valor_unidade','$responsavel')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        echo "Falha ao inserir dados!";
        $_SESSION['prod_nao_cadastrado'] = true;
        header('Location:../view/lista_produtos.php');

    } else {
        $_SESSION['prod_cadastrado'] = true;
        header('Location:../view/lista_produtos.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}
