<?php
	if(!isset($_GET["token"]) || !$_GET["token"]) {
    include srv_root."/pages/404/controller.php";
    goto skip_this_page;
  }
	$new_user=user::get_by_email_validation_token($_GET["token"]);
	if(!$new_user){
		include srv_root."/pages/404/controller.php";
		goto skip_this_page;
	}
	$new_user->email_validation_token = NULL;

	include "view_1.php";

	skip_this_page:
?>
