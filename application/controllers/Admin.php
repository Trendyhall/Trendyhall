<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Admin extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}


	public function index() {
		$this->allow_access();
		$this->data['title'] = "Страница администратора";


		$this->load->view('templates/header', $this->data);
		$this->load->view('admin/index', $this->data);  
		$this->load->view('templates/footer');
	}

	public function settings() {
		$this->allow_access();
		$this->data['title'] = "Настройки";

		$this->load->view('templates/header', $this->data);
		$this->load->view('admin/settings', $this->data);
		$this->load->view('templates/footer');
	}

	public function orders($id = false) {
		$this->allow_access();
		$this->data['title'] = "Заказы";

		$this->load->model('Orders_model');
		if (!$id) {
			$this->data['orders'] = $this->Orders_model->GetOrdersList();

			$this->load->view('templates/header', $this->data);
			$this->load->view('admin/orders', $this->data);
			$this->load->view('templates/footer');
		} else {
			$this->load->model('Goods_model');

			$this->data['order'] = $this->Orders_model->GetOrderByID($id);
			if ($this->data['order'] === FALSE) {
				
    			echo "<script type='text/javascript'>alert('Заказ с номером $id не был найден'); window.location = '/admin/orders';</script>";
			}
			$this->data['cart_json'] = json_decode($this->data['order']['orderbody'], true);
			foreach ($this->data['cart_json'] as $key => $value) {
				$ids[] = $key;
			}
			$this->data['cart'] = $this->Goods_model->getGoodsByOnlyID($ids);

			$this->load->view('templates/header', $this->data);
			$this->load->view('admin/order', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function order_delete($id) {
		$this->allow_access();
		$this->data['title'] = "Заказы";

		$this->load->model('Orders_model');
		$this->Orders_model->DeleteOrderByID($id);

		$this->redirect('/admin/orders');
	}

	public function order_cancel($id) {
		$this->allow_access();
		$this->data['title'] = "Заказы";

		$this->load->model('Orders_model');
		$this->load->model('Goods_model');

		$order_body = json_decode($this->Orders_model->GetOrderByID($id)['orderbody']);
		foreach ($order_body as $key => $value) {
			$this->Goods_model->updateGoodCountByID($key, $value);
		}

		$this->Orders_model->DeleteOrderByID($id);

		$this->redirect('/admin/orders');
	}



	//================

	public function headers1() {
		$this->allow_access();
		$this->data['title'] = "Заголовки";

		$this->load->view('templates/header', $this->data);
		
		$this->load->view('templates/footer');
	}

	public function databasedebug() {
		$this->allow_access();
		$this->data['title'] = "Заголовки";

		$this->input->post('tablename');

		$this->load->model('Goods_model');
		$this->load->model('Othertables_model');

		if ($this->input->post('checkbox')) $this->data['resulte'] = $this->Othertables_model->FindID($this->input->post('tablename'), $this->input->post('columnname'), $this->input->post('value'));
		else $this->data['resulte'] = "Check out check box";

		$this->load->view('templates/header', $this->data);
		$this->load->view('admin/databasedebug', $this->data);
		$this->load->view('templates/footer');
	}


	public function fillucode() {
		$this->allow_access();
		$this->data['title'] = "Fill ucode";

		$this->load->model('Goods_model');

		$this->Goods_model->Spetial1();

		$this->load->view('templates/header', $this->data);
		$this->load->view('admin/fillucode', $this->data);
		$this->load->view('templates/footer');
	}
	
	public function database_upload() {
		$this->allow_access();
		$this->data['title'] = "Загрузка базы данных";

		$this->load->view('templates/header', $this->data);
		$this->load->view('admin/database-upload', $this->data);
		$this->load->view('templates/footer');
	}

	public function database_upload1() {
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
			var_dump($row);
			echo "<br>";
			
			$row[3] = $this->Othertables_model->FindORInsertID("colours",       $row[3] );
			$row[4] = $this->Othertables_model->FindORInsertID("sizes",         $row[4] );
			$row[7] = $this->Othertables_model->FindORInsertID("brands",        $row[7] );
			$row[8] = $this->Othertables_model->FindORInsertID("groups",        $row[8] );
			$row[11] = $this->Othertables_model->FindORInsertID("providers",    $row[11]);
			$row[12] = $this->Othertables_model->FindORInsertID("manufactures", $row[12]);
			$row[13] = $this->Othertables_model->FindORInsertID("countries",    $row[13]);
			$row[18] = $this->Othertables_model->FindORInsertID("seasons",      $row[18]);
			

			$this->Goods_model->InsertGood($row);
		} 

		/*$this->load->view('templates/header', $this->data);
		$this->load->view('admin/database-upload1', $this->data);
		$this->load->view('templates/footer');*/
	}

}