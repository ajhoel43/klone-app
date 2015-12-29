<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class M_servbkl extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->prefix = $this->session->userdata('prefix_');
	}

	function get_list_servbkl($params = array())
	{
		if(isset($params['nama_layanan']) && $params['nama_layanan'] != '')
			$this->db->like('ly.nama_layanan', $params['nama_layanan']);

		if(isset($params['kode_jb']) && $params['kode_jb'] != '')
			$this->db->where('ly.kode_jb', $params['kode_jb']);

		if (isset($params['limit']) && isset($params['start']))
			$this->db->limit($params['limit'], $params['start']);

		$this->db->select('
			ly.*,
			ly.deskripsi as desc,
			jb.nama_jb
			');

		$this->db->order_by('ly.kode_jb asc');
		$this->db->join('M_jenis_bengkel jb', 'jb.kode_jb = ly.kode_jb', 'left');
		$query = $this->db->get('M_layanan ly')->result();

		return $query;
	}

	function get_oneServbkl($params = array())
	{
		if(isset($params['id']))
			$this->db->where('ly.ID_layanan', $params['id']);

		if(isset($params['nama_layanan']) && isset($params['kode_jb']))
		{
			$this->db->where('ly.nama_layanan', $params['nama_layanan']);
			$this->db->where('ly.kode_jb', $params['kode_jb']);
		}
		
		$this->db->select('
			ly.*,
			ly.deskripsi as desc,
			jb.nama_jb
			');
		
		$this->db->join('M_jenis_bengkel jb', 'jb.kode_jb = ly.kode_jb', 'left');
		$query = $this->db->get('M_layanan ly')->row();

		return $query;
	}

	function get_maxID($params = array())
	{
		if(isset($params['id']))
			$this->db->like('ID_layanan', $params['id'], 'after');

		$this->db->select_max('ID_layanan', 'ID');
		$query = $this->db->get('M_layanan')->row();

		return $query;
	}

	function add_servbkl($params, $id = null)
	{
		$params['ID_layanan'] = strtolower($params['ID_layanan']);

		// Manual check for same id record
		$rec = $this->get_oneServbkl(array('id' => $params['ID_layanan']));
		$query = 0;
		$msg = lang('label_servb')." is exists";

		if($id)
		{
			$rec1 = $this->get_oneServbkl(array('id' => $id));
			if($rec1->ID_layanan == $params['ID_layanan'] OR is_null($rec))
			{
				$this->db->where('ID_layanan', $id);
				$query = $this->db->update('M_layanan', $params);
				$msg = update_flag($query);
			}
		}
		else
		{
			if(is_null($rec))
			{
				$query = $this->db->insert('M_layanan', $params);
				$msg = insert_flag($query);
			}
		}

		return array($query, $msg);
	}

	function del_servbkl($id)
	{
		$this->db->where('ID_layanan', $id);
		$query = $this->db->delete('M_layanan');

		return $query;
	}
}