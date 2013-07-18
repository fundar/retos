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
	}
	
	public function index() {
		$vars["user"] = $this->isUser();
		$vars["view"] = $this->view("home", true);
			
		$this->render("content", $vars);
	}
	
	public function auth($type = false) {
		if(isset($_SESSION['access_token'])) {
			header('Location:' . get("webURL") . "/callback/" . $type);
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
		if(isset($_SESSION['access_token'])) {
			if($type == "github") {
				$user = $this->Github_Controller->getUser();
			} elseif($type == "twitter") {
				$user = $this->Twitter_Controller->getUser();
			} else {
				header('Location:' . get("webURL"));
			}
		} else {
			if($type == "github") {
				$user = $this->Github_Controller->getToken();
				
				if($user) {
					$user = $this->Github_Controller->getUser();
				} else {
					header('Location:' . get("webURL"));
				}
			} elseif($type == "twitter") {
				$user = $this->Twitter_Controller->getToken();
				
				if($user) {
					$user = $this->Twitter_Controller->getUser();
				} else {
					header('Location:' . get("webURL"));
				}
				
			} else {
				header('Location:' . get("webURL"));
			}	
		}
		
		$data = $this->Default_Model->getUser($user);
		
		if($data) {
			$_SESSION['user_id'] = $data[0]["user_id"];
		} else {
			$this->Default_Model->saveUser($user);
			$user = $this->Default_Model->getUser($user);
			
			$_SESSION['user_id'] = $user[0]["user_id"];
		}
		
		header('Location:' . get("webURL"));
	}
	
	
	/*Posts*/
	public function add() {
		$this->Posts_Controller = $this->controller("Posts_Controller");
		$this->Posts_Controller->add();
	}
	
	public function view($slug) {
		$this->Posts_Controller = $this->controller("Posts_Controller");
		$this->Posts_Controller->view($slug);
	}
	
	/*Validate user & logout*/
	public function isUser() {
		if(isset($_SESSION['access_token'])) {
			$user_id = $_SESSION['user_id'];
			$user	 = $this->Default_Model->getUserByID($_SESSION['user_id']);
			
			if($user) {
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	
	public function logout() {
		session_unset(); 
		session_destroy();
		
		header('Location:' . get("webURL"));
	}
}
