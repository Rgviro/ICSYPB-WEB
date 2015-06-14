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
ul {
    float: left;
    width: 100%;
    padding: 0;
    margin: 0;
    list-style-type: none;
}

x {
    float: left;
    width: 11em;
	height: 3em;
	border:#200;
	text-align:center;
	text-justify:auto;
	text-wrap:normal;
	border-style:outset;
	border-width:thin;
	font:"Times New Roman", Times, serif
    text-decoration:none;
    color: white;
    background-color: #00CC33;
    padding: 0.2em 0.6em;
    border-right: 1px solid white;
}

x:hover {
	background-color: #99CC33;
}

li {
    display: inline;
}
</style>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
<body>
	<li><x href="/index.php/gestorUsuarios/gestorUsr">USUARIOS</x></li>
	<li><x href="/index.php/gestorGrupos/gestorGrpGtr">GRUPOS-GESTORES</x></li>
	<li><x href="/index.php/gestorGrupos/gestorGrpUsr">GRUPOS-USUARIOS</x></li>
	<li><x href="/index.php/gestorConvocatorias/gestorConv">ZONAS</x></li>
	<li><x href="/index.php/gestorNotificaciones/gestorNotif">NOTIFICACIONES</x></li>
    <br>
 
    
<!-- End of header-->
    <div style='height:20px;'></div>  
    <div>
        <?php echo $output; ?>
    </div>
</body>
</html>
