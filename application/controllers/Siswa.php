<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
/**
* 
*/
class Siswa extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_siswa');
	}

	function list_siswa() {
		$data['records'] = $this->model_siswa->get_list_data();
		$this->template1->create_view('siswa/list_data', $data);
	}
}

?>