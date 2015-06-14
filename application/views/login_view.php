<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/960.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" media="screen" />
<style type="text/css">
h1{
	font-size: 22px;
	text-align: center;
	margin: 20px 0px;
}
#login{
background: #fefefe;
min-height: 500px;
}
#formulario_login{
font-size: 14px;
border: 4px solid #112233;
}
label{
display: block;
font-size: 16px;
color: #333333;
	font-weight: bold;
}
input[type=text],input[type=password]{
padding: 10px 6px;
width: 400px;
}
input[type=submit]{
padding: 5px 40px;
background: #61399d;
color: #fff;
}
#campos_login{
margin: 50px 0px;
}
	p{
	color: #f00;
	font-weight: bold;
}
</style>
<link href="Themes/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
$username = array('name' => 'username', 'placeholder' => 'nombre de usuario');
$password = array('name' => 'password',	'placeholder' => 'introduce tu password');
	$submit = array('name' => 'submit', 'value' => 'Iniciar sesion', 'title' => 'Iniciar sesion');
	?>
	<div class="container_12">
		<h1>ICSYPB</h1>
		<div class="grid_12" id="login">
			<div class="grid_8 push_2" id="formulario_login">
				<div class="grid_6 push_1" id="campos_login">
					<div align="center">
					  <?=form_open(base_url().'login/new_user')?>
				  </div>
				  <label for="username">
					  <div align="center" class="navbar-static"><strong>Nombre de usuario:</strong></div>
				  </label>
					<div align="center">
					  <?=form_input($username)?>
				  </div>
					<p><?=form_error('username')?></p>
					<label for="password" class="navbar-static">
					  <div align="center"><strong>Introduce tu password:</strong></div>
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