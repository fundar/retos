<?php if($user and is_array($user)) { ?>
	<p>Bienvenido: 
		<a href="<?php echo $user[0]["url"];?>" title="<?php echo utf8_decode($user[0]["name"]);?>">
			<?php echo utf8_decode($user[0]["name"]);?>
		</a>
	</p> 
	
	<p>
		Tipo: <?php echo $user[0]["type"];?>
	</p>
	
	<p>
		<img src="<?php echo $user[0]["image_url"];?>" alt="<?php echo $user[0]["name"];?>" />
	</p>
	
	
	<?php if($user[0]["admin"] == "t") { ?>
		<p>
			<a href="/add" title="Add project">Add project</a>
		</p>
	<?php } ?>
	
	<p>
		<a href="/logout" title="logout">logout</a>
	</p>
<?php } else { ?>
	<p>
		<a class="btn-auth btn-github" href="/auth/github" title="Sign in with GitHub">Sign in with <b>GitHub</b></a>
		<a class="btn-auth btn-twitter" href="/auth/twitter" title="Sign in with Twitter">Sign in with <b>Twitter</b></a>
	</p>
<?php } ?>
	
<?php if(is_array($posts)) { ?>
	<div class="large-12 columns">
		<h3>Ideas</h3>	
		
		<div class="row">
			<?php foreach($posts as $post) { ?>
				<!-- Retos th. Fila 1 -->  
				<div class="large-3 small-6 columns">
					<img src="<?php echo get("webURL") . '/' . $post["image_url"];?>" title="<?php echo utf8_decode($post["title"]);?>"/>
					<h6 class="panel">
						<?php echo utf8_decode($post["title"]);?>
					</h6>
					
					<p class="panel callout">
						Comentarios <?php echo $post["count"];?>
						
						<span class="like-post" value="<?php echo $post["post_id"];?>"> Like</span>
						&nbsp;<span class="votes vote<?php echo $post["post_id"];?>"><?php echo $post["votes"];?></span>
					</p>
				</div>
			<?php } ?>
		</div>
	</div>
	
	<script type="text/javascript">
		$(document).ready( function () {
			$(".like-post").click( function () {
				id = $(this).attr("value");
				
				$.ajax({
					url: "/like/" + id
				}).done(function (data) {
					if(data == "false") {
						
					} else {
						$(".vote" + id).text(data);
					}
				});
			});
		});
	</script>
<?php } ?>
