<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* This class need validate SESSION
*/
class User extends CI_Controller {
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('model_user');


		$status = $this->session->userdata('user_previleges');

		if ($status == null OR $status == '') 
		{
			redirect('front/login');
		}
	}

	function _process_randomstr( $length, $params ) 
	{
		//menghilangkan space dan hanya mengambil karakter A-Z,a-z,0-9
		$karakter = preg_replace("/[^A-Za-z0-9]/",'', $params['username'].$params['id']);
		//set string = null
		$string = '';
		for ($i = 0; $i < $length; $i++) 
		{
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter{$pos};
		}
		
		$salt = $this->model_user->_create_salt($string);
		$hash = $this->model_user->_create_hash($salt, $string);

		return array($string, $salt, $hash);
	}

	function _validate_form()
	{
		$this->form_validation->set_rules('username', lang('label_username'), 'required');
		$this->form_validation->set_rules('first_name', lang('info_first_name'), 'required');
		$this->form_validation->set_rules('password', lang('label_password'), 'required');
		$this->form_validation->set_rules('repassword', 'Confirm Password', 'required');
		$this->form_validation->set_rules('email', lang('label_email'), 'required');
		$this->form_validation->set_rules(array('date', 'month', 'year'), lang('label_birth'), 'required');
		$this->form_validation->set_rules('phone_num', lang('label_phone'), 'required');
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
			$string = preg_match('/[@]/', $this->input->post('email'));
			$string1 = preg_match('/[.]/', $this->input->post('email'));

			if(!$string OR !$string1)
				die(sprintf('%s@@%s@@', $show, lang('messageEmailNotValid')));

			$_POST = $this->model_user->_generate_birth_date($this->input->post());
			// Generate Hash
			list($_POST['hash'], $_POST['salt'], $_POST['password']) = $this->model_user->_create_hash($this->input->post());

			list($bresult, $msg) = $this->model_user->add_user($this->input->post(), $id);

			if(!$bresult)
				die(sprintf('%s@@%s@@', $show, $msg));
			else
				die(sprintf('%s@@%s@@', $hide, $msg));
		}

		$this->_edit_user_form($id);
	}

	function list_user() {
		$data['records'] = $this->model_user->get_list_user();
		$this->template1->create_view('user/list_data', $data);
	}

    function create_user()
	{
		$submit = $this->input->post('submit');
		if($submit)
		{
			$show = 0;
			$hide = 1;
			unset($_POST['submit']);
			
			// Checking if field is null
			$vresult = $this->_validate_form();
			if(!$vresult)
				die(sprintf('%s@@%s@@', $show, validation_errors()));

			// Checking username availability
			list($bresult, $msg) = $this->model_user->auto_checking(array('username' => $this->input->post('username')));
			if($bresult)
				die(sprintf('%s@@%s@@', $show, $msg));

			//Checking password match
			if($_POST['password'] !== $_POST['repassword'])
				die(sprintf('%s@@%s@@', $show, lang('messagePasswNotMatch')));

			unset($_POST['repassword']);
			//Checking email valid format
			$string = preg_match('/[@]/', $this->input->post('email'));
			$string1 = preg_match('/[.]/', $this->input->post('email'));

			if(!$string OR !$string1)
				die(sprintf('%s@@%s@@', $show, lang('messageEmailNotValid')));

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
		list($bresult, $msg) = $this->model_user->delete_user(array('username' => $id));

		die(sprintf('%s@@%s@@', return_flag($bresult), $msg));
	}
}
?>