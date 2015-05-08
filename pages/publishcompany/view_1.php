<link href="<?php echo url_root;?>/pages/publishcompany/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="page-head">
			<div class="page-title">
				<h1>Publication de la société</h1>
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
								<li><a href="#contract_details" data-toggle="tab" class="step"><span class="number">2</span><span class="desc"><i class="fa fa-check"></i> Détails du contrat </span></a></li>
								<li><a href="#payment_informations" data-toggle="tab" class="step"><span class="number">3</span><span class="desc"><i class="fa fa-check"></i> Informations du paiement </span></a></li>
								<li><a href="#validation" data-toggle="tab" class="step"><span class="number">4</span><span class="desc"><i class="fa fa-check"></i> Validation </span></a></li>
							</ul>
							<div id="bar" class="progress progress-striped" role="progressbar">
								<div class="progress-bar progress-bar-success">
								</div>
							</div>

							<div class="alert alert-danger form-error" style="display:none;">
								Vous avez des champs invalides, SVP vérifier ci-dessous.
							</div>
							<div class="alert alert-danger payment_unhandled_error" style="display:none;">
								Désolé une erreur s'est produite lors de l'authentification pour le paiement <button class="btn btn-link" type="submit"><i class="icon-reload"></i> Réessayer</button>
							</div>
							
							<div class="tab-content">
								
								<div class="tab-pane active" id="contract_details">
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
									
									<div class="tabbable-line">
										<ul class="nav nav-tabs ">
											<li class="active"><a href="#pay_online" class="payment_type" data-toggle="tab">Payer enligne</a></li>
											<li><a href="#local_pay" class="payment_type" data-toggle="tab">Paiement assisté par agent</a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="pay_online">

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
														<input type="text" class="form-control" name="credit_card_number" data-msg-required="Ce champ est obligatoire" data-msg-error="Ce numéro n'est pas valide" data-msg-balance-error="Vous n'avez pas accès de solde dans cette carte"/>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Mot de passe de la carte <span class="required">*</span></label>
													<div class="col-md-6">
														<input type="password" class="form-control" name="credit_card_password" data-msg-required="Ce champ est obligatoire" data-msg-error="Ce mot de passe n'est pas valide"/>
													</div>
												</div>
											</div>

											<div class="tab-pane" id="local_pay">
												<div class="row">
													<div class="col-md-offset-3 col-md-6">
														<div class="note note-info agent_warning">
															<h4 class="block"><i class="icon-info" style="font-size:150%;"></i> Cette méthode requit un agent agrée</h4>
															<p>
																Si vous n'êtes pas accompagné d'un de nos agents agrées, <a class="get_agent">demander un agent</a> immédiatement, ou <a class="ajaxify" href="<?php echo url_root;?>/contact">contactez nous</a> pour avoir un support direct.
															</p>
														</div>
														<div class="note note-success agent_request_success" style="display:none;">
															<h4 class="block"><i class="icon-like" style="font-size:150%;"></i> Merci,</h4>
															<p>
																on a bien reçu votre demande, on vous contactera très bientôt.
															</p>
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-md-3">Code privé de l'agent <span class="required">*</span></label>
													<div class="col-md-6">
														<input type="password" class="form-control" name="agent_code" data-msg-required="Ce champ est obligatoire" data-msg-error="Ce code n'est pas valide"/>
													</div>
												</div>

											</div>
										</div>
									</div>
									
								</div>



								<div class="tab-pane" id="validation">

									<h4 class="form-section">Identité du travail</h4>

									<div class="form-group">
										<label class="control-label col-md-3">Nom :</label>
										<div class="col-md-6"><p><strong><?php echo $company->name;?></strong></p></div>
									</div>

									<div class="form-group">
										<label class="control-label col-md-3">Description :</label>
										<div class="col-md-6"><p><strong><?php echo $company->description;?></strong></p></div>
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
				<h4 class="block"><i class="icon-trophy" style="font-size:150%;"></i>&nbsp;&nbsp;Félicitations, la société é été bien publiée</h4>
				<p>
					Accusé de paiment:
					<strong class="payment_recipt"></strong>
				</p>
				<p>
					<a class="btn btn-success ajaxify goto_company" href="<?php echo url_root;?>/account"><i class="icon-link"></i>&nbsp;&nbsp;Accéder à la société publiée</a>
				</p>
			</div>
		</div>

		<div id="already_done_msg" style="display:none;">
			<div class="note note-info">
				<h4 class="block"><i class="icon-info" style="font-size:150%;"></i>&nbsp;&nbsp;Vous avez déja publié la société</h4>
				<p>
					Accusé de paiment:
					<strong class="payment_recipt"></strong>
				</p>
				<p>
					<a class="btn btn-success ajaxify goto_company" href="<?php echo url_root;?>/account"><i class="icon-link"></i>&nbsp;&nbsp;Accéder à la société publiée</a>
				</p>
			</div>
		</div>

	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/publishcompany/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
