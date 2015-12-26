<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class M_wil extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->prefix = $this->session->userdata('prefix_');
	}

	function wil_dropdown()
	{
		$buffer = array();
		$buffer[''] = '- '.lang('label_wil').' -';

		$query = $this->db->get('M_wilayah')->result();

		foreach ($query as $q) {
			$buffer[$q->kode_wil] = $q->nama_wil;
		}

		return $buffer;
	}

	function wil_checkbox()
	{
		$buffer = array();

		$query = $this->db->get('M_wilayah')->result();

		foreach ($query as $q) {
			$buffer[$q->kode_wil] = $q->nama_wil;
		}

		return $buffer;
	}

	function get_list_wil($params = array())
	{
		if(isset($params['nama_wil']) && $params['nama_wil'] != '')
			$this->db->like('nama_wil', $params['nama_wil']);

		if (isset($params['limit']) && isset($params['start']))
			$this->db->limit($params['limit'], $params['start']);
		else
			$this->db->limit(20);

		$query = $this->db->get('M_wilayah')->result();

		return $query;
	}

	function get_one_wil($params = array())
	{
		if(isset($params['id']))
			$this->db->where('kode_wil', $params['id']);
		
		$query = $this->db->get('M_wilayah')->row();

		return $query;
	}

	function add_wil($params, $id = null)
	{
		// Manual check for same id record
		$rec = $this->get_one_wil(array('id' => $params['kode_wil']));
		$query = 0;
		$msg = lang('label_wil_kode')." is exists";

		if($id)
		{
			$rec1 = $this->get_one_wil(array('id' => $id));
			if($rec1->kode_wil == $params['kode_wil'] OR is_null($rec))
			{
				$this->db->where('kode_wil', $id);
				$query = $this->db->update('M_wilayah', $params);
				$msg = update_flag($query);
			}
		}
		else
		{
			if(is_null($rec))
			{
				$query = $this->db->insert('M_wilayah', $params);
				$msg = insert_flag($query);
			}
		}

		return array($query, $msg);
	}

	function del_wil($id)
	{
		$this->db->where('kode_wil', $id);
		$query = $this->db->delete('M_wilayah');

		return $query;
	}
}