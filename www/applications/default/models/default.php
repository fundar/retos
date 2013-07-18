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
}
