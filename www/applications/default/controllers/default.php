<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Default_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("default");
		
		$this->Templates     	  = $this->core("Templates");
		$this->Default_Model 	  = $this->model("Default_Model");
		
		$this->Github_Controller  = $this->controller("Github_Controller");
		$this->Twitter_Controller = $this->controller("Twitter_Controller");
		$this->Persona_Controller = $this->controller("Persona_Controller");
		
		$this->Templates->theme();
	}
	
	public function index() {
		$vars["user"]  = $this->isUser();
		$vars["posts"] = $this->Default_Model->getAllPost();
		$vars["view"]  = $this->view("home", true);
		
		$this->render("content", $vars);
	}
	
	public function projects() {
		$this->title("Proyectos");
		
		$user = $this->isUser();
		
		if($user) {
			if($user[0]["admin"] == "t") {
				$vars["user"]     = $this->isUser();
				$vars["projects"] = $this->Default_Model->getProjects();
				$vars["view"]     = $this->view("projects", true);
				
				$this->render("content", $vars);
			} else {
				header('Location:' . get("webURL"));
			}
		} else {
			header('Location:' . get("webURL"));
		}
	}
	
	public function project($offset = 0) {
		$this->title("Proyectos");
		
		$user = $this->isUser();
		
		if($user) {
			if($user[0]["admin"] == "t") {
				$vars["user"]     = $this->isUser();
				$vars["project"]  = $this->Default_Model->getProject($offset);
				$vars["offset"]   = $offset;
				$vars["view"]     = $this->view("project", true);
				
				
				$this->render("content", $vars);
			} else {
				header('Location:' . get("webURL"));
			}
		} else {
			header('Location:' . get("webURL"));
		}
	}
	
	public function getProjectsList() {
		$this->title("Proyectos");
		
		$user = $this->isUser();
		
		if($user) {
			if($user[0]["admin"] == "t") {
				$vars["user"]     = $this->isUser();
				$vars["projects"] = $this->Default_Model->getProjects();
				$vars["view"]     = $this->view("list", true);
				
				$this->render("content", $vars);
			} else {
				header('Location:' . get("webURL"));
			}
		} else {
			header('Location:' . get("webURL"));
		}
	}
	
	public function submit() {
		header('Location:' . get("webURL"));
		
		/*
		$this->title("Sube tu proyecto");
		
		$vars["user"] = $this->isUser();
		
		if(isset($_POST["send"])) {
			$project = $this->Default_Model->addProject($user);
				
			if(is_array($project) and isset($project["error"]) or $project == false) {
				if($project == false) {
					$project["error"] = "Ocurrio un error, revisa todos los campos";
				}
				
				$vars["error"] 	    = $project["error"];
				$vars["categories"] = $this->Default_Model->categories();
				$vars["view"]  		= $this->view("submit", true);
			} else {
				$vars["view"] = $this->view("submit-successful", true);
			}
		} else {
			$vars["categories"] = $this->Default_Model->categories();
			$vars["view"] 	    = $this->view("submit", true);
		}
		
		$this->render("content", $vars);
		*/
	}
	
	public function order($type = false) {
		if($type == "comentarios") {
			$posts = $this->Default_Model->getAllPost("count");
		} elseif($type == "votos") {
			$posts = $this->Default_Model->getAllPost("votes");
		} else {
			header('Location:' . get("webURL"));
		}
		
		$vars["user"]  = $this->isUser();
		$vars["posts"] = $posts;
		$vars["view"]  = $this->view("home", true);
		
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
			} elseif($type == "persona") {
				$user = $this->Persona_Controller->getUser();
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
			} elseif($type == "persona") {
				$user = $this->Persona_Controller->getUser();
				
				if($user) {
					
				} else {
					echo json_encode(array('status'=>'failure', 'reason'=> "Error"));
					die();
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
		
		if($type == "persona") {
			echo json_encode(array('status'=>'okay', 'email' => $user["email"]));
		} else {
			header('Location:' . get("webURL"));
		}
	}
	
	
	/*Posts*/
	public function add() {
		header('Location:' . get("webURL"));
		
		//$this->title("Sube tu idea");
		
		/*quitar el true cuando ya pueden subir todos los usuarios*/
		/*
		$user = $this->isUser();
		
		if($user) {
			if(isset($_POST["send"])) {
				$post = $this->Default_Model->addPost($user);
				
				if(is_array($post) and isset($post["error"])) {
					$vars["error"] 		= $post["error"];
					$vars["user"]       = $user;
					$vars["categories"] = $this->Default_Model->categories();
					$vars["view"]       = $this->view("add", true);
				} else {
					$vars["user"] = $user;
					$vars["view"] = $this->view("add-successful", true);
					// header('Location:' . get("webURL") . "/reto/" . $post[0]["slug"]);
				}
			} else {
				$vars["user"]       = $user;
				$vars["categories"] = $this->Default_Model->categories();
				$vars["view"]       = $this->view("add", true);
			}
			
			$this->render("content", $vars);
		} else {
			$vars["view"] = $this->view("ingresar-error", true);
			
			$this->render("content", $vars);
		}
		*/
	}
	
	public function viewPost($slug) {
		
		/*Comentarios - Ajax*/
		/*
		if(isset($_POST["comment"]) and isset($_POST["slug"])) {
			if($_POST["comment"] != "" and $slug == $_POST["slug"]) {
				$user = $this->isUser();
				
				if($user) {
					$comment = $this->Default_Model->setComment($user[0]["user_id"], $slug, $_POST["comment"], $_POST["parent_id"]);
					
					if($comment) {
						echo "true";
					} else {
						echo "false";
					}
				} else {
					echo "false";
				}
			} else {
				echo "false";
			}			
			
			die();
		}
		*/
		
		/*view post*/
		if($slug == "") {
			header('Location:' . get("webURL"));
		}
		
		$vars["user"] = $this->isUser();
		$vars["post"] = $this->Default_Model->getPostBySlug($slug, $vars["user"]);
		
		if(isset($vars["post"]["post_id"])) {
			$this->title(utf8_decode($vars["post"]["title"]));
			$vars["comments"] = $this->Default_Model->getCommentsByPost($vars["post"]["post_id"]);
		} else {
			$vars["comments"] = false;
		}
		
		$vars["view"] = $this->view("single", true);
		
		$this->render("content", $vars);
	}
	
	public function edit($slug = false) {
		$this->title("Editar idea");
		
		$user = $this->isUser();
		
		if($user and $slug) {
			/*
			if(isset($_POST["send"])) {
				$post = $this->Default_Model->editPost($user);
				
				if(is_array($post) and isset($post["error"])) {
					$vars["error"] = $post["error"];
				} else {
					header('Location:' . get("webURL") . "/reto/" . $post[0]["slug"]);
				}
			}
			*/
			$vars["user"]	    = $user;
			$vars["categories"] = $this->Default_Model->categories();
			$vars["post"] 		= $this->Default_Model->getEditPostBySlug($slug, $user);
			$vars["view"] 		= $this->view("edit", true);
			
			$this->render("content", $vars);
		} else {
			header('Location:' . get("webURL"));
		}
	}
	
	public function myPosts() {
		$this->title("Mis ideas");
		
		$user = $this->isUser();
		
		if($user) {
			$vars["posts"] = $this->Default_Model->getAllPostByUser($user);
			$vars["user"]  = $this->isUser();
			$vars["view"]  = $this->view("home-user", true);
			
			$this->render("content", $vars);
		} else {
			header('Location:' . get("webURL"));
		}	
		
	}
	
	public function like($post_id) {
		/*
		if(is_numeric($post_id)) {
			if(isset($_COOKIE['vote_' . $post_id])) {
				echo "false";
			} else {
				setcookie("vote_" . $post_id, "post_id", time() + 365 * 24 * 60 * 60);
				echo $this->Default_Model->likePost($post_id);
			}
		} else {
			echo "false";
		}
		*/
	}
	
	public function faqs() {
		$this->title("Preguntas frecuentes");
		
		$vars["user"] = $this->isUser();
		$vars["view"] = $this->view("faqs", true);
		
		$this->render("content", $vars);
	}
	
	public function convocatoria() {
		$this->title("Convocatoria");
		
		$vars["user"] = $this->isUser();
		$vars["view"] = $this->view("convocatoria", true);
		
		$this->render("content", $vars);	
	}
	
	/*Validate user & logout*/
	public function isUser($admin = false) {
		if(isset($_SESSION['access_token'])) {
			$user_id = $_SESSION['user_id'];
			
			if($admin) {
				$user = $this->Default_Model->getUserAdmin($_SESSION['user_id']);
			} else { 
				$user = $this->Default_Model->getUserByID($_SESSION['user_id']);
			}
			
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
