<?php echo $header; ?>
<div id="content-wrapper">
  <?php if ($attention) { ?>
  <div class="alert alert-info"><i class="fa fa-info-circle"></i> <?php echo $attention; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
  <?php } ?>
  <div class="row"><?php echo $column_left; ?>
    <?php if ($column_left && $column_right) { ?>
    <?php $class = 'col-sm-6'; ?>
    <?php } elseif ($column_left || $column_right) { ?>
    <?php $class = 'col-sm-9'; ?>
    <?php } else { ?>
    <?php $class = 'col-sm-12'; ?>
    <?php } ?>
    <div id="content-center"><?php echo $content_top; ?>
      <h2 class="pagename"><?php echo $heading_title; ?>
        <?php if ($weight) { ?>
        &nbsp;(<?php echo $weight; ?>)
        <?php } ?>
      </h2>
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <td class="text-center">Товар</td>
                <td class="text-left"></td>
                <!--<td class="text-left"><?php echo $column_model; ?></td>-->
				<td></td>
                <td class="text-right">Цена</td>
                <td class="text-right">Общая стоимость</td>
				<td class="text-right"></td>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product) { ?>
              <tr>
                <td class="text-center"><?php if ($product['thumb']) { ?>
                  <a href="<?php echo $product['href']; ?>"><img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="img-thumb" /></a>
                  <?php } ?></td>
                <td class="text-left"><a href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                  <?php if (!$product['stock']) { ?>
                  <span class="text-danger">***</span>
                  <?php } ?>
                  <?php if ($product['option']) { ?>
                  <?php foreach ($product['option'] as $option) { ?>
                  <br />
                  <small><?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>
                  <?php } ?>
                  <?php } ?>
                  <?php if ($product['reward']) { ?>
                  <br />
                  <small><?php echo $product['reward']; ?></small>
                  <?php } ?>
                  <?php if ($product['recurring']) { ?>
                  <br />
                  <span class="label label-info"><?php echo $text_recurring_item; ?></span> <small><?php echo $product['recurring']; ?></small>
                  <?php } ?></td>
                <!--<td class="text-left"><?php echo $product['model']; ?></td>-->
				<td class="text-right"></td>
                <td class="text-right"><?php echo $product['price']; ?></td>
                <td class="text-right"><?php echo $product['total']; ?></td>
				<td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
					<button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="cart.remove('<?php echo $product['cart_id']; ?>');"><i class="fa fa-times-circle"></i></button></div>
				</td>
              </tr>
              <?php } ?>
              <?php foreach ($vouchers as $voucher) { ?>
              <tr>
                <td></td>
                <td class="text-left"><?php echo $voucher['description']; ?></td>
                <td class="text-left"></td>
                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                    <input type="text" name="" value="1" size="1" disabled="disabled" class="form-control" />
                    <span class="input-group-btn">
                    <button type="button" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger" onclick="voucher.remove('<?php echo $voucher['key']; ?>');"><i class="fa fa-times-circle"></i></button>
                    </span></div></td>
                <td class="text-right"><?php echo $voucher['amount']; ?></td>
                <td class="text-right"><?php echo $voucher['amount']; ?></td>
              </tr>
              <?php } ?>
			  
            <?php foreach ($totals as $total) { ?>
            <tr>
			  <td></td><td></td><td></td>
              <td class="text-right"><strong><?php echo $total['title']; ?>:</strong></td>
              <td class="text-right"><?php echo $total['text']; ?></td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div>
      </form>
			
		<!--<h2>Выберите способ доставки</h2>
		<div class="" id="">
			<div class="radioline active" id="shipping-to-shop">
				<div class="rl--text">
					<span>Самовывоз — 0 Р.</span>
				</div>
			</div>
			<div class="radioline" id="shipping-russian-post">
				<div class="rl--text">
					<span>Почтой России — 150 Р.</span>
				</div>
			</div>
		</div>-->
	  <br>
      
      <div class="buttons clearfix">
        <div class="pull-left"><a href="<?php echo $continue; ?>" class="button"><?php echo $button_shopping; ?></a></div>
        <div class="pull-right"><a href="<?php echo $checkout; ?>" class="button"><?php echo $button_checkout; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>


<script>
$('.radioline').on('click', function() {
	$('.radioline').removeClass('active');
	$(this).addClass('active');
	
	
});
</script>