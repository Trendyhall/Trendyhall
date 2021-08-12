<?php 

class Othertables_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function GetByID($TableName, $ColumnName, $ID){
		$Value = $this->db->escape($ID);

		$query = $this->db->query("SELECT $ColumnName FROM $TableName WHERE id = $Value LIMIT 1");
		$row = $query->row_array();
		if ($row) return $row[$ColumnName];
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


}