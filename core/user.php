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
                    default :
                        $db->query("update users set ".$name."='".$db->real_escape_string($value)."' where (id='".$this->id."')");
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
                    case "pages":
                        return array_merge($this->companies, $this->jobs);
                    case "companies":
                        $list = array();
                        $q=$db->query("select id_company from user_admin where (id_user='".$this->id."')");
                        while($r=$q->fetch_row()) $list[] = new company($r[0]);
                        return $list;
                    case "jobs":
                        $list = array();
                        $q=$db->query("select id from job where (id_admin='".$this->id."')");
                        while($r=$q->fetch_row()) $list[] = new job($r[0]);
                        return $list;
                    default:
                        $q=$db->query("select ".$name." from users where (id='".$this->id."')");
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
            $q=$db->query("select count(username) from users where (username='".$username."')");
			$r=$q->fetch_row();
            return $r[0]>0;
        }

        public static function create($username,$password){
            global $db;
            if(user::username_exists($username)) return "username_exists";
            $db->query("insert into users (username,passowrd) values('".$db->real_escape_string($username)."','".$db->real_escape_string($password)."')");
            return new user($db->insert_id);
        }

        public function delete(){
            global $db;
            foreach($this->jobs as $j) $j->delete();
            foreach($this->companies as $c){
                if($c->count_admins==1) $c->delete();
            }
            $db->query("delete from users where (id='".$this->id."')");
        }

        public static function login($login,$password){
            global $db;
            
           $q=$con->query("select id,password from users where (login='".$login."')");
            if($q->num_rows==0){
                return "login_error";
            }else{
                $r=$q->fetch_row();
                if ($password != $r[1]) return "password_error";
                else return new user($r[0]);
            }
        }
        
    }
?>
