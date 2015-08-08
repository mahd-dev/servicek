<?php
	if($user==null || !$user->is_master){ // must be connected to access account page
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
			case "mobile":$user->mobile=$_POST["value"];break;
		}
		die("success");
	}

	if(isset($_POST["old_password"]) && isset($_POST["new_password"])){
		if(strlen($_POST["new_password"]) < 8) die(json_encode(array("status"=>"new_password_min_length_error")));
		$check_password=user::login($user->username, $_POST["old_password"], gf::getClientIP());
		if($check_password instanceOf user){
			$user->password=$_POST["new_password"];
			die(json_encode(array(
				"status"=>"success"
			)));
		}elseif (is_array($check_password)) {
            if($check_password["status"] == "waiting_restriction_time"){
            	session_destroy();
                die(json_encode(array(
                    "status" => "not_logged_in"
                )));
            }elseif($check_password["status"] == "password_error"){
                die(json_encode(array(
                    "status" => "old_password_error",
                    "params" => array(
                        "remaining_attempts" => $check_password["remaining_attempts"]
                    )
                )));
            }else die("unhandled_error");
        }else die("unhandled_error");
	}

	$job = job::get_all();
	$shops = shop::get_all();
	$companies = company::get_all();

	$count_all_jobs = count($job);
	$count_contracted_jobs = 0;
	$count_visible_jobs = 0;
	for ($i=0; $i < $count_all_jobs; $i++) {
		if($job[$i]->is_contracted) {
			$count_visible_jobs++;
			if ($job[$i]->current_contract->type != 0) $count_contracted_jobs++;
		}
	}

	$count_all_shops = count($shops);
	$count_contracted_shops = 0;
	$count_visible_shops = 0;
	for ($i=0; $i < $count_all_shops; $i++) {
		if($shops[$i]->is_contracted) {
			$count_visible_shops++;
			if ($shops[$i]->current_contract->type != 0) $count_contracted_shops++;
		}
	}

	$count_all_companies = count($companies);
	$count_contracted_companies = 0;
	$count_visible_companies = 0;
	for ($i=0; $i < $count_all_companies; $i++) {
		if($companies[$i]->is_contracted) {
			$count_visible_companies++;
			if ($companies[$i]->current_contract->type != 0) $count_contracted_companies++;
		}
	}
	include "view_1.php";

	skip_this_page:
?>
