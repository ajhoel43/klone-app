<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* This class need validate SESSION
*/
class Jeken extends CI_Controller {
	private $usprev;
	private $error = 0;
	private $success = 1;

	function __construct() 
	{
		parent::__construct();
		$this->load->model('m_jeken');

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
		$this->form_validation->set_rules('kode_jeken', "Type", 'required');
		$this->form_validation->set_rules('nama_jeken', lang('label_jeken'), 'required');
		$this->form_validation->set_rules('cc_min', lang('label_cc'), 'required');

		if($this->form_validation->run() === TRUE)
			return true;
		else
			return false;
	}

	function index()
	{
		$this->load->library('pagination');
		
		$pagparams = array(
			'base_url' => base_url('jeken/index'),
			'total_rows' => $this->m_jeken->get_list_jeken()
			);

		$config = load_pagination_config($pagparams);		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$params = array();
		$params['limit'] = $config['per_page'];
		$params['start'] = $page;

		$data = array();
		$data['records'] = $this->m_jeken->get_list_jeken($params);
		$data['links'] = $this->pagination->create_links();
		$data['type_kend'] = type_kend_dropdown();
		$this->template1->create_view('jeken/list_data', $data);
	}

	function add_jeken()
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			$vresult = $this->_validate_form();
			if(!$vresult)
				die(report_flag($this->error, validation_errors()));

			if(isset($_POST['cc_max']) && $_POST['cc_max'] != '')
			{
				if(!_is_number($_POST['cc_max']) && _is_number($_POST['cc_min']))
					die(report_flag($this->error, "You must input a number in CC field"));
			}
			else
			{
				if(!_is_number($_POST['cc_min']))
					die(report_flag($this->error, "You must input a number in CC field"));
			}

			// *************** Checking for redundancy ************* //
			$params = array(
				'nama_jeken' => $_POST['nama_jeken'],
				'type_kend' => $_POST['kode_jeken']
				);
			$rec = $this->m_jeken->get_oneJeken($params);
			if(count($rec) > 0)
				die(report_flag($this->error, lang('messageRedundancyData')));
			// ***************************************************** //

			// Generate ID format*
			$max = $this->m_jeken->get_maxID(array('id' => $_POST['kode_jeken']));
			$maxID = (int)substr($max->ID, 5);
			$_POST['kode_jeken'] = join('', array($_POST['kode_jeken'], sprintf('%05s',$maxID+1)));
			unset($_POST['type_kend']);
			// *******************
			list($bresult, $msg) = $this->m_jeken->add_jeken($this->input->post());

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data['jeken_dd'] = type_kend_dropdown();
		$this->load->view('jeken/add_jeken', $data);
	}

	function upd_jeken($id)
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			if(!$this->_validate_form())
				die(report_flag($this->error, validation_errors()));

			// ***************** Checking for redundancy ****************** //
			$rec = $this->m_jeken->get_oneJeken(array('nama_jeken' => $_POST['nama_jeken']));
			if(count($rec) > 0 AND $rec->kode_jeken != $_POST['kode_jeken'])
				die(report_flag($this->error, lang('messageRedundancyData')));
			// ************************************************************ //
			
			list($bresult, $msg) = $this->m_jeken->add_jeken($this->input->post(), $id);

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data = array();
		$data['record'] = $this->m_jeken->get_oneJeken(array('id' => $id));
		$this->load->view('jeken/upd_jeken', $data);
	}

	function del_jeken($id)
	{
		$bresult = $this->m_jeken->del_jeken($id);

		if(!$bresult)
			die(report_flag($this->error, delete_flag($bresult)));
		else
			die(report_flag($this->success, delete_flag($bresult)));
	}

	function search_data()
	{
		$params = array(
			'nama_jeken' => $this->input->post('nama_jeken'),
			'type_kend' => $this->input->post('type_kend')
			);
		$data['records'] = $this->m_jeken->get_list_jeken($params);
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('jeken/list_data_ajax', $data, TRUE));
		else{
			echo "<center><div class='alert alert-danger'>No Records Found</div></center>";
			die();
		}
	}
}