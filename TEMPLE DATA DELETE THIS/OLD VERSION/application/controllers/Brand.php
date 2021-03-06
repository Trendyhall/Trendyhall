<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class Brand extends MY_Controller {

	public function __constract() {
		parent::__constract();
	}

    public function p_init() {
        //pagination bootstrap
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
        $p_config['first_tag_open'] = "<li>";
        $p_config['first_tagl_close'] = "</li>";
        $p_config['last_tag_open'] = "<li>";
        $p_config['last_tagl_close'] = "</li>";
        return $p_config;
    }

	public function index() {
		$this->data['title'] = "Бренды";
		$this->data['active_name'] = 2;

        $this->load->model('Brands_model');
        $this->data['brands'] = $this->Brands_model->getBrands();

		$this->load->view('templates/header', $this->data);
		$this->load->view('brand/index', $this->data);
		$this->load->view('templates/footer');
	}

    public function view($slug) {
        $this->load->model('Brands_model');
        $this->data['brand'] = $this->Brands_model->getBrand($slug);

        $this->data['title'] = $this->data['brand']['name'];
        $this->data['active_name'] = -1;

        $this->load->model('Goods_model');
        $this->load->library('pagination');

        $offset = (int) $this->uri->segment(3);
        $row_count = 60;
        
        $count = (int) $this->Goods_model->getGoodsCount(0, array('brand' => $this->data['brand']['name']));

        $this->data['goods'] = $this->Goods_model->getGoods($row_count, $offset, 0, array('brand' => $this->data['brand']['name']));

        //pagination config
        $p_config = $this->p_init();
        $p_config['base_url'] = '/brands/'.$slug;    
        $p_config['total_rows'] = $count;
        $p_config['per_page'] = $row_count;

        //init pagination
        $this->pagination->initialize($p_config);
        $this->data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header', $this->data);
        $this->load->view('brand/view', $this->data);
        $this->load->view('templates/footer');
    }
}