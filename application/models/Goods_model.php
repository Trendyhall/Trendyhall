<?php  

class Goods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}


	public function BuildGetGoodsQuery($sort_type, $IDs_array){
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

		$where = 'firstsize = 0 AND count != 255 AND (0';
		foreach ($IDs_array as $key => $value) {
			$where .= " OR id = '$value'";
		}
		$where .= ')';
		return $query->where($where);
	}

	public function getGoodsCountById($sort_type, $IDs_array)
	{
		$query = $this->BuildGetGoodsQuery($sort_type, $IDs_array);
		$query = $query->from('goods');
		return $query->count_all_results();
	}

	public function getGoodsByID($row_count, $offset, $sort_type, $IDs_array) {
		$query = $this->BuildGetGoodsQuery($sort_type, $IDs_array);
		$query = $query->get('goods', $row_count, $offset);
		return $query->result_array();
	}

	public function getGoodsByOnlyID($IDs_array) {
		$where = '0';
		foreach ($IDs_array as $key => $value) {
			$where .= " OR id = '$value'";
		}
		$query = $this->db->get_where('goods', $where);
		return $query->result_array();
	}

	public function getGoodsID($where_array = FALSE) {
		$query = $this->db->select('id, firstsize');

		if ($where_array !== FALSE) {
			if (@$where_array['size'] == null) {
				$query = $query->where("firstsize", 0);
			}

			$where = "count != 255";
			foreach ($where_array as $key => $value) {
				$where .= " AND (0";
				foreach ($value as $key1 => $value1) {
					$where .= " OR $key= '$value1'";
				}
				$where .= ")";
			}

			$query = $query->where($where);
		}
		$query = $query->get('goods')->result_array();
		$result_array = array();
		foreach ($query as $key => $value) {
			if ($value['firstsize'] == 0) $result_array[] = $value['id'];
			else $result_array[] = $value['firstsize'];
		}
		return $result_array;
	}

	public function getGood($ID) {
		$query = $this->db->query("SELECT * FROM goods WHERE id = $ID LIMIT 1");
		return $query->row_array();
	}

	public function getGoodByCodeColour($ModelCode, $Colour) {
		$query = $this->db->query("SELECT * FROM goods WHERE modelcode = '$ModelCode' AND colour = '$Colour' AND firstsize = 0 LIMIT 1");
		return $query->row_array();
	}



	
	public function getGoodWithSameItemgroup($itemgroup) {
		$query = $this->db->query("SELECT * FROM goods WHERE firstsize = 0 AND count != 255 AND itemgroup = $itemgroup ORDER BY RAND() LIMIT 5");
		return $query->result_array();
	}

	public function getAllSizesByCodeColour($ModelCode, $Colour) {
		$query = $this->db->query("SELECT id, size, count FROM goods WHERE modelcode = '$ModelCode' AND colour = '$Colour'  ORDER BY size");
		$result_array = $query->result_array();
		foreach ($result_array as $key => $value) {
			$query1 = $this->db->query("SELECT size FROM sizes WHERE id = '".$value['size']."' LIMIT 1");
			$result_array[$key]['size'] = $query1->row_array()['size'];
		}
		return $result_array;
	}

	public function getAllColoursByCode($ModelCode) {
		$query = $this->db->query("SELECT id, modelcode, colour FROM goods WHERE modelcode = '$ModelCode' AND firstsize = 0 AND count != 255");
		$result_array = $query->result_array();
		foreach ($result_array as $key => $value) {
			$query1 = $this->db->query("SELECT colourcode FROM colours WHERE id = '".$value['colour']."' LIMIT 1");
			$result_array[$key]['colour'] = $query1->row_array()['colourcode'];
		}
		return $result_array;
	}

	public function getFirstsizeIDByID($ID) {
		$query = $this->db->query("SELECT firstsize FROM goods WHERE id = '$ID' LIMIT 1");
		$result_array = $query->row_array();
		if ($result_array['firstsize'] == 0) return $ID;
		else return $result_array['firstsize'];
	}


	public function updateGoodCountByID($ID, $value) {
		$this->db->query("UPDATE goods SET count = count + $value WHERE id = '$ID'");
	}









	/*Special and for 1C*/

	public function Special1() {
		$sql = "SELECT id, articule FROM goods";
		$goods = $this->db->query($sql)->result_array();

		
		/*foreach ($goods as $key => $value) {
			$sql = "UPDATE goods SET modelcode = $this->db->escape(explode('*', $value['articule'])[0]) WHERE id = $this->db->escape($value['id']);
			$this->db->query($sql);
		}*/
	}

	public function InsertGood($goods) {
		$sql = "INSERT INTO goods (id, articule, modelcode, colour, size, firstsize, gender, brand, itemgroup, name, consist, provider, manufacturer, country, imagecount, price, sale, count, season, description) VALUES (";
		foreach ($goods as $key => $value) {
			if ($key == 0) $sql = $sql.$this->db->escape($value);
			else $sql = $sql.", ".$this->db->escape($value);
		}
		$sql = $sql.")";
		$this->db->query($sql);
	}
}