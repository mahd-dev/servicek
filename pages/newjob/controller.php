<?php
	if(!$_POST["user_id"] && ($user==null || $user->is_agent)){
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}


	if(isset($_POST["check_url"])) die((gf::check_url($_POST["check_url"])?"true":"false"));
	if(
		isset($_POST["name"]) &&
		isset($_POST["description"]) &&
		isset($_POST["categories"]) &&
		isset($_POST["url"]) &&
		isset($_POST["address"]) &&
		isset($_POST["longitude"]) &&
		isset($_POST["latitude"]) &&
		isset($_POST["tel"]) &&
		isset($_POST["mobile"]) &&
		isset($_POST["email"]) &&
		isset($_POST["user_id"])
	){

		if(
			!$_POST["name"] ||
			!$_POST["description"] ||
			!$_POST["categories"] ||
			!$_POST["address"] ||
			!$_POST["longitude"] ||
			!$_POST["latitude"] ||
			!$_POST["email"]
		)  die(json_encode(array("status"=>"error_empty_parameter")));

		if(!gf::check_url($_POST["url"])) die(json_encode(array("status"=>"unvailable_url")));

		foreach ($_POST["categories"] as $c){
			$c = new category($c);
			if(!$c->isvalid) die(json_encode(array("status"=>"error_invalid_parameter")));
		}

		// create job é contract
		$job=job::create(($_POST["user_id"]?new user($_POST["user_id"]):$user));

		$job->name=$_POST["name"];
		$job->description=$_POST["description"];
		foreach ($_POST["categories"] as $c) $job->assign_to_category(new category($c));

		if(gf::check_url($_POST["url"])) $job->url=$_POST["url"];

		$job->address=$_POST["address"];
		$job->geolocation=json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
		$job->tel=$_POST["tel"];
		$job->mobile=$_POST["mobile"];
		$job->email=$_POST["email"];

		$experiences = job_cv::create($job);
		$experiences->title = "Expériences";
		$studies = job_cv::create($job);
		$studies->title = "Études";
		$stages = job_cv::create($job);
		$stages->title = "Stages";

		$contract=contract::create($job);
		$contract->type=0;
		$contract->amount=0;
		$contract->duration=1;

		die(json_encode(array(
			"status"=>"success",
			"params"=>array(
				"job_url"=>url_root."/".$job->url
			)
		)));
	}

	include __DIR__."/../404/controller.php";

	skip_this_page:
?>
