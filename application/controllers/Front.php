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

	function check_available()
	{
		$params = $this->input->post('term');
		$params = explode('@@', $params);
		$visible = 1;
		$successsign = '<span class="glyphicon glyphicon-ok-sign" style="color:green;"></span>';
		$failsign = '<span class="glyphicon glyphicon-remove-sign" style="color:red;"></span>';

		if($params[0] == 'email')
		{
			$string = preg_match('/[@]/', $params[1]);
			$string1 = preg_match('/[.]/', $params[1]);
			/*$string = preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $params[1]);*/

			if(!$string OR !$string1)
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
		$flag = return_flag($bresult);
		
		if(is_null($bresult))
		{
			die(sprintf('%s@@%s@@', $visible, $successsign." ".$msg));
		}
		else
		{
			die(sprintf('%s@@%s@@', $visible, $failsign." ".$msg));

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
							//unset sensitive info
							unset($userdata['hash']);
							unset($userdata['password']);
							unset($userdata['salt']);
							$this->session->set_userdata($userdata);
							redirect('main');
						}
					}
					else 
					{
						$this->session->set_flashdata('error', lang('messageLoginFalse'));
					}
				} else {
					$this->session->set_flashdata('error', lang('messageLoginFalse'));
				}
			}
		}

		$this->template1->create_view1('user/user_login', $data);
	}


    function logout() 
    {
    	$this->session->sess_destroy();
    	redirect('main');
    }
}