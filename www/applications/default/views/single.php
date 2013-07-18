<?php if($post and is_array($post)) { ?>
	<p>
		<?php echo $post["title"];?>
	</p>
<?php } else { ?>
	<p>
		No existe
	</p>
<?php } ?>
