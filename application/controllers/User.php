<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* 
*/
class User extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('model_user');
	}

	function _process_randomstr( $length, $params ) {
		//menghilangkan space dan hanya mengambil karakter A-Z,a-z,0-9
		$karakter = preg_replace("/[^A-Za-z0-9]/",'', $params['username'].$params['id']);
		//set string = null
		$string = '';
		for ($i = 0; $i < $length; $i++) {
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter{$pos};
		}
		
		$salt = $this->model_user->_create_salt($string);
		$hash = $this->model_user->_create_hash($salt, $string);

		return array($string, $salt, $hash);
	}

	function _generate_id( $params = array() ){
		if ($params['Jenis_User'] == 'Siswa') {
			$params['juser'] = 'usersis';
			$max = $this->model_user->_get_max_id($params);
			$urut = (int)substr($max, 12, 15);
			$urut++;
			$gender = genderInt($params['Jenis_Kel']);
			$tahun = date('Y');
		}
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

	function _edit_user_form($id) {
		$data['record'] = $this->model_user->get_user_data(array('id' => $id));
		
		$this->template1->create_view('user/edit_data', $data);
	}

	function edit_user($id) {		
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

	function login() {
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

	function list_user() {
		$data['records'] = $this->model_user->get_user_info();
		$this->template1->create_view('user/list_data', $data);
	}

    function logout() {
    	$this->session->sess_destroy();
    	redirect('main');
    }

    function _add_user_form(){
    	$this->template1->create_view('user/add_user');
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
    	$this->load->view('user/add_user1');
    }
}
?>