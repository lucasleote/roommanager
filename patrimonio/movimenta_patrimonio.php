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
			<center><h3><span class="glyphicon glyphicon-sort" aria-hidden="true"></span> Movimentar patrimônio</h3></center><br>
			<div class="form-group">
				<?php
				
					require "../class_banco.php";
					require "../class_patrimonio.php";
					
	      			$conexao=new Banco($ip,$usuario,$senha,$bd); 
	      			$conexao->Conecta();
	      
	      			$query = "SELECT id,nome FROM patrimonios";
	      			$consulta = mysql_query($query) or die(mysql_error ());

				?>

				<select class="form-control input-sm" name="patrimonio">

				<?php
  					echo '<option>Patrimônio</option>';

  					// Armazena os dados da consulta em um array associativo
  					while($registro = mysql_fetch_assoc($consulta)) {
        				echo '<option value='.$registro["id"].'>'.$registro["id"].' - '.$registro["nome"].'</option>';
  					}
  				?>
				</select><br>
				
				<select class="form-control input-sm" name="tipo">
					<option value="null">Tipo de movimento</option>
					<option value="entrada">Entrada</option>
					<option value="saida">Saída</option>
				</select><br>

				<input type="text" class="form-control input-sm" name="quantidade" placeholder="Quantidade" title="Quantidade" required><br>

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
		
		$id_patrimonio=$_POST['patrimonio'];
		$tipo=$_POST['tipo'];
		$quantidade=$_POST['quantidade'];
		$obs=$_POST['obs'];
		
		date_default_timezone_set('America/Sao_Paulo');

		$data = date("Y/m/d");
		$hora = date("H:i");

		$movimento=new Patrimonio();
		$movimento->movimentaPatrimonio($tipo,$id_patrimonio,$quantidade,$obs,$data,$hora);
		
		$conexao->Disconecta();
	}
?>