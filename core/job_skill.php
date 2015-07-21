<?php
  class job_skill{

    private $id;

    public function __construct($nid){
      $this->id = $nid;
    }

    public function __set($name,$value){
      global $db;
      if ($this->id != NULL) {
        switch($name){
          default :
            $db->query("update job_skill set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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

          default:
            $q=$db->query("select ".$name." from job_skill where (id='".$this->id."')");
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
      $db->query("insert into job_skill (id_job) values('".$job->id."')");
      return new job_skill($db->insert_id);
    }

    public function delete(){
      global $db;
      $db->query("delete from job_skill where (id='".$this->id."')");
    }

  }
?>
