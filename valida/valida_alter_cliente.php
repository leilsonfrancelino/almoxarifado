<?php
ob_start();
session_start();
require "../dao/conexao.php";

$id_cliente = $_POST['id_cliente'];

$sql_cli = "SELECT * FROM clientes where id_cli='$id_cliente'";
$result = mysqli_query($conexao, $sql_cli);
$dados = mysqli_fetch_array($result);


if (isset($_POST['alterar'])) {

    //verificando posts
    if (isset($_POST['novo_nome']) && ($_POST['novo_nome']) != "") {

        $novo_nome = ($_POST['novo_nome']);

        $sql = "UPDATE clientes SET nome_cli='$novo_nome' WHERE id_cli ='$id_cliente'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['cliente_alterado'] = true;
        }
    }
   

    if (isset($_SESSION['cliente_alterado'])) {
        header('Location:../view/lista_clientes.php');
    } else {
        $_SESSION['cliente_nao_alterado'] = true;
        header('Location:../view/lista_clientes.php');
    }
} else {
    echo "<script> alert('Não foi possível fazer a alteração');</script>";
}
