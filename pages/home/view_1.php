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
				$rslt.='<li>';
				$rslt.='<div class="element">';
				$rslt.='<div class="checkbox"><label><input type="checkbox"'.($lo_list && in_array($c, $lo_list)?" checked":"").' data-id="'.$c->id.'"> '.$c->long_name.'</label></div>';
				$rslt.='<a class="dropdown-toggle btn btn-flat pull-right"><span class="caret"></span></a>';
				$rslt.='</div>';
				$rslt.='<ul class="collapsed">';
				$rslt.=$sc_rslt;
				$rslt.='</ul>';
				$rslt.='</li>';
			}elseif ($has_pages) {
				$rslt.='<li>';
				$rslt.='<div class="element">';
				$rslt.='<div class="checkbox"><label><input type="checkbox"'.($lo_list && in_array($c, $lo_list)?" checked":"").' data-id="'.$c->id.'"> '.$c->long_name.'</label></div>';
				$rslt.='</div>';
				$rslt.='</li>';
			}
		}
		return $rslt;
	}
?>

<div class="row">
	<div class="col-md-3 col-sm-6">
		<div class="type">
			<div class="togglebutton"><label><input type="checkbox"<?php echo (isset($_GET["jo"]) && $_GET["jo"]?" checked": "") ?> class="job"> Métier</label></div>
			<div class="togglebutton"><label><input type="checkbox"<?php echo (isset($_GET["sh"]) && $_GET["sh"]?" checked": "") ?> class="shop"> Boutique</label></div>
			<div class="togglebutton"><label><input type="checkbox"<?php echo (isset($_GET["co"]) && $_GET["co"]?" checked": "") ?> class="company"> Société</label></div>
		</div>
		<div class="categories tree">
			<h2 class="visible-sm-block visible-xs-block">Catégories</h2>
			<ul>
				<?php foreach (category::get_roots() as $c){
					echo categories($c);
				} ?>
			</ul>
		</div>
		<hr>
	</div>
	<div class="col-md-3 col-sm-6 col-md-push-6">
		<div class="localities tree">
			<h2 class="visible-sm-block visible-xs-block">Adresses</h2>
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
		<div class="home hidden-xs hidden-sm"<?php if(count($rslt)) echo ' style="display:none;"'; ?>>
			<div id="myCarousel" class="carousel slide" data-ride="carousel">

			  <div class="carousel-inner" role="listbox">

					<div class="item active">
			      <img src="/assets/img/home/flyer1-1.png" alt="">
			    </div>
			    <div class="item">
			      <img src="/assets/img/home/flyer1-2.png" alt="">
			    </div>

			  </div>

			  <!-- Left and right controls -->
			  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Précédent</span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Suivant</span>
			  </a>
			</div>
		</div>
		<div class="results">
			<h2 class="filter-title"><?php echo $title; ?></h2>
			<hr>
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

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/home/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php if(isset($logout) && $logout){?>
<script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php }?>
