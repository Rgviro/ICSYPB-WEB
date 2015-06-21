<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class gestorZonasBalizas extends CI_Controller {
 
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


//Asignacion de BAlizas a Zonas
    public function gestorBlzZona()
    {
//Comprobamos el login de usuario    	

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
		    $crud->set_table('rutabaliza');
		    
		    //Modificamos display de columnas
		    
		    $crud->display_as('IDRB','ID');
		    $crud->display_as('IDRUTA','RUTA');
		    $crud->display_as('IDBALIZA','BALIZA');
		    $crud->display_as('ORDEN','POSICION');	      
		   
	   
		    //Establecemos relacion.
		    $crud->set_relation('IDRUTA','ruta','IDRUTA');
		 	$crud->set_relation('IDBALIZA','baliza','IDBALIZA');
		    //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Baliza a Ruta');
		    
		    //Indicamos los campos obligatorios
		    $crud->required_fields('IDRUTA');
			$crud->required_fields('IDBALIZA');
		    
		    //Validaciones sobre los campos    
		   
		    
	    $crud->fields('IDRB','IDRUTA','IDBALIZA','ORDEN');
		    
		    //Deshabilitamos el boton borrar, solo hacemos borrado logico
		    //$crud->unset_delete();
		    
			//REnderizamos la vista 
		    $output = $crud->render();
		 
		    $this->load->view('header.php');		    
		    $this->load->view('perfiles/admin_menu.php');		    		    
        	$this->load->view('gestorZonas.php',$output);     		
    		$this->load->view('footer.php');
    	}	    
    }
      
    
  
   
}