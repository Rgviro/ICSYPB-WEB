<!-- BEGIN admin_menu.php - Vista del controlador admin.php -->
  <body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url()?>login" title="ICSYPB">
    <img style="max-width:50px; margin-top: -15px;" src="<?=base_url()?>assets/Images/btrack.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">               
            <li class="dropdown">            
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gesti&oacute;n de Zonas <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href='<?=base_url()?>perfiles/gestorZonas/gestorZona'>Zonas</a></li>
                <li><a href='<?=base_url()?>perfiles/gestorZonasBalizas/gestorBlzZona'>Balizas por Zona</a></li>                  
              </ul>
            </li>   
            <li class="dropdown">            
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gesti&oacute;n de Balizas <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href='<?=base_url()?>perfiles/gestorBalizas/gestorBlz'>Balizas</a></li>
                <li><a href='<?=base_url()?>perfiles/gestorBalizas/gestorBlzUsuario'>Responsable de Baliza</a></li>                 
              </ul>
            </li>                       
            <li class="divider"></li>
            <li><a href='<?=base_url()?>perfiles/balizas/mostrarBlz'>Balizas</a></li>                      
            <li><a href='<?=base_url()?>perfiles/zonas/mostrarZona'>Zonas</a></li> 
            <li class="divider"></li>
            <li class="dropdown">            
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Estad&iacute;sticas <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href='<?=base_url()?>perfiles/gestorEstadisticas/GestEstTot'>Totales</a></li>
                <li><a href='<?=base_url()?>perfiles/gestorEstadisticasPub/GestEstPubIni'>P&uacute;blicas</a></li>                  
              </ul>
            </li>           
            <li class="divider"></li>           
          </ul> 
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=base_url()?>gestion/gestorusuarios/crud_cambiopasswordusuario">Cambio Password</a></li>
            <li><a href="<?=base_url()?>ayuda">Ayuda</a></li>
          </ul>
          </li>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    <br>
    </body>
