<form method="POST" enctype='multipart/form-data' action="">
	<?php if(isset($error)) { ?>
		<p>Error en algo!</p>
	<?php } ?>
	
	T&iacute;tulo: <input type="text" name="title" value="" /><br/>
	Abstract: <input type="text" name="abstract" value="" /><br/>
	Descripci&oacute;n: <input type="text" name="descr" value="" /><br/>
	Imagen: <input type="file" name="file" /><br/>
	
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

<p>
	<a href="/" title="Home">Home</a>
</p>

<p>
	<a href="/logout" title="logout">logout</a>
</p>
