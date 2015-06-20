<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class GestorGrupos extends CI_Controller {
 
	const VISTA_GRUPO_USUARIO = 1;
	const VISTA_GRUPO_GESTOR = 2;
	
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
   	// Muestra toda la información, por defecto INFO_ALL
    	phpinfo();

        echo "<h1>Gestor de grupos</h1>";//Just an example to ensure that we get into the function
        die();
    }
    
    //Mantenimiento de grupos y usuarios
    public function gestorGrpUsr()
    {
    	if ($this->session->userdata('perfil') == 'usuario') {
    		$this->load->view('usuario_no_autorizado.php');
    	}else {
	 	
	    	//Mantenimiento de grupos y usuarios
	    	$crud = new grocery_CRUD();
	
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');    	
	    	$crud->set_theme('datatables');
	    	
	    	//Indicamos la tabla  
	    	$crud->set_table('GRUPOS');
	
	    	//Establecemos la relacion
	    	$crud->set_relation_n_n('USUARIOS', 'REL_USU_GRUPO', 'USUARIOS', 'IDGRUPO', 'IDUSUARIO', 'NOMBRE',null,'IDTIPOUSUARIO IN (1,2,3)');    	
			$crud->columns('NOMBRE','DESCRIPCION','ACTIVO','USUARIOS','FECHA_ALTA','FECHA_MODIFICACION','FECHA_BAJA');
	
			//Solo podemos añadir usuarios a grupos, no crearlos
			//De esta manera se tienen que crear primero y añadir un gestor
			$crud->unset_add();
			
	 		//Valores para el campo ATIVO
			$crud->field_type('ACTIVO','dropdown',
					array('SI' => 'SI', 'NO' => 'NO'));		
			
			//Nomber que aparece al lado de Añadir
			$crud->set_subject('Grupo');
	
			$crud->field_type('NOMBRE','readonly');
			$crud->field_type('DESCRIPCION','readonly');
			$crud->field_type('ACTIVO','readonly');
			
			//Ocultamos las fechas para que no salgan en el alta o modificacion
			$crud->change_field_type('FECHA_ALTA','invisible');
			$crud->change_field_type('FECHA_MODIFICACION','invisible');
			$crud->change_field_type('FECHA_BAJA','invisible');
			
	    	$crud->fields('NOMBRE','DESCRIPCION','ACTIVO','USUARIOS','FECHA_ALTA','FECHA_MODIFICACION');
	    	$crud->callback_before_insert(array($this,'get_date_insert'));
	    	$crud->callback_before_update(array($this,'get_date_update'));
	    	
	    	//Deshabilitamos el boton borrar, solo se puede borrar el grupo
	    	//desde el gestor de grupos
	    	$crud->unset_delete();    	
	 		
			//Renderizamos la salida
	 		$output = $crud->render();
	 		
	 		
	 		//Mirar el metodo 
	 		$this->_example_output($output, self::VISTA_GRUPO_USUARIO);
    	}

    }

   
    //Mantenimiento de grupos y gestores    
    public function gestorGrpGtr()
    {
    	//Mantenimiento de grupos y gestores
        $crud = new grocery_CRUD();
        
    	//Tema twitter bootstrap adaptativo
    	// desactivado de momento por que no filtra bien en algunos casos
    	//$crud->set_theme('twitter-bootstrap');    	
    	$crud->set_theme('datatables');    
        
        //Establecemos la tabla
    	$crud->set_table('GRUPOS');
    	
    	//Establecemos la relacion
    	$crud->set_relation_n_n('GESTOR', 'REL_GESTOR_GRUPO', 'USUARIOS', 'IDGRUPO', 'IDUSUARIO', 'NOMBRE',null,'IDTIPOUSUARIO IN (1,2)');    	 
    	$crud->columns('NOMBRE','DESCRIPCION','ACTIVO','GESTOR','FECHA_ALTA','FECHA_MODIFICACION','FECHA_BAJA');
   	
    	
    	//Indicamos los campos obligatorios
    	$crud->required_fields('NOMBRE','ACTIVO', 'GESTOR');

    	//Validaciones sobre los campos
    	$crud->set_rules('NOMBRE','Nombre','trim|required|min_length[5]|max_length[50]');
    	$crud->set_rules('DESCRIPCION','Descripcion','trim|max_length[50]');
    	$crud->set_rules('ACTIVO','Activo','trim|required');
    	    	
    	//Nomber que aparece al lado de Añadir
    	$crud->set_subject('Grupo');
    	
    	//Valores para el campo ATIVO
    	$crud->field_type('ACTIVO','dropdown',
    			array('SI' => 'SI', 'NO' => 'NO'));
    	
    	//Ocultamos las fechas para que no salgan en el alta o modificacoin 
    	$crud->change_field_type('FECHA_ALTA','invisible');
    	$crud->change_field_type('FECHA_MODIFICACION','invisible');
    	$crud->change_field_type('FECHA_BAJA','invisible');
    	

    	$crud->fields('NOMBRE','DESCRIPCION','ACTIVO','GESTOR','FECHA_ALTA','FECHA_MODIFICACION');
    	$crud->callback_before_insert(array($this,'get_date_insert'));
    	$crud->callback_before_update(array($this,'get_date_update'));    	
    	

    	$output = $crud->render();
    	//Mirar el metodo
    	$this->_example_output($output, self::VISTA_GRUPO_GESTOR);
    }

    
    function get_date_insert($post_array) {
    	$post_array['FECHA_ALTA'] = date('d-m-Y H:i:s');
    	return $post_array;
    }
    function get_date_update($post_array) {
    	$post_array['FECHA_MODIFICACION'] = date('d-m-Y H:i:s');
    	return $post_array;
    }
    
    
    function _example_output($output = null, $vista) 
    {
    	$this->grocery_crud->set_theme('twitter-bootstrap');
    	//Cada accion del controller puede devolver una vista
    	//de esta manera elegimos cual
    	switch ($vista) {
    		case 1:
    			$this->load->view('gestorGrpUsr.php',$output);
    			break;
    		case 2:
    			$this->load->view('gestorGrpGtr.php',$output);
    			break;
    	}
    }
}
