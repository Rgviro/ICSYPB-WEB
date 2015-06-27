<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Movil
 *
 * @brief	Controlador para acceso mediante móvil
 *
 */
class Movil extends CI_Controller
{
	/**
	 * Constructor
	 *
	 * @brief	Constructor que carga los módulos de base de datos, helpers para URL, formularios, user_agent, sesión y GroceryGRUD
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('session','form_validation'));
		$this->load->helper(array('url','form'));
	}

	
	/**
	 * home
	 *
	 * @brief	Redirige a login
	 */
	public function home()
	{
		// Comprueba el perfil
		redirect(base_url().'login');
	}

	
/* Fin de archivo movil.php */
/* Localización : ./controllers/movil/movil.php */
