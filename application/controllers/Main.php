<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();

		$status = $this->session->userdata('user_previleges');

		if ($status == null || $status == '') {
			redirect('front/login');
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
		$data['title'] = "K'Lone";
		$data['user'] = $this->session->userdata();
		$this->template1->create_view('pages/content', $data);
	}

	

	
}
?>