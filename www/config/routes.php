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
		"params"	  => array(segment(1))
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
		"method"	  => "viewPost",
		"params"	  => array(segment(1))
	),
	6 => array(
		"pattern"	  => "/^like/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "like",
		"params"	  => array(segment(1))
	),
	7 => array(
		"pattern"	  => "/^faqs/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "faqs",
		"params"	  => array()
	),
	8 => array(
		"pattern"	  => "/^convocatoria/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "convocatoria",
		"params"	  => array()
	),
	9 => array(
		"pattern"	  => "/^ordenar/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "order",
		"params"	  => array(segment(1))
	),
	10 => array(
		"pattern"	  => "/^mis-ideas/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "myPosts",
		"params"	  => array()
	),
	11 => array(
		"pattern"	  => "/^submit/",
		"application" => "default",
		"controller"  => "default",
		"method"	  => "submit",
		"params"	  => array()
	)
);
