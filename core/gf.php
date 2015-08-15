<?php

	class gf {

		public static function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = gf::utf8ize($value);
        }
    } else if (is_string ($mixed)) {
        return utf8_encode($mixed);
    }
    return $mixed;
}

		public static function check_url($url){
			global $db;
			global $reserved_urls;
			if(in_array($url, $reserved_urls)) return false;
			$t = 0;
			$q=$db->query("select count(*) from company where (url='".$url."')");
			$r=$q->fetch_row();
			$t+=$r[0];
			$q=$db->query("select count(*) from shop where (url='".$url."')");
			$r=$q->fetch_row();
			$t+=$r[0];
			$q=$db->query("select count(*) from job where (url='".$url."')");
			$r=$q->fetch_row();
			$t+=$r[0];
			return $t==0;
		}

		public static function get_by_url($url){
			global $db;
			$q=$db->query("select id from company where (url='".$url."')");
			if($q->num_rows==1) {
				$r=$q->fetch_row();
				return new company($r[0]);
			}else{
				$q=$db->query("select id from shop where (url='".$url."')");
				if($q->num_rows==1) {
					$r=$q->fetch_row();
					return new shop($r[0]);
				}else{
					$q=$db->query("select id from job where (url='".$url."')");
					if($q->num_rows==1) {
						$r=$q->fetch_row();
						return new job($r[0]);
					}else{
						return null;
					}
				}
			}
		}


		public static function pay($method, $card_number, $card_password, $amount){

			switch ($method) {
				case 'e_dinar_smart_tunisian_post':

					$payment_recipt="ignored_payment";
					$payment_error="unhandled";

					break;
				case 'visa_electron_tunisian_post':

					$payment_recipt="ignored_payment";
					$payment_error="unhandled";

					break;
				case 'visa':

					$payment_recipt="ignored_payment";
					$payment_error="unhandled";

					break;
				case 'mastecard':

					$payment_recipt="ignored_payment";
					$payment_error="unhandled";

					break;
				default:
					$payment_error = "invalid_method";
					break;
			}

			if(!$payment_error) $rslt = array("status"=>"success", "params"=>array(
				"payment_recipt"=>$payment_recipt
			));
			elseif($payment_error=="invalid_method") $rslt = array("status"=>"invalid_method");
			elseif($payment_error=="invalid_card_number") $rslt = array("status"=>"invalid_card_number");
			elseif($payment_error=="error_card_password") $rslt = array("status"=>"error_card_password");
			elseif($payment_error=="insufficient_balance") $rslt = array("status"=>"insufficient_balance");
			elseif($payment_error)  $rslt = array("status"=>"unhandled_payment_error");

			return $rslt;
		}

		public static function search($q){
			global $db;

			$q = $db->real_escape_string($q);

			$rslt = array();

			$q_company=$db->query("
				SELECT id,
				(((MATCH (name) AGAINST ('$q')) + (MATCH (slogan, description) AGAINST ('$q'))) / 2)
				AS score
    			FROM company WHERE (MATCH (name, slogan, description) AGAINST ('$q'))
    		") or die("q_company : ".$db->error);
			while ($r=$q_company->fetch_row()) {
				$e = new company($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_company_seat=$db->query("
				SELECT id_company, MATCH (name, address, tel, mobile, email) AGAINST ('$q') AS score
    			FROM company_seat WHERE MATCH (name, address, tel, mobile, email) AGAINST ('$q')
			") or die("q_category : ".$db->error);
			while ($r=$q_company_seat->fetch_row()) {
				$c = new company($r[0]);
				if($c->is_contracted) {
					$ex = array_search($c, array_column($rslt, 'obj'));
					if($ex!==false) $rslt[$ex]["score"] += 1;
					else $rslt[] = array("obj" => $c, "score" => 1);
				}
			}

			$q_shop=$db->query("
				SELECT id,
				(((MATCH (name) AGAINST ('$q')) + (MATCH (description, address, tel, mobile, email) AGAINST ('$q'))) / 2)
				AS score
    			FROM shop WHERE MATCH (name, description, address, tel, mobile, email) AGAINST ('$q')
			") or die("q_shop : ".$db->error);
			while ($r=$q_shop->fetch_row()) {
				$e = new shop($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_job=$db->query("
				SELECT id,
				(((MATCH (name) AGAINST ('$q')) + (MATCH (description, address, tel, mobile, email) AGAINST ('$q'))) / 2)
				AS score
    			FROM job WHERE MATCH (name, description, address, tel, mobile, email) AGAINST ('$q')
			") or die("q_job : ".$db->error);
			while ($r=$q_job->fetch_row()) {
				$e = new job($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_product=$db->query("
				SELECT id, MATCH (name, description) AGAINST ('$q') AS score
    			FROM product WHERE MATCH (name, description) AGAINST ('$q')
			") or die("q_product : ".$db->error);
			while ($r=$q_product->fetch_row()) {
				$e = new product($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_service=$db->query("
				SELECT id, MATCH (name, description) AGAINST ('$q') AS score
    			FROM service WHERE MATCH (name, description) AGAINST ('$q')
			") or die("q_service : ".$db->error);
			while ($r=$q_service->fetch_row()) {
				$e = new service($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_category=$db->query("
				SELECT id, MATCH (name) AGAINST ('$q') AS score
    			FROM category WHERE MATCH (name) AGAINST ('$q')
			") or die("q_category : ".$db->error);
			while ($r=$q_category->fetch_row()) {
				$c = new category($r[0]);
				foreach($c->childrens as $child){
					if($child->is_contracted){
						$ex = array_search($child, array_column($rslt, 'obj'));
						if($ex!==false) $rslt[$ex]["score"] += 1;
						else $rslt[] = array("obj" => $child, "score" => 1);
					}
				}

			}

			usort($rslt, function($a, $b) {
			    return $a['score'] - $b['score'];
			});

			return $rslt;

		}

		public static function legacy_search($q){
			global $db;

			$q = $db->real_escape_string($q);

			$rslt = array();

			$q_company=$db->query("
				SELECT id
				FROM company WHERE (concat(IFNULL(name,''),' ',IFNULL(slogan,''),' ',IFNULL(description,'')) like '%".str_replace(" ","%",$q)."%')
    		") or die("q_company : ".$db->error);
			while ($r=$q_company->fetch_row()) {
				$e = new company($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_company_seat=$db->query("
				SELECT id_company
				FROM company_seat WHERE (concat(IFNULL(name,''),' ',IFNULL(address,''),' ',IFNULL(tel,''),' ',IFNULL(mobile,''),' ',IFNULL(email,'')) like '%".str_replace(" ","%",$q)."%')
			") or die("q_category : ".$db->error);
			while ($r=$q_company_seat->fetch_row()) {
				$c = new company($r[0]);
				if($c->is_contracted) {
					$ex = array_search($c, array_column($rslt, 'obj'));
					if($ex!==false) $rslt[$ex]["score"] += 1;
					else $rslt[] = array("obj" => $c, "score" => 1);
				}
			}

			$q_shop=$db->query("
				SELECT id
				FROM shop WHERE (concat(IFNULL(name,''),' ',IFNULL(description,''),' ',IFNULL(address,''),' ',IFNULL(tel,''),' ',IFNULL(mobile,''),' ',IFNULL(email,'')) like '%".str_replace(" ","%",$q)."%')
			") or die("q_shop : ".$db->error);
			while ($r=$q_shop->fetch_row()) {
				$e = new shop($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_job=$db->query("
				SELECT id
				FROM job WHERE (concat(IFNULL(name,''),' ',IFNULL(description,''),' ',IFNULL(address,''),' ',IFNULL(tel,''),' ',IFNULL(mobile,''),' ',IFNULL(email,'')) like '%".str_replace(" ","%",$q)."%')
			") or die("q_job : ".$db->error);
			while ($r=$q_job->fetch_row()) {
				$e = new job($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_product=$db->query("
				SELECT id
				FROM product WHERE (concat(IFNULL(name,''),' ',IFNULL(description,'')) like '%".str_replace(" ","%",$q)."%')
			") or die("q_product : ".$db->error);
			while ($r=$q_product->fetch_row()) {
				$e = new product($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_service=$db->query("
				SELECT id
    			FROM service WHERE (concat(IFNULL(name,''),' ',IFNULL(description,'')) like '%".str_replace(" ","%",$q)."%')
			") or die("q_service : ".$db->error);
			while ($r=$q_service->fetch_row()) {
				$e = new service($r[0]);
				if($e->is_contracted) $rslt[] = array("obj" => $e, "score" => 1);
			}

			$q_category=$db->query("
				SELECT id
    			FROM category WHERE (IFNULL(name,'') like '%".str_replace(" ","%",$q)."%')
			") or die("q_category : ".$db->error);
			while ($r=$q_category->fetch_row()) {
				$c = new category($r[0]);
				foreach($c->childrens as $child){
					if($child->is_contracted){
						$ex = array_search($child, array_column($rslt, 'obj'));
						if($ex!==false) $rslt[$ex]["score"] += 1;
						else $rslt[] = array("obj" => $child, "score" => 1);
					}
				}

			}

			usort($rslt, function($a, $b) {
			    return $a['score'] - $b['score'];
			});

			return $rslt;
		}

		public static function news(){
			global $db;

			$rslt = array();

			$q_company=$db->query("
				SELECT id
				FROM company ORDER BY requests desc, RAND()
    		") or die("q_company : ".$db->error);
			while ($r=$q_company->fetch_row()) {
				$e = new company($r[0]);
				if($e->is_contracted) $rslt[] = $e;
			}

			$q_shop=$db->query("
				SELECT id
				FROM shop ORDER BY requests desc, RAND()
			") or die("q_shop : ".$db->error);
			while ($r=$q_shop->fetch_row()) {
				$e = new shop($r[0]);
				if($e->is_contracted) $rslt[] = $e;
			}

			$q_job=$db->query("
				SELECT id
				FROM job ORDER BY requests desc, RAND()
			") or die("q_job : ".$db->error);
			while ($r=$q_job->fetch_row()) {
				$e = new job($r[0]);
				if($e->is_contracted) $rslt[] = $e;
			}

			shuffle($rslt);

			return $rslt;
		}

		public static function getClientIP(){

			if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
		        return  $_SERVER["HTTP_X_FORWARDED_FOR"];
		    }else if (array_key_exists('REMOTE_ADDR', $_SERVER)) {
		        return $_SERVER["REMOTE_ADDR"];
		    }else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
		        return $_SERVER["HTTP_CLIENT_IP"];
		    }
		    return null;
		}

		public static function generate_guid(){
			if (function_exists('com_create_guid')){
	            return com_create_guid();
	        }else{
	            mt_srand((double)microtime()*10000);
	            $charid = strtoupper(md5(uniqid(rand(), true)));
	            $uuid =  substr($charid, 0, 8).substr($charid, 8, 4).substr($charid,12, 4).substr($charid,16, 4).substr($charid,20,12);
	            return $uuid;
	        }
		}

		public static function randomString($length = 10) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ$£*-+=)_-(&!:?;.,<>#~[]@|{}';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}

	}
?>
