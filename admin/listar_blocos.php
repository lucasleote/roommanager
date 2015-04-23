<?php
	header('Content-Type: text/html; charset=utf-8');

	require "../class_banco.php";
	require "../class_sala.php";

	$conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco
	
	try {
		$con = $conexao->Conecta(); //abre conexão ao banco
	} catch (Exception $erro) {
		echo $erro->getMessage();
		exit();
	}

	$salas=new Sala();
	$salas->listaBloco($con);
	
	$conexao->Disconecta(); //fecha conexão
?>