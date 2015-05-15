<?php
	class company{

		private $id;
	
		public function __construct($nid){
			$this->id = $nid;
		}

		

		public function __set($name,$value){
			global $db;
			if ($this->id != NULL) {
				switch($name){
					default :
						$db->query("update company set ".$name."='".$db->real_escape_string($value)."' where (id='".$this->id."')");
					break;
				}
			}
		}

		public function __get($name){
			global $db;
			if ($this->id != NULL) {
				switch($name){
					case "id":
						return $this->id;
					break;
					case "isvalid":
						$q=$db->query("select count(*) from company where (id='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0]==1;
					break;
					case "admins":
						$list = array();
						$q=$db->query("select id_user from user_admin where (id_page='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new user($r[0]);
						return $list;
					break;
					case "count_admins":
						$q=$db->query("select count(*) from user_admin where (id_page='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0];
					break;
					
					case "seats":
						$list = array();
						$q=$db->query("select id from company_seat where (id_company='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new company_seat($r[0]);
						return $list;
					break;
					
					case "products":
						$list = array();
						$q=$db->query("select id from product where (id_company='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new product($r[0]);
						return $list;
					break;
					case "services":
						$list = array();
						$q=$db->query("select id from service where (id_company='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new service($r[0]);
						return $list;
					break;
					case "offers":
						$list = array();
						$q=$db->query("select id from offer where (id_company='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new offer($r[0]);
						return $list;
					break;
					
					case "categories":
						$list = array();
						$q=$db->query("select id_category from category_children where (id_children='".$this->id."' and children_type='company')");
						while($r=$q->fetch_row()) $list[] = new category($r[0]);
						return $list;
					break;
					
					case "is_contracted":
						$q=$db->query("select count(id) from contract where (id_page='".$this->id."' and page_type='company' and TIMESTAMPDIFF(DAY,NOW(),DATE_ADD(creation_time, INTERVAL duration DAY)) >= 0)");
						$r=$q->fetch_row();
						return $r[0]>0;
					break;					
					case "current_contract":
						$q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='company' and TIMESTAMPDIFF(DAY,NOW(),DATE_ADD(creation_time, INTERVAL duration DAY)) >= 0) ORDER BY DATE_ADD(creation_time, INTERVAL duration DAY) DESC LIMIT 1");
						if($q->num_rows==0) return null;
						else{
							$r=$q->fetch_row();
							return new contract($r[0]);
						}
					break;
					case "available_contracts":
						$q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='company' and TIMESTAMPDIFF(DAY,NOW(),DATE_ADD(creation_time, INTERVAL duration DAY)) >= 0)");
						$list = array();
						while($r=$q->fetch_row()) $list[] = new contract($r[0]);
						return $list;
					break;
					case "all_contracts":
						$q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='company')");
						$list = array();
						while($r=$q->fetch_row()) $list[] = new contract($r[0]);
						return $list;
					break;
					
					case "url":
						$q=$db->query("select url from company where (id='".$this->id."')");
						$r=$q->fetch_row();
						if($r[0]) return $r[0];
						else return "company/".$this->id;
					break;

					case "has_agent_requests":
                        $q=$db->query("select count(*) from agent_request where (id_for='".$this->id."' and rel_type='company')");
                        $r=$q->fetch_row();
                        return $r[0]>0;
                    break;
                    case "agent_requests":
                        $list = array();
                        $q=$db->query("select id, creation_time from agent_request where (id_for='".$this->id."' and rel_type='company')");
                        while($r=$q->fetch_row()) $list[] = array("id"=>$r[0], "creation_time"=>$r[1]);
                        return $list;
                    break;

					default:
						$q=$db->query("select ".$name." from company where (id='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0];
					break;
				}
			}else{
				return NULL;
			}
		}

		public function delete(){
			global $db;
			foreach ($this->seats as $s) $s->delete();
			foreach ($this->products as $s) $s->delete();
			foreach ($this->services as $s) $s->delete();
			foreach ($this->offers as $s) $s->delete();
			$db->query("delete from category_children where (id_children='".$this->id."' and children_type='company')");
			$db->query("delete from user_admin where (id_page='".$this->id."')");
			$db->query("delete from company where (id='".$this->id."')");
		}

		public static function create($user){
			global $db;
			$db->query("insert into company values()");
			$nid = $db->insert_id;
			$db->query("insert into user_admin (id_user, id_company) values('".$user->id."', '".$nid."')");
			return new company($nid);
		}

		public static function get_all(){
			global $db;
			$list = array();
			$q = $db->query("select id from company");
			while($r = $q->fetch_row()) $list[] = new company($r[0]);
			return $list;
		}

		public function assign_to_admin($user){
			global $db;
			$db->query("replace into user_admin (id_user, id_company) values('".$user->id."', '".$this->id."')");
		}

		public function unassign_from_admin($user){
			global $db;
			$db->query("delete from user_admin where (id_user='".$user->id."' and id_company='".$this->id."')");
		}

		public function is_assigned_to_admin($user){
			global $db;
			$q=$db->query("select count(*) from user_admin where (id_user='".$user->id."' and id_company='".$this->id."')");
			$r=$q->fetch_row();
			return $r[0]==1;
		}

		public function assign_to_category($category){
			global $db;
			$db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'company')");
		}

		public function unassign_from_category($category){
			global $db;
			$db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='company')");
		}

		public function unassign_from_all_categories(){
			global $db;
			$db->query("delete from category_children where (id_children='".$this->id."' and children_type='company')");
		}

		public static function check_url($url){
			global $db;
			global $reserved_urls;
			if(in_array($url, $reserved_urls)) return false;
			$q=$db->query("select count(*) from company where (url='".$url."')");
			$r=$q->fetch_row();
			return $r[0]==0;
		}

		public static function get_by_url($url){
			global $db;
			$q=$db->query("select id from company where (url='".$url."')");
			if($q->num_rows==0) return null;
			$r=$q->fetch_row();
			return new company($r[0]);
		}

		public function request_agent(){
			global $db;
			$db->query("insert into agent_request (id_for, rel_type) values('".$this->id."', 'company')");
		}

        public function clear_agent_requests(){
            global $db;
            $db->query("delete from agent_request where (id_for = '".$this->id."' and rel_type = 'company')");
        }

	}
?>
