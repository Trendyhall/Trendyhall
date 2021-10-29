<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Background extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->helper('post');
	}


	public function index() {
		 
	}

	public function user_login() {
		$post_json = get_post_json_and_test_keys(array('phone', 'password'));
		if (!$post_json) show_404();
		
		$this->load->model('Users_model');
		echo $this->Users_model->get_uuid_by_phone_password($post_json['phone'], $post_json['password']);
	}

	public function user_exsist() {
		$post_json = get_post_json_and_test_keys(array('phone'));
		if (!$post_json) show_404();
		
		$this->load->model('Users_model');
		echo $this->Users_model->get_exsist_by_phone($post_json['phone']);
	}

	public function user_signup() {
		$post_json = get_post_json_and_test_keys(array('uuid', 'phone', 'password'));
		if (!$post_json) show_404();
		
		$this->load->model('Users_model');
		$this->Users_model->set_new_user($post_json);
		echo true;
	}


	public function get_user_name() {
		$post_json = get_post_json_and_test_keys(array('uuid'));
		if (!$post_json) show_404();
		
		$this->load->model('Users_model');
		echo $this->Users_model->get_user_name_by_uuid($post_json['uuid']);
	}

	public function new_order() {
		$post_json = get_post_json_and_test_keys(array('orderbody', 'phone', 'name'));
		if (!$post_json) show_404();
		
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