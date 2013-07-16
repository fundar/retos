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
	
	public function getAgencies() {
		$query = "select * from agency";
		$data  = $this->Db->query($query);
		
		die(var_dump($data));
		return $data;
	}
}
