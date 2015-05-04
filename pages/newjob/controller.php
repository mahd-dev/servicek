<?php
	if($user==null){ // must be connected to access account page
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}

	if(
		isset($_POST["token"]) &&
		isset($_POST["name"]) &&
		isset($_POST["description"]) &&
		isset($_POST["address"]) &&
		isset($_POST["longitude"]) &&
		isset($_POST["latitude"]) &&
		isset($_POST["tel"]) &&
		isset($_POST["mobile"]) &&
		isset($_POST["email"]) &&
		isset($_POST["offer"]) &&
		isset($_POST["method"]) &&
		isset($_POST["credit_card_number"]) &&
		isset($_POST["credit_card_password"])
	){
		// checking parameters
		if($_POST["token"] != $_SESSION["new_job_token"]) die(json_encode(array("status"=>"invalid_token")));
		$check_token = contract::check_token($_POST["token"]);
		if($check_token){
			$created_job = $check_token->page;
			die(json_encode(array(
				"status"=>"already_done",
				"params"=>array(
					"payment_recipt"=>$check_token->payment_recipt,

				)
			)));
		}
		if(
			!$_POST["name"] ||
			!$_POST["description"] ||
			!$_POST["address"] ||
			!$_POST["longitude"] ||
			!$_POST["latitude"] ||
			!$_POST["tel"] ||
			//!$_POST["mobile"] ||
			!$_POST["email"] ||
			!$_POST["offer"] ||
			!$_POST["method"] ||
			!$_POST["credit_card_number"] ||
			!$_POST["credit_card_password"]
		)  die(json_encode(array("status"=>"error_empty_parameter")));
		if(!in_array($_POST["offer"], array("1", "2", "3")))  die(json_encode(array("status"=>"invalid_offer")));
		if(!in_array($_POST["method"], array("e_dinar_smart_tunisian_post")))  die(json_encode(array("status"=>"invalid_method")));
		
		// process payment
		// ...
		$payment_recipt="";

		// create job é contract
		$job=job::create($user);
		$contract=contract::create($job,$_POST["token"]);
		
		$job->name=$_POST["name"];
		$job->description=$_POST["description"];
		$job->address=$_POST["address"];
		$job->geolocation=json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
		$job->tel=$_POST["tel"];
		$job->mobile=$_POST["mobile"];
		$job->email=$_POST["email"];
/*
		$contract->payment_from
		$contract->payment_recipt
		$contract->type
		$contract->amount
		$contract->duration
*/
	}

	// definig SEO parameters
	// ...

	// select right view
	
	// process required data
	$new_job_token = gf::generate_guid();
	$_SESSION["new_job_token"] = $new_job_token;

	// display view
	include "view_1.php";

	skip_this_page:
?>
