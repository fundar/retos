<?php if(is_array($project)) { ?>
	<div class="large-12 columns">
		<a name="retos"></a>
		
		<a href="/list" title="Listado">Listado</a><br/><br/>
		
		<div>
			<?php if($offset-1 == -1) { ?>
			
			<?php } else { ?>
				<a href="/project/<?php echo $offset - 1;?>">Anterior</a> 
			<?php } ?>
			
			<?php if($offset+1 < 38) { ?>
				| <a href="/project/<?php echo $offset + 1;?>">Siguiente</a>
			<?php } ?>
			
			<span style="float:right;">
				<a href="/project/">Primero</a> | <a href="/project/36">Último</a>
			</span>
		</div><br/>
		
		<div class="row">
			<div class="large-12 columns">
				<div class="row">
					<h3><?php echo utf8_decode($project["title"]);?></h3>
					
					<p>Descripci&oacute;n: <?php echo utf8_decode($project["descr"]);?></p><br/>
					
					<p>
						Categor&iacute;a: <?php echo utf8_decode($project["name_category"]);?><br/>
						Url del video: <a target="_blank" href="<?php echo $project["url_video"];?>"><?php echo $project["url_video"];?></a><br/>
						Url del demo: <a target="_blank" href="<?php echo $project["url_demo"];?>"><?php echo $project["url_demo"];?></a><br/>
					</p>
					
					<p>
						Representante: <?php echo utf8_decode($project["name"]);?><br/>
						Correo: <?php echo utf8_decode($project["email"]);?><br/><br/>
						
						Integrantes: <?php echo utf8_decode($project["names"]);?>
					</p><br/><br/>
				</div>
			</div>
		</div><br/>
		
		<a href="/list" title="Listado">Listado</a><br/><br/>
		
		<div>
			<?php if($offset-1 == -1) { ?>
			
			<?php } else { ?>
				<a href="/project/<?php echo $offset - 1;?>">Anterior</a> 
			<?php } ?>
			
			<?php if($offset+1 < 38) { ?>
				| <a href="/project/<?php echo $offset + 1;?>">Siguiente</a>
			<?php } ?>
			
			<span style="float:right;">
				<a href="/project/">Primero</a> | <a href="/project/36">Último</a>
			</span>
		</div>
	</div>
<?php } else { ?>
	<br/><br/><p>Aun no han agregado proyectos.</p>
<?php } ?>
