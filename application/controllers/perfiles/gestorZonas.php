<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class gestorZonas extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
		// Bibliotecas CodeIgniter necesarias
		$this->load->database();
		$this->load->helper('url');
		// Biblioteca GroceryCRUD
		$this->load->library('grocery_CRUD');
		$this->load->library(array('session'));	
    }
 
    
    public function index()
    {
        echo "<h1>Gestor de Zonas</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    //Creacion de Zonas
    public function gestorZona()
    {
    	if ($this->session->userdata('perfil') != 'administrador') {
			//redirect(base_url().'login');
			$this->load->view('usuario_no_autorizado.php');
						
		}else {
    	
		    $crud = new grocery_CRUD();
		    
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');   
		     
			//Indicamos la tabla
		    $crud->set_table('ruta');
		     //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Ruta');
			//REnderizamos la vista 
			$output = $crud->render();
		 
		    $this->load->view('header.php');		    
		    $this->load->view('perfiles/admin_menu.php');		    		    
        	$this->load->view('gestorZonas.php',$output);     		
    		$this->load->view('footer.php');
		    
    	}	    
    }
}