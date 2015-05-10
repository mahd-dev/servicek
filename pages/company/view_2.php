<link href="<?php echo url_root;?>/pages/company/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<link href="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?php echo cdn;?>/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css"/>

<?php if(!$is_contracted){?>
<div class="row">
	<div class="col-md-12">
		<div class="note note-danger">
			<h4 class="block">Cette société n'est pas pubilée</h4>
			<p>
				 Cette société n'est pas disponible au public, vous seul vous pouvez y accéder.<br>
				 Vous ne disposez pas encore de contrat de publication.<br><br>
				 <a class="btn green ajaxify" href="<?php echo url_root."/".$company->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }?>
<div class="row">
	<div class="profile-sidebar col-md-3">
		<div class="portlet light profile-sidebar-portlet">
			
			<div class="logo fileinput col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12 fileinput-new" data-provides="fileinput">
				<a class="fileinput-preview thumbnail" data-trigger="fileinput">
					<img src="<?php $logo=$company->logo; if($logo) echo $paths->company_logo->url.$logo; else {?>http://www.placehold.it/400x300/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="logo"/>
				</a>
				<form class="hide"><input type="file" name="logo"></form>
			</div>

			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<a class="editable" data-name="name" data-type="text" ><?php echo $company->name;?></a>
				</div>
				<div class="profile-usertitle-job">
					<a class="editable" data-name="slogan" data-type="text" ><?php echo $company->slogan;?></a>
				</div>
			</div>
		</div>

		<div class="portlet light">
			<h5>A propos :</h5>
			<a class="editable" data-name="description" data-type="textarea" ><?php echo $company->description;?></a>
		</div>
		
		<div class="portlet light">
			<h5>Domaines d'activité :</h5>
			<a class="categories-editable" data-name="categories" data-type="select2" data-available='<?php echo json_encode($available_categories);?>'><?php echo $categories;?></a>
		</div>

	</div>
	<div class="profile-content col-md-9">
		<div class="row">
			<div class="col-md-6">
				<div class="portlet light">
					<div class="portlet-title tabbable-line">
						<div class="caption caption-md">
							<i class="icon-globe theme-font hide"></i>
							<span class="caption-subject font-blue-madison bold uppercase"><a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="name" data-type="text" ><?php echo $s->name; ?></a></span>
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1_1">
								<p class="margin-bottom-30">
									<strong><h5>Adresse :</h5></strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="address" data-type="text" ><?php echo $s->address; ?></a>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Téléphone :</h5></strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="tel" data-type="text" ><?php echo $s->tel; ?></a>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Portable :</h5></strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="mobile" data-type="text" ><?php echo $s->mobile; ?></a>
								</p>
								<p class="margin-bottom-30">
									<strong><h5>Email :</h5></strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="email" data-type="text" ><?php echo $s->email; ?></a>
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
							<div class="map-canvas aspectratio-content" data-pk="<?php echo $s->id;?>" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
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
							<li class="active"><a href="#services_list" data-toggle="tab" aria-expanded="true">Services</a></li>
							<li><a href="#products_list" data-toggle="tab" aria-expanded="false">Produits</a></li>
						</ul>
						<div class="btn-group btn-group-solid pull-right">
							<button class="btn btn-default new_service">Ajouter un Service</button>
							<button class="btn btn-default new_product">Ajouter un Produit</button>
						</div>
					</div>
					<div class="portlet-body">
						<div class="tab-content">
							<div class="tab-pane row active" id="services_list">
							<?php foreach ($company->services as $p) { ?>
								<div class="col-sm-6 col-md-4 service" data-id="<?php echo $p->id; ?>">
									<div class="thumbnail">
										
										<div class="btn-group pull-right">
											<button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"></i></button>
											<ul class="dropdown-menu" role="menu">
												<li><a class="delete"><i class="icon-close"></i> Supprimer</a></li>
											</ul>
										</div>

										<div class="service_image fileinput fileinput-new" data-provides="fileinput">
											<a class="fileinput-preview thumbnail" data-trigger="fileinput">
												<img src="<?php $image=$p->image; if($image) echo $paths->service_image->url.$image; else {?>http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
											</a>
											<form class="hide"><input type="file" name="image"></form>
										</div>

										<div class="caption">
											<h3><a class="service_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
											<p><a class="service_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->description; ?></a></p>
											<p><a class="service_editable" data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number" ><?php echo $p->price; ?></a> DNT</p>
										</div>
									</div>
								</div>
							<?php }?>
							<div class="col-sm-6 col-md-4 service" data-id="" id="new_service_template" style="display:none;">
								<div class="thumbnail">
									
									<div class="btn-group pull-right">
										<button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"></i></button>
										<ul class="dropdown-menu" role="menu">
											<li><a class="delete"><i class="icon-close"></i> Supprimer</a></li>
										</ul>
									</div>

									<div class="service_image fileinput fileinput-new" data-provides="fileinput">
										<a class="fileinput-preview thumbnail" data-trigger="fileinput">
											<img src="http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image" alt="image"/>
										</a>
										<form class="hide"><input type="file" name="image"></form>
									</div>

									<div class="caption">
										<h3><a class="service_editable name" data-name="name" data-pk="" data-type="text" ></a></h3>
										<p><a class="service_editable description" data-name="description" data-pk="" data-type="text" ></a></p>
										<p><a class="service_editable price" data-name="price" data-pk="" data-type="number" ></a> DNT</p>
									</div>
								</div>
							</div>
							
							</div>
							<div class="tab-pane row" id="products_list">
								<?php foreach ($company->products as $p) {?>
									<div class="col-sm-6 col-md-4 product" data-id="<?php echo $p->id; ?>">
										<div class="thumbnail">
											
											<div class="btn-group pull-right">
												<button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"></i></button>
												<ul class="dropdown-menu" role="menu">
													<li><a class="delete"><i class="icon-close"></i> Supprimer</a></li>
												</ul>
											</div>

											<div class="product_image fileinput fileinput-new" data-provides="fileinput">
												<a class="fileinput-preview thumbnail" data-trigger="fileinput">
													<img src="<?php $image=$p->image; if($image) echo $paths->product_image->url.$image; else {?>http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
												</a>
												<form class="hide"><input type="file" name="image"></form>
											</div>

											<div class="caption">
												<h3><a class="product_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
												<p><a class="product_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->description; ?></a></p>
												<p><a class="product_editable" data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number" ><?php echo $p->price; ?></a> DNT</p>
											</div>
										</div>
									</div>
								<?php }?>
								<div class="col-sm-6 col-md-4 product" data-id="" id="new_product_template" style="display:none;">
									<div class="thumbnail">

										<div class="btn-group pull-right">
											<button class="btn btn-xs dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-angle-down"></i></button>
											<ul class="dropdown-menu" role="menu">
												<li><a class="delete"><i class="icon-close"></i> Supprimer</a></li>
											</ul>
										</div>

										<div class="product_image fileinput fileinput-new" data-provides="fileinput">
											<a class="fileinput-preview thumbnail" data-trigger="fileinput">
												<img src="http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image" alt="image"/>
											</a>
											<form class="hide"><input type="file" name="image"></form>
										</div>

										<div class="caption">
											<h3><a class="product_editable name" data-name="name" data-pk="" data-type="text" ></a></h3>
											<p><a class="product_editable description" data-name="description" data-pk="" data-type="text" ></a></p>
											<p><a class="product_editable price" data-name="price" data-pk="" data-type="number" ></a> DNT</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput<?php if(!debug) echo ".min";?>.js"></script>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_2<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>