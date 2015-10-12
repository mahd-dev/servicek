<link href="<?php echo url_root;?>/pages/job/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<?php
	if(!$is_contracted){
		$lc=$job->last_contract;
		if($lc &&$lc->type==0){
?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>La période d'essai a expiré</h4>
			<p>
				 Ce métier n'est plus disponible au public, vous seul vous pouvez y accéder.<br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$job->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }else{?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Ce métier n'est pas publiée</h4>
			<p>
				 Ce métier n'est plus disponible au public, vous seul vous pouvez y accéder.<br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$job->url;?>/publish"><i class="icon-rocket"></i> Publier maintenant</a>
			</p>
		</div>
	</div>
</div>
<?php }}else{
	$cc=$job->current_contract;
	$rd = $cc->remaining_days;
	if($cc->type==0){
		if($rd>10){
?>
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<h4>Ce métier est en période d'essai gratuit</h4>
			<p>
				 <?php if(strtotime($cc->expiration) > strtotime(date("d-m-Y h:i:s", mktime(0,0,0,1,1,2016)))){ ?>
					 Vous pouvez essayer toutes les fonctionnalités pendant 1 mois à partir de la date de création de la société,<br>
				 <?php }else{ ?>
					 Vous pouvez essayer toutes les fonctionnalités jusqu'à fin 2015 (à l'occasion de développement de servicek.net),<br>
				 <?php } ?>
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, ce métier ne sera plus disponible au public.</span><br>
				 Afin d'assurer la disponibilité du métier, créez un contrat de publication avant la fin de la période d'essai.<br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$job->url;?>/publish"><i class="icon-rocket"></i> Créer un contrat de publication</a><br>
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
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, ce métier ne sera plus disponible au public.</span><br>
				 Afin d'assurer la disponibilité du métier, créez un contrat de publication avant la fin de la période d'essai.<br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$job->url;?>/publish"><i class="icon-rocket"></i> Créer un contrat de publication</a><br>
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
				 <span class="text-danger">Au bout de <?php echo $rd;?> jours, ce métier ne sera plus disponible au public.</span><br><br>
				 <a class="btn btn-primary btn-raised ajaxify" href="<?php echo url_root."/".$job->url;?>/publish"><i class="icon-rocket"></i> Renouveler le contrat</a><br>
				 <span class="text-success">La date de début du nouveau contrat de publication sera initialisée à la date fin du contrat existant.</span>
			</p>
		</div>
	</div>
</div>
<?php }}?>
<div class="row">
	<div class="profile-sidebar col-md-3">
		<div class="portlet light profile-sidebar-portlet box">

			<div class="image fileinput col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12 fileinput-new" data-provides="fileinput">
				<a style="max-width: 100%;" class="fileinput-preview thumbnail" data-trigger="fileinput">
					<img src="<?php $image=$job->image; if($image) echo $paths->job_image->url.$image; else {?>http://www.placehold.it/400x300/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
				</a>
				<form class="hide"><input type="file" name="image"></form>
			</div>

			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					 <a href="javascript:;" class="editable" data-name="name" data-type="text" ><?php echo $job->name;?></a>
				</div>
			</div>

			<?php if ($is_admin_level): ?>
				<?php
					$address = $job->url."@servicek.net";

					$mailbox = 'servicek.net';
					$username = $address;
					$password = $_SESSION["pwd"];
					$encryption = 'tls';

					$imap = new imap($mailbox, $username, $password, $encryption);

					if($imap->isConnected()===false) die($imap->getError());

					$unreadMessages = $imap->countUnreadMessages();
				?>
				<div class="profile-usertitle">
					<a href="<?php echo url_root."/".$job->url; ?>/messages" class="btn btn-primary ajaxify messages"><i class="fa fa-envelope"></i> Consulter l'E-mail<?php if($unreadMessages){ ?> <span class="badge"><?php echo $unreadMessages; ?></span><?php } ?></a>
				</div>
			<?php endif; ?>

			<div class="profile-usermenu">
				<ul class="nav">
					<li class="active">
						<a href="#portfolio_tab" data-toggle="tab" aria-expanded="true">
							<i class="fa fa-suitcase"></i>
							Portefeuille
						</a>
					</li>
					<li>
						<a href="#cv_tab" data-toggle="tab" aria-expanded="false">
							<i class="fa fa-trophy"></i>
							CV
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
				<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
			</div>
		</div>

		<div class="portlet light box">
			<h5>Domaines d'activité :</h5>
			<?php if($is_contracted && !$is_trial){?>
				<?php echo $categories;?>
			<?php }else{?>
				<a class="categories-editable" data-name="categories" data-type="select2" data-value='<?php echo json_encode($categories_json);?>' data-available='<?php echo str_replace("'", "\u0027", json_encode($available_categories));?>'></a>
			<?php }?>
			<hr>
			<p class="margin-bottom-30">
				<h5>Adresse :</h5>
				<a href="javascript:;" class="editable" data-name="address" data-type="textarea" ><?php echo $job->address;?></a>
			</p>
			<p class="margin-bottom-30">
				<h5>Téléphone :</h5>
				<a href="javascript:;" class="editable" data-name="tel" data-type="text" ><?php echo $job->tel;?></a>
			</p>
			<p class="margin-bottom-30">
				<h5>Portable :</h5>
				<a href="javascript:;" class="editable" data-name="mobile" data-type="text" ><?php echo $job->mobile;?></a>
			</p>
			<p class="margin-bottom-30">
				<h5>Email :</h5>
				<a href="javascript:;" class="editable" data-name="email" data-type="text" ><?php echo $job->email;?></a>
			</p>
		</div>
		<div class="map_portlet portlet light">
			<a href="javascript:;" class="map_show" data-toggle="modal" data-target="#map_modal"></a>
			<div class="map_container aspectratio-container aspect-4-3 fit-width">
				<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
			</div>
		</div>
	</div>

	<div class="col-md-9">

			<div class="tab-content">

				<div class="tab-pane row active" id="portfolio_tab">
					<div class="portfolio_container">
						<?php foreach ($job->portfolio as $p) {
							$portfolio_categories_json = array();
							foreach ($p->categories as $cat) $portfolio_categories_json[] = intval($cat->id);
						?>
							<div class="col-xs-12 col-sm-6 col-md-4 item portfolio" data-id="<?php echo $p->id; ?>">
								<div class="box">
									<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>
									<div class="caption">
										<h3><a class="portfolio_editable" data-name="name" data-pk="<?php echo $p->id; ?>" data-type="text" ><?php echo $p->name; ?></a></h3>
									</div>
									<div class="portfolio_image ps_image aspectratio-container aspect-4-3 fit-width fileinput fileinput-new" data-provides="fileinput">
										<a class="aspectratio-content fileinput-preview thumbnail" data-trigger="fileinput">
											<img src="<?php $image=$p->image; if($image) echo $paths->portfolio_image->url.$image; else {?>http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
										</a>
										<form class="hide"><input type="file" name="image"></form>
									</div>

									<div class="caption">
										<p>Description : <br><a class="portfolio_editable" data-name="description" data-pk="<?php echo $p->id; ?>" data-type="textarea" ><?php echo $p->description; ?></a></p>
										<p>Catégories : <a href="javascript:;" data-toggle="modal" data-target="#add_category_modal">Ajouter</a><br><a class="portfolio_categories_editable" data-name="categories" data-pk="<?php echo $p->id; ?>" data-type="select2" data-value='<?php echo json_encode($portfolio_categories_json);?>'></a> | <a href="javascript:;" class="clear_value">Supprimer</a></p>
										<div class="fb-like" data-href="<?php echo url_root."/".$p->url;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
									</div>
								</div>
							</div>
						<?php }?>
					</div>
					<div class="col-md-12">
						<button class="btn btn-success btn-raised btn-sm new_portfolio"><i class="fa fa-plus"></i> Nouvel élément</button>
					</div>
				</div>

				<div class="tab-pane" id="cv_tab">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3><a href="javascript:;" class="editable" data-name="description" data-type="textarea" data-emptytext="A propos"><?php echo $job->description;?></a></h3>
						</div>
						<div class="panel-body skills">
							<h4>Compétences :</h4>
							<table class="table">
								<tbody class="skill_container">
									<?php foreach ($job->skills as $skill) { ?>
										<tr class="skill_item" data-id="<?php echo $skill->id; ?>">
											<td>
												<a href="javascript:;" class="skill_editable" data-name="title" data-type="text" data-emptytext="Compétence" data-pk="<?php echo $skill->id; ?>"><?php echo $skill->title; ?></a> -
												<small><a href="javascript:;" class="skill_editable" data-name="description" data-type="text" data-emptytext="Description de la compétence" data-pk="<?php echo $skill->id; ?>"><?php echo $skill->description; ?></a></small>
											</td>
											<td>
												<a href="javascript:;" class="skill_editable" data-name="percent" data-type="number" data-emptytext="Pourcentage" data-pk="<?php echo $skill->id; ?>"><?php $per = $skill->percent; echo ($per?$per:""); ?></a> %
											</td>
											<td>
												<button class="btn btn-primary btn-xs pull-right remove_skill"><i class="fa fa-close"></i></button>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<button class="btn btn-success btn-raised btn-sm add_skill"><i class="fa fa-plus"></i> Nouvelle compétence</button>
						</div>
					</div>

					<div class="cv_container">
						<?php foreach ($job->cv as $cv) { $items = $cv->items; ?>
							<div class="cv_item panel panel-default" data-id="<?php echo $cv->id; ?>">
								<div class="panel-heading">
									<button class="btn btn-primary btn-xs pull-right remove_cv"><i class="fa fa-close"></i></button>
									<h2><a href="javascript:;" class="cv_editable" data-name="title" data-type="text" data-emptytext="Nom du bloc (Etudes, Expériences, Stages ...)" data-pk="<?php echo $cv->id; ?>"><?php echo $cv->title; ?></a></h2>
									<p><a href="javascript:;" class="cv_editable" data-name="description" data-type="textarea" data-emptytext="Description du bloc" data-pk="<?php echo $cv->id; ?>"><?php echo $cv->description; ?></a></p>
								</div>
								<div class="panel-body">
									<div class="cv_item_container">
										<?php foreach ($items as $item) { $projects = $item->projects; ?>
											<div class="cv_item_item" data-id="<?php echo $item->id; ?>">
												<button class="btn btn-primary btn-xs pull-right remove_cv_item"><i class="fa fa-close"></i></button>
												<h3>
													<a href="javascript:;" class="cv_item_editable" data-name="title" data-type="text" data-emptytext="Titre" data-pk="<?php echo $item->id; ?>"><?php echo $item->title; ?></a>
													<small> à <a href="javascript:;" class="cv_item_editable" data-name="at" data-type="text" data-emptytext="Etablissement" data-pk="<?php echo $item->id; ?>"><?php echo $item->at; ?></a></small>
												</h3>
												<p><a href="javascript:;" class="cv_item_editable" data-name="description" data-type="text" data-emptytext="Description du titre" data-pk="<?php echo $item->id; ?>"><?php echo $item->description; ?></a></p>
												<p>Depuis <a href="javascript:;" class="cv_item_editable" data-name="date_from" data-type="date" data-format="yyyy-mm-dd" data-viewformat="dd/mm/yyyy" data- data-pk="<?php echo $item->id; ?>"><?php echo date("j/m/Y", strtotime($item->date_from)); ?></a>
													<?php $to = $item->date_to; ?>jusqu'à <a href="javascript:;" class="cv_item_editable" data-name="date_to" data-type="date" data-format="yyyy-mm-dd" data-viewformat="dd/mm/yyyy" data-emptytext="présent" data-pk="<?php echo $item->id; ?>"><?php if($to) echo date("j/m/Y", strtotime($item->date_to)); ?></a>
													 - <small><a href="javascript:;" class="cv_item_editable" data-name="location" data-type="text" data-emptytext="Emplacement" data-pk="<?php echo $item->id; ?>"><?php echo $item->location; ?></a></small>
												</p>
												<div class="list-group list-group-item">
													<h4>Projets :</h4>
													<div class="cv_item_project_container">
														<?php foreach ($projects as $project) { ?>
															<div class="cv_item_project_item" data-id="<?php echo $project->id; ?>">
																<h5 class="list-group-item-heading">
																	<button class="btn btn-primary btn-xs remove_cv_item_project"><i class="fa fa-close"></i></button>
																	<a href="javascript:;" class="cv_item_project_editable" data-name="title" data-type="text" data-emptytext="Nom" data-pk="<?php echo $project->id; ?>"><?php echo $project->title; ?></a> -
																	<small> <a href="javascript:;" class="cv_item_project_editable" data-name="description" data-type="text" data-emptytext="Description du projet" data-pk="<?php echo $project->id; ?>"><?php echo $project->description; ?></a></small>
																</h5>
																<div class="list-group-separator"></div>
															</div>
														<?php } ?>
													</div>
													<button class="btn btn-success btn-raised btn-sm add_cv_item_project"><i class="fa fa-plus"></i> Nouveau projet</button>
												</div>
												<hr>
											</div>
										<?php } ?>
									</div>
									<button class="btn btn-success btn-raised btn-sm add_cv_item"><i class="fa fa-plus"></i> Nouveau titre</button>
								</div>
							</div>
						<?php } ?>
					</div>
					<button class="btn btn-success btn-raised btn-sm add_cv"><i class="fa fa-plus"></i> Nouveau bloc</button>
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
						<?php $page_admin = $job->admin; $token = $page_admin->reset_password_token; ?>
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
				            <h4 class="list-group-item-heading">Conversion en boutique</h4>
				            <p class="list-group-item-text text-warning">
											<i class="fa fa-exclamation-triangle"></i><br>
											Le CV et les compétences seront perdues car le type boutique ne les possède pas.<br>
											les éléments du portefeuille seront converties en produits et leurs adresses URL seront changés.<br>
											Les domaines d'activités risquent d'être perdues selon leurs compatibilité avec le type boutique.
										</p>
										<button class="btn btn-default pull-right transform_shop">Convertir en boutique</button>
					        </div>
						    </div>
								<div class="list-group-separator"></div>
								<div class="list-group-item">
					        <div class="row-content">
				            <h4 class="list-group-item-heading">Conversion en société</h4>
				            <p class="list-group-item-text text-warning">
											<i class="fa fa-exclamation-triangle"></i><br>
											Le CV et les compétences seront perdues car le type société ne les possède pas.<br>
											les éléments du portefeuille seront converties en services et leurs adresses URL seront changés.<br>
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
				            <h4 class="list-group-item-heading">Suppression du métier</h4>
				            <p class="list-group-item-text text-warning">
											<i class="fa fa-exclamation-triangle"></i><br>
											La suppression est définitive et vos ne pouvez jamais restaurer le compte ou ses données suivant le "<a href="https://fr.wikipedia.org/wiki/Droit_%C3%A0_l%27oubli" target="_blank">Droit à l'oubli</a>", SVP soyez sûr.
										</p>
										<button class="btn btn-danger pull-right delete_page" data-confirm="Etes vous sûr de supprimer le métier ">Supprimer le métier définitivement</button>
					        </div>
						    </div>
							</div>
				    </div>
					</div>
				</div>

			</div>
	</div>
</div>

<div class="col-xs-12 col-sm-6 col-md-4 item portfolio" data-id="" id="new_portfolio_template" style="display:none;">
	<div class="box">
		<a class="delete btn btn-danger btn-xs pull-right margin-bottom-10"><i class="icon-close"></i> Supprimer</a>
		<div class="caption">
			<h3><a class="portfolio_editable name" data-name="name" data-pk="" data-type="text" ></a></h3>
		</div>
		<div class="portfolio_image ps_image aspectratio-container aspect-4-3 fit-width fileinput fileinput-new" data-provides="fileinput">
			<a class="aspectratio-content fileinput-preview thumbnail" data-trigger="fileinput">
				<img src="http://www.placehold.it/300x200/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image" alt="image"/>
			</a>
			<form class="hide"><input type="file" name="image"></form>
		</div>

		<div class="caption">
			<p>Description : <br><a class="portfolio_editable description" data-name="description" data-pk="" data-type="textarea" ></a></p>
			<p>Catégories : <a href="javascript:;" data-toggle="modal" data-target="#add_category_modal">Ajouter</a><br><a class="portfolio_categories_editable" data-name="categories" data-type="select2" data-value='[]'></a> | <a href="javascript:;" class="clear_value">Supprimer</a></p>
			<div class="fb-like" data-href="<?php echo url_root;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
		</div>
	</div>
</div>

<div style="display: none;" class="templates">
	<table>
		<tr class="skill_item" data-id="">
			<td>
				<a href="javascript:;" class="skill_editable" data-name="title" data-type="text" data-emptytext="Compétence" data-pk=""></a> -
				<small><a href="javascript:;" class="skill_editable" data-name="description" data-type="text" data-emptytext="Description de la compétence" data-pk=""></a></small>
			</td>
			<td>
				<a href="javascript:;" class="skill_editable" data-name="percent" data-type="number" data-emptytext="Pourcentage" data-pk=""></a> %
			</td>
			<td>
				<button class="btn btn-primary btn-xs pull-right remove_skill"><i class="fa fa-close"></i></button>
			</td>
		</tr>
	</table>

	<div class="cv_item panel panel-default" data-id="">
		<div class="panel-heading">
			<button class="btn btn-primary btn-xs pull-right remove_cv"><i class="fa fa-close"></i></button>
			<h2><a href="javascript:;" class="cv_editable" data-name="title" data-type="text" data-emptytext="Nom du bloc (Etudes, Expériences, Stages ...)" data-pk=""></a></h2>
			<p><a href="javascript:;" class="cv_editable" data-name="description" data-type="textarea" data-emptytext="Description du bloc" data-pk=""></a></p>
		</div>
		<div class="panel-body">
			<div class="cv_item_container"></div>
			<button class="btn btn-success btn-raised btn-sm add_cv_item"><i class="fa fa-plus"></i> Nouveau titre</button>
		</div>
	</div>

	<div class="cv_item_item" data-id="">
		<button class="btn btn-primary btn-xs pull-right remove_cv_item"><i class="fa fa-close"></i></button>
		<h3>
			<a href="javascript:;" class="cv_item_editable" data-name="title" data-type="text" data-emptytext="Titre" data-pk=""></a>
			<small> à <a href="javascript:;" class="cv_item_editable" data-name="at" data-type="text" data-emptytext="Etablissement" data-pk=""></a></small>
		</h3>
		<p><a href="javascript:;" class="cv_item_editable" data-name="description" data-type="text" data-emptytext="Description du titre" data-pk=""></a></p>
		<p>Depuis <a href="javascript:;" class="cv_item_editable" data-name="date_from" data-type="date" data-format="yyyy-mm-dd" data-viewformat="dd/mm/yyyy" data- data-pk=""></a>
			jusqu'à <a href="javascript:;" class="cv_item_editable" data-name="date_to" data-type="date" data-format="yyyy-mm-dd" data-viewformat="dd/mm/yyyy" data-emptytext="présent" data-pk=""></a>
			- <small><a href="javascript:;" class="cv_item_editable" data-name="location" data-type="text" data-emptytext="Emplacement" data-pk=""></a></small>
		</p>
		<h4>Projets :</h4>
		<div class="list-group">
			<div class="cv_item_project_container"></div>
			<button class="btn btn-success btn-raised btn-sm add_cv_item_project"><i class="fa fa-plus"></i> Nouveau projet</button>
		</div>
		<hr>
	</div>

	<div class="cv_item_project_item" data-id="">
		<h5 class="list-group-item-heading">
			<button class="btn btn-primary btn-xs remove_cv_item_project"><i class="fa fa-close"></i></button>
			<a href="javascript:;" class="cv_item_project_editable" data-name="title" data-type="text" data-emptytext="Nom" data-pk=""></a> -
			<small> <a href="javascript:;" class="cv_item_project_editable" data-name="description" data-type="text" data-emptytext="Description du projet" data-pk=""></a></small>
		</h5>
		<div class="list-group-separator"></div>
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

<input type="hidden" name="available_portfolio_categories" value='<?php echo str_replace("'", "\u0027", json_encode($available_portfolio_categories));?>'>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/job/script_2<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
