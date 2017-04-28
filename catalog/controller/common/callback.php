<?php

class ControllerCommonCallback extends Controller {
	
	public function add() {
		$json = array();
		
		$data = array();
		if (isset($this->request->post['c_name'])) {
			$data['customer_name'] = $this->request->post['c_name'];
		}
		if (isset($this->request->post['c_phone'])) {
			$data['customer_phone'] = $this->request->post['c_phone'];
		}
		
		$this->load->model('account/callback');
		$this->model_account_callback->addCallback($data);
		//$json['success'] = $data;
		
		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
}