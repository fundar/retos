<?php
/**
 * Access from index.php:
 */

class Default_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("default");
		
		$this->Templates     	  = $this->core("Templates");
		$this->Default_Model 	  = $this->model("Default_Model");
		$this->Github_Controller  = $this->controller("Github_Controller");
		$this->Twitter_Controller = $this->controller("Twitter_Controller");
		
		$this->Templates->theme();
		
		session_start();
	}
	
	public function index() {
		$vars["view"] = $this->view("home", true);
			
		$this->render("content", $vars);
	}
	
	public function auth($type = false) {
		if(isset($_SESSION['access_token'])) {
			header('Location:' . get("webURL") . "/callback/twitter");
		} else {
			if($type == "github") {
				$this->Github_Controller->redirect();
			} elseif($type == "twitter") {
				$this->Twitter_Controller->redirect();
			} else {
				return false;
			}
		}
	}
	
	public function callback($type = false) {
		if($type == "github") {
			$user = $this->Github_Controller->getUser();
		} elseif($type == "twitter") {
			if(empty($_SESSION['access_token']) || empty($_SESSION['access_token']['oauth_token']) || empty($_SESSION['access_token']['oauth_token_secret'])) {
				$user = $this->Twitter_Controller->getToken();
			} else {
				$user = $this->Twitter_Controller->getUser();
			}
		}		
		
		if(!$this->Default_Model->getUser($user)) {
			$this->Default_Model->saveUser($user);
		}
	
		//session - login / logout
	}
	
	private function login() {
		
	}
	
	private function logout() {
		
	}
}
