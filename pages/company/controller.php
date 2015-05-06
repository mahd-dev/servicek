<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$c=new company($_GET['id']);
		if (!$c->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}
	
	$s=$c->seats[0];
	$geolocation=json_decode($s->geolocation);

	if ($user!=null && $c->is_assigned_to_admin($user)) {
		if (isset($_POST['for']) && isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
			switch ($_POST['for']) {
				case 'company':
					switch ($_POST['name']) {
						case 'name': $c->name=$_POST['value']; break;
						case 'slogan': $c->slogan=$_POST['value']; break;
						case 'description': $c->description=$_POST['value']; break;
					}
					break;
				case 'seat':
					$seat = new company_seat($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $seat->name=$_POST['value']; break;
						case 'address': $seat->address=$_POST['value']; break;
						case 'tel': $seat->tel=$_POST['value']; break;
						case 'mobile': $seat->mobile=$_POST['value']; break;
						case 'email': $seat->email=$_POST['value']; break;
					}
					break;
				case 'product':
					$product = new product($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $product->name=$_POST['value']; break;
						case 'description': $product->description=$_POST['value']; break;
						case 'price': $product->tel=$_POST['value']; break;
					}
					break;
				case 'service':
					$service = new service($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $service->name=$_POST['value']; break;
						case 'description': $service->description=$_POST['value']; break;
						case 'price': $service->tel=$_POST['value']; break;
					}
					break;
			}
			die();
		}
		include "view_2.php";
	}else{
		include "view_1.php";
	}
			
	skip_this_page:
?>
