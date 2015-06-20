<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class GestorNotificaciones extends CI_Controller {
 
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
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
	//Listado de notificaciones
	function gestorNotif ()
	{

		//Comprobamos el login de usuario
		if ($this->session->userdata('perfil') == 'usuario') {
			$this->load->view('usuario_no_autorizado.php');
		}else {		
			$crud = new grocery_CRUD();
			
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');
			
			//$crud->set_theme('datatables');	
			$crud->set_table('NOTIFICACION');
			$crud->set_subject('notificacion');
			
			$crud->set_relation('IDCONVOCATORIA','CONVOCATORIA','NOMBRE');
			$crud->set_relation('IDTIPONOTIFICACION','TIPO_NOTIFICACION','TIPO');
			$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}');
			$crud->set_relation('IDSTATUS_NOTIFICACION','STATUS_NOTIFICACION','ESTADO');
			
			
			//Modificamos display de columnas
			$crud->display_as('IDCONVOCATORIA','CONVOCATORIA');
			$crud->display_as('IDTIPONOTIFICACION','TIPO NOTIFICACION');
			$crud->display_as('IDUSUARIO','DESTINATARIO');
			$crud->display_as('IDSTATUS_NOTIFICACION','ESTADO');		
	
			$crud->columns('IDCONVOCATORIA','IDUSUARIO','IDTIPONOTIFICACION','IDSTATUS_NOTIFICACION','TIPO_NOTIF','FECHA_ENVIO', 'FECHA_ALTA','FECHA_MODIFICACION');
	
			$crud->fields('IDTIPOUSUARIO','IDUSUARIO','IDTIPONOTIFICACION','IDSTATUS_NOTIFICACION','TIPO_NOTIF','FECHA_ENVIO','FECHA_ALTA','FECHA_MODIFICACION');
			$crud->callback_before_insert(array($this,'get_date_insert'));
			$crud->callback_before_update(array($this,'get_date_update'));
					
			//Solo podemos añadir usuarios a grupos, no crearlos
			//De esta manera se tienen que crear primero y añadir un gestor
			$crud->unset_operations();
					
			$output = $crud->render();
			
			$this->_example_output($output);
		}
				
	}
  
	function get_date_insert($post_array) {
		$post_array['FECHA_ALTA'] = date('d-m-Y H:i:s');
		return $post_array;
	}
	function get_date_update($post_array) {
		$post_array['FECHA_MODIFICACION'] = date('d-m-Y H:i:s');
		return $post_array;
	}

    function _example_output($output = null) 
    {
        $this->load->view('gestorNotificaciones.php',$output);    
    }
}
