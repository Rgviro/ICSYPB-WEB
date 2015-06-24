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

		//cagamos la session
		$this->load->library('session');
    }
 
    
    public function index()
    {
        echo "<h1>Gestor de Zonas</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    //Creacion de Zonas
    public function gestorZona(){
 
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
		 
		    $this->_load_view($output);
    	}	    
    }
      

    function _load_view($output = null, $vista)
  {
    $this->load->view('header.php');
	switch ($this->session->userdata('perfil'))
	{
		case "administrador":
	        	$this->load->view('perfiles/admin_menu.php');
			break;
		case "gestor":
                        $this->load->view('perfiles/gestor_menu.php');
			break;
		case "usuario":
                        $this->load->view('perfiles/usuario_menu.php');
			break;
	}
	switch ($vista) {
		case 1:
			// Vista de gestor de grupos con usuarios asignados al grupo
			$this->load->view('gestion/gestorZonas.php',$output);
			break;
		case 2:
			// Vista de gestor de grupos con gestores con gestores asignados al grupo
			$this->load->view('gestion/gestorZonas.php.php',$output);
			break;
	}


        $this->load->view('footer.php');
  }

}
    function _example_output($output = null) 
    {
        $this->load->view('gestorZonas.php',$output);    
    }
    
   
}