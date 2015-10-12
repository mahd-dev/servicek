<link href="<?php echo url_root;?>/pages/shop/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<?php
	if(!$is_contracted){
		$lc=$shop->last_contract;
		if($lc && $lc->type==0){
?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>La période d'essai a expiré</h4>
			<p>
				 Cette boutique n'est plus disponible au public, vous seul vous pouvez y accéder.<br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$shop->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }else{?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Cette boutique n'est pas publiée</h4>
			<p>
				 Cette boutique n'est plus disponible au public, vous seul vous pouvez y accéder.<br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$shop->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }}else{
	$cc=$shop->current_contract;
	$rd = $cc->remaining_days;
	if($cc->type==0){
		if($rd>10){
?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Cette boutique est en période d'essai gratuit</h4>
			<p>
				<?php if(strtotime($cc->expiration) > strtotime(date("d-m-Y h:i:s", mktime(0,0,0,1,1,2016)))){ ?>
				 Vous pouvez essayer toutes les fonctionnalités pendant 1 mois à partir de la date de création de la société,<br>
			  <?php }else{ ?>
				 Vous pouvez essayer toutes les fonctionnalités jusqu'à fin 2015 (à l'occasion de développement de servicek.net),<br>
			  <?php } ?>
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, cette boutique ne sera plus disponible au public.</span><br>
				 Afin d'assurer la disponibilité de la boutique, créez un contrat de publication avant la fin de la période d'essai.<br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$shop->url;?>/publish"><i class="icon-rocket"></i> Créer un contrat de publication</a><br>
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
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, cette boutique ne sera plus disponible au public.</span><br>
				 Afin d'assurer la disponibilité de la boutique, créez un contrat de publication avant la fin de la période d'essai.<br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$shop->url;?>/publish"><i class="icon-rocket"></i> Créer un contrat de publication</a><br>
				 <span class="text-success">La date de début contrat de publication sera initialisée à la date fin de la période d'essai.</span>
			</p>
		</div>
	</div>
</div>
<?php }}elseif($rd<=30){?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Le contrat de publication expirera bienôt</h4>
			<p>
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, cette boutique ne sera plus disponible au public.</span><br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$shop->url;?>/publish"><i class="icon-rocket"></i> Renouveler le contrat</a><br>
				 <span class="text-success">La date de début du nouveau contrat de publication sera initialisée à la date fin du contrat existant.</span>
			</p>
		</div>
	</div>
</div>
<?php }}?>

<div class="row">
	<div class="profile-sidebar col-md-3">
		<div class="portlet light profile-sidebar-portlet box">

			<div class="image fileinput col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12 fileinput-new box" style="padding:0;" data-provides="fileinput">
				<a style="max-width: 100%;" class="fileinput-preview thumbnail" data-trigger="fileinput">
					<img src="<?php $image=$shop->image; if($image) echo $paths->shop_image->url.$image; else {?>http://www.placehold.it/400x300/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
				</a>
				<form class="hide"><input type="file" name="image"></form>
			</div>

			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<a class="editable" data-name="name" data-type="text" ><?php echo $shop->name;?></a>
				</div>
			</div>

			<?php if ($is_admin_level): ?>
				<?php
					$address = $shop->url."@servicek.net";

					$mailbox = 'servicek.net';
					$username = $address;
					$password = $_SESSION["pwd"];
					$encryption = 'tls';

					$imap = new imap($mailbox, $username, $password, $encryption);

					if($imap->isConnected()===false) die($imap->getError());

					$unreadMessages = $imap->countUnreadMessages();
				?>
				<div class="profile-usertitle">
					<a href="<?php echo url_root."/".$shop->url; ?>/messages" class="btn btn-primary ajaxify messages"><i class="fa fa-envelope"></i> Consulter l'E-mail<?php if($unreadMessages){ ?> <span class="badge"><?php echo $unreadMessages; ?></span><?php } ?></a>
				</div>
			<?php endif; ?>

			<div class="profile-usermenu">
				<ul class="nav">
					<li class="active">
						<a href="#home_tab" data-toggle="tab" aria-expanded="true">
							<i class="fa fa-home"></i>
							Accueil
						</a>
					</li>
					<li>
						<a href="#config_tab" data-toggle="tab" aria-expanded="false">
							<i class="fa fa-cogs"></i>
							Configuration
						</a>
					</li>
				</ul>
			</div>

			<div class="profile-usertitle">
				<div class="fb-like" data-href="<?php echo url_root."/".$shop->url; ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</div>
		</div>

		<div class="info portlet light box">
			<h5>A propos :</h5>
			<a class="editable" data-name="description" data-type="textarea" ><?php echo $shop->description;?></a>
			<hr>
			<h5>Domaine<?php if($nb_categories) echo "s";?> d'activité :</h5>
			<?php if($is_contracted && !$is_trial){?>
				<?php echo $categories;?>
			<?php }else{?>
				<a class="categories-editable" data-name="categories" data-type="select2" data-value='<?php echo json_encode($categories_json);?>' data-available='<?php echo str_replace("'", "\u0027", json_encode($available_categories));?>'></a>
			<?php }?>
			<hr>
			<p class="margin-bottom-10">
				<strong>Adresse:</strong> <a class="seat_editable" data-pk="<?php echo $shop->id;?>" data-name="address" data-type="text" ><?php echo $shop->address; ?></a>
			</p>
			<p class="margin-bottom-10">
				<strong>Téléphone:</strong> <a class="seat_editable" data-pk="<?php echo $shop->id;?>" data-name="tel" data-type="text" ><?php echo $shop->tel; ?></a>
			</p>
			<p class="margin-bottom-10">
				<strong>Portable:</strong> <a class="seat_editable" data-pk="<?php echo $shop->id;?>" data-name="mobile" data-type="text" ><?php echo $shop->mobile; ?></a>
			</p>
			<p class="margin-bottom-10">
				<strong>Email:</strong> <a class="seat_editable" data-pk="<?php echo $shop->id;?>" data-name="email" data-type="text" ><?php echo $shop->email; ?></a>
			</p>
		</div>
		<div class="map_portlet portlet light">
			<a href="javascript:;" class="map_show" data-toggle="modal" data-target="#map_modal"></a>
			<div class="map_container aspectratio-container aspect-4-3 fit-width">
				<div class="map-canvas aspectratio-content" data-pk="<?php echo $shop->id;?>" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
			</div>
		</div>

	</div>
	<div class="col-md-9">

		<div class="tab-content">
			<div class="tab-pane active" id="home_tab">

				<div class="row hidden-sm">
					<div class="col-md-12">
						<div class="cover ps_image aspectratio-container aspect-3-1 fit-width fileinput fileinput-new" data-provides="fileinput">
							<a class="aspectratio-content thumbnail fileinput-preview" data-trigger="fileinput">
								<img src="<?php $cover=$shop->cover; if($cover) echo $paths->shop_cover->url.$cover; else {?>http://www.placehold.it/600x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+photo+de+couverture<?php }?>" alt="cover"/>
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
							<li class="active"><a href="#products_list" class="sp_tabs" data-toggle="tab" aria-expanded="false">Produits</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="javascript:;" class="new_product"><i class="fa fa-plus"></i> Ajouter un Produit</a></li>
						</ul>
					</div>
				</div>
				<div class="box">
					<div class="row">
						<div class="col-md-12">
							<div class="tab-content">
								<div class="tab-pane row active" id="products_list">
									<?php foreach ($shop->products as $p) {
										$product_categories_json = array();
										foreach ($p->categories as $cat) $product_categories_json[] = intval($cat->id);
									?>
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
													<p>Description : <br><a class="product_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="textarea" ><?php echo $p->description; ?></a></p>
													<p>Catégories : <a href="javascript:;" data-toggle="modal" data-target="#add_category_modal">Ajouter</a><br><a class="product_categories_editable" data-name="categories" data-pk="<?php echo $p->id; ?>" data-type="select2" data-value='<?php echo json_encode($product_categories_json);?>'></a> | <a href="javascript:;" class="clear_value">Supprimer</a></p>
													<p>Prix :<br>
														<?php $price=$p->price; $rent_price=$p->rent_price;?>
														<p><label><span><input type="checkbox" class="price_checkbox"<?php if($price!=null){?> checked<?php }?>></span>Vente </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="price" data-pk="<?php echo $p->id; ?>" data-type="number"<?php if($price==null){?> data-disabled='true'<?php }?>><?php echo $price; ?></a><sup class="unit"<?php if($price==null){?> style='display:none;'<?php }?>> DNT</sup></p>
														<p><label><span><input type="checkbox" class="rent_price_checkbox"<?php if($rent_price!=null){?> checked<?php }?>></span>Location </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="rent_price" data-pk="<?php echo $p->id; ?>" data-type="number"<?php if($rent_price==null){?> data-disabled='true'<?php }?>><?php echo $rent_price; ?></a><sup class="unit"<?php if($rent_price==null){?> style='display:none;'<?php }?>> DNT</sup></p>
													</p>
													<div class="fb-like" data-href="<?php echo url_root."/".$p->url;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
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

			<div class="tab-pane" id="config_tab">

				<?php if(isset($cc)){ ?>
				<div class="panel panel-default">
			    <div class="panel-heading">
						<h2 class="panel-title">Contrat actuel</h2>
					</div>
			    <div class="panel-body">
						<div class="list-group">
					    <div class="list-group-item">
				        <div class="row-content">
			            <h4 class="list-group-item-heading">
										Numéro <?php echo $cc->id; ?>
										<?php switch ($cc->type) {
											case 0:
												echo ", contrat de test";
												break;
											case 1:
												echo ", durée 6 mois";
												break;
											case 2:
												echo ", durée 1 an";
												break;
											case 3:
												echo ", durée 3 ans";
												break;
										} ?>
									</h4>
			            <p class="list-group-item-text">
										A partir de <?php echo date("d/m/Y h:i:s", strtotime($cc->creation_time)); ?><br>
										Jusqu'à <?php echo date("d/m/Y h:i:s", strtotime($cc->expiration)); ?>
									</p>
									<p class="list-group-item-text">
										<?php $ag = $cc->agent; if($ag){ ?>
										Paiement effectué manuellement via l'agent <?php echo $ag->displayname; ?> au totalité de <?php echo $cc->amount; ?><sup>DT</sup>
										<?php }else if($cc->payment_from){
											echo "Paiement effectué enligne via une carte ";
											switch ($cc->payment_from) {
												case 'e_dinar_smart_tunisian_post':
													echo "E-DINAR SMART (LA POSTE TUNISIENNE)";
													break;
												case 'visa_electron_tunisian_post':
													echo "VISA Electron (LA POSTE TUNISIENNE)";
													break;
												case 'visa':
													echo "VISA";
													break;
												case 'mastercard':
													echo "Mastercard";
													break;
											}
											echo "au totalité de ".$cc->amount."<sup>DT</sup><br>";
											echo "avec le reçu ".$cc->payment_recipt;
										} ?>
									</p>
				        </div>
					    </div>
						</div>
			    </div>
				</div>
				<?php } ?>

				<?php if ($user && $user->is_master): ?>
					<?php $page_admin = $shop->admin; $token = $page_admin->reset_password_token; ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2 class="panel-title">Administrateur</h2>
						</div>
						<div class="panel-body">
							<p>
								Nom d'utilisateur : <b><?php echo $page_admin->username; ?></b><br>
								Nom complet : <b><?php echo $page_admin->displayname; ?></b><br>
								E-mail : <b><?php echo $page_admin->email; ?></b><br>
								Tel : <b><?php echo $page_admin->mobile; ?></b>
							</p>
							<p>
								<div class="ticket"<?php if(!$token){ ?> style="display:none;"<?php } ?>>
									Ticket de réinitialisation du mot de passe : <b><?php echo url_root."/reset_password/";?><span class="token"><?php echo $token; ?></span></b>
									<button class="btn btn-flat cancel_password_reset_ticket">Annuler le ticket</button>
								</div>
								<div class="new_ticket"<?php if($token){ ?> style="display:none;"<?php } ?>>
									<button class="btn btn-flat new_password_reset_ticket">Créer un ticket de réinitialisation du mot de passe</button>
								</div>
							</p>
						</div>
					</div>
				<?php endif; ?>

				<?php if(!isset($cc) || $cc->type==0){ ?>
				<div class="panel panel-default">
			    <div class="panel-heading">
						<h2 class="panel-title">Changement de type</h2>
					</div>
			    <div class="panel-body">
						<div class="list-group">
					    <div class="list-group-item">
				        <div class="row-content">
			            <h4 class="list-group-item-heading">Conversion en métier</h4>
			            <p class="list-group-item-text text-warning">
										<i class="fa fa-exclamation-triangle"></i><br>
										La photo de couverture sera perdue car le type métier ne la possède pas.<br>
										Les produits seront converties en éléments du portefeuille, leurs prix seront perdues et leurs adresses URL seront changés.<br>
										Les domaines d'activités risquent d'être perdues selon leurs compatibilité avec le type métier.
									</p>
									<button class="btn btn-default pull-right transform_job">Convertir en métier</button>
				        </div>
					    </div>
					    <div class="list-group-separator"></div>
							<div class="list-group-item">
								<div class="row-content">
									<h4 class="list-group-item-heading">Conversion en société</h4>
									<p class="list-group-item-text text-warning">
										<i class="fa fa-exclamation-triangle"></i><br>
										Les domaines d'activités risquent d'être perdues selon leurs compatibilité avec le type société.
									</p>
									<button class="btn btn-default pull-right transform_company">Convertir en société</button>
								</div>
							</div>
						</div>
			    </div>
				</div>
				<?php } ?>

				<div class="panel panel-danger">
			    <div class="panel-heading">
		        <h2 class="panel-title">Zone dangeureuse</h2>
			    </div>
			    <div class="panel-body">
						<div class="list-group">
					    <div class="list-group-item">
				        <div class="row-content">
			            <h4 class="list-group-item-heading">Suppression de la société</h4>
			            <p class="list-group-item-text text-warning">
										<i class="fa fa-exclamation-triangle"></i><br>
										La suppression est définitive et vos ne pouvez jamais restaurer le compte ou ses données suivant le "<a href="https://fr.wikipedia.org/wiki/Droit_%C3%A0_l%27oubli" target="_blank">Droit à l'oubli</a>", SVP soyez sûr.
									</p>
									<button class="btn btn-danger pull-right delete_page" data-confirm="Etes vous sûr de supprimer la société ">Supprimer la société définitivement</button>
				        </div>
					    </div>
						</div>
			    </div>
				</div>
			</div>

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
			<p>Catégories : <a href="javascript:;" data-toggle="modal" data-target="#add_category_modal">Ajouter</a><br><a class="product_categories_editable" data-name="categories" data-type="select2" data-value='[]'></a> | <a href="javascript:;" class="clear_value">Supprimer</a></p>
			<p>Prix :<br>
				<p><label><span><input type="checkbox" class="price_checkbox" checked></span>Vente </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="price" data-pk="" data-type="number" ></a><sup class="unit"> DNT</sup></p>
				<p><label><span><input type="checkbox" class="rent_price_checkbox"></span>Location </label>&nbsp;&nbsp;&nbsp;&nbsp;<a class="product_editable" data-name="rent_price" data-pk="" data-type="number" data-disabled='true'></a><sup class="unit" style='display:none;'> DNT</sup></p>
			</p>
			<div class="fb-like" data-href="<?php echo url_root;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
		</div>
	</div>
</div>

<div class="modal fade" id="map_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
      <div class="modal-body">
				<div class="aspectratio-container aspect-4-3 fit-width">
					<div class="map-canvas aspectratio-content" data-pk="<?php echo $s->id;?>" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
				</div>
      </div>
    </div>
	</div>
</div>

<div class="modal fade" id="add_category_modal">
	<div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body">
				<p>Si vous ne trouvez pas une catégorie convenable a vos produits, ajoutez la en utilisant ce formulaire, et sélectionnez la dans les produits corresopndants</p>
				<form id="add_category_form" method="post">
					<fieldset>
						<div class="form-group">
							<b>Nom de nouvelle catégorie :</b>
              <input type="text" class="form-control" name="new_category" required>
		        </div>
					</fieldset>
				</form>
      </div>
			<div class="modal-footer">
        <button type="reset" form="add_category_form" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" form="add_category_form" class="btn btn-primary">Ajouter</button>
      </div>
    </div>
	</div>
</div>

<input type="hidden" name="available_product_categories" value='<?php echo str_replace("'", "\u0027", json_encode($available_product_categories));?>'>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/shop/script_2<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
