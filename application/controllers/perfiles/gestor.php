<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
class Gestor extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
	}
	
	public function index()
	{
		if($this->session->userdata('perfil') == FALSE || $this->session->userdata('perfil') != 'gestor')
		{
			redirect(base_url().'login');
		}
		// Carga la vista de gestor
		$data['titulo'] = 'ICSYPB - Bienvenido Gestor';
        $this->load->view('header.php');
        $this->load->view('perfiles/gestor_menu.php');
        $this->load->view('perfiles/gestor_view',$data);
        $this->load->view('footer.php');
	}
}
