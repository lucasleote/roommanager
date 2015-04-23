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
			$this->conecta=mysqli_connect($this->ip,$this->usuario,$this->senha) or die (mysql_error ());
			mysqli_set_charset($this->conecta,"utf8");
			mysqli_select_db($this->conecta,$this->bd) or die(mysql_error());
			return $this->conecta;
		}
		
		//Método que fecha conexão do banco
		function Disconecta()
		{
			mysqli_close($this->conecta);
			//echo "disconectei";
		}
	}

#--------------------------------------------------------------------------------------------------------------------------#

?>

