<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['cadastrar'])) {

    $nome_usuario = ($_POST['nome_usuario']);
    $senha_usuario = ($_POST['senha_usuario']);   

    //inserir no banco.
    $sql = "INSERT INTO usuarios (usuario,senha)
          VALUE ('$nome_usuario',md5('$senha_usuario'))";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        $_SESSION['usuario_nao_cadastrado'] = true;
        header('Location:../index.php');

    } else {
        $_SESSION['usuario_cadastrado'] = true;
        header('Location:../index.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}
