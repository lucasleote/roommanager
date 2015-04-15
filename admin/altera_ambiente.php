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
    <script src="checkbox.js"></script>
  </head>

  <?php 

  $id=$_GET['id'];

  require "../class_banco.php";
  require "../class_sala.php";
  require "../class_usuario.php";
   
  $conexao=new Banco($ip,$usuario,$senha,$bd); 
  $conexao->Conecta();
      
  $query = "SELECT salas.id, salas.nome, tipo_sala.descricao, tipo_sala.id as idsala, salas.capacidade, blocos.descricao as bloco, blocos.id as idbloco, salas.obs FROM salas,tipo_sala,blocos WHERE salas.id_tipo = tipo_sala.id AND salas.id_bloco = blocos.id AND salas.id='$id' ";
    $consulta = mysql_query($query) or die(mysql_error ());
      

  while($registro = mysql_fetch_assoc($consulta)) {

  echo "
  <div class='main' align='center'>
    <center><h2>Altera ambiente</h2></center><br>
    <form class='form-inline' method='POST' action=''>
      <table align='center'>
        <tr><td align='right'><label>ID:&nbsp;</label></td><td><input type='text' name='id' class='form-control input-sm' value=".$id." required disabled=disable></td></tr>
        <tr><td>&nbsp;</td></tr>
        
        <tr><td align='right'><label>Nome:&nbsp;</label></td><td><input type='text' name='nome' class='form-control input-sm' value=".$registro['nome']." required></tr></td>
        <tr><td>&nbsp;</td></tr>
        
        <tr><td align='right'><label>Tipo:&nbsp;</label></td><td><select class='form-control input-sm' name='tipo'>";
        $query = "SELECT id,descricao FROM tipo_sala";
                $consulta = mysql_query($query) or die(mysql_error ());
                
                echo '<option value='.$registro["idsala"].'>'.$registro["descricao"].'</option>';
                while($result = mysql_fetch_assoc($consulta)) {
                  echo '<option value='.$result["id"].'>'.$result["descricao"].'</option>';
                } echo "
        <tr><td>&nbsp;</td></tr>

        <table align='center'>
          <tr><td colspan='2' align='center'><h4>Recursos</h4></td></tr>";
            $select = 'SELECT recursos.id, recursos.nome FROM recursos ORDER BY id ASC';

            $retorno = mysql_query($select) or die (mysql_error());
            
            $i=0;
            
            while ($result = mysql_fetch_assoc($retorno))
            {
              echo "<tr id=".$result['nome'].">";
              echo "<td><input type='checkbox' id=cb".$result['nome']." name='recursos".$i++."' value=".$result['id'].">&nbsp;".$result['nome']."</td>";
              echo "</tr>";
            }
        echo "</table><table>
        <tr><td>&nbsp;</td></tr>
        
        <tr><td align='right'><label>Capacidade:&nbsp;</label></td><td><input type='text' name='capacidade' class='form-control input-sm' value=".$registro['capacidade']." required></tr></td>
        <tr><td>&nbsp;</td></tr>
        
        <tr><td align='right'><label>Bloco:&nbsp;</label></td><td><select class='form-control input-sm' name='bloco'>";
        $query = "SELECT id,descricao FROM blocos";
                $consulta = mysql_query($query) or die(mysql_error ());
                
                echo '<option value='.$registro["idbloco"].'>'.$registro["bloco"].'</option>';
                while($result = mysql_fetch_assoc($consulta)) {
                  echo '<option value='.$result["id"].'>'.$result["descricao"].'</option>';
                }
                echo "
        <tr><td>&nbsp;</td></tr>
        
        <tr><td align='right'><label>Obs.:&nbsp;</label></td><td><textarea class='form-control input-sm' rows='3' name='obs'>".$registro['obs']."</textarea></tr></td>
      </table>
      
      <br><br><button type='submit' name='enviar' class='btn btn-success'>Enviar</button>
      <a href='listar_ambientes.php'><button type='button' class='btn btn-danger'>Cancelar</button></a>
    </form>
  </div>";
  }
  ?>

  <?php
    if(isset($_POST["enviar"])) {

      $id=$_GET['id'];

      $nome=$_POST['nome'];
      $id_tipo=$_POST['tipo'];
      //$recursos=$_POST['recursos'];
      $capacidade=$_POST['capacidade'];
      $obs=$_POST['obs'];
      $id_bloco=$_POST['bloco'];

      $salas=new Sala();
      $salas->alteraSala($id,$nome,$id_tipo,$capacidade,$obs,$id_bloco);
      
      $conexao->Disconecta();
    }

  ?>

</html>