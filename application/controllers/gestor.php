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
		$data['titulo'] = 'Bienvenido de nuevo ' .$this->session->userdata('perfil');
		$this->load->view('gestor_view',$data);
	}
}
