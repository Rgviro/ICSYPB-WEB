<?php 
 
$server = "ctcloud.sytes.net";
$user = "root";
$pass = "";
$bd = "icsypbdb";
 

//http://ejemplocodigo.com/ejemplo-php-crear-y-leer-json-de-una-tabla-mysql/

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

$rutas = array(); //creamos un array para las rutas
$balizas = array();//creamos un array para las balizas
$baliza= array();//creamos un array para los campos de las balizas

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
  	 $buffer_rec_id = $row[0];
     $buffer_rec_name = $row[1];
  	  unset($balizas);
      $baliza[] =  array('idbaliza'=>  $row[2],'descripcion'=> $row[3],'mac'=>  $row[4],'posicion'=>  $row[5], 'idusuario'=> $row[6],'estropeado'=> $row[7] ,'mail'=> $row[8]);
	  //$balizas[] = $baliza;
	  $rutas[] = array( 'id'=> $buffer_rec_id, 'descripcion'=> $buffer_rec_name, $baliza);
         
  }
  else
  {
      $baliza[] =  array('idbaliza'=>  $row[2],'descripcion'=> $row[3],'mac'=>  $row[4],'posicion'=>  $row[5], 'idusuario'=> $row[6],'estropeado'=> $row[7] ,'mail'=> $row[8]);
	 // $balizas[] = $baliza;
  }

 }
	//desconectamos la base de datos*/
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
 
//Creamos el JSON
$json_string = json_encode($rutas, JSON_NUMERIC_CHECK);
echo $json_string;
?>