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
	 * sconvconfirmnotif
	 *
	 * @brief	Funcion principal del controlador - Llama a la vista asociada al Codigo_Notif. En caso contrario redirige a login.
	 */
	public function sconvconfirmnotif($codigoNotif)
	{

		$query = $this->db->query('SELECT A.NUM_CAMBIOS_ESTADO, A.FECHA_LIMITE, B.NOMBRE, B.DESCRIPCION, B.LOCALIZACION, B.FECHA_FIN
    							  FROM REL_CONVOCATORIA_USUARIO A INNER JOIN CONVOCATORIA B
    							  ON A.IDCONVOCATORIA = B.IDCONVOCATORIA
								  WHERE A.CODIGO_NOTIF =\''.$codigoNotif .'\'' );
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$veces = $row->NUM_CAMBIOS_ESTADO;
				$fecha = date_create_from_format('d/m/Y H:i:s', $row->FECHA_LIMITE);
				if ($veces == 0){
					if ($fecha >= date('d/m/Y H:i:s')){

						$data['codigoNotif'] = $codigoNotif ;
						$data['NOMBRE'] = $row->NOMBRE;
						$data['DESCRIPCION'] = $row->DESCRIPCION;
						$data['LOCALIZACION'] = $row->LOCALIZACION;
						$data['FECHA_FIN'] = $row->FECHA_FIN;

						//Carga la pagina de 2 botones
						$this->load->view('movil/movil.php', $data);
					}else {
						$this->load->view('movil/confirm_conv_no_permitido.php');
					}
				} else {
						$this->load->view('movil/confirm_conv_no_permitido.php');
									}
			}
		}
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

	/**
	 * Accept_CNV
	 *
	 * @brief	Método para aceptar la convocatoria según el código de notificación recibido
	 *
	 * @param $codigoNotif	Código de notificación
	 */
	function Accept_CNV($codigoNotif)
    {
		$query = $this->db->query('UPDATE REL_CONVOCATORIA_USUARIO A
		SET A.FECHA_ACEPTADO = now(),
		A.ACEPTADO = \'SI\', A.NUM_CAMBIOS_ESTADO=1	WHERE A.CODIGO_NOTIF =\''.$codigoNotif .'\'');
		//Carga la vista de 2 botones
		$this->load->view('movil/confirm_conv_ok');
	}

// 	Funcion para acepatr la convocatoria

	/**
	 * Deny_CNV
	 *
	 *	@brief	Método para denegar la convocatoria según el código de notificación recibido
	 *
	 * @param $codigoNotif	Código de notificación
	 */
	function Deny_CNV($codigoNotif)
    {
    	$query = $this->db->query('UPDATE REL_CONVOCATORIA_USUARIO A
		SET A.FECHA_ACEPTADO = now(),
		A.ACEPTADO = \'NO\', A.NUM_CAMBIOS_ESTADO=1	WHERE A.CODIGO_NOTIF =\''.$codigoNotif .'\'');
		//Carga la vista de 2 botones
		$this->load->view('movil/confirm_conv_nok');
	}

}
/* Fin de archivo movil.php */
/* Localización : ./controllers/movil/movil.php */
