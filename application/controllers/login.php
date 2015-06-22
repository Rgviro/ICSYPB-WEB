<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('login_model'); // Modelo con metodo login_user()
		$this->load->library(array('session','form_validation')); // Bibliotecas Session y Form_Validation
		$this->load->helper(array('url','form')); // Carga los Helper URL y FORM de CodeIgniter
		$this->load->database();
    }
	
    
    /** index()
     *   Funcion principal del controlador
     *   Llama a cada controlador dependiendo del perfil, o muestra la vista
     *   de login para iniciar sesion.
     */
	public function index()
	{	
		switch ($this->session->userdata('perfil')) {
			case '':
				$data['token'] = $this->token();
				$data['titulo'] = 'ICSYPB - Track Your Way';
				$this->load->view('login_view',$data);
				break;
			case 'administrador':
				redirect(base_url().'perfiles/admin');
				break;
			case 'gestor':
				redirect(base_url().'perfiles/gestor');
				break;
			case 'usuario':
				redirect(base_url().'perfiles/usuario');
				break;
			default:
				$data['titulo'] = 'ICSYPB - Sistema de Convocatorias';
				$this->load->view('login_view',$data);
				break;		
		}
	}

	/**
	 * new_user()
	 *  Funcion de entrada de nuevo usuario en el sistema.
	 *  Comprueba el token, usuario y pass
	 */
	public function new_user()
	{
		if($this->input->post('token') && $this->input->post('token') == $this->session->userdata('token'))
		{
            $this->form_validation->set_rules('username', 'Usuario', 'required|trim|min_length[2]|max_length[150]|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|max_length[150]|xss_clean');

            //Comprovamos si está validado
			if($this->form_validation->run() == FALSE) $this->index();
			else{
				// Hacemos POST de usuario y password (OJO Pass con SHA1)
				$username = $this->input->post('username');				
				$password = sha1($this->input->post('password'));
				
				// Llamamos al modelo para recoger los datos de usuario
				$check_user = $this->login_model->login_user($username,$password);
				
				// Si el modelo devuelve ok, guardamos los datos en el array $data
				// y los añadimos a la sesion con set_userdata
				if($check_user == TRUE)
				{
					switch ($check_user->IDTIPO) {
						case 1:
							$data = array(
			                'is_logued_in' 	=> 		TRUE,
			                'id_usuario' 	=> 		$check_user->IDUSUARIO,
			                'perfil'		=>		'administrador',
			                'username' 		=> 		$check_user->USER
		            		);
							break;
						case 2:
							$data = array(
			                'is_logued_in' 	=> 		TRUE,
			                'id_usuario' 	=> 		$check_user->IDUSUARIO,
			                'perfil'		=>		'gestor',
			                'username' 		=> 		$check_user->USER
		            		);
							break;
						case 3:
							$data = array(
			                'is_logued_in' 	=> 		TRUE,
			                'id_usuario' 	=> 		$check_user->IDUSUARIO,
			                'perfil'		=>		'usuario',
			                'username' 		=> 		$check_user->USER
		            		);
							break;
						default:
							break;
					}
										
					$this->session->set_userdata($data);
					$this->index();
				}
			}
		}else{
			redirect(base_url().'login');
		}
	}
	
	
	/**
	 * token()
	 *   Metodo que genera un token de sesion utilizando MD5 y un random()
	 */
	public function token()
	{
		$token = md5(uniqid(rand(),true));
		$this->session->set_userdata('token',$token);
		return $token;
	}
	
	
	/**
	 * logout_ci()
	 *   Metodo que destruye la sesión actual
	 */
	public function logout_ci()
	{
		$this->session->sess_destroy();
		//$this->index();
		redirect(base_url().'login');
	}
}
/* Fin de archivo login.php */
/* Localización : ./controllers/login.php */
