<?php
    class user{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $con;
            if ($this->id != NULL) {
                switch($name){
                    default :
                        $con->query("update users set ".$name."='".$db->real_escape_string($value)."' where (id='".$this->id."')");
                    break;
                }
            }
        }

        public function __get($name){
            global $con;
            if ($this->id != NULL) {
                switch($name){
                    case "id":
                        return $this->id;
                    break;
                    /*
                    case "property":
                        $q=$con->query("select property from users where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    */
                    default:
                        $q=$con->query("select ".$name." from users where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function username_exists($username){
            global $con;
            $q=$con->query("select count(username) from users where (username='".$username."')");
			$r=$q->fetch_row();
            return $r[0]>0;
        }

        public static function create($username,$password){
            global $con;
            $nid=newguid();
            $con->query("insert into users (username,passowrd) values('".$db->real_escape_string($username)."','".$db->real_escape_string($password)."')");
            return new user($nid);
        }

        public function delete(){
            global $con;
            $con->query("delete from users where id='".$this->id."'");
        }

        public static function login($login,$password){
            global $db;
        }
        /*
        public function fnct($param){
            global $db;

        }
        public static function static_fnct($param){
            global $db;

        }
        */
    }
?>
