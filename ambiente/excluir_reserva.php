<?php

	$id_agenda = $_GET['id_agenda'];
	$tempo_uso = $_GET['tempo_uso'];

	require "../class_usuario.php";
	require "../class_banco.php";
	require "../class_sala.php";

	$conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco
	
	try {
		$conexao->Conecta(); //abre conexão ao banco
	} catch (Exception $erro) {
		echo $erro->getMessage();
		exit();
	}

	$reserva=new Usuario();
	$reserva->excluiReserva($id_agenda,$tempo_uso);
	
	$conexao->Disconecta(); //fecha conexão
?>