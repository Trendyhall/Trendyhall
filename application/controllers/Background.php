<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Background extends MY_Controller {
	public function __constract() {
		parent::__constract();
	}


	public function index() {
		 
	}

	public function user_login() {
		$postData = file_get_contents('php://input');
		$post_json = json_decode($postData, true);
		if (!array_key_exists('phone', $post_json) || !array_key_exists('password', $post_json)) show_404();
		
		$this->load->model('Users_model');
		echo $this->Users_model->GetUUIDByPhonePassword($post_json['phone'], $post_json['password']);
	}

	public function get_user_name() {
		$postData = file_get_contents('php://input');
		$post_json = json_decode($postData, true);
		if (!array_key_exists('uuid', $post_json)) show_404();
		
		$this->load->model('Users_model');
		echo $this->Users_model->GetUserNameByUUID($post_json['uuid']);
	}

	public function new_order() {
		$postData = file_get_contents('php://input');
		$post_json = json_decode($postData, true);
		if (!array_key_exists('orderbody', $post_json)) show_404();
		
		
		$this->load->model('Users_model');
		$this->Users_model->SetNewOrder($post_json);
		var_dump($post_json);
	}

}