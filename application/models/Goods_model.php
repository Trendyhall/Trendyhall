<?php  

class Goods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function BuildGetGoodsQuery($sort_type, $where_array = FALSE){
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

		
		if ($where_array === FALSE) {
			return $query->where("firstsize", 0);
		}
		else {
			if (@$where_array['size'] == null) {
				$query = $query->where("firstsize", 0);
			}

			$where = "1";
			foreach ($where_array as $key => $value) {
				$where .= " AND (0";
				foreach ($value as $key1 => $value1) {
					$where .= " OR ".$key."= '".$value1."'";
				}
				$where .= ")";
			}

			return $query->where($where);
		}
	}

	public function getGoodsCount($sort_type, $where_array = FALSE)
	{
		$query = $this->BuildGetGoodsQuery($sort_type, $where_array);
		$query = $query->from('goods');
		return $query->count_all_results();
	}

	public function getGoods($row_count, $offset, $sort_type, $where_array = FALSE) {
		$query = $this->BuildGetGoodsQuery($sort_type, $where_array);
		$query = $query->get('goods', $row_count, $offset);
		return $query->result_array();
	}

	public function getGood($ID) {
		$query = $this->db->query("SELECT * FROM goods WHERE id = ".$ID." LIMIT 1");
		return $query->row_array();
	}

	public function getGoodByCodeColour($ModelCode, $Colour) {
		$query = $this->db->query("SELECT * FROM goods LIMIT 1");
		return $query->row_array();
	}

	public function InsertGood($goods) {
		$sql = "INSERT INTO goods (id, articule, modelcode, colour, size, firstsize, gender, brand, itemgroup, name, consist, provider, manufacturer, contry, imagecount, price, sale, count, adddate, season, description) VALUES (null";
		foreach ($goods as $key => $value) {
			if ($key == 0) $sql.$this->db->escape($value);
			else $sql = $sql.", ".$this->db->escape($value);
		}
		$sql = $sql.")";
		$this->db->query($sql);
	}

	public function Special1() {
		$sql = "SELECT id, articule FROM goods";
		$goods = $this->db->query($sql)->result_array();

		
		/*foreach ($goods as $key => $value) {
			$sql = "UPDATE goods SET modelcode = ".$this->db->escape(explode('*', $value['articule'])[0])." WHERE id = ".$this->db->escape($value['id']);
			$this->db->query($sql);
		}*/
	}
}