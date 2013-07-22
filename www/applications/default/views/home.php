<?php if($user and is_array($user)) { ?>
	<p>Bienvenido: 
		<a href="<?php echo $user[0]["url"];?>" title="<?php echo utf8_decode($user[0]["name"]);?>">
			<?php echo utf8_decode($user[0]["name"]);?>
		</a>
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
			<?php $i=1;?>
			<?php foreach($posts as $post) { ?>
				<?php if($i == 5) { ?>
					<?php $i=0; ?>
					<div class="row top">
				<?php } ?>
				
				<!-- Retos th. Fila 1 -->  
				<div class="large-3 small-6 columns">
					<a href="/reto/<?php echo $post["slug"];?>" title="<?php echo utf8_decode($post["title"]);?>">
						<img src="<?php echo get("webURL") . '/' . $post["image_url"];?>" title="<?php echo utf8_decode($post["title"]);?>"/>
					</a>
					
					<a href="/reto/<?php echo $post["slug"];?>" title="<?php echo utf8_decode($post["title"]);?>">
						<h6 class="panel">
							<?php echo utf8_decode($post["title"]);?>
						</h6>
					</a>
					
					<div class="panel callout stats  reto">
						<ul class="social-stats">
							<li>
								<p class="like like-post vote<?php echo $post["post_id"];?>" value="<?php echo $post["post_id"];?>">
									<?php echo $post["votes"];?>
								</p>
							</li>
							<li><p class="opinion"><?php echo $post["count"];?> Comentarios</p></li>
						</ul>			
					</div>
				</div>
				
				<?php if($i==0) { ?>
					</div>
				<?php } ?>
				
				<?php $i++; ?>
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
