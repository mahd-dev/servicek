<?php
	if($user==null || $user->is_agent){
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
		isset($_POST["email"])
	){

		if(
			!$_POST["name"] ||
			!$_POST["description"] ||
			!$_POST["categories"] ||
			!$_POST["address"] ||
			!$_POST["longitude"] ||
			!$_POST["latitude"] ||
			!$_POST["tel"] ||
			!$_POST["email"]
		)  die(json_encode(array("status"=>"error_empty_parameter")));

		if(!gf::check_url($_POST["url"])) die(json_encode(array("status"=>"unvailable_url")));

		foreach ($_POST["categories"] as $c){
			$c = new category($c);
			if(!$c->isvalid) die(json_encode(array("status"=>"error_invalid_parameter")));
		}

		// create shop é contract
		$shop=shop::create($user);

		$shop->name=$_POST["name"];
		$shop->description=$_POST["description"];
		foreach ($_POST["categories"] as $c) $shop->assign_to_category(new category($c));

		if(gf::check_url($_POST["url"])) $shop->url=$_POST["url"];

		$shop->address=$_POST["address"];
		$shop->geolocation=json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
		$shop->tel=$_POST["tel"];
		$shop->mobile=$_POST["mobile"];
		$shop->email=$_POST["email"];

		$contract=contract::create($shop);

		$contract->type=0;
		$contract->amount=0;
		$contract->duration=1;

		die(json_encode(array(
			"status"=>"success",
			"params"=>array(
				"shop_url"=>url_root."/".$shop->url
			)
		)));
	}

	include __DIR__."/../404/controller.php";

	skip_this_page:
?>
