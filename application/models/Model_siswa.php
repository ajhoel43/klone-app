<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class Model_siswa extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function get_list_data($params = null) {
		
		$this->db->select('*');
		$this->db->get('M_Siswa')->result();
	}
}

?>