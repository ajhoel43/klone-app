<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class M_jb extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->prefix = $this->session->userdata('prefix_');
	}

	function get_list_jb($params = array())
	{
		if(isset($params['nama_jb']) && $params['nama_jb'] != '')
			$this->db->like('nama_jb', $params['nama_jb']);

		if (isset($params['limit']) && isset($params['start']))
			$this->db->limit($params['limit'], $params['start']);
		else
			$this->db->limit(20);

		$query = $this->db->get('M_jenis_bengkel')->result();

		return $query;
	}

	function get_oneJb($params = array())
	{
		if(isset($params['id']))
			$this->db->where('kode_jb', $params['id']);
		
		$query = $this->db->get('M_jenis_bengkel')->row();

		return $query;
	}

	function add_jb($params, $id = null)
	{
		$params['kode_jb'] = strtolower($params['kode_jb']);

		$rec = $this->get_oneJb(array('id' => $params['kode_jb']));
		$query = 0;
		$msg = lang('label_jb_kode')." is exists";
		
		if(is_null($rec))
		{
			if($id)
			{	
				$this->db->where('kode_jb', $id);
				$query = $this->db->update('M_jenis_bengkel', $params);
				$msg = update_flag($query);
			}
			else
			{
				$query = $this->db->insert('M_jenis_bengkel', $params);
				$msg = insert_flag($query);
			}
		}

		return array($query, $msg);
	}

	function del_jb($id)
	{
		$this->db->where('kode_jb', $id);
		$query = $this->db->delete('M_jenis_bengkel');

		return $query;
	}
}