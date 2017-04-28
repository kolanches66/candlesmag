<!--<div class="list-group">
  <?php foreach ($categories as $category) { ?>
  <?php if ($category['category_id'] == $category_id) { ?>
  <a href="<?php echo $category['href']; ?>" class="list-group-item active"><?php echo $category['name']; ?></a>
  <?php if ($category['children']) { ?>
  <?php foreach ($category['children'] as $child) { ?>
  <?php if ($child['category_id'] == $child_id) { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item sub active"><?php echo $child['name']; ?></a>
  <?php } else { ?>
  <a href="<?php echo $child['href']; ?>" class="list-group-item sub"><?php echo $child['name']; ?></a>
  <?php } ?>
  <?php } ?>
  <?php } ?>
  <?php } else { ?>
  <a href="<?php echo $category['href']; ?>" class="list-group-item"><?php echo $category['name']; ?></a>
  <?php } ?>
  <?php } ?>
</div>-->


		<div id="category">
			<!--<h4 class="sideblocktitle">Каталог</h4>-->
		<ul>
<?php	foreach ($categories as $category) { ?>
<?php 		if ($category['category_id'] == $category_id) { ?>
				<li><a href="<?php echo $category['href']; ?>" class="active"><?php echo $category['name']; ?></a></li>
<?php		} else { ?>
				<li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
<?php 		} ?>
<?php 			if ($category['children']) { ?>
<?php 				foreach ($category['children'] as $child) { ?>
<?php 					if ($child['category_id'] == $child_id) { ?>
							<li class="child"><a href="<?php echo $child['href']; ?>" class="active"><?php echo $child['name']; ?></a></li>
<?php 					} else { ?>
							<li class="child"><a href="<?php echo $child['href']; ?>" ><?php echo $child['name']; ?></a></li>
<?php 					} ?>
<?php 				} ?>
<?php 			} ?> 		
<?php 	} ?>
		</ul></div>