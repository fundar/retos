<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Default_Model extends ZP_Model {
	
	public function __construct() {
		$this->Db = $this->db();
		
		$this->helpers();
	}
	
	public function saveUser($user) {
		$fields = "";
		$values = "";
		
		foreach($user as $key => $value) {
			$fields .= $key   . ",";
			$values .= "'" . $value . "',";
		}
		
		$fields = rtrim($fields, ",");
		$values = rtrim($values, ",");
		
		$query  = "insert into users (" . $fields .") values (" . $values . ")";
		$data   = $this->Db->query($query);
		
		return true;
	}
	
	public function getUser($user) {
		$query  = "select * from users where id_user='" . $user["id_user"] . "' and type='" . $user["type"] . "'";
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getUserByID($user_id) {
		$query  = "select * from users where user_id=" . $user_id;
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getUserAdmin($user_id) {
		$query  = "select * from users where admin=true and user_id=" . $user_id;
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	/*Categories*/
	public function categories() {
		$query  = "select * from categories";
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	/*Projects*/
	public function getProjects() {
		$query = "select projects.*, categories.name as name_category from projects join categories on projects.category_id=categories.category_id";
		$data  = $this->Db->query($query);
		
		return $data;
	}
	
	public function addProject() {
		$data["category_id"] = $_POST["category_id"];
		$data["name"]        = $_POST["name"];
		$data["email"]       = $_POST["email"];
		$data["names"]       = $_POST["names"];
		$data["title"]       = $_POST["title"];
		$data["descr"]       = $_POST["descr"];
		$data["url_video"]   = $_POST["url-video"];
		$data["url_demo"]    = $_POST["url-demo"];
		
		if($data["name"] == "") {
			return array("error" => "Necesitas escribir el nombre del representante");
		} elseif(!isEmail($data["email"])) {
			return array("error" => "Necesitas escribir el email del representante");
		} elseif($data["names"] == "") {
			return array("error" => "Necesitas escribir los nombres de los integrantes");
		} elseif($data["title"] == "") {
			return array("error" => "Necesitas escribir el nombre del proyecto");
		} elseif($data["descr"] == "") {
			return array("error" => "Necesitas escribir la descripción del proyecto");
		} elseif($data["url_video"] == "") {
			return array("error" => "Necesitas escribir la url del video del proyecto");
		} elseif(!isset($_POST["terminos"])) {
			return array("error" => "Necesitas aceptar los términos y condiciones");
		}
		
		$result = $this->Db->insert("projects", $data, "project_id");
		
		/*
		if($result) {
			$to       = $data["email"];
			$subject  = "Gracias por enviar tu proyecto a ConectaDF";
			$message  = "Gracias por enviar tu proyecto a ConectaDF.";
			$message .= "Los jueces evaluarán tu propuesta de acuerdo a las bases. De requerir información adicional acerca de tu proyecto nos pondremos en contacto contigo,";
			$message .= " de manera que te pedimos estés pendiente a partir del 22 de agosto y hasta el 27, día en que serán anunciados los proyectos seleccionados.<br/><br/>";
			$message .= "Saludos<br/>";
			$message .= "El equipo OpenDataMx";
			$from     = "contacto@opendata.mx";
			$headers  = "From:" . $from;
			
			mail($to,$subject,$message,$headers);
		}
		*/
		
		return $result;
	}
	
	
	/*Posts*/
	public function addPost($user) {
		$data["user_id"]     = $user[0]["user_id"];
		$data["category_id"] = $_POST["category_id"];
		$data["title"]       = $_POST["title"];
		$data["abstract"]    = $_POST["abstract"];
		$data["descr"]       = $_POST["descr"];
		$data["status"]      = "false";
		$data["image_url"]   = $this->upload();
		
		if($data["title"] == "") {
			return array("error" => true);
		} elseif($data["abstract"] == "") {
			return array("error" => true);
		} elseif($data["descr"] == "") {
			return array("error" => true);
		} elseif($data["category_id"] == "") {
			return array("error" => true);
		}
		
		$data["slug"] = slug($data["title"]);
		
		if(!$data["image_url"]) {
			return array("error" => true);
		}
		
		$result = $this->Db->insert("posts", $data, "post_id");
		
		if($result) {
			return $this->getPost($result);
		}
		
		return false;
	}
	
	public function editPost($user) {
		$post_id 			 = $_POST["post_id"];
		$data["category_id"] = $_POST["category_id"];
		$data["title"]       = $_POST["title"];
		$data["abstract"]    = $_POST["abstract"];
		$data["descr"]       = $_POST["descr"];
		
		if($data["title"] == "") {
			return array("error" => true);
		} elseif($data["abstract"] == "") {
			return array("error" => true);
		} elseif($data["descr"] == "") {
			return array("error" => true);
		} elseif($data["category_id"] == "") {
			return array("error" => true);
		} elseif($_POST["post_id"] == "") {
			return array("error" => true);
		}
		
		$data["slug"] = slug($data["title"]);
		
		if($user[0]["admin"] == "t") {
			$data["status"] = $_POST["status"];
		}
		
		if($_FILES["file"]["name"] == "") {
			
		} else {
			$data["image_url"]   = $this->upload();
			
			if(!$data["image_url"]) {
				return array("error" => true);
			}
		}
		
		$result = $this->Db->update("posts", $data, "post_id=" . $post_id);
		
		if($result) {
			return $this->getPost($post_id);
		}
		
		return false;
	}
	
	public function getPost($post_id) {
		$query  = "select * from posts where post_id=" . $post_id;
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getAllPost($order = "post_id") {
		$queryc = "(select count(*) from comments where comments.post_id=posts.post_id) as count";
		$query  = "select posts.*, categories.name as category, " . $queryc . " from posts ";
		$query .= "join categories on posts.category_id=categories.category_id ";
		$query .= "where posts.status=true order by " . $order . " desc";
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getPostBySlug($slug, $user = false) {
		$queryc = "(select count(*) from comments where comments.post_id=posts.post_id) as count";
		$query  = "select posts.*, users.url, users.type as type_user, users.admin, users.name as name_user, categories.name as category, " . $queryc . " from posts ";
		$query .= "join users on posts.user_id=users.user_id ";
		$query .= "join categories on posts.category_id=categories.category_id ";
			
		if($user[0]["admin"] == "t") {
			$query .= "where slug='" . $slug . "' limit 1";
		} else {
			$query .= "where slug='" . $slug . "' and posts.status=true limit 1";
		}
		
		
		$data = $this->Db->query($query);
		
		if($data and is_array($data)) {
			return $data[0];
		}
		
		return false;
	}
	
	public function getEditPostBySlug($slug, $user) {
		$queryc = "(select count(*) from comments where comments.post_id=posts.post_id) as count";
		$query  = "select posts.*, categories.name as category, " . $queryc . " from posts join categories on posts.category_id=categories.category_id ";
		
		if(is_array($user)) {
			if($user[0]["admin"] == "t") {
				$query .= "where slug='" . $slug . "' limit 1";
			} else {
				$query .= "where slug='" . $slug . "' and user_id=" . $user[0]["user_id"] . "limit 1";
			}
		} else {
			return false;
		}
		
		$data = $this->Db->query($query);
		
		if($data and is_array($data)) {
			return $data[0];
		}
		
		return false;
	}
	
	public function getPostIDBySlug($slug) {
		$query  = "select post_id from posts where slug='" . $slug . "' and posts.status=true limit 1";
		$data   = $this->Db->query($query);
		
		if($data and is_array($data)) {
			return $data[0]["post_id"];
		}
		
		return false;
	}
	
	private function upload() {
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp        = explode(".", $_FILES["file"]["name"]);
		$extension   = end($temp);
		
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 900000)
		&& in_array($extension, $allowedExts)) {
			if($_FILES["file"]["error"] > 0) {
				return false;
			} else {
				$this->Files = $this->core("Files");
				$upload = $this->Files->uploadImage("www/lib/uploads/");
				
				return $upload["small"];
			}
		} else {
			return false;
		}
	}
	
	public function likePost($post_id) {
		$query  = "update posts set votes=(votes+1) where post_id=" . $post_id . " and status=true";
		$data   = $this->Db->query($query);
		
		return $this->getVotes($post_id);
	}
	
	public function getVotes($post_id) {
		$query  = "select votes from posts where post_id=" . $post_id . " and status=true";
		$data   = $this->Db->query($query);
		
		if($data) {
			return $data[0]["votes"];
		} else {
			return false;
		}
	}
	
	public function getAllPostByUser($user) {
		$user_id = $user[0]["user_id"];
		$admin   = $user[0]["admin"];

		$queryc  = "(select count(*) from comments where comments.post_id=posts.post_id) as count";
		$query   = "select posts.*, categories.name as category, " . $queryc . " from posts ";
		$query  .= "join categories on posts.category_id=categories.category_id ";
		
		if($admin == "f") {
			$query .= "where posts.user_id=" . $user_id . " order by post_id desc";
		} else {
			$query .= "order by post_id desc";
		}
		
		
		$data = $this->Db->query($query);
		
		return $data;
	}
	
	/*comments*/
	public function setComment($user_id, $slug, $comment, $parent_id) {
		$post_id = $this->getPostIDBySlug($slug);
		
		if(!$post_id) {
			return false;
		}
		$fields  = "post_id, user_id, comment, parent_id";
		$values  = $post_id . "," . $user_id . ",'" . $comment . "'," . $parent_id;
		
		$query  = "insert into comments (" . $fields .") values (" . $values . ")";
		$data   = $this->Db->query($query);
		
		return true;
	}
	
	public function getCommentsByPost($post_id) {
		/*falta validar el status en la consulta*/
		
		$query  = "select comments.*, users.name, users.url from comments join users on comments.user_id=users.user_id ";
		$query .= " where parent_id=0 and post_id=" . $post_id . " order by comment_id desc";
		$data   = $this->Db->query($query);
		
		
		if($data) {
			$i = 0;
			foreach($data as $key => $comment) {
				$comments[$i] = $comment;
				
				$childs = $this->getParentComments($comment["comment_id"]);
				
				if($childs) {
					$i++;
					
					foreach($childs as $child) {
						$comments[$i] = $child;
						$i++;
					}
				}
				
				$i++;
			}
			
			return $comments;
		}
		
		return false;
	}
	
	public function getParentComments($comment_id) {
		$query  = "select comments.*, users.name, users.url from comments join users on comments.user_id=users.user_id ";
		$query .= " where parent_id=" . $comment_id . " order by comment_id desc";
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function countCommentsByPost($post_id) {
		$query  = "select count(*) comments where post_id=" . $post_id;
		$data   = $this->Db->query($query);
		
		return $data;
	}
}
