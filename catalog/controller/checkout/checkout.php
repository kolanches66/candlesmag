<?php
class ControllerCheckoutCheckout extends Controller {
	
	private $error = array();
	
	public function index() 
	{	
		$this->load->model('account/customer');
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && ($this->validate())) 
		{
			$this->checkout();
			$this->response->redirect($this->url->link('checkout/success', '', true));
		}
		
		$data['cart_link'] = $this->url->link('checkout/cart', '', true);
		
		// выводим ошибки, если данные введены неверно
		{ 
			if (isset($this->error['warning'])) {
				$data['error_warning'] = $this->error['warning'];
			} else {
				$data['error_warning'] = '';
			}

			if (isset($this->error['firstname'])) {
				$data['error_firstname'] = $this->error['firstname'];
			} else {
				$data['error_firstname'] = '';
			}

			if (isset($this->error['lastname'])) {
				$data['error_lastname'] = $this->error['lastname'];
			} else {
				$data['error_lastname'] = '';
			}

			if (isset($this->error['email'])) {
				$data['error_email'] = $this->error['email'];
			} else {
				$data['error_email'] = '';
			}

			if (isset($this->error['telephone'])) {
				$data['error_telephone'] = $this->error['telephone'];
			} else {
				$data['error_telephone'] = '';
			}

			if (isset($this->error['address_1'])) {
				$data['error_address_1'] = $this->error['address_1'];
			} else {
				$data['error_address_1'] = '';
			}

			if (isset($this->error['city'])) {
				$data['error_city'] = $this->error['city'];
			} else {
				$data['error_city'] = '';
			}

			if (isset($this->error['postcode'])) {
				$data['error_postcode'] = $this->error['postcode'];
			} else {
				$data['error_postcode'] = '';
			}

			if (isset($this->error['country'])) {
				$data['error_country'] = $this->error['country'];
			} else {
				$data['error_country'] = '';
			}

			if (isset($this->error['zone'])) {
				$data['error_zone'] = $this->error['zone'];
			} else {
				$data['error_zone'] = '';
			}
			
			// СПОСОБЫ ДОСТАВКИ
			
			/*if (isset($this->session->data['shipping_methods'])) {
				$data['shipping_methods'] = $this->session->data['shipping_methods'];
			} else {
				$data['shipping_methods'] = array();
			}
			
			if (isset($this->session->data['shipping_method']['code'])) {
				$data['code'] = $this->session->data['shipping_method']['code'];
			} else {
				$data['code'] = '';
			}
			
			if (isset($this->session->data['payment_methods'])) {
				$data['payment_methods'] = $this->session->data['payment_methods'];
			} else {
				$data['payment_methods'] = array();
			}*/
			
			/*if (empty($this->session->data['shipping_methods'])) {
				$data['error_warning'] = sprintf($this->language->get('error_no_shipping'), $this->url->link('information/contact'));
			} else {
				$data['error_warning'] = '';
			}			

			
			
			if (empty($this->session->data['payment_methods'])) {
				$data['error_warning'] = sprintf($this->language->get('error_no_payment'), $this->url->link('information/contact'));
			} else {
				$data['error_warning'] = '';
			}

			if (isset($this->session->data['payment_methods'])) {
				$data['payment_methods'] = $this->session->data['payment_methods'];
			} else {
				$data['payment_methods'] = array();
			}

			if (isset($this->session->data['payment_method']['code'])) {
				$data['code'] = $this->session->data['payment_method']['code'];
			} else {
				$data['code'] = '';
			}

			if ($this->config->get('config_checkout_id')) {
				$this->load->model('catalog/information');

				$information_info = $this->model_catalog_information->getInformation($this->config->get('config_checkout_id'));

				if ($information_info) {
					$data['text_agree'] = sprintf($this->language->get('text_agree'), $this->url->link('information/information/agree', 'information_id=' . $this->config->get('config_checkout_id'), true), $information_info['title'], $information_info['title']);
				} else {
					$data['text_agree'] = '';
				}
			} else {
				$data['text_agree'] = '';
			}

			if (isset($this->session->data['agree'])) {
				$data['agree'] = $this->session->data['agree'];
			} else {
				$data['agree'] = '';
			}*/
			
		}

		$data['action'] = $this->url->link('checkout/checkout', '', true);
	
		// загружаем список всех стран
		$this->load->model('localisation/country');
		$data['countries'] = $this->model_localisation_country->getCountries();
		
		// Если мы уже вводили данные,
		// то достаём их из сессии
		{
			//		
			// ЛИЧНЫЕ ДАННЫЕ
			//
			// Имя
			if (isset($this->session->data['guest']['firstname'])) {
				$data['firstname'] = $this->session->data['guest']['firstname'];
			} else {
				//$data['firstname'] = '';
				if ($this->customer->isLogged()) {
					$data['firstname'] = $this->customer->getFirstName();
				} else {
					$data['firstname'] = '';
				}
			}
			//
			// Фамилия
			if (isset($this->session->data['guest']['lastname'])) {
				$data['lastname'] = $this->session->data['guest']['lastname'];
			} else {
				//$data['lastname'] = '';
				if ($this->customer->isLogged()) {
					$data['lastname'] = $this->customer->getLastName();
				} else {
					$data['lastname'] = '';
				}
			}
			//
			// Email
			if (isset($this->session->data['guest']['email'])) {
				$data['email'] = $this->session->data['guest']['email'];
			} else {
				// если мы зарегистрированы, то вытаскиваем
				// инфу из аккаунта
				if ($this->customer->isLogged()) {
					$data['email'] = $this->customer->getEmail();
				} else {
					$data['email'] = '';
				}
			}
			//
			// Телефон
			if (isset($this->session->data['guest']['telephone'])) {
				$data['telephone'] = $this->session->data['guest']['telephone'];
			} else {
				//$data['telephone'] = '';
				if ($this->customer->isLogged()) {
					$data['telephone'] = $this->customer->getTelephone();
				} else {
					$data['telephone'] = '';
				}
			}
			
			//$this->session->data['shipping_address']['country_id'] = 176;
			//$this->session->data['shipping_address']['zone_id'] = 2807;
			
			//
			// ДОСТАВКА
			// Способ
			if (isset($this->session->data['shipping_address']['method']['value'])) {
				$data['shipping_method'] = $this->session->data['shipping_address']['method']['value'];
			}
			else {
				$data['shipping_method'] = '';
			}
			// 
			// Страна
			if (isset($this->session->data['shipping_address']['country_id'])) {
				$data['country_id'] = $this->session->data['shipping_address']['country_id'];
			} else {
				$data['country_id'] = $this->config->get('config_country_id');
			}
			// Область
			if (isset($this->session->data['shipping_address']['zone_id'])) {
				$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
			} else {
				$data['zone_id'] = $this->config->get('config_zone_id');
				//$data['zone_id'] = '';
			}
			// Город
			if (isset($this->session->data['shipping_address']['city'])) {
				$data['city'] = $this->session->data['shipping_address']['city'];
			} else {
				$data['city'] = '';
			}
			// Адрес
			if (isset($this->session->data['shipping_address']['address_1'])) {
				$data['address_1'] = $this->session->data['shipping_address']['address_1'];
			} else {
				$data['address_1'] = '';
			}
			// Индекс
			if (isset($this->session->data['shipping_address']['postcode'])) {
				$data['postcode'] = $this->session->data['shipping_address']['postcode'];
			} else {
				$data['postcode'] = '';
			}
		}
		
		$data['shipping_methods'] = $this->shipping_methods();
		
		//$this->session->data['shipping_methods'] = $this->shipping_methods();
		//$this->session->data['payment_methods'] = $this->payment_methods();
		
		// основные параметры страницы
		// title и meta-теги для поисковиков
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));
		
		// загружаем данные для header'а и для footer'а
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');	
		$data['header'] = $this->load->controller('common/header');
		
		//var_dump($data['shipping_methods']);
		
		// отображение .tlp
		$this->response->setOutput($this->load->view('checkout/checkout', $data));
	}
	
	// изменение списка регионов в зависимости от страны
	public function country() {
		$json = array();

		$this->load->model('localisation/country');
		$country_info = $this->model_localisation_country->getCountry($this->request->get['country_id']);
		
		// если страна выбрана
		if ($country_info) 
		{
			$this->load->model('localisation/zone');

			$json = array(
				'country_id'        => $country_info['country_id'],
				'name'              => $country_info['name'],
				'iso_code_2'        => $country_info['iso_code_2'],
				'iso_code_3'        => $country_info['iso_code_3'],
				'address_format'    => $country_info['address_format'],
				'postcode_required' => $country_info['postcode_required'],
				'zone'              => $this->model_localisation_zone->getZonesByCountryId($this->request->get['country_id']),
				'status'            => $country_info['status']
			);
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
	
	public function getTotals()
	{
		// Totals
		$this->load->model('extension/extension');

		$totals = array();
		$taxes = $this->cart->getTaxes();
		$total = 0;
			
		// Because __call can not keep var references so we put them into an array. 			
		$total_data = array(
			'totals' => &$totals,
			'taxes'  => &$taxes,
			'total'  => &$total
		);
			
		// Display totals
		if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) 
		{
			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');
			
			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('extension/total/' . $result['code']);
						
					// We have to put the totals in an array so that they pass by reference.
					$this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
				}
			}

			$sort_order = array();

			// делаем нормальный ассоциативный массив
			foreach ($totals as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $totals);
		}
		
		return $totals;
	}
	
	private function validate() 
	{
		
		// ЛИЧНЫЕ ДАННЫЕ
		// email
		if ((utf8_strlen($this->request->post['email']) > 96) || !preg_match($this->config->get('config_mail_regexp'), $this->request->post['email'])) {
			$this->error['email'] = $this->language->get('error_email');
		}
		if (!$this->customer->isLogged() && $this->model_account_customer->getTotalCustomersByEmail($this->request->post['email'])) {
			$this->error['warning'] = $this->language->get('error_exists');
		}
		// имя
		if ((utf8_strlen(trim($this->request->post['firstname'])) < 1) || (utf8_strlen(trim($this->request->post['firstname'])) > 32)) {
			$this->error['firstname'] = $this->language->get('error_firstname');
		}
		// фамилия
		if ((utf8_strlen(trim($this->request->post['lastname'])) < 1) || (utf8_strlen(trim($this->request->post['lastname'])) > 32)) {
			$this->error['lastname'] = $this->language->get('error_lastname');
		}
		// телефон
		if ((utf8_strlen($this->request->post['telephone']) < 3) || (utf8_strlen($this->request->post['telephone']) > 32)) {
			$this->error['telephone'] = $this->language->get('error_telephone');
		}
		
		// ДОСТАВКА
		// способ доставки
		// если метод не из списка
		$shipping_methods = array('courier', 'mail', 'self-pickup');
		$shipping_method = $this->request->post['shipping_method'];
		
		if (!in_array($shipping_method, $shipping_methods)) {
			$this->error['shipping_method'] = 'Выберите метод из списка';
		}
		else {
			// курьер или почта
			if ($shipping_method == 'mail' || $shipping_method == 'courier') {
				$this->load->model('localisation/country');
					$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
				if ($shipping_method == 'mail') {
					// если страна не выбрана
					if ($this->request->post['country_id'] == '') {
						$this->error['country'] = $this->language->get('error_country');
					}
					// если select "zone_id":
					// 1. не существует.   2. в нём ничего не выбрано.   3. в нём не число
					if (!isset($this->request->post['zone_id']) || $this->request->post['zone_id'] == '' || !is_numeric($this->request->post['zone_id'])) {
						$this->error['zone'] = $this->language->get('error_zone');
					}
				}
				// адрес
				if ($this->request->post['shipping_'.$shipping_method.'_address'] == '') {
					$this->error['address'] = 'Укажите адрес для доставки';
				}	
				// индекс
				// если индекс необходим, и если он не соответствует длине
				if ($country_info && $country_info['postcode_required'] && (utf8_strlen(trim($this->request->post['shipping_'.$shipping_method.'_postcode'])) < 2 || utf8_strlen(trim($this->request->post['shipping_'.$shipping_method.'_postcode'])) > 10)) {
					$this->error['postcode'] = $this->language->get('error_postcode');
				}
				// переписываем из полей в сессию
				$this->session->data['shipping_address']['address_1'] = 
				  $this->request->post['shipping_'.$shipping_method.'_address'];
				$this->session->data['shipping_address']['postcode'] = 
				  $this->request->post['shipping_'.$shipping_method.'_postcode'];
			}
		}

		// переписываем из полей в сессию
		// личные данные
		$this->session->data['guest']['email'] = $this->request->post['email'];
		$this->session->data['guest']['firstname'] = $this->request->post['firstname'];
		$this->session->data['guest']['lastname'] = $this->request->post['lastname'];
		$this->session->data['guest']['telephone'] = $this->request->post['telephone'];
		
		// доставка
		$this->session->data['shipping_address']['method']['value'] = $this->request->post['shipping_method'];
		$s_methods = $this->shipping_methods();
		foreach ($s_methods as $s_method) {
			if ($s_method['value'] == $shipping_method) { 
				$this->session->data['shipping_address']['method']['name'] = $s_method['name'];
			}
		}
		
		$this->session->data['shipping_address']['firstname'] = $this->request->post['firstname'];
		$this->session->data['shipping_address']['lastname'] = $this->request->post['lastname'];
		$this->session->data['shipping_address']['city'] = $this->request->post['city'];
		$this->session->data['shipping_address']['country_id'] = $this->request->post['country_id'];
		$this->session->data['shipping_address']['zone_id'] = $this->request->post['zone_id'];
		
		// подгружаем название страны и региона
		// (до этого у нас были только их id)
		// страна
		$this->load->model('localisation/country');
		$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);
		if ($country_info) {
			$this->session->data['shipping_address']['country'] = $country_info['name'];
		} else {
			$this->session->data['shipping_address']['country'] = '';
		}
		
		// регион
		$this->load->model('localisation/zone');
		$zone_info = $this->model_localisation_zone->getZone($this->session->data['shipping_address']['zone_id']);
		if ($zone_info) {
			$this->session->data['shipping_address']['zone'] = $zone_info['name'];
		} else {
			$this->session->data['shipping_address']['zone'] = '';
		}
		
		//var_dump($this->session->data['guest']);

		return !$this->error;
	}
	
	private function checkout()
	{
		$order_data = array();
		// личные данные покупателя
		if ($this->customer->isLogged()) {
			$order_data['customer_id'] = $this->customer->getId();
		} else {
			$order_data['customer_id'] = 0;
		}
		$order_data['firstname'] = $this->session->data['guest']['firstname'];
		$order_data['lastname'] = $this->session->data['guest']['lastname'];
		$order_data['email'] = $this->session->data['guest']['email'];
		$order_data['telephone'] = $this->session->data['guest']['telephone'];

		// информация о доставке
		//$order_data['shipping_firstname'] = $this->session->data['shipping_address']['firstname'];
		//$order_data['shipping_lastname'] = $this->session->data['shipping_address']['lastname'];
		$order_data['shipping_method'] = $this->session->data['shipping_address']['method']['name'];
		$order_data['shipping_country'] = $this->session->data['shipping_address']['country'];
		$order_data['shipping_country_id'] = $this->session->data['shipping_address']['country_id'];
		$order_data['shipping_zone'] = $this->session->data['shipping_address']['zone'];
		$order_data['shipping_zone_id'] = $this->session->data['shipping_address']['zone_id'];
		$order_data['shipping_city'] = $this->session->data['shipping_address']['city'];
		
		$order_data['shipping_address_1'] = $this->session->data['shipping_address']['address_1'];
		$order_data['shipping_postcode'] = $this->session->data['shipping_address']['postcode'];
		
		//$totals = array();
		$order_data['totals'] = $this->getTotals();
		$totals = array();
		foreach ($order_data['totals'] as $total) {
			$totals[$total['code']] = $this->currency->format($total['value'], $this->session->data['currency']);
		}
		$order_data['total'] = $totals['total'];
		
		// информация о валюте
		$order_data['currency_id'] = $this->currency->getId($this->session->data['currency']);
		$order_data['currency_code'] = $this->session->data['currency'];
		$order_data['currency_value'] = $this->currency->getValue($this->session->data['currency']);
		
		// информация о заказанных товарах
		$order_data['products'] = array();
		foreach ($this->cart->getProducts() as $product) {
			$option_data = array();

			foreach ($product['option'] as $option) {
				$option_data[] = array(
					'product_option_id'       => $option['product_option_id'],
					'product_option_value_id' => $option['product_option_value_id'],
					'option_id'               => $option['option_id'],
					'option_value_id'         => $option['option_value_id'],
					'name'                    => $option['name'],
					'value'                   => $option['value'],
					'type'                    => $option['type']
				);
			}

			$order_data['products'][] = array(
				'product_id' => $product['product_id'],
				'name'       => $product['name'],
				'model'      => $product['model'],
				'option'     => $option_data,
				'download'   => $product['download'],
				'quantity'   => $product['quantity'],
				'subtract'   => $product['subtract'],
				'price'      => $product['price'],
				'total'      => $product['total'],
				'tax'        => $this->tax->getTax($product['price'], $product['tax_class_id']),
				'reward'     => $product['reward']
			);
		}
		
		// информация о пользователе
		$order_data['ip'] = $this->request->server['REMOTE_ADDR'];
		
		if (!empty($this->request->server['HTTP_X_FORWARDED_FOR'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_X_FORWARDED_FOR'];
		} elseif (!empty($this->request->server['HTTP_CLIENT_IP'])) {
			$order_data['forwarded_ip'] = $this->request->server['HTTP_CLIENT_IP'];
		} else {
			$order_data['forwarded_ip'] = '';
		}

		if (isset($this->request->server['HTTP_USER_AGENT'])) {
			$order_data['user_agent'] = $this->request->server['HTTP_USER_AGENT'];
		} else {
			$order_data['user_agent'] = '';
		}

		if (isset($this->request->server['HTTP_ACCEPT_LANGUAGE'])) {
			$order_data['accept_language'] = $this->request->server['HTTP_ACCEPT_LANGUAGE'];
		} else {
			$order_data['accept_language'] = '';
		}
		
		//var_dump($order_data);
		
		$this->load->model('checkout/checkout');
		$this->model_checkout_checkout->addOrder($order_data);
	}
	
	public function shipping_methods() {
		return array(
			array('value' => 'mail', 'name' => 'Почтой России'), 
			array('value' => 'courier', 'name' => 'Курьер(Екатеринбург)'),
			array('value' => 'self-pickup', 'name' => 'Самовывоз')
		);
	}
	
	// функция возвращает все доступные для текущего заказа способы доставки
	/*public function shipping_methods() {
		$this->load->language('checkout/checkout');

		if (isset($this->session->data['shipping_address'])) 
		{
			// Shipping Methods
			$method_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('shipping');

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('extension/shipping/' . $result['code']);

					$quote = $this->{'model_extension_shipping_' . $result['code']}->getQuote($this->session->data['shipping_address']);

					if ($quote) {
						$method_data[$result['code']] = array(
							'title'      => $quote['title'],
							'quote'      => $quote['quote'],
							'sort_order' => $quote['sort_order'],
							'error'      => $quote['error']
						);
					}
				}
			}

			$sort_order = array();

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);
			return $method_data;
		}

		return 0;
	}*/
	
	/*public function payment_methods() {
		$this->load->language('checkout/checkout');

		if (isset($this->session->data['payment_address'])) {
			// Totals
			$totals = array();
			$taxes = $this->cart->getTaxes();
			$total = 0;

			// Because __call can not keep var references so we put them into an array.
			$total_data = array(
				'totals' => &$totals,
				'taxes'  => &$taxes,
				'total'  => &$total
			);
			
			$this->load->model('extension/extension');

			$sort_order = array();

			$results = $this->model_extension_extension->getExtensions('total');

			foreach ($results as $key => $value) {
				$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
			}

			array_multisort($sort_order, SORT_ASC, $results);

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('extension/total/' . $result['code']);
					
					// We have to put the totals in an array so that they pass by reference.
					$this->{'model_extension_total_' . $result['code']}->getTotal($total_data);
				}
			}

			// Payment Methods
			$method_data = array();

			$this->load->model('extension/extension');

			$results = $this->model_extension_extension->getExtensions('payment');

			$recurring = $this->cart->hasRecurringProducts();

			foreach ($results as $result) {
				if ($this->config->get($result['code'] . '_status')) {
					$this->load->model('extension/payment/' . $result['code']);

					$method = $this->{'model_extension_payment_' . $result['code']}->getMethod($this->session->data['payment_address'], $total);

					if ($method) {
						if ($recurring) {
							if (property_exists($this->{'model_extension_payment_' . $result['code']}, 'recurringPayments') && $this->{'model_extension_payment_' . $result['code']}->recurringPayments()) {
								$method_data[$result['code']] = $method;
							}
						} else {
							$method_data[$result['code']] = $method;
						}
					}
				}
			}

			$sort_order = array();

			foreach ($method_data as $key => $value) {
				$sort_order[$key] = $value['sort_order'];
			}

			array_multisort($sort_order, SORT_ASC, $method_data);

			return $method_data;
		}

		
		
	}*/
	
}