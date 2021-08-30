<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Background extends MY_Controller {
	public function __construct() {
		parent::__construct();
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

	public function user_exsist() {
		$postData = file_get_contents('php://input');
		$post_json = json_decode($postData, true);
		if (!array_key_exists('phone', $post_json)) show_404();
		
		$this->load->model('Users_model');
		echo $this->Users_model->GetExsistByPhone($post_json['phone']);
	}

	public function user_signup() {
		$postData = file_get_contents('php://input');
		$post_json = json_decode($postData, true);
		if (!array_key_exists('uuid', $post_json) || !array_key_exists('phone', $post_json) || !array_key_exists('password', $post_json)) show_404();
		
		$this->load->model('Users_model');
		$this->Users_model->set_new_user($post_json);
		echo true;
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
		
		$this->load->model('Orders_model');
		$this->load->model('Goods_model');
		$id = $this->Orders_model->set_new_order($post_json);
		
		$order_body = json_decode($post_json['orderbody']);
		foreach ($order_body as $key => $value) {
			$this->Goods_model->update_good_count($key, -$value);
		}
		
		echo $id;
	}

}