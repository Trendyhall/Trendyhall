<?php  

class Colour_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getIDByColourName($colourName) {
		$query = $this->db->select('id')->get_where('colours', array('runame' => $colourName));
		return $query->result_array();
	}

	public function getIDByCode($Code){
		$Value = $this->db->escape($Code);

		$query = $this->db->query("SELECT id FROM colours WHERE colourcode = ".$Value." LIMIT 1");
		$row = $query->row_array();
		if ($row) return $row['id'];
		else return FALSE;
	}

	public function getCodeByID($ID){
		$Value = $this->db->escape($ID);

		$query = $this->db->query("SELECT colourcode FROM colours WHERE id = ".$Value." LIMIT 1");
		$row = $query->row_array();
		if ($row) return $row['colourcode'];
		else return FALSE;
	}
}