<?php


$server = "ctcloud.sytes.net";
$user = "root";
$pass = "";
$bd = "icsypbdb";

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

if($_POST){
/**leer el fichero recibido y convertir su contenido*/
//$str_datos = file_get_contentes("tracking.json");
//$datos = json_decode($str_datos,true);
/*Leer datos del POSt*/
$misdatosjson =json_decode($_POST["datos"])
foreach ($misdatosjson as $dato ) {
	//generamos la consulta
	$sql = "INSERT INTO tracking (MACUSUSARIO,ID_RUTA,ID_BALIZA,MAC_BALIZA,FECHA) values($datos[0],$datos[1],$datos[2],$datos[3],$datos[4]) ";
	mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
	$result = mysqli_query($conexion, $sql);

	# code...
}

}

else{
echo "Datos no recibidos"
}
?>