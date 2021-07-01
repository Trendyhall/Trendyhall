<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Special extends MY_Controller {

	public function __constract() {
		parent::__constract();
	}


	public function index() {
		$this->allow_access();
		$this->data['title'] = "Специальная страница";
		$this->data['active_name'] = -1;


		$this->load->view('templates/header', $this->data);
		$this->load->view('special/index', $this->data);  
		$this->load->view('templates/footer');
	}

	public function database_upload() {
		$this->allow_access();
		$this->data['title'] = "Загрузка базы данных";
		$this->data['active_name'] = -1;

		$this->load->view('templates/header', $this->data);
		$this->load->view('special/database-upload', $this->data);
		$this->load->view('templates/footer');
	}

	public function database_upload1() {
		$this->allow_access();
		$this->data['title'] = "Загрузка базы данных";
		$this->data['active_name'] = -1;
		
		$this->load->model('Goods_model');
		$this->load->model('OtherTables_model');

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
			$row[2] = $this->OtherTables_model->FindID("colours", "colorcode", $row[2]);
			$row[3] = $this->OtherTables_model->FindID("sizes", "size", $row[3]);
			$row[6] = $this->OtherTables_model->FindID("brands", "name", $row[6]);
			$row[7] = $this->OtherTables_model->FindID("groups", "name", $row[7]);
			$row[10] = $this->OtherTables_model->FindID("providers", "name", $row[10]);
			$row[11] = $this->OtherTables_model->FindID("manufactures", "name", $row[11]);
			$row[12] = $this->OtherTables_model->FindID("countries", "name", $row[12]);
			$row[15] = $this->OtherTables_model->FindID("sales", "sale", $row[15]);
			$row[17] = $this->OtherTables_model->FindID("adddates", "date", $row[17]);
			$row[18] = $this->OtherTables_model->FindID("seasons", "name", $row[18]);
			$row[19] = $this->OtherTables_model->FindID("descriptions", "description", $row[19]);
			*/

			//$this->Goods_model->InsertGood($row);
		} 

		$this->load->view('templates/header', $this->data);
		$this->load->view('special/database-upload1', $this->data);
		$this->load->view('templates/footer');
	}

	public function headers1() {
		$this->allow_access();
		$this->data['title'] = "Заголовки";
		$this->data['active_name'] = -1;

		$this->load->view('templates/header', $this->data);
		
		$this->load->view('templates/footer');
	}

	public function databasedebug() {
		$this->allow_access();
		$this->data['title'] = "Заголовки";
		$this->data['active_name'] = -1;

		$this->input->post('tablename');

		$this->load->model('Goods_model');
		$this->load->model('OtherTables_model');

		if ($this->input->post('checkbox')) $this->data['resulte'] = $this->OtherTables_model->FindID($this->input->post('tablename'), $this->input->post('columnname'), $this->input->post('value'));
		else $this->data['resulte'] = "Check out check box";

		$this->load->view('templates/header', $this->data);
		$this->load->view('special/databasedebug', $this->data);
		$this->load->view('templates/footer');
	}

}