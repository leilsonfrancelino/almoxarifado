<?php 
//Criando o arquivo de conexão
$host = "localhost";
$usuario = "root";
$senha = "";
$banco="estoque1";

$conexao= mysqli_connect($host,$usuario,$senha,$banco) or die("Não foi possivel conectar ao banco");
mysqli_select_db($conexao,$banco) or die("Não foi possivel encontrar esse banco");
