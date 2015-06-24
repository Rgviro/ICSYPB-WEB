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
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');   
		     
			//Indicamos la tabla
		    $crud->set_table('usuario');
		    //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Usuario');
		    
		    //Modificamos display de columnas
		    
		    $crud->display_as('USER','USUARIO');
		    $crud->display_as('NOMBRE','NOMBRE');	     
		    $crud->display_as('APELLIDO1','PRIMER APELLIDO');
		    $crud->display_as('APELLIDO2','SEGUNDO APELLIDO');
		    $crud->display_as('IDTIPO','ROL');
		    $crud->display_as('EMAIL','E MAIL');
		    $crud->display_as('TFNO','TELEFONO');
		    $crud->display_as('PASSWD','CLAVE');
	   
		    //Establecemos relacion.
		    
		   $crud->set_relation('IDTIPO','tipousuario','DESCRIPCION');
		 	
		  
		    //Indicamos los campos obligatorios
		    $crud->required_fields('USER','NOMBRE','EMAIL', 'TFNO','PASWD');
	
		    
		    //Validaciones sobre los campos
		    $crud->set_rules('USER','usuario','trim|required|min_length[5]|max_length[20]');
		    $crud->set_rules('NOMBRE','Nombre','trim|required|min_length[5]|max_length[20]');
		    $crud->set_rules('APELLIDO1','Primer apellido','trim|max_length[50]');
		    $crud->set_rules('APELLIDO2','Segundo apellido','trim|max_length[50]');
		    //$crud->set_rules('ID_TIPO','ID_TIPO','required');
		    $crud->set_rules('EMAIL','Email','trim|required|valid_email');
		    $crud->set_rules('TFNO','Telefono','trim|required|exact_length[9]');	    
		    $crud->set_rules('PASSWD','Password','trim|required|min_length[5]|max_length[20]');
		    	    
	    //Establecemos relacion.
		  //  $crud->set_relation('ID_TIPO','tipousuario','IDTIPO');
		   
		    //Valores para el campo tipo
		    //$crud->field_type('ID_TIPO','dropdown',
		   	//	array('1' => '1', '2' => '2', '3' => '3'));
		    //
		    //Ocultamos las fechas para que no salgan en el alta o modificacoin
		    
		    $crud->change_field_type('PASSWD', 'password');
		    
		    
		    $crud->fields('USER','NOMBRE','APELLIDO1','APELLIDO2','IDTIPO','EMAIL','TFNO', 'PASSWD');
		    
		    //Deshabilitamos el boton borrar, solo hacemos borrado logico
		    $crud->unset_delete();
		    
			//REnderizamos la vista 
		    $output = $crud->render();
		 
		    $this->load->view('header.php');
		    if ($this->session->userdata('perfil') == 'administrador') {
		    	$this->load->view('perfiles/admin_menu.php');
		    }
		    else{}	
		    
        	$this->load->view('gestorUsuarios.php',$output);     		
    		$this->load->view('footer.php');
    	}	    
    }
      
    //Asignacion de gestores
    public function gestorGsr()
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
		    $crud->set_table('rutagestor');
		    //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Gestor a Ruta');
		    
		    //Modificamos display de columnas
		    
		    $crud->display_as('IDRUTA','RUTA');
		    $crud->display_as('IDUSUARIO','GESTOR');	
		    //Establecemos relacion.
		    
		   $crud->set_relation('IDRUTA','ruta','DESCRIPCION');
		   $crud->set_relation('IDUSUARIO','usuario','USER','USER IN(SELECT USER FROM usuario WHERE IDTIPO= 2 OR IDTIPO =1)');
		   //$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}','IDTIPOUSUARIO IN (SELECT IDTIPOUSUARIO FROM TIPO_USUARIO WHERE IDTIPOUSUARIO IN (1,2))');
		  
		    //Indicamos los campos obligatorios
		    $crud->required_fields('IDRUTA','IDUSUARIO');
		    
		    $crud->fields('IDRUTA','IDUSUARIO');		    
		    
			//REnderizamos la vista 
		    $output = $crud->render();
		 
		    $this->load->view('header.php');
		    if ($this->session->userdata('perfil') == 'administrador') {
		    	$this->load->view('perfiles/admin_menu.php');
		    }
		    else{}	
		    
        	$this->load->view('gestorUsuarios.php',$output);     		
    		$this->load->view('footer.php');
    	}	    
    }

//gestorGsr
    function encrypt_password_callback($post_array) {
    	//$this->load->library('encrypt');
    	//$key = 'super-secret-key';
    	//$post_array['password'] = $this->encrypt->encode($post_array['password'], $key);
    	$post_array['PASSWD'] =sha1($post_array['PASSWD']); 
    
    	return $post_array;
    }  
}