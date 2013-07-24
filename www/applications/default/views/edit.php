	<h3>
		Editar - 
		<a href="/reto/<?php echo $post["slug"];?>" title="<?php echo utf8_decode($post["title"]);?>">
			<?php echo utf8_decode($post["title"]);?>
		</a>
	</h3>
	
	<?php if(isset($error)) { ?>
		<p>Ocurrio un error!</p>
	<?php } ?>
	
	<br />
	
	<?php if($post and is_array($post)) { ?>
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
			T&iacute;tulo: <input type="text" name="title" value="<?php echo utf8_decode($post["title"]);?>" /><br/>
	
			Abstract: 
			<textarea name="abstract"><?php echo utf8_decode($post["abstract"]);?></textarea><br/>
			
			Descripci&oacute;n: 
			<textarea name="descr" class="editme"><?php echo utf8_decode($post["descr"]);?></textarea><br/>
			
			<p>
				<img src="<?php echo get("webURL") . '/' . $post["image_url"];?>" title="<?php echo utf8_decode($post["title"]);?>" /><br/>
				Imagen (1MB Máximo - 473x335 píxeles): <input type="file" name="file" /><br/>
			</p>
			
			Categoría: 
			<select name="category_id">
				<?php foreach($categories as $category) { ?>
					<option value="<?php echo $category["category_id"];?>"<?php echo ($category["category_id"] == $post["category_id"]) ? 'selected="selected"': ""; ?>>
						<?php echo utf8_decode($category["name"])	;?>
					</option>
				<?php } ?>
			</select><br/>
			
			<input type="hidden" name="post_id" value="<?php echo $post["post_id"];?>" />
			<input type="submit" name="send" value="Editar" />
		</form>
	<?php } else { ?>
		<p>El reto no existe</p>
		
		<p>
			<a href="/add">Agregar reto</a>
		</p>
	<?php } ?>
