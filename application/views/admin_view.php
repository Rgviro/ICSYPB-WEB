<!DOCTYPE html>
	<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" name="viewport" >
        <meta content="width=device-width, initial-scale=1">  
		 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/960.css" media="screen" />
		 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/text.css" media="screen" />
		 <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" media="screen" />
         <link href="CSS/bootstrap.min.css" rel="stylesheet">
         <link href="CSS/navbar-fixed-top.css" rel="stylesheet">
         <script src="CSS/ie-emulation-modes-warning.js"></script>
         
         <meta http-equiv="X-UA-Compatible" content="IE=edge" name="viewport" >
        <meta content="width=device-width, initial-scale=1">       
        <link rel="stylesheet" href="application/views/Themes/css/bootstrap.min.css">
        <script src="CSS/jquery.min.js" type="text/javascript"></script>
        <script src="CSS/script.js"></script>
        <title>CSS MenuMaker</title>

	</head>
	<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Menu</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">ICSYPB - Bluetooth Tracker</a>
        </div>        
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href='gestorUsuarios/gestorUsr'>Gesti&oacute;n Usuarios</a></li>
            <li class="dropdown">            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gesti&oacute;n de Zonas <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href='gestorZonas/gestorZona'>Gestores de Zona</a></li>
                <li><a href='gestorZonas/gestorBlzZona'>Balizas a Zona</a></li>                  
              </ul>
            </li>
            <li><a href='gestorBalizas/gestorBlz'>Gesti&oacute;n de Balizas</a></li>
            <li class="divider"></li>
            <li><a href='gestorBalizas/gestorBlz'>Balizas</a></li>
            <li><a href='gestorBalizas/gestorBlz'>Estadisticas</a></li>
            <li class="divider"></li>
            <li class="dropdown">            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Zonas <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href='gestorUsuario/gestorConvActivas'>Activas</a></li>
                <li><a href='gestorUsuario/gestorConvNoActivas'>Hist&oacute;rico</a></li> 
              </ul>
            </li>
          <li> 
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Acceso</a></li>
            <li><a href="../navbar-static-top/">Ayuda</a></li>           
          </ul>
          </li>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>