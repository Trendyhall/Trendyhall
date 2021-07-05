<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Main extends MY_Controller {

	public function __constract() {
		parent::__constract();
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


	public function item($good_code = NULL) {
		$this->load->model('Goods_model');
		$this->load->model('Colour_model');

		$this->data['title'] = "";
		$this->data['active_name'] = -1;

		$good_code = explode('_', $good_code);
		$good_code[1] = $this->Colour_model->getIDByCode($good_code[1]);
		$this->data['good'] = $this->Goods_model->getGoodByCodeColour($good_code[0], $good_code[1]);
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