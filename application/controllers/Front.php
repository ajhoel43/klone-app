<?php  if ( !defined('BASEPATH')) exit('No direct script access allowed');

/**
*
*/
class Front extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
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

	function check_available($id = null)
	{
		$params = $this->input->post('term');
		$params = explode('@@', $params);
		$visible = 1;
		$successsign = '<span class="glyphicon glyphicon-ok-circle" style="color:green;"></span>';
		$failsign = '<span class="glyphicon glyphicon-remove-circle" style="color:red;"></span>';

		if($params[0] == 'email')
		{
			$string = preg_match('/(^[A-Za-z]{1}\w*([._%~-]\w+)?)@\w+[._%~-]?\w+[.](\w+|\w+.\w)\z/', $params[1]);
			/*$string = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $params[1]);*/
 
			if(!$string)
				die(sprintf('%s@@%s@@', $visible, $failsign." ".lang('messageEmailNotValid')));

			$nparams = array('email' => $params[1]);
		}
		else if($params[0] == 'user')
		{
			$string = preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $params[1]);
			if($string)
				die(sprintf('%s@@%s@@', $visible, $failsign." ".lang('messageUserNotValid')));

			$nparams = array('username' => $params[1]);
		}
		else if($params[0] == 'pass')
		{
			$option = array('cost' => 10, 'salt' => password_hash(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM), PASSWORD_BCRYPT));
			$pass1 = tempHash($params[1], $option);
			$pass2 = tempHash($params[2], $option);

			if($params[1] === $params[2])
				die(sprintf('%s@@%s@@', $visible, $successsign." ".lang('messagePasswMatch')));
			else
				die(sprintf('%s@@%s@@', $visible, $failsign." ".lang('messagePasswNotMatch')));
		}

		list($bresult, $msg) = $this->model_user->auto_checking($nparams);
		// if username or email exists = fail
		if($bresult)
		{
			if($id)
			{
				list($bresult1, $msg1) = $this->model_user->auto_checking(array('username' => $id));
	
				if(isset($nparams['username']) && $nparams['username'] === $bresult1->username)
					die(sprintf('%s@@%s@@', $visible, ''));			
				elseif(isset($nparams['email']) && $nparams['email'] === $bresult1->email)
					die(sprintf('%s@@%s@@', $visible, ''));
			}

			die(sprintf('%s@@%s@@', $visible, $failsign." ".$msg));
		}
		else
		{
			die(sprintf('%s@@%s@@', $visible, $successsign." ".$msg));

		}
	}

	function create_user()
	{
		$submit = $this->input->post('submit');
		if($submit)
		{
			$show = 0;
			$hide = 1;
			unset($_POST['submit']);

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
			$string = preg_match('/(^[A-Za-z]{1}\w*([._%~-]\w+)?)@\w+[._%~-]?\w+[.](\w+|\w+.\w)\z/', $_POST['email']);

			if(!$string)
				die(sprintf('%s@@%s@@', $show, lang('messageEmailNotValid')));

			$_POST = $this->model_user->_generate_birth_date($this->input->post());
			list($_POST['hash'], $_POST['salt'], $_POST['password']) = $this->model_user->_create_hash($this->input->post());

			list($bresult, $id, $msg) = $this->model_user->add_user($this->input->post());

			if(!$bresult)
				die(sprintf('%s@@%s@@', $show, $msg));
			else
				die(sprintf('%s@@%s@@', $hide, $msg));
		}
	}

	function login() 
	{
		$login = $this->input->post('submit');
		$data = array();

		if ($login){
			unset($_POST['submit']);
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === TRUE){
				$userdata = $this->model_user->get_user_info($this->input->post());

				if ( $userdata ) {
					list($hash, $salt, $pass) = $this->model_user->_create_hash($this->input->post(), $userdata['salt'], FALSE);
					
					if(password_verify($_POST['password'], $userdata['password']))
					{
						if(hash_equals($hash, $userdata['hash'])){
							if($userdata['status'] == 1)
							{
								//unset sensitive info
								unset($userdata['hash']);
								unset($userdata['password']);
								unset($userdata['salt']);
								$userdata['valid'] = 1;
								$this->session->set_userdata($userdata);
								redirect('main');
							}
							else
								$this->session->set_flashdata('error', lang('messageLoginFalse'));
						}
						else
							$this->session->set_flashdata('error', lang('messageLoginFalse'));	
					}
					else 
						$this->session->set_flashdata('error', lang('messageLoginFalse'));
				} 
				else
					$this->session->set_flashdata('error', lang('messageLoginFalse'));
			}
		}

		$this->template1->create_view1('user/user_login', $data);
	}

    function logout() 
    {
    	$this->session->sess_destroy();
    	redirect('main');
    }

    function forgot_password()
    {
    	$submit = $this->input->post('submit');
    	$data = array();
    	
    	if($submit)
    	{
	   		unset($_POST['submit']);
    		$this->form_validation->set_rules('username', 'Username','required');
    		$this->form_validation->set_rules('email', 'Email', 'required');

    		if($this->form_validation->run() === TRUE)
    		{
    			$bresult = $this->model_user->get_verification_info($this->input->post());
    		
    			if($bresult)
    			{
    				$destination = array(
    					'email' => $bresult->email, 
    					'name' => $bresult->first_name." ".$bresult->last_name
    					);

    				$mparams = array(
    					'user' => $bresult->first_name,
    					'link' => base_url('front/forgot_password')
    					);

    				$mresult = $this->my_phpmailer->smtp_googlemail($destination, $mparams);
    				
    				if($mresult)
    				{
	    				$_SESSION['error'] = 1;
	    				$_SESSION['success'] = 1;
	    				$_SESSION['msg'] = "Email has send to <a href='#'>".$bresult->email."</a><br>Check your inbox!! <span class='glyphicon glyphicon-envelope'></span>";
    				}
    				else
    				{
    					$_SESSION['error'] = 1;
	    				$_SESSION['success'] = 0;
	    				$_SESSION['msg'] = $msg;
    				}
    				$this->session->mark_as_temp(array('error', 'success', 'msg'), 30);
    			}		    
    		}
    	}

		$this->template1->create_view1('user/forgot_password', $data);
    }
}