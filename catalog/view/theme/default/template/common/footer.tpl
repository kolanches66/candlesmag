<div id="footer-wrapper">
  <div id="footer">
    <div class="row">
      <?php if ($informations) { ?>
	  <div class="col-sm-4">
        <h5><?php echo $text_service; ?></h5>
        <ul class="list-unstyled">
          <li><a href="<?php echo $contact; ?>">Обратная связь</a></li>
        </ul>
      </div>
      <div class="col-sm-4">
        <h5><?php echo $text_information; ?></h5>
        <ul class="list-unstyled">
          <?php foreach ($informations as $information) { ?>
          <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
          <?php } ?>
        </ul>
      </div>
      <?php } ?>
      <div class="col-sm-4">
        <h5><?php echo $text_account; ?></h5>
        <ul class="list-unstyled">
		  <?php 
		  if ($logged) 
		  { 
		  ?>
			<li><a href="<?php echo $account_order; ?>">История заказов</a></li>
			<li><a href="<?php echo $account_edit; ?>">Изменить данные</a></li>
			<li><a href="<?php echo $account_address; ?>">Адрес доставки</a></li>
			<li><a href="<?php echo $logout; ?>">Выход</a></li>
		  <?php 
		  }
		  else
		  {
		  ?>
			<li><a href="<?php echo $login; ?>">Вход</a></li>
			<li><a href="<?php echo $register; ?>">Регистрация</a></li>
		  <?php
		  }
		  ?>
        </ul>
      </div>
    </div>
  </div>
</div>
</body></html>