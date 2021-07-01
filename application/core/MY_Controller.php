<?php 

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->data['title'] = "TRENDY HALL";

		$this->load->helper('cookie');
		$this->data['UserID'] = get_cookie('user-id');
		$this->data['IsAdmin'] = $this->data['UserID'] == '0';
	}

	public function allow_access(){
		if (!$this->data['IsAdmin']) show_404();
	}
}