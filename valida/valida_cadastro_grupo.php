<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['cadastrar'])) {

    $nome_grupo = ($_POST['nome_grupo']);
       

    //inserir no banco.
    $sql = "INSERT INTO grupos (nome)
          VALUE ('$nome_grupo')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        $_SESSION['grupo_nao_cadastrado'] = true;
        header('Location:../view/lista_grupos.php');

    } else {
        $_SESSION['grupo_cadastrado'] = true;
        header('Location:../view/lista_grupos.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}
