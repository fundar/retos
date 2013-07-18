<?php if($user and is_array($user)) { ?>
	<p>Bienvenido: <?php echo $user[0]["name"];?></p> 
	
	<p>
		Tipo: <?php echo $user[0]["type"];?>
	</p>
	
	<p>
		<img src="<?php echo $user[0]["image_url"];?>" alt="<?php echo $user[0]["name"];?>" />
	</p>
	
	
	<p>
		<a href="/add" title="Add project">Add project</a>
	</p>
	
	<p>
		<a href="/view/" title="View project">View project</a>
	</p>
	
	<p>
		<a href="/edit/" title="Add project">Edit project</a>
	</p>
	
	<p>
		<a href="/logout" title="logout">logout</a>
	</p>
	
<?php } else { ?>
	<p>
		<a class="btn-auth btn-github" href="/auth/github" title="Sign in with GitHub">Sign in with <b>GitHub</b></a>
		<a class="btn-auth btn-twitter" href="/auth/twitter" title="Sign in with Twitter">Sign in with <b>Twitter</b></a>
	</p>
<?php } ?>
