<?php
    class product{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    default :
                        $db->query("update product set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
                            case "shop": return new shop($this->id_page); break;
                            case "job": return new job($this->id_page); break;
                            default: return null; break;
                        }
                    break;
                    case "categories":
                        $list = array();
                        $q=$db->query("select category_children.id_category from category_children, category where (category_children.id_children='".$this->id."' and category_children.children_type='product' and category_children.id_category=category.id and ifnull(category.product,0)>0)");
                        while($r=$q->fetch_row()) $list[] = new category($r[0]);
                        return $list;
                    break;
                    case "is_contracted":
                        $p = $this->page;
                        if($p) return $p->is_contracted;
                        else return false;
                    break;

                    case 'url':
                        $p = $this->page;
                        if($p) return $p->url.'/product/'.$this->id;
                        else return "404";
                    break;

                    default:
                        $q=$db->query("select ".$name." from product where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function create($page){
            global $db;
            $db->query("insert into product (id_page, page_type) values('".$page->id."', '".get_class($page)."')");
            return new product($db->insert_id);
        }

        public function delete(){
            global $db;
            $db->query("delete from category_children where (id='".$this->id."' and children_type='product')");
            $db->query("delete from product where (id='".$this->id."')");
        }

        public function assign_to_category($category){
            global $db;
            $db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'product')");
        }

        public function unassign_from_category($category){
            global $db;
            $db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='product')");
        }

        public function unassign_from_all_categories(){
            global $db;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='product')");
        }

    }
?>
