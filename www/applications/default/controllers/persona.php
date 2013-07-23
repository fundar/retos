<?php
/**
 * Access from index.php:
 */


class Persona_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("default");
		
		$this->Templates = $this->core("Templates");
	}
	
	public function getUser() {
		$Persona = $this->library("persona", "persona", array($_SERVER['HTTP_HOST'], $_POST['assertion']));
		
		if($Persona->verify_assertion()) {
			$email = $Persona->getEmail();
			$array = explode('@', $email);
			
			$user["email"]     = $email;
			$user["name"]      = $array[0];
			$user["type"]      = "persona";
			$user["image_url"] = "";
			$user["url"]       = "";
			$user["id_user"]   = $email;
			
			$_SESSION['access_token'] = $email;
			
			return $user;
			
		} else {
			return false;
		}
	}
}
