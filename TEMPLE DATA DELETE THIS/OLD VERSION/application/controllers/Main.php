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
		$p_config['num_tag_open'] = '<li>';
		$p_config['num_tag_close'] = '</li>';
		$p_config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$p_config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$p_config['next_tag_open'] = "<li>";
		$p_config['next_tagl_close'] = "</li>";
		$p_config['prev_tag_open'] = "<li>";
		$p_config['prev_tagl_close'] = "</li>";
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

	public function news() {
		$this->data['title'] = "Новости";
		$this->data['active_name'] = 1;

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/news', $this->data);
		$this->load->view('templates/footer');
	}

	public function man() {//?size=8,10&color=чёрный,белый
		$this->load->model('Goods_model');
		$this->load->library('pagination');

		$this->data['title'] = "Мальчики";
		$this->data['active_name'] = 3;

		$this->data['url'] = $this->uri->uri_string();

		$offset = (int) $this->uri->segment(2);
		$row_count = 42;


		$sort_type = 0;
		$has_params = FALSE;
		$where_array = array();

		$url = parse_url($_SERVER['REQUEST_URI']);
		parse_str(@$url['query'], $params);
		foreach ($params as $key => $value) {
			switch ($key) {
				case 'sort':
					$sort_type = $value;
					break;
				case 'color':
					$this->load->model('Color_model');
					$colors_arr = explode(",", $value);
					$where_array['colorcode'] = array();
					for ($j=0; $j < count($colors_arr); $j++) { 
						$colors_array = $this->Color_model->getColorCodes($colors_arr[$j]);
						for ($i=0; $i < count($colors_array); $i++) { 
							array_push($where_array['colorcode'], $colors_array[$i]['colorcode']);
						}
					}
					if (count($where_array['colorcode']) > 0) {
						$has_params = TRUE;
					}
					break;

				default:
					$where_array[$key] = explode(",", $value);
					if (count($where_array[$key]) > 0) {
						$has_params = TRUE;
					}
					break;
			}
		}

		$this->data['sort_type'] = $sort_type;
		$this->data['params'] = $where_array;

		if ($has_params === FALSE) {
			$count = (int) $this->Goods_model->getGoodsCount($sort_type);	
			$this->data['goods'] = $this->Goods_model->getGoods($row_count, $offset, $sort_type);
		} else {
			$count = (int) $this->Goods_model->getGoodsCount($sort_type, $where_array);	
			$this->data['goods'] = $this->Goods_model->getGoods($row_count, $offset, $sort_type, $where_array);
		}
		
		

		//pagination config
		$p_config = $this->p_init();
		$p_config['base_url'] = '/man/';

		$p_config['total_rows'] = $count;
		$p_config['per_page'] = $row_count;

		//init pagination
		$this->pagination->initialize($p_config);
		$this->data['pagination'] = $this->pagination->create_links();


		$this->load->view('templates/header', $this->data);
		$this->load->view('main/man', $this->data);
		$this->load->view('templates/footer');
	}

	public function woman() {
		$this->load->model('Goods_model');
		$this->load->library('pagination');

		$this->data['title'] = "Девочики";
		$this->data['active_name'] = 4;

		

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/woman', $this->data);
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

	public function view($articule = NULL) {
		$this->load->model('Goods_model');

		$this->data['title'] = "";
		$this->data['active_name'] = -1;

		$this->data['good'] = $this->Goods_model->getGood($articule);
		if (empty($this->data['good'])) {
			show_404();
		}
		$this->data['title'] = $this->data['good']['item'];

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/view', $this->data);
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

	public function termsofuse()
	{
		$this->data['title'] = "Политика о конфиденциальности";
		$this->data['active_name'] = -1;
		
		$this->load->view('templates/header', $this->data);
		$this->load->view('main/terms-of-use', $this->data);
		$this->load->view('templates/footer');
	}
}