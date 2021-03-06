<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class gestorBalizas extends CI_Controller {
 
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
        echo "<h1>Gestor de Balizas</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    //Creacion de Balizas
    public function gestorBlz()
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
			    $crud->set_table('baliza');
			    
			    //Modificamos display de columnas
			    $crud->display_as('TEXTO_ID','DESCRIPCION');			   
			    $crud->display_as('POSICION','POSICION');	
			    //$crud->display_as('IDBALIZA','USER');			   
			   // $crud->display_as('EMAIL','EMAIL');
		   		  
		   		//Establecemos relacion.a
		   		//$crud->set_relation('IDBALIZA','usuario','USER','IDBALIZA IN (SELECT A.IDBALIZA, B.USER FROM contactobaliza as A, usuario as B WHERE A.IDUSUARIO = B.IDUSUARIO)');
				$crud->set_relation_n_n('USER', 'contactobaliza', 'usuario', 'IDBALIZA', 'IDUSUARIO', 'USER',null);  
				$crud->columns('TEXTO_ID','POSICION','USER','ESTROPEADO');

			    //Nomber que aparece al lado de A�adir
			    $crud->set_subject('Baliza');

			    //Valores para el campo Estropeado
			    $crud->field_type('ESTROPEADO','dropdown',
			     		array(1 => 'SI', 0 => 'NO'));

			    
			    $crud->fields('TEXTO_ID','POSICION','IDBALIZA','ESTROPEADO');
			    //Indicamos los campos obligatorios
			  //   $crud->required_fields('MAC','TEXTO_ID','ID_CONTACTO','ESTROPEADO', 'MAIL' );
		   
			    //Deshabilitamos el boton borrar, solo hacemos borrado logico
			    $crud->unset_delete();
			    
				//Renderizamos la vista 
			    $output = $crud->render();
			    $this->load->view('header.php');		    
			    $this->load->view('perfiles/gestor_menu.php');		    		    
	        	$this->load->view('gestorBalizas.php',$output);        		
	    		$this->load->view('footer.php');
			 		    
	    	}	    
						
		}else {
    	
		    $crud = new grocery_CRUD();
		    
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');   
		     
			//Indicamos la tabla
		    $crud->set_table('baliza');
		    
		    //Modificamos display de columnas
		    $crud->display_as('TEXTO_ID','DESCRIPCION');
		    $crud->display_as('MAC','DIRECCION MAC');
		    $crud->display_as('POSICION','POSICION');		   
		    //$crud->display_as('IDBALIZA','USUARIO');
		   // $crud->display_as('ESTROPEADO','ESTROPEADO');
		    $crud->display_as('EMAIL','EMAIL');
	   		  
	   		//Establecemos relacion.a
		   		//$crud->set_relation('IDBALIZA','usuario','USER','IDBALIZA IN (SELECT A.IDBALIZA, B.USER FROM contactobaliza as A, usuario as B WHERE A.IDUSUARIO = B.IDUSUARIO)');
				 $crud->set_relation_n_n('USER', 'contactobaliza', 'usuario', 'IDBALIZA', 'IDUSUARIO', 'USER',null);  
				$crud->columns('TEXTO_ID','POSICION','USER','ESTROPEADO');

			    //Nomber que aparece al lado de A�adir
			    $crud->set_subject('Baliza');

			    //Valores para el campo Estropeado
			    $crud->field_type('ESTROPEADO','dropdown',
			     		array(1 => 'SI', 0 => 'NO'));

			    
			    $crud->fields('MAC','TEXTO_ID','POSICION','ESTROPEADO');
			    //Indicamos los campos obligatorios
			  //   $crud->required_fields('MAC','TEXTO_ID','ID_CONTACTO','ESTROPEADO', 'MAIL' );
		   
		    
		  		   
		     
		    //Deshabilitamos el boton borrar, solo hacemos borrado logico
		    $crud->unset_delete();
		    
			//REnderizamos la vista 
		    $output = $crud->render();
		    $this->load->view('header.php');		    
		    $this->load->view('perfiles/admin_menu.php');		    		    
        	$this->load->view('gestorBalizas.php',$output);        		
    		$this->load->view('footer.php');
		 		    
    	}	    
    }
    
//Asignacionde responsables a Balizas
    public function gestorBlzUsuario()
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
			    $crud->set_table('contactobaliza');
			    echo $this->session->userdata('id_usuario');
			    //$crud->where('IDBALIZA','IDBALIZA IN ( SELECT IDBALIZA FROM balizasrutagestor WHERE GESTOR = ' & $this->session->userdata('id_usuario') & ')');
			    //$crud->where('IDUSUARIO',$this->session->userdata('id_usuario'));
			    //Modificamos display de columnas
			    $crud->display_as('IDUSUARIO','Responsable');
			    $crud->display_as('IDBALIZA','Baliza');
			    
		   		//Establecemos relacion.'{username} - {last_name} 
		   		$crud->set_relation('IDBALIZA','baliza','TEXTO_ID');
		   		$crud->set_relation('IDUSUARIO','usuario','USER');	   		
		
				$crud->columns('IDBALIZA','IDUSUARIO');

			    //Nomber que aparece al lado de A�adir
			    $crud->set_subject('Responsable de Baliza');
			    
			    $crud->fields('IDBALIZA','IDUSUARIO');
		   
			    //Deshabilitamos el boton borrar, solo hacemos borrado logico
			    $crud->unset_delete();
			    
				//Renderizamos la vista 
			    $output = $crud->render();
			    $this->load->view('header.php');		    
			    $this->load->view('perfiles/gestor_menu.php');		    		    
	        	$this->load->view('gestorBalizas.php',$output);        		
	    		$this->load->view('footer.php');
			 		    
	    	}	    
						
		}
		else {
    	
		    $crud = new grocery_CRUD();
		    
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');   
		     
			//Indicamos la tabla
		    $crud->set_table('contactobaliza');
		    
		    //Modificamos display de columnas
		    $crud->display_as('IDUSUARIO','Responsable');
		    $crud->display_as('IDBALIZA','Baliza');
		   
	   		//Establecemos relacion.'{username} - {last_name} 
	   		$crud->set_relation('IDBALIZA','baliza','TEXTO_ID');
	   		$crud->set_relation('IDUSUARIO','usuario','USER');	   		
	
			$crud->columns('IDBALIZA','IDUSUARIO');

		    //Nomber que aparece al lado de A�adir
		    $crud->set_subject('Responsable de Baliza');
		    
		    $crud->fields('IDBALIZA','IDUSUARIO');
		    
			//REnderizamos la vista 
		    $output = $crud->render();
		    $this->load->view('header.php');		    
		    $this->load->view('perfiles/admin_menu.php');		    		    
        	$this->load->view('gestorBalizas.php',$output);        		
    		$this->load->view('footer.php');
		 		    
    	}	    
    }    
      
//Visualizacion de Balizas
    public function mostarBlz()
    {

    	if ($this->session->userdata('perfil') != 'administrador') {
			//redirect(base_url().'login');
			$this->load->view('usuario_no_autorizado.php');
						
		}else {
    	
		    $crud = new grocery_CRUD();
		    
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	//$crud->set_theme('datatables');   
		     
			//Indicamos la tabla
		    $crud->set_table('baliza');
		    
		    //Modificamos display de columnas
		    
		   // $crud->display_as('MAC','MAC');
		   //  $crud->display_as('POSICION','POSICION');	     
		   //  $crud->display_as('TEXTO_ID','DESCRIPCION');
		    $crud->display_as('ID_CONTACTO','PERSONA');
		  //   $crud->display_as('ESTROPEADO','ESTROPEADO');
		     $crud->display_as('MAIL','EMAIL');
	   
		    //Establecemos relacion.
		    //$crud->set_relation('ID_CONTACTO','USUARIO','IDUSUARIO');
	
		    //Nomber que aparece al lado de A�adir
		    $crud->set_subject('baliza');
		    
		    //Indicamos los campos obligatorios
		     $crud->required_fields('MAC','TEXTO_ID','ID_CONTACTO','ESTROPEADO', 'MAIL' );
	
		    
		    //Validaciones sobre los campos
		     $crud->set_rules('MAC','Direccion MAC','trim|required|min_length[17]|max_length[20]');
		     $crud->set_rules('POSICION','POSICION GPS','trim|required|min_length[10]|max_length[20]');
		     $crud->set_rules('TEXTO_ID','Descripcion','trim|max_length[30]');		    
		     $crud->set_rules('ID_CONTACTO','Persona Contacto','required');
		     $crud->set_rules('EMAIL','Email','trim|required|valid_email');		    
		    	    
	    
		    //Valores para el campo Estropeado
		  //   $crud->field_type('ESTROPEADO','dropdown',
		  //   		array('SI' => 'SI', 'NO' => 'NO'));
		    
		    
		    
		    
		   $crud->fields('MAC','POSICION','TEXTO_ID','ID_CONTACTO','EMAIL');
		   
		     
		    //Deshabilitamos el boton borrar, solo hacemos borrado logico
		    $crud->unset_delete();
		    
			//Renderizamos la vista 
		    $output = $crud->render();
		 
		    $this->_example_output($output);
    	}	    
    }
      
   
    function _example_output($output = null) 
    {
        $this->load->view('gestorBalizas.php',$output);    
    }}
