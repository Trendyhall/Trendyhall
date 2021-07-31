<?php 

class Orders_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function GetOrdersList() {
		$query = $this->db->query("SELECT id, ordertime, deliverytype FROM orders WHERE 1");
		if ($query->result_array() != null) return $query->result_array();
		else return FALSE;
	}

	public function SetNewOrder($data) {
		$query = $this->db->query("INSERT INTO `orders` (`id`, `passcode`, `orderbody`, `comment`, `deliverytype`, `data`, `ordertime`) VALUES (NULL, ".$this->db->escape($data['passcode']).", ".$this->db->escape($data['orderbody']).", ".$this->db->escape($data['comment']).", ".$this->db->escape($data['deliverytype']).", ".$this->db->escape($data['data']).", ".$this->db->escape($data['ordertime']).")");
	}

}