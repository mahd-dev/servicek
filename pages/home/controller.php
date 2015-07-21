<?php
	// definig SEO parameters
	// ...


	$rslt=array();
	$map = array();
	foreach (gf::news() as $e) {
		switch (get_class($e)) {
			case 'company':

				$c = $e->categories;
				if(count($c)) $c=$c[0];
				else break;
				$s = $e->seats[0];
				$geolocation=json_decode($s->geolocation);
				$itm = array(
					"type"=>get_class($e),
					"title"=>$e->name,
					"sub_title"=>$e->slogan,
					"content"=>$e->description,
					"image_url"=>($e->logo ? $paths->company_logo->url.$e->logo : null),
					"url"=>url_root."/".$e->url,
					"requests"=>$e->requests,
					"category"=>$c->id,
					"icon"=>$c->icon,
					"longitude"=>$geolocation->longitude,
					"latitude"=>$geolocation->latitude
				);

				if(array_key_exists($itm["category"], $rslt)) {
					$rslt[$itm["category"]]["childrens"][] = array(
						"title"=>$itm["title"],
						"sub_title"=>$itm["sub_title"],
						"content"=>$itm["content"],
						"image_url"=>$itm["image_url"],
						"url"=>$itm["url"],
						"requests"=>$itm["requests"],
						"category"=>$itm["category"]
					);
				}else{
					$rslt[$itm["category"]] = array(
						"category" => $c,
						"childrens" => array(
							array(
								"title"=>$itm["title"],
								"sub_title"=>$itm["sub_title"],
								"content"=>$itm["content"],
								"image_url"=>$itm["image_url"],
								"url"=>$itm["url"],
								"requests"=>$itm["requests"],
								"category"=>$itm["category"]
							)
						)
					);
				}

				$map[]=array(
					"title"=>$itm["title"],
					"content"=>$itm["content"],
					"image_url"=>$itm["image_url"],
					"url"=>$itm["url"],
					"category"=>$itm["category"],
					"icon"=>$itm["icon"],
					"longitude"=>$itm["longitude"],
					"latitude"=>$itm["latitude"]
				);

				break;
			case 'shop':

				$c = $e->categories;
				if(count($c)) $c=$c[0];
				else break;
				$geolocation=json_decode($e->geolocation);

				$itm=array(
					"type"=>get_class($e),
					"title"=>$e->name,
					"sub_title"=>"",
					"content"=>$e->description,
					"image_url"=>($e->image ? $paths->shop_image->url.$e->image : null),
					"url"=>url_root."/".$e->url,
					"requests"=>$e->requests,
					"category"=>$c->id,
					"icon"=>$c->icon,
					"longitude"=>$geolocation->longitude,
					"latitude"=>$geolocation->latitude
				);

				if(array_key_exists($itm["category"], $rslt)) {
					$rslt[$itm["category"]]["childrens"][] = array(
						"title"=>$itm["title"],
						"sub_title"=>$itm["sub_title"],
						"content"=>$itm["content"],
						"image_url"=>$itm["image_url"],
						"url"=>$itm["url"],
						"requests"=>$itm["requests"],
						"category"=>$itm["category"]
					);
				}else{
					$rslt[$itm["category"]] = array(
						"category" => $c,
						"childrens" => array(
							array(
								"title"=>$itm["title"],
								"sub_title"=>$itm["sub_title"],
								"content"=>$itm["content"],
								"image_url"=>$itm["image_url"],
								"url"=>$itm["url"],
								"requests"=>$itm["requests"],
								"category"=>$itm["category"]
							)
						)
					);
				}

				$map[]=array(
					"title"=>$itm["title"],
					"content"=>$itm["content"],
					"image_url"=>$itm["image_url"],
					"url"=>$itm["url"],
					"category"=>$itm["category"],
					"icon"=>$itm["icon"],
					"longitude"=>$itm["longitude"],
					"latitude"=>$itm["latitude"]
				);

			break;
			case 'job':

				$c = $e->categories;
				if(count($c)) $c=$c[0];
				else break;
				$geolocation=json_decode($e->geolocation);

				$itm=array(
					"type"=>get_class($e),
					"title"=>$e->name,
					"sub_title"=>"",
					"content"=>$e->description,
					"image_url"=>($e->image ? $paths->job_image->url.$e->image : null),
					"url"=>url_root."/".$e->url,
					"requests"=>$e->requests,
					"category"=>$c->id,
					"icon"=>$c->icon,
					"longitude"=>$geolocation->longitude,
					"latitude"=>$geolocation->latitude
				);

				if(array_key_exists($itm["category"], $rslt)) {
					$rslt[$itm["category"]]["childrens"][] = array(
						"title"=>$itm["title"],
						"sub_title"=>$itm["sub_title"],
						"content"=>$itm["content"],
						"image_url"=>$itm["image_url"],
						"url"=>$itm["url"],
						"requests"=>$itm["requests"],
						"category"=>$itm["category"]
					);
				}else{
					$rslt[$itm["category"]] = array(
						"category" => $c,
						"childrens" => array(
							array(
								"title"=>$itm["title"],
								"sub_title"=>$itm["sub_title"],
								"content"=>$itm["content"],
								"image_url"=>$itm["image_url"],
								"url"=>$itm["url"],
								"requests"=>$itm["requests"],
								"category"=>$itm["category"]
							)
						)
					);
				}

				$map[]=array(
					"title"=>$itm["title"],
					"content"=>$itm["content"],
					"image_url"=>$itm["image_url"],
					"url"=>$itm["url"],
					"category"=>$itm["category"],
					"icon"=>$itm["icon"],
					"longitude"=>$itm["longitude"],
					"latitude"=>$itm["latitude"]
				);

				break;
		}
	}

	foreach ($rslt as &$item) {
		usort($item["childrens"], function($a, $b){
			return $b["requests"] - $a["requests"];
		});
	}

	usort($rslt, function($a, $b){
		return $b["childrens"][0]["requests"] - $a["childrens"][0]["requests"];
	});

	// select and display right view
	// ...
	include "view_1.php";
?>
