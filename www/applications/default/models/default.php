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
		$query  = "select posts.*, categories.name as category from posts join categories on posts.category_id=categories.category_id ";
		$query .= "where posts.status=true";
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getPostBySlug($slug) {
		$query  = "select posts.*, categories.name as category from posts join categories on posts.category_id=categories.category_id ";
		$query .= "where slug='" . $slug . "' and posts.status=true limit 1";
		$data   = $this->Db->query($query);
		
		if($data and is_array($data)) {
			return $data[0];
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
}
