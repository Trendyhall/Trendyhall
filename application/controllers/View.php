<?php 

defined('BASEPATH') OR exit('No direc script access allowed');

class View extends MY_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->helper('goodsview');
	}

	public function create_pagination($count, $row_count) {
		//pagination bootstrap
		$p_config['reuse_query_string'] = TRUE;
		$p_config['full_tag_open'] = '<ul class="pagination">';
		$p_config['full_tag_close'] ='</ul>';
		$p_config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
		$p_config['num_tag_close'] = '</span></li>';
		$p_config['cur_tag_open'] = '<li class="page-item active" aria-current="page"><span class="page-link">';
		$p_config['cur_tag_close'] = '</span></li>';
		$p_config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['next_link'] = '<span aria-hidden="true">&raquo;</span>';
		$p_config['next_tagl_close'] = '</span></li>';
		$p_config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
		$config['prev_link'] = '<span aria-hidden="true">&laquo;</span>';
		$p_config['prev_tagl_close'] = '</span></li>';

		$config['first_link'] = 'Первая';
		$p_config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
		$p_config['first_tagl_close'] = '</span></li>';
		$config['last_link'] = 'Последняя';
		$p_config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
		$p_config['last_tagl_close'] = '</span></li>';

		$p_config['base_url'] = '/'.$this->uri->segment(1).'/';
		if ($this->uri->segment(1)=='brands') $p_config['base_url'] .= $this->uri->segment(2).'/';

		$p_config['total_rows'] = $count;
		$p_config['per_page'] = $row_count;

		//init pagination
		$this->load->library('pagination');
		$this->pagination->initialize($p_config);

		return $this->pagination->create_links();
	}

	public function view($offset = 0, $where = FALSE) {
		$this->load->model('Goods_model');
		$this->load->model('Othertables_model');


		$offset = (int) $offset;
		$row_count = 42;// количество товара на странице
		$sort_type = 0;

		if (isset($where['sort-type'])){
			$sort_type = $where['sort-type'];
			unset($where['sort-type']);
		}
		

		$where_sql = $this->Goods_model->build_get_goods_where($where);
		$count = (int) $this->Goods_model->get_goods_count($where_sql);
		$this->data['goods'] = $this->Goods_model->get_goods($row_count, $offset, $sort_type, $where_sql);

		$pagination = $this->create_pagination($count, $row_count);


		$this->load->view('templates/header', $this->data);

		if ($this->uri->segment(1)=='brands') $this->load->view('brands/view', $this->data);

		view_echo($this->load, "<div class='row'>");
		$this->load->view('view/filters', $this->data);
		$this->load->view('view/view', $this->data);
		view_echo($this->load, "</div>");

		view_echo($this->load, "<div class='col col-xs-12 pagination-div'><nav>$pagination</nav></div>");

		$this->load->view('templates/footer');
	}

	
	public function index($offset = 0) {
		$this->data['title'] = "TSET";
		$this->view($offset, $_GET);
	}

	
	public function brands() {
		$this->data['title'] = "Бренды";
		$this->data['active_name'] = 2;

        $this->load->model('Brands_model');
        $this->data['brands'] = $this->Brands_model->get_brands();

		$this->load->view('templates/header', $this->data);
		$this->load->view('brand/index', $this->data);
		$this->load->view('templates/footer');
	}

    public function brand($slug, $offset = 0) {
        $this->load->model('Brands_model');
        $this->data['brand'] = $this->Brands_model->get_brand($slug);

        $this->data['title'] = $this->data['brand']['output'];
        $this->data['active_name'] = -1;
        $this->data['addBrandDescription'] = TRUE;


        $addition_where[0] = 'brand';
		$addition_where[1] = array($this->data['brand']['id']);

		$this->BuildFilters($offset, $addition_where);
    }

	public function boys($offset = 0) {
		$this->data['title'] = "Мальчики";
		$this->data['active_name'] = 3;


		$addition_where[0] = 'gender';
		$addition_where[1] = array(1, 3);

		$this->BuildFilters($offset, $addition_where);
	}

	public function girls($offset = 0) {
		$this->data['title'] = "Девочки";
		$this->data['active_name'] = 4;

		$addition_where[0] = 'gender';
		$addition_where[1] = array(2, 3);

		$this->BuildFilters($offset, $addition_where);
	}


	public function new($offset = 0) {
		$this->data['title'] = "Новинки";
		$this->data['active_name'] = 5;

		$addition_where[0] = 'season';
		$addition_where[1] = array(2);

		$this->BuildFilters($offset, $addition_where);
	}

	public function sale($offset = 0) {
		$this->data['title'] = "Скидки";
		$this->data['active_name'] = 6;

		$addition_where[0] = 'sale!';
		$addition_where[1] = array(0);

		$this->BuildFilters($offset, $addition_where);
	}

	public function item($good_code = NULL) {
		$this->load->model('Goods_model');
		$this->load->model('Colour_model');
		$this->load->model('Othertables_model');
		$this->load->helper('goodsview');
		$this->data['Othertables_model'] = $this->Othertables_model;

		$this->data['title'] = "";

		$good_code = explode('_', $good_code);
		$good_code[1] = $this->Colour_model->getIDByCode($good_code[1]);
		$this->data['good'] = $this->Goods_model->getGoodByCodeColour($good_code[0], $good_code[1]);
		if (empty($this->data['good'])) {
			show_404();
		}

		$this->data['sizes'] = $this->Goods_model->getAllSizesByCodeColour($good_code[0], $good_code[1]);
		$this->data['colours'] = $this->Goods_model->getAllColoursByCode($good_code[0]);
		$this->data['other_goods'] = $this->Goods_model->getGoodWithSameItemgroup($this->data['good']['itemgroup']);

		foreach ($this->data['other_goods'] as $key => $value) {
			$this->data['other_goods'][$key]['brand'] = $this->Othertables_model->GetByID("brands", "name", $value['brand']);
			$this->data['other_goods'][$key]['colour'] = $this->Colour_model->GetCodeByID($value['colour']);
		}
		

		//data change
		{
			$this->data['good']['brand'] = $this->Othertables_model->GetByID("brands", "name", $this->data['good']['brand']);
			$this->data['good']['rucolour'] = $this->Othertables_model->GetByID("colours", "runame", $this->data['good']['colour']);
			$this->data['good']['colour'] = $this->Othertables_model->GetByID("colours", "colourcode", $this->data['good']['colour']);
			$this->data['good']['provider'] = $this->Othertables_model->GetByID("providers", "name", $this->data['good']['provider']);
			$this->data['good']['manufacturer'] = $this->Othertables_model->GetByID("manufactures", "name", $this->data['good']['manufacturer']);
			$this->data['good']['country'] = $this->Othertables_model->GetByID("countries", "name", $this->data['good']['country']);
			$this->data['good']['description'] = $this->Othertables_model->GetByID("descriptions", "description", $this->data['good']['description']);
		}


		$this->data['title'] = $this->data['good']['name'];

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/item', $this->data);
		$this->load->view('templates/footer');
	}


	public function cart_cards() {
		$this->load->model('Goods_model');
		$this->load->model('Colour_model');
		$this->load->model('Othertables_model');
		$this->data['Othertables_model'] = $this->Othertables_model;


		$postData = file_get_contents('php://input');
		$cart_ids_json = json_decode($postData, true);
		foreach ($cart_ids_json as $key => $value) {
			$cart_ids[] = $key;
		}
		if (isset($cart_ids)) {
			$this->data['goods'] = $this->Goods_model->getGoodsByOnlyID($cart_ids);

			foreach ($this->data['goods'] as $key => $value) {
				$this->data['goods'][$key]['brand'] = $this->Othertables_model->GetByID("brands", "name", $value['brand']);
				$this->data['goods'][$key]['size'] = $this->Othertables_model->GetByID("sizes", "size", $value['size']);
				$this->data['goods'][$key]['colour'] = $this->Colour_model->GetCodeByID($value['colour']);
			}
		}
		$this->load->view('view/cart-cards', $this->data);
	}


	public function like_cards() {
		$this->load->model('Goods_model');
		$this->load->model('Colour_model');
		$this->load->model('Othertables_model');
		$this->data['Othertables_model'] = $this->Othertables_model;

		$postData = file_get_contents('php://input');
		$like_ids_json = json_decode($postData, true);
		$like_ids = array();
		foreach ($like_ids_json as $key => $value) {
			$like_ids[] = $key;
		}

		$this->data['goods'] = $this->Goods_model->getGoodsByOnlyID($like_ids);

		foreach ($this->data['goods'] as $key => $value) {
			$this->data['goods'][$key]['brand'] = $this->Othertables_model->GetByID("brands", "name", $value['brand']);
			$this->data['goods'][$key]['colour'] = $this->Colour_model->GetCodeByID($value['colour']);
		}

		//$this->data['good'] = $this->Goods_model->getGood($goodID);

		$this->load->view('view/like-cards', $this->data);
	}


}