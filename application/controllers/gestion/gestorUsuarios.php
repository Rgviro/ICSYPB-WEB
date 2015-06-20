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
 
    
    /**
     * index
     *
     * @brief	Representa los métodos públicos accesibles de esta clase
     */
    public function index()
    {
    	  echo "<h1>Clase GestorUsuarios";
    	  echo "<h2>*gestorusuarios()<h2>";
    	  die();
    }

    /**
     * gestorusuarios
     *
     * @brief	Genera el CRUD de gestión de los usuarios.
     */
    public function crud_gestorusuarios()
    {

    	if ($this->session->userdata('perfil') != 'administrador') $this->load->view('errores/usuario_no_autorizado.php');
		else {

			// CRUD - USUARIOS
		    $crud = new grocery_CRUD();
		    
		    if ($this->agent->is_mobile()) {
			// Cargamos theme twitter-bootstrap para GroceryCRUD
	    	    	$crud->set_theme('twitter-bootstrap');
		    }
	    	    else {
			// Cargamos theme datatables clasico para escritorio
			$crud->set_theme('datatables');
		    }
		     
			//Indicamos la tabla
		    $crud->set_table('usuario');
		    
		    //Modificamos display de columnas
		    
		    $crud->display_as('USER','USUARIO');
		    $crud->display_as('NOMBRE','NOMBRE');	     
		    $crud->display_as('APELLIDO1','PRIMER APELLIDO');
		    $crud->display_as('APELLIDO2','SEGUNDO APELLIDO');
		    $crud->display_as('ID_TIPO','ROL');
		    $crud->display_as('EMAIL','E MAIL');
		    $crud->display_as('TFNO','TELEFONO');
		    $crud->display_as('PASSWD','CLAVE');
	   
		    //Establecemos relacion.
		   // $crud->set_relation('ID_TIPO','tipousuario','IDTIPO');
		 	
		    //Nomber que aparece al lado de Añadir
		    $crud->set_subject('Usuario');
		    
		    //Columnas de la rejilla
		    $crud->columns('USER','NOMBRE','APELLIDO1','APELLIDO2', 'ID_TIPO','EMAIL', 'TFNO');
		    //Indicamos los campos obligatorios
		    $crud->required_fields('USER','NOMBRE','EMAIL', 'TFNO','PASWD');
	
		    
		    //Validaciones sobre los campos
		    $crud->set_rules('USER','usuario','trim|required|min_length[5]|max_length[20]');
		    $crud->set_rules('NOMBRE','Nombre','trim|required|min_length[5]|max_length[20]');
		    $crud->set_rules('APELLIDO1','Primer apellido','trim|max_length[30]');
		    $crud->set_rules('APELLIDO2','Segundo apellido','trim|max_length[30]');
		    $crud->set_rules('ID_TIPO','ID_TIPO','required');
		    $crud->set_rules('EMAIL','Email','trim|required|valid_email');
		    $crud->set_rules('TFNO','Telefono','trim|required|exact_length[9]');	    
		    $crud->set_rules('PASSWD','Password','trim|required|min_length[5]|max_length[20]');
		    	    
		    //Deshabilitamos el boton borrar, solo hacemos borrado logico
		    $crud->unset_delete();

			// RENDER DEL CRUD
		    $output = $crud->render();
		    $this->_load_view($output, self::VISTA_ALTA_USUARIO);
    	  }
    }

	/**
	 *  crud_cambiopassword
	 *
	 *  @brief	Cambio de password para usuario
	 */
    public function crud_cambiopassword()
    {
    	// Solo para administrador
    	if ($this->session->userdata('perfil') != 'administrador') $this->load->view('errores/usuario_no_autorizado.php');
    	else {

    		// CRUD - USUARIOS
    		$crud = new grocery_CRUD();

    		if ($this->agent->is_mobile()) {
    			// Cargamos theme twitter-bootstrap para GroceryCRUD
    			$crud->set_theme('twitter-bootstrap');
    		}
    		else {
    			// Cargamos theme datatables clasico para escritorio
    			$crud->set_theme('datatables');
    		}

    		//Indicamos la tabla
    		$crud->set_table('USUARIOS');
    		$crud->order_by('NOMBRE','asc');

    		//Modificamos display de columnas
    		$crud->display_as('IDTIPOUSUARIO','ROL');
    		$crud->display_as('NOMBRE','NOMBRE');
    		$crud->display_as('APELLIDO1','PRIMER APELLIDO');
    		$crud->display_as('APELLIDO2','SEGUNDO APELLIDO');
	    //Establecemos relacion.
		    $crud->set_relation('ID_TIPO','tipousuario','IDTIPO');
    		//Columnas de la rejilla
    		$crud->columns('IDTIPOUSUARIO','NOMBRE','APELLIDO1','APELLIDO2', 'TELEFONO','EMAIL', 'ACTIVO', 'FECHA_ALTA');
    		     		
    		//Nombre que aparece al lado de Añadir
    		$crud->set_subject('Usuario');

    		//Indicamos los campos obligatorios
    		$crud->required_fields('USUARIO','PASSWORD' );

    		//Validaciones sobre los campos
    		$crud->set_rules('USUARIO','Usuario','trim|required|min_length[5]|max_length[20]');
    		$crud->set_rules('PASSWORD','Password','trim|required|min_length[5]|max_length[40]|callback_rules_password_cambiado');
		    //Valores para el campo tipo
		    //$crud->field_type('ID_TIPO','dropdown',
		   	//	array('1' => '1', '2' => '2', '3' => '3'));
		    //
		    //Ocultamos las fechas para que no salgan en el alta o modificacoin
		    
		    $crud->change_field_type('PASSWD', 'password');
		    
    		$crud->edit_fields('USUARIO','PASSWORD');
    		

    		// Campos y funciones de callback
    		$crud->callback_edit_field('PASSWORD',array($this,'cb_edit_password'));
    		$crud->callback_before_update(array($this,'cb_before_update'));

    		//Deshabilitamos el boton borrar, solo hacemos borrado logico
    		$crud->unset_delete();
    		$crud->unset_add();
    		$crud->unset_read();

    		// RENDER DEL CRUD
    		$output = $crud->render();
    		$this->_load_view($output, self::VISTA_MODIF_PASS);
    	}
    }

    /**
     * crud_cambiopasswordusuario
     *
     * @brief	CRUD de cambio password para usuario
     */
    public function crud_cambiopasswordusuario() {
    	$crud = new grocery_CRUD();

    	//Indicamos la tabla
    	$crud->set_table('usuario');
    	$crud->edit_fields('USUARIO','PASSWORD');

    	//Ocultamos las fechas para que no salgan en el alta o modificacion
    	
    	$crud->change_field_type('PASSWORD', 'password');

    	$crud->edit_fields('USUARIO','PASSWORD');
    	$crud->callback_edit_field('PASSWORD',array($this,'cb_edit_password'));
    	$crud->callback_before_update(array($this,'cb_before_update'));


    	//Indicamos los campos obligatorios
    	$crud->required_fields('USUARIO','PASSWORD');

    	
    	//Validaciones sobre los campos
    	$crud->set_rules('USUARIO','Usuario','trim|required|min_length[5]|max_length[20]');
    	$crud->set_rules('PASSWORD','Password','trim|required|min_length[5]|max_length[40]||callback_rules_password_cambiado');

    	$crud->unset_add();
    	$crud->unset_delete();
    	$crud->unset_list();

    	//Para controlar que no se haga otra cosa que editar
    	$crud->unset_back_to_list();

    	//Identificamos la operacion y si no esta editando lo redirigimos a editar.
    	$state_code = $crud->getState();
    	if($state_code == 'unknown' || $state_code == 'list') {
    		redirect("gestion/gestorusuarios/crud_cambiopasswordusuario/edit/" . $this->session->userdata('id_usuario'));
    	}

    	//Comprobamos que solo podemos cambiar nuestra password
    	$segment_object = $crud->getStateInfo();
    	$primary_key = $segment_object->primary_key;
    	if($primary_key != $this->session->userdata('id_usuario')) {
    		$this->load->view('header.php');
    		$this->load->view('errores/usuario_no_autorizado.php');
    		$this->load->view('footer.php');
    	} else {

	    	// RENDER DEL CRUD
    		$output = $crud->render();
    		$this->_load_view($output, self::VISTA_MODIF_PASS);
    	}
    }
		 



    /**
     * rules_password_cambiado
     *
     * @brief	Función callback de validación - Comprueba que el password no sea el de por defecto
     *
     * @param $campo	Parámetro de Password
     * @return boolean	True/False si se ha cambiado o no
     */
    function rules_password_cambiado($campo){
    	if ($campo == 'NUEVA PASSWORD'){
    		$this->form_validation->set_message('rules_password_cambiado', "La %s debe cambiarse.");
    		return false;
    	}else return true;
    }

    /**
     * cb_edit_password
     *
     * @brief	Funcrion de callback para resetear la contrase�a
     *
     * @param $post_array Vector de texto para contraseña
     * @return $post_array Vector de texto cifrado
     */
    function cb_edit_password($value, $primary_key)
    {
    	return '<input type="text" maxlength="50" value="NUEVA PASSWORD" name="PASSWORD" style="width:462px">';
    }


  /**
   * cb_encrypt_password_callback
   *
   * @brief	Función de callback para cifrar la contraseña con sha1
   *
   * @param $post_array Vector de texto para contraseña
   * @return $post_array Vector de texto cifrado
   */
  function cb_encrypt_password_callback($post_array)
  {
    //$this->load->library('encrypt');
    //$key = 'super-secret-key';
    //$post_array['password'] = $this->encrypt->encode($post_array['password'], $key);
    $post_array['PASSWORD'] =sha1($post_array['PASSWORD']);
    return $post_array;
  }


  /**
   * cb_before_insert
   *
   * @brief	Funcion que añade  y cifra el password
   *
   * @param $post_array
   * @return $post_array
   */
  function cb_before_insert($post_array)
  {    
    $post_array['PASSWORD'] =sha1($post_array['PASSWORD']);
    return $post_array;
  }


  /**
   * cb_before_update
   *
   * @brief	Funcion que añade la fecha de modificacion y cifra el password
   *
   * @param $post_array Vector de texto para fecha de modificación
   * @return $post_array Vector de texto con fecha adaptada
   */
  function cb_before_update($post_array)
  {
    	
    	$post_array['PASSWORD'] =sha1($post_array['PASSWORD']);
    	return $post_array;
  }


  /**
   * _load_view
   *
   * @brief	Carga la vista asociada al controlador, en este caso gestion/gestorusuarios_view.php
   *
   * @param $output Vista renderizada
   */
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
			$this->load->view('gestion/gestorusuarios_view.php',$output);
			break;
		case 2:
			// Vista de gestor de grupos con gestores con gestores asignados al grupo
			$this->load->view('gestion/gestorusuariospassword_view.php',$output);
			break;
	}


        $this->load->view('footer.php');
  }

}

/* Fin de archivo gestorusuarios.php */
/* Localización : ./controllers/gestion/gestorusuarios.php */
