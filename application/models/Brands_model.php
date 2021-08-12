<?php  

class Brands_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get_brands() {
		$query = $this->db->get('brands');
		return $query->result_array();
	}

	public function get_brand($slug) {
		$query = $this->db->get_where('brands', array('slug' => $slug));
		return $query->row_array();
	}


}