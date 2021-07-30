<?php 

class Users_model extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function GetUUIDByPhonePassword($phone, $password) {
		$query = $this->db->query("SELECT uuid FROM users WHERE phone = '".$phone."' AND password = '".$password."' LIMIT 1");
		if ($query->row() != null) return $query->row()->uuid;
		else return FALSE;
	}

	public function GetUserNameByUUID($uuid) {
		$query = $this->db->query("SELECT name FROM users WHERE uuid = '".$uuid."' LIMIT 1");
		if ($query->row() != null) return $query->row()->name;
		else return FALSE;
	}

}