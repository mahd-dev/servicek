<?php

	class gf {

		public static function pay($method, $card_number, $card_password, $amount){
			
			switch ($method) {
				case 'e_dinar_smart_tunisian_post':

					$payment_recipt="ignored_payment";
					$payment_error=null;

					break;
				case 'visa_electron_tunisian_post':

					$payment_recipt="ignored_payment";
					$payment_error=null;

					break;
				case 'visa':

					$payment_recipt="ignored_payment";
					$payment_error=null;

					break;
				case 'mastecard':

					$payment_recipt="ignored_payment";
					$payment_error=null;
					
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
			while ($r=$q_company->fetch_row()) $rslt[] = array("obj" => new company($r[0]), "score" => $r[1]);

			$q_company_seat=$db->query("
				SELECT id_company, MATCH (name, address, tel, mobile, email) AGAINST ('$q') AS score
    			FROM company_seat WHERE MATCH (name, address, tel, mobile, email) AGAINST ('$q')
			") or die("q_category : ".$db->error);
			while ($r=$q_company_seat->fetch_row()) {
				$c = new company($r[0]);
				$ex = array_search($c, array_column($rslt, 'obj'));
				if($ex) $rslt[$ex]["score"] += $r[1];
				else $rslt[] = array("obj" => $c, "score" => $r[1]);
			}

			// 


			$q_job=$db->query("
				SELECT id,
				(((MATCH (name) AGAINST ('$q')) + (MATCH (description, address, tel, mobile, email) AGAINST ('$q'))) / 2)
				AS score
    			FROM job WHERE MATCH (name, description, address, tel, mobile, email) AGAINST ('$q')
			") or die("q_job : ".$db->error);
			while ($r=$q_job->fetch_row()) $rslt[] = array("obj" => new job($r[0]), "score" => $r[1]);
			
			$q_product=$db->query("
				SELECT id, MATCH (name, description) AGAINST ('$q') AS score
    			FROM product WHERE MATCH (name, description) AGAINST ('$q')
			") or die("q_product : ".$db->error);
			while ($r=$q_product->fetch_row()) $rslt[] = array("obj" => new product($r[0]), "score" => $r[1]);
			
			$q_service=$db->query("
				SELECT id, MATCH (name, description) AGAINST ('$q') AS score
    			FROM service WHERE MATCH (name, description) AGAINST ('$q')
			") or die("q_service : ".$db->error);
			while ($r=$q_service->fetch_row()) $rslt[] = array("obj" => new service($r[0]), "score" => $r[1]);

			$q_category=$db->query("
				SELECT id, MATCH (name) AGAINST ('$q') AS score
    			FROM category WHERE MATCH (name) AGAINST ('$q')
			") or die("q_category : ".$db->error);
			while ($r=$q_category->fetch_row()) {
				$c = new category($r[0]);
				foreach($c->childrens as $child){
					$ex = array_search($child, array_column($rslt, 'obj'));
					if($ex) $rslt[$ex]["score"] += $r[1];
					else $rslt[] = array("obj" => $child, "score" => $r[1]);
				}
				
			}
			
			usort($rslt, function($a, $b) {
			    return $a['score'] - $b['score'];
			});

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
		

	}
?>