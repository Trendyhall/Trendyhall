<?php 

class MY_Controller extends CI_Controller {

	private const ADMIN_UUID = 'b8038c7c-4fc1-4ad7-b64d-406449663c4c';

	public function __construct() {
		parent::__construct();
		

		$this->data['title'] = "TRENDY HALL";
		$this->data['active_name'] = -1;

		$this->load->helper('cookie');
		$this->data['UUID'] = get_cookie('uuid');
		
		$this->data['IsAdmin'] = $this->data['UUID'] == self::ADMIN_UUID;
	}

	public function allow_access(){
		if (!$this->data['IsAdmin']) $this->redirect('/404');
	}

	public function redirect($url, $statusCode = 303)
	{
	   header('Location: ' . $url, true, $statusCode);
	   die();
	}
}