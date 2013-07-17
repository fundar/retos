<?php
/**
 * Access from index.php:
 */


class Github_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("default");
		
		$this->Templates  = $this->core("Templates");
		$this->Github_Api = $this->library("githubapi", "githubapi");
	}
	
	public function redirect() {
		$access_config = array (
			'redirect_uri' => GITHUB_CALLBACK_URL,
			'client_id'	   => GITHUB_ID,
			'state' 	   =>  md5(uniqid()),
		);

		$url = $this->Github_Api->getAccessUrl($access_config);
		
		header('Location:' . $url);
	}
	
	public function getUser() {
		$post = array (
			'redirect_uri'  => GITHUB_CALLBACK_URL,
			'client_id'     => GITHUB_ID,
			'client_secret' => GITHUB_SECRET,
		);

		$res = $this->Github_Api->setAccessToken($post);
		
		if($res) {
			$command = "/user";
			$res	 = $this->Github_Api->apiCall($command);
			
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
