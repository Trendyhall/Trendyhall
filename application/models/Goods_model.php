<?php  

class Goods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function build_get_goods_where($where_array){
		$where = "firstsize = 0 AND firstsize IS NOT NULL";
		foreach ($where_array as $key => $value) {
			$where .= " AND (0";
				foreach ($value as $key1 => $value1) {
					$where .= " OR $key= '$value1'";
				}
				$where .= ")";
		}
		return $where;
	}
	
	public function make_sort($sort_type = FALSE){
		switch ($sort_type) {
			case 0:
				$query = $this->db->order_by('season', 'desc');
				break;
			case 1:
				$query = $this->db->order_by('price', 'asc');
				break;
			case 2:
				$query = $this->db->order_by('price', 'desc');
				break;
			case 3:
				$query = $this->db->order_by('season', 'desc');
				break;
			case 4:
				$query = $this->db->order_by('season', 'asc');
				break;
			default:
				$query = $this->db;
				break;
		}
		return $query;
	}



	public function get_goods_count($where_sql)
	{
		$query = $this->make_sort();
		$query = $query->where($where_sql);
		$query = $query->from('goods');
		return $query->count_all_results();
	}

	public function get_goods($row_count, $offset, $sort_type, $where_sql) {
		$query = $this->make_sort($sort_type);
	 	$query = $query->where($where_sql);
		$query = $query->get('goods', $row_count, $offset);
		return $query->result_array();
	}


	//==================================================

	public function get_goods_by_ids($ids) {
		$query = $this->make_sort();
		$where_sql = '0';
		foreach ($ids as $key => $value) {
			$where_sql .= " OR id = '$value'";
		}
	 	$query = $query->where($where_sql);
		$query = $query->get('goods');
		return $query->result_array();
	}

	public function get_good($ID) {
		$query = $this->db->query("SELECT * FROM goods WHERE id = $ID LIMIT 1");
		return $query->row_array();
	}

	public function get_all_sizes($modelcode, $colour) {
		$query = $this->db->query("SELECT id, size, count FROM goods WHERE modelcode = '$modelcode' AND colour = '$colour' ORDER BY size");
		$result_array = $query->result_array();
		foreach ($result_array as $key => $value) {
			$query1 = $this->db->query("SELECT output FROM sizes WHERE id = '".$value['size']."' LIMIT 1");
			$result_array[$key]['size'] = $query1->row_array()['output'];
		}
		return $result_array;
	}

	public function get_all_colors($modelcode) {
		$query = $this->db->query("SELECT id, modelcode, colour, imagecount FROM goods WHERE modelcode = '$modelcode' AND firstsize = 0 AND firstsize IS NOT NULL");
		$result_array = $query->result_array();
		foreach ($result_array as $key => $value) {
			$query1 = $this->db->query("SELECT output FROM colours WHERE id = '".$value['colour']."' LIMIT 1");
			$result_array[$key]['colour'] = $query1->row_array()['output'];
		}
		return $result_array;
	}

	public function get_similar_good($itemgroup) {
		$query = $this->db->query("SELECT * FROM goods WHERE firstsize = 0 AND firstsize IS NOT NULL AND itemgroup = $itemgroup ORDER BY RAND() LIMIT 5");
		return $query->result_array();
	}

	//=================================================

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