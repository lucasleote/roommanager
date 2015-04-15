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
			<center><h3><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Cadastro de novo patrimônio</h3></center><br>
			<div class="form-group">
				<input type="text" class="form-control input-sm" name="nome" placeholder="Nome" title="Nome" required><br>
				<?php
				
					require "../class_banco.php";
					require "../class_patrimonio.php";
					
	      			$conexao=new Banco($ip,$usuario,$senha,$bd); 
	      			$conexao->Conecta();
	      
	      			$query = "SELECT id,descricao FROM tipo_patrimonio";
	      			$consulta = mysql_query($query) or die(mysql_error ());

				?>

				<select class="form-control input-sm" name="tipo">

				<?php
  					echo '<option>Categoria</option>';

  					// Armazena os dados da consulta em um array associativo
  					while($registro = mysql_fetch_assoc($consulta)) {
        				echo '<option value='.$registro["id"].'>'.$registro["descricao"].'</option>';
  					}
  				?>
				</select><br>
				<textarea class="form-control input-sm" rows="3" name="obs" placeholder="Obs."></textarea><br>
			</div>
			<center>
				<button type="submit" name="enviar" class="btn btn-success">Enviar</button>
				<a href="../inicio.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
			</center>
		</form>
	</div>

</html>

<?php
	if(isset($_POST["enviar"])) {
		
		$nome=$_POST['nome'];
		$id_tipo=$_POST['tipo'];
		$obs=$_POST['obs'];
		
		date_default_timezone_set('America/Sao_Paulo');

		$data = date("Y/m/d");
		$hora = date("H:i");

		$patrimonio=new Patrimonio();
		$patrimonio->inserePatrimonio($nome,$id_tipo,$obs,$data,$hora);
		
		$conexao->Disconecta();
	}
?>