<?php if($post and is_array($post)) { ?>
	<div class="large-12 columns top-single">
		        <!-- Contenido-->  
		        <h3><?php echo utf8_decode($post["title"]);?></h3>

	</div>			
	
        <div class="row"><!-- Resumen reto--> 
                <div class="small-11 small-centered columns top-single"> 
			        <div class="row top-single">
					  <div class="large-7 columns ilustracion">
						<img src="<?php echo get("webURL") . '/' . str_replace("_s.", "_m.", $post["image_url"]);?>" alt="<?php echo $post["title"];?>">
					  </div>
                      <div class="large-5 columns panel-retos parrafo">
						
						<div class="panel callout stats  reto">
							<ul class="social-stats">
							<li><p class="like votes like-post" value="<?php echo $post["post_id"];?>"><?php echo $post["votes"];?></p></li>
							<li><p class="opinion"><?php echo $post["count"];?> Comentarios</p></li>
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
				<p class="detalle">Categor&iacute;a:</p>
				
				<p><?php echo utf8_decode($post["category"]);?></p>
				
				<p class="detalle">DETALLE</p>
				
				<p>
					<?php echo utf8_decode($post["descr"]);?>
				</p>	
			</div>
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
			<?php } ?>
		</div>
		
		
		<!-- Formulario de comentarios -->
		<?php if($user and is_array($user)) { ?>
			<form method="POST" action="">
				<input type="text"   id="post-comment" name="comment" value="" onKeyPress="return checkSubmit(event)"/>
				<input type="hidden" id="post-slug"    name="post-slug" value="<?php echo $post["slug"];?>"/>
				<input type="button" id="send-comment" name="send-comment" value="comentar" />
			</form>
		<?php } else { ?>
			Necesitas estar conectado para comentar
		<?php } ?>
	
	</div><!-- contenido sepués de cita -->		
	
	<!-- JS & Ajax -->
	<script type="text/javascript">
		function checkSubmit(e) {
		   if(e && e.keyCode == 13) {
			  $("#send-comment").click();
			  return false;
		   }
		}

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

