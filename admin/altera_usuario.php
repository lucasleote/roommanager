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

  require "../class_banco.php";
  require "../class_sala.php";
  require "../class_usuario.php";
   
  $conexao=new Banco($ip,$usuario,$senha,$bd); 
  $conexao->Conecta();
      
  $query = "SELECT usuarios.id, usuarios.nome, usuarios.cpf, usuarios.telefone, usuarios.email, usuarios.username, usuarios.passwd, usuarios.obs, tipo_usuario.descricao, tipo_usuario.id as idusuario FROM usuarios,tipo_usuario WHERE usuarios.id_tipo = tipo_usuario.id AND usuarios.id='$id' ";
  $consulta = mysql_query($query) or die(mysql_error ());
      

  while($registro = mysql_fetch_assoc($consulta)) {

  echo "
  <div class='main' align='center'>
    <center><h2>Altera usuário</h2></center><br>
    <form class='form-inline' method='POST' action=''>
      <table>
        <tr><td align='right'><label>ID:&nbsp;</label></td><td><input type='text' name='id' class='form-control input-sm' value=".$id." required disabled=disable></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Nome:&nbsp;</label></td><td><input type='text' name='nome' class='form-control input-sm' value=".$registro['nome']." required></tr></td>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>CPF:&nbsp;</label></td><td><input type='text' name='cpf' class='form-control input-sm' value=".$registro['cpf']." required></tr></td>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Telefone:&nbsp;</label></td><td><input type='text' name='telefone' class='form-control input-sm' value=".$registro['telefone']." required></tr></td>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>E-mail:&nbsp;</label></td><td><input type='email' name='email' class='form-control input-sm' value=".$registro['email']." required></tr></td>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Username:&nbsp;</label></td><td><input type='text' name='username' class='form-control input-sm' value=".$registro['username']." required disabled=disable></tr></td>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Senha:&nbsp;</label></td><td><input type='text' class='form-control input-sm' value='*****' required disabled=disable></tr></td>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Perfil:&nbsp;</label></td><td><select class='form-control input-sm' name='tipo'>";
        $query = "SELECT id,descricao FROM tipo_usuario";
        $consulta = mysql_query($query) or die(mysql_error ());

        echo '<option value='.$registro["idusuario"].'>'.$registro["descricao"].'</option>';
        while($result = mysql_fetch_assoc($consulta)) {
          echo '<option value='.$result["id"].'>'.$result["descricao"].'</option>';
        } echo "
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Obs.:&nbsp;</label></td><td><textarea class='form-control input-sm' rows='3' name='obs'>".$registro['obs']."</textarea></tr></td>
      </table>
      <br><br><button type='submit' name='enviar' class='btn btn-success'>Enviar</button>
      <a href='listar_usuarios.php'><button type='button' class='btn btn-danger'>Cancelar</button></a>
    </form>
  </div>";
  }
  ?>

  <?php
    if(isset($_POST["enviar"])) {

      $id=$_GET['id'];

      $nome=$_POST['nome'];
      $cpf=$_POST['cpf'];
      $telefone=$_POST['telefone'];
      $email=$_POST['email'];
      $obs=$_POST['obs'];
      $id_tipo=$_POST['tipo'];

      $usuarios=new Usuario();
      $usuarios->alteraUsuario($id,$nome,$cpf,$telefone,$email,$obs,$id_tipo);

      $conexao->Disconecta();

    }
  ?>

</html>