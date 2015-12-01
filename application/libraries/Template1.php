<?php  
/**
* 
*/
class Template1
{
	protected $CI;

	public function __construct()
	{
		$this->CI=& get_instance();
		$this->CI->load->helper(array('url', 'language'));
		$this->CI->lang->load('en', 'english');
	}

	public function create_view($page, $data = null){
		$data['userdata'] = $this->CI->session->userdata();
		$this->CI->load->view('templates/header', $data);
		$this->CI->load->view('templates/navbar', $data);
		$this->CI->load->view( $page, $data );
		$this->CI->load->view('templates/footer', $data);
	}

	public function create_view1($page, $data = null) {
		$this->CI->load->view('templates/header', $data);
		$this->CI->load->view($page, $data);
		$this->CI->load->view('templates/footer', $data);
	}
}
?>