<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* This class need validate SESSION
*/
class Front extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_user');
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
						echo "Wrong Password";
					}
				} else {
					echo "Wrong Username & Password";
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