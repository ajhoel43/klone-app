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
		$this->prefix = $this->session->userdata('prefix_');
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

	function _generate_birth_date($params)
	{
		if(strlen($params['date']) == 1)
			$params['date'] = "0".$params['date'];
		if(strlen($params['month']) == 1)
			$params['month'] = "0".$params['month'];
		
		$params['birth_date'] = $params['date']."-".$params['month']."-".$params['year'];
		$params['birth_date'] = to_db_date($params['birth_date']);
		unset($params['date']);
		unset($params['month']);
		unset($params['year']);

		return $params;
	}

	function usprev_dropdown($params = array())
	{
		if(isset($params['level']) AND $params['level'] > 1)
		{
			echo "You Have no Permission";
			die();
		}

		if(isset($params['level']))
			$this->db->where('level >=', $params['level']);

		$query = $this->db->get('M_user_previleges')->result();

		$buffer = array();
		$buffer[''] = "- ".lang('user_prev')." -";

		foreach ($query as $q) {
			$buffer[$q->kode_up] = $q->deskripsi;
		}

		return $buffer;
	}

	function get_user_info( $params = array() )
	{
		$this->db->select('
			u.*,
			up.*,
			up.deskripsi as user_type
			');

		$this->db->join('M_user_previleges up', 'up.kode_up = u.user_previleges','left');
		
		if ($params) {
			$this->db->where('username', $params['username']);
			$query = $this->db->get('M_user u')->row_array();
		} else {
			$query = $this->db->get('M_user u')->result();
		}

		return $query;
	}

	function get_list_user($params = array())
	{
		$this->db->select('
			u.*,
			up.deskripsi as user_type
			');

		$this->db->join('M_user_previleges up', 'up.kode_up = u.user_previleges', 'left');
		$this->db->order_by('up.level asc','u.username asc');
		$query = $this->db->get('M_user u')->result();

		return $query;
	}

	function auto_checking( $params = array() )
	{
		$message = '';
		$this->db->select('username, email');
		$type = 0;

		if(isset($params['username']))
		{
			$this->db->where('username', $params['username']);
			$type = 0;
		}

		if(isset($params['email']))
		{
			$this->db->where('email', $params['email']);
			$type = 1;
		}

		$query = $this->db->get('M_user')->row();
		$count = count($query);
		
		if($count == 0 && $type == 0)
		{
			$message = lang('messageUserOk');
		}
		elseif($count > 0 && $type == 0)
		{
			$message = lang('messageUserNotOk');
		}

		if($count == 0 && $type == 1)
		{
			$message = lang('messageEmailOk');
		}
		elseif($count > 0 && $type == 1)
		{
			$message = lang('messageEmailNotOk');
		}

		return array($query, $message);
	}

	function get_user_data( $params = null ) 
	{
		if(isset($params['id']))
			$this->db->where('username', $params['id']);

		$this->db->select('*');
		
		$query = $this->db->get('M_user')->row();
		
		return $query;
	}

	function add_user( $params, $id = null ) 
	{
		$msg = '';
		if($id) {
			$this->db->where('username', $id);
			
			$query = $this->db->update('M_user', $params);

			if(!$query)
				$msg = lang('message_error_update').' M_user';
		} else {
			$query = $this->db->insert('M_user', $params);

			if(!$query)
				$msg = lang('message_error_insert').' M_user';
		}

		return array($query, $msg);
	}

	function delete_user($params)
	{
		$msg = '';

		if(isset($params['username']))
			$this->db->where('username', $params['username']);

		$query = $this->db->delete('M_user');

		if($query)
			$msg = lang('message_success_delete');
		else
			$msg = lang('message_error_delete');

		return array($query, $msg);
	}

	function get_verification_info($params)
	{
		if(isset($params['username']) && !is_null($params['username']))
			$this->db->where('username', $params['username']);

		if(isset($params['email']) && !is_null($params['email']))
			$this->db->where('email', $params['email']);

		$this->db->select('
			username, 
			email, 
			first_name, 
			last_name
			');

		$query = $this->db->get('M_user')->row();
		return $query;
	}
}

?>