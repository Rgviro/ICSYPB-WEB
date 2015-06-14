<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class estadisticas extends CI_Controller {
 
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
        echo "<h1>Gestor de Zonas</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    //Creacion de Zonas
    public function mostrarEstadistica()
    {

    	if ($this->session->userdata('perfil') != 'administrador') {
			//redirect(base_url().'login');
			$this->load->view('usuario_no_autorizado.php');
						
		}else {
    	
		    $crud = new grocery_CRUD();
		    
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');   
		     
			//Indicamos la tabla
		    $crud->set_table('RUTA');
		     //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Ruta');
		    
		    //Modificamos display de columnas
		    
		    $crud->display_as('IDRUTA','ID');
		    $crud->display_as('DESCRIPCION','DESCRIPCION');	     
		   
	   
		    //Establecemos relacion.
		   // $crud->set_relation('ID_TIPO','tipousuario','IDTIPO');
		 	
		    //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Ruta');
		    
		    //Indicamos los campos obligatorios
		    $crud->required_fields('DESCRIPCION');
	
		    
		    //Validaciones sobre los campos
		    
		    $crud->set_rules('DESCRIPCION','Nombre','trim|required|min_length[5]|max_length[20]');
		   
		   
		    
		    
		    $crud->fields('IDRUTA','DESCRIPCION');
		    
		    //Deshabilitamos el boton borrar, solo hacemos borrado logico
		    //$crud->unset_delete();
		    
			//REnderizamos la vista 
		    $output = $crud->render();
		 
		    $this->_example_output($output);
    	}	    
    }
    
    
    function _example_output($output = null) 
    {
        $this->load->view('gestorZonas.php',$output);    
    }
    
   
}