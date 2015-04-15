<?php

	// global init

	session_start();

    define("cdn","http".(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"?"s":"")."://".$_SERVER["HTTP_HOST"]."/assets");
    define("url_root","http".(!empty($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] != "off"?"s":"")."://".$_SERVER["HTTP_HOST"]);
	define("srv_root",$_SERVER['DOCUMENT_ROOT']);

	define("lang",(isset($_COOKIE["lang"]) && $_COOKIE["lang"]!=""?$_COOKIE["lang"]:"fr"));
	define("rtl",(lang=="ar"?TRUE:FALSE));


	// Router

	$url=explode("/",reset(explode("?",strtolower($_SERVER["REQUEST_URI"]))));
	array_shift($url);

	switch($url[0]){

		case "":
			$req_page = "pages/home/controller.php";break;

		case "page_requires_parameters": // like http://loop.tn/post/123456789/897654321
			if(isset($fullpage[1])) $_GET["param_1"]=$url[1];
			if(isset($fullpage[2])) $_GET["param_2"]=$url[2];
			$req_page = "pages/page/controller.php";break;

		case "sitemap.xml":
			die(include"seo/sitemap.php");break;

		default:
			$req_page="pages/404/controller.php"; break;
	}

	include (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest" ? $req_page : "master/controller.php");
?>
