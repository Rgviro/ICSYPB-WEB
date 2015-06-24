<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class zonas extends CI_Controller {
 
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
        echo "<h1>Visualizarr de Zonas</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    //Creacion de Zonas
    public function mostrarZona()
    {
 
    	if ($this->session->userdata('perfil') != 'administrador') {
			if ($this->session->userdata('perfil') != 'gestor') {
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
			   // $crud->fields('IDRUTA','DESCRIPCION');
			    
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
	        	$this->load->view('vistaZonas.php',$output);       		
	    		$this->load->view('footer.php');
	    	}	    
						
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
		    
		   
		    
		    
		   // $crud->fields('IDRUTA','DESCRIPCION');
		    
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
        	$this->load->view('vistaZonas.php',$output);       		
    		$this->load->view('footer.php');
    	}	    
    }
      

      
    
    function _example_output($output = null) 
    {
        $this->load->view('gestorZonas.php',$output);    
    }
    
   
}