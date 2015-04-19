<?php
	session_start();

	// autoload required core classes
	function __autoload($class_name) {
		include_once 'core/'.$class_name.'.php';
	}

	// root url constants
	define("cdn","http".(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"?"s":"")."://".$_SERVER["HTTP_HOST"]."/assets");
    define("url_root","http".(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"?"s":"")."://".$_SERVER["HTTP_HOST"]);
	define("srv_root",$_SERVER['DOCUMENT_ROOT']);

	// language selection
	define("lang",(isset($_COOKIE["lang"]) && $_COOKIE["lang"]!=""?$_COOKIE["lang"]:"fr"));
	define("rtl",(lang=="ar"?TRUE:FALSE));

	// connecting to database
	include "db_config.php";
	$db = mysqli_connect($db_server, $db_user, $db_password, $db_name);

	// routing url
	include "router.php";
?>
