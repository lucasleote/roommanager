<?php

	require "../class_banco.php";
	require "../class_patrimonio.php";
	
	$conexao=new Banco($ip,$usuario,$senha,$bd); 
	$conexao->Conecta();
	
	$saldo_atual = 0;
	
	date_default_timezone_set('America/Sao_Paulo');

	$data = date("Y/m/d");
	$hora = date("H:i");

	$estoque=new Patrimonio();
	$estoque->criaEstoque($saldo_atual,$data,$hora);
	
	$conexao->Disconecta();
	
?>