<?php

	$rslt = array();
	if(!isset($_GET["co"]) && !isset($_GET["sh"]) && !isset($_GET["jo"])){
		$_GET["co"] = 1;
		$_GET["sh"] = 1;
		$_GET["jo"] = 1;
	}else{
		if(!isset($_GET["co"])) $_GET["co"] = 0;
		if(!isset($_GET["sh"])) $_GET["sh"] = 0;
		if(!isset($_GET["jo"])) $_GET["jo"] = 0;
	}
	if(isset($_GET["ca"]) || isset($_GET["lo"])){
		if($_GET["co"]){
			$q_company = "select distinct
				category_children.id_children
				from
				category_children,
				company,
				company_seat
				where
				category_children.children_type='company'
				and
				category_children.id_children=company.id
				and
				company_seat.id_company=company.id
			";
		}
		if($_GET["sh"]){
			$q_shop = "select distinct
				category_children.id_children
				from
				category_children,
				shop
				where
				category_children.children_type='shop'
				and
				category_children.id_children=shop.id
			";
		}
		if($_GET["jo"]){
			$q_job = "select distinct
				category_children.id_children
				from
				category_children,
				job
				where
				category_children.children_type='job'
				and
				category_children.id_children=job.id
			";
		}

		$ca_list = array();
		if(isset($_GET["ca"])){
			foreach ($_GET["ca"] as $ca) {
				$ca = new category($ca);
				$ca_list[] = $ca;
				$ca_list = array_merge($ca_list, $ca->all_subcategories_list);
			}
			$ca_str = implode(",", array_map(function ($obj){
				return $obj->id;
			}, $ca_list));
			if($_GET["co"]) $q_company.="and category_children.id_category IN (".$ca_str.")";
			if($_GET["sh"]) $q_shop.="and category_children.id_category IN (".$ca_str.")";
			if($_GET["jo"]) $q_job.="and category_children.id_category IN (".$ca_str.")";
		}
		$lo_list = array();
		if(isset($_GET["lo"])){
			foreach ($_GET["lo"] as $lo) {
				$lo = new locality($lo);
				$lo_list[] = $lo;
				$lo_list = array_merge($lo_list, $lo->all_childrens_list);
			}
			$lo_str = implode(",", array_map(function ($obj){
				return $obj->id;
			}, $lo_list));
			if($_GET["co"]) $q_company.="and company_seat.id_locality IN (".$lo_str.")";
			if($_GET["sh"]) $q_shop.="and shop.id_locality IN (".$lo_str.")";
			if($_GET["jo"]) $q_job.="and job.id_locality IN (".$lo_str.")";
		}

		if($_GET["jo"]){
			$qj=$db->query($q_job);
			while($r=$qj->fetch_row()){
				$e = new job($r[0]);
				$rslt[] = array(
					//"type"=>get_class($e),
					"title"=>substr($e->name, 0, 20),
					"content"=>substr($e->description, 0, 100),
					"image_url"=>($e->image ? $paths->job_image->url.$e->image : null),
					"url"=>"/".$e->url
				);
			}
		}
		if($_GET["co"]){
			$qc=$db->query($q_company);
			while($r=$qc->fetch_row()){
				$e = new company($r[0]);
				$rslt[] = array(
					//"type"=>get_class($e),
					"title"=>substr($e->name, 0, 20),
					"content"=>substr($e->description, 0, 100),
					"image_url"=>($e->logo ? $paths->company_logo->url.$e->logo : null),
					"url"=>"/".$e->url
				);
			}
		}
		if($_GET["sh"]){
			$qs=$db->query($q_shop);
			while($r=$qs->fetch_row()){
				$e = new shop($r[0]);
				$rslt[] = array(
					//"type"=>get_class($e),
					"title"=>substr($e->name, 0, 20),
					"content"=>substr($e->description, 0, 100),
					"image_url"=>($e->image ? $paths->shop_image->url.$e->image : null),
					"url"=>"/".$e->url
				);
			}
		}
	}

	$title="";
	if((isset($_GET["ca"]) || isset($_GET["lo"])) && ($_GET["co"] || $_GET["sh"] || $_GET["jo"])){
		if($_GET["co"] && $_GET["sh"] && $_GET["jo"]){
			$title.="Les pages";
		}else{
			$title.="Les";
			if($_GET["jo"]) $title.=" métiers";
			if($_GET["sh"]) $title.=($_GET["jo"]?($_GET["co"]?", ":" et "):" ")."boutiques";
			if($_GET["co"]) $title.=($_GET["jo"] || $_GET["sh"]?" et ":" ")."sociétés";
		}
		if(isset($_GET["ca"])){
			$title.=" de";
			$i=0;
			$len=count($_GET["ca"]);
			foreach ($_GET["ca"] as $ca) {
				$ca = new category($ca);
				$title.=($i==0?" ":($i<$len-1?", ":" et ")).strtolower($ca->name);
				$i++;
			}
		}
		if(isset($_GET["lo"])){
			$title.=" situés à";
			$i=0;
			$len=count($_GET["lo"]);
			foreach ($_GET["lo"] as $lo) {
				$lo = new locality($lo);
				$title.=($i==0?" ":($i<$len-1?", ":" et ")).$lo->long_name;
				$i++;
			}
		}
	}

	if(isset($_GET["fetchdata"])){
		$a=json_encode(array("title"=>$title, "rslt"=>$rslt));
		if (json_last_error() == JSON_ERROR_UTF8){
			$rslt = gf::utf8ize($rslt);
			$a=json_encode(array("title"=>$title, "rslt"=>$rslt));
		}
		die($a);
	}

	if(isset($ogp) && $title){
		$ogp->setTitle( "Servicek.net : ".$title );
		$ogp->setURL( url_root.$_SERVER["REQUEST_URI"] );
	}

	include "view_1.php";
?>
