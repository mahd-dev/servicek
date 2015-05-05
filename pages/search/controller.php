<?php
	
	if(isset($_GET["term"])){
		die(json_encode(array(
			$_GET["term"],
			"aaa",
			"bbb",
			"ccc"
			)));
	}

	if(!isset($_GET["q"])){
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}

	$r=array_slice(gf::search($_GET["q"]), 0, 50);

	$rslt=array();
	foreach ($r as $e) {
		switch (get_class($e)) {
			case 'company':
				$rslt[]=array(
					"type"=>get_class($e),
					"title"=>$e->name,
					"sub_title"=>$e->slogan,
					"description"=>$e->description,
					"image_url"=>$paths->company_logo->url.$e->logo,
					"url"=>url_root."/".$e->url
					);
				break;
			case 'job':
				$rslt[]=array(
					"type"=>get_class($e),
					"title"=>$e->name,
					"sub_title"=>"",
					"description"=>$e->description,
					"image_url"=>$paths->job_image->url.$e->image,
					"url"=>url_root."/job/".$e->id
					);
				break;
			case 'product':
				$pc=$e->company;
				$rslt[]=array(
					"type"=>get_class($e),
					"title"=>$e->name,
					"sub_title"=>$pc->name,
					"description"=>$e->description,
					"image_url"=>$paths->product_image->url.$e->image,
					"url"=>url_root."/".$pc->url
					);
				break;
			case 'service':
				$sc=$e->company;
				$rslt[]=array(
					"type"=>get_class($e),
					"title"=>$e->name,
					"sub_title"=>$sc->name,
					"description"=>$e->description,
					"image_url"=>$paths->service_image->url.$e->image,
					"url"=>url_root."/".$sc->url
					);
				break;
		}
	}
	// definig SEO parameters
	// ...

	// select and display right view
	// ...
	include "view_1.php";

	skip_this_page:
?>
