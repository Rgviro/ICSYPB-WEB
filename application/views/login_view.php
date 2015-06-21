<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?=base_url()?>assets/Images/btrack-ico2.ico"> 
  <link href="<?=base_url()?>assets/CSS/bootstrap.min.css" rel="stylesheet" type="text/css">
  <script src="<?=base_url()?>assets/Javascript/jquery-1.11.2.min.js"></script>
  <script src="<?=base_url()?>assets/Javascript/bootstrap.min.js"></script>
  <link href="<?=base_url()?>assets/CSS/login.css" rel="stylesheet" type="text/css">
  <meta name="description" content="ICSYPB - Track Your Way">
  <meta name="author" content="Grupo 11">
</head>
<body>

<p><img class="center-block" src="assets/Images/btrack.png"   width="100"  height="93" align="middle" alt="ICSYPB" longdesc="assets/Images/btrack.png"  /></p>
<?php
$username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
$password = array('name' => 'password',	'placeholder' => 'introduce tu password');
	$submit = array('name' => 'submit', 'value' => 'Iniciar sesion', 'title' => 'Iniciar sesion');
	?>
	<div class="container_12">
		<h1 align = center><FONT COLOR="0A3D91">ICSYPB</FONT></h1>
<!--
     <form class="form-signin">
        <h2 class="form-signin-heading">Acceso al sistema</h2>
        <label for="inputUser" class="sr-only">Usuario</label>
        <input type="user" id="inputUser" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      </form>

    </div>  -->
		<div class="grid_12" id="login">
			<div class="grid_8 push_2" id="formulario_login">
				<div class="grid_6 push_1" id="campos_login">
					<div align="center">
					  <?=form_open(base_url().'login/new_user')?>
				  </div>
				  <label align="center" for="username" class="center-block" >
					  <div align="center"><strong>Usuario:</strong></div>
				  </label>
					<div align=center>
					  <?=form_input($username)?>
				  </div>
					<p><?=form_error('username')?></p>
					<label for="password" class="center-block" >
					  <div align="center"><strong>Password:</strong></div>
					</label>
					<div align="center" class="input-xlarge">
					  <span class="input-large">
					  <?=form_password($password)?>
				  </span>				    </div>
					<p align="center"><?=form_error('password')?></p>
					<div align="center" class="btn-navbar">
					  <?=form_hidden('token',$token)?>
					  <?=form_submit($submit)?>
					  <?=form_close()?>
					  <?php 
					if($this->session->flashdata('usuario_incorrecto'))
					{
					?>
				  </div>
				  <p align="center"><?=$this->session->flashdata('usuario_incorrecto')?></p>
					<div align="center">
					  <?php
					}
					?>
				  </div>
				</div>
			</div>
		</div>
	</div>
	</body>
</html>