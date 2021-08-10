<?php 

class Users_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function GetUUIDByPhonePassword($phone, $password) {
		$query = $this->db->query("SELECT uuid FROM users WHERE phone = '$phone' AND password = '$password' LIMIT 1");
		if ($query->row() != null) return $query->row()->uuid;
		else return FALSE;
	}

	public function GetExsistByPhone($phone) {
		$query = $this->db->query("SELECT id FROM users WHERE phone = '$phone' LIMIT 1");
		return $query->row() != null;
	}

	public function GetUserNameByUUID($uuid) {
		$query = $this->db->query("SELECT name FROM users WHERE uuid = '$uuid' LIMIT 1");
		if ($query->row() != null) return $query->row()->name;
		else return FALSE;
	}

	public function SetNewUser($data) {
		$this->db->query("INSERT INTO `users` (`id`, `uuid`, `phone`, `password`, `name`, `secondname`, `patronymic`, `cart`, `like`) VALUES (NULL, ".$this->db->escape($data['uuid']).", ".$this->db->escape($data['phone']).", ".$this->db->escape($data['password']).", ".$this->db->escape($data['name']).", ".$this->db->escape($data['secondname']).", ".$this->db->escape($data['patronymic']).", NULL, NULL)");
	}

}