<?php if(is_array($posts)) { ?>
	<div class="large-12 columns">
		<a name="retos"></a>
		
		<div>
			<p style="color:#A63838; font-size:30px;">
				Aviso importante.
			</p>
			
			<p style="font-size:17px;">
				Debido a la amplia respuesta que tuvo la convocatoria #ConectaDF, tanto en cantidad y calidad de proyectos, 
				se amplió el periodo de evaluación para el jurado de ConectaDF. 
				En breve daremos a conocer la nueva fecha de presentación de resultados.
			</p>
		</div><br/><br/>
		
		<h3>Retos</h3>
		
		<p>
			Ordenar por: 
			<a href="/ordenar/comentarios/#retos" title="Ordenar por comentarios"<?php echo (segment(0) and segment(1) == "comentarios") ? ' class="bold"' : ""; ?>>comentarios</a> | 
			<a href="/ordenar/votos/#retos" title="Ordenar por votos"<?php echo (segment(0) and segment(1) == "votos") ? ' class="bold"' : ""; ?>>votos</a>
		</p>
		
		<div class="row">
			<?php foreach($posts as $post) { ?>
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
								<p class="like vote<?php echo $post["post_id"];?>" value="<?php echo $post["post_id"];?>">
									<?php echo $post["votes"];?>
								</p>
							</li>
							<li><p class="opinion"><?php echo $post["count"];?> Comentarios</p></li>
						</ul>			
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
