<?php if(is_array($projects)) { ?>
	<div class="large-12 columns">
		<a name="retos"></a>
		<h3>Proyectos</h3>
		
		<div class="row">
			<ol>
				<?php foreach($projects as $key => $project) { ?>
					<li>
						<a href="/project/<?php echo $key;?>">
							<?php echo utf8_decode($project["title"]);?>
						</a>
					</li>
				<?php } ?>
			</ol>
		</div>
	</div>
<?php } else { ?>
	<br/><br/><p>Aun no han agregado proyectos.</p>
<?php } ?>
