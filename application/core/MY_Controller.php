<?php 

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();
		

		$this->data['title'] = "TRENDY HALL";
		$this->data['active_name'] = -1;

		$this->load->helper('cookie');
		$this->data['UUID'] = get_cookie('uuid');
		
		$this->data['is_admin'] = $this->data['UUID'] == $this->config->item('admin_uuid');
	}

	public function allow_access(){
		if (!$this->data['is_admin']) show_404();
	}

	public function redirect($url, $statusCode = 303)
	{
	   header('Location: ' . $url, true, $statusCode);
	   die();
	}
}