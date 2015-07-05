<link href="<?php echo url_root;?>/pages/newswitch/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
<div class="row">
	<div class="col-md-12">
		<div class="box">
			<form>
			</form>
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="list-group radio">
							<div class="radio">
								<label>
									<input type="radio" name="type" value="1" checked="true">
									<h4 class="list-group-item-heading">Title 1</h4>
								</label>
							</div>

							<div class="list-group-separator"></div>
							<div class="radio">
								<label>
									<input type="radio" name="type" value="3">
									<h4 class="list-group-item-heading">Title 3</h4>
								</label>
							</div>
							<div class="list-group-separator"></div>
						</div>
					</div>
				</div>

				<div style="display:none">
					<a href="#title1" data-toggle="tab"></a>
					<a href="#title2" data-toggle="tab"></a>
					<a href="#title3" data-toggle="tab"></a>
				</div>

				<div class="row">
					<div class="profile-content col-md-offset-3 col-md-6">
						<div class="tab-content ">
							<div class="tab-pane active" id="title1">
								<form action="javascript:;" id="job_submit_form" method="POST">

											<div class="alert alert-danger form-error hide">
												Vous avez des champs invalides, SVP vérifier ci-dessous.
											</div>

											<div class="form-group">
												<input type="text" class="form-control" name="job_name" placeholder="Nom du travail" data-msg-required="Ce champ est obligatoire"/>
											</div>
											<div class="form-group">
												<textarea class="form-control" name="job_description" placeholder="Expliquez brièvement le travail" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="5"></textarea>
											</div>
											<div class="form-group">
											<select name="job_categories[]" placeholder="Domaines d'activité" class="form-control select2" multiple>
												<?php foreach ($available_categories as $c) {?>
													<option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
												<?php }?>
											</select>
										</div>

											<div class="form-group">
												<div class="input-group">
													<input type="text" placeholder="Adresse" class="form-control" name="job_address" data-msg-required="Ce champ est obligatoire"/>
													<span class="input-group-btn">
														<a class="btn btn-default" id="job_find_my_position" data-toggle="tooltip" title="Rechercher ma position"><i class="icon-target"></i></a>
													</span>
												</div>


												<span class="help-block">Recherchez vorte adresse et précisez là en déplaçant le pointeur sur la carte</span>
												<div class="aspectratio-container aspect-4-3 fit-width">
													<div id="job_geolocation" class="aspectratio-content"></div>
												</div>
												<input type="hidden" name="job_latitude">
												<input type="hidden" name="job_longitude">
											</div>
											<div class="form-group">
												<input type="tel" placeholder="Numéro de téléphone fixe" class="form-control" name="job_tel" data-msg-required="Ce champ est obligatoire"/>
											</div>
											<div class="form-group">
												<input type="tel" placeholder="Numéro du téléphone mobile" class="form-control" name="job_mobile"/>
											</div>
											<div class="form-group">
												<input type="email" placeholder="E-mail" class="form-control" name="job_email" data-msg-required="Ce champ est obligatoire"/>
											</div>

										<button type="submit" class="btn btn-lg btn-success">Créer le travail <i class="fa fa-check"></i></button>

								</form>
							</div>

							<div class="tab-pane" id="title2">

							</div>

							<div class="tab-pane" id="title3">
								<form action="javascript:;" id="company_submit_form" method="POST">
									<div class="alert alert-danger form-error hide">
										Vous avez des champs invalides, SVP vérifier ci-dessous.
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="company_name" placeholder="Nom de la société" data-msg-required="Ce champ est obligatoire"/>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" name="company_slogan" placeholder="Slogan"/>
									</div>
									<div class="form-group">
										<textarea class="form-control" name="company_description" placeholder="Expliquez brièvement la société" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="5"></textarea>
									</div>
									<div class="form-group">
										<select name="company_categories[]" placeholder="Domaines d'activité" class="form-control select2" multiple>
											<?php foreach ($available_categories as $c) {?>
												<option value="<?php echo $c->id;?>"><?php echo $c->name;?></option>
											<?php }?>
										</select>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><?php echo url_root."/";?></span>
											<input type="text" class="form-control" name="company_url" placehoder="Lien électronique" data-msg-required="Ce champ est obligatoire" data-msg-remote="Ce lien n'est pas disponible"/>
										</div>
										<div class="error_msg"></div>
									</div>
									<hr>
									<div class="form-group">
										<label class="control-label">Adresse <span class="required">*</span></label>
										<div class="input-group">
											<input type="text" class="form-control" name="company_address" data-msg-required="Ce champ est obligatoire"/>
											<span class="input-group-btn">
												<a class="btn btn-default btn-flat" id="company_find_my_position" data-toggle="tooltip" title="Rechercher ma position"><i class="fa fa-compass" style="font-size:200%"></i></a>
											</span>
										</div>
										<span class="help-block">Recherchez vorte adresse et précisez là en déplaçant le pointeur sur la carte</span>
										<div class="aspectratio-container aspect-4-3 fit-width">
											<div id="company_geolocation" class="aspectratio-content"></div>
										</div>
										<input type="hidden" name="company_latitude">
										<input type="hidden" name="company_longitude">
									</div>
									<div class="form-group">
										<input type="tel" class="form-control" name="company_tel" placeholder="Numéro de téléphone fixe" data-msg-required="Ce champ est obligatoire"/>
									</div>
									<div class="form-group">
										<input type="tel" class="form-control" name="company_mobile" placeholder="Numéro de téléphone mobile"/>
									</div>
									<div class="form-group">
										<input type="email" class="form-control" name="company_email" placeholder="E-mail" data-msg-required="Ce champ est obligatoire"/>
									</div>
									<button type="submit" class="btn btn-lg btn-success">Créer la société <i class="fa fa-check"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

<script src="<?php echo url_root;?>/pages/newswitch/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
