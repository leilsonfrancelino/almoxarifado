<?php
ob_start();
session_start();
require "../dao/conexao.php";

$cod_prod = $_POST['cod_prod'];

$sql_prods = "SELECT * FROM produtos where codigo='$cod_prod'";
$result = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($result);


if (isset($_POST['alterar'])) {

    //verificando posts
    if (isset($_POST['nova_descricao']) && ($_POST['nova_descricao']) != "") {

        $nova_descricao = ($_POST['nova_descricao']);

        $sql = "UPDATE produtos SET descricao='$nova_descricao' WHERE codigo ='$cod_prod'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['prod_alterado'] = true;
        }
    }

    if (isset($_POST['nova_unidade']) && ($_POST['nova_unidade']) != "") {

        $nova_unidade = ($_POST['nova_unidade']);

        $sql = "UPDATE produtos SET unidade='$nova_unidade' WHERE codigo ='$cod_prod'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['prod_alterado'] = true;
        }
    }    

    if (isset($_POST['novo_fornecedor']) && ($_POST['novo_fornecedor']) != "") {

        $novo_fornecedor = ($_POST['novo_fornecedor']);

        $sql = "UPDATE produtos SET fornecedor='$novo_fornecedor' WHERE codigo ='$cod_prod'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['prod_alterado'] = true;
        }
    }
	
	if (isset($_POST['novo_grupo']) && ($_POST['novo_grupo']) != "") {

        $novo_grupo = ($_POST['novo_grupo']);

        $sql = "UPDATE produtos SET grupo='$novo_grupo' WHERE codigo ='$cod_prod'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['prod_alterado'] = true;
        }
    }

    if (isset($_POST['novo_valor_unidade']) && ($_POST['novo_valor_unidade']) != "") {

        $novo_valor_unidade = ($_POST['novo_valor_unidade']);

        $valor_unidade_formatado = str_replace(',', '.', str_replace('.', ',', $novo_valor_unidade));

        $sql = "UPDATE produtos SET valor_unidade='$valor_unidade_formatado' WHERE codigo ='$cod_prod'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['prod_alterado'] = true;
        }
    }


    $responsavel = $_SESSION['usuario'];

    //inserir no banco.
    $sql = "UPDATE produtos SET responsavel='$responsavel'WHERE codigo ='$cod_prod'";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (isset($_SESSION['prod_alterado'])) {
        header('Location:../view/lista_produtos.php');
    } else {
        $_SESSION['prod_nao_alterado'] = true;
        header('Location:../view/lista_produtos.php');
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}
