<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class gestorConvocatorias extends CI_Controller {
 
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
        echo "<h1>Gestor de Usuarios</h1>";//Just an example to ensure that we get into the function
        die();
    }

 

	//Convocatorias
    public function gestorConv()
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
	    	
	    	//Establecemos la tabla
	    	$crud->set_table('CONVOCATORIA');
	    	$crud->set_subject('Convocatoria');
	
	    	//OJO: Con esta sentencia solo podemos asignar gestores que tengan grupos
	    	$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}','IDUSUARIO IN (SELECT B.IDUSUARIO FROM REL_GESTOR_GRUPO A, USUARIOS B WHERE A.IDUSUARIO = B.IDUSUARIO)');
	    	
	    	//OJO con esta sentencia asignamos usuarios que son gestores o administradores, independientemente de que tengan un grupo
	    	// asociados como gestor
	    	//$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}','IDTIPOUSUARIO IN (SELECT IDTIPOUSUARIO FROM TIPO_USUARIO WHERE IDTIPOUSUARIO IN (1,2))');
	    
	
	    	//OJO: Con esta sentencia solo podemos asignar grupos que tengan usuarios
	    	$crud->set_relation('IDGRUPO','GRUPOS','NOMBRE','IDGRUPO IN (SELECT DISTINCT(IDGRUPO) FROM REL_USU_GRUPO)');
	    	
	    	//OJO con esto sacamos todos los grupos
	    	//$crud->set_relation('IDGRUPO','GRUPOS','NOMBRE');
	
	    	//Indicamos las columnas
	    	$crud->columns('NOMBRE','DESCRIPCION','LOCALIZACION','IDUSUARIO','IDGRUPO','NUM_CAMBIOS_ESTADO','ACTIVO','FECHA_EJECUCION','FECHA_EJECUCION2','FECHA_FIN','FECHA_ALTA','FECHA_MODIFICACION','FECHA_BAJA');
	    	 
	    	$crud->required_fields('IDUSUARIO','IDGRUPO','NOMBRE','LOCALIZACION','NUM_CAMBIOS_ESTADO','ACTIVO','FECHA_EJECUCION','FECHA_FIN');
	    	
	    	//Modificamos display de columnas
	    	$crud->display_as('IDUSUARIO','GESTOR');
	    	$crud->display_as('IDGRUPO','GRUPO CONVOCATORIA');
	    	$crud->display_as('LOCALIZACION','LOCALIZACION');
	    	$crud->display_as('FECHA_EJECUCION','PRIMERA CONV. USUARIOS');
	    	$crud->display_as('FECHA_EJECUCION2','SEGUNDA CONV. USUARIOS');    	
	    	$crud->display_as('FECHA_FIN','FECHA CONVOCATORIA');
	    	$crud->display_as('NUM_CAMBIOS_ESTADO','N. DE CAMBIOS DE ESTADO');
	    	
	    	//Validaciones sobre los campos
	    	$crud->set_rules('NOMBRE','Nombre','trim|required|min_length[5]|max_length[50]');
	    	$crud->set_rules('DESCRIPCION','Descripcion','trim|max_length[50]');
	    	$crud->set_rules('LOCALIZACION','Localizacion','trim|required|min_length[5]|max_length[50]');
	    	$crud->set_rules('ACTIVO','Activo','trim|required');
	    	$crud->set_rules('NUM_CAMBIOS_ESTADO','Cambio de estado','required|numeric|callback_MenorDiez');
	    	$crud->set_rules('FECHA_EJECUCION','Primera convocatoria','required|callback_fechaMayorActual|callback_fechasDistintas[FECHA_EJECUCION2]');    	    	
	    	$crud->set_rules('FECHA_EJECUCION2','Segunda convocatoria','callback_fechaMayorActual|callback_fechasDistintas[FECHA_EJECUCION]|callback_fechaPosterior[FECHA_EJECUCION]');
	    	$crud->set_rules('FECHA_FIN','Limite para confirmar','required|callback_fechaMayorActual|callback_fechaLimiteMayor');
	
	    		
	    	//Valores para el campo ATIVO
	    	$crud->field_type('ACTIVO','dropdown',
	    			array('SI' => 'SI', 'NO' => 'NO'));
	    	
	    	
	    	//Ocultamos las fechas para que no salgan en el alta o modificacion
	    	$crud->change_field_type('FECHA_ALTA','invisible');
	    	$crud->change_field_type('FECHA_MODIFICACION','invisible');
	    	$crud->change_field_type('FECHA_BAJA','invisible');    	
	  
	
	    	$crud->fields('IDUSUARIO','IDGRUPO','NOMBRE','DESCRIPCION','LOCALIZACION','ACTIVO','NUM_CAMBIOS_ESTADO', 'FECHA_EJECUCION','FECHA_EJECUCION2','FECHA_FIN','FECHA_ALTA','FECHA_MODIFICACION');
	    	$crud->callback_before_insert(array($this,'get_date_insert'));
	    	$crud->callback_before_update(array($this,'get_date_update'));    	
	    	
	    	//Componemos la llamada al control de usuarios a convocatorias
	  	  	$crud->add_action('Usuarios', 'http://www.todoparafiestasinfantiles.com/images/bomgr/usuarios.gif', '','ui-icon-plus',array($this,'url_personalizada'));
	
	    	
	    	//Renderizamos la salida
	    	$output = $crud->render();
	    	//OJO la vista que devuelve la pasamos por parametro
	    	//Mirar el metodo
	    	$this->_example_output($output);
    	}       	
    		
    }    
    
        
    //RELACION DE USUARIOS Y CONVOCATORIAS
    public function gestorUsuConv($idconvocatoria, $idgrupo)
    {
		
    	//Comprobamos el login de usuario
    	if ($this->session->userdata('perfil') == 'usuario') {
    		$this->load->view('usuario_no_autorizado.php');
    	}else {    	
	    	//Mantenimiento de grupos y usuarios
	    	$crud = new grocery_CRUD();
	    	
	   	
	    	//Tema twitter bootstrap adaptativo
	    	// desactivado de momento por que no filtra bien en algunos casos
	    	//$crud->set_theme('twitter-bootstrap');
	    	$crud->set_theme('datatables');
	    	 
	    	//Establecemos el caption	
	    	$crud->set_subject('Usuarios Convocatorias');
	    	
	    	//Establecemos la tabla
	    	$crud->set_table('REL_CONVOCATORIA_USUARIO');
	
	    	//Establecemos la relacion con convocatorias
	    	$crud->set_relation('IDCONVOCATORIA','CONVOCATORIA','NOMBRE', 'IDCONVOCATORIA IN ('.$idconvocatoria.')');
	
	    	
	    	//dependiendo del estado en el que nos encontremos
	    	$state = $crud->getState();
	    	if($state == 'add')
	    	{
	    		//Mostramos en el combo de usuarios solo aquellos que no estan añadidos
	    		$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}',
	    				'IDUSUARIO IN (SELECT B.IDUSUARIO FROM REL_USU_GRUPO A, USUARIOS B WHERE A.IDUSUARIO = B.IDUSUARIO AND B.IDUSUARIO NOT IN (SELECT C.IDUSUARIO FROM REL_CONVOCATORIA_USUARIO C WHERE C.IDCONVOCATORIA = '.$idconvocatoria .') AND A.IDGRUPO='.$idgrupo.')');
	    		    		
	    		//Do your cool stuff here . You don't need any State info you are in add
	    		$crud->change_field_type('FECHA_ACUSE_RECIBO','invisible');
	    		$crud->change_field_type('FECHA_ACEPTADO','invisible');
	    		$crud->change_field_type('NUM_CAMBIOS_ESTADO','invisible');
	    		
	    		$crud->field_type('FECHA_LIMITE','dropdown',$this->getFechasConvocatoria($idconvocatoria));
	    		$crud->change_field_type('CODIGO_NOTIF','invisible');
	    		$crud->required_fields('IDCONVOCATORIA','IDUSUARIO','FECHA_LIMITE');
	    		
	    		$crud->add_fields('IDCONVOCATORIA','IDUSUARIO','FECHA_LIMITE', 'CODIGO_NOTIF');
	    	
	    	} 
	    	else
	    	{
	    		
	    		//Mostramos en usuario
	    		$crud->set_relation('IDUSUARIO','USUARIOS','{NOMBRE} {APELLIDO1}');    		

	    		$crud->field_type('FECHA_LIMITE','dropdown',$this->getFechasConvocatoria($idconvocatoria));	    		

	    		$crud->change_field_type('FECHA_ACEPTADO','invisible');
	    		$crud->change_field_type('CODIGO_NOTIF','hidden');
	    		
	    		$crud->edit_fields('FECHA_LIMITE','CODIGO_NOTIF');
	    		$crud->required_fields('FECHA_LIMITE');
	    		
	    	}    	
	
	    	//Valores para el campo ATIVO
	    	$crud->field_type('ACEPTADO','dropdown',
	    			array('SI' => 'SI', 'NO' => 'NO'));
	  	
	    	    	   	
	    	//Modificamos display de columnas
	    	$crud->display_as('IDCONVOCATORIA','CONVOCATORIA');    	
	    	$crud->display_as('IDUSUARIO','NOMBRE USUARIO');
	    	$crud->display_as('NUM_CAMBIOS_ESTADO','CAMBIOS DE ESTADO USUARIO');
	    	$crud->display_as('CODIGO_NOTIF','COIGO NOTIFICACION');    	
	    	
	    	  	
	    	//Friltramos para que solo aparezca la convocatoria para la que estamos 
	    	//añadiendo usuarios. No la han pasado como parametro.
	    	$crud->where('REL_CONVOCATORIA_USUARIO.IDCONVOCATORIA',$idconvocatoria);
	
	    	//EStablecemos los campos obligatorios
	    	//$crud->required_fields('IDCONVOCATORIA','IDUSUARIO','FECHA_LIMITE');
	    	//$crud->fields('IDCONVOCATORIA','IDUSUARIO','FECHA_LIMITE', 'CODIGO_NOTIF');
	    	$crud->callback_before_insert(array($this,'get_codigo_unico_notif'));
	    	$crud->callback_before_update(array($this,'get_codigo_unico_notif'));

	    	//Con este truquito refresco la ventana despues del delete
	    	// que no entra en el crud y no refresca el boton añadir
	    	// cuando hemos borrado un usuario
	    	$crud->set_lang_string('delete_success_message',
	    			'El usuario se ha borrado correctamente.<br/>Espere mientras se refresca la pagina.
		 			<script type="text/javascript">
		  			window.location = "'.site_url(strtolower('gestorConvocatorias').'/'.strtolower('gestorUsuConv').'/'.$idconvocatoria.'/'.$idgrupo ).'";
		 			</script>
		 			<div style="display:none">');
	    	
	    	//Comprobamos que se pueden añadir mas usuarios a la convocatoria
	    	if ($this->canAddUser($idconvocatoria, $idgrupo)) {
	    		//Deshabilitamos el boton editar
	    		//$crud->unset_edit();
	    		$crud->unset_read();
	    	} else {
	    		$crud->unset_add();
	    		//$crud->unset_edit();
	    		$crud->unset_read();
	    		//$crud->unset_operations();
	    	}

	    	
	    		    	
	    	//Renderizamos la salida
	    	$output = $crud->render();
	    	
	    	$this->_example_output($output);
    	}
    
    }
    
    function _example_output($output = null)
    {
    	$this->load->view('gestorConvocatorias.php',$output);
    }    

/******************************************************************************************************
 * 						FUNCIONES AUXILIARES 
 *****************************************************************************************************/    


    
    //Para pasar la url personalizada
    function url_personalizada($primary_key , $row)
    {
    	return site_url('/gestorConvocatorias/gestorUsuConv/'.$row->IDCONVOCATORIA.'/'.$row->IDGRUPO);
    }    
    
    //Comprobamos si existen mas usuarios que añadir al grupo
    public function canAddUser($idconvocatoria, $idgrupo){
    	$query = $this->db->query('SELECT * FROM REL_USU_GRUPO A
								  WHERE A.IDUSUARIO NOT IN (SELECT IDUSUARIO FROM REL_CONVOCATORIA_USUARIO B WHERE B.IDCONVOCATORIA ='.$idconvocatoria .')
								  AND A.IDGRUPO ='.$idgrupo);
    	if ($query->num_rows() > 0)
    	{
    		return true;
    	}else {
    		return false;
    	}
    	
    }
	
    //Obtiene las fechas de la convocatoria para añadir en el combo
    public function getFechasConvocatoria($idconvocatoria) {

    	$query = $this->db->query('select DATE_FORMAT(FECHA_EJECUCION,\'%d/%m/%Y %T\') FECHA_EJECUCION, DATE_FORMAT(FECHA_EJECUCION2,\'%d/%m/%Y %T\') FECHA_EJECUCION2 FROM CONVOCATORIA A
								  WHERE A.IDCONVOCATORIA ='.$idconvocatoria);


    	if ($query->num_rows() > 0)
    	{
    		foreach ($query->result() as $row)
    		{    			
    			return array(
    					"$row->FECHA_EJECUCION" => "PRIMERA CONVOCATORIA " . $row->FECHA_EJECUCION,
    					"$row->FECHA_EJECUCION2" => "SEGUNDA CONVOCATORIA " . $row->FECHA_EJECUCION2,
    			);
    		}
    	}
    }
    
  

    //FUNCIONES DE VALIDACION PERSONALIZADAS
        
    public function MenorDiez($campo){
    	if ($campo > 10){
    		$this->form_validation->set_message('MenorDiez', "La %s debe de ser un valor menor que 10.");
    		return false;
    	}else {
    		return true;
    	}
    }
    //Fechas distintas
	public function fechasDistintas($fecha1, $fecha2) {


		$fechaComparar = date_create_from_format('d/m/Y H:i:s', $fecha1);
		$fechaComparacion = date_create_from_format('d/m/Y H:i:s', $this->input->post($fecha2));
		

		if ($fechaComparar == $fechaComparacion){
			$this->form_validation->set_message('fechasDistintas', "Las fechas de primera y segunda convocatorias deben de ser distintas");
			return false;
		}else {
			return true;
		}
		
	}
	
	//Fecha mayor que la actual	
	public function fechaMayorActual($fecha)
	{
		
		$fechaComparar = date_create_from_format('d/m/Y H:i:s', $fecha);
		$fechaActual = date_create_from_format('d/m/Y H:i:s', date('d/m/Y h:m:s'));

		if ($fecha <> null && ($fechaComparar < $fechaActual)){
			$this->form_validation->set_message('fechaMayorActual', "La %s debe de ser posterior a la fecha actual.");
			return false;			
		}else {
			return true;
		}
		

	}
	
	//Fecha2 posterior a fecha1
	public function fechaPosterior($fecha1, $fecha2)
	{
		
		$fechaComparar = date_create_from_format('d/m/Y H:i:s', $fecha1);
		$fechaComparacion = date_create_from_format('d/m/Y H:i:s', $this->input->post($fecha2));
      
		if ($fechaComparar < $fechaComparacion){
			$this->form_validation->set_message('fechaPosterior', "La %s debe de ser posterior a la fecha de primera convocatoria.");
			return false;
		}else {
			return true;
		}	
	
	}	
	
	public function fechaLimiteMayor($fecha1) {
		
		$fechaLimite = date_create_from_format('d/m/Y H:i:s', $fecha1);
		$fechaPrimera = date_create_from_format('d/m/Y H:i:s', $this->input->post('FECHA_EJECUCION'));
		$fechaSegunda = date_create_from_format('d/m/Y H:i:s', $this->input->post('FECHA_EJECUCION2'));
		
		if (($fechaLimite < $fechaPrimera) || ($fechaLimite < $fechaSegunda)){
			$this->form_validation->set_message('fechaLimiteMayor', "La Fecha de la convocatoria debe de ser posterior a la fecha de primera convocatoria y segunda convocatoria.");
			return false;
		}else {
			return true;
		}		
		
	}
	
	//obtenemos un codigo unico para la notificacion
	function get_codigo_unico_notif($post_array){
		$post_array['CODIGO_NOTIF'] = md5(uniqid(rand(),true));;		
		return $post_array;		
	}
	
	//fechas por defecto
	function get_date_insert($post_array) {
		$post_array['FECHA_ALTA'] = date('d-m-Y H:i:s');
		return $post_array;
	}
	function get_date_update($post_array) {
		$post_array['FECHA_MODIFICACION'] = date('d-m-Y H:i:s');
		return $post_array;
	}

    
  
}