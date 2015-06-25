<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class jsonbase extends CI_Controller {
 
   
 
    
    public function index()
    {
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
$baliza= array();//creamos un array para los campos de la baliza leida

//generamos las consultas
$sql = "SELECT * FROM balizastojson2";
mysqli_set_charset($conexion, "utf8"); //formato de datos utf8 

//if(!$resouter = mysqli_query($conexion, $sql)) die();
 $result = mysqli_query($conexion, $sql);
 $buffer_rec_id = 1;
 $buffer_rec_name ="";
 $buffer_rec_id_ant = 1;
 $buffer_rec_name_ant ="";

 while( $row = mysqli_fetch_array($result))
 {  
    if( $row[0] == $buffer_rec_id_ant){
      $buffer_rec_id = $row[0];
      $buffer_rec_name = $row[1];  
      $baliza[] = array('id'=> $row[2],'texto_id'=>$row[3],'mac'=>$row[4],'posicion'=>$row[5],'id_contacto'=>$row[6],'estropeado'=> $row[7] ,'mail'=> $row[8]);
      //$balizas[]= $baliza;
      $buffer_rec_id_ant =  $buffer_rec_id;
      $buffer_rec_name_ant =$buffer_rec_name ;
    }
    elseif (is_null($row[0])){
      $rutas[] = array( 'id'=> $buffer_rec_id_ant, 'descripcion'=> $buffer_rec_name_ant, 'balizas'=>$baliza);  //genera el array de la ruta con sus balizas
      unset ($baliza); //vacia las balizas      
    }
    else{
      $rutas[] = array( 'id'=> $buffer_rec_id_ant, 'descripcion'=> $buffer_rec_name_ant, 'balizas'=>$baliza);  //genera el array de la ruta con sus balizas
      unset ($baliza); //vacia las balizas
      $buffer_rec_id = $row[0];
      $buffer_rec_name = $row[1];  
      $baliza[] = array('id'=> $row[2],'texto_id'=>$row[3],'mac'=>$row[4],'posicion'=>$row[5],'id_contacto'=>$row[6],'estropeado'=> $row[7] ,'mail'=> $row[8]);
      $balizas[]= $baliza;
      $buffer_rec_id_ant =  $buffer_rec_id;
      $buffer_rec_name_ant =$buffer_rec_name ;
    }
 }
 $rutas[] = array( 'id'=> $buffer_rec_id_ant, 'descripcion'=> $buffer_rec_name_ant, 'balizas'=>$baliza);  //genera el array de la ruta con sus balizas
     
  //desconectamos la base de datos*/
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
 
//Creamos el JSON
$json_string = json_encode($rutas, JSON_NUMERIC_CHECK);
echo $json_string;
        die();
    }
 
}
?>
