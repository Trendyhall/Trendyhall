<?php 

class Orders_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get_orders() {
		$conf = $this->config->item('order_statuses_visability');
		$where = "0";
		foreach ($conf as $key => $value) {
			if ($value) $where.= " OR status = $key";
		}


		$query = $this->db->query("SELECT id, phone, ordertime, deliverytype, status FROM orders WHERE $where");
		if ($query->result_array() != null) return $query->result_array();
		else return FALSE;
	}

	public function get_order_by_id($id) {
		$query = $this->db->query("SELECT * FROM orders WHERE id = '".$id."' OR phone = '".$id."' LIMIT 1");
		if ($query->row_array() != null) return $query->row_array();
		else return FALSE;
	}

	public function set_new_order($data) {
		$this->db->query("INSERT INTO `orders` (`id`, `passcode`, `name`, `phone`, `address`, `orderbody`, `comment`, `deliverytype`, `ordertime`) VALUES (NULL, ".$this->db->escape($data['passcode']).", ".$this->db->escape($data['name']).", ".$this->db->escape($data['phone']).", ".$this->db->escape($data['address']).", ".$this->db->escape($data['orderbody']).", ".$this->db->escape($data['comment']).", ".$this->db->escape($data['deliverytype']).", ".$this->db->escape($data['ordertime']).")");
		$query = $this->db->query("SELECT id FROM orders WHERE ordertime = ".$this->db->escape($data['ordertime']));
		return $query->row()->id;
	}

	public function set_order_status_by_id($id, $status) {
		$query = $this->db->query("UPDATE orders SET status = $status WHERE id = ".$this->db->escape($id));
	}

}