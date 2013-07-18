<?php if($post and is_array($post)) { ?>
	<div class="post">
		<p><img src="<?php echo get("webURL") . '/' . $post["image_url"];?>" alt="<?php echo $post["title"];?>"></p>
		<p class="title"><?php echo utf8_decode($post["title"]);?></p>
		<p class="abstract"><?php echo utf8_decode($post["abstract"]);?></p>
		<p class="descr"><?php echo utf8_decode($post["descr"]);?></p>
		<p class="descr">Categoria: <?php echo utf8_decode($post["category"]);?></p>
	</div>
	
	<p>
		<a href="/like/<?php echo $post["slug"];?>" title="Like">Like</a>
	</p>
	
	<p>
		Comentarios
	</p>
	
	<form method="POST" action="">
		<input type="text" name="comment" value=""/>
		<input type="submit" name="send" value="comentar" />
	</form>
<?php } else { ?>
	<p>
		No existe
	</p>
<?php } ?>
