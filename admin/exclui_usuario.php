<!DOCTYPE HTML>
<html lang="pt-BR">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomManager</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mascara.js"></script>
  </head>

  <?php 
    $id=$_GET['id'];
    $nome=$_GET['nome'];
  ?>

  <div class="main">
    <form method="POST" action="">
      <center><h2>Confirma exclusão do usuário <?php echo "<i>$nome</i>?"; ?></h2></center>
      <center>
      <button type="submit" name="enviar" class="btn btn-success">Sim</button>
      <a href="listar_usuarios.php"><button type="button" class="btn btn-danger">Não</button></a>
      </center>
    </form>
  </div>

  <?php
  if(isset($_POST["enviar"])) {
    require "../class_banco.php";
    require "../class_usuario.php";
    require "../class_sala.php";

    $conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco
  
    try {
      $conexao->Conecta(); //abre conexão ao banco
    } catch (Exception $erro) {
      echo $erro->getMessage();
      exit();
    }

    $usuarios=new Usuario();
    $usuarios->excluiUsuario($id,$nome);
    
    $conexao->Disconecta();
  }
?>

</html>