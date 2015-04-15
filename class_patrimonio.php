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
	Class Patrimonio
	{
		//Atributos
		Private $id;
		Private $nome;
		Private $id_tipo;
		Private $obs;
		Private $data;
		Private $hora;

		//Método que insere nova categoria no banco
		function insereTipo($descricao,$obs)
		{
			$query = "SELECT descricao FROM tipo_patrimonio WHERE descricao LIKE '$descricao' ";
			
			mysql_query($query);
			
			if (mysql_affected_rows()>0) {
				echo '<script language="javascript">
				alert("Já existente uma categoria com esse nome!\n\nEscolha outro.");
				</script>';
			}
			
			else { 

				$sql="INSERT INTO tipo_patrimonio (id,descricao,obs) VALUES ('NULL','$descricao','$obs')";
				mysql_query($sql) or die(mysql_error ());

				echo "<script language='javascript'>
				alert('Categoria cadastrada com sucesso!');
				window.location='../inicio.php';
				</script>";
			}
		}

		//Método que lista categorias cadastradas
		function listaTipo()
		{ 	
			echo "<br><center><h3><span class='glyphicon glyphicon-th-list' aria-hidden='true'></span> Categorias cadastradas no sistema</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed"" align="center">';
			echo '<tr class="success">';
			echo '<td align="center"><b>CÓDIGO</b></td>';
			echo '<td align="center"><b>NOME</b></td>';
			echo '<td align="center"><b>OBS.</b></td>';
			//echo '<td colspan="2" align="center"><b>AÇÕES</b></td>';
			echo '</tr>';

			$select = 'SELECT tipo_patrimonio.id, tipo_patrimonio.descricao, tipo_patrimonio.obs FROM tipo_patrimonio ORDER BY id DESC';

			$retorno = mysql_query($select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysql_fetch_assoc($retorno))
			{
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['id']."</td>";
				echo "<td>".$result['descricao']."</td>";
				echo "<td>".$result['obs']."</td>";

				/*echo "<td align='center'>
					<a href='?id=".$result['id']."'>
						<button title='Alterar' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-edit' title='Alterar'></i></button>
					</a>
				</td>";*/
				}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="3" align="center"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}

		//Método que insere novo patrimônio no banco
		function inserePatrimonio($nome,$id_tipo,$obs,$data,$hora)
		{
			$query = "SELECT nome FROM patrimonios WHERE nome LIKE '$nome' ";
			
			mysql_query($query);
			
			if (mysql_affected_rows()>0) {
				echo '<script language="javascript">
				alert("Já existente um patrimônio com esse nome!\n\nEscolha outro.");
				</script>';
			}
			
			else { 

				$sql="INSERT INTO patrimonios (id,nome,id_tipo,obs,data,hora) VALUES ('NULL','$nome','$id_tipo','$obs','$data','$hora')";
				mysql_query($sql) or die(mysql_error ());

				echo "<script language='javascript'>
				alert('Patrimônio cadastrado com sucesso!');
				window.location='cria_estoque.php';
				</script>";
			}
		}

		//Método que altera o patrimonio
		function alteraPatrimonio($id,$nome,$id_tipo,$obs)
		{
			$sql="UPDATE patrimonios SET patrimonios.nome='$nome',patrimonios.id_tipo='$id_tipo',patrimonios.obs='$obs'
			WHERE patrimonios.id='$id'";
			mysql_query($sql) or die(mysql_error ());

			echo "<script language='javascript'>
				alert('Patrimônio alterado com sucesso!');
				window.location='lista_patrimonio.php';
				</script>";
		}

		//Método que cria estoque
		function criaEstoque($saldo_atual,$data,$hora)
		{
			global $id_patrimonio;

			$select = "SELECT MAX(id) AS id FROM patrimonios";
			$retorno = mysql_query($select) or die(mysql_error ());
			$retorno;

			while ($result = mysql_fetch_assoc($retorno))
			{
				$id_patrimonio = $result['id'];
			}

			$sql="INSERT INTO estoque (id_patrimonio,saldo_atual,data,hora) VALUES ('$id_patrimonio','$saldo_atual','$data','$hora')";
				mysql_query($sql) or die(mysql_error ());	

			echo "<script language='javascript'>
				alert('Estoque criado com sucesso!');
				window.location='../inicio.php';
				</script>";		
		}

		//Método que lista patrimônios cadastradas
		function listaPatrimonio()
		{ 	
			echo "<br><center><h3><span class='glyphicon glyphicon-barcode' aria-hidden='true'></span> Patrimônios cadastrados no sistema</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed"" align="center">';
			echo '<tr class="success">';
			echo '<td align="center"><b>CÓDIGO</b></td>';
			echo '<td align="center"><b>NOME</b></td>';
			echo '<td align="center"><b>CATEGORIA</b></td>';
			echo '<td align="center"><b>SALDO ATUAL</b></td>';
			echo '<td align="center"><b>OBS.</b></td>';
			echo '<td align="center"><b>DATA</b></td>';
			echo '<td align="center"><b>HORA</b></td>';
			echo '<td colspan="2" align="center"><b>AÇÕES</b></td>';
			echo '</tr>';

			$select = 'SELECT patrimonios.id, patrimonios.nome, tipo_patrimonio.descricao, estoque.saldo_atual, patrimonios.obs, DATE_FORMAT(patrimonios.data,"%d/%m/%y") AS data, patrimonios.hora FROM patrimonios,tipo_patrimonio,estoque WHERE patrimonios.id_tipo = tipo_patrimonio.id AND patrimonios.id = estoque.id_patrimonio ORDER BY patrimonios.id DESC';

			$retorno = mysql_query($select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysql_fetch_assoc($retorno))
			{
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['id']."</td>";
				echo "<td>".$result['nome']."</td>";
				echo "<td>".$result['descricao']."</td>";
				echo "<td>".$result['saldo_atual']."</td>";
				echo "<td>".$result['obs']."</td>";
				echo "<td>".$result['data']."</td>";
				echo "<td>".$result['hora']."</td>";

				echo "<td align='center'>
					<a href='altera_patrimonio.php?id=".$result['id']."'>
						<button title='Alterar' class='btn btn-warning btn-xs'><i class='glyphicon glyphicon-edit' title='Alterar'></i></button>
					</a>
				</td>";
				}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="7" align="center"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}

		//Método que movimenta patrimônio
		function movimentaPatrimonio($tipo,$id_patrimonio,$quantidade,$obs,$data,$hora)
		{
			global $saldo_atual;
			session_start();
			$operador = $_SESSION['nome'];

			$sql="INSERT INTO movimentacoes (id,tipo,id_patrimonio,quantidade,obs,data,hora,operador) VALUES ('NULL','$tipo','$id_patrimonio','$quantidade','$obs','$data','$hora','$operador')";
			mysql_query($sql) or die(mysql_error ());

			$select = "SELECT estoque.saldo_atual FROM estoque WHERE id_patrimonio = $id_patrimonio";
			$retorno = mysql_query($select) or die (mysql_error());
			
			while ($result = mysql_fetch_assoc($retorno))
			{
				$saldo_atual = $result['saldo_atual'];
			}

			if ($tipo=='entrada'){
				$sql2="UPDATE estoque SET saldo_atual=$saldo_atual+$quantidade, data='$data', hora='$hora' WHERE id_patrimonio='$id_patrimonio'";
				mysql_query($sql2) or die(mysql_error ());
			}

			if ($tipo=='saida'){
				$sql2="UPDATE estoque SET saldo_atual=$saldo_atual-$quantidade, data='$data', hora='$hora' WHERE id_patrimonio='$id_patrimonio'";
				mysql_query($sql2) or die(mysql_error ());
			}

			echo "<script language='javascript'>
			alert('Patrimônio movimentado com sucesso!');
			window.location='../inicio.php';
			</script>";
		}

		function listaMovimentacoes()
		{ 	
			echo "<br><center><h3><span class='glyphicon glyphicon-sort' aria-hidden='true'></span> Movimentações de patrimônio</h3></center><br>";

			echo '<table class="table table-hover table-bordered table-condensed"" align="center">';
			echo '<tr class="success">';
			echo '<td align="center"><b>ID</b></td>';
			echo '<td align="center"><b>TIPO</b></td>';
			echo '<td align="center"><b>PATRIMÔNIO</b></td>';
			echo '<td align="center"><b>QUANTIDADE</b></td>';
			echo '<td align="center"><b>OBS.</b></td>';
			echo '<td align="center"><b>DATA</b></td>';
			echo '<td align="center"><b>HORA</b></td>';
			echo '<td align="center"><b>OPERADOR</b></td>';
			echo '</tr>';

			$select = 'SELECT movimentacoes.id, movimentacoes.tipo, movimentacoes.id_patrimonio, patrimonios.nome, movimentacoes.quantidade, movimentacoes.obs, movimentacoes.operador, DATE_FORMAT(movimentacoes.data,"%d/%m/%y") AS data, movimentacoes.hora FROM movimentacoes,patrimonios WHERE movimentacoes.id_patrimonio=patrimonios.id ORDER BY movimentacoes.data DESC, movimentacoes.hora DESC';

			$retorno = mysql_query($select) or die (mysql_error());
			
			$i=0;
			
			while ($result = mysql_fetch_assoc($retorno))
			{
				if ($result['tipo']=='entrada') $result['tipo']='E';
				if ($result['tipo']=='saida') $result['tipo']='S';
				$i=$i+1;
				echo "<tr>";
				echo "<td>".$result['id']."</td>";
				echo "<td>".$result['tipo']."</td>";
				echo "<td>".$result['id_patrimonio']." - ".$result['nome']."</td>";
				echo "<td>".$result['quantidade']."</td>";
				echo "<td>".$result['obs']."</td>";
				echo "<td>".$result['data']."</td>";
				echo "<td>".$result['hora']."</td>";
				echo "<td>".$result['operador']."</td>";
			}

			echo '<tr>';
			echo '<td><b>TOTAL</b></td>';
			echo '<td colspan="7" align="center"><b>'.$i.'</b></td>';
			echo '</tr>';
			
			echo "</table>";

			echo "<center><a href='../inicio.php'><button type='button' class='btn btn-danger'>Cancelar</button></a></center>";
		}
	}
?>