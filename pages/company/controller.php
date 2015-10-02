<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$company=new company($_GET['id']);
		if (!$company->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}

	$is_admin_level = ($user!=null && !$user->is_master && $page->is_assigned_to_admin($user));

	$s=$company->seats[0];

	if(isset($_POST["cancel_password_reset_ticket"])){
		$admin = $company->admins[0];
		$admin->reset_password_token = NULL;
		die(json_encode(array("status"=>"success")));
	} elseif (isset($_POST["new_password_reset_ticket"])) {
		$admin = $company->admins[0];
		$token = $admin->set_reset_password_token();
		die(json_encode(array("status"=>"success", "params"=>array(
			"token"=>$token
		))));
	}

	if(isset($_POST["email"]) && isset($_POST["subject"])){

		chdir(__DIR__);
		include_once '../../core/PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = 'servicek.net';
		$mail->SMTPAuth = true;
		$mail->Username = "no-reply@servicek.net";
		$mail->Password = $smtp_noreply_password;
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->SMTPOptions = array(
	    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
	    )
		);

		$mail->From = "no-reply@servicek.net";
		$mail->FromName = "servicek.net";
		$mail->addAddress($company->url."@servicek.net");

		$mail->addReplyTo($_POST["email"]);

		$mail->isHTML(true);

		if(isset($_FILES["attachments"])){
			for ($i=0; $i < count($_FILES["attachments"]["name"]); $i++) {
				$mail->addAttachment($_FILES["attachments"]["tmp_name"][$i], $_FILES["attachments"]["name"][$i]);
			}
		}

		$mail->Subject = $_POST["subject"];
		$mail->Body    = $_POST["message"];
		$mail->AltBody = strip_tags(str_replace(array("</p>"), "\r\n", str_replace(array("<br>", "</br>", "<br/>"), "\r\n", $_POST["message"])));

		if(!$mail->send()) die($mail->ErrorInfo);
		else {
			die(json_encode(array("status"=>"success")));
		}
	}
	$geolocation=json_decode($s->geolocation);
	$is_contracted=$company->is_contracted;
	if($is_contracted) $is_trial = ($company->current_contract->type == 0);
	$categories = array();
	$nb_categories = count($categories);
	$categories_json = array();
	$categories_obj = $company->categories;
	foreach ($categories_obj as $cat){
		$categories_json[] = intval($cat->id);
		$categories[] = $cat->name;
	}
	$categories = implode(", ", $categories);

	if ($user!=null && ($company->is_assigned_to_admin($user) || $user->is_master)) {
		if (isset($_POST['element']) && isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
			switch ($_POST['element']) {
				case 'company':
					switch ($_POST['name']) {
						case 'name': $company->name=$_POST['value']; break;
						case 'slogan': $company->slogan=$_POST['value']; break;
						case 'description': $company->description=$_POST['value']; break;
						case 'categories' :
							if(count($_POST['value'])==0){
								header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
								echo "Domaine d'activité requit";
								die();
							}
							$company->unassign_from_all_categories();
							foreach ($_POST['value'] as $value) {
								$company->assign_to_category(new category(intval($value)));
							}
						break;
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
						case 'price': $product->price=$_POST['value']; break;
						case 'rent_price': $product->rent_price=$_POST['value']; break;
						case 'categories' :
							$product->unassign_from_all_categories();
							foreach ($_POST['value'] as $value) {
								$product->assign_to_category(new category(intval($value)));
							}
						break;
					}
					break;
				case 'service':
					$service = new service($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $service->name=$_POST['value']; break;
						case 'description': $service->description=$_POST['value']; break;
						case 'price': $service->price=$_POST['value']; break;
						case 'rent_price': $service->rent_price=$_POST['value']; break;
						case 'categories' :
							$service->unassign_from_all_categories();
							foreach ($_POST['value'] as $value) {
								$service->assign_to_category(new category(intval($value)));
							}
						break;
					}
					break;
			}
			die();
		}elseif(isset($_POST["geolocation"]) && isset($_POST["latitude"]) && isset($_POST["longitude"])){
			$seat = new company_seat($_POST["geolocation"]);
			$seat->geolocation = json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
			die("success");

		}elseif (isset($_POST['new_service'])) {

			$service=service::create($company);
			die(json_encode(array("status"=>"success", "id"=>$service->id, "url"=>url_root."/".$service->url)));

		}elseif (isset($_POST['new_product'])) {

			$product=product::create($company);
			die(json_encode(array("status"=>"success", "id"=>$product->id, "url"=>url_root."/".$product->url)));

		}elseif (isset($_POST['delete_service'])) {

			$service=new service($_POST['delete_service']);
			$service->delete();

			die(json_encode(array("status"=>"success")));

		}elseif (isset($_POST['delete_product'])) {

			$product=new product($_POST['delete_product']);
			$product->delete();

			die(json_encode(array("status"=>"success")));

		}elseif(isset($_POST["file"]) && $_POST["file"]=="logo"){

			$oldname=$paths->company_logo->dir.$company->logo;

			if(file_exists($oldname) && is_file($oldname)) unlink($oldname);

			$name=gf::generate_guid().".".end((explode(".", $_FILES["logo"]["name"])));
			move_uploaded_file($_FILES["logo"]["tmp_name"], $paths->company_logo->dir.$name);

			$company->logo=$name;

			die("success");
		}elseif(isset($_POST["file"]) && $_POST["file"]=="cover"){

			$oldname=$paths->company_cover->dir.$company->cover;

			if(file_exists($oldname) && is_file($oldname)) unlink($oldname);

			$name=gf::generate_guid().".".end((explode(".", $_FILES["cover"]["name"])));
			move_uploaded_file($_FILES["cover"]["tmp_name"], $paths->company_cover->dir.$name);

			$company->cover=$name;

			die("success");
		}elseif(isset($_POST["file"]) && $_POST["file"]=="service_image" && isset($_POST["pk"])){

			$service=new service($_POST["pk"]);

			$oldname=$paths->service_image->dir.$service->image;

			if(file_exists($oldname) && is_file($oldname)) unlink($oldname);

			$name=gf::generate_guid().".".end((explode(".", $_FILES["image"]["name"])));
			move_uploaded_file($_FILES["image"]["tmp_name"], $paths->service_image->dir.$name);

			$service->image=$name;

			die("success");
		}elseif(isset($_POST["file"]) && $_POST["file"]=="product_image" && isset($_POST["pk"])){

			$product=new product($_POST["pk"]);

			$oldname=$paths->product_image->dir.$product->image;

			if(file_exists($oldname) && is_file($oldname)) unlink($oldname);

			$name=gf::generate_guid().".".end((explode(".", $_FILES["image"]["name"])));
			move_uploaded_file($_FILES["image"]["tmp_name"], $paths->product_image->dir.$name);

			$product->image=$name;

			die("success");
		}elseif (isset($_POST["remove_me"])) {
			$company->delete();
			die("success");
		}elseif (isset($_POST["transform"])) {
			$company->transform_to($_POST["transform"]);
			die("success");
		}elseif (isset($_POST["new_category"])) {
			$new_category = category::create();
			$new_category->name = $_POST["new_category"];
			$new_category->service = 1;
			$new_category->product = 1;
			$new_category->portfolio = 1;
			$new_category->parent = $company->categories[0];
			die(json_encode(array("status"=>"success",
				"params"=>array("id"=>$new_category->id, "text"=>$_POST["new_category"])
			)));
		}

		$available_categories = array();
		foreach (category::get_available_for('company') as $c) $available_categories[] = array("id"=>intval($c->id), "text"=>$c->name);

		$available_product_categories = array();
		foreach (category::get_available_for('product', $categories_obj) as $c) $available_product_categories[] = array("id"=>intval($c->id), "text"=>$c->name);

		$available_service_categories = array();
		foreach (category::get_available_for('service', $categories_obj) as $c) $available_service_categories[] = array("id"=>intval($c->id), "text"=>$c->name);

		include "view_2.php";
	}elseif($is_contracted){

		if(isset($_GET["product"])) $ps=new product($_GET["product"]);
		elseif(isset($_GET["service"])) $ps=new service($_GET["service"]);

		// defining seo parameters
		if(isset($ogp)){
			if(isset($ps)){
				$ps_name = $ps->name;
				$ogp->setTitle( ($ps_name? $ps_name : $company->name ) );
				$ps_description = $ps->description;
				$ogp->setDescription( ($ps_description? $ps_description : $company->description ) );

        $ogp->setURL( url_root."/".urlencode($ps->url) );

        $ogp->setType( 'article' );

        $seo_img = $ps->image;
        if($seo_img){
					switch (get_class($ps)) {
						case 'product': $img_path=$paths->product_image->url.$seo_img; break;
						case 'service': $img_path=$paths->service_image->url.$seo_img; break;
					}
          $image = new OpenGraphProtocolImage();
          $image->setURL( url_root.$img_path );
          $image->setSecureURL( str_replace("http://", "https://", url_root.$img_path) );
          $image->setType( 'image/jpeg' );
          $ogp->addImage($image);

          $ref["twitter:image:src"] = url_root.$img_path;
        }

        $article = new OpenGraphProtocolArticle();
        $article->setPublishedTime( date(DATE_ISO8601, strtotime($ps->creation_time)) );
        $article->setModifiedTime( new DateTime( 'now', new DateTimeZone( 'Africa/Tunis' ) ) );
        $article->setSection( get_class($ps) );

        foreach(array_filter(explode(",",$categories)) as $c) $article->addTag( $c );

        $ref["twitter:title"] = $ps->name;
        $ref["twitter:description"] = $ps->description;
			}else{
        $ogp->setTitle( $company->name );
        $ogp->setDescription( $company->description );
        $ogp->setURL( url_root."/".urlencode($company->url) );

        $ogp->setType( 'article' );

        $seo_img = $company->logo;
        if($seo_img){
            $image = new OpenGraphProtocolImage();
            $image->setURL( url_root.$paths->company_logo->url.$seo_img );
            $image->setSecureURL( str_replace("http://", "https://", url_root.$paths->company_logo->url.$seo_img) );
            $image->setType( 'image/jpeg' );
            $ogp->addImage($image);

            $ref["twitter:image:src"] = url_root.$paths->company_logo->url.$seo_img;
        }

        $article = new OpenGraphProtocolArticle();
        $article->setPublishedTime( date(DATE_ISO8601, strtotime($company->creation_time)) );
        $article->setModifiedTime( new DateTime( 'now', new DateTimeZone( 'Africa/Tunis' ) ) );
        $article->setSection( 'Company' );

        foreach(array_filter(explode(",",$categories)) as $c) $article->addTag( $c );

        $ref["twitter:title"] = $company->name;
        $ref["twitter:description"] = $company->description;
			}
    }

		$company->requests += 1;

		$ps_list = array();
		$ps_organized = array();
		foreach ($company->services as $e) {
			$itm = array(
				"id"=>$e->id,
				"type"=>get_class($e),
				"name"=>$e->name,
				"description"=>$e->description,
				"price"=>$e->price,
				"image"=>($e->image ? $paths->service_image->url.$e->image : null),
				"url"=>url_root."/".$e->url,
				"categories"=>$e->categories,
				"creation_time"=>$e->creation_time
			);

			if(count($itm["categories"])){
				foreach ($itm["categories"] as $c) {
					if(array_key_exists($c->id, $ps_organized)) {
						$ps_organized[$c->id]["childrens"][] = array(
							"id"=>$itm["id"],
							"type"=>$itm["type"],
							"name"=>$itm["name"],
							"description"=>$itm["description"],
							"price"=>$itm["price"],
							"image"=>$itm["image"],
							"url"=>$itm["url"],
							"creation_time"=>$itm["creation_time"]
						);
					}else{
						$ps_organized[$c->id] = array(
							"category" => $c,
							"childrens" => array(
								array(
									"id"=>$itm["id"],
									"type"=>$itm["type"],
									"name"=>$itm["name"],
									"description"=>$itm["description"],
									"price"=>$itm["price"],
									"image"=>$itm["image"],
									"url"=>$itm["url"],
									"creation_time"=>$itm["creation_time"]
								)
							)
						);
					}
				}
			}else{
				$ps_list[] = $itm;
			}

		}

		foreach ($company->products as $e) {
			$itm = array(
				"id"=>$e->id,
				"type"=>get_class($e),
				"name"=>$e->name,
				"description"=>$e->description,
				"price"=>$e->price,
				"rent_price"=>$e->rent_price,
				"image"=>($e->image ? $paths->product_image->url.$e->image : null),
				"url"=>url_root."/".$e->url,
				"categories"=>$e->categories,
				"creation_time"=>$e->creation_time
			);

			if(count($itm["categories"])){
				foreach ($itm["categories"] as $c) {
					if(array_key_exists($c->id, $ps_organized)) {
						$ps_organized[$c->id]["childrens"][] = array(
							"id"=>$itm["id"],
							"type"=>$itm["type"],
							"name"=>$itm["name"],
							"description"=>$itm["description"],
							"price"=>$itm["price"],
							"rent_price"=>$itm["rent_price"],
							"image"=>$itm["image"],
							"url"=>$itm["url"],
							"creation_time"=>$itm["creation_time"]
						);
					}else{
						$ps_organized[$c->id] = array(
							"category" => $c,
							"childrens" => array(
								array(
									"id"=>$itm["id"],
									"type"=>$itm["type"],
									"name"=>$itm["name"],
									"description"=>$itm["description"],
									"price"=>$itm["price"],
									"rent_price"=>$itm["rent_price"],
									"image"=>$itm["image"],
									"url"=>$itm["url"],
									"creation_time"=>$itm["creation_time"]
								)
							)
						);
					}
				}
			}else{
				$ps_list[] = $itm;
			}

		}

		foreach ($ps_organized as &$item) {
			usort($item["childrens"], function($a, $b){
				return $b["creation_time"] - $a["creation_time"];
			});
		}

		usort($ps_organized, function($a, $b){
			if($b["childrens"][0]["creation_time"] == $a["childrens"][0]["creation_time"]) return count($b["childrens"]) - count($a["childrens"]);
			return $b["childrens"][0]["creation_time"] - $a["childrens"][0]["creation_time"];
		});

		usort($ps_list, function($a, $b){
			return $b["creation_time"] - $a["creation_time"];
		});

		include "view_1.php";
	}else{
		include __DIR__."/../404/controller.php";goto skip_this_page;
	}

	skip_this_page:
?>
