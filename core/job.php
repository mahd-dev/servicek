<?php
    class job{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    case "admin":
                        $this->id_admin=$value->id;
                    default :
                        $db->query("update job set ".$name."='".$db->real_escape_string($value)."' where (id='".$this->id."')");
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
                    case "admin":
                        return new user($this->id_admin);
                    break;
                    case "categories":
                        $list = array();
                        $q=$db->query("select id_category from category_children where (id_children='".$this->id."' and children_type='job')");
                        while($r=$q->fetch_row()) $list[] = new category($r[0]);
                        return $list;
                    break;
                    default:
                        $q=$db->query("select ".$name." from job where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function create($user){
            global $db;
            $db->query("insert into job (id_admin) values('".$user->id."')");
            return new job($db->insert_id);
        }

        public function delete(){
            global $db;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='job')");
            $db->query("delete from user_admin where (id_page='".$this->id."')");
            $db->query("delete from job where (id='".$this->id."')");
        }

        public static function get_all(){
            global $db;
            $list = array();
            $q = $db->query("select id from job");
            while($r = $q->fetch_row()){
                $list[] = new job($r[0]);
            }
            return $list;
        }

        public function assign_to_category($category){
            global $db;
            $db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'job')");
        }

        public function unassign_from_category($category){
            global $db;
            $db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='job')");
        }

    }
?>
