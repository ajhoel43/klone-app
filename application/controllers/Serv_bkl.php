<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* This class need validate SESSION
*/
class Serv_bkl extends CI_Controller {
	private $usprev;
	private $error = 0;
	private $success = 1;

	function __construct() 
	{
		parent::__construct();
		$this->load->model('m_servbkl');
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
		$this->form_validation->set_rules('nama_layanan', lang('label_servb_name'), 'required');
		$this->form_validation->set_rules('kode_jb[]', lang('label_jb'), 'required');

		if($this->form_validation->run() === TRUE)
			return true;
		else
			return false;
	}

	function index()
	{
		$this->load->library('pagination');
		
		$config = load_pagination_config();

		$config['base_url'] = base_url('serv_bkl/index');
		$config['total_rows'] = count($this->m_servbkl->get_list_servbkl());
		$config['per_page'] = 20;
		// $choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = round($choice);
		
		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$params = array();
		$params['limit'] = $config['per_page'];
		$params['start'] = $page;

		$data = array();
		$data['records'] = $this->m_servbkl->get_list_servbkl($params);
		$data['jb_dd'] = $this->m_jb->jb_dropdown();
		$data['links'] = $this->pagination->create_links();
		$this->template1->create_view('serv_bkl/list_data', $data);
	}

	function add_servbkl()
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			$vresult = $this->_validate_form();
			if(!$vresult)
				die(report_flag($this->error, validation_errors()));

			$this->db->trans_begin();
			$kode_jb = $this->input->post('kode_jb');

			foreach ($kode_jb as $value => $index) {
				//*************** Checking for redundancy data **************//
				$params = array(
					'nama_layanan' => $this->input->post('nama_layanan'),
					'kode_jb' => $index,
					);
				$rec = $this->m_servbkl->get_oneServbkl($params);

				if(count($rec) > 0)
				{
					$indexnum = (int)$value+1;
					die(report_flag($this->error, lang('messageRedundancyData')." on checkbox number: ".$indexnum." => ".$index));
				}
				//**********************************************************//

				// Generate ID format*
				$max = $this->m_servbkl->get_maxID(array('id' => $index));
				$maxID = (int)substr($max->ID, 5);
				$_POST['kode_jb'] = $index;
				$_POST['ID_layanan'] = join('', array($_POST['kode_jb'], sprintf('%05s',$maxID+1)));
				if($_POST['deskripsi'] == '')
					$_POST['deskripsi'] = $_POST['nama_layanan'];
				// ******************
				
				list($bresult, $msg) = $this->m_servbkl->add_servbkl($this->input->post());
			}

			if(!$bresult)
			{
				$this->db->trans_rollback();
				die(report_flag($this->error, $msg));
			}
			else
			{
				$this->db->trans_commit();
				die(report_flag($this->success, $msg));
			}
		}

		$data['jb_dd'] = $this->m_jb->jb_checkbox();
		$this->load->view('serv_bkl/add_servbkl', $data);
	}

	function upd_servbkl($id)
	{
		$submit = $this->input->post('submit');

		if($submit)
		{
			unset($_POST['submit']);

			$vresult = $this->_validate_form();
			if(!$vresult)
				die(report_flag($this->error, validation_errors()));

			//************ Checking for redundancy ************//
			$params = array(
				'nama_layanan' => $this->input->post('nama_layanan'),
				'kode_jb' => $this->input->post('kode_jb'),
				);
			$rec = $this->m_servbkl->get_oneServbkl($params);

			if(count($rec) > 0 AND $rec->ID_layanan != $_POST['ID_layanan'])
				die(report_flag($this->error, lang('messageRedundancyData')));
			//*************************************************//

			list($bresult, $msg) = $this->m_servbkl->add_servbkl($this->input->post(), $id);

			if(!$bresult)
				die(report_flag($this->error, $msg));
			else
				die(report_flag($this->success, $msg));
		}

		$data = array();
		$data['record'] = $this->m_servbkl->get_oneServbkl(array('id' => $id));
		$data['jb_dd'] = $this->m_jb->jb_checkbox();
		$this->load->view('serv_bkl/upd_servbkl', $data);
	}

	function del_servbkl($id)
	{
		$bresult = $this->m_servbkl->del_servbkl($id);

		if(!$bresult)
			die(report_flag($this->error, delete_flag($bresult)));
		else
			die(report_flag($this->success, delete_flag($bresult)));
	}

	function search_data()
	{
		$params = array(
			'nama_layanan' => $this->input->post('nama_layanan'),
			'kode_jb' => $this->input->post('kode_jb')
			);
		$data['records'] = $this->m_servbkl->get_list_servbkl($params);
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('serv_bkl/list_data_ajax', $data, TRUE));
		else{
			echo "<center><div class='alert alert-danger'>No Records Found</div></center>";
			die();
		}
	}
}