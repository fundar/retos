<?php
/**
 * Access from index.php:
 */


class Github_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("github");
		
		$this->Templates = $this->core("Templates");
	}
	
	public function redirect() {
		include "diversen/githubapi.php";
		session_start();
		
		$access_config = array (
			'redirect_uri' => GITHUB_CALLBACK_URL,
			'client_id'	   => GITHUB_ID,
			'state' 	   =>  md5(uniqid()),
		);

		$api = new githubApi();
		$url = $api->getAccessUrl($access_config);
		
		header('Location:' . $url);
	}
	
	public function getUser() {
		include "diversen/githubapi.php";
		session_start();
		
		$post = array (
			'redirect_uri'  => GITHUB_CALLBACK_URL,
			'client_id'     => GITHUB_ID,
			'client_secret' => GITHUB_SECRET,
		);

		$api = new githubApi();
		$res = $api->setAccessToken($post);
		
		if($res) {
			$command = "/user";
			$res	 = $api->apiCall($command);
			
			if(!$res) {
				echo "Could not get access token. Errors: <br />";
				header('Location:' . get("webURL"));
			}	
			
			$user["email"]   = $res["email"];
			$user["name"]    = $res["name"];
			$user["type"]    = "github";
			$user["id_user"] = $res["id"];
			
			return $user;
			
		} else {
			echo "Could not get access token. Errors: <br />";
			header('Location:' . get("webURL"));
		}
	}
}
