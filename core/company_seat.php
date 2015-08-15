<?php
    class company_seat{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    case 'locality':
          						$this->id_locality = $value->id;
          						break;
                    case 'geolocation':
                      $geo = json_decode($value);
                      locality::fill($geo->latitude, $geo->longitude, $this);
                      $db->query("update company_seat set geolocation=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
                      break;
                    default :
                        $db->query("update company_seat set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
                    default:
                        $q=$db->query("select ".$name." from company_seat where (id='".$this->id."')");
			            $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function get_all(){
    			global $db;
    			$list = array();
    			$q = $db->query("select id from company_seat");
    			while($r = $q->fetch_row()) $list[] = new company_seat($r[0]);
    			return $list;
    		}

        public static function create($company){
            global $db;
            $db->query("insert into company_seat (id_company) values('".$company->id."')");
            return new company_seat($db->insert_id);
        }

        public function delete(){
            global $db;
            $db->query("delete from company_seat where (id='".$this->id."')");
        }

    }
?>
