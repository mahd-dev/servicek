<link href="<?php echo url_root;?>/pages/shop/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="profile-sidebar col-md-3">
		<?php $image=$shop->image; if($image){?>
			<div class="row">
				<div class="image col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12">
					<img class="public_image" src="<?php echo $paths->shop_image->url.$image;?>" alt="image"/>
				</div>
			</div>
		<?php }?>
		<div class="portlet light profile-sidebar-portlet box">

			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php echo $shop->name;?>
				</div>
				<div class="fb-like" data-href="<?php echo url_root."/".$shop->url; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</div>

		</div>
		<div class="info portlet light box">
			<h5>A propos :</h5>
			<p><?php echo $shop->description;?></p>
		<hr>
			<h5>Domaine<?php if($nb_categories) echo "s";?> d'activité :</h5>
			<?php echo $categories;?>
		<hr>
			<p class="margin-bottom-10">
				<strong>Adresse:</strong> <?php echo $shop->address; ?>
			</p>
			<p class="margin-bottom-10">
				<strong>Téléphone:</strong> <?php echo $shop->tel; ?>
			</p>
			<p class="margin-bottom-10">
				<strong>Portable:</strong> <?php echo $shop->mobile; ?>
			</p>
			<p class="margin-bottom-10">
				<strong>Email:</strong> <?php echo $shop->email; ?>
			</p>
		</div>
		<div class="portlet light">
			<div class="tab-content aspectratio-container aspect-4-3 fit-width">
				<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
			</div>
		</div>
	</div>
	<div class="profile-content col-md-9">
		<?php $cover = $shop->cover; if($cover){?>

			<div class="row hidden-sm">
				<div class="col-md-12 margin-bottom-20">
					<div class="cover ps_image aspectratio-container aspect-3-1 fit-width box" style="padding:0;">
						<div class="aspectratio-content">
							<img src="<?php echo $paths->shop_cover->url.$cover;?>" alt="cover"/>
						</div>
					</div>
				</div>
			</div>

		<?php }?>

		<?php foreach ($ps_organized as $item) { $c = $item["category"]; ?>
			<div class="property-carousel-wrapper box">
				<h3><i class="category-icon <?php echo $c->icon; ?>"></i> <?php echo $c->name; ?></h3>
				<hr>
			  <div class="property-carousel">
					<?php foreach ($item["childrens"] as $r) { ?>
						<div class="property-carousel-item">
							<a href="<?php echo $r["url"];?>" class="ajaxify item">
				        <div class="property-box">
			            <div class="property-box-image">
										<?php if($r["image"]){?>
											<div class="aspectratio-container aspect-4-3 fit-width">
												<div class="aspectratio-content image" style="background-image:url('<?php echo $r["image"];?>');"></div>
											</div>
										<?php }else{ ?>
											<div class="aspectratio-container aspect-4-3 fit-width">
												<div class="aspectratio-content"></div>
											</div>
										<?php }?>
			            </div>
			            <div class="property-box-content">
										<h3><?php echo $r["name"];?></h3>
										<div class="fb-like" data-href="<?php echo $r["url"];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
			            </div>
				        </div>
							</a>
		      	</div>
					<?php } ?>
			  </div>
			</div>
		<?php } ?>


		<?php if(count($ps_list)) { ?>

			<h3>Produits</h3>
			<div class="row">
				<?php foreach ($ps_list as $p) {
					if($p["name"]||$p["image"]){
				?>
					<div class="col-xs-12 col-sm-6 col-md-4">
						<a class="item ps"
							data-type="<?php echo $p["type"]; ?>"
							data-id="<?php echo $p["id"]; ?>"
							data-name="<?php if($p["name"]){ echo $p["name"]; }?>"
							data-description="<?php echo $p["description"]; ?>"
							data-sale-price="<?php if($p["price"]){ echo $p["price"]; }?>"
							data-rent-price="<?php if($p["rent_price"]){ echo $p["rent_price"]; }?>"
							data-url="<?php if($p["url"]){ echo $p["url"]; }?>"
						>

							<div class="property-box">
								<div class="property-box-image">
									<?php if($p["image"]){?>
										<div class="ps_image ps_public_image aspectratio-container aspect-4-3 fit-width">
											<div class="aspectratio-content">
												<img class="prod_srv_image" src="<?php echo $p["image"];?>" alt="image"/>
											</div>
										</div>
									<?php }else{ ?>
										<div class="aspectratio-container aspect-4-3 fit-width">
											<div class="aspectratio-content"></div>
										</div>
									<?php }?>
								</div>
								<div class="property-box-content">
									<h3><?php echo $p["name"]; ?></h3>
									<div class="fb-like" data-href="<?php echo url_root."/".$p["url"];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
								</div>
							</div>

						</a>
					</div>
				<?php }}?>
			</div>

		<?php }?>

	</div>
</div>

<div class="modal fade" id="show_ps" tabindex="-1" role="dialog" aria-labelledby="show product-service">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button class="btn pull-right next"><i class="fa fa-arrow-right"></i></button>
				<button class="btn previous"><i class="fa fa-arrow-left"></i></button>
			</div>
			<div class="modal-body">
				<h2 class="modal-title"></h2>
				<p>
					<div class="fb-like" data-href="<?php echo url_root;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
				</p>
				<img class="prod_srv_image modal_ps_image" src="" alt="image"/>
				<div class="caption">
					<p class="description"></p>
					<h4 class="sale_price">Prix : <span class="price_val"></span><sup> DNT</sup></h4>
					<h4 class="rent_price">Prix de location : <span class="price_val"></span><sup> DNT</sup></h4>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="root_url" value="<?php echo url_root.'/'.$shop->url; ?>"/>

<?php if(isset($ps)){ ?>
<input type="hidden" name="ps_id" value="<?php echo $ps->id; ?>"/>
<input type="hidden" name="ps_type" value="<?php echo get_class($ps); ?>"/>
<?php } ?>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/shop/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
