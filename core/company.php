<?php
    class template{

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
                    case "admins":
                        $list = array();
                        $q=$db->query("select id_user from user_admin where (id_page='".$this->id."')");
                        while($r=$q->fetch_row()) $list[] = new user($r[0]);
                        return $list;
                    case "count_admins":
                        $q=$db->query("select count(*) from user_admin where (id_page='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
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
            return new company($db->insert_id);
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

        public function assign_to_category($category){
            global $db;
            $db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'company')");
        }

        public function unassign_from_category($category){
            global $db;
            $db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='company')");
        }

    }
?>
