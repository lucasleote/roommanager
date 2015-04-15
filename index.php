<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <link rel="shortcut icon" href="img/icon_if.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomManager - Login</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="main" align="center">

      <form class="form-signin" method="POST" action="">
        <br><br>
        <!--<h2 class="form-signin-heading"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Efetue login</h2>-->
        <h2 class="form-signin-heading">RoomManager</h2>
        <br><input class="form-control" name="usuario" placeholder="Username"  autofocus>
        <br><input type="password" class="form-control" name="senha" placeholder="Senha">
       
        <br><br>
        <button name="enviar" class="btn btn-lg btn-success" type="submit">Entrar</button>
        <button name="calendario" class="btn btn-lg btn-primary" type="submit">Calendário</button>
      </form>

    </div> <!-- /container -->
  </body>

</html>

<?php
error_reporting(0);
  if(isset($_POST["enviar"])) {
    header('Content-Type: text/html; charset=utf-8');

    $username = $_POST['usuario']; 
    $passwd = $_POST['senha'];

    require "class_banco.php";
    require "class_usuario.php";
    require "class_sala.php";

    $conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco

    try {
      $conexao->Conecta(); //abre conexão ao banco
    } catch (Exception $erro) {
      echo $erro->getMessage();
    exit();
    }

    $usuarios=new Usuario();
    $usuarios->validaUsuario($username,$passwd);
  }

  if(isset($_POST["calendario"])) {
    header('Location: ambiente/calendar.php');
  }
?>