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

$rutas = array(); //creamos un array 

if(!$result = mysqli_query($conexion, $sql)) die();
 
$datoruta = array_fill_keys(array(
  'IDRUTA', 
  'DESCRIPCION'  
), null);

$datobaliza = array_fill_keys(array(
  'IDBALIZA',
  'TEXTO_ID',
  'MAC',
  'POSICION',
  'IDUSUARIO',
  'ESTROPEADO',
  'EMAIL'
), null);

$rutasbalizas = array();

while ($rutasbalizas = mysql_fetch_assoc($resouter, MYSQL_ASSOC)){   
   $id=$datoruta['IDRUTA'];
   $nombre=$datoruta['DESCRIPCION']; 
   if(isset($rutasbalizas[$datoruta]['IDRUTA'])){
      $rutasbalizas[$datoruta]['IDRUTA'][] = array_intersect_key($rutasbalizas, $datobaliza);
   } else {
     $rutasbalizas[$stId] = array_intersect_key($rutasbalizas, $datoruta);
     $rutasbalizas[$stId]['balizas'] = array(array_intersect_key($rutasbalizas, $datobaliza));
   }
}
/*
while($row = mysqli_fetch_array($result)) 
{ 
	$id=$row['IDRUTA'];
    $nombre=$row['DESCRIPCION']; 
    $idb=$row['IDBALIZA'];
    $texto_idb=$row['TEXTO_ID'];
    $mac=$row['MAC'];
    $posicion=$row['POSICION'];
    $id_contacto=$row['IDUSUARIO'];
    $estropeado=$row['ESTROPEADO'];
    $mail=$row['EMAIL'];

	   $rutas[] = array('id'=> $id, 'descripcion'=> $nombre,'idb'=> $idb, 'descripcion'=> $texto_idb,'mac'=> $mac,'posicion'=> $posicion,'idcontacto'=>$id_contacto,'estropeado'=>$estropeado,'email'=>$mail);
	}  
	//desconectamos la base de datos*/
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
 
//Creamos el JSON
$json_string = json_encode($rutasbalizas, JSON_NUMERIC_CHECK);
echo $json_string;
 

    
 
?>