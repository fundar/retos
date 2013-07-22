<!DOCTYPE html>
<html lang="<?php print get("webLang"); ?>">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		 <meta name="viewport" content="width=device-width" />
		<title><?php print $this->getTitle(); ?></title>
		
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->themePath; ?>/img/favicon.ico" />
		<link href="<?php echo $this->themePath; ?>/css/auth-buttons.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/foundation.css" />
		<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/fuentes/stylesheet.css" />
		<link rel="stylesheet" href="<?php echo $this->themePath; ?>/css/dialog.css" />
		
		<script src="<?php echo $this->themePath; ?>/js/vendor/custom.modernizr.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
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
							
							<a href="/logout" title="logout">Salir</a>
						<?php } else { ?>
							<span>Conecta con:</span>
						
							<a href="/auth/github" title="Sign in with GitHub">
								<img src="<?php echo $this->themePath; ?>/css/img/github-conecta.png">
							</a>
							
							<a href="/auth/twitter" title="Sign in with Twitter">
								<img src="<?php echo $this->themePath; ?>/css/img/twitter-conecta.png">
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
		<li><a href="/" class="button">Home</a></li>
		<li><a href="/convocatoria" class="button">Convocatoria</a></li>
		<!-- <li><a href="#" class="button">Sube tu idea</a></li> -->
		<li><a href="/faqs" class="button">Preguntas frecuentes</a></li>
		</ul>
		</div>
		</div>
		</div>

		<!-- End Header and Nav -->
		  
		  <!-- Destacado -->
		 <?php if(!segment(0)) { ?>
			<div class="row">
			<div class="large-12 columns">
				<img src="<?php echo $this->themePath; ?>/img/destacado.jpg" style="margin: 50px auto 30px;">
			</div>
			</div>
		 <?php } ?>
		
