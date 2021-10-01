<?php
ob_start();
session_start();
require "../dao/conexao.php";

if (isset($_POST['cadastrar'])) {

    $nome_departamento = ($_POST['nome_departamento']);
       

    //inserir no banco.
    $sql = "INSERT INTO departamentos (nome)
          VALUE ('$nome_departamento')";

    //Incluir
    $resultado = mysqli_query($conexao, $sql);

    if (!isset($resultado)){
        $_SESSION['departamento_nao_cadastrado'] = true;
        header('Location:../view/lista_departamentos.php');

    } else {
        $_SESSION['departamento_cadastrado'] = true;
        header('Location:../view/lista_departamentos.php');
        exit();
        
    }
} else {
    echo "<script> alert('Não foi possível fazer o cadastro');</script>";
}
