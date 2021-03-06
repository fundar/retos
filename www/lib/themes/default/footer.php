            
<!-- Footer -->
<footer id="footer">
    <div class="row">
		<div class="large-12 columns">
			<a target="_blank" href="http://www.setravi.df.gob.mx" title="Setravi">
				<img class="logo-1" src="<?php echo $this->themePath; ?>/img/setravi-logo.jpg">
			</a>
		</div>
		
		<div class="row">
			<div class="large-6 columns colaboradores bordo">En alianza con:<br>
				<a target="_blank" href="http://mexico.itdp.org" title="ITDP México">
					<img src="<?php echo $this->themePath; ?>/img/itdp.jpg">
				</a>
				
				<a target="_blank" href="http://fundar.org.mx" title="Fundar, Centro de Análisis e Investigación">
					<img src="<?php echo $this->themePath; ?>/img/fundar.jpg">
				</a>
				
				<a target="_blank" href="http://www.labplc.mx" title="Laboratorio para la ciudad">
					<img src="<?php echo $this->themePath; ?>/img/laboratorio-para-la-ciudad.jpg">
				</a>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<a target="_blank" href="http://datosabiertos.df.gob.mx/" title="Datos abiertos DF">
					<img src="<?php echo $this->themePath; ?>/img/datos-abiertos-df.jpg">
				</a>
				
				<a target="_blank" href="http://uc.edu.mx/" title="Universidad de la comunicación">
					<img src="<?php echo $this->themePath; ?>/img/uc.jpg">
				</a>
			</div>
			
			<div class="large-6 columns colaboradores">Un evento de:<br>
				<a target="_blank" href="http://opendata.mx" title="OpenDataMX">
					<img src="<?php echo $this->themePath; ?>/img/OpenDataMX.jpg">
				</a>
			</div>
		</div>
         
    </div>
</footer>

<footer id="footer2">
	<div class="row">
		<div class="large-12 columns">
		<div class="row pie2">
		  <div class="small-3 columns">

		<p class="redes fb">&Uacute;nete a nuestra comunidad:<br>
		<a href="https://www.facebook.com/groups/opendatamx" target="_blank">opendatamx</a></p>
		</div>
		<div class="small-3 columns">
		<p class="redes tw">S&iacute;guenos en:<br>
		<a href="http://twitter.com/opendatamx" target="_blank">twitter.com/opendatamx</a></p>
		</div>
		<div class="small-3 columns">
		<p class="redes correo">Si prefieres escrbenos a:<br>
		<span><a href="mailto:contacto@opendata.mx">contacto@opendata.mx</a></span></p>
		</div>
			<div class="small-3 columns">
				<a href="/" title="Conectadf.mx">
					<img class="logo-conectaDF" src="<?php echo $this->themePath; ?>/img/ConectaDF_logo-pie.png">
				</a>
			</div>
		</div>
		<hr />
		<div class="row">
		<div class="large-6 columns derechos">
		  <p class="">&copy; 2013 CONECTADF | Todos los derechos reservados.</p>
		</div>
		<div class="large-6 columns">
		  <ul class="inline-list right code">
			<li><a  href="http://fundar.org.mx" target="_blank" title="Fundar">Coded by FundarLabs</a></li>
			<li><a  href="http://akora.mx" target="_blank" title="Akora">Designed by Akora</a></li>

		  </ul>
		</div>
		</div>
	</div> 
</footer>

	<script type="text/javascript">
		$('#open-ingreso').click(function() {
			$('#dialog').toggle();
		});
	</script>
 
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? '<?php echo $this->themePath; ?>/js/vendor/zepto' : '<?php echo $this->themePath; ?>/js/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <script src="<?php echo $this->themePath; ?>/js/foundation.min.js"></script>

  
  <script>
    $(document).foundation();
  </script>
  
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-21808432-5', 'conectadf.mx');
		ga('send', 'pageview');
	</script>
</body>
</html>
