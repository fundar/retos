<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

$routes = array(
	0 => array(
			"pattern"	  => "/^auth/",
			"application" => "default",
			"controller"  => "default",
			"method"	  => "auth",
			"params"	  => array(segment(1))
		),
	1 => array(
			"pattern"	  => "/^callback/",
			"application" => "default",
			"controller"  => "default",
			"method"	  => "callback",
			"params"	  => array(segment(1))
		),
);
