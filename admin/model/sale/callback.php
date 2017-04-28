<?php
class ModelSaleCallback extends Model {
	
	public function getCallbacks() {
		$sql ="SELECT * FROM " . DB_PREFIX . "callback ORDER BY customer_name";
		$query = $this->db->query($sql);
		return $query->rows;
	}
	
	public function deleteCallback($callback_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "callback WHERE " . 
						 "callback_id = '" . (int)$callback_id . "'");
	}
	
}
