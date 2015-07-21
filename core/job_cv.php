<?php
  class job_cv{

    private $id;

    public function __construct($nid){
      $this->id = $nid;
    }

    public function __set($name,$value){
      global $db;
      if ($this->id != NULL) {
        switch($name){
          default :
            $db->query("update job_cv set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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

          case 'job':
            return new job($this->id_job);
          break;
          case 'items':
            $list = array();
            $q=$db->query("select id, ifnull(date_to, NOW()) as dte from job_cv_item where (id_cv='".$this->id."') order by dte desc") or die ($db->error);
            while($r=$q->fetch_row()) $list[] = new job_cv_item($r[0]);
            return $list;
          break;

          default:
            $q=$db->query("select ".$name." from job_cv where (id='".$this->id."')");
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
      $db->query("insert into job_cv (id_job) values('".$job->id."')");
      return new job_cv($db->insert_id);
    }

    public function delete(){
      global $db;
      foreach ($this->items as $item) $item->delete();
      $db->query("delete from job_cv where (id='".$this->id."')");
    }

  }
?>
