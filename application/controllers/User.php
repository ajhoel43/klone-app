<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* This class need validate SESSION
*/
class User extends CI_Controller {
	private $admin = 'ADMIN';
	private $super = 'SUPER';
	private $owner = 'OWNER';
	private $ruser = 'RUSER';

	function __construct() 
	{
		parent::__construct();
		$this->load->model('model_user');

		$status = $this->session->userdata('valid');

		if ($status !== 1) 
		{
			redirect('front/login');
		}
	}

	function _validate_form()
	{
		$this->form_validation->set_rules('username', lang('label_username'), 'required');
		$this->form_validation->set_rules('first_name', lang('info_first_name'), 'required');
		$this->form_validation->set_rules('password', lang('label_password'), 'required');
		$this->form_validation->set_rules('repassword', 'Confirm Password', 'required');
		$this->form_validation->set_rules('email', lang('label_email'), 'required');
		$this->form_validation->set_rules(array('date', 'month', 'year'), lang('label_birth'), 'required');
		// $this->form_validation->set_rules('phone_num', lang('label_phone'), 'required');
		
		if($this->session->userdata('user_previleges') === $this->super)
			$this->form_validation->set_rules('user_previleges', lang('label_user_prev'), 'required');

		if($this->form_validation->run() === TRUE)
			return true;
		else
			return false;
	}

	function _edit_user_form($id) 
	{
		$data['record'] = $this->model_user->get_user_data(array('id' => $id));
		$upparams = array('level' => $this->session->userdata('level'));
		$data['usprev'] = $this->model_user->usprev_dropdown($upparams);
		$birth = dashDateExplode($data['record']->birth_date);
		
		for ($i=0; $i < count($birth) ; $i++) { 
			$data['date'.$i] = $birth[$i];
		}
		
		$this->load->view('user/edit_user', $data);
	}

	function edit_user($id) 
	{
		$save = $this->input->post('submit');
		
		if( $save ) 
		{
			$show = 0;
			$hide = 1;
			unset($_POST['submit']);

			// Check Permission
			$level = $this->session->userdata('user_previleges');
			if($level !== $this->super)
			{
				if($this->session->userdata('username') !== $id OR $level !== $this->admin)
					die(sprintf('%s@@%s@@', $show, lang('messageNoPermission')));
			}

			// Checking if field is null
			$vresult = $this->_validate_form();
			if(!$vresult)
				die(sprintf('%s@@%s@@', $show, validation_errors()));

			// Checking username changes
			if($id !== $this->input->post('username'))
			{
				// Checking username availability
				list($bresult, $msg) = $this->model_user->auto_checking(array('username' => $this->input->post('username')));
				if($bresult)
					die(sprintf('%s@@%s@@', $show, $msg));	
			}

			//Checking password match
			if($_POST['password'] !== $_POST['repassword'])
				die(sprintf('%s@@%s@@', $show, lang('messagePasswNotMatch')));

			unset($_POST['repassword']);
			
			//Checking email valid format
			if(!_valid_email($_POST['email']))
				die(sprintf('%s@@%s@@', $show, lang('messageEmailNotValid')));

			$_POST = $this->model_user->_generate_birth_date($this->input->post());
			// Generate Hash
			list($_POST['hash'], $_POST['salt'], $_POST['password']) = $this->model_user->_create_hash($this->input->post());

			list($bresult, $msg) = $this->model_user->add_user($this->input->post(), $id);

			if(!$bresult)
				die(sprintf('%s@@%s@@', $show, $msg));
			else
			{
				if($this->session->userdata('username') === $id)
					die(sprintf('%s@@%s@@', 2, "<h4>Your account is updated successfully</h4><br><p>You will be logout automatically</p>"));

				die(sprintf('%s@@%s@@', $hide, $msg));
			}
		}

		$this->_edit_user_form($id);
	}

	function list_users() 
	{
		$this->load->library('pagination');

		$getuser = $this->model_user->get_list_user();

		$config['base_url'] = base_url('user/list_users');
		$config['total_rows'] = count($getuser);
		$config['per_page'] = 20;
		// $choice = $config['total_rows'] / $config['per_page'];
		// $config['num_links'] = round($choice);

		// Pagination View Configuration
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = '<span class="glyphicon glyphicon-chevron-left"></span><span class="glyphicon glyphicon-chevron-left"></span> First';
		$config['last_link'] = 'Last <span class="glyphicon glyphicon-chevron-right"></span><span class="glyphicon glyphicon-chevron-right"></span>';
		$config['prev_link'] = '<span class="glyphicon glyphicon-chevron-left"></span> Prev';
		$config['next_link'] = 'Next <span class="glyphicon glyphicon-chevron-right"></span>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';

		$this->pagination->initialize($config);

		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$params = array(
			'limit' => $config['per_page'],
			'start' => $page,
			);

		$data['records'] = $this->model_user->get_list_user($params);
		$data['links'] = $this->pagination->create_links();
		$data['usprev'] = $this->model_user->usprev_dropdown();

		$this->template1->create_view('user/list_data', $data);
	}
	
	function list_user($type = null) 
	{
		$params = array(
			'user_previleges' => $type,
			'limit' => 20
			);
		$data['records'] = $this->model_user->get_list_user($params);
		$data['usprev'] = $this->model_user->usprev_dropdown();
		$this->template1->create_view('user/list_data', $data);
	}

	function searchuser()
	{
		$data = array();
		$data['records'] = $this->model_user->get_list_user($this->input->post());
		$count = count($data['records']);

		if($count > 0)
			die($this->load->view('user/list_data_ajax', $data, TRUE));
		else
			echo "<center><div class='alert alert-danger'>No Records Found</div></center>";
	}

    function create_user()
	{
		$submit = $this->input->post('submit');
		if($submit)
		{
			$show = 0;
			$hide = 1;
			unset($_POST['submit']);
			
			// Checking user status
			$level = $this->session->userdata('user_previleges');
			if($level !== $this->super && $level !== $this->admin)
				die(sprintf('%s@@%s@@', $show, lang('messageNoPermission')));

			// Checking if field is null
			$vresult = $this->_validate_form();
			if(!$vresult)
				die(sprintf('%s@@%s@@', $show, validation_errors()));

			// Checking username availability
			list($bresult, $msg) = $this->model_user->auto_checking(array('username' => $this->input->post('username')));
			if($bresult)
				die(sprintf('%s@@%s@@', $show, $msg));

			//Checking password match
			$option = array('cost' => 10, 'salt' => password_hash(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM), PASSWORD_BCRYPT));
			$pass1 = tempHash($this->input->post('password'), $option);
			$pass2 = tempHash($this->input->post('repassword'), $option);

			if(!hash_equals($pass1, $pass2))
				die(sprintf('%s@@%s@@', $show, lang('messagePasswNotMatch')));

			unset($_POST['repassword']);
			
			//Checking email valid format
			if(!_valid_email($_POST['email']))
				die(sprintf('%s@@%s@@', $show, lang('messageEmailNotValid')));

			// if($level === $this->super)
			// 	$_POST['status'] = 1; // Set status to active

			$_POST = $this->model_user->_generate_birth_date($this->input->post());
			list($_POST['hash'], $_POST['salt'], $_POST['password']) = $this->model_user->_create_hash($this->input->post());

			list($bresult, $msg) = $this->model_user->add_user($this->input->post());

			if(!$bresult)
				die(sprintf('%s@@%s@@', $show, $msg));
			else
				die(sprintf('%s@@%s@@', $hide, $msg));
		}

		$upparams = array('level' => $this->session->userdata('level'));
		$data['usprev'] = $this->model_user->usprev_dropdown($upparams);
		$this->load->view('user/add_user', $data);
	}

	function delete_user($id)
	{
		$level = $this->session->userdata('user_previleges');
		$status = $this->session->userdata('level');
		$status = (int)$status;
		$record = $this->model_user->get_user_info(array('username' => $id));
		unset($record['password']);
		unset($record['salt']);
		unset($record['hash']);

		if($level != $this->super && $level != $this->admin)
			die(sprintf('%s@@%s@@', 0, lang('messageNoPermission')));

		if($status < $record['level'])
			die(sprintf('%s@@%s@@', 0, lang('message_error_delete')));
		
		if($this->session->userdata('username') === $id)
			die(sprintf('%s@@%s@@', 0, "This user is currently login"));

		list($bresult, $msg) = $this->model_user->delete_user(array('username' => $id));

		die(sprintf('%s@@%s@@', return_flag($bresult), $msg));
	}

	function delete_dialog($id)
	{
		$data['record'] = $this->model_user->get_list_user(array('username' => $id));
		$this->load->view('user/delete_dialog', $data);
	}

	function activate_user()
	{
		$id = $this->input->post('term');
		unset($_POST['term']);

		$level = $this->session->userdata('user_previleges');
		
		if($level !== $this->super)
			die(sprintf('%s@@%s@@', 0, lang('messageNoPermission')));

		$record = $this->model_user->get_user_info(array('username' => $id));
		unset($record['password']);
		unset($record['salt']);
		unset($record['hash']);

		if($record['status'] == 1)
			die(sprintf('%s@@%s@@', 0, "This user is already activate :)"));

		$_POST['status'] = 1;
		list($bresult, $msg) = $this->model_user->add_user($this->input->post(), $id);
		
		die(sprintf('%s@@%s@@', return_flag($bresult), $msg));
	}

	function make_admin()
	{
		$id = $this->input->post('term');
		unset($_POST['term']);
		
		$level = $this->session->userdata('user_previleges');
		
		if($level !== $this->super)
			die(sprintf('%s@@%s@@', 0, lang('messageNoPermission')));

		$record = $this->model_user->get_user_info(array('username' => $id));
		unset($record['password']);
		unset($record['salt']);
		unset($record['hash']);

		if($record['status'] != 1 OR $record['user_previleges'] === $this->admin)
			die(sprintf('%s@@%s@@', 0, "This user is already Administator :)"));
		
		$_POST['user_previleges'] = $this->admin;
		$_POST['status'] = 1;
		list($bresult, $msg) = $this->model_user->add_user($this->input->post(), $id);
		
		die(sprintf('%s@@%s@@', return_flag($bresult), $msg));
	}
}