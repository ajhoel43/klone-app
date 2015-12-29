<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class M_bengkel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->prefix = $this->session->userdata('prefix_');
	}

	function get_list_bengkel($params = array())
	{
		if(isset($params['nama_bengkel']) && $params['nama_bengkel'] != '')
			$this->db->like('b.nama_bengkel', $params['nama_bengkel']);

		if(isset($params['jenis_bengkel']) && $params['jenis_bengkel'] != '')
			$this->db->where('b.jenis_bengkel', $params['jenis_bengkel']);

		if (isset($params['limit']) && isset($params['start']))
			$this->db->limit($params['limit'], $params['start']);

		$this->db->select('
			b.*,
			jb.nama_jb
			');
		$this->db->join('M_jenis_bengkel jb', 'jb.kode_jb = b.jenis_bengkel', 'left');
		$query = $this->db->get('M_bengkel b')->result();

		return $query;
	}

	function get_onebengkel($params = array())
	{
		if(isset($params['id']))
			$this->db->where('ID_bengkel', $params['id']);
		
		$query = $this->db->get('M_bengkel')->row();

		return $query;
	}

	function get_maxID($params = array())
	{
		if(isset($params['id']))
			$this->db->like('ID_bengkel', $params['id'], 'after');

		$this->db->select_max('ID_bengkel', 'ID');
		$query = $this->db->get('M_bengkel')->row();

		return $query;
	}

	function add_bengkel($params, $id = null)
	{
		// $params['kode_bengkel'] = strtolower($params['kode_bengkel']);

		// Manual check for same id record
		$rec = $this->get_onebengkel(array('id' => $params['ID_bengkel']));
		$query = 0;
		$msg = lang('label_bengkel')." is exists";

		if($id)
		{
			$rec1 = $this->get_onebengkel(array('id' => $id));
			if($rec1->kode_bengkel == $params['ID_bengkel'] OR is_null($rec))
			{
				$this->db->where('ID_bengkel', $id);
				$query = $this->db->update('M_bengkel', $params);
				$msg = update_flag($query);
			}
		}
		else
		{
			if(is_null($rec))
			{
				$query = $this->db->insert('M_bengkel', $params);
				$msg = insert_flag($query);
			}
		}

		return array($query, $msg);
	}

	function del_bengkel($id)
	{
		$this->db->where('ID_bengkel', $id);
		$query = $this->db->delete('M_bengkel');

		return $query;
	}
}