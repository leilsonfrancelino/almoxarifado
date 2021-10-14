<?php
ob_start();
session_start();
require "../dao/conexao.php";

$id_grupo = $_POST['id_grupo'];

$sql_prods = "SELECT * FROM grupos where id='$id_grupo'";
$result = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($result);


if (isset($_POST['alterar'])) {

    //verificando posts
    if (isset($_POST['novo_nome']) && ($_POST['novo_nome']) != "") {

        $novo_nome = ($_POST['novo_nome']);

        $sql = "UPDATE grupos SET nome='$novo_nome' WHERE id ='$id_grupo'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['grupo_alterado'] = true;
        }
    }
   

    if (isset($_SESSION['grupo_alterado'])) {
        header('Location:../view/lista_grupos.php');
    } else {
        $_SESSION['grupo_nao_alterado'] = true;
        header('Location:../view/lista_grupos.php');
    }
} else {
    echo "<script> alert('Não foi possível fazer a alteração');</script>";
}
