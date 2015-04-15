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

	<div class="main">
		<form method="POST" action="">
			<center><h3><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar ambiente</h3></center><br>
			<div class="form-group">
				<?php
				
					require "../class_banco.php";
					require "../class_sala.php";
					
	      			$conexao=new Banco($ip,$usuario,$senha,$bd); 
	      			$conexao->Conecta();
	      
	      			$query = "SELECT id,descricao FROM tipo_sala";
	      			$consulta = mysql_query($query) or die(mysql_error ());

				?>

				<b>Tipo de ambiente:</b><select class="form-control input-sm" name="tipo">

				<?php
  					echo '<option value="all">Todos</option>';

  					// Armazena os dados da consulta em um array associativo
  					while($registro = mysql_fetch_assoc($consulta)) {
        				echo '<option value='.$registro["id"].'>'.$registro["descricao"].'</option>';
  					}
  				?>
				</select>
				
				<table align="center">
					<tr><td colspan="2" align="center"><h4>Recursos:</h4></td></tr>
					<tr>
						<td><input type="checkbox" name="recursos[]" value="Quadro branco">Quadro branco</td>
						<td><input type="checkbox" name="recursos[]" value="Projetor">Projetor</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="recursos[]" value="Sistema de som">Sistema de som&nbsp;&nbsp;&nbsp;</td>
						<td><input type="checkbox" name="recursos[]" value="Computador">Computador(es)</td>
					</tr>
				</table>
				<br>
				<b>Capacidade:</b><input type="text" class="form-control input-sm" name="capacidade" placeholder="Capacidade" title="Capacidade"><br>
				<?php
      				$query = "SELECT id,descricao FROM blocos";
      				$consulta = mysql_query($query) or die(mysql_error ());
      			?>

				<b>Bloco:</b><select class="form-control input-sm" name="bloco">

				<?php
      				echo '<option value="all">Todos</option>';
  
      				// Armazena os dados da consulta em um array associativo
      				while($registro = mysql_fetch_assoc($consulta)) {
	        			echo '<option value='.$registro["id"].'>'.$registro["descricao"].'</option>';
      				}
      			?>
				</select><br>
			</div>
			<center>
				<button type="submit" name="enviar" class="btn btn-success">Enviar</button>
				<a href="../inicio.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
			</center>
		</form>
	</div>

</html>

<?php
	error_reporting(0);
	if(isset($_POST["enviar"])) {
		$recursos=array();

		$id_tipo=$_POST['tipo'];
		
		$recursos = implode($_POST["recursos"], ",");
		
		$capacidade=$_POST['capacidade'];
		$id_bloco=$_POST['bloco'];

		$recursos;
		
		$sala=new Sala();
		$sala->buscaSala($id_tipo,$recursos,$capacidade,$id_bloco);
		
		$conexao->Disconecta(); //fecha conexão
	}
?>