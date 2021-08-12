<?php  

class Goods_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}


	



	public function get_goods_count()
	{
		$query = $this->db->from('goods');
		return $query->count_all_results();
	}

	public function get_goods($row_count, $offset) {
		$query = $this->db->get('goods', $row_count, $offset);
		return $query->result_array();
	}




	public function get_good($ID) {
		$query = $this->db->query("SELECT * FROM goods WHERE id = $ID LIMIT 1");
		return $query->row_array();
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