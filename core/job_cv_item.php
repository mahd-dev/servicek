<?php
  class job_cv_item{

    private $id;

    public function __construct($nid){
      $this->id = $nid;
    }

    public function __set($name,$value){
      global $db;
      if ($this->id != NULL) {
        switch($name){
          default :
            $db->query("update job_cv_item set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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

          case 'cv':
            return new job_cv($this->id_cv);
          break;
          case 'projects':
            $list = array();
            $q=$db->query("select id from job_cv_item_project where (id_cv_item='".$this->id."') order by creation_time desc") or die ($db->error);
            while($r=$q->fetch_row()) $list[] = new job_cv_item_project($r[0]);
            return $list;
          break;

          default:
            $q=$db->query("select ".$name." from job_cv_item where (id='".$this->id."')");
            $r=$q->fetch_row();
            return $r[0];
          break;
        }
      }else{
        return NULL;
      }
    }

    public static function create($cv){
      global $db;
      $db->query("insert into job_cv_item (id_cv) values('".$cv->id."')");
      return new job_cv_item($db->insert_id);
    }

    public function delete(){
      global $db;
      foreach ($this->projects as $project) $project->delete();
      $db->query("delete from job_cv_item where (id='".$this->id."')");
    }

  }
?>
