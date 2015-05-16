<link href="<?php echo url_root;?>/pages/newjob/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="page-head">
			<div class="page-title">
				<h1>Création d'un nouveau travail</h1>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="portlet light" id="page_wizard">
			<div class="portlet-body form">
				<form action="javascript:;" class="form-horizontal" id="submit_form" method="POST">
					
						<div class="form-body">
							
							<div class="alert alert-danger form-error hide">
								Vous avez des champs invalides, SVP vérifier ci-dessous.
							</div>
							
							<h4 class="block">Informations d'identité</h4>

							<div class="form-group">
								<label class="control-label col-md-3">Nom <span class="required">*</span></label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" data-msg-required="Ce champ est obligatoire"/>
									<span class="help-block">Saisir le nom du travail </span>
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
							<label class="control-label col-md-3">Domaines d'activité <span class="required">*</span></label>
							<div class="col-md-6">
								<select name="categories[]" class="form-control select2" multiple>
									<?php foreach ($available_categories as $c) {?>
										<option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
									<?php }?>
								</select>
								<span class="help-block">Sélectionnez vos domaines d'activité</span>
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
						<div class="form-actions">
							<button type="submit" class="btn btn-success pull-right">Créer le travail <i class="icon-check"></i></button>
						</div>

				</form>
			</div>
		</div>

		<div id="success_msg" style="display:none;">
			<div class="note note-success">
				<h4 class="block"><i class="icon-trophy" style="font-size:150%;"></i>&nbsp;&nbsp;Félicitations, le travail é été bien crée</h4>
				<p>
				<a class="btn btn-success ajaxify goto_job" href="<?php echo url_root;?>/account"><i class="icon-link"></i>&nbsp;&nbsp;Accéder au travail crée</a>
				</p>
			</div>
		</div>

	</div>
</div>


<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/newjob/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
