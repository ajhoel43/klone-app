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

	// function _process_randomstr( $length, $params ) {
	// 	//menghilangkan space dan hanya mengambil karakter A-Z,a-z,0-9
	// 	$karakter = preg_replace("/[^A-Za-z0-9]/",'', $params['username'].$params['id']);
	// 	//set string = null
	// 	$string = '';
	// 	for ($i = 0; $i < $length; $i++) {
	// 		$pos = rand(0, strlen($karakter)-1);
	// 		$string .= $karakter{$pos};
	// 	}
		
	// 	$salt = $this->_create_salt($string);
	// 	$hash = $this->_create_hash($salt, $string);

	// 	return array($string, $salt, $hash);
	// }

	function _create_salt( $string ){
		$salt = substr($string, 0, 3);
		
		return $salt;		
	}

	function _create_hash( $salt, $string ) {
		$hash = hash('sha256', $salt . hash('sha256', $string));

		return $hash;
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
		$query = $this->db->get('M_User');

		return $query;
	}

	function get_user_info($params = null)
	{
		$this->db->select('*');

		if ($params) {
			unset($params['login']);
			$this->db->where('Username', $params['username']);
			$query = $this->db->get('M_User')->row_array();//die(var_dump($query));
		} else {
			$query = $this->db->get('M_User')->result();
		}
		
		return $query;
	}

	function get_user_data( $params = null ) {
		$this->db->select('*');
		if ($params) {
			unset($params['login']);
			// $this->db->select('
			// 	Username, Jenis_User
			// 	');
			$this->db->where('ID_User', $params['ID_User']);
			$query = $this->db->get('M_User')->row();//die(var_dump($query));
		} else {
			//$this->db->select('*');
			$query = $this->db->get('M_User')->result();
		}
		
		return $query;
	}

	function add_user( $params, $id = null ) {
		$msg = '';
		if($id) {
			$this->db->where('ID_User', $id);
			
			unset($params['ID_User']);
			$query = $this->db->update('M_User', $params);

			if(!$query)
				$msg = lang('message_error_update').' M_User';
		} else {
			$query = $this->db->insert('M_User', $params);

			if(!$query)
				$msg = lang('message_error_insert').' M_User';
		}

		return array($query, $msg);
	}
}

?>