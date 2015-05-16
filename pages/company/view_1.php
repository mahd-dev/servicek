<link href="<?php echo url_root;?>/pages/company/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="profile-sidebar col-md-3">
		<div class="portlet light profile-sidebar-portlet">
			
			<?php $logo=$company->logo; if($logo){?>
				<div class="logo col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12">
					<img class="public_logo" src="<?php echo $paths->company_logo->url.$logo;?>" alt="logo"/>
				</div>
			<?php }?>

			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php echo $company->name;?>
				</div>
				<div class="profile-usertitle-job">
					<?php echo $company->slogan;?>
				</div>
			</div>

		</div>
		<div class="portlet light">
			<h5>A propos :</h5>
			<?php echo $company->description;?>
		<hr>
			<h5>Domaines d'activité :</h5>
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
		<div class="potlet light">
			<div class="tab-content aspectratio-container aspect-4-3 fit-width">
				<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
			</div>
		</div>
	</div>
	<div class="profile-content col-md-9">
		<?php $cover = $company->cover; if($cover){?>

			<div class="row">
				<div class="col-md-12 margin-bottom-20">
					<div class="cover aspectratio-container aspect-3-1 fit-width">
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
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 tabbable-line margin-bottom-20">
						<ul class="nav nav-tabs pull-left">
							<?php if($cs>0){?><li class="active"><a href="#services" class="sp_tabs" data-toggle="tab" aria-expanded="true">Services</a></li><?php }?>
							<?php if($cp>0){?><li<?php if($cs==0){?> class="active"<?php }?>><a href="#products" class="sp_tabs" data-toggle="tab" aria-expanded="false">Produits</a></li><?php }?>
						</ul>
					</div>
				</div>
				<div class="tab-content">
					<?php if($cs>0){?>
						<div class="tab-pane row js-masonry active" id="services">
						<?php foreach ($services as $p) {
							$name=$p->name;
							$image=$p->image;
							$description=$p->description;
							$price=$p->price;
							if($name||$image||$description||$price){
						?>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="thumbnail">
									<?php if($name){?><div class="caption"><h3><?php echo $name; ?></h3></div><?php }?>
									<?php if($image){?>
										<img class="prod_srv_image" src="<?php echo $paths->service_image->url.$image;?>" alt="image"/>
									<?php }?>
									<?php if($description||$price){?>
										<div class="caption">
											<p><?php echo $description; ?></p>
											<?php if($price){?><h4>Prix : <?php echo $price ; ?><sup> DNT</sup></h4><?php }?>
										</div>
									<?php }?>
								</div>
							</div>
						<?php }}?>
						</div>
					<?php }?>
					<?php if($cp>0){?>
						<div class="tab-pane row js-masonry<?php if($cs==0){?> active<?php }?>" id="products" data-columns>
						<?php foreach ($products as $p) {
							$name=$p->name;
							$image=$p->image;
							$description=$p->description;
							$price=$p->price;
							$rent_price=$p->rent_price;
							if($name||$image||$description||$price||$rent_price){
						?>
							<div class="col-xs-12 col-sm-6 col-md-4">
								<div class="thumbnail">
									<?php if($name){?><div class="caption"><h3><?php echo $name; ?></h3></div><?php }?>
									<?php if($image){?>
										<img class="prod_srv_image" src="<?php echo $paths->product_image->url.$image;?>" alt="image"/>
									<?php }?>
									<?php if($description||$price||$rent_price){?>
										<div class="caption">
											<p><?php echo $description; ?></p>
											<?php if($price){?><h4>Prix : <?php echo $price ; ?><sup> DNT</sup></h4><?php }?>
											<?php if($rent_price){?><h4>Prix de location : <?php echo $rent_price ; ?><sup> DNT</sup></h4><?php }?>
										</div>
									<?php }?>
								</div>
							</div>
						<?php }}?>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
