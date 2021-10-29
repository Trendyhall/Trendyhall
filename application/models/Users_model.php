<?php 

class Users_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function get_uuid_by_phone_password($phone, $password) {
		$query = $this->db->query("SELECT uuid FROM users WHERE phone = '$phone' AND password = '$password' LIMIT 1");
		if ($query->row() != null) return $query->row()->uuid;
		else return FALSE;
	}

	public function get_exsist_by_phone($phone) {
		$query = $this->db->query("SELECT id FROM users WHERE phone = '$phone' LIMIT 1");
		return $query->row() != null;
	}

	public function get_user_name_by_uuid($uuid) {
		$query = $this->db->query("SELECT name FROM users WHERE uuid = '$uuid' LIMIT 1");
		if ($query->row() != null) return $query->row()->name;
		else return FALSE;
	}

	public function get_user_by_uuid($uuid) {
		$query = $this->db->query("SELECT * FROM users WHERE uuid = '$uuid' LIMIT 1");
		if ($query->row() != null) return $query->row_array();
		else return FALSE;
	}

	public function set_new_user($data) {
		$this->db->query("INSERT INTO `users` (`id`, `uuid`, `phone`, `password`, `name`, `secondname`, `patronymic`, `cart`, `likes`) VALUES (NULL, ".$this->db->escape($data['uuid']).", ".$this->db->escape($data['phone']).", ".$this->db->escape($data['password']).", ".$this->db->escape($data['name']).", ".$this->db->escape($data['secondname']).", ".$this->db->escape($data['patronymic']).", ".$this->db->escape($data['cart']).", ".$this->db->escape($data['like']).")");
	}

	public function set_user_cart_by_uuid($uuid, $data) {
		$this->db->query("UPDATE users SET cart = '$data' WHERE uuid = '$uuid'");
	}

	public function set_user_like_by_uuid($uuid, $data) {
		$this->db->query("UPDATE users SET likes = '$data' WHERE uuid = '$uuid'");
	}

}