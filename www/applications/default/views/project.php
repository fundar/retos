<?php if(is_array($project)) { ?>
	<div class="large-12 columns">
		<a name="retos"></a>
		
		<div class="row">
			<div class="large-12 columns">
				<div class="row">
					<h3><?php echo utf8_decode($project["title"]);?></h3>
					
					<p>Descripci&oacute;n: <?php echo utf8_decode($project["descr"]);?></p><br/>
					
					<p>
						Categor&iacute;a: <?php echo utf8_decode($project["name_category"]);?><br/>
						Url del video: <?php echo $project["url_video"];?><br/>
						Url del demo: <?php echo $project["url_demo"];?><br/>
					</p>
					
					<p>
						Representante: <?php echo utf8_decode($project["name"]);?><br/>
						Correo: <?php echo utf8_decode($project["email"]);?><br/><br/>
						
						Integrantes: <?php echo utf8_decode($project["names"]);?>
					</p><br/><br/>
				</div>
			</div>
		</div>
		<br/>
		
		<p>
			<a href="/project/<?php echo $offset - 1;?>">Anterior</a> | <a href="/project/<?php echo $offset + 1;?>">Siguiente</a>
		</p>
		
	</div>
<?php } else { ?>
	<br/><br/><p>Aun no han agregado proyectos.</p>
<?php } ?>
