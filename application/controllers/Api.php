<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Api extends MY_Controller {
	private const API_KEY = 'a8b8aaea-07e2-489b-8449-f35408a1e3f5';

	public function __constract() {
		parent::__constract();
	}


	public function index() {
		$postData = file_get_contents('php://input');
		$post_json = json_decode($postData, true);
		if (!array_key_exists('api-key', $post_json)) show_404();
		if ($post_json['api-key'] == self::API_KEY) 
		{
			echo "Your api key is right"."<br>";
			var_dump($post_json['data']);
		}
		else show_404(); 
	}
}