<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Addition extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}


	public function index() {
		$this->redirect('/');
	}

	public function junior_republic_event() {
		$this->data['title'] = "Акция от Junior Republic";


		$this->load->view('templates/header', $this->data);
		$this->load->view('addition/junior-republic-event', $this->data);  
		$this->load->view('templates/footer');
	}
}