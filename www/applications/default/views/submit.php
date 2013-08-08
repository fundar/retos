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
		<p class="color-red"><?php echo $error;?></p>
	<?php } ?>
	
	<br />
	
	Nombre del representante*: <input type="text" name="name" value="<?php echo (isset($_POST["name"])) ? $_POST["name"]: ""; ?>" /><br/>
	Correo del representante*: <input type="text" name="email" value="<?php echo (isset($_POST["email"])) ? $_POST["email"]: ""; ?>" /><br/>
	Nombres de los integrantes*: <textarea name="names"><?php echo (isset($_POST["names"])) ? $_POST["names"]: ""; ?></textarea><br/>
	
	Nombre del proyecto*: <input type="text" name="title" value="<?php echo (isset($_POST["title"])) ? $_POST["title"]: ""; ?>" /><br/>
	Descripci&oacute;n*: <textarea name="descr" class="editme"><?php echo (isset($_POST["descr"])) ? $_POST["descr"]: ""; ?></textarea>
	<p>Asegúrate de explicar como contribuyes a la problemática de la movilidad urbana así como el tipo de datos asociados que se generarían, analizarían o difundirían. Explica las funcionalidades con detalle y el valor agregado par los usuarios, los convocantes u otro actor relacionado con la problemática. Comenta qué tipo de modelo de sustentabilidad podría aplicarse a la propuesta.</p>
	
	<br/>
	
	Url del video explicando el proyecto*: <input type="text" name="url-video" value="<?php echo (isset($_POST["url-video"])) ? $_POST["url-video"]: ""; ?>" />
	<p>Trata de que tu video no pase de 3 minutos. Intenta ejemplificar el uso cotidiano y no dejes fuera los detalles importantes de valor agreado que distingan a tu propuesta.</p>
	
	<br/>
	
	Url del demo o algun otro recurso demostrativo: <input type="text" name="url-demo" value="<?php echo (isset($_POST["url-demo"])) ? $_POST["url-demo"]: ""; ?>" />
	<p>El demo es opcional pero si se incluye es un factor que puede ayudar positivamente a la decisión de los jueces (sugerimos servicios de distribución de demos como <a href="https://app.io/">Kickfolio</a> o <a href="https://testflightapp.com/">TestFlight</a>).</p>
	
	<br/>
	Categor&iacute;a*: 
	<select name="category_id">
		<?php foreach($categories as $category) { ?>
			<option value="<?php echo $category["category_id"];?>">
				<?php echo utf8_decode($category["name"])	;?>
			</option>
		<?php } ?>
	</select>
	<p>Sí tu aplicación ya está en algúna tienda en línea (appstore, Google Play, etc) debes usar la categoría Apps pre-existentes)</p>
	
	<br/>
	<input type="checkbox" name="terminos" value="ok" /> He leído, entiendo y acepto los términos de participación
	
	<br/><br/>
	<p>
		El envío de esta propuesta no implica cesión de derechos de autor en los desarrollos.<br/>
		El envío de la propuesta implica que, de resultar seleccionada, los participantes aceptan facilitar a las instituciones convocantes un esquema automatizado de acceso a los datos generados por el uso de los desarrollos. Dichos datos quedarán licenciados en términos de la licencia ODC Open Database License (ODbL) <a href="http://opendatacommons.org/licenses/odbl/">http://opendatacommons.org/licenses/odbl/</a><br/>
		El envío de la propuesta implica la aceptación de los términos descritos en la convocatoria.<br />
	</p>
	
	<br/>
	*Campo obligatorio
	<br/><br/>
	
	<input type="submit" name="send" value="Enviar" />
</form>
