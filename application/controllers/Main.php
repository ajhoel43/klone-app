<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* 
*/
class Main extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$status = $this->session->userdata('valid');

		if ($status !== 1) {
			redirect('front/login');
		}

		$this->remap();
	}

	private function remap()
	{
		// for pull data from other database with klone prefix
		$this->session->set_userdata('prefix_', 'klone');
	}
	public function index()
	{
		$data['title'] = "K'Lone";
		$this->template1->create_view('pages/content', $data);
	}

	

	
}
?>