<?php
    class job{

        private $id;

        public function __construct($nid){
            $this->id = $nid;
        }

        public function __set($name,$value){
            global $db;
            if ($this->id != NULL) {
                switch($name){
                    case "admin":
                        $this->id_admin=$value->id;
                    case 'locality':
          						$this->id_locality = $value->id;
          						break;
                    case 'geolocation':
                      $geo = json_decode($value);
                      locality::fill($geo->latitude, $geo->longitude, $this);
                      $db->query("update job set geolocation=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
                      break;
                    default :
                        $db->query("update job set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
                        $q=$db->query("select count(*) from job where (id='".$this->id."')");
                        $r=$q->fetch_row();
                        return $r[0]==1;
                    break;
                    case "admin":
                        return new user($this->id_admin);
                    break;
                    case "categories":
                        $list = array();
                        $q=$db->query("select category_children.id_category from category_children, category where (category_children.id_children='".$this->id."' and category_children.children_type='job' and category_children.id_category=category.id and ifnull(category.job_publish_price,0)>0)");
                        while($r=$q->fetch_row()) $list[] = new category($r[0]);
                        return $list;
                    break;

                    case 'locality':
                      return new locality($this->id_locality);
                    break;

                    case 'skills':
                      $list = array();
                      $q=$db->query("select id from job_skill where (id_job='".$this->id."') order by percent desc");
                      while($r=$q->fetch_row()) $list[] = new job_skill($r[0]);
                      return $list;
                    break;

                    case 'portfolio':
                      $list = array();
                      $q=$db->query("select id from portfolio where (id_job='".$this->id."') order by creation_time desc");
                      while($r=$q->fetch_row()) $list[] = new portfolio($r[0]);
                      return $list;
                    break;

                    case 'cv':
                      $list = array();
                      $tmp_list = array();
                      $q=$db->query("select c.id, (select ifnull(max(ifnull(i.date_to, NOW())),NOW()) from job_cv_item i where i.id_cv=c.id) as dte from job_cv c where (c.id_job='".$this->id."')") or die ($db->error);
                      while($r=$q->fetch_row()) $tmp_list[] = array(new job_cv($r[0]), $r[1]);
                      usort($tmp_list, function($a, $b){
                        return strtotime($b[1]) - strtotime($a[1]);
                      });
                      foreach ($tmp_list as $value) $list[] = $value[0];
                      unset($tmp_list);
                      return $list;
                    break;

                    case "offers":
          						$list = array();
          						$q=$db->query("select id from offer where (id_page='".$this->id."' and page_type='shop') order by creation_time desc");
          						while($r=$q->fetch_row()) $list[] = new offer($r[0]);
          						return $list;
          					break;

                    case "is_contracted":
          						return !!$this->current_contract;
          					break;
          					case "current_contract":
          						$lc = $this->last_contract;
          						if($lc && !$lc->is_expired) return $lc;
          						else return null;
          					break;
                    case "last_contract":
                        $q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='job') ORDER BY DATE_ADD(creation_time, INTERVAL duration MONTH) DESC LIMIT 1");
                        if($q->num_rows==0) return null;
                        else{
                            $r=$q->fetch_row();
                            return new contract($r[0]);
                        }
                    break;
                    case "available_contracts":
                        $q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='job' and TIMESTAMPDIFF(DAY,NOW(),DATE_ADD(creation_time, INTERVAL duration MONTH)) >= 0)");
                        $list = array();
                        while($r=$q->fetch_row()) $list[] = new contract($r[0]);
                        return $list;
                    break;
                    case "all_contracts":
                        $q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='job')");
                        $list = array();
                        while($r=$q->fetch_row()) $list[] = new contract($r[0]);
                        return $list;
                    break;

                    case "url":
          						$q=$db->query("select url from job where (id='".$this->id."')");
          						$r=$q->fetch_row();
          						if($r[0]) return $r[0];
          						else return "job/".$this->id;
          					break;

                    case "has_agent_requests":
                        $q=$db->query("select count(*) from agent_request where (id_for='".$this->id."' and rel_type='job')");
                        $r=$q->fetch_row();
                        return $r[0]>0;
                    break;
                    case "agent_requests":
                        $list = array();
                        $q=$db->query("select id, creation_time from agent_request where (id_for='".$this->id."' and rel_type='job')");
                        while($r=$q->fetch_row()) $list[] = array("id"=>$r[0], "creation_time"=>$r[1]);
                        return $list;
                    break;

                    default:
                        $q=$db->query("select ".$name." from job where (id='".$this->id."')");
	                      $r=$q->fetch_row();
                        return $r[0];
                    break;
                }
            }else{
                return NULL;
            }
        }

        public static function create($user){
            global $db;
            $db->query("insert into job (id_admin) values('".$user->id."')");
            return new job($db->insert_id);
        }

        public function delete(){
            global $db;
            foreach ($this->skills as $skill) $skill->delete();
            foreach ($this->cv as $cv) $cv->delete();
            $locality = $this->locality;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='job')");
            $db->query("delete from job where (id='".$this->id."')");
            $locality->delete_if_empty();
        }

        public function transform_to($to) {
          global $paths;
    			switch ($to) {
            case 'shop':
    					$shop=shop::create($this->admin);
    					$shop->name=$this->name;
    					$shop->image=$this->image;
    					$shop->description=$this->description;
    					$shop->url=$this->url;
    					$shop->geolocation=$this->geolocation;
    					$shop->locality=$this->locality;
    					$shop->address=$this->address;
    					$shop->tel=$this->tel;
    					$shop->mobile=$this->mobile;
    					$shop->email=$this->email;
    					$shop->requests=$this->requests;
    					$shop->creation_time=$this->creation_time;
    					if($shop->image) rename($paths->job_image->dir.$shop->image, $paths->shop_image->dir.$shop->image);

              foreach ($this->all_contracts as $contract) {
    						$contract->id_page = $shop->id;
    						$contract->page_type = "shop";
    					}
    					foreach ($this->categories as $category) {
    						$shop->assign_to_category($category);
    					}

              foreach ($this->portfolio as $portfolio) {
    						$product=product::create($shop);
    						$product->name=$portfolio->name;
    						$product->image=$portfolio->image;
    						$product->description=$portfolio->description;
    						$product->creation_time=$portfolio->creation_time;
    						if($product->image) rename($paths->portfolio_image->dir.$product->image, $paths->product_image->dir.$product->image);
    					}

              foreach ($this->offers as $offer) {
                $offer->id_page = $shop->id;
                $offer->page_type = "shop";
              }

    					$this->delete();
    					break;
    				case 'company':
    					$company=company::create($this->admin);
              $seat=company_seat::create($company);
    					$company->name=$this->name;
    					$company->logo=$this->image;
    					$company->description=$this->description;
    					$company->url=$this->url;
    					$seat->geolocation=$this->geolocation;
    					$seat->locality=$this->locality;
    					$seat->address=$this->address;
    					$seat->tel=$this->tel;
    					$seat->mobile=$this->mobile;
    					$seat->email=$this->email;
    					$company->requests=$this->requests;
    					$company->creation_time=$this->creation_time;
              $seat->creation_time=$this->creation_time;
    					if($company->logo) rename($paths->job_image->dir.$company->logo, $paths->company_logo->dir.$company->logo);

              foreach ($this->all_contracts as $contract) {
    						$contract->id_page = $company->id;
    						$contract->page_type = "company";
    					}
    					foreach ($this->categories as $category) {
    						$company->assign_to_category($category);
    					}

              foreach ($this->portfolio as $portfolio) {
    						$service=service::create($company);
    						$service->name=$portfolio->name;
    						$service->image=$portfolio->image;
    						$service->description=$portfolio->description;
    						$service->creation_time=$portfolio->creation_time;
    						if($service->image) rename($paths->portfolio_image->dir.$service->image, $paths->service_image->dir.$service->image);
    					}

              foreach ($this->offers as $offer) {
    						$offer->id_page = $company->id;
    						$offer->page_type = "company";
    					}

    					$this->delete();
    					break;
    			}
    		}

        public static function get_all(){
            global $db;
            $list = array();
            $q = $db->query("select id from job");
            while($r = $q->fetch_row()){
                $list[] = new job($r[0]);
            }
            return $list;
        }

        public function assign_to_category($category){
            global $db;
            $db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'job')");
        }

        public function unassign_from_category($category){
            global $db;
            $db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='job')");
        }

        public function unassign_from_all_categories(){
            global $db;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='job')");
        }

        public function request_agent(){
            global $db;
            $db->query("insert into agent_request (id_for, rel_type) values('".$this->id."', 'job')");
        }

        public function clear_agent_requests(){
            global $db;
            $db->query("delete from agent_request where (id_for = '".$this->id."' and rel_type = 'job')");
        }

    }
?>
