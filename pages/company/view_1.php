<link href="<?php echo url_root;?>/pages/company/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="profile-sidebar col-md-3">
		<?php $logo=$company->logo; if($logo){?>
			<div class="row">
				<div class="logo col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12">
					<img class="public_logo" src="<?php echo $paths->company_logo->url.$logo;?>" alt="logo"/>
				</div>
			</div>
		<?php }?>
		<div class="portlet light profile-sidebar-portlet box">

			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php echo $company->name;?>
				</div>
				<div class="profile-usertitle-job">
					<?php echo $company->slogan;?>
				</div>
			</div>

		</div>
		<div class="info portlet light box">
			<h5>A propos :</h5>
			<p><?php echo $company->description;?></p>
		<hr>
			<strong><h5>Domaine<?php if($nb_categories) echo "s";?> d'activité :</h5></strong>
			<?php echo $categories;?>
		<hr>
			<h5><?php echo $s->name; ?></h5>
			<p class="margin-bottom-10">
				<strong>Adresse:</strong> <?php echo $s->address; ?>
			</p>
			<p class="margin-bottom-10">
				<strong>Téléphone:</strong> <?php echo $s->tel; ?>
			</p>
			<p class="margin-bottom-10">
				<strong>Portable:</strong> <?php echo $s->mobile; ?>
			</p>
			<p class="margin-bottom-10">
				<strong>Email:</strong> <?php echo $s->email; ?>
			</p>
		</div>
		<div class="portlet light">
			<div class="tab-content aspectratio-container aspect-4-3 fit-width">
				<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
			</div>
		</div>
	</div>
	<div class="profile-content col-md-9">
		<?php $cover = $company->cover; if($cover){?>

			<div class="row hidden-sm">
				<div class="col-md-12 margin-bottom-20">
					<div class="cover ps_image aspectratio-container aspect-3-1 fit-width">
						<div class="aspectratio-content">
							<img src="<?php echo $paths->company_cover->url.$cover;?>" alt="cover"/>
						</div>
					</div>
				</div>
			</div>

		<?php }?>
		<?php
			$products = $company->products;
			$services = $company->services;
			$cp=count($products);
			$cs=count($services);
			if(($cp+$cs)>0){
		?>

		<div class="sp-navbar navbar navbar-default">
			<ul class="nav navbar-nav nav-tabs">
				<?php if($cs>0){?><li class="active"><a href="#services" data-toggle="tab" aria-expanded="true">Services</a></li><?php }?>
				<?php if($cp>0){?><li<?php if($cs==0){?> class="active"<?php }?>><a href="#products" data-toggle="tab" aria-expanded="false">Produits</a></li><?php }?>
			</ul>
		</div>
		<div class="box">
			<div class="row">
				<div class="col-md-12">
					<div class="tab-content">
						<?php if($cs>0){?>
							<div class="tab-pane row active" id="services">
							<?php foreach ($services as $p) {
								$id=$p->id;
								$name=$p->name;
								$image=$p->image;
								$description=$p->description;
								$price=$p->price;
								if($name||$image||$description||$price){
							?>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<a class="thumbnail ps"
										data-id="<?php echo $id; ?>"
										data-name="<?php if($name){ echo $name; }?>"
										data-description="<?php echo $description; ?>"
										data-sale-price="<?php if($price){ echo $price; }?>"
										data-rent-price=""
									>
										<?php /*
										<?php if($name){?><div class="caption"><h3><?php echo $name; ?></h3></div><?php }?>
										*/ ?>
										<div class="ps_image aspectratio-container aspect-4-3 fit-width">
											<div class="aspectratio-content">
										<?php if($image){?>
											<img class="prod_srv_image" src="<?php echo $paths->service_image->url.$image;?>" alt="image"/>
										<?php }?>
											</div>
										</div>
										<?php /*
										<?php if($description||$price){?>
											<div class="caption">
												<p><?php echo $description; ?></p>
												<?php if($price){?><h4>Prix : <?php echo $price ; ?><sup> DNT</sup></h4><?php }?>
											</div>
										<?php }?>
										*/ ?>
									</a>
								</div>
							<?php }}?>
							</div>
						<?php }?>
						<?php if($cp>0){?>
							<div class="tab-pane row <?php if($cs==0){?> active<?php }?>" id="products" data-columns>
							<?php foreach ($products as $p) {
								$id=$p->id;
								$name=$p->name;
								$image=$p->image;
								$description=$p->description;
								$price=$p->price;
								$rent_price=$p->rent_price;
								if($name||$image||$description||$price||$rent_price){
							?>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<a class="thumbnail ps"
										data-id="<?php echo $id; ?>"
										data-name="<?php if($name){ echo $name; }?>"
										data-description="<?php echo $description; ?>"
										data-sale-price="<?php if($price){ echo $price; }?>"
										data-rent-price="<?php if($rent_price){ echo $rent_price ; }?>"
									>
										<?php /*
										<?php if($name){?><div class="caption"><h3><?php echo $name; ?></h3></div><?php }?>
										*/?>
										<div class="ps_image aspectratio-container aspect-4-3 fit-width">
											<div class="aspectratio-content">
										<?php if($image){?>
											<img class="prod_srv_image" src="<?php echo $paths->product_image->url.$image;?>" alt="image"/>
										<?php }?>
											</div>
										</div>
										<?php /*
										<?php if($description||$price||$rent_price){?>
											<div class="caption">
												<p><?php echo $description; ?></p>
												<?php if($price){?><h4>Prix : <?php echo $price ; ?><sup> DNT</sup></h4><?php }?>
												<?php if($rent_price){?><h4>Prix de location : <?php echo $rent_price ; ?><sup> DNT</sup></h4><?php }?>
											</div>
										<?php }?>
										*/?>
									</a>
								</div>
							<?php }}?>
							</div>
						<?php }?>
					</div>
				</div>
			</div>
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

<input type="hidden" name="root_url" value="<?php echo url_root.'/'.$company->url; ?>"/>

<?php if(isset($ps)){ ?>
<input type="hidden" name="ps_id" value="<?php echo $ps->id; ?>"/>
<input type="hidden" name="ps_type" value="<?php echo get_class($ps); ?>"/>
<?php } ?>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
