<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$company=new company($_GET['id']);
		if (!$company->isvalid || $company->admin!=$user) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}

	if(isset($_GET["request_agent"])){
		$job->request_agent();
		die(json_encode(array("status"=>"success")));
	}

	if(isset($_POST["check_url"])) die((company::check_url($_POST["check_url"])?"true":"false"));

	$offers=array(
		"1" => array("duration" => "6", "amount" => "60", "text" => "6 mois : <strong>60 DT</strong>", "help" => '<span class="label label-info pull-right" style="padding:10px;margin:-4px;"><i class="icon-speedometer"></i> Désigné pour le test</span>', "default" => false),
		"2" => array("duration" => "12", "amount" => "90", "text" => "12 mois : <strong>90 DT</strong>", "help" => '<span class="label label-success pull-right" style="padding:10px;margin:-4px;"><i class="icon-check"></i> Recommandé</span>', "default" => true),
		"3" => array("duration" => "36", "amount" => "180", "text" => "3 ans : <strong>180 DT</strong>", "help" => '<span class="label label-primary pull-right" style="padding:10px;margin:-4px;"><i class="icon-star"></i> Inscription longue terme</span>', "default" => false)
	);
	
	if(
		isset($_POST["token"]) &&
		isset($_POST["offer"]) &&
		isset($_POST["method"]) &&
		isset($_POST["credit_card_number"]) &&
		isset($_POST["credit_card_password"]) &&
		isset($_POST["agent_code"])
	){

		// checking parameters
		if($_POST["token"] != $_SESSION["new_company_token"]) die(json_encode(array("status"=>"invalid_token")));
		$check_token = contract::check_token($_POST["token"]);
		if($check_token){
			$created_company = $check_token->page;
			die(json_encode(array(
				"status"=>"already_done",
				"params"=>array(
					"payment_recipt"=>$check_token->payment_recipt,
					"company_url"=>url_root."/".$created_company->url
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
			!$_POST["email"] ||
			!$_POST["offer"] ||
			!$_POST["method"] ||
			!$_POST["credit_card_number"] ||
			!$_POST["credit_card_password"]
		)  die(json_encode(array("status"=>"error_empty_parameter")));

		if(!company::check_url($_POST["url"])) die(json_encode(array("status"=>"unvailable_url")));
		if(!array_key_exists($_POST["offer"], $offers))  die(json_encode(array("status"=>"invalid_offer")));
		if(!in_array($_POST["method"], $payment_methods))  die(json_encode(array("status"=>"invalid_method")));
		
		
		// process payment
		// ...
		$payment_recipt="ignored_payment";
		$payment_error=null;
		
		if($payment_error=="invalid_card_number") die(json_encode(array("status"=>"invalid_card_number")));
		elseif($payment_error=="error_card_password") die(json_encode(array("status"=>"error_card_password")));
		elseif($payment_error=="insufficient_balance") die(json_encode(array("status"=>"insufficient_balance")));
		elseif($payment_error)  die(json_encode(array("status"=>"unhandled_payment_error")));


		// create company é contract
		$company=company::create($user);
		$seat=company_seat::create($company);
		$contract=contract::create($company,$_POST["token"]);
		

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

		$contract->payment_from=$_POST["method"];
		$contract->payment_recipt=$payment_recipt;

		$contract->type=$_POST["offer"];
		$contract->amount=$offers[$_POST["offer"]]["amount"];
		$contract->duration=$offers[$_POST["offer"]]["duration"];

		die(json_encode(array(
			"status"=>"success",
			"params"=>array(
				"payment_recipt"=>$payment_recipt,
				"company_url"=>url_root."/".$company->url
			)
		)));
	}

	// definig SEO parameters
	// ...

	// process required data
	$new_company_token = gf::generate_guid();
	$_SESSION["new_company_token"] = $new_company_token;

	// select and display right view
	// ...
	include "view_1.php";

	skip_this_page:
?>
