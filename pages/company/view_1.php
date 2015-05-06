<link href="<?php echo url_root;?>/pages/company/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="profile-sidebar col-md-3">
		<div class="portlet light profile-sidebar-portlet">
			<!--
			<div class="profile-userpic">
				<img src="../../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
			</div>
			-->
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php echo $c->name;?>
				</div>
				<div class="profile-usertitle-job">
					<?php echo $c->slogan;?>
				</div>
			</div>
			

		</div>
		<div class="portlet light">
			<h5>A propos :</h5>
			<?php echo $c->description;?>
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
		<div class="row">
			<div class="col-md-12">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<ul class="nav nav-tabs pull-left">
							<li class="active"><a href="#services" data-toggle="tab" aria-expanded="true">Services</a></li>
							<li><a href="#prods" data-toggle="tab" aria-expanded="false">Produits</a></li>
						</ul>
						
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane row active" id="services">
							<?php foreach ($c->products as $p) {?>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="thumbnail">
										<!--<img src="" alt="100%x200" style="width: 100%;  display: block;">-->
										<div class="caption">
											<h3><?php echo $p->name; ?></h3>
											<p><?php echo $p->description; ?></p>
											<p><?php echo $p->price ; ?> DNT</p>
										</div>
									</div>
								</div>
							<?php }?>
							</div>
							<div class="tab-pane row" id="prods">
							<?php foreach ($c->services as $p) {?>
								<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="thumbnail">
										<!--<img src="" alt="100%x200" style="width: 100%;  display: block;">-->
										<div class="caption">
											<h3><?php echo $p->name; ?></h3>
											<p><?php echo $p->description; ?></p>
											<p><?php echo $p->price ; ?> DNT</p>
										</div>
									</div>
								</div>
							<?php }?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
