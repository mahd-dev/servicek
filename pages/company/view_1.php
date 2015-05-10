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
		</div>
		<div class="portlet light">
			<h5>Domaines d'activité :</h5>
			<?php echo $categories;?>
		</div>
	</div>
	<div class="profile-content col-md-9">
		<div class="row">
			<div class="col-md-6">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase"><?php echo $s->name; ?></span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<p class="margin-bottom-30">
									<strong><h5>Adresse:</h5></strong> <?php echo $s->address; ?>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Téléphone:</h5></strong> <?php echo $s->tel; ?>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Portable:</h5></strong> <?php echo $s->mobile; ?>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Email:</h5></strong> <?php echo $s->email; ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase">Map</span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content aspectratio-container aspect-4-3 fit-width">
							<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
			$products = $company->products;
			$services = $company->services;
			$cp=count($products);
			$cs=count($services);
			if(($cp+$cs)>0){
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<ul class="nav nav-tabs pull-left">
							<?php if($cs>0){?><li class="active"><a href="#services" data-toggle="tab" aria-expanded="true">Services</a></li><?php }?>
							<?php if($cp>0){?><li<?php if($cs==0){?> class="active"<?php }?>><a href="#products" data-toggle="tab" aria-expanded="false">Produits</a></li><?php }?>
						</ul>
						
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<?php if($cs>0){?>
								<div class="tab-pane row active" id="services">
								<?php foreach ($services as $p) {?>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<div class="thumbnail">
											<?php $image=$p->image; if($image){?>
												<img class="service_image" src="<?php echo $paths->service_image->url.$image;?>" alt="image"/>
											<?php }?>
											<div class="caption">
												<h3><?php echo $p->name; ?></h3>
												<p><?php echo $p->description; ?></p>
												<?php if($p->price){?><h4><?php echo $p->price ; ?> DNT</h4><?php }?>
											</div>
										</div>
									</div>
								<?php }?>
								</div>
							<?php }?>
							<?php if($cp>0){?>
								<div class="tab-pane row<?php if($cs==0){?> active<?php }?>" id="products">
								<?php foreach ($products as $p) {?>
									<div class="col-xs-12 col-sm-6 col-md-4">
										<div class="thumbnail">
											<?php $image=$p->image; if($image){?>
												<img class="product_image" src="<?php echo $paths->product_image->url.$image;?>" alt="image"/>
											<?php }?>
											<div class="caption">
												<h3><?php echo $p->name; ?></h3>
												<p><?php echo $p->description; ?></p>
												<?php if($p->price){?><h4><?php echo $p->price ; ?> DNT</h4><?php }?>
											</div>
										</div>
									</div>
								<?php }?>
								</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }?>
	</div>
</div>


<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
