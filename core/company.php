<?php
	class company{

		private $id;

		public function __construct($nid){
			$this->id = $nid;
		}



		public function __set($name,$value){
			global $db;
			if ($this->id != NULL) {
				switch($name){
					default :
						$db->query("update company set ".$name."=".($value===null?"NULL":"'".$db->real_escape_string($value)."'")." where (id='".$this->id."')");
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
						$q=$db->query("select count(*) from company where (id='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0]==1;
					break;
					case "admins":
						$list = array();
						$q=$db->query("select id_user from user_admin where (id_company='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new user($r[0]);
						return $list;
					break;
					case "count_admins":
						$q=$db->query("select count(*) from user_admin where (id_company='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0];
					break;

					case "seats":
						$list = array();
						$q=$db->query("select id from company_seat where (id_company='".$this->id."')");
						while($r=$q->fetch_row()) $list[] = new company_seat($r[0]);
						return $list;
					break;

					case "products":
						$list = array();
						$q=$db->query("select id from product where (id_page='".$this->id."' and page_type='company') order by creation_time desc");
						while($r=$q->fetch_row()) $list[] = new product($r[0]);
						return $list;
					break;
					case "services":
						$list = array();
						$q=$db->query("select id from service where (id_page='".$this->id."' and page_type='company') order by creation_time desc");
						while($r=$q->fetch_row()) $list[] = new service($r[0]);
						return $list;
					break;
					case "offers":
						$list = array();
						$q=$db->query("select id from offer where (id_page='".$this->id."' and page_type='company') order by creation_time desc");
						while($r=$q->fetch_row()) $list[] = new offer($r[0]);
						return $list;
					break;

					case "categories":
						$list = array();
						$q=$db->query("select category_children.id_category from category_children, category where (category_children.id_children='".$this->id."' and category_children.children_type='company' and category_children.id_category=category.id and ifnull(category.company_publish_price,0)>0)");
						while($r=$q->fetch_row()) $list[] = new category($r[0]);
						return $list;
					break;

					case 'locality':
						return new locality($this->id_locality);
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
						$q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='company') ORDER BY DATE_ADD(creation_time, INTERVAL duration MONTH) DESC LIMIT 1");
						if($q->num_rows==0) return null;
						else{
							$r=$q->fetch_row();
							return new contract($r[0]);
						}
					break;
					case "available_contracts":
						$q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='company' and TIMESTAMPDIFF(DAY,NOW(),DATE_ADD(creation_time, INTERVAL duration MONTH)) >= 0)");
						$list = array();
						while($r=$q->fetch_row()) $list[] = new contract($r[0]);
						return $list;
					break;
					case "all_contracts":
						$q=$db->query("select id from contract where (id_page='".$this->id."' and page_type='company')");
						$list = array();
						while($r=$q->fetch_row()) $list[] = new contract($r[0]);
						return $list;
					break;

					case "url":
						$q=$db->query("select url from company where (id='".$this->id."')");
						$r=$q->fetch_row();
						if($r[0]) return $r[0];
						else return "company/".$this->id;
					break;

					case "has_agent_requests":
            $q=$db->query("select count(*) from agent_request where (id_for='".$this->id."' and rel_type='company')");
            $r=$q->fetch_row();
            return $r[0]>0;
          break;
          case "agent_requests":
            $list = array();
            $q=$db->query("select id, creation_time from agent_request where (id_for='".$this->id."' and rel_type='company')");
            while($r=$q->fetch_row()) $list[] = array("id"=>$r[0], "creation_time"=>$r[1]);
            return $list;
          break;

					default:
						$q=$db->query("select ".$name." from company where (id='".$this->id."')");
						$r=$q->fetch_row();
						return $r[0];
					break;
				}
			}else{
				return NULL;
			}
		}

		public function delete(){
			global $db;
			foreach ($this->seats as $s) {
				$locality = $s->locality;
				$s->delete();
				$locality->delete_if_empty();
			}
			foreach ($this->products as $p) $p->delete();
			foreach ($this->services as $s) $s->delete();
			foreach ($this->offers as $o) $o->delete();
			$db->query("delete from category_children where (id_children='".$this->id."' and children_type='company')");
			$db->query("delete from user_admin where (id_page='".$this->id."')");
			$db->query("delete from company where (id='".$this->id."')");
		}

		public function transform_to($to) {
			global $paths;
			switch ($to) {
				case 'job':
					$job=job::create($this->admins[0]);
					$s = $this->seats[0];
					$job->name=$this->name;
					$job->image=$this->logo;
					$job->description=$this->description;
					$job->url=$this->url;
					$job->geolocation=$s->geolocation;
					$job->locality=$s->locality;
					$job->address=$s->address;
					$job->tel=$s->tel;
					$job->mobile=$s->mobile;
					$job->email=$s->email;
					$job->requests=$this->requests;
					$job->creation_time=$this->creation_time;
					if($job->image) rename($paths->company_logo->dir.$job->image, $paths->job_image->dir.$job->image);

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
					foreach ($this->services as $service) {
						$portfolio=portfolio::create($job);
						$portfolio->name=$service->name;
						$portfolio->image=$service->image;
						$portfolio->description=$service->description;
						$portfolio->creation_time=$service->creation_time;
						if($portfolio->image) rename($paths->service_image->dir.$portfolio->image, $paths->portfolio_image->dir.$portfolio->image);
					}

					foreach ($this->offers as $offer) {
						$offer->id_page = $job->id;
						$offer->page_type = "job";
					}

					$this->delete();
					break;

				case 'shop':
					$shop=shop::create($this->admins[0]);
					$s = $this->seats[0];
					$shop->name=$this->name;
					$shop->image=$this->logo;
					$shop->cover=$this->cover;
					$shop->description=$this->description;
					$shop->url=$this->url;
					$shop->geolocation=$s->geolocation;
					$shop->locality=$s->locality;
					$shop->address=$s->address;
					$shop->tel=$s->tel;
					$shop->mobile=$s->mobile;
					$shop->email=$s->email;
					$shop->requests=$this->requests;
					$shop->creation_time=$this->creation_time;
					if($shop->image) rename($paths->company_logo->dir.$shop->image, $paths->shop_image->dir.$shop->image);
					if($shop->cover) rename($paths->company_cover->dir.$shop->cover, $paths->shop_cover->dir.$shop->cover);

					foreach ($this->all_contracts as $contract) {
						$contract->id_page = $shop->id;
						$contract->page_type = "shop";
					}
					foreach ($this->categories as $category) {
						$shop->assign_to_category($category);
					}

					foreach ($this->services as $service) {
						$product=product::create($shop);
						$product->name=$service->name;
						$product->image=$service->image;
						$product->description=$service->description;
						$product->price=$service->price;
						$product->creation_time=$service->creation_time;
						if($product->image) rename($paths->product_image->dir.$product->image, $paths->service_image->dir.$product->image);
					}
					foreach ($this->products as $product) {
						$product->id_page = $shop->id;
						$product->page_type = "shop";
					}

					foreach ($this->offers as $offer) {
						$offer->id_page = $shop->id;
						$offer->page_type = "shop";
					}

					$this->delete();
					break;
			}
		}

		public static function create($user){
			global $db;
			$db->query("insert into company values()");
			$nid = $db->insert_id;
			$db->query("insert into user_admin (id_user, id_company) values('".$user->id."', '".$nid."')");
			return new company($nid);
		}

		public static function get_all(){
			global $db;
			$list = array();
			$q = $db->query("select id from company");
			while($r = $q->fetch_row()) $list[] = new company($r[0]);
			return $list;
		}

		public function assign_to_admin($user){
			global $db;
			$db->query("replace into user_admin (id_user, id_company) values('".$user->id."', '".$this->id."')");
		}

		public function unassign_from_admin($user){
			global $db;
			$db->query("delete from user_admin where (id_user='".$user->id."' and id_company='".$this->id."')");
		}

		public function is_assigned_to_admin($user){
			global $db;
			$q=$db->query("select count(*) from user_admin where (id_user='".$user->id."' and id_company='".$this->id."')");
			$r=$q->fetch_row();
			return $r[0]==1;
		}

		public function assign_to_category($category){
			global $db;
			$db->query("replace into category_children (id_category, id_children, children_type) values('".$category->id."', '".$this->id."', 'company')");
		}

		public function unassign_from_category($category){
			global $db;
			$db->query("delete from category_children where (id_category='".$category->id."' and id_children='".$this->id."' and children_type='company')");
		}

		public function unassign_from_all_categories(){
			global $db;
			$db->query("delete from category_children where (id_children='".$this->id."' and children_type='company')");
		}

		public function request_agent(){
			global $db;
			$db->query("insert into agent_request (id_for, rel_type) values('".$this->id."', 'company')");
		}

    public function clear_agent_requests(){
        global $db;
        $db->query("delete from agent_request where (id_for = '".$this->id."' and rel_type = 'company')");
    }

	}
?>
