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
		<p>
			<?php echo $error;?>
		</p>
	<?php } ?>
	
	<br />
	
	Nombre del representante*: <input type="text" name="name" value="<?php echo (isset($_POST["name"])) ? $_POST["name"]: ""; ?>" /><br/>
	Correo del representante*: <input type="text" name="email" value="<?php echo (isset($_POST["email"])) ? $_POST["email"]: ""; ?>" /><br/>
	Nombres de los integrantes*: <textarea name="names"><?php echo (isset($_POST["names"])) ? $_POST["names"]: ""; ?></textarea><br/>
	
	Nombre del proyecto*: <input type="text" name="title" value="<?php echo (isset($_POST["title"])) ? $_POST["title"]: ""; ?>" /><br/>
	Descripci&oacute;n*: <textarea name="descr" class="editme"><?php echo (isset($_POST["descr"])) ? $_POST["descr"]: ""; ?></textarea><br/>
	
	Url del video explicando el proyecto*: <input type="text" name="url-video" value="<?php echo (isset($_POST["url-video"])) ? $_POST["url-video"]: ""; ?>" /><br/>
	Url del demo o algun otro recurso demostrativo (opcional): <input type="text" name="url-demo" value="<?php echo (isset($_POST["url-demo"])) ? $_POST["url-demo"]: ""; ?>" /><br/>
	
	Categor&iacute;a*: 
	<select name="category_id">
		<?php foreach($categories as $category) { ?>
			<option value="<?php echo $category["category_id"];?>">
				<?php echo utf8_decode($category["name"])	;?>
			</option>
		<?php } ?>
	</select>
	
	<br/>
	<input type="checkbox" name="terminos" value="ok" /> Acepto t&eacute;rminos y condiciones
	
	<br/>
	*Campo obligatorio
	
	<input type="submit" name="send" value="Agregar" />
</form>
