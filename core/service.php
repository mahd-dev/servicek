<?php
    class service{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    default :
                        $db->query("update service set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
                    case "company":
                        return new company($this->id_company);
                    break;
                    case "categories":
                        $list = array();
                        $q=$db->query("select id_category from category_children where (id_children='".$this->id."' and children_type='service')");
                        while($r=$q->fetch_row()) $list[] = new category($r[0]);
                        return $list;
                    break;
                    case "is_contracted":
                        return $this->company->is_contracted;
                    break;
                    default:
                        $q=$db->query("select ".$name." from service where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function create($company){
            global $db;
            $db->query("insert into service (id_company) values('".$company->id."')");
            return new service($db->insert_id);
        }

        public function delete(){
            global $db;
            $db->query("delete from category_children where (id='".$this->id."' and children_type='service')");
            $db->query("delete from service where (id='".$this->id."')");
        }

        public function assign_to_category($category){
            global $db;
            $db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'service')");
        }

        public function unassign_from_category($category){
            global $db;
            $db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='service')");
        }

        public function unassign_from_all_categories(){
            global $db;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='service')");
        }

    }
?>
