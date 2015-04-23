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
#--------------------------------------C L A S S E   S A L A--------------------------------------------------------#
	Class Sala
	{
		//Atributos
		Private $id;
		Private $nome;
		Private $id_tipo;
		Private $recursos;
		Private $capacidade;
		Private $obs;
		Private $data;
		Private $hora;
		Private $id_bloco;

		//Método que cadastra nova sala no banco
		function insereSala($con,$nome,$id_tipo,$capacidade,$obs,$data,$hora,$id_bloco)
		{			
			$query = "SELECT nome FROM salas WHERE nome='$nome' AND id_bloco='$id_bloco' ";
			
			mysqli_query($con,$query) or die(mysql_error ());
			
			if (mysqli_affected_rows()>0) {
				echo '<script language="javascript">
				alert("Ambiente já existente com esse nome nesse bloco!\n\nEscolha outro.");
				</script>';
			}
			
			else { 

				$sql="INSERT INTO salas (id,nome,id_tipo,capacidade,obs,data,hora,id_bloco) VALUES ('NULL','$nome','$id_tipo','$capacidade','$obs','$data','$hora','$id_bloco')";
				mysqli_query($con,$sql) or die(mysql_error ());

				/*echo "<script language='javascript'>
				alert('Ambiente cadastrado com sucesso!');
				window.location='../inicio.php';
				</script>";*/
			}
		}

		function gravaRecurso($con,$recursos,$quantidade)
		{
			global $id_sala;

			$select = "SELECT MAX(id) AS id FROM salas";
			$retorno = mysqli_query($con,$select) or die(mysql_error ());
			$retorno;

			while ($result = mysqli_fetch_assoc($retorno))
			{
				$id_sala = $result['id'];
			}

			//var_dump($recursos);

			foreach ($recursos as $i) {
			 	$i."<br>";
				if($i=='4 ') {
					$sql="INSERT INTO salarecurso (id,id_recurso,id_sala,quantidade) VALUES ('NULL','$i','$id_sala','$quantidade')";
				} else {
					$sql="INSERT INTO salarecurso (id,id_recurso,id_sala,quantidade) VALUES ('NULL','$i','$id_sala',1)";
				}
				mysqli_query($con,$sql);
			}	

			echo "<script language='javascript'>
				alert('Ambiente cadastrado com sucesso!');
				window.location='../inicio.php';
				</script>";	
		}

		//Método que altera cadasttro da sala
		function alteraSala($id,$nome,$id_tipo,$capacidade,$obs,$id_bloco)
		{
			$sql="UPDATE salas SET salas.nome='$nome',salas.id_tipo='$id_tipo',salas.capacidade='$capacidade',salas.obs='$obs',salas.id_bloco='$id_bloco' WHERE salas.id='$id'";
			mysql_query($sql) or die(mysql_error ());

			echo "<script language='javascript'>
				alert('Ambiente alterado com sucesso!');
				window.location='listar_ambientes.php';
				</script>";
		}

		//Método que deleta ambiente
		function excluiSala($id,$nome)
		{
			$sql2="DELETE FROM salarecurso WHERE salarecurso.id_sala='$id' ";
			mysql_query($sql2) or die(mysql_error ());

			$sql="DELETE FROM salas WHERE salas.id='$id' AND salas.nome='$nome' ";
			mysql_query($sql) or die(mysql_error ());

			echo "<script language='javascript'>
			alert('Ambiente excluído com sucesso!');
			window.location='listar_ambientes.php';
			</script>";
		}

		//Método que lista as salas cadastradas
		function listaSala($con)
		{ 
			echo "<br><center><h3><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Ambientes cadastrados no sistema</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed">';
			echo '<tr class="success">';
			echo '<td align="center"><b>ID</b></td>';
			echo '<td align="center"><b>NOME</b></td>';
			echo '<td align="center"><b>TIPO</b></td>';
			//echo '<td><b>ID RECURSO</b></td>';
			echo '<td align="center"><b>RECURSOS</b></td>';
			echo '<td align="center"><b>CAPACIDADE</b></td>';
			echo '<td align="center"><b>BLOCO</b></td>';
			echo '<td align="center"><b>OBS.</b></td>';
			echo '<td align="center"><b>DATA</b></td>';
			echo '<td align="center"><b>HORA</b></td>';
			echo '<td colspan="2" align="center"><b>AÇÕES</b></td>';
			echo '</tr>';

			$select = 'SELECT salas.id, salas.nome, tipo_sala.descricao AS saladesc, salas.capacidade, blocos.descricao AS blocodesc, salas.obs, DATE_FORMAT(salas.data,"%d/%m/%y") AS data, DATE_FORMAT(salas.hora,"%H:%i") AS hora 
			FROM salas,tipo_sala,blocos 
			WHERE salas.id_tipo = tipo_sala.id AND salas.id_bloco = blocos.id 
			ORDER BY id DESC';

			$retorno = mysqli_query($con,$select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysqli_fetch_assoc($retorno))
			{
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['id']."</td>";
				echo "<td>".$result['nome']."</td>";
				echo "<td>".$result['saladesc']."</td>";
				//echo "<td>".$result['id_recurso']."</td>";
				//echo "<td>".$result['recurso']."</td>";
				$select2='SELECT recursos.nome AS recurso, salarecurso.quantidade AS quantidade
				FROM recursos INNER JOIN
				salarecurso ON recursos.id=salarecurso.id_recurso
				WHERE salarecurso.id_sala="'.$result['id'].'" ';
				$retorno2 = mysqli_query($con,$select2) or die (mysql_error());
				echo "<td>";
				while ($result2 = mysqli_fetch_assoc($retorno2))
				{
					echo "- ".$result2['recurso']."[".$result2['quantidade']."]<br>";
				}
				echo "</td>";
				echo "<td>".$result['capacidade']."</td>";
				echo "<td>".$result['blocodesc']."</td>";
				echo "<td>".$result['obs']."</td>";
				echo "<td>".$result['data']."</td>";
				echo "<td>".$result['hora']."</td>";

				echo "<td>
					<a href='altera_ambiente.php?id=".$result['id']."'>
						<button title='Alterar' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-edit' title='Alterar'></i></button>
					</a>
				</td>";

				echo "<td>
					<a href='exclui_ambiente.php?id=".$result['id']."&nome=".$result['nome']."&bloco=".$result['blocodesc']."'>
						<button title='Excluir' class='btn btn-danger btn-xs'><i class='glyphicon glyphicon-remove' title='Excluir'></i></button>
					</a>
				</td>";
			}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="10" align="center"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}

		function buscaSala($con,$id_tipo,$recursos,$capacidade,$id_bloco)
		{ 	$capacidade1=$capacidade-10;
			$capacidade2=$capacidade+10;

			$select = "SELECT DISTINCT salas.id, salas.nome, salas.recursos, salas.capacidade, salas.id_bloco, salas.obs FROM salas 
			WHERE 1";

			if ($capacidade != '') {
				$select .= " AND salas.capacidade BETWEEN '$capacidade1' AND '$capacidade2'";
			}

			if ($id_tipo != 'all') {
				$select .= " AND salas.id_tipo = '$id_tipo'";
			}

			if ($id_bloco != 'all') {
				$select .= " AND salas.id_bloco = '$id_bloco'";
			}

			$select .= " ORDER BY id DESC;";

			$retorno = mysqli_query($con,$select) or die (mysql_error());
			
			$i=0;

			if (mysqli_affected_rows()>0) {

			echo "<br><center><h3><span class='glyphicon glyphicon-search' aria-hidden='true'></span> Ambientes encontrados</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed">';
			echo '<tr class="success">';
			echo '<td><b>ID</b></td>';
			echo '<td><b>NOME</b></td>';
			echo '<td><b>RECURSOS</b></td>';
			echo '<td><b>CAPACIDADE</b></td>';
			echo '<td><b>BLOCO</b></td>';
			echo '<td><b>OBS.</b></td>';
			echo '<td><b>DATA</b></td>';
			echo '<td><b>HORA</b></td>';
			echo '</tr>';

			while ($result = mysqli_fetch_assoc($retorno))
			{
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['id']."</td>";
				echo "<td>".$result['nome']."</td>";
				echo "<td>".$result['recursos']."</td>";
				echo "<td>".$result['capacidade']."</td>";
				echo "<td>Bloco ".$result['id_bloco']."</td>";
				echo "<td>".$result['obs']."</td>";
				echo "<td>".$result['data']."</td>";
				echo "<td>".$result['hora']."</td>";
				echo "</tr>";				
			}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="10" align="center"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='busca_ambiente.php'><button type='button' class='btn btn-warning'>Limpar</button></a></center>";

			}

			else {
				echo "<br><div class='alert alert-danger' align='center' role='alert'><b>Oops!</b> Sua consulta não retornou nenhum resultado!</div>";
			}
		}

		//Método que cadastra novo bloco no banco
		function insereBloco($id,$descricao)
		{
			$query = "SELECT descricao FROM blocos WHERE descricao LIKE '$descricao'";
			
			mysql_query($query) or die(mysql_error ());
			
			if (mysql_affected_rows()>0) {
				echo '<script language="javascript">
				alert("Bloco já existente com essa descrição!\n\nEscolha outra.");
				</script>';
			}
			
			else { 

				$sql="INSERT INTO blocos (id,descricao) VALUES ('$id','$descricao')";
				mysql_query($sql) or die(mysql_error ());

				echo "<script language='javascript'>
				alert('Bloco cadastrado com sucesso!');
				window.location='../inicio.php';
				</script>";
			}
		}


		//Método que lista os blocos cadastrados
		function listaBloco($con)
		{ 
			echo "<br><center><h3><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Blocos cadastrados no sistema</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed">';
			echo '<tr class="success">';
			echo '<td align="center"><b>ID</b></td>';
			echo '<td align="center"><b>DESCRIÇÃO</b></td>';
			echo '</tr>';

			$select = 'SELECT blocos.id, blocos.descricao FROM blocos ORDER BY id DESC';

			$retorno = mysqli_query($con,$select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysqli_fetch_assoc($retorno))
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

		//Método que calcula os horários dos períodos de aula
		function somaHorario($horario){
			if($horario=='09:45'){
				$horario =  date('H:i:s', strtotime('+15 minute', strtotime($horario)));
			} elseif($horario=='12:15'){
				$horario =  date('H:i:s', strtotime('+75 minute', strtotime($horario)));
			} elseif($horario=='15:45'){
				$horario =  date('H:i:s', strtotime('+15 minute', strtotime($horario)));
			} elseif($horario=='21:15'){
				$horario =  date('H:i:s', strtotime('+15 minute', strtotime($horario)));
			} else{
				$horario =  date('H:i:s', strtotime('+45 minute', strtotime($horario)));
			}

			return date('H:i',strtotime($horario));
		}
		
		//Método que verifica se é intervalo
		function intervalo($horario){
			if($horario=="09:45" || $horario=="12:15" || $horario=="15:45" || $horario=="21:15"){
				return 1;
			} else {
					return 0;
				}
		}

		//Método que verifica a agenda de salas
		function verificaAgenda($con,$data,$horario){
			$horario = date('H:i:s',strtotime($horario));

			$select = $sql = "SELECT usuarios.nome,agenda.motivo,agenda.id_sala,agenda.obs,agenda.tempo_uso FROM agenda,usuarios WHERE agenda.data_uso = '$data' AND agenda.hora_uso = '$horario' AND usuarios.id = agenda.id_usuario";
			
			$retorno = mysqli_query($con,$select) or die (mysql_error());
			$retorno = mysqli_fetch_assoc($retorno);
			return $retorno;
		}

		//Método que lista as salas de um bloco para verificar disponibilidade
		function listaSalaBloco($con,$data,$bloco)
		{ 
			$select = "SELECT salas.nome, salas.id  FROM salas WHERE salas.id_bloco = '$bloco' ";
			$retorno = mysqli_query($con,$select) or die (mysql_error());
			
			$count = mysqli_num_rows($retorno);
			$colspan=$count+1;

			echo "<br>";
			echo "<center><button title='Data' type='button' class='btn btn-large btn-primary disabled' disabled='disabled'><b>Bloco: ".$bloco." - Data: ".date("d/m/Y", strtotime($data))."</b></button>
			<a href='agendar_ambiente.php?id_bloco=".$bloco."'><button class='btn btn-warning btn-large' title='Agendar ambiente'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button></a></center>";
			echo "<br>";

			$horario = "07:30";

			echo '<table align="center" class="table table-hover table-bordered table-condensed">';
			echo "<tr class='success'><td><center><b>Horário</b></center></td>";

			while ($result = mysqli_fetch_assoc($retorno)){
				echo "<td><center><b>".$result['nome']."</b></center></td>";				
			}

			echo '</tr>';
	
			for ($i=1;$i<=22;$i++){
				$horario2 = $this->somaHorario($horario);
				echo "<tr>";
				echo "<td><center><b>".$horario." - ".$horario2."</b></center></td>";
					
				if ($this->intervalo($horario)==1){
					echo "<td colspan='".$count." align='center'><button title='Data' type='button' class='btn btn-sm btn-block btn-danger disabled' disabled='disabled'><center><b>I N D I S P O N Í V E L *</b></center></button></td>";
				}
				else{
					for ($j=1;$j<=$count;$j++){
					$retorno = $this->verificaAgenda($con,$data,$horario);
					echo "<td align='center'>";
					if($retorno!=NULL && $j==$retorno['id_sala']){
						if ($retorno['obs']==''){
							echo "<center>Utilizador: <b>".$retorno['nome']."</b><br>Motivo: ".$retorno['motivo']."</center>";
						}
						else{
							echo "<center>Utilizador: <b>".$retorno['nome']."</b><br>Motivo: ".$retorno['motivo']."<br>Obs.: ".$retorno['obs']."</center>";
						}
					}
					else {
						//echo "<button class='btn btn-warning btn-xs' title='Agendar ambiente'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>";
					}
					echo "</td>";
					}
				}

				$horario=$horario2;
				echo "</tr>";
			}	

			echo "</table>";
			echo "* horários de intervalo";
			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}

		//Método que lista as salas de um bloco para verificar disponibilidade
		function listaSalaBlocoFora($con,$data,$bloco)
		{ 
			$select = "SELECT salas.nome, salas.id  FROM salas WHERE salas.id_bloco = '$bloco' ";
			$retorno = mysqli_query($con,$select) or die (mysql_error());
			
			$count = mysqli_num_rows($retorno);
			$colspan=$count+1;

			echo "<br>";
			echo "<center><button title='Data' type='button' class='btn btn-large btn-primary disabled' disabled='disabled'><b>Bloco: ".$bloco." - Data: ".date("d/m/Y", strtotime($data))."</b></button></center>";
			echo "<br>";
			echo "<div class='alert alert-warning' role='alert' align='center'><b>Heeey!</b> Você precisa estar <i>logado</i> para reservar um ambiente! Ok?</div>";

			$horario = "07:30";

			echo '<table align="center" class="table table-hover table-bordered table-condensed">';
			echo "<tr class='success'><td><center><b>Horário</b></center></td>";

			while ($result = mysqli_fetch_assoc($retorno)){
				echo "<td><center><b>".$result['nome']."</b></center></td>";				
			}

			echo '</tr>';
	
			for ($i=1;$i<=22;$i++){
				$horario2 = $this->somaHorario($horario);
				echo "<tr>";
				echo "<td><center><b>".$horario." - ".$horario2."</b></center></td>";
					
				if ($this->intervalo($horario)==1){
					echo "<td colspan='".$count." align='center'><button title='Data' type='button' class='btn btn-sm btn-block btn-danger disabled' disabled='disabled'><center><b>I N D I S P O N Í V E L *</b></center></button></td>";
				}
				else{
					for ($j=1;$j<=$count;$j++){
					$retorno = $this->verificaAgenda($con,$data,$horario);
					echo "<td align='center'>";
					if($retorno!=NULL && $j==$retorno['id_sala']){
						if ($retorno['obs']==''){
							echo "<center>Utilizador: <b>".$retorno['nome']."</b><br>Motivo: ".$retorno['motivo']."</center>";
						}
						else{
							echo "<center>Utilizador: <b>".$retorno['nome']."</b><br>Motivo: ".$retorno['motivo']."<br>Obs.: ".$retorno['obs']."</center>";
						}
					}
					else {
						//echo "<button class='btn btn-warning btn-xs' title='Agendar ambiente'><span class='glyphicon glyphicon-plus' aria-hidden='true'></span></button>";
					}
					echo "</td>";
					}
				}

				$horario=$horario2;
				echo "</tr>";
			}	

			echo "</table>";
			echo "<b><i>* horários de intervalo</i></b>";
			//echo "<center><a href='../index.php'><button type='button' class='btn btn-danger'>Voltar</button></a></center><br>";
		}		

		function insereAgenda($con,$id_sala,$id_usuario,$data_age,$hora_age,$data_uso,$hora_uso,$tempo_uso,$motivo,$obs,$id_bloco,$id_horario)
		{
			$query = "SELECT id FROM agenda WHERE id_sala='$id_sala' AND data_uso='$data_uso' AND hora_uso='$hora_uso' ";
			
			mysqli_query($con,$query) or die(mysql_error ());
			
			if (mysqli_affected_rows()>0) {
				echo '<script language="javascript">
				alert("Este ambiente já está ocupado nessa data, neste horário!\n\nEscolha outro.");
				window.location="agendar_ambiente.php?id_bloco='.$id_bloco.'";
				</script>';
			}
			
			else { 

				$sql="INSERT INTO agenda (id,id_sala,id_usuario,data_age,hora_age,data_uso,hora_uso,tempo_uso,motivo,obs) 
				VALUES ('NULL','$id_sala','$id_usuario','$data_age','$hora_age','$data_uso','$hora_uso','$tempo_uso','$motivo','$obs')";
				mysqli_query($con,$sql) or die(mysql_error ());

				if ($tempo_uso>1) {
					for ($aux=1;$aux<$tempo_uso;$aux++){
						$id_horario=$id_horario+1;
						$select = "SELECT horario FROM horario WHERE id='$id_horario' ";
						$retorno = mysqli_query($con,$select) or die (mysql_error());
						while ($result = mysqli_fetch_assoc($retorno)) {
							$_SESSION['horario']=$result["horario"];
						}

						$novohorario=$_SESSION['horario'];

						$sql="INSERT INTO agenda (id,id_sala,id_usuario,data_age,hora_age,data_uso,hora_uso,tempo_uso,motivo,obs) 
						VALUES ('NULL','$id_sala','$id_usuario','$data_age','$hora_age','$data_uso','$novohorario','','$motivo','$obs')";
						mysqli_query($con,$sql) or die(mysql_error ());
					}
				}
				echo '<script language="javascript">
				alert("Reserva efetuada com sucesso!");
				window.location="calendario.php";
				</script>';
			}
		}
	}
?>