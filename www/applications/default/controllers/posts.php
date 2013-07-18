<?php
/**
 * Access from index.php:
 */


class Posts_Controller extends ZP_Controller {
	
	public function __construct() {
		$this->app("default");
		
		$this->Templates = $this->core("Templates");
	}
}
