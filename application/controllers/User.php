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

	function _edit_user_form($params) {
		$data['record'] = $this->model_user->get_user_data(array('ID_User' => $params));
		$data['Salt'] = $this->model_user->_create_salt($data['record']->Password);
		$data['Hash'] = $this->model_user->_create_hash($data['Salt'], $data['record']->Password);
		
		$this->template1->create_view('user/edit_data', $data);
	}

	function edit_user($id) {		
		$save = $this->input->post('submit');

		if( $save ) {
			unset($_POST['submit']);
			
			$_POST['salt'] = $this->model_user->_create_salt($_POST['password']);
			$_POST['hash'] = $this->model_user->_create_hash($_POST['salt'], $_POST['password']);

			$this->model_user->add_user($this->input->post(), $id);
			redirect('user/list_user');

		//$data['record'] = $this->model_user->get_user_data(array('username' => $id));

		//$data['random'] = $this->model_user->_process_randomstr(10, $data['Username'], $data['Jenis_User']);
		// $data['salt'] = $this->model_user->_create_salt($data['record']->Password);
		// $data['hash'] = $this->model_user->_create_hash($data['salt'], $data['record']->Password);

		//$data['message'] = $this->model_user->update_user($data);

		}

		$this->_edit_user_form($id);
	}

	function login() {
		$login = $this->input->post('login');

		if ($login){
			unset($_POST['login']);
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === TRUE){
				$userdata = $this->model_user->get_user_info($this->input->post());

				if ( $userdata ) {
					$hash = $this->model_user->_create_hash($userdata['Salt'], $_POST['password']);
					
					if($hash == $userdata['Hash'] && $_POST['password']==$userdata['Password']){
						$this->session->set_userdata($userdata);
						redirect('');
					} else {
						echo "Wrong Password";
					}
				} else {
					echo "Wrong Username & Password";
				}
			}
		}

		$this->template1->create_view1('user/user_login');
	}

	function list_user() {
		$data['records'] = $this->model_user->get_user_info();
		//getting default password with _process_randomstr
		//list($data['random'], $data['salt'], $data['hash']) = $this->model_user->_process_randomstr(10, $this->session->userdata('Username'), $this->session->userdata('Jenis_User'));
		// $data['random'] = $this->model_user->_process_randomstr(10, $this->session->userdata('Username'), $this->session->userdata('Jenis_User'));
		// $data['salt'] = $this->model_user->_create_salt($data['random']);
		// $data['hash'] = $this->model_user->_create_hash($data['salt'], $data['random']);
		$this->template1->create_view('user/list_data', $data);
	}

    function truepage($msg) {
    	//$data['title'] = "Success Login";

    	//$data['session'] = $this->session->userdata();
    	redirect('');
    }

    function logout() {
    	$this->session->sess_destroy();
    	redirect('');
    }

    function _add_user_form(){
    	$this->template1->create_view('user/add_user');
    }

    function add_user() {
    	$save = $this->input->post('submit');

    	if($save) {
			unset($_POST['submit']);
			//unset($_POST['ID_User']);
			
			
			$_POST['salt'] = $this->model_user->_create_salt($_POST['password']);
			$_POST['hash'] = $this->model_user->_create_hash($_POST['salt'], $_POST['password']);

			$this->model_user->add_user($this->input->post());//die(var_dump($q));
			redirect('user/list_user');
    	}

    	// $this->load->view('user/add_user');
    	$this->_add_user_form();
    }

    function add_user1()
    {
    	$this->load->view('user/add_user1');
    }
}
?>