<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Main extends MY_Controller {

	public function __constract() {
		parent::__constract();
	}

	public function p_init() {
		//pagination bootstrap
		$p_config['reuse_query_string'] = TRUE;
		$p_config['full_tag_open'] = "<ul class='pagination'>";
		$p_config['full_tag_close'] ="</ul>";
		$p_config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$p_config['num_tag_close'] = '</span></li>';
		$p_config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
		$p_config['cur_tag_close'] = "</span></li>";
		$p_config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
		$p_config['next_tagl_close'] = "</span></li>";
		$p_config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
		$p_config['prev_tagl_close'] = "</span></li>";

		$config['first_link'] = 'Первая';
		$p_config['first_tag_open'] = "<li>";
		$p_config['first_tagl_close'] = "</li>";
		$config['last_link'] = 'Последняя';
		$p_config['last_tag_open'] = "<li>";
		$p_config['last_tagl_close'] = "</li>";

		return $p_config;
	}

	public function index() {
		$this->data['title'] = "Главная страница";
		$this->data['active_name'] = 0;


		$this->load->view('templates/header', $this->data);
		$this->load->view('main/index', $this->data);
		$this->load->view('templates/footer');
	}

	public function signup() {
		$this->data['title'] = "Зарегистрироваться";
		$this->data['active_name'] = -1;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/signup', $this->data);
		$this->load->view('templates/footer');
	}

	public function reset_password() {
		$this->data['title'] = "Восстановить пароль";
		$this->data['active_name'] = -1;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/reset_password', $this->data);
		$this->load->view('templates/footer');
	}

	public function profile() {
		$this->data['title'] = "Профиль";
		$this->data['active_name'] = -1;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/profile', $this->data);
		$this->load->view('templates/footer');
	}

	public function cart() {
		$this->data['title'] = "Корзина";
		$this->data['active_name'] = -1;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/cart', $this->data);
		$this->load->view('templates/footer');
	}

	public function news() {
		$this->data['title'] = "Новости";
		$this->data['active_name'] = 1;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/news', $this->data);
		$this->load->view('templates/footer');
	}

	public function view() {//?size=8&size=10&color=чёрный&color=белый
		$this->load->model('Goods_model');
		$this->load->model('Othertables_model');

		$this->load->library('pagination');

		$this->data['title'] = "Мальчики";
		$this->data['active_name'] = 3;

		

		$offset = (int) $this->uri->segment(2);
		$row_count = 42;

		$sort_type = 3;
		$has_params = FALSE;

		$where_array = $_GET;

		foreach ($where_array as $key => $value) {
			switch ($key) {
				case 'sort-type':
					$sort_type = $value;
					unset($where_array['sort-type']);
					break;
				case 'colour':
					$has_params = TRUE;
					$this->load->model('Color_model');
					$ColoursArray = array();
					foreach ($value as $key1 => $value1) {
						$ColoursID = $this->Color_model->getIDByColourName($value1);
						foreach ($ColoursID as $key2 => $value2) {
						 	$ColoursArray[] = $value2['id'];
						}
					}
					$where_array['colour'] = $ColoursArray;
					break;

				case 'itemgroup':
					$has_params = TRUE;
					$KeysArray = array();
					foreach ($value as $key1 => $value1) {
						$KeysArray[] = $this->Othertables_model->FindID("groups", "name", $value1);
					}
					$where_array[$key] = $KeysArray;
					break;

				case 'size':
					$has_params = TRUE;
					$KeysArray = array();
					foreach ($value as $key1 => $value1) {
						$KeysArray[] = $this->Othertables_model->FindID("sizes", "size", $value1);
					}
					$where_array[$key] = $KeysArray;
					break;

				default:
					/*$where_array[$key] = explode(",", $value);
					if (count($where_array[$key]) > 0) {
						$has_params = TRUE;
					}*/
					break;
			}
		}

		$this->data['where_array'] = $where_array;

		$this->data['sort_type'] = $sort_type;

		if ($has_params === FALSE) {
			$count = (int) $this->Goods_model->getGoodsCount($sort_type);	
			$this->data['goods'] = $this->Goods_model->getGoods($row_count, $offset, $sort_type);

			foreach ($this->data['goods'] as $key => $value) {
				$this->data['goods'][$key]['brand'] = $this->Othertables_model->GetByID("brands", "name", $value['brand']);
			}

		} else {
			$count = (int) $this->Goods_model->getGoodsCount($sort_type, $where_array);	
			$this->data['goods'] = $this->Goods_model->getGoods($row_count, $offset, $sort_type, $where_array);

			foreach ($this->data['goods'] as $key => $value) {
				$this->data['goods'][$key]['brand'] = $this->Othertables_model->GetByID("brands", "name", $value['brand']);
			}
		}
		
		

		//pagination config
		$p_config = $this->p_init();
		$p_config['base_url'] = '/goods/';

		$p_config['total_rows'] = $count;
		$p_config['per_page'] = $row_count;

		//init pagination
		$this->pagination->initialize($p_config);
		$this->data['pagination'] = $this->pagination->create_links();

		$this->data['Othertables_model'] = $this->Othertables_model;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/filters', $this->data);
		$this->load->view('main/view', $this->data);
		$this->load->view('templates/footer');
	}


	public function new() {
		$this->data['title'] = "Новинки";
		$this->data['active_name'] = 5;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/new', $this->data);
		$this->load->view('templates/footer');
	}

	public function sale() {
		$this->data['title'] = "Скидки";
		$this->data['active_name'] = 6;



		$this->load->view('templates/header', $this->data);
		$this->load->view('main/sale', $this->data);
		$this->load->view('templates/footer');
	}


	public function item($good_id = NULL) {
		$this->load->model('Goods_model');

		$this->data['title'] = "";
		$this->data['active_name'] = -1;

		$this->data['good'] = $this->Goods_model->getGood(trim($good_id, "id-"));
		if (empty($this->data['good'])) {
			show_404();
		}

		$this->data['title'] = $this->data['good']['name'];

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/item', $this->data);
		$this->load->view('templates/footer');
	}






	public function contact(){

		$this->data['title'] = "Контакты";
		$this->data['active_name'] = -1;

		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->library('email');

        //set validation rules
        $this->form_validation->set_rules('name', 'Ваше имя', 'trim|required');
        $this->form_validation->set_rules('email', 'Ваш email', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Тема', 'trim|required');
        $this->form_validation->set_rules('message', 'Ваш отзыв', 'trim|required');

        //run validation on form input
        if ($this->form_validation->run() == FALSE) {
            //validation fails
            $this->load->view('templates/header', $this->data);
			$this->load->view('main/contact', $this->data);
			$this->load->view('templates/footer');
			//redirect('/contact');
        }
        else {
            //get the form data
            $name = $this->input->post('name');
            $from_email = $this->input->post('email');
            $subject = $this->input->post('subject');
            $message = $this->input->post('message');

            //set to_email id to which you want to receive mails
            $to_email = 'grunin200412@gmail.com';                  

            //send mail
            $this->email->from($from_email, $name);
            $this->email->to($to_email);
            $this->email->subject($subject);
            $this->email->message($message);
            if ($this->email->send()) {
                // mail sent
                $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Ваше сообщение успешно отправлено!</div>');
                redirect('/contact');
            }
            else {
                //error
                $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Произошла ошибка, повторите попытку позже.</div>');
                redirect('/contact');
            }
        }
	}

	public function privacypolicy()
	{
		$this->data['title'] = "Политика о конфиденциальности";
		$this->data['active_name'] = -1;
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('main/privacy-policy', $this->data);
		$this->load->view('templates/footer');
	}

	public function terms()
	{
		$this->data['title'] = "Политика о конфиденциальности";
		$this->data['active_name'] = -1;
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('main/terms', $this->data);
		$this->load->view('templates/footer');
	}
}