<?php
	if($user==null || $user->is_agent){
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}
	
	if(
		isset($_POST["name"]) &&
		isset($_POST["description"]) &&
		isset($_POST["categories"]) &&
		isset($_POST["address"]) &&
		isset($_POST["longitude"]) &&
		isset($_POST["latitude"]) &&
		isset($_POST["tel"]) &&
		isset($_POST["mobile"]) &&
		isset($_POST["email"])
	){

		if(
			!$_POST["name"] ||
			!$_POST["description"] ||
			!$_POST["address"] ||
			!$_POST["longitude"] ||
			!$_POST["latitude"] ||
			!$_POST["tel"] ||
			!$_POST["email"]
		)  die(json_encode(array("status"=>"error_empty_parameter")));

		// create job é contract
		$job=job::create($user);
		
		$job->name=$_POST["name"];
		$job->description=$_POST["description"];
		foreach (explode(",", $_POST["categories"]) as $c) $job->assign_to_category(category::get_by_name($c));
		$job->address=$_POST["address"];
		$job->geolocation=json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
		$job->tel=$_POST["tel"];
		$job->mobile=$_POST["mobile"];
		$job->email=$_POST["email"];

		die(json_encode(array(
			"status"=>"success",
			"params"=>array(
				"job_url"=>url_root."/".$job->url
			)
		)));
	}

	// definig SEO parameters
	// ...

	// process required data
	$available_categories = array();
	foreach (category::get_all() as $c) $available_categories[] = $c->name;

	// display view
	include "view_1.php";

	skip_this_page:
?>
