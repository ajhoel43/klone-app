<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class M_jeken extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->prefix = $this->session->userdata('prefix_');
	}

	function jeken_dropdown()
	{
		$buffer = array();
		$buffer[''] = '- '.lang('label_jeken').' -';

		$query = $this->db->get('M_jenis_kendaraan')->result();

		foreach ($query as $q) {
			$buffer[$q->kode_jeken] = $q->nama_jeken;
		}

		return $buffer;
	}

	function jeken_checkbox()
	{
		$buffer = array();

		$query = $this->db->get('M_jenis_kendaraan')->result();

		foreach ($query as $q) {
			$buffer[$q->kode_jeken] = $q->nama_jeken;
		}

		return $buffer;
	}

	function get_list_jeken($params = array())
	{
		if(isset($params['nama_jeken']) && $params['nama_jeken'] != '')
			$this->db->like('nama_jeken', $params['nama_jeken']);

		if(isset($params['type_kend']) && $params['type_kend'] != '')
			$this->db->like('kode_jeken', $params['type_kend']);

		if (isset($params['limit']) && isset($params['start']))
			$this->db->limit($params['limit'], $params['start']);

		$query = $this->db->get('M_jenis_kendaraan')->result();

		return $query;
	}

	function get_oneJeken($params = array())
	{
		if(isset($params['id']))
			$this->db->where('kode_jeken', $params['id']);

		if(isset($params['nama_jeken']))
			$this->db->where('nama_jeken', $params['nama_jeken']);

		if(isset($params['type_kend']))
			$this->db->like('kode_jeken', $params['type_kend']);
		
		$query = $this->db->get('M_jenis_kendaraan')->row();

		return $query;
	}

	function get_maxID($params = array())
	{
		if(isset($params['id']))
			$this->db->like('kode_jeken', $params['id'], 'after');

		$this->db->select_max('kode_jeken', 'ID');
		$query = $this->db->get('M_jenis_kendaraan')->row();

		return $query;
	}

	function add_jeken($params, $id = null)
	{
		$params['kode_jeken'] = strtolower($params['kode_jeken']);

		// Manual check for same id record
		$rec = $this->get_oneJeken(array('id' => $params['kode_jeken']));
		$query = 0;
		$msg = lang('label_jeken_code')." is exists";

		if($id)
		{
			$rec1 = $this->get_oneJeken(array('id' => $id));
			if($rec1->kode_jeken == $params['kode_jeken'] OR is_null($rec))
			{
				$this->db->where('kode_jeken', $id);
				$query = $this->db->update('M_jenis_kendaraan', $params);
				$msg = update_flag($query);
			}
		}
		else
		{
			if(is_null($rec))
			{
				$query = $this->db->insert('M_jenis_kendaraan', $params);
				$msg = insert_flag($query);
			}
		}

		return array($query, $msg);
	}

	function del_jeken($id)
	{
		$this->db->where('kode_jeken', $id);
		$query = $this->db->delete('M_jenis_kendaraan');

		return $query;
	}
}