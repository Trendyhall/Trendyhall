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

	public function GetOrderByID($id) {
		$query = $this->db->query("SELECT * FROM orders WHERE id = '".$id."' LIMIT 1");
		if ($query->row_array() != null) return $query->row_array();
		else return FALSE;
	}

	public function SetNewOrder($data) {
		$this->db->query("INSERT INTO `orders` (`id`, `passcode`, `name`, `phone`, `address`, `orderbody`, `comment`, `deliverytype`, `ordertime`) VALUES (NULL, ".$this->db->escape($data['passcode']).", ".$this->db->escape($data['name']).", ".$this->db->escape($data['phone']).", ".$this->db->escape($data['address']).", ".$this->db->escape($data['orderbody']).", ".$this->db->escape($data['comment']).", ".$this->db->escape($data['deliverytype']).", ".$this->db->escape($data['ordertime']).")");
		$query = $this->db->query("SELECT id FROM orders WHERE ordertime = ".$this->db->escape($data['ordertime']));
		return $query->row()->id;
	}

	public function DeleteOrderByID($id) {
		$query = $this->db->query("DELETE FROM orders WHERE id = ".$this->db->escape($id));
	}

}