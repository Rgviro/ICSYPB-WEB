<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
 
<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
 
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>

<style type='text/css'>
body
{
    font-family: Arial;
    font-size: 14px;
}
a {
    color: blue;
    text-decoration: none;
    font-size: 14px;
}
a:hover
{
    text-decoration: underline;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
	<a href="/index.php/gestorUsuarios/gestorUsr">USUARIOS</a>
	<a href="/index.php/gestorGrupos/gestorGrpGtr">GRUPOS-GESTORES</a>
	<a href="/index.php/gestorGrupos/gestorGrpUsr">GRUPOS-USUARIOS</a>
	<a href="/index.php/gestorConvocatorias/gestorConv">CONVOCATORIAS</a>
	<a href="/index.php/gestorNotificaciones/gestorNotif">NOTIFICACIONES</a>	
<!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
        <?php echo $output; ?>
    </div>
</body>
</html>
