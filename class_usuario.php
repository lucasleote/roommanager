<!DOCTYPE HTML>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/estilo.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
</head>

<?php
#--------------------------------------C L A S S E   U S U A R I O--------------------------------------------------------#
	Class Usuario
	{
		//Atributos
		Private $id;
		Private $nome;
		Private $cpf;
		Private $telefone;
		Private $email;
		Private $username;
		Private $passwd;
		Private $obs;
		Private $data;
		Private $hora;
		Private $id_tipo;

		//Método que valida usuário e senha no login
		function validaUsuario($username,$passwd,$modulo)
		{
			$passwd = md5($passwd);

			$query = "SELECT id,username,passwd,id_tipo,nome FROM usuarios WHERE username='$username' and passwd='$passwd'";
			
			$retorno = mysql_query($query);
			
			if (mysql_affected_rows()>0) {				
				while ($result = mysql_fetch_assoc($retorno))
				{

					session_start();
					$_SESSION['id_tipo'] = $result['id_tipo'];
					$_SESSION['id'] = $result['id'];
					$_SESSION['nome'] = $result['nome'];
				}

				$_SESSION['login'] = $username;				

				header('Location: painel.php');
			}
			
			else { 
				echo "<script language='javascript'>
				alert('Usuário e/ou senha incorreto(s)! Tente novamente.');
				window.location='index.php'
				</script>";
			}
		}

		//Método que insere novo usuário no banco
		function insereUsuario($nome,$cpf,$telefone,$email,$username,$passwd,$obs,$data,$hora,$id_tipo)
		{
			$query = "SELECT username FROM usuarios WHERE username='$username' ";
			
			mysql_query($query);
			
			if (mysql_affected_rows()>0) {
				echo '<script language="javascript">
				alert("Usuário já existente com esse username!\n\nEscolha outro.");
				</script>';
			}
			
			else { 

				$sql="INSERT INTO usuarios (id,nome,cpf,telefone,email,username,passwd,obs,data,hora,id_tipo) VALUES ('NULL','$nome','$cpf','$telefone','$email','$username','$passwd','$obs','$data','$hora','$id_tipo')";
				mysql_query($sql) or die(mysql_error ());

				echo "<script language='javascript'>
				alert('Usuário cadastrado com sucesso!');
				window.location='../inicio.php';
				</script>";
			}

		}

		//Método que altera cadastro do usuário
		function alteraUsuario($id,$nome,$cpf,$telefone,$email,$obs,$id_tipo)
		{
			$sql="UPDATE usuarios SET usuarios.nome='$nome',usuarios.cpf='$cpf',usuarios.telefone='$telefone',usuarios.email='$email',usuarios.obs='$obs',usuarios.id_tipo='$id_tipo' WHERE usuarios.id='$id'";
			mysql_query($sql) or die(mysql_error ());

			echo "<script language='javascript'>
			alert('Cadastro alterado com sucesso!');
			window.location='../admin/listar_usuarios.php';
			</script>";
		}

		//Método que deleta cadastro do usuário
		function excluiUsuario($id,$nome)
		{
			$sql="DELETE FROM usuarios WHERE usuarios.id='$id' AND usuarios.nome='$nome' ";
			mysql_query($sql) or die(mysql_error ());

			echo "<script language='javascript'>
			alert('Usuário excluído com sucesso!');
			window.location='listar_usuarios.php';
			</script>";
		}

		//Método que lista usuários cadastrados
		function listaUsuario()
		{ 	
			echo "<br><center><h3><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Usuários cadastrados no sistema</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed"" align="center">';
			echo '<tr class="success">';
			echo '<td align="center"><b>ID</b></td>';
			echo '<td align="center"><b>NOME</b></td>';
			echo '<td align="center"><b>CPF</b></td>';
			echo '<td align="center"><b>TELEFONE</b></td>';
			echo '<td align="center"><b>E-MAIL</b></td>';
			echo '<td align="center"><b>USERNAME</b></td>';
			echo '<td align="center"><b>PERFIL</b></td>';
			echo '<td align="center"><b>OBS.</b></td>';
			echo '<td align="center"><b>DATA</b></td>';
			echo '<td align="center"><b>HORA</b></td>';
			echo '<td colspan="2" align="center"><b>AÇÕES</b></td>';
			echo '</tr>';

			$select = 'SELECT usuarios.id, usuarios.nome, usuarios.cpf, usuarios.telefone, usuarios.email, usuarios.username, usuarios.passwd, usuarios.obs, DATE_FORMAT(usuarios.data,"%d/%m/%y") AS data, DATE_FORMAT(usuarios.hora,"%H:%i") AS hora, tipo_usuario.descricao FROM usuarios,tipo_usuario WHERE usuarios.id_tipo = tipo_usuario.id ORDER BY id DESC';

			$retorno = mysql_query($select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysql_fetch_assoc($retorno))
			{
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['id']."</td>";
				echo "<td>".$result['nome']."</td>";
				echo "<td>".$result['cpf']."</td>";
				echo "<td>".$result['telefone']."</td>";
				echo "<td>".$result['email']."</td>";
				echo "<td>".$result['username']."</td>";
				echo "<td>".$result['descricao']."</td>";
				echo "<td>".$result['obs']."</td>";
				echo "<td>".$result['data']."</td>";
				echo "<td>".$result['hora']."</td>";
			

				echo "<td>
					<a href='altera_usuario.php?id=".$result['id']."'>
						<button title='Alterar' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-edit' title='Alterar'></i></button>
					</a>
				</td>";

				echo "<td>
					<a href='exclui_usuario.php?id=".$result['id']."&nome=".$result['nome']."'>
						<button title='Excluir' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-remove' title='Excluir'></i></button>
					</a>
				</td>";
				}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="11" align="center"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}

		//Método que insere novo tipo de usuário no banco
		function insereTipo($descricao)
		{
			$query = "SELECT descricao FROM tipo_usuario WHERE descricao LIKE '$descricao' ";
			
			mysql_query($query);
			
			if (mysql_affected_rows()>0) {
				echo '<script language="javascript">
				alert("Tipo de usuário já existente com esse nome!\n\nEscolha outro.");
				</script>';
			}
			
			else { 

				$sql="INSERT INTO tipo_usuario (id,descricao) VALUES ('NULL','$descricao')";
				mysql_query($sql) or die(mysql_error ());

				echo '<script language="javascript">
				alert("Tipo de usuário cadastrado com sucesso!");
				</script>';
			}

		}

		//Método que lista tipos de usuários
		function listaTipo()
		{ 	
			echo "<br><center><h3><span class='glyphicon glyphicon-user' aria-hidden='true'></span> Perfis de usuário</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed" align="center">';
			echo '<tr class="success">';
			echo '<td><b>ID</b></td>';
			echo '<td><b>DESCRIÇÃO</b></td>';
			echo '</tr>';

			$select = 'SELECT tipo_usuario.id, tipo_usuario.descricao FROM tipo_usuario ORDER BY id DESC';

			$retorno = mysql_query($select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysql_fetch_assoc($retorno))
			{
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['id']."</td>";
				echo "<td>".$result['descricao']."</td>";
				echo "</tr>";
			}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="2"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}

		function minhasReservas($id_usuario){
			echo "<br><center><h3><span class='glyphicon glyphicon-folder-open' aria-hidden='true'></span> &nbsp;Minhas reservas</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed" align="center">';
			echo '<tr class="success">';
			echo '<td align="center"><b>SALA</b></td>';
			echo '<td align="center"><b>BLOCO</b></td>';
			echo '<td align="center"><b>DATA AGENDAMENTO</b></td>';
			echo '<td align="center"><b>DATA USO</b></td>';
			echo '<td align="center"><b>HORA USO</b></td>';
			echo '<td align="center"><b>TEMPO DE USO</b></td>';
			echo '<td align="center"><b>MOTIVO</b></td>';
			echo '<td align="center"><b>OBS.</b></td>';
			echo '<td align="center"><b>AÇÕES</b></td>';
			echo '</tr>';

			$select = "SELECT agenda.id AS id_agenda,salas.id,salas.nome,blocos.id,blocos.descricao,DATE_FORMAT(agenda.data_age,'%d/%m/%Y') AS data_age,DATE_FORMAT(agenda.data_uso,'%d/%m/%Y') AS data_uso,DATE_FORMAT(agenda.hora_uso,'%H:%i') AS hora_uso,agenda.tempo_uso,agenda.motivo,agenda.obs FROM salas,blocos,agenda WHERE agenda.id_sala = salas.id AND salas.id_bloco = blocos.id AND agenda.id_usuario = '$id_usuario' AND agenda.tempo_uso > 0 ORDER BY agenda.data_age DESC";

			$retorno = mysql_query($select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysql_fetch_assoc($retorno))
			{
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['nome']."</td>";
				echo "<td>".$result['descricao']."</td>";
				echo "<td>".$result['data_age']."</td>";
				echo "<td>".$result['data_uso']."</td>";
				echo "<td>".$result['hora_uso']."</td>";
				echo "<td>".$result['tempo_uso']." período(s)</td>";
				echo "<td>".$result['motivo']."</td>";
				echo "<td>".$result['obs']."</td>";
				
				echo "<td align='center'>
					<a href='excluir_reserva.php?id_agenda=".$result['id_agenda']."&tempo_uso=".$result['tempo_uso']."'>
						<button title='Cancelar reserva' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-remove' title='Cancelar reserva'></i></button>
					</a>
				</td>
				</tr>";
			}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="8" align="center"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}

		function excluiReserva($id_agenda,$tempo_uso) {
			$delete = "DELETE FROM agenda WHERE agenda.id = '$id_agenda'";
			mysql_query($delete) or die (mysql_error());

			if ($tempo_uso>1) {
				for ($aux=1;$aux<$tempo_uso;$aux++){
					$id_agenda=$id_agenda+1;
					$delete = "DELETE FROM agenda WHERE agenda.id = '$id_agenda'";
					mysql_query($delete) or die (mysql_error());
				}
			}
			echo "<script language='javascript'>
			alert('Reserva cancelada com sucesso!');
			window.location='minhas_reservas.php';
			</script>";
		}
	}
?>