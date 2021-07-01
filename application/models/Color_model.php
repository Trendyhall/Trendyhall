<?php  

class Color_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getIDByColourName($colourName) {
		$query = $this->db->select('id')->get_where('colours', array('runame' => $colourName));
		return $query->result_array();
	}
}