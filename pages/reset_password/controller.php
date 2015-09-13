<?php
	if($user!=null || !isset($_GET["token"]) || !$_GET["token"]) {
    include srv_root."/pages/404/controller.php";
    goto skip_this_page;
  }
	$new_user=user::get_by_reset_password_token($_GET["token"]);
	if(!$new_user){
		include srv_root."/pages/404/controller.php";
		goto skip_this_page;
	}
	if (isset($_POST["password"])) {
		if(strlen($_POST["password"]) < 8) die(json_encode(array("status" => "password_min_length_error")));
			$new_user->password = $_POST["password"];
			if(isset($_GET["email_validation_token"]) && $_GET["email_validation_token"]==$new_user->email_validation_token){
				$new_user->email_validation_token = NULL;
			}
			$_SESSION["user"]=serialize($new_user); // storing user to session
			$_SESSION["pwd"]=$_POST["password"];
			if($new_user->count_pages==1) $url = url_root."/".$new_user->pages[0]->url;
			else $url = url_root."/account";
			die(json_encode(array(
				"status" => "logged_in",
				"params" => array(
					"displayname" => $new_user->displayname,
					"goto_page" => $url
				)
			)));
	}

	include "view_1.php";

	skip_this_page:
?>
