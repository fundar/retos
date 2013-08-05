<?php if(is_array($projects)) { ?>
	<div class="large-12 columns">
		<a name="retos"></a>
		<h3>Proyectos</h3>
		
		<div class="row">
			<?php foreach($projects as $project) { ?>
				<div class="large-12 columns">
					<div class="row">
						<p><strong><?php echo utf8_decode($project["title"]);?></strong></p>
						
						<p>Descripci&oacute;n: <?php echo utf8_decode($project["descr"]);?></p>
						
						<p>
							Categor&iacute;a: <?php echo $project["name_category"];?><br/>
							Url del video: <?php echo $project["url_video"];?><br/>
							Url del demo: <?php echo $project["url_demo"];?><br/>
						</p>
						
						<p>
							Representante: <?php echo utf8_decode($project["name"]);?><br/>
							Correo: <?php echo utf8_decode($project["email"]);?><br/><br/>
							
							Integrantes: <?php echo utf8_decode($project["names"]);?>
						</p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<br/><br/><p>Aun no han agregado proyectos.</p>
<?php } ?>
