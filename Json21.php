<?php 
 
$server = "localhost";
$user = "root";
$pass = "";
$bd = "icsypbdb";
 

//http://ejemplocodigo.com/ejemplo-php-crear-y-leer-json-de-una-tabla-mysql/

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");


//generamos las consultas
$sql = "SELECT * FROM balizastojson2";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8


if(!$result = mysqli_query($conexion, $sql)) die();
 
$rutas = array(); //creamos un array
 /*
 echo $buffer_rec_id;
 echo $id_anterior;
 echo $contbalizas;
 echo $contrutas ;
 echo $buffer_rec_name;
 echo $buffer_rec_cat;*/

 while( $row = mysqli_fetch_array($result))
{ 
	$id=$row['IDRUTA']; 
	$nombre=$row['DESCRIPCION']; 
    $idb=$row['IDBALIZA']; 
    $textoi=$row['TEXTO_ID']; 
    $mac=$row['MAC']; 
    $posicion=$row['POSICION']; 
    $idu=$row['IDUSUARIO']; 
    $estrop=$row['ESTROPEADO']; 
    $mail=$row['EMAIL']; 
  // echo $id ;
  // echo $nombre;
	//$rutas[] = array('id'=> $id, 'descripcion'=> $nombre);
    $rutas[] = array('id'=> $id, 'descripcion'=> $nombre, 'idbaliza'=> $idb, 'descripcion'=>$textoi, 'mac'=> $mac, 'posicion'=> $posicion, 'idusuario'=> $idu, 'estropeado'=> $estrop, 'email'=> $mail);
	}

	//desconectamos la base de datos*/
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
 
//Creamos el JSON
$json_string = json_encode($rutas, JSON_NUMERIC_CHECK);
echo $json_string;
//echo $json_string;
?>