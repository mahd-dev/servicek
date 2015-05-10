<?php
	if($user==null || $user->is_agent){
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}


	if(isset($_POST["check_url"])) die((company::check_url($_POST["check_url"])?"true":"false"));
	if(
		isset($_POST["name"]) &&
		isset($_POST["slogan"]) &&
		isset($_POST["description"]) &&
		isset($_POST["url"]) &&
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

		if(!company::check_url($_POST["url"])) die(json_encode(array("status"=>"unvailable_url")));
		
		// create company é contract
		$company=company::create($user);
		$seat=company_seat::create($company);
		
		$company->name=$_POST["name"];
		$company->slogan=$_POST["slogan"];
		$company->description=$_POST["description"];
		if(company::check_url($_POST["url"])) $company->url=$_POST["url"];

		$seat->name="Siège social"; // to translate
		$seat->type="master";
		$seat->address=$_POST["address"];
		$seat->geolocation=json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
		$seat->tel=$_POST["tel"];
		$seat->mobile=$_POST["mobile"];
		$seat->email=$_POST["email"];

		die(json_encode(array(
			"status"=>"success",
			"params"=>array(
				"company_url"=>url_root."/".$company->url
			)
		)));
	}

	// definig SEO parameters
	// ...

	// process required data

	// select and display right view
	// ...
	include "view_1.php";

	skip_this_page:
?>
