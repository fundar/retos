<?php if($post and is_array($post)) { ?>
	<div class="large-12 columns top-single">
		        <!-- Contenido-->  
		        <h3><?php echo utf8_decode($post["title"]);?></h3>
			<div class="row">
				<div class="large-12 columns ">				
				<p class="cita">
				<?php echo utf8_decode($post["abstract"]);?>	
				</p>
				</div>
			</div>
		        </div>			
	
        <div class="row"><!-- Resumen reto--> 
                <div class="small-11 small-centered columns top-single"> 
			        <div class="row top-single">
					  <div class="large-7 columns ilustracion">
						<img  src="img/reto-post.jpg">
					  </div>
                                          <div class="large-5 columns panel-retos parrafo">
						<div class="panel callout stats  reto">
							<ul class="social-stats">
							<li><p class="like"><?php echo $post["votes"];?></p></li>
							<li><p class="opinion"><?php echo $post["votes"];?> Comentarios</p></li>
							</ul>			
			                        </div>
						<h4 class="nombredelreto">
							<?php echo utf8_decode($post["title"]);?>
						</h4>
						<p class="elresumen">
							<?php echo utf8_decode($post["abstract"]);?>
					  </div>
				</div>
		</div>		
		<div class="small-11 small-centered columns top-single"> 		
			        <!-- Explicación reto-->
				<p>
					<?php echo utf8_decode($post["abstract"]);?>
				</p>
				
				<p class="detalle">DETALLE</p>
				
				<p>
					<?php echo utf8_decode($post["descr"]);?>
				</p>	
			</div>
		</div>
	</div><!-- contenido sepués de cita -->
	
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
	
	
	<!-- Comentarios -->
	<p>Comentarios</p>
	
	<div id="comments">
		<?php if(is_array($comments)) { ?>
			<?php foreach($comments as $comment) { ?>
				<div class="comment">
					<p>
						<span>
							<a href="<?php echo $comment["url"];?>" title="<?php echo utf8_decode($comment["name"]);?>">
								<?php echo utf8_decode($comment["name"]);?>
							</a>
						</span>:<br/>
						<?php echo utf8_decode($comment["comment"]);?>
					</p>
				</div>
			<?php } ?>
		<?php } else { ?>
			<p>Se el primero en comentar</p>
		<?php } ?>
	</div>
	
	
	<!-- Formulario de comentarios -->
	<?php if($user and is_array($user)) { ?>
		<form method="POST" action="">
			<input type="text"   id="post-comment"      name="comment" value=""/>
			<input type="hidden" id="post-slug"    name="post-slug" value="<?php echo $post["slug"];?>"/>
			<input type="button" id="send-comment" name="send-comment" value="comentar" />
		</form>
	<?php } else { ?>
		Necesitas estar conectado para comentar
	<?php } ?>
	
	
	<!-- JS & Ajax -->
	<script type="text/javascript">
		$(document).ready( function () {
			$(".like-post").click( function () {
				id = $(this).attr("value");
				like_post(id);
			});
			
			$("#send-comment").click( function () {
				slug    = $("#post-slug").val();
				comment = $("#post-comment").val();
				
				comment_post(slug, comment);
			});
		});
		
		function comment_post(vslug, vcomment) {
			$.post("/reto/" + slug, { slug: vslug, comment: vcomment })
			.done(function(data) {
				if(data == "true") {
					html = '<div class="comment"><p><span>';
					html += '<a href="<?php echo $user[0]["url"];?>" title="<?php echo utf8_decode($user[0]["name"]);?>">';
					html += '<?php echo utf8_decode($user[0]["name"]);?></a></span>:<br/>';
					html += vcomment + '</p></div>';
					
					$("#post-comment").val("");
					$('#comments').append(html);
				}
			});
		}
		
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
		Contenido no disponible!
	</p>
<?php } ?>

