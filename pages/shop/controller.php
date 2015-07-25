<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$shop=new shop($_GET['id']);
		if (!$shop->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}

	$geolocation=json_decode($shop->geolocation);
	$is_contracted=$shop->is_contracted;
	if($is_contracted) $is_trial = ($shop->current_contract->type == 0);
	$categories = array();
	$nb_categories = count($categories);
	$categories_json = array();
	foreach ($shop->categories as $cat){
		$categories_json[] = intval($cat->id);
		$categories[] = $cat->name;
	}
	$categories = implode(", ", $categories);

	if ($user!=null && ($shop->admin==$user || $user->is_master)) {
		if (isset($_POST['element']) && isset($_POST['pk']) && isset($_POST['name']) && isset($_POST['value'])) {
			switch ($_POST['element']) {
				case 'shop':
					switch ($_POST['name']) {
						case 'name': $shop->name=$_POST['value']; break;
						case 'description': $shop->description=$_POST['value']; break;
						case 'categories' :
							if(count($_POST['value'])==0){
								header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
								echo "Domaine d'activité requit";
								die();
							}
							$shop->unassign_from_all_categories();
							foreach ($_POST['value'] as $value) {
								$shop->assign_to_category(new category(intval($value)));
							}
						break;
					}
					break;
				case 'seat':
					switch ($_POST['name']) {
						case 'address': $shop->address=$_POST['value']; break;
						case 'tel': $shop->tel=$_POST['value']; break;
						case 'mobile': $shop->mobile=$_POST['value']; break;
						case 'email': $shop->email=$_POST['value']; break;
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
			$shop->geolocation = json_encode(array("longitude"=>$_POST["longitude"], "latitude"=>$_POST["latitude"]));
			die("success");

		}elseif (isset($_POST['new_service'])) {

			$service=service::create($shop);
			die(json_encode(array("status"=>"success", "id"=>$service->id)));

		}elseif (isset($_POST['new_product'])) {

			$product=product::create($shop);
			die(json_encode(array("status"=>"success", "id"=>$product->id)));

		}elseif (isset($_POST['delete_service'])) {

			$service=new service($_POST['delete_service']);
			$service->delete();

			die(json_encode(array("status"=>"success")));

		}elseif (isset($_POST['delete_product'])) {

			$product=new product($_POST['delete_product']);
			$product->delete();

			die(json_encode(array("status"=>"success")));

		}elseif(isset($_POST["file"]) && $_POST["file"]=="image"){

			$oldname=$paths->shop_image->dir.$shop->image;

			if(file_exists($oldname) && is_file($oldname)) unlink($oldname);

			$name=gf::generate_guid().".".end((explode(".", $_FILES["image"]["name"])));
			move_uploaded_file($_FILES["image"]["tmp_name"], $paths->shop_image->dir.$name);

			$shop->image=$name;

			die("success");
		}elseif(isset($_POST["file"]) && $_POST["file"]=="cover"){

			$oldname=$paths->shop_cover->dir.$shop->cover;

			if(file_exists($oldname) && is_file($oldname)) unlink($oldname);

			$name=gf::generate_guid().".".end((explode(".", $_FILES["cover"]["name"])));
			move_uploaded_file($_FILES["cover"]["tmp_name"], $paths->shop_cover->dir.$name);

			$shop->cover=$name;

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
		foreach (category::get_available_for('shop') as $c) $available_categories[] = array("id"=>intval($c->id), "text"=>$c->name);

		include "view_2.php";
	}elseif($is_contracted){

		if(isset($_GET["product"])) $ps=new product($_GET["product"]);
		elseif(isset($_GET["service"])) $ps=new service($_GET["service"]);

		// defining seo parameters
		if(isset($ogp)){
			if(isset($ps)){
				$ogp->setTitle( $ps->name );
        $ogp->setDescription( $ps->description );
        $ogp->setURL( url_root."/".$shop->url."/".get_class($ps)."/".$ps->id );

        $ogp->setType( 'article' );

        $seo_img = $ps->image;
        if($seo_img){
					switch (get_class($ps)) {
						case 'product': $img_path=$paths->product_image->url.$seo_img; break;
						case 'service': $img_path=$paths->service_image->url.$seo_img; break;
					}
          $image = new OpenGraphProtocolImage();
          $image->setURL( $img_path );
          $image->setSecureURL( $img_path );
          $image->setType( 'image/jpeg' );
          $ogp->addImage($image);

          $ref["twitter:image:src"] = $img_path;
        }

        $article = new OpenGraphProtocolArticle();
        $article->setPublishedTime( date(DATE_ISO8601, strtotime($shop->creation_time)) );
        $article->setModifiedTime( new DateTime( 'now', new DateTimeZone( 'Africa/Tunis' ) ) );
        $article->setSection( get_class($ps) );

        foreach(array_filter(explode(",",$categories)) as $c) $article->addTag( $c );

        $ref["twitter:title"] = $ps->name;
        $ref["twitter:description"] = $ps->description;
			}else{
        $ogp->setTitle( $shop->name );
        $ogp->setDescription( $shop->description );
        $ogp->setURL( url_root."/".$shop->url );

        $ogp->setType( 'article' );

        $seo_img = $shop->image;
        if($seo_img){
            $image = new OpenGraphProtocolImage();
            $image->setURL( $paths->shop_image->url.$seo_img );
            $image->setSecureURL( $paths->shop_image->url.$seo_img );
            $image->setType( 'image/jpeg' );
            $ogp->addImage($image);

            $ref["twitter:image:src"] = $paths->shop_image->url.$seo_img;
        }

        $article = new OpenGraphProtocolArticle();
        $article->setPublishedTime( date(DATE_ISO8601, strtotime($shop->creation_time)) );
        $article->setModifiedTime( new DateTime( 'now', new DateTimeZone( 'Africa/Tunis' ) ) );
        $article->setSection( 'shop' );

        foreach(array_filter(explode(",",$categories)) as $c) $article->addTag( $c );

        $ref["twitter:title"] = $shop->name;
        $ref["twitter:description"] = $shop->description;
			}
    }

		$shop->requests += 1;

		include "view_1.php";
	}else{
		include __DIR__."/../404/controller.php";goto skip_this_page;
	}

	skip_this_page:
?>
