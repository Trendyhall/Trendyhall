<?php  

class Goods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getGoodsCount($sort_type, $where_array = FALSE)
	{
		if ($sort_type == 1) {
			$query = $this->db
			->order_by('price', 'asc');
		}
		elseif ($sort_type == 2) {
			$query = $this->db
			->order_by('price', 'desc');
		}
		elseif ($sort_type == 3) {
			$query = $this->db
			->order_by('year', 'asc')
			->order_by('season', 'desc');
		}
		elseif ($sort_type == 4) {
			$query = $this->db
			->order_by('year', 'desc')
			->order_by('season', 'asc');
		}
		else {
			$query = $this->db;
		}



		if ($where_array === FALSE) {
			$query = $query->where("isfirstsize", 1);
			$query = $query->from('goods');
			return $query->count_all_results();
		}
		else {
			if (@$where_array['size'] == null) {
				$query = $query->where("isfirstsize", 1);
			}

			$where = "1";
			foreach ($where_array as $key => $value) {
				$where .= " AND (0";
				foreach ($value as $key1 => $value1) {
					$where .= " OR ".$key." = '".$value1."'";
				}
				$where .= ")";
			}

			$query = $query->where($where);
			$query = $query->from('goods');
			return $query->count_all_results();
		}
	}

	public function getGoods($row_count, $offset, $sort_type, $where_array = FALSE) {
		if ($sort_type == 1) {
			$query = $this->db
			->order_by('price', 'asc');
		}
		elseif ($sort_type == 2) {
			$query = $this->db
			->order_by('price', 'desc');
		}
		elseif ($sort_type == 3) {
			$query = $this->db
			->order_by('year', 'asc')
			->order_by('season', 'desc');
		}
		elseif ($sort_type == 4) {
			$query = $this->db
			->order_by('year', 'desc')
			->order_by('season', 'asc');
		}
		else {
			$query = $this->db;
		}

		
		if ($where_array === FALSE) {
			$query = $query->where("isfirstsize", 1);
			$query = $query->get('goods', $row_count, $offset);
			return $query->result_array();
		}
		else {
			if (@$where_array['size'] == null) {
				$query = $query->where("isfirstsize", 1);
			}

			$where = "1";
			foreach ($where_array as $key => $value) {
				$where .= " AND (0";
				foreach ($value as $key1 => $value1) {
					$where .= " OR ".$key." = '".$value1."'";
				}
				$where .= ")";
			}

			$query = $query->where($where);
			$query = $query->get('goods', $row_count, $offset);
			return $query->result_array();
		}
	}

	public function getGood($articule) {
		$query = $this->db->get_where('goods', array('articule' => $articule));
		return $query->row_array();
	}
}