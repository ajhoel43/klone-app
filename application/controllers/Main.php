<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->library(array('template1', 'session'));
		
		$status = $this->session->userdata('Jenis_User');

		if ($status == null || $status == '') {
			redirect('user/login');
		}
	}

	public function index()
	{
		/*$data['title'] = "E-Learning";
		$this->load->view('templates/header', $data);
		$this->load->view('templates/navbar');
		$this->load->view('pages/content');
		$this->load->view('templates/footer');
		*/
		$data['title'] = "E-Learning";
		$this->template1->create_view('pages/content', $data);
	}

	

	
}
?>