<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Model_user extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function _create_hash( $params = array(), $salt = null, $create = TRUE) {
		
		if($create === FALSE)
		{
			$option = array(
				'cost' => 10,
				'salt' => $salt
				);
		}
		else
		{
			$option = array(
				'cost' => 10,
				'salt' => password_hash(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM), PASSWORD_BCRYPT),
				);
		}

		$pass = password_hash($params['password'], PASSWORD_BCRYPT, $option);
		$hash = password_hash($params['password'].$params['username'], PASSWORD_BCRYPT, $option);

		return array($hash, $option['salt'], $pass);
	}

	function _get_max_id( $params ){
		if ($params['Jenis_User'] == 'Siswa' ) {
			$this->db->like('Jenis_User', $params['juser']);
		} else if ($params['Jenis_User'] == 'Guru') {
			$this->db->like('Jenis_User', $params['juser']);
		} else if ($params['Jenis_User'] == 'Administrator') {
			$this->db->like('Jenis_User', $params['juser']);
		}

		$this->db->select_max('Jenis_User');
		//$this->db->select('')
		$query = $this->db->get('M_user');

		return $query;
	}

	function get_user_info( $params = array() )
	{
		$this->db->select('*');

		if ($params) {
			$this->db->where('username', $params['username']);
			$query = $this->db->get('M_user')->row_array();
		} else {
			$query = $this->db->get('M_user')->result();
		}
		
		return $query;
	}

	function get_user_data( $params = null ) {
		if(isset($params['id']))
			$this->db->where('ID_user', $params['id']);

		$this->db->select('*');
		
		$query = $this->db->get('M_user')->row();
		
		return $query;
	}

	function add_user( $params, $id = null ) {
		$msg = '';
		if($id) {
			$this->db->where('ID_user', $id);
			
			unset($params['ID_user']);
			$query = $this->db->update('M_user', $params);

			if(!$query)
				$msg = lang('message_error_update').' M_user';
		} else {
			$query = $this->db->insert('M_user', $params);

			if(!$query)
				$msg = lang('message_error_insert').' M_user';
		}

		return array($query, $id = $this->db->insert_id(), $msg);
	}
}

?>