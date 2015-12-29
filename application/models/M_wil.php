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

	// ********************** Func. WILAYAH ************************** //
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

		$this->db->order_by('kode_wil asc');
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
	// ********************** END WILAYAH ************************** //

	// ********************** Func. KOTA ************************** //
	function kota_dropdown()
	{
		$buffer = array();
		$buffer[''] = '- '.lang('label_kota').' -';

		$this->db->join('M_wilayah mw', 'mk.kode_wil = mw.kode_wil', 'left');
		$query = $this->db->get('M_kota mk')->result();

		foreach ($query as $q) {
			$buffer[$q->kode_kota] = $q->nama_wil." >> ".$q->nama_kota;
		}

		return $buffer;
	}

	function get_list_kota($params = array())
	{
		if(isset($params['nama_kota']) && $params['nama_kota'] != '')
			$this->db->like('mk.nama_kota', $params['nama_kota']);

		if(isset($params['nama_wil']) && $params['nama_wil'] != '')
			$this->db->like('mw.nama_wil', $params['nama_wil']);

		if (isset($params['limit']) && isset($params['start']))
			$this->db->limit($params['limit'], $params['start']);

		$this->db->join('M_wilayah mw', 'mw.kode_wil = mk.kode_wil', 'left');

		$this->db->order_by('mk.ID_kota asc');
		$query = $this->db->get('M_kota mk')->result();

		return $query;
	}

	function get_one_kota($params = array())
	{
		if(isset($params['id']))
			$this->db->where('ID_kota', $params['id']);
		
		$this->db->join('M_wilayah mw', 'mw.kode_wil = mk.kode_wil', 'left');
		$query = $this->db->get('M_kota mk')->row();

		return $query;
	}

	function get_max_kota($params = array())
	{
		// $this->db->select('');
		$this->db->where('kode_wil', $params['kode_wil']);
		$this->db->select_max('kode_kota', 'ID');

		$query = $this->db->get('M_kota')->row();

		return $query;
	}

	function add_kota($params, $id = null)
	{
		// Manual check for same id record
		$rec = $this->get_one_kota(array('id' => $params['ID_kota']));
		$query = 0;
		$msg = lang('label_kota_kode')." for <b>".$rec->nama_wil."</b>".lang('message_data_exist')." ";
		$msg .= "<br><br>Report :";
		$msg .= "<div style='text-align:right;'>".lang('label_kode')." => <b>$rec->kode_kota</b>".lang('message_IsUse')."<b>".$rec->nama_kota."</b></div>";

		if($id)
		{
			$rec1 = $this->get_one_kota(array('id' => $id));
			if($rec1->ID_kota == $params['ID_kota'] OR is_null($rec))
			{
				$this->db->where('ID_kota', $id);
				$query = $this->db->update('M_kota', $params);
				$msg = update_flag($query);
			}
		}
		else
		{
			if(is_null($rec))
			{
				$query = $this->db->insert('M_kota', $params);
				$msg = insert_flag($query);
			}
		}

		return array($query, $msg);
	}

	function del_kota($id)
	{
		$this->db->where('ID_kota', $id);
		$query = $this->db->delete('M_kota');

		return $query;
	}
	// ********************** END KOTA ************************** //

	// ********************** START KEC ************************** //
	function kec_dropdown()
	{
		$buffer = array();
		$buffer[''] = '- '.lang('label_kec').' -';

		$this->db->join('M_kota mk', 'mk.ID_kota = mkec.ID_kota', 'left');
		$this->db->join('M_wilayah mw', 'mk.kode_wil = mw.kode_wil', 'left');
		$query = $this->db->get('M_kecamatan mkec')->result();

		// foreach ($query as $q) {
		// 	$buffer[$q->kode_kota] = $q->nama_wil." >> ".$q->nama_kota;
		// }

		return $buffer;
	}

	function get_list_kec($params = array())
	{
		if(isset($params['nama_kec']) && $params['nama_kec'] != '')
			$this->db->like('mkec.nama_kec', $params['nama_kec']);

		if(isset($params['nama_kota']) && $params['nama_kota'] != '')
			$this->db->like('mk.nama_kota', $params['nama_kota']);

		if(isset($params['nama_wil']) && $params['nama_wil'] != '')
			$this->db->like('mw.nama_wil', $params['nama_wil']);

		if (isset($params['limit']) && isset($params['start']))
			$this->db->limit($params['limit'], $params['start']);

		$this->db->join('M_kota mk', 'mk.ID_kota = mkec.ID_kota', 'left');
		$this->db->join('M_wilayah mw', 'mw.kode_wil = mk.kode_wil', 'left');

		$this->db->order_by('mkec.ID_kec asc');
		$query = $this->db->get('M_kecamatan mkec')->result();

		return $query;
	}

	function get_one_kec($params = array())
	{
		if(isset($params['id']))
			$this->db->where('mkec.ID_kec', $params['id']);
		
		$this->db->join('M_kota mk', 'mk.ID_kota = mkec.ID_kota', 'left');
		$this->db->join('M_wilayah mw', 'mw.kode_wil = mk.kode_wil', 'left');
		$query = $this->db->get('M_kecamatan mkec')->row();

		return $query;
	}

	function get_max_kec($params = array())
	{
		// $this->db->select('');
		$this->db->where('ID_kota', $params['kode_kota']);
		$this->db->select_max('kode_kec', 'ID');

		$query = $this->db->get('M_kecamatan')->row();

		return $query;
	}

	function add_kec($params, $id = null)
	{
		// Manual check for same id record
		$rec = $this->get_one_kec(array('id' => $params['ID_kec']));
		$query = 0;
		$msg = lang('label_kec_kode')." for ".lang('label_kota')." <b>".$rec->nama_kota."</b>".lang('message_data_exist')." ";
		$msg .= "<br><br>Report :";
		$msg .= "<div style='text-align:left;'>".lang('label_kode')." => <b>$rec->kode_kec</b>".lang('message_IsUse')."<b>".$rec->nama_kec."</b></div>";

		if($id)
		{
			$rec1 = $this->get_one_kec(array('id' => $id));
			if($rec1->ID_kota == $params['ID_kec'] OR is_null($rec))
			{
				$this->db->where('ID_kec', $id);
				$query = $this->db->update('M_kecamatan', $params);
				$msg = update_flag($query);
			}
		}
		else
		{
			if(is_null($rec))
			{
				$query = $this->db->insert('M_kecamatan', $params);
				$msg = insert_flag($query);
			}
		}

		return array($query, $msg);
	}

	function del_kec($id)
	{
		$this->db->where('ID_kec', $id);
		$query = $this->db->delete('M_kecamatan');

		return $query;
	}
	// ********************** END KEC **************************** //

}