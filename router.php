<?php

	// preparing url
	$url=explode("/",reset(explode("?",urldecode($_SERVER["REQUEST_URI"]))));
	array_shift($url);

	$reserved_urls=array(
		"",
		"about",
		"contact",
		"commercial",
		"search",
		"login",
		"logout",
		"register",
		"account",
		"new",
		"job",
		"shop",
		"company",
		"product",
		"service",
		"post",
		"validate_email",
		"reset_password",
		"forgotten_password",
		"help",
		"sitemap.xml",
	);

	// selecting page based on url
	switch(strtolower($url[0])){

		case "admin":
			switch (strtolower($url[1])) {
				case 'categories': $req_page="pages_admin/categories/controller.php"; break;

				default: $req_page="pages/404/controller.php"; break;
			}
		break;

		case "":
			$req_page = "pages/home/controller.php";break;
		case "about":
			$req_page = "pages/about/controller.php";break;

		case "contact":
			$req_page = "pages/contact/controller.php";break;

    case "search":
			if(isset($url[1]) && strtolower($url[1])!="autocomplete") $_GET["q"]=$url[1];
			$req_page = "pages/search/controller.php";break;
    case "login":
			$req_page = "pages/login/controller.php";break;
    case "logout":
      session_destroy();
      $user=null;
      $logout=true;
			$req_page = "pages/home/controller.php";break;
    case "register":
			$req_page = "pages/register/controller.php";break;
    case "account":
    	if(isset($url[1]) && strtolower($url[1])=="set_user_attrib") $set_user_attrib=true;
			$req_page = "pages/account/controller.php";break;
		case "new":
			if(!isset($url[1])) {
				$req_page="pages/new/controller.php";break;
			}else{
				switch (strtolower($url[1])) {
					case 'company': die(include "pages/newcompany/controller.php"); break;
					case 'shop': die(include "pages/newshop/controller.php"); break;
					case 'job': die(include "pages/newjob/controller.php"); break;
					default: $req_page="pages/404/controller.php"; break;
				}
			}
    case "job":
			if(isset($url[1])) $_GET["id"]=$url[1];
			if(isset($url[2]) && strtolower($url[2])=="publish") $req_page = "pages/publishjob/controller.php";
			else {
				if(isset($url[2]) && isset($url[3])) $_GET["portfolio"]=$url[3];
					$req_page = "pages/job/controller.php";
			}
		break;
		case "shop":
			if(isset($url[1])) $_GET["id"]=$url[1];
			if(isset($url[2]) && strtolower($url[2])=="publish") $req_page = "pages/publishshop/controller.php";
			else {
				if(isset($url[2]) && isset($url[3])) $_GET["product"]=$url[3];
					$req_page = "pages/shop/controller.php";
			}
		break;
    case "company":
			if(isset($url[1])) $_GET["id"]=$url[1];
			if(isset($url[2]) && strtolower($url[2])=="publish") $req_page = "pages/publishcompany/controller.php";
			else {
				if(isset($url[2]) && isset($url[3]) && in_array($url[2], array("product","service"))) $_GET[$url[2]]=$url[3];
					$req_page = "pages/company/controller.php";
			}
		break;
    case "product":
			if(isset($url[1])) $_GET["id"]=$url[1];
			$req_page = "pages/product/controller.php";
		break;
    case "service":
			if(isset($url[1])) $_GET["id"]=$url[1];
			$req_page = "pages/service/controller.php";
		break;
    case "post":
			if(isset($url[1])) $_GET["id"]=$url[1];
			$req_page = "pages/post/controller.php";
		break;

		case 'validate_email':
			if(isset($url[1])) $_GET["token"]=$url[1];
			$req_page = "pages/validate_email/controller.php";
		break;
		case 'reset_password':
			if(isset($url[1])) $_GET["token"]=$url[1];
			if(isset($url[2])) $_GET["email_validation_token"]=$url[1];
			$req_page = "pages/reset_password/controller.php";
		break;
		case 'forgotten_password':
			$req_page = "pages/forgotten_password/controller.php";
		break;

		case "setlocations":
			die(include"maintenance/setlocations/controller.php");break;

		case "fixutf8":
			die(include"maintenance/fixutf8/controller.php");break;

		case "locality_merge":
			if(isset($url[1]) && $url[1] == $db_password) {
				if(isset($url[2])) $_GET["from"]=$url[2];
				if(isset($url[3])) $_GET["to"]=$url[3];
				die(include"maintenance/locality_merge/controller.php");
			}
			break;
		case 'help':
			switch (strtolower($url[1])) {
				case 'mail-config':
					if(isset($url[2])) $_GET["address"]=$url[2];
					$req_page="help/mailconfig/controller.php";
				break;

				default: $req_page="pages/404/controller.php"; break;
			}
			break;
		case "sitemap.xml":
			die(include"seo/sitemap.php");break;
		case "robots.txt":
			die(include"seo/robots.txt");break;

		case "git_webhook_push":
			die(include"git_webhook/pull.php");break;
		case "git_webhook_release":
			die(include"git_webhook/release.php");break;

		default:
			$page = gf::get_by_url($url[0]);
			if($page){
				$type=get_class($page);
				$_GET["id"]=$page->id;
				if(isset($url[1]) && strtolower($url[1])=="publish") $req_page = "pages/publish".$type."/controller.php";
				elseif (isset($url[1]) && strtolower($url[1])=="messages") {
					if(isset($url[2])) {
						$_GET["folder"] = $url[2];
						if(isset($url[3])) {
							$_GET["message"] = $url[3];
							if(isset($url[4])) $_GET["attachment"] = $url[4];
						}
					}
					$req_page = "pages/mailbox/controller.php";
				} else {
					if(isset($url[1]) && isset($url[2]) && in_array(strtolower($url[1]), array("product","service","portfolio"))) $_GET[$url[1]]=$url[2];
					$req_page = "pages/".$type."/controller.php";
				}
				break;
			} else $req_page="pages/404/controller.php";
			break;
	}

	// running selected page
	$is_ajax = (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
	include ($is_ajax ? $req_page : "master/controller.php");
?>
