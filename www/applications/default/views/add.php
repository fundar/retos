<form method="POST" enctype='multipart/form-data' action="">
	<?php if(isset($error)) { ?>
		<p>Ocurrio un error!</p>
	<?php } ?>
	
	<br />
	
	T&iacute;tulo: <input type="text" name="title" value="" /><br/>
	
	Abstract: <textarea name="abstract"></textarea><br/>
	Descripci&oacute;n: <textarea name="descr"></textarea><br/>
	
	Imagen (1MB Máximo - 473x335 píxeles): <input type="file" name="file" /><br/>
	
	Categoría: 
	<select name="category_id">
		<?php foreach($categories as $category) { ?>
			<option value="<?php echo $category["category_id"];?>">
				<?php echo utf8_decode($category["name"])	;?>
			</option>
		<?php } ?>
	</select>
	
	<br/>
	
	<input type="submit" name="send" value="enviar" />
</form>
