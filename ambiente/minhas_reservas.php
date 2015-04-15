<?php
	session_start();
	$id_usuario=$_SESSION['id'];

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
	$reserva->minhasReservas($id_usuario);
	
	$conexao->Disconecta(); //fecha conexão
?>