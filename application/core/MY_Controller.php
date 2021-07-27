<?php 

class MY_Controller extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->data['title'] = "TRENDY HALL";

		$this->load->helper('cookie');
		$this->data['UserID'] = get_cookie('user-id');
		$ADMIN_UUID = "b8038c7c-4fc1-4ad7-b64d-406449663c4c";
		$this->data['IsAdmin'] = $this->data['UserID'] == $ADMIN_UUID;
	}

	public function allow_access(){
		if (!$this->data['IsAdmin']) show_404();
	}
}