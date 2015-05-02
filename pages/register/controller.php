<?php
	
	if($user!=null) { // already logged in
        include"view_2.php";
        goto skip_this_page;
    }

	if(isset($_POST["check_username"])) die(json_encode(array("status" => (user::username_exists($_POST["check_username"]) ? "not_available":"available"))));
	
	elseif (isset($_POST["displayname"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["mobile"])) {
		if(strlen($_POST["password"]) < 8) die(json_encode(array("resp_msg" => "password_min_length_error")));
		$new_user=user::create($_POST["username"],$_POST["password"]);
		if($new_user instanceOf user){
			$new_user->displayname = $_POST["displayname"];
			$new_user->email = $_POST["email"];
			$new_user->mobile = $_POST["mobile"];

			$_SESSION["user"]=serialize($new_user); // storing user to session
            
            die(json_encode(array(
                "resp_msg" => "logged_in",
                "params" => array(
                    "displayname" => $new_user->displayname
                )
            )));
		}else die(json_encode(array(
				"resp_msg"=>"username_exists"
			)));
	}

	// definig SEO parameters
	// ...

	// select and display right view
	// ...
	include "view_1.php";

	skip_this_page:
?>
