<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class gestorUsuarios extends CI_Controller {
 
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
        echo "<h1>Gestor de Usuarios</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    //Creacion de usuarios
    public function gestorUsr()
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
		    $crud->set_table('usuario');
		    
		    //Modificamos display de columnas
		    $crud->display_as('ID_TIPO','ROL');
		    $crud->display_as('USER','USUARIO');
		    $crud->display_as('NOMBRE','NOMBRE');	     
		    $crud->display_as('APELLIDO1','PRIMER APELLIDO');
		    $crud->display_as('APELLIDO2','SEGUNDO APELLIDO');
		    
	   
		    //Establecemos relacion.
		   // $crud->set_relation('ID_TIPO','TIPOUSUARIO','IDTIPO');
	
		    //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Usuario');
		    
		    //Indicamos los campos obligatorios
		    $crud->required_fields('USER','NOMBRE','ID_TIPO','EMAIL', 'TFNO','PASWD' );
	
		    
		    //Validaciones sobre los campos
		    $crud->set_rules('USER','usuario','trim|required|min_length[5]|max_length[20]');
		    $crud->set_rules('NOMBRE','Nombre','trim|required|min_length[5]|max_length[20]');
		    $crud->set_rules('APELLIDO1','Primer apellido','trim|max_length[30]');
		    $crud->set_rules('APELLIDO2','Segundo apellido','trim|max_length[30]');
		    $crud->set_rules('ID_TIPO','Rol','required');
		    $crud->set_rules('EMAIL','Email','trim|required|valid_email');
		    $crud->set_rules('TFNO','Telefono','trim|required|exact_length[9]');	    
		    $crud->set_rules('PASSWD','Password','trim|required|min_length[5]|max_length[20]');
		    	    
	    
		    //Valores para el campo ATIVO
		    //$crud->field_type('ACTIVO','dropdown',
		    //		array('SI' => 'SI', 'NO' => 'NO'));
		    
		    //Ocultamos las fechas para que no salgan en el alta o modificacoin
		    
		    $crud->change_field_type('PASSWD', 'password');
		    
		    
		    $crud->fields('USER','NOMBRE','APELLIDO1','APELLIDO2','IDTIPO','EMAIL','TFNO', 'PASSWORD');
		    $crud->callback_before_insert(array($this,'get_date_insert'));
		    $crud->callback_before_update(array($this,'get_date_update'));
		    $crud->callback_before_insert(array($this,'encrypt_password_callback'));	    
		    $crud->callback_before_update(array($this,'encrypt_password_callback'));
		     
		    //Deshabilitamos el boton borrar, solo hacemos borrado logico
		    $crud->unset_delete();
		    
			//REnderizamos la vista 
		    $output = $crud->render();
		 
		    $this->_example_output($output);
    	}	    
    }
      

    function encrypt_password_callback($post_array) {
    	//$this->load->library('encrypt');
    	//$key = 'super-secret-key';
    	//$post_array['password'] = $this->encrypt->encode($post_array['password'], $key);
    	$post_array['PASSWORD'] =sha1($post_array['PASSWORD']); 
    
    	return $post_array;
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
        $this->load->view('gestorUsuarios.php',$output);    
    }
}