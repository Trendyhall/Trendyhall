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

	public function db_upload() {
		$this->allow_access();
		$this->data['title'] = "Загрузка базы данных";
		
		$this->load->model('Goods_model');
		$this->load->model('Othertables_model');

		$uploaddir = 'C:\xampp\tmp';
		$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
		if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
		    $is_ok = true;
		} else {
		    $is_ok = false;
		}
		if ($is_ok) foreach (explode("\n", file_get_contents($uploadfile)) as $key => $value) {
			$row = explode(";", $value);

			/*
			$row[2] = $this->Othertables_model->FindID("colours", "colourcode", $row[2]);
			$row[3] = $this->Othertables_model->FindID("sizes", "size", $row[3]);
			$row[6] = $this->Othertables_model->FindID("brands", "name", $row[6]);
			$row[7] = $this->Othertables_model->FindID("groups", "name", $row[7]);
			$row[10] = $this->Othertables_model->FindID("providers", "name", $row[10]);
			$row[11] = $this->Othertables_model->FindID("manufactures", "name", $row[11]);
			$row[12] = $this->Othertables_model->FindID("countries", "name", $row[12]);
			$row[17] = $this->Othertables_model->FindID("adddates", "date", $row[17]);
			$row[18] = $this->Othertables_model->FindID("seasons", "name", $row[18]);
			$row[19] = $this->Othertables_model->FindID("descriptions", "description", $row[19]);
			*/

			//$this->Goods_model->InsertGood($row);
		} 

		$this->load->view('templates/header', $this->data);
		$this->load->view('admin/database-upload1', $this->data);
		$this->load->view('templates/footer');
	}
}