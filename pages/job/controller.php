<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$job=new job($_GET['id']);
		if (!$job->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}

	$geolocation=json_decode($job->geolocation);
	$is_contracted = $job->is_contracted;
	
	if ($job->admin==$user || $user->is_master) {
		if (isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
			switch ($_POST['name']) {
				case 'description':
					$job->description=$_POST['value'];
					break;
				case 'name':
					$job->name=$_POST['value'];
					break;
				case 'address':
					$job->address=$_POST['value'];
					break;
				case 'tel':
					$job->tel=$_POST['value'];
					break;
				case 'mobile':
					$job->mobile=$_POST['value'];
					break;
				case 'email':
					$job->email=$_POST['value'];
					break;
				default:
					header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
					break;
			}
			die();
		}elseif(isset($_POST["geolocation"]) && isset($_POST["latitude"]) && isset($_POST["longitude"])){
			$job->geolocation = json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
			die("success");
			
		}elseif(isset($_POST["file"]) && $_POST["file"]=="image"){
			
			$oldname=$paths->job_image->dir.$job->image;

			if(file_exists($oldname) && is_file($oldname)) unlink($oldname);
			
			$name=gf::generate_guid().".".end((explode(".", $_FILES["image"]["name"])));
			move_uploaded_file($_FILES["image"]["tmp_name"], $paths->job_image->dir.$name);
			
			$job->image=$name;
			
			die("success");
		}

		include "view_2.php";
	}elseif($is_contracted){
		include "view_1.php";
	}else{
		include __DIR__."/../404/controller.php";goto skip_this_page;
	}
			
	skip_this_page:	
?>