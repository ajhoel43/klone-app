<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
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

	function _generate_birth_date($params)
	{
		if(strlen($params['date']) == 1)
			$params['date'] = "0".$params['date'];
		if(strlen($params['month']) == 1)
			$params['month'] = "0".$params['month'];
		
		$params['birth_date'] = $params['date']."-".$params['month']."-".$params['year'];
		$params['birth_date'] = to_db_date($params['birth_date']);
		unset($params['date']);
		unset($params['month']);
		unset($params['year']);

		return $params;
	}

	function check_available()
	{
		$username = $this->input->post('term');
		if($username == 'Pandu')
		{
			die(sprintf('%s@@%s@@', 1, "Username Available"));
		}
		else
		{
			die(sprintf('%s@@%s@@', 1, "Username is not Available"));
		}
	}

	function _edit_user_form($id) {
		$data['record'] = $this->model_user->get_user_data(array('id' => $id));
		$data['usprev'] = $this->model_user->usprev_dropdown();
		$birth = dashDateExplode($data['record']->birth_date);
		
		for ($i=0; $i < count($birth) ; $i++) { 
			$data['date'.$i] = $birth[$i];
		}
		
		$this->template1->create_view('user/edit_user', $data);
	}

	function edit_user($id) 
	{
		$save = $this->input->post('submit');
		
		if( $save ) {
			unset($_POST['submit']);
			$_POST = $this->_generate_birth_date($this->input->post());

			list($_POST['hash'], $_POST['salt'], $_POST['password']) = $this->model_user->_create_hash($this->input->post());

			list($flag, $id, $msg) = $this->model_user->add_user($this->input->post(), $id);
			if($flag)
				redirect('user/list_user');
			else
				echo lang('message_error_update');
		}

		$this->_edit_user_form($id);
	}

	function list_user() {
		$data['records'] = $this->model_user->get_user_info();
		$this->template1->create_view('user/list_data', $data);
	}

    function _add_user_form(){
    	$data['usprev'] = $this->model_user->usprev_dropdown();
    	$this->template1->create_view('user/add_user', $data);
    }

    function add_user() {
    	$save = $this->input->post('submit');

    	if($save) {
			unset($_POST['submit']);
			$_POST = $this->_generate_birth_date($this->input->post());
			
			list($_POST['hash'], $_POST['salt'], $_POST['password']) = $this->model_user->_create_hash($this->input->post());
			
			list($flag, $id, $msg) = $this->model_user->add_user($this->input->post());
			die();
    	}

    	$this->_add_user_form();
    }

    function add_user1()
    {
    	$data['usprev'] = $this->model_user->usprev_dropdown();
    	$this->load->view('user/add_user1', $data);
    }
}
?>