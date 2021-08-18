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
		$row_count = $this->config->item('cards_of_good_on_page');
		$sort_type = 0;// тип сортировки по умолчанию

		if (isset($where['sort-type'])){
			$sort_type = $where['sort-type'];
			unset($where['sort-type']);
		}

		foreach ($where as $key => $value) {
			// code...
		}
		
		// ====== DATA ======
		$where_sql = $this->Goods_model->build_get_goods_where($where);

		$count = (int) $this->Goods_model->get_goods_count($where_sql);
		$this->data['goods'] = $this->Goods_model->get_goods($row_count, $offset, $sort_type, $where_sql);
		foreach ($this->data['goods'] as $key => $value) {
			$this->data['goods'][$key]['brand'] = $this->Othertables_model->get('brands', $value['brand']);
		}

		$pagination = $this->create_pagination($count, $row_count);

		// ====== VIEW =======
		$this->load->view('templates/header', $this->data);

		if ($this->uri->segment(1)=='brands') $this->load->view('brand/view', $this->data);

		view_echo($this->load, "<div class='row'>");
		$this->load->view('view/filters', $this->data);
		$this->load->view('view/view', $this->data);
		view_echo($this->load, "</div>");

		view_echo($this->load, "<div class='col col-xs-12 pagination-div'><nav>$pagination</nav></div>");

		$this->load->view('templates/footer');
	}

	
	public function index($offset = 0) {
		$this->data['title'] = "TEST";
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

        $where = $_GET;
        $where['brand'] = array($this->data['brand']['id']);

		$this->view($offset, $where);
    }

	public function boys($offset = 0) {
		$this->data['title'] = "Мальчики";
		$this->data['active_name'] = 3;

		$where = $_GET;
        $where['gender'] = array(1, 3);

		$this->view($offset, $where);
	}

	public function girls($offset = 0) {
		$this->data['title'] = "Девочки";
		$this->data['active_name'] = 4;

		$where = $_GET;
        $where['gender'] = array(2, 3);

		$this->view($offset, $where);
	}


	public function new($offset = 0) {
		$this->data['title'] = "Новинки";
		$this->data['active_name'] = 5;

		$this->load->model('Othertables_model');
		
		$where = $_GET;
        $where['season'] = $this->Othertables_model->get_sorting_keys('seasons_sort', $this->config->item('actual_season'));

		$this->view($offset, $where);
	}

	public function sale($offset = 0) {
		$this->data['title'] = "Скидки";
		$this->data['active_name'] = 6;

		$where = $_GET;
		$where['sale!'] = array(0);

		$this->view($offset, $where);
	}

	public function item($good_code = NULL) {
		$this->load->model('Goods_model');
		$this->load->model('Othertables_model');
		$this->load->helper('goodsview');

		$this->data['title'] = "";

		$good_id = $good_code;
		/*$good_id = explode('|', $good_code);
		if (isset($good_id[0])) $good_id = $good_id[0];
		else show_404();*/

		$this->data['good'] = $this->Goods_model->get_good($good_id);
		if (empty($this->data['good'])) {
			show_404();
		}

		$this->data['sizes'] = $this->Goods_model->get_all_sizes($this->data['good']['modelcode'], $this->data['good']['colour']);
		$this->data['colours'] = $this->Goods_model->get_all_colors($this->data['good']['modelcode']);
		$this->data['other_goods'] = $this->Goods_model->get_similar_good($this->data['good']['itemgroup']);

		foreach ($this->data['other_goods'] as $key => $value) {
			$this->data['other_goods'][$key]['brand'] = $this->Othertables_model->get("brands", $value['brand']);
		}
		

		//data change
		{
			$this->config->load('databaseequals');
			foreach ($this->config->item('foreign_column_name_to_table_name') as $key => $value) {
				$this->data['good'][$key] = $this->Othertables_model->get($value, $this->data['good'][$key]);
			}
		}


		$this->data['title'] = $this->data['good']['name'];

		$this->load->view('templates/header', $this->data);
		$this->load->view('view/item', $this->data);
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