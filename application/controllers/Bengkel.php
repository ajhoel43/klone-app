<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* This class need validate SESSION
*/
class Bengkel extends CI_Controller {
	private $usprev;
	private $error = 0;
	private $success = 1;
	private $username;

	function __construct() 
	{
		parent::__construct();
		$this->load->model('m_bengkel');
		$this->load->model('m_jb');

		$status = $this->session->userdata('valid');
		$this->usprev = $this->session->userdata('user_previleges');
		$this->username = $this->session->userdata('username');

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
		$this->form_validation->set_rules('nama_bengkel', lang('label_bengkel'), 'required');
		$this->form_validation->set_rules('jenis_bengkel', lang('label_jb'), 'required');
		$this->form_validation->set_rules('alamat', lang('address'), 'required');
		// $this->form_validation->set_rules('koordinat', lang('koordinat'), 'required');

		if($this->form_validation->run() === TRUE)
			return true;
		else
			return false;
	}

	function index()
	{
		$this->load->library('pagination');
		
		$config = load_pagination_config();

		$config['base_url'] = base_url('bengkel/index');
		$config['total_rows'] = count($this->m_bengkel->get_list_bengkel());
		$config['per_page'] = 20;
		// $choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = round($choice);
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$params = array();
		$params['limit'] = $config['per_page'];
		$params['start'] = $page;

		$data = array();
		$data['records'] = $this->m_bengkel->get_list_bengkel($params);
		$data['jb_dd'] = $this->m_jb->jb_dropdown();
		$data['links'] = $this->pagination->create_links();
		$this->template1->create_view('bengkel/list_data', $data);
	}

	function add_bengkel()
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			$vresult = $this->_validate_form();
			if(!$vresult)
				die(report_flag($this->error, validation_errors()));

			// Generate ID format*
			$ID = $_POST['jenis_bengkel'].'ngklon'; //Tempr ID for testing
			$max = $this->m_bengkel->get_maxID(array('id' => $ID));
			$maxID = (int)substr($max->ID, 11);
			$_POST['ID_bengkel'] = join('', array($ID, sprintf('%04s',$maxID+1)));
			// *******************

			if(strlen($_POST['ID_bengkel']) != 15)
				die(report_flag($this->error, lang('message_error_insert')));

			$_POST['register_by'] = $this->username;
			$_POST['register_tgl'] = get_time_stamp();
			// die(var_dump($_POST));
			list($bresult, $msg) = $this->m_bengkel->add_bengkel($this->input->post());

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data['jb_dd'] = $this->m_jb->jb_dropdown();
		$this->load->view('bengkel/add_bengkel', $data);
	}

	function upd_bengkel($id)
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			if(!$this->_validate_form())
				die(report_flag($this->error, validation_errors()));

			list($bresult, $msg) = $this->m_jb->add_jb($this->input->post(), $id);

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data = array();
		$data['record'] = $this->m_jb->get_oneJb(array('id' => $id));
		$this->load->view('jb/upd_jb', $data);
	}

	function del_bengkel($id)
	{
		$bresult = $this->m_bengkel->del_bengkel($id);

		if(!$bresult)
			die(report_flag($this->error, delete_flag($bresult)));
		else
			die(report_flag($this->success, delete_flag($bresult)));
	}

	function search_bengkel()
	{
		$params = array(
			'nama_bengkel' => $this->input->post('nama_jb'),
			'jenis_bengkel' => $this->input->post('jenis_bengkel')
			);
		$data['records'] = $this->m_bengkel->get_list_bengkel($params);
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('bengkel/list_data_ajax', $data, TRUE));
		else{
			echo "<center><div class='alert alert-danger' style='margin-top:1em;'>No Records Found</div></center>";
			die();
		}
	}

	function info_bkl_dtl($id)
	{
		$params = array('id' => $id);
		$data['record'] = $this->m_bengkel->get_onebengkel($params);
		die(var_dump($id, $data));
	}
}