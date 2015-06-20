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
          <img style="max-width:70px; margin-top: -10px;" src="<?=base_url()?>assets/Images/upsam.png"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active dropdown">            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gesti&oacute;n Grupos <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href='<?=base_url()?>gestion/gestorgrupos/crud_gestorgruposgestor'>Grear Grupo</a></li>
                <li><a href='<?=base_url()?>gestion/gestorgrupos/crud_gestorgruposusuario'>A&ntilde;adir Usuario</a></li>                  
              </ul>
            </li>
            <li class="dropdown">            
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Gesti&oacute;n Convocatorias<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href='<?=base_url()?>gestion/gestorconvocatorias/crud_gestorconvocatorias'>Activas</a></li>
                <li><a href='<?=base_url()?>gestion/gestorconvocatorias/crud_gestorconvocatoriashistorico'>Hist&oacute;rico</a></li>                  
              </ul>
            </li>      
            <li class="divider"></li>
            <li><a href='<?=base_url()?>gestion/gestornotificaciones/crud_gestornotificaciones'>Notificaciones</a></li>            
           <li class="dropdown">            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Estad&iacute;sticas <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">                
                <li><a href='<?=base_url()?>estadisticas/estadisticausuario/crud_estadisticausuarios'>Usuarios</a></li>
                 <li><a href='<?=base_url()?>estadisticas/estadisticaconv/crud_estconvocatorias'>Convocatorias Activas</a></li>
                 <li><a href='<?=base_url()?>estadisticas/estadisticaconv/crud_estconvocatoriashis'>Convocatorias Hist&oacute;rico</a></li> 
              </ul>
            </li>
            <li class="divider"></li>
            <li class="dropdown">            
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Convocatorias <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li><a href='<?=base_url()?>gestion/gestorconvusuario/crud_gestorconvactivas'>Activas</a></li>
                <li><a href='<?=base_url()?>gestion/gestorconvusuario/crud_gestorconvnoactivas'>Hist&oacute;rico</a></li> 
              </ul>
            </li>
          </ul> 
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?=base_url()?>gestion/gestorusuarios/crud_cambiopasswordusuario">Cambio Password</a></li>
            <li><a href="<?=base_url()?>ayuda">Ayuda</a></li>           
          </ul>
          </li>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
