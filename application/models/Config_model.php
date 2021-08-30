<?php  

class Config_model extends CI_Model {
	public function __construct() {
		$this->load->database();
		$this->init();
	}

	public function init() {
		$query = $this->db->get('config')->result_array();
		$conf = $this->config->item('changeble_items');
		foreach ($query as $key => $value) {
			if (array_key_exists($value['name'], $conf)){
				$conf[$value['name']] = $key;
			}
		}
		foreach ($conf as $key => $value) {

			if ($value) {
				$this->config->set_item($key, json_decode($query[$value]['value']));
			}
			else {
				$v = json_encode($this->config->item($key));
				$this->db->query("INSERT INTO config (name, value) VALUES ('$key', '$v')");
			}
		}

	}

	public function update() {
		$conf = $this->config->item('changeble_items');
		foreach ($conf as $key => $value) {
			$value = $this->config->item($key);
			$this->set_item($key, $this->config->item($key));
		}
	}

	public function item($name) {
		$query = $this->db->get_where('config', array('name' => $name));
		return json_decode($query->row_array());
	}

	public function set_item($name, $value) {
		$value = json_encode($value);
		$this->db->query("UPDATE config SET value = '$value' WHERE name = '$name'");
	}

}