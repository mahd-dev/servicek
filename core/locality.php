<?php
  class locality{

    private $id;

    public function __construct($nid){
      $this->id = $nid;
    }

    public function __set($name,$value){
      global $db;
      if ($this->id != NULL) {
        switch($name){
          case "parent":
            if($value) $this->id_parent = $value->id;
            else $this->id_parent = null;
          break;
          default :
            $db->query("update locality set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
          case "isvalid":
            $q=$db->query("select count(*) from locality where (id='".$this->id."')");
            $r=$q->fetch_row();
            return $r[0]==1;
          break;

          case 'is_root':
            $q=$db->query("select id_parent from locality where (id='".$this->id."')");
            $r=$q->fetch_row();
            return !$r[0];
          break;

          case "has_childrens":
            $q=$db->query("select count(*) from locality where (id_parent='".$this->id."')");
            $r=$q->fetch_row();
            return !!$r[0];
          break;
          case "childrens":
            $list = array();
            $q=$db->query("select id from locality where (id_parent='".$this->id."')");
            while($r=$q->fetch_row()) $list[] = new locality($r[0]);
            return $list;
          break;

          case "all_childrens_list":
            return $this->get_childrens_list();
          break;
          case "all_childrens_tree":
            return $this->get_childrens_tree();
          break;

          case "has_pages":
            $q1=$db->query("select count(*) from job where (id_locality='".$this->id."')");
            $q2=$db->query("select count(*) from shop where (id_locality='".$this->id."')");
            $q3=$db->query("select count(*) from company_seat where (id_locality='".$this->id."')");
            $r1=$q1->fetch_row();
            $r2=$q2->fetch_row();
            $r3=$q3->fetch_row();
            return !!($r1[0] + $r2[0] + $r3[0]);
          break;
          case "pages":
            return array_merge($this->companies, $this->shops, $this->jobs);
          break;

          case "parent":
            $q=$db->query("select id_parent from locality where (id='".$this->id."')");
            $r=$q->fetch_row();
            if($r[0]) return new locality($r[0]);
            else return null;
          break;

          case "companies":
            $list = array();
            $q=$db->query("select id from company where (id_locality='".$this->id."')");
            while($r=$q->fetch_row()) $list[] = new company($r[0]);
            return $list;
          break;
          case "shops":
            $list = array();
            $q=$db->query("select id from shop where (id_locality='".$this->id."')");
            while($r=$q->fetch_row()) $list[] = new shop($r[0]);
            return $list;
          break;
          case "jobs":
            $list = array();
            $q=$db->query("select id from job where (id_locality='".$this->id."')");
            while($r=$q->fetch_row()) $list[] = new job($r[0]);
            return $list;
          break;

          default:
            $q=$db->query("select ".$name." from locality where (id='".$this->id."')");
            $r=$q->fetch_row();
            return $r[0];
          break;
        }
      }else{
        return NULL;
      }
    }

    public static function fill($latitude, $longitude, $for){
      $r=file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&sensor=false");
      $resp = json_decode($r)->results[0]->address_components;
      if(isset($resp) && $resp){
        $parent = null;
        foreach (array_reverse($resp) as $comp) {
          if(!is_numeric($comp->short_name) && (!$parent || ($comp->short_name != $parent->short_name))){
            $parent = locality::create($comp->short_name, $comp->long_name, $parent);
          }
        }
        $for->locality = $parent;
      }else{
        sleep(1);
        locality::fill($latitude, $longitude, $for);
      }
    }

    public static function get_all(){
      global $db;
      $rslt=array();
      $q=$db->query("select id from locality");
      while ($r=$q->fetch_row()) $rslt[] = new locality($r[0]);
      return $rslt;
    }

    public static function get_roots(){
      global $db;
      $rslt=array();
      $q=$db->query("select id from locality where id_parent is NULL");
      while ($r=$q->fetch_row()) $rslt[] = new locality($r[0]);
      return $rslt;
    }

    public static function create($short_name, $long_name, $parent=null){
      global $db;
      $q=$db->query("select id from locality where (id_parent".($parent?" = '".$parent->id."'":" is NULL")." and short_name='".$db->real_escape_string($short_name)."')");
      if($q->num_rows==1){
        $r=$q->fetch_row();
        return new locality($r[0]);
      }else{
        if($parent){
          $db->query("insert into locality(id_parent, short_name, long_name) values('".$parent->id."', '".$db->real_escape_string($short_name)."', '".$db->real_escape_string($long_name)."')");
        }else{
          $db->query("insert into locality(short_name, long_name) values('".$db->real_escape_string($short_name)."', '".$db->real_escape_string($long_name)."')");
        }
        return new locality($db->insert_id);
      }
    }

    public function delete(){
      global $db;
      $db->query("delete from locality where (id='".$this->id."')");
    }

    public function delete_if_empty() {
      if(!$this->has_childrens && !$this->has_pages){
        $parent = $this->parent;
        $this->delete();
        if($parent) $parent->delete_if_empty();
      }
    }

    private function get_childrens_tree(){
      $list=array();
      foreach($this->sub_categories as $sc){
        $list[]=array("category" => $sc, "subcategories" => $sc->get_childrens_tree());
      }
      return $list;
    }
    private function get_childrens_list(){
      $list=array();
      foreach($this->childrens as $sc){
        $list[]=$sc;
        $list=array_merge($list, $sc->get_childrens_list());
      }
      return $list;
    }

  }
?>
