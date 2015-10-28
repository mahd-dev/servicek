<!-- custom page styles -->
<link href="<?php echo url_root;?>/pages/home/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<?php
	function categories($c){
		global $ca_list;
		$rslt = "";
		$has_sc = ($c->count_sub_categories > 0);
		$has_pages = $c->has_pages;
		if($has_sc || $has_pages) {
			$sc_rslt="";
			foreach ($c->sub_categories as$sc) {
				$sc_rslt.=categories($sc);
			}
			if($sc_rslt){
				$rslt.='<li>';
				$rslt.='<div class="element">';
				$rslt.='<div class="checkbox"><label><input type="checkbox"'.($ca_list && in_array($c, $ca_list)?" checked":"").' data-id="'.$c->id.'"> <i class="'.$c->icon.'"></i> '.$c->name.'</label></div>';
				$rslt.='<a class="dropdown-toggle btn btn-flat pull-right"><span class="caret"></span></a>';
				$rslt.='</div>';
				$rslt.='<ul class="collapsed">';
				$rslt.=$sc_rslt;
				$rslt.='</ul>';
				$rslt.='</li>';
			}elseif ($has_pages) {
				$rslt.='<li>';
				$rslt.='<div class="element">';
				$rslt.='<div class="checkbox"><label><input type="checkbox"'.($ca_list && in_array($c, $ca_list)?" checked":"").' data-id="'.$c->id.'"> '.$c->name.'</label></div>';
				$rslt.='</div>';
				$rslt.='</li>';
			}
		}
		return $rslt;
	}
?>
<?php
	function localities($c){
		global $lo_list;
		$rslt = "";
		$has_sc = $c->has_childrens;
		$has_pages = $c->has_pages;
		if($has_sc || $has_pages) {
			$sc_rslt="";
			foreach ($c->childrens as$sc) {
				$sc_rslt.=localities($sc);
			}
			if($sc_rslt){
				$rslt.='<li data-id="'.$c->id.'">';
				$rslt.='<div class="element">';
				$rslt.='<div class="checkbox"><label><input type="checkbox"'.($lo_list && in_array($c, $lo_list)?" checked":"").' data-id="'.$c->id.'"> '.$c->long_name.'</label></div>';
				$rslt.='<a class="dropdown-toggle btn btn-flat pull-right"><span class="caret"></span></a>';
				$rslt.='</div>';
				$rslt.='<ul class="collapsed">';
				$rslt.=$sc_rslt;
				$rslt.='</ul>';
				$rslt.='</li>';
			}elseif ($has_pages) {
				$rslt.='<li data-id="'.$c->id.'">';
				$rslt.='<div class="element">';
				$rslt.='<div class="checkbox"><label><input type="checkbox"'.($lo_list && in_array($c, $lo_list)?" checked":"").' data-id="'.$c->id.'"> '.$c->long_name.'</label></div>';
				$rslt.='</div>';
				$rslt.='</li>';
			}
		}
		return $rslt;
	}
?>

<div class="hidden-md hidden-lg">
	<img src="/assets/img/home/home_1.svg" width="100%" alt="" />
</div>

<div class="row">
	<div class="col-md-3 col-sm-6">
		<div class="type box">
			<div class="togglebutton"><label><input type="checkbox"<?php echo (isset($_GET["jo"]) && $_GET["jo"]?" checked": "") ?> class="job"> Métier</label></div>
			<div class="togglebutton"><label><input type="checkbox"<?php echo (isset($_GET["sh"]) && $_GET["sh"]?" checked": "") ?> class="shop"> Boutique</label></div>
			<div class="togglebutton"><label><input type="checkbox"<?php echo (isset($_GET["co"]) && $_GET["co"]?" checked": "") ?> class="company"> Société</label></div>
		</div>
		<div class="categories tree box">
			<img src="/assets/img/home/home_3.svg" class="help" alt="" />
			<h3 class="tree-title">Catégories</h3>
			<ul>
				<?php foreach (category::get_roots() as $c){
					echo categories($c);
				} ?>
			</ul>
		</div>
		<hr>
	</div>
	<div class="col-md-3 col-sm-6 col-md-push-6">
		<div class="localities tree box">
			<img src="/assets/img/home/home_2.svg" class="help" alt="" />
			<h3 class="tree-title">Adresses</h3>
			<ul>
				<?php
					$r = locality::get_roots();
					if(count($r)>1){
						foreach ($r as $l){
							echo localities($l);
						}
					}else{
						foreach ($r[0]->childrens as $l){
							echo localities($l);
						}
					}
				?>
			</ul>
		</div>
		<hr>
	</div>
	<div class="col-md-6 col-md-pull-3 col-sm-12" style="float:left;">
		<div class="home hidden-xs hidden-sm"<?php if(!$empty) echo ' style="display:none;"'; ?>>
			<img src="/assets/img/home/home_1.svg" width="100%" alt="" />
			<h2 style="color:#1e88e5;">Servicek était un rêve, maintenant est devenu une réalité grâce à</h2>
			<div class="row" style="text-align:center;">
				<div class="col-sm-6">
					<h3 style="color:#1e88e5;">Idée</h3>
					<a href="/about" class="ajaxify">
						<img src="/assets/img/home/logo.svg" alt="" style="max-height:100px;max-width:200px;" />
					</a>
				</div>
				<div class="col-sm-6">
					<h3 style="color:#1e88e5;">Développement</h3>
					<a href="http://mahd.company" target="_blank">
						<img src="/assets/img/home/mahd.svg" alt="" style="max-height:100px;max-width:150px;" />
					</a>
				</div>
			</div>
			<a class="btn btn-primary btn-raised" data-toggle="modal" data-target="#be_partner" style="margin-top:50px;"><i class="fa fa-thumbs-up"></i> Donner un coup de pouce à servicek</a>
		</div>

		<div class="results">
			<h2 class="page-header filter-title"><?php echo $title; ?></h2>
			<div class="row items_container">
				<?php foreach ($rslt as $r) {?>

					<div class="col-sm-6">
						<a href="<?php echo $r["url"];?>" class="ajaxify item">
							<div class="property-box">
								<div class="property-box-image">
									<?php if($r["image_url"]){?>
										<div class="aspectratio-container aspect-4-3 fit-width">
											<div class="aspectratio-content image" style="background-image:url('<?php echo $r["image_url"];?>');"></div>
										</div>
									<?php }?>
									<?php if(!$r["image_url"]){?>
										<div class="aspectratio-container aspect-4-3 fit-width">
											<div class="aspectratio-content"></div>
										</div>
									<?php }?>
								</div>
								<div class="property-box-content">
										<h3 class="title-text"><?php echo $r["title"];?></h3>
										<p class="content-text"><?php echo $r["content"];?></p>
										<div class="fb-like" data-href="<?php echo $r["url"];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
								</div>
							</div>
						</a>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div id="item_template" class="col-sm-6" style="display:none;">
	<a href="" class="ajaxify item">
		<div class="property-box">
			<div class="property-box-image">
				<div class="aspectratio-container aspect-4-3 fit-width">
					<div class="aspectratio-content image" style="background-image:url();"></div>
				</div>
			</div>
			<div class="property-box-content">
					<h3 class="title-text"></h3>
					<p class="content-text"></p>
					<div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
			</div>
		</div>
	</a>
</div>

<div class="modal fade" id="be_partner">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1>Devenir Partenaire</h1>
			</div>
      <div class="modal-body">
				<p>Servicek est un startup, portant des idées innovantes au commerce.</p>
				<p>Si vous aimer ce projet, donnez-le un petit coup de pouce ;)</p>
				<a href="/contact" class="btn btn-primary btn-raised ajaxify">Contacter servicek</a>
      </div>
    </div>
	</div>
</div>

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/home/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php if(isset($logout) && $logout){?>
<script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php }?>
