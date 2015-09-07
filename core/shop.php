<?php
    class shop{

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
                      $db->query("update shop set geolocation=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
                      break;
                    default :
                        $db->query("update shop set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
                        $q=$db->query("select count(*) from shop where (id='".$this->id."')");
                        $r=$q->fetch_row();
                        return $r[0]==1;
                    break;
                    case "admin":
                        return new user($this->id_admin);
                    break;
                    case "categories":
                        $list = array();
                        $q=$db->query("select category_children.id_category from category_children, category where (category_children.id_children='".$this->id."' and category_children.children_type='shop' and category_children.id_category=category.id and ifnull(category.shop_publish_price,0)>0)");
                        while($r=$q->fetch_row()) $list[] = new category($r[0]);
                        return $list;
                    break;

                    case 'locality':
                      return new locality($this->id_locality);
                    break;

                    case "products":
          						$list = array();
          						$q=$db->query("select id from product where (id_page='".$this->id."' and page_type='shop') order by creation_time desc");
          						while($r=$q->fetch_row()) $list[] = new product($r[0]);
          						return $list;
          					break;
          					case "services":
          						$list = array();
          						$q=$db->query("select id from service where (id_page='".$this->id."' and page_type='shop') order by creation_time desc");
          						while($r=$q->fetch_row()) $list[] = new service($r[0]);
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
                        $q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='shop') ORDER BY DATE_ADD(creation_time, INTERVAL duration MONTH) DESC LIMIT 1");
                        if($q->num_rows==0) return null;
                        else{
                            $r=$q->fetch_row();
                            return new contract($r[0]);
                        }
                    break;
                    case "available_contracts":
                        $q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='shop' and TIMESTAMPDIFF(DAY,NOW(),DATE_ADD(creation_time, INTERVAL duration MONTH)) >= 0)");
                        $list = array();
                        while($r=$q->fetch_row()) $list[] = new contract($r[0]);
                        return $list;
                    break;
                    case "all_contracts":
                        $q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='shop')");
                        $list = array();
                        while($r=$q->fetch_row()) $list[] = new contract($r[0]);
                        return $list;
                    break;

                    case "url":
          						$q=$db->query("select url from shop where (id='".$this->id."')");
          						$r=$q->fetch_row();
          						if($r[0]) return $r[0];
          						else return "shop/".$this->id;
          					break;

                    case "has_agent_requests":
                        $q=$db->query("select count(*) from agent_request where (id_for='".$this->id."' and rel_type='shop')");
                        $r=$q->fetch_row();
                        return $r[0]>0;
                    break;
                    case "agent_requests":
                        $list = array();
                        $q=$db->query("select id, creation_time from agent_request where (id_for='".$this->id."' and rel_type='shop')");
                        while($r=$q->fetch_row()) $list[] = array("id"=>$r[0], "creation_time"=>$r[1]);
                        return $list;
                    break;

                    default:
                        $q=$db->query("select ".$name." from shop where (id='".$this->id."')") or die ($db->error);
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
            $db->query("insert into shop (id_admin) values('".$user->id."')");
            return new shop($db->insert_id);
        }

        public function delete(){
            global $db;
            foreach ($this->products as $p) $p->delete();
      			foreach ($this->services as $s) $s->delete();
            foreach ($this->offers as $o) $o->delete();
            $locality = $this->locality;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='shop')");
            $db->query("delete from shop where (id='".$this->id."')");
            $locality->delete_if_empty();
        }

        public function transform_to($to) {
          global $paths;
    			switch ($to) {
            case 'job':
    					$job=job::create($this->admin);
    					$job->name=$this->name;
    					$job->image=$this->image;
    					$job->description=$this->description;
    					$job->url=$this->url;
    					$job->geolocation=$this->geolocation;
    					$job->locality=$this->locality;
    					$job->address=$this->address;
    					$job->tel=$this->tel;
    					$job->mobile=$this->mobile;
    					$job->email=$this->email;
    					$job->requests=$this->requests;
    					$job->creation_time=$this->creation_time;
    					if($job->image) rename($paths->shop_image->dir.$job->image, $paths->job_image->dir.$job->image);

              foreach ($this->all_contracts as $contract) {
    						$contract->id_page = $job->id;
    						$contract->page_type = "job";
    					}
    					foreach ($this->categories as $category) {
    						$job->assign_to_category($category);
    					}

              foreach ($this->products as $product) {
    						$portfolio=portfolio::create($job);
    						$portfolio->name=$product->name;
    						$portfolio->image=$product->image;
    						$portfolio->description=$product->description;
    						$portfolio->creation_time=$product->creation_time;
    						if($portfolio->image) rename($paths->product_image->dir.$portfolio->image, $paths->portfolio_image->dir.$portfolio->image);
    					}

              foreach ($this->offers as $offer) {
    						$offer->id_page = $job->id;
    						$offer->page_type = "job";
    					}

    					$this->delete();
    					break;
    				case 'company':
    					$company=company::create($this->admin);
              $seat=company_seat::create($company);
    					$company->name=$this->name;
    					$company->logo=$this->image;
              $company->cover=$this->cover;
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
    					if($company->logo) rename($paths->shop_image->dir.$company->logo, $paths->company_logo->dir.$company->logo);
              if($company->cover) rename($paths->shop_cover->dir.$company->cover, $paths->company_cover->dir.$company->cover);

              foreach ($this->all_contracts as $contract) {
    						$contract->id_page = $company->id;
    						$contract->page_type = "company";
    					}
    					foreach ($this->categories as $category) {
    						$company->assign_to_category($category);
    					}

              foreach ($this->products as $product) {
    						$product->id_page = $company->id;
    						$product->page_type = "company";
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
            $q = $db->query("select id from shop");
            while($r = $q->fetch_row()){
                $list[] = new shop($r[0]);
            }
            return $list;
        }

        public function assign_to_category($category){
            global $db;
            $db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'shop')");
        }

        public function unassign_from_category($category){
            global $db;
            $db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='shop')");
        }

        public function unassign_from_all_categories(){
            global $db;
            $db->query("delete from category_children where (id_children='".$this->id."' and children_type='shop')");
        }

        public function request_agent(){
            global $db;
            $db->query("insert into agent_request (id_for, rel_type) values('".$this->id."', 'shop')");
        }

        public function clear_agent_requests(){
            global $db;
            $db->query("delete from agent_request where (id_for = '".$this->id."' and rel_type = 'shop')");
        }

    }
?>
