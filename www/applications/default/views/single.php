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
								<li><p class="like votes" value="<?php echo $post["post_id"];?>"><?php echo $post["votes"];?></p></li>
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
				<p class="detalle">Usuario:</p>
				
				<?php if($post["admin"] == "t") { ?>
					<p>
						<a href="http://twitter.com/opendatamx" title="OpenDataMx" target="_blank" >OpenDataMX</a>
					</p>
				<?php } elseif($post["type_user"] == "persona") { ?>
					<p>
						<?php echo utf8_decode($post["name_user"]);?>
					</p>
				<?php } else { ?>
					<p>
						<a href="<?php echo $post["url"];?>" title="ConectaDF" target="_blank">
							<?php echo $post["url"];?>
						</a>
					</p>
				<?php } ?>
				
				<p class="detalle">Categor&iacute;a:</p>
				
				<p><?php echo utf8_decode($post["category"]);?></p>
				
				<p class="detalle">DETALLE</p>
				
				<div class="descr">
					<?php echo utf8_decode($post["descr"]);?>
				</div>	
			</div>
		</div>
		
		
		<!-- Comentarios -->
		<div class="small-11 small-centered columns">
			<div class="row">
				
				<br/><br/><p>Comentarios</p>
				
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
			</div>
		</div>
	</div><!-- contenido sepués de cita -->		
<?php } else { ?>
	<br/><p>
		Contenido no disponible!
	</p>
<?php } ?>

