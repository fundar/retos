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
	2 => array(
		"pattern"	  => "/^logout/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "logout",
		"params"	  => array()
	),
	3 => array(
		"pattern"	  => "/^add/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "add",
		"params"	  => array()
	),
	4 => array(
		"pattern"	  => "/^edit/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "edit",
		"params"	  => array(segment(1))
	),
	5 => array(
		"pattern"	  => "/^reto/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "view",
		"params"	  => array(segment(1))
	)
);
