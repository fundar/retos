<?php
/**
 * Access from index.php:
 */


class Posts_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("default");
		
		$this->Default_Model = $this->model("Default_Model");
		$this->Templates     = $this->core("Templates");
	}
	
	public function add() {
		$user = $this->isUser();
		
		if($user) {
			
			if(isset($_POST["send"])) {
				$post = $this->Default_Model->addPost($user);
				
				if(is_array($post) and isset($post["error"])) {
					$vars["error"] = $post["error"];
				} else {
					header('Location:' . get("webURL") . "/reto/" . $post[0]["slug"]);
				}
			}
			
			$vars["user"]       = $user;
			$vars["categories"] = $this->Default_Model->categories();
			$vars["view"]       = $this->view("add", true);
			
			$this->render("content", $vars);
		} else {
			header('Location:' . get("webURL"));
		}
	}
	
	public function view($slug) {
		$vars["post"] = $this->Default_Model->getPostBySlug($slug);
		$vars["view"] = $this->view("single", true);
		
		$this->render("content", $vars);
	}
	
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
}
