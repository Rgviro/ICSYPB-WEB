<!-- usuario_no_autorizado.php - Vista error por acceso no autorizado -->

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" name="viewport" >
  <meta content="width=device-width, initial-scale=1"> 
  <link rel="icon" href="<?=base_url()?>assets/Images/btrack-ico2.ico"> 
  <link href="<?=base_url()?>assets/CSS/bootstrap.min.css" rel="stylesheet" type="text/css">
  <script src="<?=base_url()?>assets/Javascript/jquery-1.11.2.min.js"></script>
  <script src="<?=base_url()?>assets/Javascript/bootstrap.min.js"></script>
</head>

	<body>
		<div class="container_12">
			<div class="grid_12">
				<h1 style="text-align: center">NO ESTAS AUTORIZADO A ACCEDER A ESA INFORMACION!!!</h1>
				<?=anchor(base_url().'login/index', 'Iniciar sesion')?>
				<?=anchor(base_url().'login/logout_ci', 'Cerrar sesion')?>
			</div>
		</div>	
	</body>
</html>