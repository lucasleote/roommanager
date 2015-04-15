<?php
	$id_bloco=$_GET['id_bloco'];
	session_start();
	$_SESSION['id'];
	$_SESSION['login'];
	$_SESSION['nome'];

	require "../class_banco.php";
	require "../class_sala.php";
	require "../class_usuario.php";

	$conexao=new Banco($ip,$usuario,$senha,$bd); 
	$conexao->Conecta();
?>

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
			<center><h3><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Reservar ambiente</h3></center><br>
			<div class="form-group">
				Nome: <input type="text" class="form-control input-sm" name="nome" placeholder="Nome" title="Nome" value=<?php echo $_SESSION['nome'];?> disabled="disabled"><br>
				Ambiente:
				<?php      
					$select = "SELECT salas.nome, salas.id  FROM salas WHERE salas.id_bloco = '$id_bloco' ";
					$retorno = mysql_query($select) or die (mysql_error());
				?>
				<select class="form-control input-sm" name="id_sala">
					<?php
						echo '<option value="null">selecione...</option>';

						// Armazena os dados da consulta em um array associativo
						while ($result = mysql_fetch_assoc($retorno)){
						echo '<option value='.$result["id"].'>'.$result["nome"].'</option>';
						}
					?>
				</select>
				
				<br>Data de uso: <input type="date" name="data_uso" class="form-control input-sm">
				
				<br>Hora de uso: 
				<select class="form-control input-sm" name="hora_uso">
					<?php
						$select = "SELECT horario FROM horario ORDER BY id ASC";

						$retorno = mysql_query($select) or die (mysql_error());

						echo '<option value="null">selecione...</option>';
						while ($result = mysql_fetch_assoc($retorno)) {
						echo '<option value='.$result["horario"].'>'.$result["horario"].'</option>';
						}
					?>
				</select>

				<br>Tempo de uso <small>(em períodos)</small>: <input type="number" max="3" name="tempo_uso" class="form-control input-sm" placeholder="2">
				<br>Motivo:<textarea class="form-control input-sm" rows="3" name="motivo" placeholder="Motivo"></textarea><br>
				Observação:<textarea class="form-control input-sm" rows="3" name="obs" placeholder="Obs."></textarea><br>
			</div>
			<center>
			<button type="submit" name="enviar" class="btn btn-success">Enviar</button>
			<a href="calendario.php"><button type="button" class="btn btn-danger">Cancelar</button></a>
			</center>
		</form>
	</div>
</html>

<?php
	if(isset($_POST["enviar"])) {
		$_SESSION['id'];

		date_default_timezone_set('America/Sao_Paulo');

		$id_sala = $_POST['id_sala'];
		$id_usuario = $_SESSION['id'];
		$data_age = date("Y/m/d");
		$hora_age = date("H:i");
		$data_uso = $_POST['data_uso'];
		$hora_uso = $_POST['hora_uso'];
		$tempo_uso = $_POST['tempo_uso'];
		$motivo = $_POST['motivo'];
		$obs = $_POST['obs'];
		$id_bloco = $_POST['id_bloco'];

		$select = "SELECT id FROM horario ORDER BY horario LIKE '$hora_uso'";

		$retorno = mysql_query($select) or die (mysql_error());

		while ($result = mysql_fetch_assoc($retorno)) {
			$_SESSION['id_horario']=$result["id"];
		}

		$id_horario = $_SESSION['id_horario'];

		$reserva=new Sala();
		$reserva->insereAgenda($id_sala,$id_usuario,$data_age,$hora_age,$data_uso,$hora_uso,$tempo_uso,$motivo,$obs,$id_bloco,$id_horario);
		
		$conexao->Disconecta(); //fecha conexão
	}
?>