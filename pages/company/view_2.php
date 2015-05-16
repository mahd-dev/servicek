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
			<hr>
			<h5>Domaines d'activité :</h5>
			<?php if($is_contracted){?>
				<?php echo $categories;?>
			<?php }else{?>
				<a class="categories-editable" data-name="categories" data-type="select2" data-value='<?php echo json_encode($categories_json);?>' data-available='<?php echo json_encode($available_categories);?>'></a>
			<?php }?>
			<hr>
			<h5><a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="name" data-type="text" ><?php echo $s->name; ?></a><h5>
			<p class="margin-bottom-10">
				<strong>Adresse:</strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="address" data-type="text" ><?php echo $s->address; ?></a>
			</p>
			<p class="margin-bottom-10">
				<strong>Téléphone:</strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="tel" data-type="text" ><?php echo $s->tel; ?></a>
			</p>
			<p class="margin-bottom-10">
				<strong>Portable:</strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="mobile" data-type="text" ><?php echo $s->mobile; ?></a>
			</p>
			<p class="margin-bottom-10">
				<strong>Email:</strong> <a class="seat_editable" data-pk="<?php echo $s->id;?>" data-name="email" data-type="text" ><?php echo $s->email; ?></a>
			</p>
		</div>
		<div class="tab-content aspectratio-container aspect-4-3 fit-width">
			<div class="map-canvas aspectratio-content" data-pk="<?php echo $s->id;?>" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
		</div>

	</div>
	<div class="col-md-9">
		<div class="row">
			<div class="col-md-12 margin-bottom-20">
				<div class="cover aspectratio-container aspect-3-1 fit-width fileinput fileinput-new" data-provides="fileinput">
					<a class="aspectratio-content thumbnail fileinput-preview" data-trigger="fileinput">
						<img src="<?php $cover=$company->cover; if($cover) echo $paths->company_cover->url.$cover; else {?>http://www.placehold.it/600x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+photo+de+couverture<?php }?>" alt="cover"/>
					</a>
					<form class="hide"><input type="file" name="cover"></form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12 tabbable-line margin-bottom-20">
						<ul class="nav nav-tabs pull-left">
							<li class="active"><a href="#services_list" class="sp_tabs" data-toggle="tab" aria-expanded="true">Services</a></li>
							<li><a href="#products_list" class="sp_tabs" data-toggle="tab" aria-expanded="false">Produits</a></li>
						</ul>
						<div class="btn-group btn-group-solid pull-right">
							<button class="btn btn-default new_service">Ajouter un Service</button>
							<button class="btn btn-default new_product">Ajouter un Produit</button>
						</div>
					</div>
				</div>
				<div class="tab-content">
					<div class="tab-pane row js-masonry active" id="services_list">
					<?php foreach ($company->services as $p) { ?>
						<div class="col-xs-12 col-sm-6 col-md-4 item service" data-id="<?php echo $p->id; ?>">
							<div class="thumbnail">
								
								<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>

								<h3><a class="service_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
								<div class="service_image fileinput fileinput-new" data-provides="fileinput">
									<a class="fileinput-preview thumbnail" data-trigger="fileinput">
										<img src="<?php $image=$p->image; if($image) echo $paths->service_image->url.$image; else {?>http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
									</a>
									<form class="hide"><input type="file" name="image"></form>
								</div>

								<div class="caption">
									<p>Description :<br><a class="service_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->description; ?></a></p>
									<p>Prix :<br><a class="service_editable" data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number" ><?php echo $p->price; ?></a><sup> DNT</sup></p>
								</div>
							</div>
						</div>
					<?php }?>
					
					</div>
					<div class="tab-pane row js-masonry" id="products_list">
						<?php foreach ($company->products as $p) {?>
							<div class="col-xs-12 col-sm-6 col-md-4 item product" data-id="<?php echo $p->id; ?>">
								<div class="thumbnail">
									
									<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>

									<h3><a class="product_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
									<div class="product_image fileinput fileinput-new" data-provides="fileinput">
										<a class="fileinput-preview thumbnail" data-trigger="fileinput">
											<img src="<?php $image=$p->image; if($image) echo $paths->product_image->url.$image; else {?>http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
										</a>
										<form class="hide"><input type="file" name="image"></form>
									</div>

									<div class="caption">
										<p>Description :<br><a class="product_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->description; ?></a></p>
										<p>Prix :<br>
											<?php $price=$p->price; $rent_price=$p->rent_price;?>
											<p><label><span><input type="checkbox" class="price_checkbox"<?php if($price!=null){?> checked<?php }?>></span>Vente </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number"<?php if($price==null){?> data-disabled='true'<?php }?>><?php echo $price; ?></a><sup class="unit"<?php if($price==null){?> style='display:none;'<?php }?>> DNT</sup></p>
											<p><label><span><input type="checkbox" class="rent_price_checkbox"<?php if($rent_price!=null){?> checked<?php }?>></span>Location </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="rent_price" data-pk="<?php echo $p->id; ?>" data-type="number"<?php if($rent_price==null){?> data-disabled='true'<?php }?>><?php echo $rent_price; ?></a><sup class="unit"<?php if($rent_price==null){?> style='display:none;'<?php }?>> DNT</sup></p>
										</p>
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


<div class="col-xs-12 col-sm-6 col-md-4 item service" data-id="" id="new_service_template" style="display:none;">
	<div class="thumbnail">
		
		<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>

		<h3><a class="service_editable name" data-name="name" data-pk="" data-type="text" ></a></h3>
		<div class="service_image fileinput fileinput-new" data-provides="fileinput">
			<a class="fileinput-preview thumbnail" data-trigger="fileinput">
				<img src="http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image" alt="image"/>
			</a>
			<form class="hide"><input type="file" name="image"></form>
		</div>

		<div class="caption">
			<p>Description :<br><a class="service_editable description" data-name="description" data-pk="" data-type="text" ></a></p>
			<p>Prix :<br><a class="service_editable" data-name="price" data-pk="" data-type="number" ></a><sup> DNT</sup></p>
		</div>
	</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-4 item product" data-id="" id="new_product_template" style="display:none;">
	<div class="thumbnail">

		<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>

		<h3><a class="product_editable name" data-name="name" data-pk="" data-type="text" ></a></h3>
		<div class="product_image fileinput fileinput-new" data-provides="fileinput">
			<a class="fileinput-preview thumbnail" data-trigger="fileinput">
				<img src="http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image" alt="image"/>
			</a>
			<form class="hide"><input type="file" name="image"></form>
		</div>

		<div class="caption">
			<p>Description :<br><a class="product_editable description" data-name="description" data-pk="" data-type="text" ></a></p>
			<p>Prix :<br>
				<p><label><span><input type="checkbox" class="price_checkbox" checked></span>Vente </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number" ><?php echo $p->price; ?></a><sup class="unit"> DNT</sup></p>
				<p><label><span><input type="checkbox" class="rent_price_checkbox"></span>Location </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="rent_price" data-pk="<?php echo $p->id; ?>" data-type="number" data-disabled='true'><?php echo $p->price; ?></a><sup class="unit" style='display:none;'> DNT</sup></p>
			</p>
		</div>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_2<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>