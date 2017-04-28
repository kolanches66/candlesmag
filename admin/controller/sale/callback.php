<?php
class ControllerSaleCallback extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/callback');

		$this->document->setTitle('Обратные звонки');

		$this->load->model('sale/callback');

		$this->getList();
	}
	
	protected function getList() {
		
		$url = '';

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => 'Обратные звонки',
			'href' => $this->url->link('sale/callback', 'token=' . $this->session->data['token'] . $url, true)
		);

		$data['callbacks'] = array();
		$data['callbacks'] = $this->model_sale_callback->getCallbacks();
		$callback_total = count($data['callbacks']);
		
		$data['delete'] = $this->url->link('sale/callback/delete', 'token=' . $this->session->data['token'] . $url, true);

		$data['heading_title'] = 'Обратные звонки';

		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_name'] = $this->language->get('column_name');
		$data['column_sort_order'] = $this->language->get('column_sort_order');
		$data['column_action'] = $this->language->get('column_action');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		/*$pagination = new Pagination();
		$pagination->total = $callback_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('sale/callback', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($callback_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($callback_total - $this->config->get('config_limit_admin'))) ? $callback_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $callback_total, ceil($callback_total / $this->config->get('config_limit_admin')));*/

		

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('sale/callback', $data));
	}

	public function delete() {
		$this->load->model('sale/callback');
		if (isset($this->request->post['selected'])) {
			foreach ($this->request->post['selected'] as $callback_id) {
				$this->model_sale_callback->deleteCallback($callback_id);
			}
			
			$url = '';
			$this->response->redirect($this->url->link('sale/callback', 'token=' . $this->session->data['token'] . $url, true));
		}
		$this->getList();
	}

}
