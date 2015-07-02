<link href="<?php echo url_root;?>/pages/newcompany/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-offset-3 col-md-6">
		<h2 class="page-header">Création d'une nouvelle société</h2>
		<div class="box" id="page_wizard">
			<div class="">
				<form action="javascript:;" id="submit_form" method="POST">

						<div class="alert alert-danger form-error hide">
							Vous avez des champs invalides, SVP vérifier ci-dessous.
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="Nom de la société" data-msg-required="Ce champ est obligatoire"/>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" name="slogan" placeholder="Slogan"/>
						</div>
						<div class="form-group">
							<textarea class="form-control" name="description" placeholder="Expliquez brièvement la société" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="5"></textarea>
						</div>

						<div class="form-group">
							<select name="categories[]" placeholder="Domaines d'activité" class="form-control select2" multiple>
								<?php foreach ($available_categories as $c) {?>
									<option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
								<?php }?>
							</select>
						</div>

						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><?php echo url_root."/";?></span>
								<input type="text" class="form-control" name="url" placehoder="Lien électronique" data-msg-required="Ce champ est obligatoire" data-msg-remote="Ce lien n'est pas disponible"/>
							</div>
								<div class="error_msg"></div>
							</div>


						<hr>

						<div class="form-group">
						<label class="control-label">Adresse <span class="required">*</span></label>
						<div class="input-group">
							<input type="text" class="form-control" name="address" data-msg-required="Ce champ est obligatoire"/>
							<span class="input-group-btn">
								<a class="btn btn-default btn-flat" id="find_my_position" data-toggle="tooltip" title="Rechercher ma position"><i class="fa fa-compass" style="font-size:200%"></i></a>
							</span>
						</div>
						<span class="help-block">Recherchez vorte adresse et précisez là en déplaçant le pointeur sur la carte</span>
						<div class="aspectratio-container aspect-4-3 fit-width">
							<div id="geolocation" class="aspectratio-content"></div>
						</div>
						<input type="hidden" name="latitude">
						<input type="hidden" name="longitude">
					</div>

						<div class="form-group">
							<input type="tel" class="form-control" name="tel" placeholder="Numéro de téléphone fixe" data-msg-required="Ce champ est obligatoire"/>
						</div>
						<div class="form-group">
							<input type="tel" class="form-control" name="mobile" placeholder="Numéro de téléphone mobile"/>
						</div>
						<div class="form-group">
							<input type="email" class="form-control" name="email" placeholder="E-mail" data-msg-required="Ce champ est obligatoire"/>
						</div>

						<button type="submit" class="btn btn-lg btn-success">Créer la société <i class="fa fa-check"></i></a>
					</div>

				</form>
			</div>
		</div>

		<div id="success_msg" style="display:none;">
			<div class="alert alert-success">
				<h4><i class="fa fa-trophy" style="font-size:150%;"></i>&nbsp;&nbsp;Félicitations, le travail é été bien crée</h4>
				<p>
					Accusé de paiment:
					<strong class="payment_recipt"></strong>
				</p>
				<p>
				<a class="btn btn-success ajaxify goto_company" href="<?php echo url_root;?>/account"><i class="fa fa-link"></i>&nbsp;&nbsp;Accéder au travail crée</a>
				</p>
			</div>
		</div>

	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/newcompany/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
