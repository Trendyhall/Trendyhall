<?php 

class MY_Controller extends CI_Controller {

	private const ADMIN_UUID = 'b8038c7c-4fc1-4ad7-b64d-406449663c4c';

	public function __construct() {
		parent::__construct();
		

		$this->data['title'] = "TRENDY HALL";

		$this->load->helper('cookie');
		$this->data['UserID'] = get_cookie('user-id');
		
		$this->data['IsAdmin'] = $this->data['UserID'] == self::ADMIN_UUID;
	}

	public function allow_access(){
		if (!$this->data['IsAdmin']) show_404();
	}
}