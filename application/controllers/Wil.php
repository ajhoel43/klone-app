<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* This class need validate SESSION
*/
class Wil extends CI_Controller {
	private $usprev;
	private $error = 0;
	private $success = 1;

	function __construct() 
	{
		parent::__construct();
		$this->load->model('m_wil');

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

	// ********************* Function WIL ********************** //
	function _validate_form_wil()
	{
		$this->form_validation->set_rules('kode_wil', lang('label_wil_kode'), 'required');
		$this->form_validation->set_rules('nama_wil', lang('label_wil'), 'required');

		if($this->form_validation->run() === TRUE)
			return true;
		else
			return false;
	}

	function index()
	{
		$this->load->library('pagination');
		
		$config = load_pagination_config();

		$config['base_url'] = base_url('wil/index');
		$config['total_rows'] = count($this->m_wil->get_list_wil());
		$config['per_page'] = 20;
		// $choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = round($choice);
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$params = array();
		$params['limit'] = $config['per_page'];
		$params['start'] = $page;

		$data = array();
		$data['records'] = $this->m_wil->get_list_wil($params);
		$data['links'] = $this->pagination->create_links();
		$this->template1->create_view('wil/list_wil', $data);
	}

	function add_wil()
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			$vresult = $this->_validate_form_wil();
			if(!$vresult)
				die(report_flag($this->error, validation_errors()));

			list($bresult, $msg) = $this->m_wil->add_wil($this->input->post());

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		// $data = array();
		$this->load->view('wil/add_wil');
	}

	function upd_wil($id)
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			if(!$this->_validate_form_wil())
				die(report_flag($this->error, validation_errors()));

			list($bresult, $msg) = $this->m_wil->add_wil($this->input->post(), $id);

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data = array();
		$data['record'] = $this->m_wil->get_one_wil(array('id' => $id));
		$this->load->view('wil/upd_wil', $data);
	}

	function del_wil($id)
	{
		$bresult = $this->m_wil->del_wil($id);

		if(!$bresult)
			die(report_flag($this->error, delete_flag($bresult)));
		else
			die(report_flag($this->success, delete_flag($bresult)));
	}

	function search_wil()
	{
		$params = array('nama_wil' => $this->input->post('nama_wil'));
		$data['records'] = $this->m_wil->get_list_wil($params);
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('wil/list_wil_ajax', $data, TRUE));
		else{
			echo "<center><div class='alert alert-danger' style='margin-top:2em;'>No Records Found</div></center>";
			die();
		}
	}

	function select_wil()
	{
		$key = $this->input->post('keyword');
		$data['records'] = $this->m_wil->get_list_wil(array('nama_wil' => $key));
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('wil/select_wil', $data, TRUE));
		else {
			echo "<center><div class='alert alert-danger' style='margin-top:2em;'>No Records Found</div></center>";
			die();
		}
	}
	// ********************* END WILAYAH ************************ //

	// ********************* Function KOTA ********************** //
	function _validate_form_kota()
	{
		$this->form_validation->set_rules('kode_wil', lang('label_wil'), 'required');
		$this->form_validation->set_rules('kode_kota', lang('label_kota_kode'), 'required|numeric');
		$this->form_validation->set_rules('nama_kota', lang('label_kota'), 'required');

		if($this->form_validation->run() === TRUE)
			return true;
		else
			return false;
	}
	
	function index_kota()
	{
		$this->load->library('pagination');
		
		$config = load_pagination_config();

		$config['base_url'] = base_url('wil/index_kota');
		$config['total_rows'] = count($this->m_wil->get_list_kota());
		$config['per_page'] = 20;
		// $choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = round($choice);
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$params = array();
		$params['limit'] = $config['per_page'];
		$params['start'] = $page;

		$data = array();
		$data['records'] = $this->m_wil->get_list_kota($params);
		$data['links'] = $this->pagination->create_links();
		$this->template1->create_view('wil/list_kota', $data);
	}

	function add_kota()
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			$vresult = $this->_validate_form_kota();
			if(!$vresult)
				die(report_flag($this->error, validation_errors()));

			// Generate ID format*
			$_POST['ID_kota'] = join('', array($_POST['kode_wil'], $_POST['kode_kota']));
			// ******************

			list($bresult, $msg) = $this->m_wil->add_kota($this->input->post());

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data['wil_dd'] = $this->m_wil->wil_dropdown();
		$this->load->view('wil/add_kota', $data);
	}

	function upd_kota($id)
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			if(!$this->_validate_form_kota())
				die(report_flag($this->error, validation_errors()));

			// Generate ID format*
			$_POST['ID_kota'] = join('', array($_POST['kode_wil'], $_POST['kode_kota']));
			// ******************

			list($bresult, $msg) = $this->m_wil->add_kota($this->input->post(), $id);

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data = array();
		$data['record'] = $this->m_wil->get_one_kota(array('id' => $id));
		$this->load->view('wil/upd_kota', $data);
	}

	function del_kota($id)
	{
		$bresult = $this->m_wil->del_kota($id);

		if(!$bresult)
			die(report_flag($this->error, delete_flag($bresult)));
		else
			die(report_flag($this->success, delete_flag($bresult)));
	}

	function search_kota()
	{
		$params = array(
			'nama_kota' => $this->input->post('nama_kota'),
			'nama_wil' => $this->input->post('nama_wil')
			);
		$data['records'] = $this->m_wil->get_list_kota($params);
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('wil/list_kota_ajax', $data, TRUE));
		else{
			echo "<center><div class='alert alert-danger' style='margin-top:2em;'>No Records Found</div></center>";
			die();
		}
	}
	// ********************* END KOTA ************************ //

}