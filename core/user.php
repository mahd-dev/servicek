<?php
	class user{

		private $id;

		public function __construct($nid){
			$this->id = $nid;
		}

		public function __set($name,$value){
			global $db;
			if ($this->id != NULL) {
				switch($name){
					case "password":
						$db->query("update user set ".$name."=".($value===null?"NULL":"ENCRYPT('".$db->real_escape_string($value)."')")." where (id='".$this->id."')");
					break;
					default :
						$db->query("update user set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
					case "is_master":
						return $this->type=="master";
					break;
					case "is_agent":
						return $this->type=="agent";
					break;
					case "pages":
						return array_merge($this->companies, $this->shops, $this->jobs);
					break;
					case "companies":
						$list = array();
						$q=$db->query("select id_company from user_admin where (id_user='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new company($r[0]);
						return $list;
					break;
					case "shops":
						$list = array();
						$q=$db->query("select id from shop where (id_admin='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new shop($r[0]);
						return $list;
					break;
					case "jobs":
						$list = array();
						$q=$db->query("select id from job where (id_admin='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new job($r[0]);
						return $list;
					break;
					case "count_pages":
						$q=$db->query("select count(*) from job where (id_admin='".$this->id."')");
						$r1=$q->fetch_row();
						$q=$db->query("select count(*) from shop where (id_admin='".$this->id."')");
						$r2=$q->fetch_row();
						$q=$db->query("select count(*) from user_admin where (id_user='".$this->id."')");
						$r3=$q->fetch_row();
						return $r1[0] + $r2[0] + $r3[0];
					break;

					case "has_agent_requests":
            $q=$db->query("select count(*) from agent_request where (id_for='".$this->id."' and rel_type='user')");
            $r=$q->fetch_row();
            return $r[0]>0;
          break;
          case "agent_requests":
            $list = array();
            $q=$db->query("select id, creation_time from agent_request where (id_for='".$this->id."' and rel_type='user')");
            while($r=$q->fetch_row()) $list[] = array("id"=>$r[0], "creation_time"=>$r[1]);
            return $list;
          break;

					case 'unseen_pages':
						$list = array();
						$last_seen_date = date("Y-m-d h:i:s", strtotime($this->seen_new_pages_until));
						$q=$db->query("select id from company where (creation_time>='".$last_seen_date."')");
						while($r=$q->fetch_row()) $list[] = new company($r[0]);
						$q=$db->query("select id from shop where (creation_time>='".$last_seen_date."')");
						while($r=$q->fetch_row()) $list[] = new shop($r[0]);
						$q=$db->query("select id from job where (creation_time>='".$last_seen_date."')");
						while($r=$q->fetch_row()) $list[] = new job($r[0]);
						usort($list, function ($a, $b){
							$ta = strtotime($a->creation_time);
							$tb = strtotime($b->creation_time);
							if($ta==$tb) return 0;
							else return ($a<$b?-1:1);
						});
						return $list;
					break;

					default:
						$q=$db->query("select ".$name." from user where (id='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0];
					break;
				}
			}else{
				return NULL;
			}
		}

		public static function get_admins(){
			global $db;
			$list = array();
			$q=$db->query("select id from user where (type='master')");
			while($r=$q->fetch_row()) $list[] = new user($r[0]);
			return $list;
		}

		public function new_pages_seen($until=null){
			global $db;
			$this->seen_new_pages_until = date("Y-m-d h:i:s", ($until?$until:time()));
		}

		public static function username_exists($username){
			global $db;
			$q=$db->query("select count(username) from user where (username='".$username."')");
			$r=$q->fetch_row();
			return $r[0]>0;
		}

		public static function create($username,$password){
			global $db;
			if(user::username_exists($username)) return "username_exists";
			$db->query("insert into user (username,password) values('".$db->real_escape_string($username)."', ENCRYPT('".$db->real_escape_string($password)."'))");
			return new user($db->insert_id);
		}

		public function delete(){
			global $db;
			foreach($this->jobs as $j) $j->delete();
			foreach($this->companies as $c){
				if($c->count_admins==1) $c->delete();
			}
			$db->query("delete from user where (id='".$this->id."')");
		}

		public static function login($username, $password, $ip){
			global $db;

			// security params
			$allowed_attempts = 5;
			$waiting_minutes = 15;

			if( $ip == NULL ) return array("status"=>"restricted_host");

			$q=$db->query("select id, password from user where (username='".$username."')");
			if($q->num_rows==0){
				return array("status"=>"username_error");
			}else{
				$r=$q->fetch_row();
				$db->query("delete from restricted_ip where (TIMESTAMPDIFF(MINUTE,restriction_time,NOW())>=".$waiting_minutes.")");

				$ch_ip=$db->query("select attempts, TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(restriction_time, INTERVAL ".$waiting_minutes." MINUTE)) from restricted_ip where (ip_address='".$ip."')");

				$ch_r=$ch_ip->fetch_row();
				$attempts = ($ch_ip->num_rows > 0 ? ($ch_r[0] + 1) : 1);

				if( $attempts > $allowed_attempts ) return array("status" => "waiting_restriction_time", "remaining_time" => $ch_r[1]);
				else {

					if (!hash_equals($r[1], crypt($password, $r[1]))) {
						$db->query("INSERT INTO restricted_ip (ip_address) values('".$ip."') ON DUPLICATE KEY UPDATE attempts=attempts+1, restriction_time=NOW()");
						$ch_ip=$db->query("select TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(restriction_time, INTERVAL ".$waiting_minutes." MINUTE)) from restricted_ip where (ip_address='".$ip."')");
						$ch_r=$ch_ip->fetch_row();
						if( $attempts >= $allowed_attempts ) return array("status" => "waiting_restriction_time", "remaining_time" => $ch_r[0]);
						return array("status" => "password_error", "remaining_attempts" => ($allowed_attempts - $attempts));
					} else {
						$db->query("delete from restricted_ip where (ip_address='".$ip."')");
						return new user($r[0]);
					}
				}
			}
		}

		public static function agent_code($code, $ip){
			global $db;

			// security params
			$allowed_attempts = 5;
			$waiting_minutes = 15;

			if( $ip == NULL ) return array("status"=>"restricted_host");

			$q=$db->query("select id, username, password from user where (('".$code."' like concat(IFNULL(username,''),'%')) and (type='agent'))");

			$db->query("delete from restricted_ip where (TIMESTAMPDIFF(MINUTE,restriction_time,NOW())>=".$waiting_minutes.")");

			$ch_ip=$db->query("select attempts, TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(restriction_time, INTERVAL ".$waiting_minutes." MINUTE)) from restricted_ip where (ip_address='".$ip."')");

			$ch_r=$ch_ip->fetch_row();
			$attempts = ($ch_ip->num_rows > 0 ? ($ch_r[0] + 1) : 1);

			if( $attempts > $allowed_attempts ) return array("status" => "waiting_restriction_time", "remaining_time" => $ch_r[1]);
			else {
				while ($r=$q->fetch_row()) {
					if(substr($code, 0, strlen($r[1]))==$r[1] && hash_equals($r[2], crypt(substr($code, strlen($r[1])), $r[2]))){
						$db->query("delete from restricted_ip where (ip_address='".$ip."')");
						return new user($r[0]);
					}
				}
				$db->query("INSERT INTO restricted_ip (ip_address) values('".$ip."') ON DUPLICATE KEY UPDATE attempts=attempts+1, restriction_time=NOW()");
				$ch_ip=$db->query("select TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(restriction_time, INTERVAL ".$waiting_minutes." MINUTE)) from restricted_ip where (ip_address='".$ip."')");
				$ch_r=$ch_ip->fetch_row();
				if( $attempts >= $allowed_attempts ) return array("status" => "waiting_restriction_time", "remaining_time" => $ch_r[0]);
				return array("status" => "code_error", "remaining_attempts" => ($allowed_attempts - $attempts));
			}
		}

		public function request_agent(){
        global $db;
        $db->query("insert into agent_request (id_for, rel_type) values('".$this->id."', 'user')");
    }

    public function clear_agent_requests(){
        global $db;
        $db->query("delete from agent_request where (id_for = '".$this->id."' and rel_type = 'user')");
    }

	}
?>
