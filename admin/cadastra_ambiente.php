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

	<div class="main">
		<form method="POST" action="">
			<center><h3><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Cadastro de novo ambiente</h3></center><br>
			<div class="form-group">
				<input type="text" class="form-control input-sm" name="nome" placeholder="Nome" title="Nome" required><br>			
				<?php
				
					require "../class_banco.php";
					require "../class_sala.php";
					
	      			$conexao=new Banco($ip,$usuario,$senha,$bd); 
	      			$con = $conexao->Conecta();
	      
	      			$query = "SELECT id,descricao FROM tipo_sala";
	      			$consulta = mysqli_query($con,$query) or die(mysql_error ());

				?>

				<select class="form-control input-sm" name="tipo">

				<?php
  					echo '<option>Tipo</option>';

  					// Armazena os dados da consulta em um array associativo
  					while($registro = mysqli_fetch_assoc($consulta)) {
        				echo '<option value='.$registro["id"].'>'.$registro["descricao"].'</option>';
  					}
  				?>
				</select>
				
				<table align="center">
					<tr><td colspan="2" align="center"><h4>Recursos</h4></td></tr>
					<?php
						$select = 'SELECT recursos.id, recursos.nome FROM recursos ORDER BY id ASC';

						$retorno = mysqli_query($con,$select) or die (mysql_error());
						
						$i=0;
						
						while ($result = mysqli_fetch_assoc($retorno))
						{
							echo "<tr id=".$result['nome'].">";
							echo "<td><input type='checkbox' id=cb".$result['nome']." name='recursos".$i++."' value=".$result['id'].">&nbsp;".$result['nome']."</td>";
							echo "</tr>";
						}
					?>
				</table>
				<br>
				<input type="text" class="form-control input-sm" name="capacidade" placeholder="Capacidade" title="Capacidade" required><br>
				<?php
      				$query = "SELECT id,descricao FROM blocos";
      				$consulta = mysqli_query($con,$query) or die(mysql_error ());
      			?>

				<select class="form-control input-sm" name="bloco">

				<?php
      				echo '<option>Bloco</option>';
  
      				// Armazena os dados da consulta em um array associativo
      				while($registro = mysqli_fetch_assoc($consulta)) {
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
	error_reporting(0);
	if(isset($_POST["enviar"])) {
		$nome=$_POST['nome'];
		$id_tipo=$_POST['tipo'];
		
		$select = 'SELECT recursos.id, recursos.nome FROM recursos ORDER BY id ASC';
		$retorno = mysqli_query($con,$select) or die (mysql_error());
		$numeroRecursos = mysqli_num_rows($retorno);
		for($i=0;$i<$numeroRecursos;$i++){
			if(isset($_POST["recursos".$i])){
				$recursos[$i]=$_POST["recursos".$i]." ";
			}
		}

		var_dump($recursos);
		
		$capacidade=$_POST['capacidade'];
		$id_bloco=$_POST['bloco'];
		$obs=$_POST['obs'];

		if (isset($_POST['quantidade'])){
			$quantidade=$_POST['quantidade'];
		} else {
			$quantidade = 1;
		}

		var_dump($quantidade);

		date_default_timezone_set('America/Sao_Paulo');

		$data = date("Y/m/d");
		$hora = date("H:i");

		$sala=new Sala();
		$sala->insereSala($con,$nome,$id_tipo,$capacidade,$obs,$data,$hora,$id_bloco);

		$recurso=new Sala();
		$recurso->gravaRecurso($con,$recursos,$quantidade);
		
		$conexao->Disconecta(); //fecha conexão
	}
?>