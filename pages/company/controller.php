<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$company=new company($_GET['id']);
		if (!$company->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}
	
	$s=$company->seats[0];
	$geolocation=json_decode($s->geolocation);
	$is_contracted=$company->is_contracted;
	if($is_contracted) $is_trial = ($company->current_contract->type == 0);
	$categories = array();
	$nb_categories = count($categories);
	$categories_json = array();
	foreach ($company->categories as $cat){
		$categories_json[] = intval($cat->id);
		$categories[] = $cat->name;
	}
	$categories = implode(", ", $categories);

	if ($user!=null && ($company->is_assigned_to_admin($user) || $user->is_master)) {
		if (isset($_POST['for']) && isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
			switch ($_POST['for']) {
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
					}
					break;
				case 'service':
					$service = new service($_POST['pk']);
					switch ($_POST['name']) {
						case 'name': $service->name=$_POST['value']; break;
						case 'description': $service->description=$_POST['value']; break;
						case 'price': $service->price=$_POST['value']; break;
						case 'rent_price': $service->rent_price=$_POST['value']; break;
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
			die(json_encode(array("status"=>"success", "id"=>$service->id)));

		}elseif (isset($_POST['new_product'])) {

			$product=product::create($company);
			die(json_encode(array("status"=>"success", "id"=>$product->id)));

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
		}

		$available_categories = array();
		foreach (category::get_roots() as $c) $available_categories[] = array("id"=>intval($c->id), "text"=>$c->name);

		include "view_2.php";
	}elseif($is_contracted){

		// defining seo parameters
		if(isset($ogp)){
	        $ogp->setTitle( $company->name );
	        $ogp->setDescription( $company->description );
	        $ogp->setURL( url_root."/".$company->url );

	        $ogp->setType( 'article' );

	        $seo_img = $company->logo;
	        if($seo_img){
	            $image = new OpenGraphProtocolImage();
	            $image->setURL( $paths->company_logo->url.$seo_img );
	            $image->setSecureURL( $paths->company_logo->url.$seo_img );
	            $image->setType( 'image/jpeg' );
	            $ogp->addImage($image);

	            $ref["twitter:image:src"] = $paths->company_logo->url.$seo_img;
	        }
	        
	        $article = new OpenGraphProtocolArticle();
	        $article->setPublishedTime( date(DATE_ISO8601, strtotime($company->creation_time)) );
	        $article->setModifiedTime( new DateTime( 'now', new DateTimeZone( 'Africa/Tunis' ) ) );
	        $article->setSection( 'Company' );
	        foreach(array_filter(explode(",",$categories)) as $c) $article->addTag( $c );

	        $ref["twitter:title"] = $company->name;
            $ref["twitter:description"] = $company->description;
	        
	    }

		include "view_1.php";
	}else{
		include __DIR__."/../404/controller.php";goto skip_this_page;
	}
			
	skip_this_page:
?>
