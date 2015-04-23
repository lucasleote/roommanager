<?php
			ob_start() ;
			session_start();
?>

<html>

	<head>
		<link rel="shortcut icon" href="img/icon_if.ico">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>RoomManager - Painel</title>
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/estilo.css" rel="stylesheet">
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</head>

	<body>
		<center>
		<?php
			echo "<big><br><br>Olá <b>".$_SESSION['nome']."</b>! Bem-vindo ao <i>RoomManager</i>.<br><br>Navegue nos menus a esquerda.</big>";
		?>
		<br><br><img src="img/logo_if.png">
		</center>
	</body>

</html>