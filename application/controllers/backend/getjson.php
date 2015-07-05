<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class gestorEstadisticasPub extends CI_Controller {

	function __construct()
    {
        parent::__construct();
		// Bibliotecas CodeIgniter necesarias
		$this->load->database();
		$this->load->helper('url');
		// Biblioteca GroceryCRUD
		$this->load->library('grocery_CRUD');
		$this->load->library(array('session'));		

		//cagamos la session
		$this->load->library('session');
    } 

    public function index()
    {
        
        $variable = $_GET["trackid"];
 		$idt =$variable;
		$server = "localhost";
      	$user = "ICSYPB";
      	$pass = "ICSYPB";
      	$bd = "icsypbdb";
		
      	//$variable = $_GET["trackid"];
		//Creamos la conexión
		$conexion = mysqli_connect($server, $user, $pass,$bd) 
		or die("Ha sucedido un error inexperado en la conexion de la base de datos");

		$rutas = array(); //creamos un array para las rutas
		
		//generamos las consultas
		$sql = "SELECT * FROM viewtrackpub where IDTRACKPUB = '" .$variable."'";
		mysqli_set_charset($conexion, "utf8"); //formato de datos utf8 

		//if(!$resouter = mysqli_query($conexion, $sql)) die();
		 $result = mysqli_query($conexion, $sql);
		 $buffer_rec_id = 1;
		 $buffer_rec_name ="";
		 $buffer_rec_id_ant = 1;
		 $buffer_rec_name_ant ="";

		 while( $row = mysqli_fetch_array($result))
		 {  
		   //$rutas[] = array('id'=> $row[0],'mac_user'=>$row[1],'idruta'=>$row[2],'ruta'=>$row[3],'gestor'=>$row[4],'email_gestor'=>$row[5],'id_baliza'=>$row[6],'mac_baliza'=> $row[7] ,'baliza'=> $row[8],'posbaliza'=> $row[9],'responsable_baliza'=> $row[10],'mail_responsable'=> $row[11],'fecha'=> $row[12]);
		   $rutas[] = array('id'=> $row[0],'mac_user'=>$row[1],'ruta'=>$row[3],'gestor'=>$row[4],'email_gestor'=>$row[5],'baliza'=> $row[8],'posbaliza'=> $row[9],'responsable_baliza'=> $row[10],'mail_responsable'=> $row[11],'fecha'=> $row[12]);
		   
		 }
		 //$rutas[] = array( 'id'=> $buffer_rec_id_ant, 'descripcion'=> $buffer_rec_name_ant, 'balizas'=>$baliza);  //genera el array de la ruta con sus balizas
		     
		  //desconectamos la base de datos*/
		$close = mysqli_close($conexion) 
		or die("Ha sucedido un error inexperado en la desconexion de la base de datos");			  
		 
		//Creamos el JSON
		$json_string = json_encode($rutas, JSON_NUMERIC_CHECK);
		echo $json_string;
		die();

		} 

    }

