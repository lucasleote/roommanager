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
			<center><h3><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Cadastro de novo bloco</h3></center><br>
			<div class="form-group">
				<input type="text" class="form-control input-sm" name="numero" placeholder="Número" title="Número" required><br>
				<input type="text" class="form-control input-sm" name="descricao" placeholder="Descrição" title="Descrição" required><br>	
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

	require "../class_banco.php";
	require "../class_sala.php";

	$conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco
	
	try {
		$conexao->Conecta(); //abre conexão ao banco
	} catch (Exception $erro) {
		echo $erro->getMessage();
		exit();
	}

	$descricao=$_POST['descricao'];
	$id=$_POST['numero'];

	$bloco=new Sala();
	$bloco->insereBloco($id,$descricao);
	
	$conexao->Disconecta(); //fecha conexão
	}
?>