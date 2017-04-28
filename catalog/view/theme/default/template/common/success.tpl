<?php echo $header; ?>
<div id="content-wrapper">
  <div class="row"><?php echo $column_left; ?>
    <div id="content" class=""><?php echo $content_top; ?>
      <h1><?php echo $heading_title; ?></h1>
      <?php echo $text_message; ?>
      <div class="buttons">
		  <div class="pull-right"><a href="<?=HTTP_SERVER?>" class="btn btn-primary"><?php echo $button_continue; ?></a></div>
      </div>
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>