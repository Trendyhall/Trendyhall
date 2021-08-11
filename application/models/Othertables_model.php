<?php 

class Othertables_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function FindID($TableName, $ColumnName, $Value){
		$Value = $this->db->escape($Value);

		$query = $this->db->query("SELECT id FROM $TableName WHERE $ColumnName = $Value LIMIT 1");
		$row = $query->row();
		if ($row) return $row->id;
		else {
			$this->db->query("INSERT INTO $TableName (id, $ColumnName) VALUES (null, $Value)");
			$query = $this->db->query("SELECT id FROM $TableName WHERE $ColumnName = $Value LIMIT 1");
			$row = $query->row();
			return $row->id;
		}
	}

	public function GetByID($TableName, $ColumnName, $ID){
		$Value = $this->db->escape($ID);

		$query = $this->db->query("SELECT $ColumnName FROM $TableName WHERE id = $Value LIMIT 1");
		$row = $query->row_array();
		if ($row) return $row[$ColumnName];
		else return FALSE;
	}

	public function GetTable($TableName){
		$query = $this->db->query("SELECT * FROM $TableName WHERE 1");
		return $query->result_array();
	}

	public function GetTableWhere($TableName, $ColumnName, $Value){

	}

	public function GetUniqueColumn($TableName, $ColumnName) {
		$query = $this->db->query("SELECT DISTINCT $ColumnName FROM $TableName WHERE 1");
		return $query->result_array();
	}

	public function FindORInsertID($TableName, $Value){
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