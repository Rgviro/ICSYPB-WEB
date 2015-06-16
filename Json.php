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
$sql = "SELECT * FROM balizastojson2";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8

 

//if(!$resouter = mysqli_query($conexion, $sql)) die();
 $result = mysqli_query($conexion, $sql);
 $buffer_rec_id = 0;
 $buffer_rec_name ="";
 $buffer_rec_cat = "";

 while( $row = mysqli_fetch_array($result))
 {

 	if( $buffer_rec_id != intval($row[0]) )
  {
  	  $buffer_rec_id = $row[2];
      $buffer_rec_name = $row[1]; 
      unset($balizas);

      $balizas[] =  array('idbaliza'=>  $row[3],'descripcion'=> $row[4],'mac'=>  $row[5],'posicion'=>  $row[6], 'idusuario'=> $row[7],'estropeado'=> $row[8] );
	  $rutas[] = array( 'id'=> $buffer_rec_id, 'descripcion'=> $buffer_rec_name, $balizas);
         
  }
  else
  {
      $balizas[] =  array('idbaliza'=>  $row[3],'descripcion'=> $row[4],'mac'=>  $row[5],'posicion'=>  $row[6], 'idusuario'=> $row[7],'estropeado'=> $row[8] );

  }

 }

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