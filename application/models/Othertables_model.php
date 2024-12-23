<?php 

class Othertables_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get($TableName, $ID){
		$Value = $this->db->escape($ID);
		// $TableName1 = $this->db->escape($TableName);

		$query = $this->db->query("SELECT output FROM `$TableName` WHERE id = $Value LIMIT 1");
		$row = $query->row_array();
		if ($row) return $row['output'];
		else return FALSE;
	}

	public function find_or_insert_id($TableName, $Value){
		$Value = $this->db->escape($Value);

		$query = $this->db->query("SELECT id FROM $TableName WHERE input = $Value LIMIT 1");
		$row = $query->row();
		if ($row) return $row->id;
		else {
			$this->db->query("INSERT INTO $TableName (id, input) VALUES (null, $Value)");
			$query = $this->db->query("SELECT id FROM $TableName WHERE input = $Value LIMIT 1");
			$row = $query->row();
			return $row->id;
		}
	}

	public function get_sorting_table($TableName){
		$query = $this->db->query("SELECT * FROM $TableName WHERE 1");
		$result = $query->result_array();
		if ($result) return $result;
		else return FALSE;
	}

	public function get_sorting_keys($TableName, $ID){
		$Value = $this->db->escape($ID);

		$query = $this->db->query("SELECT keysarr FROM $TableName WHERE id = $Value LIMIT 1");
		$row = $query->row_array();
		if ($row) return explode(';', $row['keysarr']);
		else return FALSE;
	}

	public function get_sorting_name($TableName, $ID){
		$Value = $this->db->escape($ID);

		$query = $this->db->query("SELECT name FROM $TableName WHERE id = $Value LIMIT 1");
		$row = $query->row_array();
		if ($row) return $row['name'];
		else return FALSE;
	}

	public function new_feedback($email, $message){
		$this->load->helper('cookie');
		$uuid = get_cookie('uuid');
		if ($uuid != null) {
			$this->db->query("INSERT INTO `feedback`(`uuid`, `email`, `text`) VALUES (?, ?, ?)", array(
				$uuid,
				$email,
				$message
			));
		}
	}

	public function get_feedbacks(){
		$this->load->helper('cookie');
		$uuid = get_cookie('uuid');
		if ($uuid != null) {
			$query = $this->db->query("SELECT * FROM `feedback` WHERE uuid = ? ORDER BY id DESC", array($uuid));
			$result = $query->result_array();
			if ($result) return $result;
		}
	}

}