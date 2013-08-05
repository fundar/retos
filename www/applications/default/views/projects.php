<?php if(is_array($projects)) { ?>
	<div class="large-12 columns">
		<a name="retos"></a>
		<h3>Proyectos</h3>
		
		<div class="row">
			<?php foreach($projects as $project) { ?>
				<div class="large-12 columns">
					<div class="row">
						<p><strong><?php echo utf8_decode($project["title"]);?></strong></p>
						
						<p><?php echo utf8_decode($project["descr"]);?></p>
						
						<p>
							Url del video: <?php echo $project["url_video"];?><br/>
							Url del demo: <?php echo $project["url_demo"];?><br/>
						</p>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } else { ?>
	<br/><br/><p>Aun no han agregado proyectos.</p>
<?php } ?>
