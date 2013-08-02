<h3>M&aacute;ndanos tu proyecto</h3>
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
	
	Nombre del representante*: <input type="text" name="name" value="" /><br/>
	Correo del representante*: <input type="text" name="email" value="" /><br/>
	Nombres de los integrantes*: <textarea name="names"></textarea><br/>
	
	Nombre del proyecto*: <input type="text" name="title" value="" /><br/>
	Descripci&oacute;n*: <textarea name="descr" class="editme"></textarea><br/>
	
	Url del video explicando el proyecto*: <textarea name="url-video"></textarea><br/>
	Url del demo o algun otro recurso demostrativo (opcional): <textarea name="url-demo"></textarea><br/>
	
	Categor&iacute;a*: 
	<select name="category_id">
		<?php foreach($categories as $category) { ?>
			<option value="<?php echo $category["category_id"];?>">
				<?php echo utf8_decode($category["name"])	;?>
			</option>
		<?php } ?>
	</select>
	
	<br/>
	<input type="checkbox" name="terminos"value="ok" /> Acepto términos y condiciones
	
	<br/>
	*Campo obligatorio
	
	<input type="submit" name="send" value="Agregar" />
</form>
