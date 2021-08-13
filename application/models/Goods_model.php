<?php  

class Goods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function build_get_goods_where($where_array){
		$where = "firstsize = 0 AND firstsize != NULL";
		foreach ($where_array as $key => $value) {
			$where .= " AND (0";
				foreach ($value as $key1 => $value1) {
					$where .= " OR $key= '$value1'";
				}
				$where .= ")";
		}
		$where .= ")";
		return $where;
	}
	
	public function make_sort($sort_type = FALSE){
		if ($sort_type === FALSE) return $this->db;
		if ($sort_type == 1) {
			$query = $this->db
			->order_by('price', 'asc');
		}
		elseif ($sort_type == 2) {
			$query = $this->db
			->order_by('price', 'desc');
		}
		elseif ($sort_type == 3 | $sort_type == 0) {
			$query = $this->db
			->order_by('season', 'desc');
		}
		elseif ($sort_type == 4) {
			$query = $this->db
			->order_by('season', 'asc');
		}
		else {
			$query = $this->db;
		}

		return $query;
	}



	public function get_goods_count($where_sql)
	{
		$query = make_sort();
		$query = $query->from('goods');
		return $query->count_all_results();
	}

	public function get_goods($row_count, $offset, $sort_type, $where_sql) {
		$query = make_sort($sort_type);
	 	$query = $query->where($where_sql)
		$query = $query->get('goods', $row_count, $offset);
		return $query->result_array();
	}


	public function get_good($ID) {
		$query = $this->db->query("SELECT * FROM goods WHERE id = $ID LIMIT 1");
		return $query->row_array();
	}


	public function get_similar_good($itemgroup) {
		$query = $this->db->query("SELECT * FROM goods WHERE firstsize = 0 AND firstsize != NULL AND itemgroup = $itemgroup ORDER BY RAND() LIMIT 5");
		return $query->result_array();
	}



	public function update_good_count($ID, $value) {
		$this->db->query("UPDATE goods SET count = count + $value WHERE id = '$ID'");
	}



	public function insert_goods($goods) {
		$sql = "INSERT INTO goods (id, articule, modelcode, colour, size, firstsize, gender, brand, itemgroup, name, consist, provider, manufacturer, country, imagecount, price, sale, count, season, description) VALUES (";
		foreach ($goods as $key => $value) {
			if ($key == 0) $sql = $sql.$this->db->escape($value);
			else $sql = $sql.", ".$this->db->escape($value);
		}
		$sql = $sql.")";
		$this->db->query($sql);
	}
}