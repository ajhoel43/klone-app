<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* This class need validate SESSION
*/
class Jenis_bkl extends CI_Controller {
	private $usprev;
	private $error = 0;
	private $success = 1;

	function __construct() 
	{
		parent::__construct();
		$this->load->model('m_jb');

		$status = $this->session->userdata('valid');
		$this->usprev = $this->session->userdata('user_previleges');

		if ($status !== 1) 
		{
			redirect('front/login');
		}

		if($this->usprev !== 'SUPER')
		{
			$this->session->set_flashdata('error', lang('messageNoPermission'));
			redirect('main');
		}
	}

	function _validate_form()
	{
		$this->form_validation->set_rules('kode_jb', lang('label_jb_kode'), 'required|min_length[5]|max_length[5]');
		$this->form_validation->set_rules('nama_jb', lang('label_jb'), 'required');

		if($this->form_validation->run() === TRUE)
			return true;
		else
			return false;
	}

	function index()
	{
		$this->load->library('pagination');
		
		$config = load_pagination_config();

		$config['base_url'] = base_url('jenis_bkl/index');
		$config['total_rows'] = count($this->m_jb->get_list_jb());
		$config['per_page'] = 20;
		// $choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = round($choice);
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$params = array();
		$params['limit'] = $config['per_page'];
		$params['start'] = $page;

		$data = array();
		$data['records'] = $this->m_jb->get_list_jb($params);
		$data['links'] = $this->pagination->create_links();
		$this->template1->create_view('jb/list_data', $data);
	}

	function add_jb()
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			$vresult = $this->_validate_form();
			if(!$vresult)
				die(sprintf('%s@@%s@@', $this->error, validation_errors()));

			list($bresult, $msg) = $this->m_jb->add_jb($this->input->post());

			if(!$bresult)
				die(sprintf('%s@@%s@@', $this->error, $msg));
			else
				die(sprintf('%s@@%s@@', $this->success, $msg));
		}

		// $data = array();
		$this->load->view('jb/add_jb');
	}

	function upd_jb($id)
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			if(!$this->_validate_form())
				die(sprintf('%s@@%s@@', $this->error, validation_errors()));

			list($bresult, $msg) = $this->m_jb->add_jb($this->input->post(), $id);

			if(!$bresult)
				die(sprintf('%s@@%s@@', $this->error, $msg));
			else
				die(sprintf('%s@@%s@@', $this->success, $msg));
		}

		$data = array();
		$data['record'] = $this->m_jb->get_oneJb(array('id' => $id));
		$this->load->view('jb/upd_jb', $data);
	}

	function del_jb($id)
	{
		$bresult = $this->m_jb->del_jb($id);

		if(!$bresult)
			die(sprintf('%s@@%s@@', $this->error, delete_flag($bresult)));
		else
			die(sprintf('%s@@%s@@', $this->success, delete_flag($bresult)));
	}

	function search_jb()
	{
		$params = array('nama_jb' => $this->input->post('nama_jb'));
		$data['records'] = $this->m_jb->get_list_jb($params);
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('jb/list_data_ajax', $data, TRUE));
		else{
			echo "<center><div class='alert alert-danger'>No Records Found</div></center>";
			die();
		}
	}
}