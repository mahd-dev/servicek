<?php
	if (!isset($_GET['id'])) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	else{
		$job=new job($_GET['id']);
		if (!$job->isvalid) {include __DIR__."/../404/controller.php";goto skip_this_page;}
	}

	$geolocation=json_decode($job->geolocation);
	$is_contracted = $job->is_contracted;
	if($is_contracted) $is_trial = ($job->current_contract->type == 0);
	$categories = array();
	$categories_json = array();
	foreach ($job->categories as $c){
		$categories_json[] = intval($c->id);
		$categories[] = $c->name;
	}
	$categories = implode(", ", $categories);

	if ($job->admin==$user || ($user && $user->is_master)) {
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
				case 'categories' :
					if(count($_POST['value'])==0){
						header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
						echo "Domaine d'activité requit";
						die();
					}
					$job->unassign_from_all_categories();
					foreach ($_POST['value'] as $value) {
						$job->assign_to_category(new category(intval($value)));
					}
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

		$available_categories = array();
		foreach (category::get_roots() as $c) $available_categories[] = array("id"=>intval($c->id), "text"=>$c->name);

		include "view_2.php";
	}elseif($is_contracted){

		// defining seo parameters
		if(isset($ogp)){
	        $ogp->setTitle( $job->name );
	        $ogp->setDescription( $job->description );
	        $ogp->setURL( url_root."/".$job->url );

	        $ogp->setType( 'article' );

	        $seo_img = $job->image;
	        if($seo_img){
	            $image = new OpenGraphProtocolImage();
	            $image->setURL( $paths->job_image->url.$seo_img );
	            $image->setSecureURL( $paths->job_image->url.$seo_img );
	            $image->setType( 'image/jpeg' );
	            $ogp->addImage($image);

	            $ref["twitter:image:src"] = $paths->job_image->url.$seo_img;
	        }
	        
	        $article = new OpenGraphProtocolArticle();
	        $article->setPublishedTime( date(DATE_ISO8601, strtotime($job->creation_time)) );
	        $article->setModifiedTime( new DateTime( 'now', new DateTimeZone( 'Africa/Tunis' ) ) );
	        $article->setSection( 'Job' );
	        foreach(array_filter(explode(",",$categories)) as $c) $article->addTag( $c );

	        $ref["twitter:title"]=$job->name;
            $ref["twitter:description"]=$job->description;
	        
	    }

		include "view_1.php";
	}else{
		include __DIR__."/../404/controller.php";goto skip_this_page;
	}
			
	skip_this_page:	
?>