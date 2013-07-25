<?php if($post and is_array($post)) { ?>
	<div class="large-12 columns top-single">
		<!-- Contenido-->
		<h3><?php echo utf8_decode($post["title"]); ?></h3>
		
		<?php if(is_array($user) and $user[0]["admin"] == "t") { ?>
			<a href="/edit/<?php echo $post["slug"]; ?>" title="Edit">Editar</a>
		<?php } ?>
	</div>
	
        <div class="row"><!-- Resumen reto--> 
                <div class="small-11 small-centered columns top-single"> 
			        <div class="row top-single">
					  
						<div class="large-7 columns ilustracion">
							<img src="<?php echo get("webURL") . '/' . str_replace("_s.", "_m.", $post["image_url"]);?>" alt="<?php echo $post["title"];?>">
						</div>
					  
						<div class="large-5 columns panel-retos parrafo">
						
							<div class="panel callout stats reto">
								<ul class="social-stats">
								<li><p class="like votes like-post" value="<?php echo $post["post_id"];?>"><?php echo $post["votes"];?></p></li>
								<li><p class="opinion"><?php echo $post["count"];?> Comentarios</p></li>
								<li class="vota-tw">
									<a href="https://twitter.com/share" class="twitter-share-button" data-text="<?php echo utf8_decode($post["title"]);?> #ConectaDF" data-via="opendatamx" data-lang="en">Tweet</a>
									<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
								</li>
								</ul>		
							</div>
							
						<div class="el-texto">
							<h4 class="nombredelreto">
								<?php echo utf8_decode($post["title"]);?>
							</h4>
							
							<p class="elresumen">
								<?php echo utf8_decode($post["abstract"]);?>
							</p>
					  </div>
				</div>
		</div>		
		<div class="small-11 small-centered columns top-single"> 		
			        <!-- Explicación reto-->
				<p class="detalle">Categor&iacute;a:</p>
				
				<p><?php echo utf8_decode($post["category"]);?></p>
				
				<p class="detalle">DETALLE</p>
				
				<div class="descr">
					<?php echo utf8_decode($post["descr"]);?>
				</div>	
			</div>
		</div>
		
		
		<!-- Comentarios -->
		<div class="small-11 small-centered">
			<p>Comentarios</p>
			<div id="comments">
				<?php if(is_array($comments)) { ?>
					<?php foreach($comments as $comment) { ?>
						<?php if($comment["parent_id"] == 0) { ?>
							<div class="comment coment_id_<?php echo $comment["comment_id"];?>">
						<?php } else { ?>
							<div class="comment2">
						<?php } ?>
							<p>
								<span>
									<a target="_blank" class="user-comment-<?php echo $comment["comment_id"];?>" href="<?php echo $comment["url"];?>" title="<?php echo utf8_decode($comment["name"]);?>">
										<?php echo utf8_decode($comment["name"]);?>
									</a>
								</span>
								
								<?php if($user and is_array($user)) { ?>
									<?php if($comment["parent_id"] == 0) { ?>
										: <a href="#" class="reply-comment" value="<?php echo $comment["comment_id"];?>">contestar</a>
									<?php } ?>
								<?php } ?>
								
								<br/>
								<span class="comment-<?php echo $comment["comment_id"];?>">
									<?php echo utf8_decode($comment["comment"]);?>
								</span>
							</p>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
			
			
			<!-- Formulario de comentarios -->
			<?php if($user and is_array($user)) { ?>
				<form method="POST" action="" id="form-comment">
					<div id="reply-to"></div>
					<input type="text"   id="post-comment" name="comment" value="" onKeyPress="return checkSubmit(event)"/>
					<input type="hidden" id="post-slug"    name="post-slug" value="<?php echo $post["slug"];?>"/>
					<input type="hidden" id="post-parent-id" name="post-parent-id" value="0"/>
					<input type="button" id="send-comment" name="send-comment" value="comentar" />
				</form>
			<?php } else { ?>
				Necesitas estar conectado para comentar
			<?php } ?>
		</div>
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
			$(".descr a").attr("target", "_blank");
			
			$(".reply-comment").click( function () {
				id = $(this).attr("value");
				console.log(id);
				div = '<p>Contestar a: ' + $(".user-comment-" + id).text() + "</p>";
				$("#reply-to").html(div);
				$("#post-parent-id").val(id);
				$("#post-comment").focus();
				return false;
			});
			
			$(".like-post").click( function () {
				id = $(this).attr("value");
				like_post(id);
			});
			
			$("#send-comment").click( function () {
				slug      = $("#post-slug").val();
				comment   = $("#post-comment").val();
				parent_id = $("#post-parent-id").val();
				
				comment_post(slug, comment, parent_id);
			});
		});
		
		function comment_post(vslug, vcomment, vparent_id) {
			$.post("/reto/" + slug, { slug: vslug, comment: vcomment, parent_id: vparent_id })
			.done(function(data) {
				if(data == "true") {
					if(vparent_id == 0) {
						html = '<div class="comment"><p><span>';
					} else {
						html = '<div class="comment2"><p><span>';
					}
					
					html += '<a href="<?php echo $user[0]["url"];?>" title="<?php echo utf8_decode($user[0]["name"]);?>">';
					html += '<?php echo utf8_decode($user[0]["name"]);?></a></span><br/>';
					html += vcomment + '</p></div>';
					
					$("#post-comment").val("");
					
					if(vparent_id == 0) {
						$('#comments').append(html);
					} else {
						$(html).insertAfter('.coment_id_' + vparent_id);
					}
					
					
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
	<br/><p>
		Contenido no disponible!
	</p>
<?php } ?>

