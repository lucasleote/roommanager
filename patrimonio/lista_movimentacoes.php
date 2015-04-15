<?php
	header('Content-Type: text/html; charset=utf-8');
	
	require "../class_banco.php";
	require "../class_patrimonio.php";

	$conexao=new Banco($ip,$usuario,$senha,$bd); //instancia banco
	
	try {
		$conexao->Conecta(); //abre conexão ao banco
	} catch (Exception $erro) {
		echo $erro->getMessage();
		exit();
	}

	$movimentacoes=new Patrimonio();
	$movimentacoes->listaMovimentacoes();
	
	$conexao->Disconecta(); //fecha conexão
?>