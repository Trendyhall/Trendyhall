<?php
public function ParseFiltersInput() {
		$where_array = $_GET;
		$sort_type = 0;
		$has_params = FALSE;

		foreach ($where_array as $key => $value) {
			switch ($key) {
				case 'sort-type':
					$sort_type = $value;
					unset($where_array['sort-type']);
					break;
				case 'colour':
					$has_params = TRUE;
					$ColoursArray = array();
					foreach ($value as $key1 => $value1) {
						$ColoursID = $this->Colour_model->getIDByColourName($value1);
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

		$this->data['sort_type'] = $sort_type;

		if ($has_params === FALSE) return FALSE;
		else return $where_array;
	}

	public function BuildFilters($offset, $addition_where = FALSE) {
		$this->load->model('Goods_model');
		$this->load->model('Colour_model');
		$this->load->model('Othertables_model');
		$this->data['Othertables_model'] = $this->Othertables_model;

		$offset = (int) $offset;
		$row_count = 42;

		$where_array = $this->ParseFiltersInput();
		if ($addition_where !== FALSE) $where_array[$addition_where[0]] = $addition_where[1];

		$sort_type = $this->data['sort_type'];


		$IDs_array = $this->Goods_model->getGoodsID($where_array);
	
		$count = (int) $this->Goods_model->getGoodsCountByID($sort_type, $IDs_array);	
		$this->data['goods'] = $this->Goods_model->getGoodsByID($row_count, $offset, $sort_type, $IDs_array);

		foreach ($this->data['goods'] as $key => $value) {
			$this->data['goods'][$key]['brand'] = $this->Othertables_model->GetByID("brands", "name", $value['brand']);
			$this->data['goods'][$key]['colour'] = $this->Colour_model->GetCodeByID($value['colour']);
		}
		
		
		

		//pagination config
		$p_config = $this->p_init();

		$p_config['total_rows'] = $count;
		$p_config['per_page'] = $row_count;

		//init pagination
		$this->load->library('pagination');
		$this->pagination->initialize($p_config);
		$this->data['pagination'] = $this->pagination->create_links();

		

		$this->load->view('templates/header', $this->data);
		if (array_key_exists('addBrandDescription', $this->data)) $this->load->view('brand/view', $this->data);
		$this->load->view('view/filters', $this->data);
		$this->load->view('view/view', $this->data);
		$this->load->view('templates/footer');
	}
