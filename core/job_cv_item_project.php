<?php
  class job_cv_item_project{

    private $id;

    public function __construct($nid){
      $this->id = $nid;
    }

    public function __set($name,$value){
      global $db;
      if ($this->id != NULL) {
        switch($name){
          default :
            $db->query("update job_cv_item_project set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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

          case 'item':
            return new job_cv_item($this->id_item);
          break;

          default:
            $q=$db->query("select ".$name." from job_cv_item_project where (id='".$this->id."')");
            $r=$q->fetch_row();
            return $r[0];
          break;
        }
      }else{
        return NULL;
      }
    }

    public static function create($item){
      global $db;
      $db->query("insert into job_cv_item_project (id_cv_item) values('".$item->id."')");
      return new job_cv_item_project($db->insert_id);
    }

    public function delete(){
      global $db;
      $db->query("delete from job_cv_item_project where (id='".$this->id."')");
    }

  }
?>
