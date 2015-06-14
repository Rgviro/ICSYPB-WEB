<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class gestorUsuario extends CI_Controller {
 
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
        echo "<h1>Gestor de Usuario</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    /*
     * MOSTRAMOS LAS CONVOCATORIAS CON VIGENCIA
     */
    public function gestorConvActivas()
    {

    	
    	//Obtenemos el IDUSUARIO de la session
    	$idusuario = $this->session->userdata('id_usuario');
    	
    	//Comprobamos el login de usuario
    	if ($idusuario == null) {
    		$this->load->view('usuario_no_autorizado.php');
    	}else {
    		
    		if ($this->compruebaAcceso($idusuario)) {
    		
		    	$crud = new grocery_CRUD();
	
					
		    	//Tema twitter bootstrap adaptativo
		    	// desactivado de momento por que no filtra bien en algunos casos
		    	//$crud->set_theme('twitter-bootstrap');    	
		    	//$crud->set_theme('datatables');   
		
			    
				//Indicamos la tabla
			    $crud->set_table('REL_CONVOCATORIA_USUARIO');
			    
			    $crud->where('REL_CONVOCATORIA_USUARIO.IDUSUARIO',$idusuario);	    
			    $crud->where('date_format(str_to_date(REL_CONVOCATORIA_USUARIO.FECHA_LIMITE, \'%d/%m/%Y %H:%i:%s\'), \'%Y%m%d%H%i%s\') >=',date('YmdHis'));
			    $crud->where('LIMITE_ALCANZADO',0);
		
				$crud->display_as('IDCONVOCATORIA','DATOS DE CONVOCATORIA');
				$crud->display_as('IDUSUARIO','NOMBRE USUARIO');
				$crud->display_as('NUM_CAMBIOS_ESTADO','CAMBIOS DE ESTADO');
	
				
				if  ($crud->getState()=='edit') {
	
					
					//establecemos las columnas que queremos visualizar				
					$crud->fields('IDCONVOCATORIA','NUM_CAMBIOS_ESTADO','ACEPTADO', 'FECHA_ACEPTADO', 'LIMITE_ALCANZADO');
	
					$crud->change_field_type('IDCONVOCATORIA','hidden');
					$crud->change_field_type('NUM_CAMBIOS_ESTADO','hidden');
					$crud->change_field_type('FECHA_ACEPTADO','hidden');
					$crud->change_field_type('LIMITE_ALCANZADO','hidden');
					$crud->change_field_type('FECHA_LIMITE','hidden');
					
					
					//Valores para el campo ATIVO
					$crud->field_type('ACEPTADO','dropdown',
							array('SI' => 'SI', 'NO' => 'NO'));					
				
				}else {
	
					//Establecemos relacion.
					$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}');
					$crud->set_relation('IDCONVOCATORIA','CONVOCATORIA','{NOMBRE} en {LOCALIZACION} el {FECHA_EJECUCION}');

					//establecemos las columnas que queremos visualizar
					$crud->fields('IDCONVOCATORIA','IDUSUARIO','ACEPTADO','NUM_CAMBIOS_ESTADO','FECHA_ACEPTADO','FECHA_LIMITE', 'LIMITE_ALCANZADO');									
					
				}
	
				$crud->columns('IDCONVOCATORIA','ACEPTADO','NUM_CAMBIOS_ESTADO','FECHA_ACEPTADO','FECHA_LIMITE');

				//Callback before update
				$crud->callback_before_update(array($this,'get_cambio_estado_fecha_aceptado'));
	
				//quitamos el boton eliminar y añadir
				$crud->unset_delete();
				$crud->unset_add();
		
			    //Nomber que aparece al lado de Añadir
			    $crud->set_subject('Usuario');	    	   
			    
				//REnderizamos la vista 
			    $output = $crud->render();
			 
			    $this->_example_output($output);
			    
    		} else {
    			$this->load->view('usuario_no_autorizado.php');
    		}
    	} 
    }

    /*
     * MOSTRAMOS LAS CONVOCATORIAS CON CADUCIDAD VENCIDA
     */
    public function gestorConvNoActivas()
    {
    	
    	//Obtenemos el IDUSUARIO de la session
    	$idusuario = $this->session->userdata('id_usuario');
    	 
    	//Comprobamos el login de usuario
    	if ($idusuario == null) {
    		$this->load->view('usuario_no_autorizado.php');
    	}else {
    		
    		if ($this->compruebaAcceso($idusuario)) {
	    	 	
		    	$crud = new grocery_CRUD();
		    	 
		    	//Tema twitter bootstrap adaptativo
		    	// desactivado de momento por que no filtra bien en algunos casos
		    	//$crud->set_theme('twitter-bootstrap');
		    	//$crud->set_theme('datatables');
		    
		    	 
		    	//Indicamos la tabla
		    	$crud->set_table('REL_CONVOCATORIA_USUARIO');
		    	
		    	//Establecemos relacion.
		    	$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}');
		    	$crud->set_relation('IDCONVOCATORIA','CONVOCATORIA','{NOMBRE} en {LOCALIZACION} el {FECHA_EJECUCION}');
		    	
		    	
		    	$crud->where('REL_CONVOCATORIA_USUARIO.IDUSUARIO',$idusuario);
				$crud->where('date_format(str_to_date(REL_CONVOCATORIA_USUARIO.FECHA_LIMITE, \'%d/%m/%Y %H:%i:%s\'), \'%Y%m%d%H%i%s\') <',date('YmdHis'));
				$crud->or_where('LIMITE_ALCANZADO',1);
		    
		    
		    	$crud->display_as('IDCONVOCATORIA','DATOS DE CONVOCATORIA');
		    	$crud->display_as('IDUSUARIO','NOMBRE USUARIO');
		    
		    	//Valores para el campo ATIVO
		    	$crud->field_type('ACEPTADO','dropdown',
		    			array('SI' => 'SI', 'NO' => 'NO'));
		    
		    	$crud->columns('IDCONVOCATORIA','ACEPTADO','NUM_CAMBIOS_ESTADO','FECHA_ACEPTADO','FECHA_LIMITE');
		    
		    	
		    	//quitamos el boton eliminar, modificar y añadir
		    	$crud->unset_operations();
		    
		    	//Nomber que aparece al lado de Añadir
		    	$crud->set_subject('Usuario');
		    	 
		    	//REnderizamos la vista
		    	$output = $crud->render();
		    
		    	$this->_example_output($output);
    		} else {
    			$this->load->view('usuario_no_autorizado.php');
    		}		    	
    	 
    	}    
    }    
    
    
    function _example_output($output = null) 
    {
        $this->load->view('gestorUsuario.php',$output);    
    }
    
    
    //Funcion que comprueba el acceso no autorizado
    // y evita la url injection de usuarios
    function compruebaAcceso ($idusuario) {
    	 
    	$url=$this->uri->uri_string();
    	$accesos = explode("/", $url);
    	$cantidad=count($accesos);
    	 
    	if ($cantidad==4)  {
    		
    		if ($accesos[2]=='edit') {
	    		//Comprobamos que podemos acceder al elemento
	    
	    		$date = date('YmdHis');
	    		//Comprobamos si ha llegado al limite de cambios de estado
	    		$query = $this->db->query('SELECT IDRELUSU
									  		FROM REL_CONVOCATORIA_USUARIO
	    							  		WHERE LIMITE_ALCANZADO = 0
	    									AND date_format(str_to_date(FECHA_LIMITE, \'%d/%m/%Y %H:%i:%s\'), \'%Y%m%d%H%i%s\') >= ' .$date.'
	    									AND IDRELUSU ='.$accesos[3] .' AND IDUSUARIO ='.$idusuario);
	    		 
	    		if ($query->num_rows() != 0)
	    		{
	    			return true;
	    
	    		}
    		} else {
    			if ($accesos[2]=='success') {
    				header( 'Location: /gestorUsuario/gestorConvActivas' );
    			} else {
    				return true;
    			}
    		}
    		
    
    	} else {
    		if ($cantidad==2) {
    			return true;
    		}
    		
    
    	}
    	
    	return false;
    	 
    }
    
    //Actualizamos campos before update
    function get_cambio_estado_fecha_aceptado($post_array) {

    	
    	$idconvocatoria = $post_array['IDCONVOCATORIA'];
    	
    	//Aumentamos los cambios de estado
    	(int)$num = $post_array['NUM_CAMBIOS_ESTADO'];
    	$post_array['NUM_CAMBIOS_ESTADO'] = ++$num;

    	//establecemos la fecha de aceptado
    	if ($this->input->post('ACEPTADO') == 'SI') {
    		$post_array['FECHA_ACEPTADO'] = date('d-m-Y H:i:s');
    	}else {
    		$post_array['FECHA_ACEPTADO'] = '';
    	}

    	//Comprobamos si ha llegado al limite de cambios de estado
    	$query = $this->db->query('SELECT NUM_CAMBIOS_ESTADO
								  FROM CONVOCATORIA
    							  WHERE IDCONVOCATORIA ='.$idconvocatoria .' AND NUM_CAMBIOS_ESTADO >'.++$num);
    	
    	if ($query->num_rows() == 0)
    	{
    		$post_array['LIMITE_ALCANZADO'] = 1;

    	}
    	

    	return $post_array;
    }    


}