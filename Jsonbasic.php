<?php 
 
$server = "ctcloud.sytes.net";
$user = "root";
$pass = "";
$bd = "icsypbdb";
 

//http://ejemplocodigo.com/ejemplo-php-crear-y-leer-json-de-una-tabla-mysql/

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");
 
//generamos la consulta
$sql = "SELECT DESCRIPCION,IDRUTA  FROM ruta";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
 
if(!$result = mysqli_query($conexion, $sql)) die();
 
$rutas = array(); //creamos un array
 
while($row = mysqli_fetch_array($result)) 
{ 
    $nombre=$row['DESCRIPCION']; 
    $id=$row['IDRUTA']; 
	$rutas[] = array('id'=> $id, 'descripcion'=> $nombre);
	}  
	//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
 
//Creamos el JSON
$json_string = json_encode($rutas, JSON_NUMERIC_CHECK);
echo $json_string;
 
//Si queremos crear un archivo json, sería de esta forma:
/*
$file = 'clientes.json';
file_put_contents($file, $json_string);
*/
    
 
?>