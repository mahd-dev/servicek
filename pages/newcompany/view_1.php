<link href="<?php echo url_root;?>/pages/newcompany/style.min.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="page-head">
			<div class="page-title">
				<h1>Création d'une nouvelle société</h1>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light" id="page_wizard">
			<div class="portlet-body form">
				<form action="javascript:;" class="form-horizontal" id="submit_form" method="POST">
					<input type="hidden" name="token" value="<?php echo $new_company_token;?>">
					<div class="form-wizard">
						<div class="form-body">
							<ul class="nav nav-pills nav-justified steps">
								<li><a href="#company_details" data-toggle="tab" class="step active"><span class="number">1</span><span class="desc"><i class="fa fa-check"></i> Détails du travail </span></a></li>
								<li><a href="#contract_details" data-toggle="tab" class="step"><span class="number">2</span><span class="desc"><i class="fa fa-check"></i> Détails du contrat </span></a></li>
								<li><a href="#payment_informations" data-toggle="tab" class="step"><span class="number">3</span><span class="desc"><i class="fa fa-check"></i> Informations du paiement </span></a></li>
								<li><a href="#validation" data-toggle="tab" class="step"><span class="number">4</span><span class="desc"><i class="fa fa-check"></i> Validation </span></a></li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success">
								</div>
							</div>

							<div class="alert alert-danger form-error hide">
								Vous avez des champs invalides, SVP vérifier ci-dessous.
							</div>
							<div class="alert alert-danger payment_unhandled_error hide">
								Désolé une erreur s'est produite lors de l'authentification pour le paiement <button class="btn btn-link" type="submit"><i class="icon-reload"></i> Réessayer</button>
							</div>
							
							<div class="tab-content">
								
								<div class="tab-pane active" id="company_details">
									
									<h4 class="block">Informations d'identité</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Nom <span class="required">*</span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="name" data-msg-required="Ce champ est obligatoire"/>
											<span class="help-block">Saisir le nom du travail </span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Slogan</label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="slogan"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Détails <span class="required">*</span></label>
										<div class="col-md-6">
											<textarea class="form-control" name="description" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="5"></textarea>
											<span class="help-block">Expliquez brièvement le travail</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Lien électronique</label>
										<div class="col-md-6">
											<div class="input-group">
												<span class="input-group-addon"><?php echo url_root."/";?></span>
												<input type="text" class="form-control" name="url" data-msg-required="Ce champ est obligatoire" data-msg-remote="Ce lien n'est pas disponible"/>
											</div>
											<div class="error_msg"></div>
											<span class="help-block">Choisissez le lien électronique pour votre société</span>
										</div>
									</div>

									<h4 class="block">Contact du travail</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Adresse <span class="required">*</span></label>
										<div class="col-md-6">

											<div class="input-group">
												<input type="text" class="form-control" name="address" data-msg-required="Ce champ est obligatoire"/>
												<span class="input-group-btn">
													<a class="btn btn-default" id="find_my_position" data-toggle="tooltip" title="Rechercher ma position"><i class="icon-target"></i></a>
												</span>
											</div>

											
											<span class="help-block">Recherchez vorte adresse et précisez là en déplaçant le pointeur sur la carte</span>
											<div class="aspectratio-container aspect-4-3 fit-width">
												<div id="geolocation" class="aspectratio-content"></div>
											</div>
											<input type="hidden" name="latitude">
											<input type="hidden" name="longitude">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tel fixe <span class="required">*</span></label>
										<div class="col-md-6">
											<input type="tel" class="form-control" name="tel" data-msg-required="Ce champ est obligatoire"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tel mobile</label>
										<div class="col-md-6">
											<input type="tel" class="form-control" name="mobile"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">E-mail <span class="required">*</span></label>
										<div class="col-md-6">
											<input type="email" class="form-control" name="email" data-msg-required="Ce champ est obligatoire"/>
										</div>
									</div>
									
								</div>



								<div class="tab-pane" id="contract_details">
									<h4 class="block">Choix de l'offre</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Offre</label>
										<div class="col-md-6">
											<div class="list-group radio-list offer-list">
												<?php foreach($offers as $on=>$o){?>
													<label class="list-group-item"><input type="radio" name="offer" value="<?php echo $on;?>" data-title="<?php echo $o["text"];?>" data-amount="<?php echo $o["amount"];?> DT TTC" <?php if($o["default"]) echo "checked";?>> <?php echo $o["text"];?> <?php echo $o["help"];?></label>
												<?php }?>
											</div>
											
										</div>
									</div>
									
									<h4 class="block">Termes du contrat</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Contrat</label>
										<div class="col-md-6">
											<div class="portlet light bordered">
												<div class="portlet-title">
													<div class="caption font-green-sharp">
														<i class="icon-book-open font-green-sharp"></i>
														<span class="caption-subject bold uppercase"> Termes du contrat</span>
													</div>
													<div class="actions">
														<a href="javascript:;" class="btn btn-circle btn-default btn-icon-only fullscreen" data-original-title="plein écran" title="plein écran"></a>
													</div>
												</div>
												<div class="portlet-body">
													<div class="aspectratio-container aspect-1-1 fit-width">
														<div class="auto-scroll aspectratio-content">
															
															Contrat en cours de préparation

														</div>
													</div>
													<label><input type="checkbox" name="accept_contract" data-msg-required="Ce champ est obligatoire"> Je suis d'accord et j'accepte les termes du contrat</label>
													<div class="error_msg"></div>
												</div>
											</div>
										</div>
									</div>

								</div>



								<div class="tab-pane" id="payment_informations">

									<h4 class="block">Carte de crédit</h4>
									<div class="row">
										<div class="col-md-offset-3 col-md-6">
											<div class="note note-info">
												<h4 class="block"><i class="icon-lock" style="font-size:150%;"></i> Ce paiement est sécurisé</h4>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<label class="control-label col-md-3">Méthode <span class="required">*</span></label>
										<div class="col-md-6">
											<label><input type="radio" name="method" value="e_dinar_smart_tunisian_post" data-title="E-DINAR SMART (LA POSTE TUNISIENNE)" checked>
												<img src="<?php echo cdn;?>/img/payment/e_dinar_smart_tunisian_post.png" alt="poste tunisienne" style="max-height:60px;" class="pull-right">
											</label>
											<label><input type="radio" name="method" value="visa_electron_tunisian_post" data-title="VISA Electron (LA POSTE TUNISIENNE)">
												<img src="<?php echo cdn;?>/img/payment/visa_electron_tunisian_post.png" alt="poste tunisienne" style="max-height:60px;" class="pull-right">
											</label>
											<label><input type="radio" name="method" value="visa" data-title="VISA">
												<img src="<?php echo cdn;?>/img/payment/visa.png" alt="poste tunisienne" style="max-height:60px;" class="pull-right">
											</label>
											<label><input type="radio" name="method" value="mastercard" data-title="Masercard">
												<img src="<?php echo cdn;?>/img/payment/mastercard.png" alt="poste tunisienne" style="max-height:60px;" class="pull-right">
											</label>
										</div>
									</div>
									

									<div class="form-group">
										<label class="control-label col-md-3">Numéro de la carte <span class="required">*</span></label>
										<div class="col-md-6">
											<input type="text" class="form-control" name="credit_card_number" data-msg-required="Ce champ est obligatoire"/>
										</div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Mot de passe de la carte <span class="required">*</span></label>
										<div class="col-md-6">
											<input type="password" class="form-control" name="credit_card_password" data-msg-required="Ce champ est obligatoire"/>
										</div>
									</div>
									
								</div>



								<div class="tab-pane" id="validation">

									<h4 class="form-section">Identité du travail</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Nom :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="name"><strong></strong></p></div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Détails :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="description"><strong></strong></p></div>
									</div>

									<h4 class="form-section">Contact du travail</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Adresse :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="address"><strong></strong></p></div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tel fixe :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="tel"><strong></strong></p></div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">Tel mobile :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="mobile"><strong></strong></p></div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-3">E-mail :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="email"><strong></strong></p></div>
									</div>
									
									<h4 class="form-section">Offre</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Type de l'offre :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="offer"><strong></strong></p></div>
									</div>
									
									<h4 class="form-section">Paiement</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Montant à payer :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="amount"><strong></strong></p></div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Méthode :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="method"><strong></strong></p></div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Numéro de la carte :</label>
										<div class="col-md-6"><p class="form-control-static" data-display="credit_card_number"><strong></strong></p></div>
									</div>

								</div>



							</div>
						</div>
						<div class="form-actions">
							<a href="javascript:;" class="btn btn-default button-previous pull-left"><i class="<?php echo($rtl?"icon-arrow-right":"icon-arrow-left");?>"></i> Retour</a>
							<a href="javascript:;" class="btn btn-primary button-next pull-right">Continuer <i class="<?php echo($rtl?"icon-arrow-left":"icon-arrow-right");?>"></i></a>
							<a href="javascript:;" class="btn btn-success button-submit pull-right">Valider et créer <i class="icon-check"></i></a>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div id="success_msg" style="display:none;">
			<div class="note note-success">
				<h4 class="block"><i class="icon-trophy" style="font-size:150%;"></i>&nbsp;&nbsp;Félicitations, le travail é été bien crée</h4>
				<p>
					Accusé de paiment:
					<strong class="payment_recipt"></strong>
				</p>
				<p>
				<a class="btn btn-success ajaxify goto_job" href=""><i class="icon-link"></i>&nbsp;&nbsp;Accéder au travail crée</a>
				</p>
			</div>
		</div>

		<div id="already_done_msg" style="display:none;">
			<div class="note note-info">
				<h4 class="block"><i class="icon-info" style="font-size:150%;"></i>&nbsp;&nbsp;Vous avez déja crée le travail.</h4>
				<p>
					Accusé de paiment:
					<strong class="payment_recipt"></strong>
				</p>
				<p>
				<a class="btn btn-success ajaxify goto_job" href=""><i class="icon-link"></i>&nbsp;&nbsp;Accéder au travail crée</a>
				</p>
			</div>
		</div>

	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/newcompany/script_1.min.js" type="text/javascript"></script>
