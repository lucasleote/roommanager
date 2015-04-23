<?php
	require "../class_banco.php";
	require "../class_sala.php";
	require "../class_usuario.php";
	
	$conexao=new Banco($ip,$usuario,$senha,$bd); 
	$con = $conexao->Conecta();
	

	date_default_timezone_set('America/Sao_Paulo');
	$data=date("Y-m-d");
?>

<!DOCTYPE HTML>
<html lang="pt-BR">

  <head>
  	<link rel="shortcut icon" href="../img/icon_if.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomManager - Calendário</title>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/mascara.js"></script>
  </head>

	<center>
		<h3><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendário de reservas</h3>
	</center>
	
	<br>
	
	<center>
		<form class="form-inline" action="" method="POST">
  			<?php
      				$query = "SELECT id,descricao FROM blocos";
      				$consulta = mysqli_query($con,$query) or die(mysql_error ());
      			?>

				<b>Bloco:</b> <select class="form-control input-sm" name="bloco">

				<?php
      				// Armazena os dados da consulta em um array associativo
      				while($registro = mysqli_fetch_assoc($consulta)) {
	        			echo '<option value='.$registro["id"].'>'.$registro["descricao"].'</option>';
      				}
      			?>
      			</select>
  			<b>Data: </b><input type="date" name="data" class="form-control input-sm">
  			<button type="submit" name="enviar" class="btn btn-success btn-sm" title="Go!"><span class='glyphicon glyphicon-ok' aria-hidden='true'></span></button>
  			<a href="../index.php"><button type="button" class="btn btn-danger btn-sm" title="Voltar"><span class='glyphicon glyphicon-chevron-left' aria-hidden='true'></span></button></a>
		</form>
	</center>

	<table class="main" align="center">
	<?php
		if(isset($_POST["enviar"])) {

			$data=$_POST['data'];
			$bloco=$_POST['bloco'];

			$salas=new Sala();
			$salas->listaSalaBlocoFora($con,$data,$bloco);
		
			$conexao->Disconecta(); //fecha conexão

		}
	?>
	</table>
</html>