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
	
	/*Posts*/
	public function addPost($user) {	
		$data["user_id"]     = $user[0]["user_id"];
		$data["category_id"] = $_POST["category_id"];
		$data["title"]       = $_POST["title"];
		$data["abstract"]    = $_POST["abstract"];
		$data["descr"]       = $_POST["descr"];
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
	
	
	public function getPost($post_id) {
		$query  = "select * from posts where post_id=" . $post_id . " and status=true";
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getAllPost() {
		$queryc = "(select count(*) from comments where comments.post_id=posts.post_id) as count";
		$query  = "select posts.*, categories.name as category, " . $queryc . " from posts ";
		$query .= "join categories on posts.category_id=categories.category_id ";
		$query .= "where posts.status=true order by post_id desc";
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getPostBySlug($slug) {
		$queryc = "(select count(*) from comments where comments.post_id=posts.post_id) as count";
		$query  = "select posts.*, categories.name as category, " . $queryc . " from posts join categories on posts.category_id=categories.category_id ";
		$query .= "where slug='" . $slug . "' and posts.status=true limit 1";
		$data   = $this->Db->query($query);
		
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
	
	/*comments*/
	public function setComment($user_id, $slug, $comment) {
		$post_id = $this->getPostIDBySlug($slug);
		
		if(!$post_id) {
			return false;
		}
		$fields  = "post_id, user_id, comment";
		$values  = $post_id . "," . $user_id . ",'" . $comment . "'";
		
		$query  = "insert into comments (" . $fields .") values (" . $values . ")";
		$data   = $this->Db->query($query);
		
		return true;
	}
	
	public function getCommentsByPost($post_id) {
		/*falta validar el status en la consulta*/
		
		$query  = "select comments.*, users.name, users.url from comments join users on comments.user_id=users.user_id ";
		$query .= " where post_id=" . $post_id;
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function countCommentsByPost($post_id) {
		$query  = "select count(*) comments where post_id=" . $post_id;
		$data   = $this->Db->query($query);
		
		return $data;
	}
}
