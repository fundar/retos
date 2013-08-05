<?php if(is_array($projects)) { ?>
	<div class="large-12 columns">
		<a name="retos"></a>
		<h3>Proyectos</h3>
		
		<div class="row">
			<?php foreach($projects as $project) { ?>
				<!-- Retos th. Fila 1 -->  
				<div class="large-3 small-6 columns bottom-retoth">
					<a href="/reto/<?php echo $post["slug"];?>" title="<?php echo utf8_decode($post["title"]);?>">
						<div class="liston">
							<img class="category-img" src="<?php echo $this->themePath; ?>/img/liston-<?php echo $post["category_id"];?>.png" />
							<img class="los-retos" src="<?php echo get("webURL") . '/' . $post["image_url"];?>" title="<?php echo utf8_decode($post["title"]);?>"/>
						</div>
					</a>
					
					<a href="/reto/<?php echo $post["slug"];?>" title="<?php echo utf8_decode($post["title"]);?>">
						<h6 class="panel">
							<?php echo utf8_decode($post["title"]);?>
						</h6>
					</a>
					
					<div class="panel callout stats  reto">
						<ul class="social-stats">
							<li>
								<p class="like like-post vote<?php echo $post["post_id"];?>" value="<?php echo $post["post_id"];?>">
									<?php echo $post["votes"];?>
								</p>
							</li>
							<li><p class="opinion"><?php echo $post["count"];?> Comentarios</p></li>
						</ul>			
					</div>
					
					<?php if($post["status"] == "f") { ?>
						<div class="color-red" style="height:0px; font-size:14px;">
							Pendiente de aprobaci&oacute;n - 
							<a href="/edit/<?php echo $post["slug"];?>" title="<?php echo utf8_decode($post["title"]);?>">
								Editar
							</a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<br/><br/><p>Aun no han agregado proyectois.</p>
<?php } ?>
