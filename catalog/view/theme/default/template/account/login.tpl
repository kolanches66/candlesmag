<?php echo $header; ?>
<div id="content-wrapper">
  <?php if ($success) { ?>
  <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
  <?php } ?>
  <?php if ($error_warning) { ?>
  <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="row">
    <div id="auth" class="">
			<div class="pagename">
				<h2><?php echo $text_i_am_returning_customer; ?></h2>
			</div>
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input class="textbox width-100" type="text" name="email" value="<?php echo $email; ?>" placeholder="Email" id="input-email" class="form-control" />
              </div>
              <div class="form-group">
                <input class="textbox width-100" type="password" name="password" value="<?php echo $password; ?>" placeholder="Пароль" id="input-password" class="form-control" />
			  </div>
              <input class="button" type="submit" value="<?php echo $button_login; ?>" />
              <?php if ($redirect) { ?>
              <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
              <?php } ?>
            </form>
			<!--<div class="form-group">
				<a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a> /
				<a href="<?php echo $register; ?>">Регистрация</a>
			</div>-->
			
          <!--</div>
        </div>
      </div>-->
      <?php echo $content_bottom; ?></div>
    <?php echo $column_right; ?></div>
</div>
<?php echo $footer; ?>