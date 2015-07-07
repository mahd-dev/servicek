<link href="<?php echo url_root;?>/pages/newjob/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="page-head">
			<div class="page-title">
				<h1>Création d'un nouveau métier</h1>
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

							<div class="form-group">
								<input type="text" class="form-control" name="name" placeholder="Nom du métier" data-msg-required="Ce champ est obligatoire"/>
							</div>
							<div class="form-group">
								<textarea class="form-control" name="description" placeholder="Expliquez brièvement le métier" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="5"></textarea>
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
									<input type="text" placeholder="Adresse" class="form-control" name="address" data-msg-required="Ce champ est obligatoire"/>
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
							<div class="form-group">
								<input type="tel" placeholder="Numéro de téléphone fixe" class="form-control" name="tel" data-msg-required="Ce champ est obligatoire"/>
							</div>
							<div class="form-group">
								<input type="tel" placeholder="Numéro du téléphone mobile" class="form-control" name="mobile"/>
							</div>
							<div class="form-group">
								<input type="email" placeholder="E-mail" class="form-control" name="email" data-msg-required="Ce champ est obligatoire"/>
							</div>

						</div>
						<button type="submit" class="btn btn-success pull-right">Créer le métier <i class="icon-check"></i></button>

				</form>
			</div>
		</div>

		<div id="success_msg" style="display:none;">
			<div class="alert alert-success">
				<h4><i class="icon-trophy" style="font-size:150%;"></i>&nbsp;&nbsp;Félicitations, le métier é été bien crée</h4>
				<p>
				<a class="btn btn-success ajaxify goto_job" href="<?php echo url_root;?>/account"><i class="icon-link"></i>&nbsp;&nbsp;Accéder au métier crée</a>
				</p>
			</div>
		</div>

	</div>
</div>


<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/newjob/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
