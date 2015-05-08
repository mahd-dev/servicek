<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$job=new job($_GET['id']);
		if (!$job->isvalid || $job->admin!=$user) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}

	if(isset($_POST["request_agent"])){
		$job->request_agent();
		die(json_encode(array("status"=>"success")));
	}

	$offers=array(
		"1" => array("duration" => "6", "amount" => "20", "text" => "6 mois : <strong>20 DT</strong>", "help" => '<span class="label label-info pull-right" style="padding:10px;margin:-4px;"><i class="icon-speedometer"></i> Désigné pour le test</span>', "default" => false),
		"2" => array("duration" => "12", "amount" => "30", "text" => "12 mois : <strong>30 DT</strong>", "help" => '<span class="label label-success pull-right" style="padding:10px;margin:-4px;"><i class="icon-check"></i> Recommandé</span>', "default" => true),
		"3" => array("duration" => "36", "amount" => "60", "text" => "3 ans : <strong>60 DT</strong>", "help" => '<span class="label label-primary pull-right" style="padding:10px;margin:-4px;"><i class="icon-star"></i> Inscription longue terme</span>', "default" => false)
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
		if($_POST["token"] != $_SESSION["new_job_token"]) die(json_encode(array("status"=>"invalid_token")));
		$check_token = contract::check_token($_POST["token"]);
		if($check_token){
			$created_job = $check_token->page;
			die(json_encode(array(
				"status"=>"already_done",
				"params"=>array(
					"payment_recipt"=>$check_token->payment_recipt,
					"job_url"=>url_root."/".$created_job->url
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
		) die(json_encode(array("status"=>"error_empty_parameter")));

		if(!array_key_exists($_POST["offer"], $offers))  die(json_encode(array("status"=>"invalid_offer")));
		
		if($_POST["credit_card_number"]){
			$payment=gf::pay($_POST["method"], $_POST["credit_card_number"], $_POST["credit_card_password"], $offers[$_POST["offer"]]["amount"]);
			if($payment["status"]!="success") die(json_encode($payment));
		}else{
			$agent=agent::login_by_code($_POST["agent_code"], gf::getClientIP());
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

		$contract=contract::create($job,$_POST["token"]);
				
		$contract->payment_from=$_POST["method"];
		if(isset($payment)) $contract->payment_recipt=$payment["params"]["payment_recipt"];

		$contract->type=$_POST["offer"];
		$contract->amount=$offers[$_POST["offer"]]["amount"];
		$contract->duration=$offers[$_POST["offer"]]["duration"];

		die(json_encode(array(
			"status"=>"success",
			"params"=>array(
				"payment_recipt"=>(isset($payment) ? $payment["params"]["payment_recipt"] : null),
				"job_url"=>url_root."/".$job->url
			)
		)));
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
