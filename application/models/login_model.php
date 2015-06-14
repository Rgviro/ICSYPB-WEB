<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 */
class Login_model extends CI_Model {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function login_user($username,$password)
	{
		// Comparamos los valores de usuario y sha1 del password con lo almacenado
		// en la BBDD
		$this->db->where('USER',$username);
		$this->db->where('PASSWD',$password); //OJO QUE ES SHA1 LO QUE SE ALMACENA
		$query = $this->db->get('USUARIO');
		
		// Si existen datos, se devuelve la fila con los campos
		if($query->num_rows() == 1)
		{
			return $query->row();
		}else{
			// Si no redirect a login con refresh
			$this->session->set_flashdata('usuario_incorrecto','Los datos introducidos son incorrectos');
			redirect(base_url().'login','refresh');
		}
	}
}