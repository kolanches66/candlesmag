<?php echo $header; ?>

<div id="content-wrapper">
	<h2 class="pagename margin-b-25">
		<a href="<?=$cart_link?>">Корзина</a> → Оформление заказа</h2>
	<form action="" method="post" enctype="multipart/form-data">
	<div class="row">
			<div class="col-sm-6">
				<fieldset id="account">
					<legend>Личные данные</legend>
					
					<div class="form-group required">
						<label class="control-label" for="input-payment-email">Email</label>
						<input type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" class="form-control" />
						<?php if ($error_email) { ?>
							<div class="text-danger">E-Mail введён неправильно</div>
						<?php } ?>
						<?php if ($error_warning) { ?>
							<div class="text-danger">Такой email уже существует</div>
						<?php } ?>
					</div>
					
					<div class="form-group required">
						<label class="control-label" for="input-firstname">Имя</label>
						<input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="Имя" id="input-firstname" class="form-control" />
						<?php if ($error_firstname) { ?>
							<div class="text-danger">Имя должно содержать от 1 до 32 символов</div>
						<?php } ?>
					</div>
					<div class="form-group required">
						<label class="control-label" for="input-payment-lastname">Фамилия</label>
						<input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Фамилия" id="input-payment-lastname" class="form-control" />
						<?php if ($error_lastname) { ?>
							<div class="text-danger">Фамилия должна содержать от 1 до 32 символов</div>
						<?php } ?>
					</div>
					
					<div class="form-group required">
						<label class="control-label" for="input-payment-telephone">Телефон</label>
						<input type="text" name="telephone" value="<?php echo $telephone; ?>" placeholder="Телефон" class="form-control" />
						<?php if ($error_telephone) { ?>
							<div class="text-danger">В телефоне должно быть от 3 до 32 цифр</div>
						<?php } ?>
					</div>
					
					<hr>
					
					<div class="form-group required">
						<label class="control-label" for="input-payment-method">Способ оплаты</label>
						<select name="payment-method" id="input-payment-method" class="form-control">
							<!--<option value="mail">Наличными</option>
							<option value="courier">Курьером (Екатеринбург)</option>
							<option value="self-pickup">Самовывоз</option>-->
						</select>
					</div>
					
				</fieldset>
			</div>
			
			<div class="col-sm-6">
				<fieldset id="account">
					<legend>Доставка</legend>
					
					<div class="form-group required">
						<label class="control-label" for="input-shipping-method">Способ доставки</label>
						<select name="shipping_method" id="input-shipping-method" class="form-control">
							<!--<option value="courier">Курьером (Екатеринбург)</option>
							<option value="mail">Почтой России</option>
							<option value="self-pickup">Самовывоз</option>-->
							<?php foreach ($shipping_methods as $method) { ?>
								<?php if ($method['value'] == $shipping_method) { ?>
								<option value="<?php echo $method['value']; ?>" selected="selected"><?php echo $method['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $method['value']; ?>"><?php echo $method['name']; ?></option>
								<?php } ?>
								<?php } ?>
						</select>
					</div>
					
					<div id="shipping-mail" class="shipping" style="display: none;">	
						<div class="form-group required">
							<label class="control-label" for="input-payment-country">Страна</label>
							<select name="country_id" id="input-payment-country" class="form-control">
								<option value="">Выберите вашу страну</option>
								<?php foreach ($countries as $country) { ?>
								<?php if ($country['country_id'] == $country_id) { ?>
								<option value="<?php echo $country['country_id']; ?>" selected="selected"><?php echo $country['name']; ?></option>
								<?php } else { ?>
								<option value="<?php echo $country['country_id']; ?>"><?php echo $country['name']; ?></option>
								<?php } ?>
								<?php } ?>
							</select>
						</div>

						<div class="form-group required">
							<label class="control-label" for="input-payment-zone">Регион / область</label>
							<select name="zone_id" id="input-payment-zone" class="form-control">
							</select>
						</div>

						<div class="form-group required">
							<label class="control-label" for="input-payment-city">Город</label>
							<input type="text" name="city" value="<?php echo $city; ?>" placeholder="Город" id="input-payment-city" class="form-control" />
						</div>

						<div class="form-group required">
							<label class="control-label" for="input-payment-address_1">Адрес</label>
							<input type="text" name="shipping_mail_address" value="<?php echo $address_1; ?>" placeholder="Адрес" id="input-payment-address_1" class="form-control" />
						</div>

						<div class="form-group required">
							<label class="control-label" for="input-payment-postcode">Индекс</label>
							<input type="text" name="shipping_mail_postcode" value="<?php echo $postcode; ?>" placeholder="Индекс" class="form-control" />
						</div>
					</div>
					
					<div id="shipping-courier" class="shipping" style="display: none;">	

						<div class="form-group required">
							<label class="control-label" for="input-payment-address_1">Адрес</label>
							<input type="text" name="shipping_courier_address" value="<?php echo $address_1; ?>" placeholder="Адрес" id="input-payment-address_1" class="form-control" />
						</div>

						<div class="form-group required">
							<label class="control-label" for="input-payment-postcode">Индекс</label>
							<input type="text" name="shipping_courier_postcode" value="<?php echo $postcode; ?>" placeholder="Индекс" class="form-control" />
						</div>
					</div>
					
				</fieldset>
			</div>
		</div>
			
			<!--<?php if ($error_warning) { ?>
			<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
			<?php } ?>
			<?php if ($payment_methods) { ?>
			<p>Выберите способ оплаты для этого заказа:</p>
			<?php foreach ($payment_methods as $payment_method) { ?>
			<div class="radio">
			  <label>
				<?php if ($payment_method['code'] == $code || !$code) { ?>
				<?php $code = $payment_method['code']; ?>
				<input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" checked="checked" />
				<?php } else { ?>
				<input type="radio" name="payment_method" value="<?php echo $payment_method['code']; ?>" />
				<?php } ?>
				<?php echo $payment_method['title']; ?>
				<?php if ($payment_method['terms']) { ?>
				(<?php echo $payment_method['terms']; ?>)
				<?php } ?>
				<?php if (isset($payment_method['description'])) { ?>
				<br /><small><?php echo $payment_method['description']; ?></small>
				<?php } ?>
			  </label>
			</div>
			<?php } ?>
			<?php } ?>-->
			
		<!--<div class="col-sm-6">
			<legend>Способ доставки</legend>
			<?php if ($error_warning) { ?>
			<div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
			<?php } ?>
			<?php if ($shipping_methods) { ?>
			<p>Выберите удобный способ доставки для этого заказа:</p>
			<?php foreach ($shipping_methods as $shipping_method) { ?>
			<p><strong><?php echo $shipping_method['title']; ?></strong></p>
			<?php if (!$shipping_method['error']) { ?>
			<?php foreach ($shipping_method['quote'] as $quote) { ?>
			<div class="radio">
			  <label>
				<?php if ($quote['code'] == $code || !$code) { ?>
				<?php $code = $quote['code']; ?>
				<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" checked="checked" />
				<?php } else { ?>
				<input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" />
				<?php } ?>
				<?php echo $quote['title']; ?> - <?php echo $quote['text']; ?>
				<?php if (isset($quote['description'])) { ?>
				<br /><small><?php echo $quote['description']; ?></small>
				<?php } ?>
			  </label>
			</div>
			<?php } ?>
			<?php } else { ?>
			<div class="alert alert-danger"><?php echo $shipping_method['error']; ?></div>
			<?php } ?>
			<?php } ?>
			<?php } ?>
		</div>-->
		
		<div class="row">
			<div class="col-sm-12">
				<div class="buttons text-center">
						<input type="submit" value="Отправить заказ" class="button" />
				</div>
			</div>
		</div>
	</form>
</div>

<script>
	
$('#input-shipping-method').on('change', function() {
	$('.shipping').hide();
	var v = $('#input-shipping-method option:selected').val();
	if (v === 'mail') {
		$('[name=shipping_mail_address]').val($('[name=shipping_courier_address]').val());
		$('[name=shipping_mail_postcode]').val($('[name=shipping_courier_postcode]').val());
		$('#shipping-mail').show();
	} else if (v === 'courier') {
		$('[name=shipping_courier_address]').val($('[name=shipping_mail_address]').val());
		$('[name=shipping_courier_postcode]').val($('[name=shipping_mail_postcode]').val());
		$('#shipping-courier').show();
	}
});

// вызываем сразу же после загрузки страницы
$('#input-shipping-method').trigger('change');

// изменение списка регионов в зависимости от страны
$('select[name=\'country_id\']').on('change', function() {
	$.ajax({
		url: 'index.php?route=checkout/checkout/country&country_id=' + this.value,
		dataType: 'json',
		beforeSend: function() {
			$('select[name=\'country_id\']').after(' <i class="fa fa-circle-o-notch fa-spin"></i>');
		},
		complete: function() {
			$('.fa-spin').remove();
		},
		success: function(json) {
			if (json['postcode_required'] == '1') {
				$('input[name=\'postcode\']').parent().parent().addClass('required');
			} else {
				$('input[name=\'postcode\']').parent().parent().removeClass('required');
			}

			html = '';

			if (json['zone'] && json['zone'] != '') {
				for (i = 0; i < json['zone'].length; i++) {
					html += '<option value="' + json['zone'][i]['zone_id'] + '"';

					if (json['zone'][i]['zone_id'] == '<?php echo $zone_id; ?>') {
						html += ' selected="selected"';
					}

					html += '>' + json['zone'][i]['name'] + '</option>';
				}
			}

			$('select[name=\'zone_id\']').html(html);
		},
		error: function(xhr, ajaxOptions, thrownError) {
			alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		}
	});
});

// вызываем сразу же после загрузки страницы
$('select[name=\'country_id\']').trigger('change');
</script>

<?php echo $footer; ?>