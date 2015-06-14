<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class BBDD extends CI_Controller {
 
    function __construct()
    {
        parent::__construct();
		// Bibliotecas CodeIgniter necesarias
		$this->load->database();
		$this->load->helper('url');
		// Biblioteca GroceryCRUD
		$this->load->library('grocery_CRUD');
    }
 
    
    public function index()
    {
        echo "<h1>Welcome to the world of Codeigniter</h1>";//Just an example to ensure that we get into the function
        die();
    }

    
    
    function controlAcceso () {

    /*	
    	$url=$this->uri->uri_string();
    	$accesos = explode("/", $url);
    	$cantidad=count($accesos);
    	$url2=$accesos[3];
    		
    	/*			echo $accesos[0]; //// ci_inici
    	 echo $accesos[1]; //// fnc_ingre_medid
    	 echo $accesos[2]; //// edit
    	 echo $accesos[3]; //// 27
    	*/
    	/*
    	echo $this->uri->segment(1);
    	echo $this->uri->segment(2);
    	echo $this->uri->segment(3);
    	echo $this->uri->segment(4);
    	echo $this->uri->segment();   	
*/

    	$idusuario = 1;
    	
    	if ($this->compruebaAcceso($idusuario)) {
			$crud = new grocery_CRUD();
			
			$crud->set_table('USUARIO');
			$crud->where('IDUSUARIO',$idusuario);
			
			
			$output = $crud->render();
			
			$this->_example_output($output);
		
    	} else {
    		$this->load->view('usuario_no_autorizado.php');
    	}
    	
    	
    } 
    
    
    
   
    

        
    public function readonly_edit_field($value = '', $key = null)
    {
    	return '<div style="margin:6px 0 0">'.$value.'</div>';
    } 
    
    public function bitToBoolean($value = '', $key = null)
    {
    	if ($value == 1) {
    		return 'Si';
    	} else {
    		return 'No';
    	}
    }
    public function changeActivo($value = '', $key = null)
    {
    	if ($value == 1) {
    		return '<div style="margin:6px 0 0">Si</div>';
    	} else {
    		return '<div style="margin:6px 0 0">No</div>';
    	}
    }       
    


    function _example_output($output = null) 
    {
        $this->load->view('bbdd.php',$output);    
    }
}
