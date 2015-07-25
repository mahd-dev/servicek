<?php
	if($user==null || !$user->is_master){
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}

	if(isset($_POST["move"]) && isset($_POST["paste"])){
		$c = new category($_POST["move"]);
		if($_POST["paste"]) $c->parent = new category($_POST["paste"]);
		else $c->parent = null;
		die(json_encode(array('status' => "success")));
	}
	if(isset($_POST["add_category"])){
		$c = category::create();
		die(json_encode(array('status' => "success", "params" => array("id" => $c->id))));
	}
	if(isset($_POST["delete_category"])){
		$c = new category($_POST["delete_category"]);
		$p = $c->parent;
		if($p){
			foreach ($c->childrens as $child) $child->assign_to_category($p);
			$c->delete();
			die(json_encode(array('status' => "success")));
		}
		die(json_encode(array('status' => "root_element")));
	}
	if(isset($_POST["element"]) && isset($_POST["pk"]) && isset($_POST["name"]) && isset($_POST["value"])){
		switch ($_POST["element"]) {
			case 'category':
				$c = new category($_POST["pk"]);
				switch ($_POST["name"]) {
					case 'name':
						$c->name = $_POST["value"];
						break;
					case 'job_publish_price':
						$c->job_publish_price = $_POST["value"];
						break;
					case 'shop_publish_price':
						$c->shop_publish_price = $_POST["value"];
						break;
					case 'company_publish_price':
						$c->company_publish_price = $_POST["value"];
						break;
					case 'service':
						$c->service = $_POST["value"];
						break;
					case 'product':
						$c->product = $_POST["value"];
						break;
					case 'icon':
						$c->icon = $_POST["value"];
						break;
				}
				break;
			default:
				header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
				break;
		}
		die();
	}

	include "view_1.php";

	skip_this_page:
?>
