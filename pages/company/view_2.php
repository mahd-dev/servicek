<link href="<?php echo url_root;?>/pages/company/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<?php
	if(!$is_contracted){
		$lc=$company->last_contract;
		if($lc && $lc->type==0){
?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>La période d'essai a expiré</h4>
			<p>
				 Cette société n'est plus disponible au public, vous seul vous pouvez y accéder.<br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$company->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }else{?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Cette société n'est pas publiée</h4>
			<p>
				 Cette société n'est plus disponible au public, vous seul vous pouvez y accéder.<br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$company->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }}else{
	$cc=$company->current_contract;
	$rd = $cc->remaining_days;
	if($cc->type==0){
		if($rd>10){
?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Cette société est en période d'essai gratuit</h4>
			<p>
				 Vous pouvez essayer toutes les fonctionnalités pendant 1 mois à partir de la date de création de la société,<br>
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, cette société ne sera plus disponible au public.</span><br>
				 Afin d'assurer la disponibilité de la société, créez un contrat de publication avant la fin de la période d'essai.<br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$company->url;?>/publish"><i class="icon-rocket"></i> Créer un contrat de publication</a><br>
				 <span class="text-success">La date de début contrat de publication sera initialisée à la date fin de la période d'essai.</span>
			</p>
		</div>
	</div>
</div>
<?php }else{?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>La période d'essai est presque finit</h4>
			<p>
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, cette société ne sera plus disponible au public.</span><br>
				 Afin d'assurer la disponibilité de la société, créez un contrat de publication avant la fin de la période d'essai.<br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$company->url;?>/publish"><i class="icon-rocket"></i> Créer un contrat de publication</a><br>
				 <span class="text-success">La date de début contrat de publication sera initialisée à la date fin de la période d'essai.</span>
			</p>
		</div>
	</div>
</div>
<?php }}elseif($rd<=10){?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Le contrat de publication expirera bienôt</h4>
			<p>
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, cette société ne sera plus disponible au public.</span><br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$company->url;?>/publish"><i class="icon-rocket"></i> Renouveler le contrat</a><br>
				 <span class="text-success">La date de début du nouveau contrat de publication sera initialisée à la date fin du contrat existant.</span>
			</p>
		</div>
	</div>
</div>
<?php }}?>

<div class="row">
	<div class="profile-sidebar col-md-3">
		<div class="portlet light profile-sidebar-portlet box">

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
				<div class="profile-usertitle-company">
					<a class="editable" data-name="slogan" data-type="text" ><?php echo $company->slogan;?></a>
				</div>
			</div>
		</div>

		<div class="info portlet light box">
			<h5>A propos :</h5>
			<a class="editable" data-name="description" data-type="textarea" ><?php echo $company->description;?></a>
			<hr>
			<h5>Domaine<?php if($nb_categories) echo "s";?> d'activité :</h5>
			<?php if($is_contracted && !$is_trial){?>
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
		<div class="aspectratio-container aspect-4-3 fit-width">
			<div class="map-canvas aspectratio-content" data-pk="<?php echo $s->id;?>" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
		</div>

	</div>
	<div class="col-md-9">
		<div class="row hidden-sm">
			<div class="col-md-12">
				<div class="cover ps_image aspectratio-container aspect-3-1 fit-width fileinput fileinput-new" data-provides="fileinput">
					<a class="aspectratio-content thumbnail fileinput-preview" data-trigger="fileinput">
						<img src="<?php $cover=$company->cover; if($cover) echo $paths->company_cover->url.$cover; else {?>http://www.placehold.it/600x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+photo+de+couverture<?php }?>" alt="cover"/>
					</a>
					<form class="hide"><input type="file" name="cover"></form>
				</div>
			</div>
		</div>

		<div class="sp-navbar navbar navbar-default">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse navbar-responsive-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#services_list" class="sp_tabs" data-toggle="tab" aria-expanded="true">Services</a></li>
					<li><a href="#products_list" class="sp_tabs" data-toggle="tab" aria-expanded="false">Produits</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="javascript:;" class="new_service"><i class="fa fa-plus"></i> Ajouter un Service</a></li>
					<li><a href="javascript:;" class="new_product"><i class="fa fa-plus"></i> Ajouter un Produit</a></li>
				</ul>
			</div>
		</div>
		<div class="box">
			<div class="row">
				<div class="col-md-12">
					<div class="tab-content">
						<div class="tab-pane row active" id="services_list">
						<?php foreach ($company->services as $p) { ?>
							<div class="col-xs-12 col-sm-6 col-md-4 item service" data-id="<?php echo $p->id; ?>">
								<div class="thumbnail">
									<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>
									<div class="caption">
										<h3><a class="service_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
									</div>

									<div class="service_image ps_image aspectratio-container aspect-4-3 fit-width fileinput fileinput-new" data-provides="fileinput">
										<a class="aspectratio-content fileinput-preview thumbnail" data-trigger="fileinput">
											<img src="<?php $image=$p->image; if($image) echo $paths->service_image->url.$image; else {?>http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
										</a>
										<form class="hide"><input type="file" name="image"></form>
									</div>

									<div class="caption">
										<p>Description :<br><a class="service_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="textarea" ><?php echo $p->description; ?></a></p>
										<p>Prix : <a class="service_editable" data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number" ><?php echo $p->price; ?></a><sup> DNT</sup></p>
									</div>
								</div>
							</div>
						<?php }?>

						</div>
						<div class="tab-pane row" id="products_list">
							<?php foreach ($company->products as $p) {?>
								<div class="col-xs-12 col-sm-6 col-md-4 item product" data-id="<?php echo $p->id; ?>">
									<div class="thumbnail">
										<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>
										<div class="caption">
											<h3><a class="product_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
										</div>
										<div class="product_image ps_image aspectratio-container aspect-4-3 fit-width fileinput fileinput-new" data-provides="fileinput">
											<a class="aspectratio-content fileinput-preview thumbnail" data-trigger="fileinput">
												<img src="<?php $image=$p->image; if($image) echo $paths->product_image->url.$image; else {?>http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
											</a>
											<form class="hide"><input type="file" name="image"></form>
										</div>

										<div class="caption">
											<p>Description :<br><a class="product_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="textarea" ><?php echo $p->description; ?></a></p>
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
</div>


<div class="col-xs-12 col-sm-6 col-md-4 item service" data-id="" id="new_service_template" style="display:none;">
	<div class="thumbnail">
		<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>
		<div class="caption">
			<h3><a class="service_editable name" data-name="name" data-pk="" data-type="text" ></a></h3>
		</div>
		<div class="service_image ps_image aspectratio-container aspect-4-3 fit-width fileinput fileinput-new" data-provides="fileinput">
			<a class="aspectratio-content fileinput-preview thumbnail" data-trigger="fileinput">
				<img src="http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image" alt="image"/>
			</a>
			<form class="hide"><input type="file" name="image"></form>
		</div>

		<div class="caption">
			<p>Description :<br><a class="service_editable description" data-name="description" data-pk="" data-type="textarea" ></a></p>
			<p>Prix : <a class="service_editable" data-name="price" data-pk="" data-type="number" ></a><sup> DNT</sup></p>
		</div>
	</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-4 item product" data-id="" id="new_product_template" style="display:none;">
	<div class="thumbnail">
		<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>
		<div class="caption">
			<h3><a class="product_editable name" data-name="name" data-pk="" data-type="text" ></a></h3>
		</div>
		<div class="product_image ps_image aspectratio-container aspect-4-3 fit-width fileinput fileinput-new" data-provides="fileinput">
			<a class="aspectratio-content fileinput-preview thumbnail" data-trigger="fileinput">
				<img src="http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image" alt="image"/>
			</a>
			<form class="hide"><input type="file" name="image"></form>
		</div>

		<div class="caption">
			<p>Description :<br><a class="product_editable description" data-name="description" data-pk="" data-type="textarea" ></a></p>
			<p>Prix :<br>
				<p><label><span><input type="checkbox" class="price_checkbox" checked></span>Vente </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="price" data-pk="" data-type="number" ></a><sup class="unit"> DNT</sup></p>
				<p><label><span><input type="checkbox" class="rent_price_checkbox"></span>Location </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="rent_price" data-pk="" data-type="number" data-disabled='true'></a><sup class="unit" style='display:none;'> DNT</sup></p>
			</p>
		</div>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_2<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
