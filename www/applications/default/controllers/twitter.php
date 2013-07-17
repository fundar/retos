<?php
/**
 * Access from index.php:
 */


class Twitter_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("default");
		
		$this->Templates   = $this->core("Templates");
		
		if(isset($_SESSION['oauth_token']) and $_SESSION['oauth_token_secret']) {
			$this->Twitter_Api = $this->library("twitter", "Twitter", array(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']));
		} elseif(isset($_SESSION['access_token'])) {
			$access_token 	   = $_SESSION['access_token'];
			$this->Twitter_Api = $this->library("twitter", "Twitter", array(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']));
		} else {
			$this->Twitter_Api = $this->library("twitter", "Twitter", array(CONSUMER_KEY, CONSUMER_SECRET));
		}
	}
	
	public function redirect() {		
		$request_token = $this->Twitter_Api->getRequestToken(OAUTH_CALLBACK);
		
		$_SESSION['oauth_token'] 		= $token = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];

		switch($this->Twitter_Api->http_code) {
			case 200:
				/* Build authorize URL and redirect user to Twitter. */
				$url = $this->Twitter_Api->getAuthorizeURL($token);
				header('Location: ' . $url); 
			break;
			default:
				/* Show notification if something went wrong. */
				echo 'Could not connect to Twitter. Refresh the page or try again later.';
				header('Location:' . get("webURL"));
		}
	}
	
	public function getToken() {
		if(isset($_REQUEST['oauth_token']) && $_SESSION['oauth_token'] !== $_REQUEST['oauth_token']) {
			$_SESSION['oauth_status'] = 'oldtoken';
			
			session_start();
			session_destroy();
			
			header('Location:' . get("webURL") . "/auth/twitter");
		}
		
		$access_token = $this->Twitter_Api->getAccessToken($_REQUEST['oauth_verifier']);

		/* Save the access tokens. Normally these would be saved in a database for future use. */
		$_SESSION['access_token'] = $access_token;

		/* Remove no longer needed request tokens */
		unset($_SESSION['oauth_token']);
		unset($_SESSION['oauth_token_secret']);

		/* If HTTP response is 200 continue otherwise send to connect page to retry */
		if(200 == $this->Twitter_Api->http_code) {
			/* The user has been verified and the access tokens can be saved for future use */
			$_SESSION['status'] = 'verified';
			header('Location:' . get("webURL") . "/callback/twitter");
		} else {
			/* Save HTTP status for error dialog on connnect page.*/
			header('Location:' . get("webURL") . "/auth/twitter");
		}
	}
	
	public function getUser() {
		/* If method is set change API call made. Test is called by default. */
		$content = $this->Twitter_Api->get('account/verify_credentials');
		
		die(var_dump($content));
	}
}
