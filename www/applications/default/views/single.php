<?php if($post and is_array($post)) { ?>
	<div class="post">
		<p><img src="<?php echo get("webURL") . '/' . $post["image_url"];?>" alt="<?php echo $post["title"];?>"></p>
		<p class="title"><?php echo utf8_decode($post["title"]);?></p>
		<p class="abstract"><?php echo utf8_decode($post["abstract"]);?></p>
		<p class="descr"><?php echo utf8_decode($post["descr"]);?></p>
		<p class="descr">Categoria: <?php echo utf8_decode($post["category"]);?></p>
		<p>
			<span class="like-post" value="<?php echo $post["post_id"];?>">Like</span>
			&nbsp;<span class="votes"><?php echo $post["votes"];?></span>
		</p>
	</div>
	
	<p>
		Comentarios
	</p>
	
	<form method="POST" action="">
		<input type="text" name="comment" value=""/>
		<input type="submit" name="send" value="comentar" />
	</form>
	
	<script type="text/javascript">
		$(document).ready( function () {
			$(".like-post").click( function () {
				id = $(this).attr("value");
				like_post(id);
			});
		});
		
		function like_post(id) {
			$.ajax({
				url: "/like/" + id
			}).done(function (data) {
				if(data == "false") {
					
				} else {
					$(".votes").text(data);
				}
			});
		}
	</script>
<?php } else { ?>
	<p>
		No existe
	</p>
<?php } ?>
