<?php
ob_start();
session_start();
require "../dao/conexao.php";

$id_departamento = $_POST['id_departamento'];

$sql_prods = "SELECT * FROM departamentos where id='$id_departamento'";
$result = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($result);


if (isset($_POST['alterar'])) {

    //verificando posts
    if (isset($_POST['novo_nome']) && ($_POST['novo_nome']) != "") {

        $novo_nome = ($_POST['novo_nome']);

        $sql = "UPDATE departamentos SET nome='$novo_nome' WHERE id ='$id_departamento'";

        $resultado = mysqli_query($conexao, $sql);

        if (isset($resultado)) {
            $_SESSION['departamento_alterado'] = true;
        }
    }
   

    if (isset($_SESSION['departamento_alterado'])) {
        header('Location:../view/lista_departamentos.php');
    } else {
        $_SESSION['departamento_nao_alterado'] = true;
        header('Location:../view/lista_departamentos.php');
    }
} else {
    echo "<script> alert('Não foi possível fazer a alteração');</script>";
}
