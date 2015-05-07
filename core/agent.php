<?php
	class agent{

		private $id;

		public function __construct($nid){
			$this->id = $nid;
		}

		public function __set($name,$value){
			global $db;
			if ($this->id != NULL) {
				switch($name){
					default :
						$db->query("update agent set ".$name."='".$db->real_escape_string($value)."' where (id='".$this->id."')");
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

					case "contracts":
						$list = array();
						$q=$db->query("select id_company from agent_admin where (id_agent='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new company($r[0]);
						return $list;
					break;

					case "count_contracts":
						$q=$db->query("select count(*) from contracts where (id_agent='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0];
					break;

					default:
						$q=$db->query("select ".$name." from agent where (id='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0];
					break;
				}
			}else{
				return NULL;
			}
		}

		public static function username_exists($username){
			global $db;
			$q=$db->query("select count(username) from agent where (username='".$username."')");
			$r=$q->fetch_row();
			return $r[0]>0;
		}

		public static function create($username,$password){
			global $db;
			if(agent::username_exists($username)) return "username_exists";
			$db->query("insert into agent (username,password) values('".$db->real_escape_string($username)."','".$db->real_escape_string($password)."')");
			return new agent($db->insert_id);
		}

		public function delete(){
			global $db;
			$db->query("delete from agent where (id='".$this->id."')");
		}

		public function login_by_code($code, $ip){
			global $db;
			
			// security params
			$allowed_attempts = 5; 
			$waiting_minutes = 15;

			if( $ip == NULL ) return array("status"=>"restricted_host");

			$q=$db->query("select id from agent where (code='".$code."')");
			
			$db->query("delete from restricted_ip where (TIMESTAMPDIFF(MINUTE,restriction_time,NOW())>=".$waiting_minutes.")");

			$ch_ip=$db->query("select attempts, TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(restriction_time, INTERVAL ".$waiting_minutes." MINUTE)) from restricted_ip where (ip_address='".$ip."')");

			$ch_r=$ch_ip->fetch_row();
			$attempts = ($ch_ip->num_rows > 0 ? ($ch_r[0] + 1) : 1);

			if( $attempts > $allowed_attempts ) return array("status" => "waiting_restriction_time", "remaining_time" => $ch_r[1]);
			else {

				if ($q->num_rows==0) {
					$db->query("INSERT INTO restricted_ip (ip_address) values('".$ip."') ON DUPLICATE KEY UPDATE attempts=attempts+1, restriction_time=NOW()");
					$ch_ip=$db->query("select TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(restriction_time, INTERVAL ".$waiting_minutes." MINUTE)) from restricted_ip where (ip_address='".$ip."')");
					$ch_r=$ch_ip->fetch_row();
					if( $attempts >= $allowed_attempts ) return array("status" => "waiting_restriction_time", "remaining_time" => $ch_r[0]);
					return array("status" => "code_error", "remaining_attempts" => ($allowed_attempts - $attempts));
				} else {
					$r=$q->fetch_row();
					$db->query("delete from restricted_ip where (ip_address='".$ip."')");
					return new agent($r[0]);
				}
			
			}
		}

		public static function login($username, $password, $ip){
			global $db;
			
			// security params
			$allowed_attempts = 5; 
			$waiting_minutes = 15;

			if( $ip == NULL ) return array("status"=>"restricted_host");

			$q=$db->query("select id, password from agent where (username='".$username."')");
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

					if ($password != $r[1]) {
						$db->query("INSERT INTO restricted_ip (ip_address) values('".$ip."') ON DUPLICATE KEY UPDATE attempts=attempts+1, restriction_time=NOW()");
						$ch_ip=$db->query("select TIMESTAMPDIFF(MINUTE,NOW(),DATE_ADD(restriction_time, INTERVAL ".$waiting_minutes." MINUTE)) from restricted_ip where (ip_address='".$ip."')");
						$ch_r=$ch_ip->fetch_row();
						if( $attempts >= $allowed_attempts ) return array("status" => "waiting_restriction_time", "remaining_time" => $ch_r[0]);
						return array("status" => "password_error", "remaining_attempts" => ($allowed_attempts - $attempts));
					} else {
						$db->query("delete from restricted_ip where (ip_address='".$ip."')");
						return new agent($r[0]);
					}
				}
			}
		}



	}
?>
