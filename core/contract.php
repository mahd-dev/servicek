<?php
    class contract{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    default :
                        $db->query("update contract set ".$name."='".$db->real_escape_string($value)."' where (id='".$this->id."')");
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
                    case "page":
                        switch ($this->page_type) {
                            case "company": return new company($this->id_page); break;
                            case "job": return new job($this->id_page); break;
                            default: return null; break;
                        }
                    break;
                    case "remaining_days":
                        $q=$db->query("select TIMESTAMPDIFF(DAY,NOW(),DATE_ADD(creation_time, INTERVAL duration DAY)) from contract where (id='".$this->id."')");
                        $r=$q->fetch_row();
                        return ($r[0] < 0 ? false : $r[0]);
                    case "is_expired":
                        return $this->remaining_days == false;
                    break;
                    default:
                        $q=$db->query("select ".$name." from contract where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function create($page, $token){
            global $db;
            $db->query("insert into contract (id_page, page_type, payment_token) values('".$page->id."', '".get_class($page)."', '".$token."')");
            return new contract($db->insert_id);
        }

        public function delete(){
            global $db;
            $db->query("delete from contract where (id='".$this->id."')");
        }

        public static function check_token($token){
            global $db;
            $q=$db->query("select id from contract where (payment_token='".$token."')");
            if($q->num_rows==0) return null;
            $r=$q->fetch_row();
            return new contract($r[0]);
        }
    }
?>
