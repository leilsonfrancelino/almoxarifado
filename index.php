<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Controle de Estoque</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
  
  <!-- alerts-->
  <script src="js/sweetalert.min.js"></script>

</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Entrar no sistema</div>
      <div class="card-body">

        <form method="POST" action="valida/valida_login.php">
          <div class="form-group">

            <center>
              <img src="imagens/univesp_index.png" style="width:45%; margin-top:-15%; margin-bottom:-10%">
            </center>
            <!-- Alerta de não autenticado ou cadastrado-->
            <?php if (isset($_SESSION['nao_autenticado'])) { ?>
              <script>
                    swal("Ops", "Usuário ou senha incorretos!", "error")
              </script>
            <?php
              unset($_SESSION['nao_autenticado']);
            } ?>
			 <?php if (isset($_SESSION['usuario_cadastrado'])) { ?>
              <script>
                    swal("Feito", "Usuário cadastrado com sucesso!", "success")
              </script>
            <?php
              unset($_SESSION['usuario_cadastrado']);
            } ?>
			  <?php if (isset($_SESSION['usuario_nao_cadastrado'])) { ?>
              <script>
                    swal("Ops", "Usuário não cadastrado!", "error")
              </script>
            <?php
              unset($_SESSION['usuario_nao_cadastrado']);
            } ?>

            <div class="form-label-group">
              <input type="text" id="inputUsuario" name="usuario" class="form-control" placeholder="Usuário" required="required" autofocus="autofocus">
              <label for="inputUsuario">Usuário</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required="required">
              <label for="inputPassword">Senha</label>
            </div>
          </div>
          <div class="form-group">
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">
                Lembrar-me
              </label>
            </div>

          </div>
          <button type="submit" name="entrar" style="width:100%" class="btn btn-primary">Entrar </button>
        </form>
        <div class="text-center"><br>
          <div class="card-header">
            
            
            <?php require "view/modais/modal_cadastrar_usuario.php"?>
            <button style="" type="button" data-toggle="modal" data-target="#modal_cadastrar_usuario" class="btn btn-outline-primary fixed-right"> <i class='far fa-file' aria-hidden="true"></i> Cadastrar-se</button>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>