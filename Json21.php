<?php 
 
$server = "localhost";
$user = "root";
$pass = "";
$bd = "icsypbdb";
 

//http://ejemplocodigo.com/ejemplo-php-crear-y-leer-json-de-una-tabla-mysql/

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

$rutas = array(); //creamos un array para las rutas
$balizas = array();//creamos un array para las balizas

//generamos las consultas
$sql = "SELECT * FROM ruta LEFT JOIN balizastojson ON ruta.IDRUTA = balizastojson.IDRUTA";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

 

//if(!$resouter = mysqli_query($conexion, $sql)) die();
 $result = mysqli_query($conexion, $sql);
 $buffer_rec_id = 0;
 $id_anterior = 1;
 $contbalizas = 0;
 $contrutas = 0;
 $buffer_rec_name ="";
 $buffer_rec_cat = "";

 while( $rutas = mysqli_fetch_array($result))
 {
/*echo $rutas[0];
echo $rutas[1];
echo $rutas[2];*/

while($row = mysqli_fetch_array($result)) 
{ 
if( $id_anterior != intval($rutas[0]) ){
	
    $rutas[$contrutas] = array( $buffer_rec_id, $buffer_rec_name, $balizas);
	$buffer_rec_id = $rutas[0];
    $buffer_rec_name = $rutas[1]; 
    $contrutas = $contrutas + 1;
}
else{
   	$balizas[$contbalizas] = array( $rutas[3], $rutas[4], $rutas[5], $rutas[6], $rutas[7], $rutas[8] , $rutas[9]  );
	$contbalizas = $contbalizas +1;
}
}
//------------------------------------


/*
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



while ($rutasbalizas = mysql_fetch_assoc($result, MYSQL_ASSOC)){   
   $id=$datoruta['IDRUTA'];
    
   if(isset($rutasbalizas[$datoruta]['IDRUTA'])){
      $rutasbalizas[$datoruta]['IDRUTA'][] = array_intersect_key($rutasbalizas, $datobaliza);
   } else {
     $rutasbalizas[$stId] = array_intersect_key($rutasbalizas, $datoruta);
     $rutasbalizas[$stId]['balizas'] = array(array_intersect_key($rutasbalizas, $datobaliza));
   }
}*/
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
$json_string = json_encode($rutas, JSON_NUMERIC_CHECK);
echo $json_string;
 

    
 
?>