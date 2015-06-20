<?php 
 
$server = "ctcloud.sytes.net";
$user = "root";
$pass = "";
$bd = "icsypbdb";
 

//http://ejemplocodigo.com/ejemplo-php-crear-y-leer-json-de-una-tabla-mysql/

//Creamos la conexión
$conexion = mysqli_connect($server, $user, $pass,$bd) 
or die("Ha sucedido un error inexperado en la conexion de la base de datos");

//generamos las consultas
$sql = "SELECT DESCRIPCION,IDRUTA  FROM ruta";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
 
if(!$result = mysqli_query($conexion, $sql)) die();
 
$rutas = array(); //creamos un array 

while($row = mysqli_fetch_array($result)) 
{ 
    $nombre=$row['DESCRIPCION']; 
    $id=$row['IDRUTA']; 
   
 //enlazamos las balizas
	//generamos la consulta anidada
	$sql2 = "SELECT `balizasjson`.`IDBALIZA`,`balizasjson`.`TEXTO_ID`, ,`balizasjson`.`MAC` ,`balizasjson`.`POSICION` ,`balizasjson`.`IDUSUARIO` ,`balizasjson`.`ESTROPEADO` ,`balizasjson`.`EMAIL` FROM `balizasjson` WHERE `balizasjson`.`IDRUTA`= " & $id & " ORDER BY `balizasjson`.`IDBALIZA`)";
	mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
	 
	if(!$result2 = mysqli_query($conexion, $sql2)) die();
	 
	$balizas = array(); //creamos un array
	 
	while($row = mysqli_fetch_array($result2)) 
	{ 	    
		$idb=$row['IDBALIZA'];
        $texto_idb=$row['TEXTO_ID'];
        $mac=$row['MAC'];
        $posicion=$row['POSICION'];
        $id_contacto=$row['IDUSUARIO'];
        $estropeado=$row['ESTROPEADO'];
        $mail=$row['MAIL'];
        $balizas[] = array('idb'=> $idb, 'descripcion'=> $texto_idb,'mac'=> $mac,'posicion'=> $posicion,'idcontacto'=>$id_contacto,'estropeado'=>$estropeado,'email'=>$mail);
	}
	   $rutas[] = array('id'=> $id, 'descripcion'=> $nombre,'balizas'=> $balizas);
	}  
	//desconectamos la base de datos
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
 
//Creamos el JSON
$json_string = json_encode($rutas, JSON_NUMERIC_CHECK);
echo $json_string;
 

    
 
?>