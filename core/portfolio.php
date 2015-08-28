<?php
    class portfolio{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    default :
                        $db->query("update portfolio set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
                    case "job":
                        return new job($this->id_job); break;
                    break;
                    case "categories":
                        $list = array();
                        $q=$db->query("select category_children.id_category from category_children, category where (category_children.id_children='".$this->id."' and category_children.children_type='portfolio' and category_children.id_category=category.id and ifnull(category.portfolio,0)>0)");
                        while($r=$q->fetch_row()) $list[] = new category($r[0]);
                        return $list;
                    break;
                    case "is_contracted":
                        return $this->job->is_contracted;
                    break;

                    case 'url':
                      return $this->job->url.'/portfolio/'.$this->id;
                    break;

                    default:
                        $q=$db->query("select ".$name." from portfolio where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function create($job){
            global $db;
            $db->query("insert into portfolio (id_job) values('".$job->id."')");
            return new portfolio($db->insert_id);
        }

        public function delete(){
            global $db;
            $db->query("delete from category_children where (id='".$this->id."' and children_type='portfolio')");
            $db->query("delete from portfolio where (id='".$this->id."')");
        }

        public function assign_to_category($category){
            global $db;
            $db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'portfolio')");
        }

        public function unassign_from_category($category){
            global $db;
            $db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='portfolio')");
        }

        public function unassign_from_all_categories(){
            global $db;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='portfolio')");
        }

    }
?>
