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
			<center><h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Cadastro de novo usuário</h3></center><br>
			<div class="form-group">
				<input type="text" class="form-control input-sm" name="nome" placeholder="Nome" title="Nome" required><br>			
				<input type="text" class="form-control input-sm" name="cpf" placeholder="CPF" title="CPF" maxlength="14" onkeypress="return valCPF(event,this);return false;" required><br>
				<input type="text" class="form-control input-sm" name="telefone" placeholder="Telefone" title="Telefone" maxlength="14" onkeypress="return valPHONE(event,this); return false;" required><br>
				<input type="email" class="form-control input-sm" name="email" placeholder="E-mail" title="E-mail" required><br>
				<input type="text" class="form-control input-sm" name="username" placeholder="Username" title="Username" required><br>
				<input type="password" class="form-control input-sm" name="passwd" placeholder="Senha" title="Senha" required><br>
				<?php
					require "../class_banco.php";
					require "../class_usuario.php";
					require "../class_sala.php";
					
					$conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco
	
					try {
						$con = $conexao->Conecta(); //abre conexão ao banco
					} catch (Exception $erro) {
						echo $erro->getMessage();
						exit();
					}

					$query = "SELECT id,descricao FROM tipo_usuario";
					$consulta = mysqli_query($con,$query) or die(mysql_error ());

				?>
				<select class="form-control input-sm" name="tipo">
				<?php
					echo '<option value="null">Perfil</option>';

					// Armazena os dados da consulta em um array associativo
					while($registro = mysqli_fetch_assoc($consulta)) {
						echo '<option value='.$registro["id"].'>'.$registro["descricao"].'</option>';
					}

					$conexao->Disconecta();
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
		$cpf=$_POST['cpf'];
		$telefone=$_POST['telefone'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$passwd=md5($_POST['passwd']);
		$obs=$_POST['obs'];
		$id_tipo=$_POST['tipo'];

		date_default_timezone_set('America/Sao_Paulo');

		$data = date("Y/m/d");
		$hora = date("H:i");

		$conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco
	
		try {
			$con = $conexao->Conecta(); //abre conexão ao banco
		} catch (Exception $erro) {
			echo $erro->getMessage();
			exit();
		}

		$usuarios=new Usuario();
		$usuarios->insereUsuario($con,$nome,$cpf,$telefone,$email,$username,$passwd,$obs,$data,$hora,$id_tipo);
		
		$conexao->Disconecta();
	}
?>