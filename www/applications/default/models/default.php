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
		if($user["type"] == "github") {
			$fields = "name, email, id_user, type";
			$values = "'" . $user["name"] . "','" . $user["email"] . "','" . $user["id_user"] . "','" . $user["type"] . "'";
		}
		
		$query  = "insert into users (" . $fields .") values (" . $values . ")";
		$data   = $this->Db->query($query);
		
		return true;
	}
	
	public function getUser($user) {
		$query  = "select * from users where id_user='" . $user["id_user"] . "' and type='" . $user["type"] . "'";
		$data   = $this->Db->query($query);
		
		if($data) {
			return true;
		} else {
			return false;
		}
	}
}
