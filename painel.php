<?php
  session_start();

  if(!isset($_SESSION['login'])){
    header('Location: index.php');
  }
?>

<!DOCTYPE html>
<html lang="pt-BR">
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
    <nav class="navbar navbar-default ">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" onClick=window.open("inicio.php","main")><span><img src="img/logo_if.png" width="20" height="25"/></span> <i>RoomManager</i> - IFSul câmpus Charqueadas</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo $_SESSION['nome']; ?> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#" onClick=window.open("ambiente/meu_perfil.php","main")><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Meu perfil</a></li>
                <li><a href="login/logoff.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>

    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Administração</a></li>
        <li><a href="#" onClick=window.open("admin/cadastra_usuario.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Cadastrar usuário</a></li>
        <li><a href="#" onClick=window.open("admin/listar_usuarios.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Listar usuários</a></li>
        <li><a href="#" onClick=window.open("admin/listar_perfis.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Listar perfis</a></li>
        <li><a href="#" onClick=window.open("admin/cadastra_ambiente.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Cadastrar ambiente</a></li>
        <li><a href="#" onClick=window.open("admin/listar_ambientes.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Listar ambientes</a></li>
        <li><a href="#" onClick=window.open("admin/cadastra_bloco.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Cadastrar bloco</a></li>
        <li><a href="#" onClick=window.open("admin/listar_blocos.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Listar blocos</a></li>
        <li class="active"><a><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Reserva de ambientes</a></li>
        <li><a href="#" onClick=window.open("ambiente/calendario.php","main")><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Calendário</a></li>
        <li><a href="#" onClick=window.open("ambiente/busca_ambiente.php","main")><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar ambiente</a></li>
        <li><a href="#" onClick=window.open("ambiente/minhas_reservas.php","main")><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> &nbsp;Minhas reservas</a></li>
        <li class="active"><a><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Patrimônio</a></li>
        <li><a href="#" onClick=window.open("patrimonio/cadastra_patrimonio.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Cadastrar patrimônio</a></li>
        <li><a href="#" onClick=window.open("patrimonio/lista_patrimonio.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Listar patrimônios</a></li>
        <li><a href="#" onClick=window.open("patrimonio/cadastra_tipo.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Cadastrar categoria</a></li>
        <li><a href="#" onClick=window.open("patrimonio/lista_tipo.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Listar categorias</a></li>
        <li><a href="#" onClick=window.open("patrimonio/movimenta_patrimonio.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Movimentar patrimônio</a></li>
        <li><a href="#" onClick=window.open("patrimonio/lista_movimentacoes.php","main")><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Listar movimentações</a></li>
      </ul>
    </div>
  </body>

  <iframe name="main" frameborder="0" src="inicio.php" scrolling="auto"></iframe>

</html>