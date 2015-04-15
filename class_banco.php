<?php
	/*Lê arquivo setup.ini e salva nas variáveis*/
	$ini = parse_ini_file('setup.ini');
	$ip=$ini['ip'];
	$usuario=$ini['user'];
	$senha=$ini['passwd'];
	$bd=$ini['bd'];

#--------------------------------------C L A S S E   B A N C O--------------------------------------------------------#
	Class Banco
	{
		//Atributos
		Private $ip;
		Private $usuario;
		Private $senha;
		Private $bd;
		Private $conecta;
		
		function __construct($ip,$usuario,$senha,$bd) 
		{
			$this->ip=$ip;
			$this->usuario=$usuario;
			$this->senha=$senha;
			$this->bd=$bd;
		}
		
		//Método que abre conexão ao banco
		function Conecta()
		{
			mysql_set_charset('utf8',$this->conecta=mysql_connect($this->ip,$this->usuario,$this->senha)) or die (mysql_error ());
			mysql_select_db($this->bd,$this->conecta) or die(mysql_error());
		}
		
		//Método que fecha conexão do banco
		function Disconecta()
		{
			mysql_close($this->conecta);
			//echo "disconectei";
		}
	}

#--------------------------------------------------------------------------------------------------------------------------#

?>

