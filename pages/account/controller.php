<?php
	if($user==null){ // must be connected to access account page
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}

	if(isset($set_user_attrib) && $set_user_attrib && isset($_POST["name"]) && isset($_POST["value"])){
		switch ($_POST["name"]) {
			case "displayname":
				if($_POST["value"]==""){
					header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
					die("Le nom ne doit pas être vide");
				}
				$user->displayname=$_POST["value"];
			break;
			case "email":$user->email=$_POST["value"];break;
			case "phone":$user->phone=$_POST["value"];break;
		}
		die("success");
	}

	if(isset($_POST["old_password"]) && isset($_POST["new_password"])){
		if(strlen($_POST["new_password"]) < 8) die(json_encode(array("resp_msg"=>"new_password_min_length_error")));
		$check_password=user::login($user->username, $_POST["old_password"], gf::getClientIP());
		if($check_password instanceOf user){
			$user->password=$_POST["new_password"];
			die(json_encode(array(
				"resp_msg"=>"success"
			)));
		}elseif (is_array($check_password)) {
            if($check_password["status"] == "waiting_restriction_time"){
            	session_destroy();
                die(json_encode(array(
                    "resp_msg" => "not_logged_in"
                )));
            }elseif($check_password["status"] == "password_error"){
                die(json_encode(array(
                    "resp_msg" => "old_password_error",
                    "params" => array(
                        "remaining_attempts" => $check_password["remaining_attempts"]
                    )
                )));
            }else die("unhandled_error");
        }else die("unhandled_error");
	}

	// definig SEO parameters
	// ...

	// init page variables to display
	$num_pages = $user->count_pages;

	$pages=array();
	foreach ($user->pages as $p) {
		if($p instanceOf company){
			if($p->url != null) $url=url_root."/".$p->url;
			else $url=url_root."/company/".$p->id;
		}else $url=url_root."/job/".$p->id;
		$pages[]=array(
			"type"=>($p instanceOf company ? "company" : "job" ),
			"url"=>$url,
			"name"=>$p->name
		);
	}
	
	// selecting and including view
	include "view_1.php";

	skip_this_page:
?>
