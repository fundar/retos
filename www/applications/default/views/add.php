<h3>Agregar reto</h3>
<script type="text/javascript" src="<?php echo $this->themePath; ?>/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
	tinymce.init({
		menubar:false,
		selector: "textarea.editme",
		plugins: [
			"autolink lists link nchor"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	});
</script>
	
<form method="POST" enctype='multipart/form-data' action="">
	<?php if(isset($error)) { ?>
		<p>Ocurrio un error!</p>
	<?php } ?>
	
	<br />
	
	T&iacute;tulo: <input type="text" name="title" value="" /><br/>
	
	Abstract: <textarea name="abstract"></textarea><br/>
	Descripci&oacute;n: <textarea name="descr" class="editme"></textarea><br/>
	
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
	
	<input type="submit" name="send" value="Agregar" />
</form>
