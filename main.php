<?php

	session_start();

	// autoload required core classes
	function __autoload($class_name) {
		switch ($class_name) {
			case 'OpenGraphProtocol':
				include_once 'core/ogp/open-graph-protocol.php';
				break;
			default:
				include_once 'core/'.$class_name.'.php';
				break;
		}
	}

	define("debug",TRUE);

	// root url constants
	define("cdn","http".(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"?"s":"")."://".$_SERVER["HTTP_HOST"]."/assets");
    define("url_root","http".(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"?"s":"")."://".$_SERVER["HTTP_HOST"]);
	define("srv_root",$_SERVER['DOCUMENT_ROOT']);

	$paths = new paths();

	// language selection
	define("lang",(isset($_COOKIE["lang"]) && $_COOKIE["lang"]!=""?$_COOKIE["lang"]:"fr"));
	define("rtl",(lang=="ar"?TRUE:FALSE));

	// connecting to database
	include "db_config.php";
	$db = mysqli_connect($db_server, $db_user, $db_password, $db_name) or die (mysqli_error);

	// check login
	$user = (isset($_SESSION["user"]) ? unserialize($_SESSION["user"]) : null);

	// var_dump(gf::search("aa bb"));

	// routing url
	include "router.php";
?>
