<!DOCTYPE html>
<html lang="<?php print get("webLang"); ?>">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width" />
		<title>
			<?php print $this->getTitle(); ?>
		</title>
		
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->themePath; ?>/img/favicon.ico" />
		<link href="<?php echo $this->themePath; ?>/css/auth-buttons.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/foundation.css" />
		<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/fuentes/stylesheet.css" />
		<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/dialog.css" />
		
		<script src="<?php echo $this->themePath; ?>/js/vendor/custom.modernizr.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		
		<!-- Mozilla Persona -->
		<script src="http://www.google.com/jsapi?key=ABQIAAAA1XbMiDxx_BTCY2_FkPh06RRaGTYH6UMl8mADNa0YKuWNNa8VNxQEerTAUcfkyrr6OwBovxn7TDAH5Q"></script>
		<script type="text/javascript">google.load("mootools", "1.4");</script>
		<script src="https://browserid.org/include.js"></script>
		<script src="<?php echo $this->themePath; ?>/js/browserID.js"></script>
		<script type="text/javascript">
			window.addEvent('domready', function() {
				$('#login').click(function() {
					navigator.id.getVerifiedEmail(function(assertion) {
						if(assertion) {
							//got an assertion, now send it up to the server for verification
							verify(assertion);
						} else {
							window.location = "<?php echo get("webURL");?>";
						}
					});
				});
			});

			function verify(assertion) {
				var browserid = new BrowserID(assertion, {
					onComplete: function(response) {
						//if the server successfully verifies the assertion we
						//updating the UI by calling 'loggedIn()'
						if(response.status == 'okay') {
							window.location = "<?php echo get("webURL");?>";
							//otherwise we handle the login failure
						} else {
							failure(response)
						}    
					}
				})
			}

			function failure(f) {
				//do stuff with failure
				alert('Ocurrio un error');
			}
		</script>
   
	</head>
	<body>
	
		<!-- Header and Nav -->
		<div id="header">
			<div class="row">
				<div class="large-12 columns">
					<ul class="inline-list right">
						<li>
							<a target="_blank" class="hashtag" href="https://twitter.com/search?q=%23ConectaDF&src=typd">#ConectaDF</a>
						</li>
						
						<li>
							<a target="_blank" href="http://twitter.com/opendatamx" title="OpendataMX Twitter">
								<img src="<?php echo $this->themePath; ?>/img/twitter.jpg">
							</a>
						</li>
						
						<li>
							<a target="_blank" href="https://www.facebook.com/groups/opendatamx">
								<img src="<?php echo $this->themePath; ?>/img/facebook.jpg">
							</a>
						</li>
						
						<li class="ingreso">
							<?php if(isset($user) and is_array($user)) { ?>
								<a href="#" id="open-ingreso"title="ingresar">Bienvenido</a>
							<?php } else { ?>
								<a href="#" id="open-ingreso"title="ingresar">Ingresar</a>
							<?php } ?>
						</li>
					</ul>
					
					<div id="dialog">
						<?php if(isset($user) and is_array($user)) { ?>
							<span><?php echo $user[0]["name"];?></span><br />
						
							<img class="avatar" src="<?php echo $user[0]["image_url"];?>" alt="<?php echo $user[0]["name"];?>" /><br /><br />
							
							<a href="/add" title="Agregar reto">Agregar reto</a><br/><br/>
							
							<a href="/mis-ideas/#retos" title="Mis ideas">Mis ideas</a><br/><br/>
							
							<a href="/logout" title="logout">Salir</a>
						<?php } else { ?>
							<span>Conecta:</span>
						
							<a href="/auth/github" title="Sign in with GitHub">
								<img src="<?php echo $this->themePath; ?>/css/img/conecta-github-btn.png">
							</a>
							
							<a href="/auth/twitter" title="Sign in with Twitter">
								<img src="<?php echo $this->themePath; ?>/css/img/conecta-twitter-btn.png">
							</a>
							
							<a href="#" title="sign in with browser ID" id="login">
								<img src="<?php echo $this->themePath; ?>/css/img/conecta-mozilla-btn.png" alt="sign in with browser ID">
							</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div> 
		  

		<div id="header2"> 
		<div class="row">
		<div class="large-5 columns" style="padding-bottom: 18px;">
			<a href="/"><img src="<?php echo $this->themePath; ?>/img/ConectaDF_logo.png" style="height: 107px; width:367px !important"></a>
		</div>
		<div class="large-7 columns">
		<ul class="button-group right">
			
		<li><a href="/" class="button<?php echo (!segment(0) or segment(0) == "ordenar") ? " active-btn" : "";?>">Retos</a></li>
		<li><a href="/convocatoria" class="button<?php echo (segment(0) == "convocatoria") ? " active-btn" : "";?>">Convocatoria</a></li>
		<li><a href="/add" class="button<?php echo (segment(0) == "add") ? " active-btn" : "";?>">Sube tu idea</a></li>
		<li><a href="/submit" class="button<?php echo (segment(0) == "submit") ? " active-btn" : "";?>">Sube tu proyecto</a></li>
		<li><a href="/faqs" class="button<?php echo (segment(0) == "faqs") ? " active-btn" : "";?>">Preguntas frecuentes</a></li>
		</ul>
		</div>
		</div>
		</div>

		<!-- End Header and Nav -->
		  
		  <!-- Destacado -->
		 <?php if(!segment(0) or segment(0) == "ordenar") { ?>
			<div class="row">
			<div class="large-12 columns">
				<img src="<?php echo $this->themePath; ?>/img/destacado.jpg" style="margin: 50px auto 30px;">
			</div>
			</div>
		 <?php } ?>
		
