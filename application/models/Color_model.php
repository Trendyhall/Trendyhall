<?php  

class Color_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function getColorCodes($colorName) {
		
		$query = $this->db->select('colorcode')->get_where('colors', array('runame' => $colorName));
		return $query->result_array();
	}
}