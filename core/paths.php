<?php
	class paths{

		private $content_files_paths = array(
			"category_icon"=>"/content/category/icon/",
			"company_logo"=>"/content/company/logo/",
			"company_cover"=>"/content/company/cover/",
			"job_image"=>"/content/job/image/",
			"shop_image"=>"/content/shop/image/",
			"shop_cover"=>"/content/shop/cover/",
			"offer_image"=>"/content/offer/image/",
			"product_image"=>"/content/product/image/",
			"service_image"=>"/content/service/image/",
			"portfolio_image"=>"/content/portfolio/image/",
		);

		public function __get($name){
            if(!array_key_exists($name, $this->content_files_paths)) return null;
            return new path($this->content_files_paths[$name]);
        }
	}

	class path{
		private $path;

		public function __construct($path){
            $this->path = $path;
        }

		public function __get($name){
			switch ($name) {
				case 'dir':
					$p=dirname(__DIR__).$this->path;
					if(!file_exists($p)) mkdir($p, 0777, true);
					return $p;
					break;
				case 'url':
					return $this->path;
					break;

				default:
					return null;
					break;
			}
        }
	}

?>
