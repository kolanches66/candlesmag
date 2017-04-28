<?php

class ModelAccountCallback extends Model {
	
	public function addCallback($data) {
		$this->db->query(
				"INSERT INTO " . DB_PREFIX . "callback SET " . 
				"customer_name = '"  .  $this->db->escape($data['customer_name'])  .  "', " .
				"customer_phone = '"  .  $this->db->escape($data['customer_phone'])  .  "', " .
				"date_added = NOW()");
	}
	
}