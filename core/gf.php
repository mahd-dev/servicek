<?php

	class gf {

		public static function search($q){
			global $db;

			$q = $db->real_escape_string($q);
			
			$rslt = array();

			$q_company=$db->query("
				SELECT company.id, 
				(((MATCH (company.name) AGAINST ('$q')) + (MATCH (company.slogan, company.description, company_seat.name, company_seat.address, company_seat.tel, company_seat.mobile, company_seat.email) AGAINST ('$q'))) / 2)
				AS score
    			FROM company, company_seat WHERE MATCH (company.name, company.slogan, company.description, company_seat.name, company_seat.address, company_seat.tel, company_seat.mobile, company_seat.email) AGAINST ('$q')
    		") or die("q_company : ".$db->error);
			while ($r=$q_company->fetch_row()) $rslt[] = array("obj" => new company($r[0]), "score" => $r[1]);

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
					$ex = array_search($obj, array_column($rslt, 'obj'));
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

	}
?>