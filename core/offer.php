<?php
    class offer{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    default :
                        $db->query("update offer set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
                    case "is_contracted":
                        return $this->page->is_contracted;
                    break;

                    case 'url':
                      return $this->page->url.'/offer/'.$this->id;
                    break;

                    default:
                        $q=$db->query("select ".$name." from offer where (id='".$this->id."')");
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
            $db->query("insert into offer (id_page, page_type) values('".$page->id."', '".get_class($page)."')");
            return new offer($db->insert_id);
        }

        public function delete(){
            global $db;
            $db->query("delete from offer where (id='".$this->id."')");
        }

    }
?>
