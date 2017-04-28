<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-callback').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> Все обратные звонки</h3>
      </div>
      <div class="panel-body">
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-callback">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left">
                    <a href="" class="">Имя</a>
                  </td>
				  <td class="text-left">
				    <a href="" class="">Телефон</a>
			      </td>
				  <td class="text-left">
				    <a href="" class="">Дата отправки</a>
			      </td>
				  <!--<td class="text-left">
				    <a href="" class="">Время для звонка</a>
			      </td>-->
                </tr>
              </thead>
              <tbody>
                <?php if ($callbacks) { ?>
                <?php foreach ($callbacks as $callback) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($callback['callback_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $callback['callback_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $callback['callback_id']; ?>" />
                    <?php } ?></td>
                  <td class="left"><?php echo $callback['customer_name']; ?></td>
                  <td class="text-left"><?php echo $callback['customer_phone']; ?></td>
				  <td class="text-left"><?php echo $callback['date_added']; ?></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="4"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <!--<div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>-->
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>