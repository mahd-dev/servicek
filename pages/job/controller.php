<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$j=new job($_GET['id']);
		if (!$j->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}


	$geolocation=json_decode($j->geolocation);
	
	if ($j->admin==$user) {
		if (isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
			switch ($_POST['name']) {
				case 'description':
					$j->description=$_POST['value'];
					break;
				case 'name':
					$j->name=$_POST['value'];
					break;
				case 'address':
					$j->address=$_POST['value'];
					break;
				case 'tel':
					$j->tel=$_POST['value'];
					break;
				case 'mobile':
					$j->mobile=$_POST['value'];
					break;
				case 'email':
					$j->email=$_POST['value'];
					break;
				default:
					header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
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