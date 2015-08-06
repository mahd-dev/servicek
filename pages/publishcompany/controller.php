<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$company=new company($_GET['id']);
		if (!$company->isvalid || $user==null || (!$company->is_assigned_to_admin($user) && !$user->is_master)) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}

	if(isset($_POST["request_agent"])){
		$company->request_agent();
		die(json_encode(array("status"=>"success")));
	}

	if(isset($_POST["check_url"])) die((gf::check_url($_POST["check_url"])?"true":"false"));

	$price=0;
	foreach ($company->categories as $cc) {
		$price+=floatval($cc->company_publish_price);
	}
	$prices_list=array(
		round($price * (2/3)),
		round($price * 1),
		round($price * 2)
	);
	$offers=array(
		"1" => array("duration" => "6", "amount" => $prices_list[0], "text" => "6 mois : <strong>".$prices_list[0]." DT</strong>", "help" => '<span class="label label-info pull-right" style="padding:10px;margin:-4px;"><i class="icon-speedometer"></i> Désigné pour le test</span>', "default" => false),
		"2" => array("duration" => "12", "amount" => $prices_list[1], "text" => "12 mois : <strong>".$prices_list[1]." DT</strong>", "help" => '<span class="label label-success pull-right" style="padding:10px;margin:-4px;"><i class="icon-check"></i> Recommandé</span>', "default" => true),
		"3" => array("duration" => "36", "amount" => $prices_list[2], "text" => "3 ans : <strong>".$prices_list[2]." DT</strong>", "help" => '<span class="label label-primary pull-right" style="padding:10px;margin:-4px;"><i class="icon-star"></i> Inscription longue terme</span>', "default" => false)
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
			!$_POST["offer"] ||
			!$_POST["method"] ||
			(
				!$_POST["credit_card_number"] ||
				!$_POST["credit_card_password"]
			) && (
				!$_POST["agent_code"]
			)
		)  die(json_encode(array("status"=>"error_empty_parameter")));

		if(!array_key_exists($_POST["offer"], $offers))  die(json_encode(array("status"=>"invalid_offer")));

		if($_POST["credit_card_number"]){
			$payment=gf::pay($_POST["method"], $_POST["credit_card_number"], $_POST["credit_card_password"], $offers[$_POST["offer"]]["amount"]);
			if($payment["status"]!="success") die(json_encode($payment));
		}else{
			$agent=user::agent_code($_POST["agent_code"], gf::getClientIP());
			if(is_array($agent)) {
				switch ($agent["status"]) {
					case "waiting_restriction_time":
						$agent["msg"] = "Vous avez encore ".$agent["remaining_time"]." minutes pour pouvoir réessayer accéder à partir de cet appareil";
					break;
					case "code_error":
						$agent["msg"] = "Code incorrect, vous avez encore ".$agent["remaining_attempts"]." tentatives";
					break;
					case "restricted_host":
						$agent["msg"] = "Vous n'êtes pas autorisé à se connecter a partir de cet appareil";
					break;
				}
				die(json_encode($agent));
			}
		}

		// create company é contract
		$contract=contract::create($company,$_POST["token"]);
		$cc = $company->current_contract;
		if($cc){
			$contract->creation_time=$cc->expiration;
		}
		$contract->payment_from=$_POST["method"];
		if(isset($payment)) $contract->payment_recipt=$payment["params"]["payment_recipt"];
		else $contract->id_agent = $agent->id;

		$contract->type=$_POST["offer"];
		$contract->amount=$offers[$_POST["offer"]]["amount"];
		$contract->duration=$offers[$_POST["offer"]]["duration"];

		die(json_encode(array(
			"status"=>"success",
			"params"=>array(
				"payment_recipt"=>(isset($payment) ? $payment["params"]["payment_recipt"] : null),
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
