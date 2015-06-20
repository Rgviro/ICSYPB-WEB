<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Gestor
 *
 * @brief	Menú y acceso para Usuario
 *
 */
class usuario extends CI_Controller 
{
	/**
	 * Constructor
	 *
	 * @brief	Constructor que carga los módulos de base de datos, helpers para URL y formularios
	 */
	public function __construct() {
		parent::__construct();
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
	}
	/**
	 * index
	 *
	 * @brief	Funcion principal del controlador. - Llama a la vista asociada al usuario con perfil usuario. En caso contrario redirige a login.
	 */
	public function index()
	{
		// Comprueba el perfil
		if($this->session->userdata('perfil') == FALSE)
		{
			//Redirige a la pantalla de login
			redirect(base_url().'login');
		}
		// Carga la vista de usuario
		$data['titulo'] = 'ICSYPB - Acceso Usuario';
                $this->load->view('header.php');
                $this->load->view('perfiles/usuario_menu.php');
                $this->load->view('perfiles/usuario_view.php',$data);
                $this->load->view('footer.php');
	}
}
/* Fin de archivo usuario.php */
/* Localización : ./controllers/perfiles/usuario.php */
