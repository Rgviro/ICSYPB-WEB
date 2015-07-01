<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class jsontobbdd extends CI_Controller {

    public function index() {
	$server = "localhost";
	$user = "ICSYPB";
	$pass = "ICSYPB";
	$bd = "icsypbdb";
		

        $rawBody = file_get_contents("php://input");
        $data = json_decode($rawBody, true);

        header('Content-Type: application/json; charset=UTF-8');
        //echo json_encode(array('data' => $data));

		//Creamos la conexión
		$conexion = mysqli_connect($server, $user, $pass,$bd) 
		or die("Ha sucedido un error inexperado en la conexion de la base de datos");

		if($data){
			//$str_datos = file_get_contentes("tracking.json");
			//$datos = json_decode($str_datos,true);
			/*Leer datos del POSt*/
			foreach ($data as $dato ) {
				//echo $dato[1];
				//print_r($dato);
				//generamos la consulta
				$sql = "INSERT INTO tracking (MAC_USUARIO,ID_RUTA,ID_BALIZA,MAC_BALIZA,DESC_BALIZA,POSICION,FECHA) values('" .$dato["mac_usuario"]. "'," .$dato["id_ruta"]. "," .$dato["id_baliza"]. ",'" .$dato["mac_baliza"]. "','" .$dato["desc_baliza"]. "','" .$dato["posicion"]. "','". $dato["fecha"]. "')";
				echo $sql;
				//mysqli_set_charset($conexion, "utf8"); //formato de datos utf8
			 	// DEBUG print_r($sql);	
				$result = mysqli_query($conexion, $sql);
			}
		}
		//desconectamos la base de datos*/
$close = mysqli_close($conexion) 
or die("Ha sucedido un error inexperado en la desconexion de la base de datos");
  
}

}
?>
