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
        echo "<h1>Estadisticas totales</h1>";//Just an example to ensure that we get into the function
        die();
    }
//Seleccion de trackpublico
 public function GestEstPubIni(){
if ($this->session->userdata('perfil') != 'administrador') {
			if ($this->session->userdata('perfil') != 'gestor') {
			    $this->load->view('header.php');
			    $this->load->view('perfiles/usuario_menu.php');	
			    $this->load->view('perfiles/inputbox.php');	    
			    //$this->load->view('perfiles/usuario_menu.php');		    		    
	        	//$this->load->view('gestorestadisticas.php',$output);     		
	    		$this->load->view('footer.php');
							
			}else {
			    $this->load->view('header.php');		    
			    $this->load->view('perfiles/gestor_menu.php');		    		    
	        	$this->load->view('perfiles/inputbox.php');	     		
	    		$this->load->view('footer.php');
	    	}	    						
		}else {   			 
		    $this->load->view('header.php');		    
		    $this->load->view('perfiles/admin_menu.php');		    		    
        	$this->load->view('perfiles/inputbox.php');	      		
    		$this->load->view('footer.php');
    	}	    
    }

    //estadisticas totales
    public function GestEstPub(){    	

 		$variable = $_GET["trackid"];
    	if ($this->session->userdata('perfil') != 'administrador') {
			if ($this->session->userdata('perfil') != 'gestor') {
				//------------------
				//echo "hola";
				echo $variable; //"Variable $fname: $HTTP_GET_VARS["fname"] <br>";
				
				//-----------------
				$crud = new grocery_CRUD();
			    
		    	//Tema twitter bootstrap adaptativo
		    	// desactivado de momento por que no filtra bien en algunos casos
		    	//$crud->set_theme('twitter-bootstrap');    	
		    	$crud->set_theme('datatables');   
			     
				//Indicamos la tabla
			    $crud->set_table('tracking');
			    $crud->where('IDTRACKPUB',$variable);

			    //Deshabilitamoslos botones
			    $crud->unset_delete();
			    $crud->unset_edit();
			    $crud->unset_add();
			    $crud->unset_export();
			    $crud->unset_print();
				//REnderizamos la vista 
			    $output = $crud->render();
			
			    $this->load->view('header.php');	
			    $this->load->view('perfiles/inputbox.php');	    
			    //$this->load->view('perfiles/usuario_menu.php');		    		    
	        	$this->load->view('gestorestadisticas.php',$output);     		
	    		$this->load->view('footer.php');
							
			}else {
	    	
			    $crud = new grocery_CRUD();
			   
		    	//Tema twitter bootstrap adaptativo
		    	// desactivado de momento por que no filtra bien en algunos casos
		    	//$crud->set_theme('twitter-bootstrap');    	
		    	$crud->set_theme('datatables');   
			     
				//Indicamos la tabla
			    $crud->set_table('tracking');
			    $crud->where('IDTRACKPUB',$variable);

			    //Deshabilitamoslos botones
			    $crud->unset_delete();
			    $crud->unset_edit();
			    $crud->unset_add();
			    $crud->unset_export();
			    $crud->unset_print();
				//REnderizamos la vista 
			    $output = $crud->render();
			  echo "hola";
				echo $variable;
			    $this->load->view('header.php');		    
			    $this->load->view('perfiles/gestor_menu.php');		    		    
	        	$this->load->view('gestorestadisticas.php',$output);     		
	    		$this->load->view('footer.php');
	    	}	    
						
		}else {
    	
		    $crud = new grocery_CRUD();
		    
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');   
		     
			//Indicamos la tabla
		    $crud->set_table('tracking');
		    $crud->where('IDTRACKPUB',$variable);

		    //Deshabilitamoslos botones
		    $crud->unset_delete();
		    $crud->unset_edit();
		    $crud->unset_add();
		    $crud->unset_export();
		    $crud->unset_print();
			//REnderizamos la vista 
		    $output = $crud->render();
		 
		    $this->load->view('header.php');		    
		    $this->load->view('perfiles/admin_menu.php');		    		    
        	$this->load->view('gestorestadisticas.php',$output);     		
    		$this->load->view('footer.php');
    	}	    
    }
   
}