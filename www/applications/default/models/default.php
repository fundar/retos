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
		$data = $this->Db->insert("users", $user, "user_id");
		
		return $data;
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
		$data["descr"]       = $_POST["descr"];
		$data["image_url"]   = $this->upload();
		
		if($data["title"] == "") {
			return array("error" => true);
		} elseif($data["descr"] == "") {
			return array("error" => true);
		} elseif($data["category_id"] == "") {
			return array("error" => true);
		}
		
		$data["slug"] = slug($data["title"]);
		
		if(!$data["image_url"]) {
			unset($data["image_url"]);
		}
		
		$result = $this->Db->insert("posts", $data, "post_id");
		
		if($result) {
			return $this->getPost($result);
		}
		
		return false;
	}
	
	
	public function getPost($post_id) {
		$query  = "select * from posts where post_id=" . $post_id;
		$data   = $this->Db->query($query);
		
		return $data;
	}
	
	public function getPostBySlug($slug) {
		$query  = "select * from posts where slug='" . $slug . "' limit 1";
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
		&& ($_FILES["file"]["size"] < 90000)
		&& in_array($extension, $allowedExts)) {
			if($_FILES["file"]["error"] > 0) {
				return false;
			} else {
				$this->Files = $this->core("Files");
				$upload = $this->Files->uploadImage("www/lib/uploads/");
				
				return $upload["medium"];
			}
		} else {
			return false;
		}
	}
}
