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
  require "../class_patrimonio.php";
   
  $conexao=new Banco($ip,$usuario,$senha,$bd); 
  $conexao->Conecta();
      
  $query = "SELECT patrimonios.id, patrimonios.nome, tipo_patrimonio.id AS idpatrimonio, tipo_patrimonio.descricao, patrimonios.obs
  FROM patrimonios,tipo_patrimonio
  WHERE patrimonios.id_tipo = tipo_patrimonio.id AND patrimonios.id='$id' ";
  $consulta = mysql_query($query) or die(mysql_error ());
      

  while($registro = mysql_fetch_assoc($consulta)) {

  echo "
  <div class='main' align='center'>
    <center><h2>Altera patrimônio</h2></center><br>
    <form class='form-inline' method='POST' action=''>
      <table>
        <tr><td align='right'><label>ID:&nbsp;</label></td><td><input type='text' name='id' class='form-control input-sm' value=".$id." required disabled=disable></td></tr>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Nome:&nbsp;</label></td><td><input type='text' name='nome' class='form-control input-sm' value=".$registro['nome']." required></tr></td>
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Tipo:&nbsp;</label></td><td><select class='form-control input-sm' name='tipo'>";
        $query = "SELECT id,descricao FROM tipo_patrimonio";
                $consulta = mysql_query($query) or die(mysql_error ());
                
                echo '<option value='.$registro["idpatrimonio"].'>'.$registro["descricao"].'</option>';
                while($result = mysql_fetch_assoc($consulta)) {
                  echo '<option value='.$result["id"].'>'.$result["descricao"].'</option>';
                } echo "
        <tr><td>&nbsp;</td></tr>
        <tr><td align='right'><label>Obs.:&nbsp;</label></td><td><textarea class='form-control input-sm' rows='3' name='obs'>".$registro['obs']."</textarea></tr></td>
      </table>
      <br><br><button type='submit' name='enviar' class='btn btn-success'>Enviar</button>
      <a href='lista_patrimonio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a>
    </form>
  </div>";
  }
  ?>

  <?php
    if(isset($_POST["enviar"])) {

      $id=$_GET['id'];

      $nome=$_POST['nome'];
      $id_tipo=$_POST['tipo'];
      $obs=$_POST['obs'];

      $patrimonio=new Patrimonio();
      $patrimonio->alteraPatrimonio($id,$nome,$id_tipo,$obs);
      
      $conexao->Disconecta();
    }

  ?>

</html>