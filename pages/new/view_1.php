<link href="<?php echo url_root;?>/pages/new/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<div class="alert alert-danger form-error hide">
			Vous avez des champs invalides, SVP vérifier ci-dessous.
		</div>
			<?php if($user==NULL || $user->is_master || $user->is_agent){ ?>
				<form id="register_form" method="post" role="form" action="<?php echo url_root;?>/register">
					<div class="form-body">
						<h2 class="page-header">Informations personelles</h2>
						<div class="box">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Nom et prénom" name="displayname" required>
							</div>
							<div class="form-group">
								<input type="email" class="form-control" placeholder="E-mail" name="email" required>
							</div>
							<div class="form-group">
								<input type="tel" class="form-control" placeholder="Téléphone" name="mobile" required>
							</div>
						</div>
						<h2 class="page-header">Informations du compte</h2>
						<div class="box">
							<div class="form-group">
								<div class="input-icon right">
									<input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username" required>
								</div>
								<div class="help-block margin-bottom-20">
									<span id="username_unvailable_msg" style="display:none;">Désolé, ce nom d'utilisateur existe déja</span>
									<span id="username_error_msg" style="display:none;">Oups, une erreur inattendue s'est parvenue lors de la vérification du nom de l'utilisateur ! <br>
										<a href='javascript:$("#register_form input[name=username]").change();'><i class="icon-reload"></i> Réessayer</a>
									</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-icon right">
									<input type="password" class="form-control" placeholder="Mot de passe" name="password" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
								</div>
								<div class="help-block margin-bottom-20">
									<span id="password_min_length_error" style="display:none;">Le mot de passe doit avoir au moin 8 caractères</span>
								</div>
							</div>
							<div class="form-group">
								<div class="input-icon right">
									<input type="password" class="form-control" placeholder="Retapez le mot de passe" id="password_confirmation" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
								</div>
								<div class="help-block margin-bottom-20">
									<span id="passwords_not_match" style="display:none;">Les mot de passe sne sont pas conformes</span>
								</div>
							</div>
						</div>
					</div>
				</form>
			<?php } ?>
			<div class="row">
				<div class="col-md-12">
					<div class="list-group radio">
						<div class="radio">
							<label>
								<input type="radio" name="type" value="1" checked="true">
								<h3 class="list-group-item-heading">Métier</h3>
							</label>
						</div>
						<div class="list-group-separator"></div>
						<div class="radio">
							<label>
								<input type="radio" name="type" value="2">
								<h3 class="list-group-item-heading">Boutique</h3>
							</label>
						</div>
						<div class="list-group-separator"></div>
						<div class="radio">
							<label>
								<input type="radio" name="type" value="3">
								<h3 class="list-group-item-heading">Société</h3>
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
				<div class="profile-content col-md-12">
					<div class="tab-content box">
						<div class="tab-pane active" id="title1">
							<form action="<?php echo url_root;?>/new/job" id="job_submit_form" method="POST">
								<div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="Nom du métier" data-msg-required="Ce champ est obligatoire"/>
								</div>
								<div class="form-group">
									<textarea class="form-control" name="description" placeholder="Expliquez brièvement le métier" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="4"></textarea>
								</div>
								<div class="form-group">
									<select name="categories[]" placeholder="Domaines d'activité" class="form-control select2" multiple>
										<?php foreach ($available_job_categories as $c) {?>
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
								<div class="form-group">
									<div class="input-group">
										<input type="text" placeholder="Adresse" class="form-control" name="address" data-msg-required="Ce champ est obligatoire"/>
										<span class="input-group-btn">
											<a class="btn btn-default" id="job_find_my_position" data-toggle="tooltip" title="Rechercher ma position"><i class="fa fa-compass" style="font-size:200%"></i></a>
										</span>
									</div>
									<span class="help-block">Recherchez vorte adresse et précisez là en déplaçant le pointeur sur la carte</span>
									<div class="aspectratio-container aspect-4-3 fit-width">
										<div id="job_geolocation" class="aspectratio-content"></div>
									</div>
									<input type="hidden" name="latitude">
									<input type="hidden" name="longitude">
								</div>

								<input type="hidden" placeholder="Numéro de téléphone fixe" class="form-control" name="tel" data-msg-required="Ce champ est obligatoire"/>
								<input type="hidden" placeholder="Numéro du téléphone mobile" class="form-control" name="mobile"/>
								<input type="hidden" placeholder="E-mail" class="form-control" name="email" data-msg-required="Ce champ est obligatoire"/>

								<input type="hidden" name="user_id" value="">

								<button type="submit" class="btn btn-primary btn-raised btn-lg">Créer le métier <i class="fa fa-check"></i></button>
							</form>
						</div>

						<div class="tab-pane" id="title2">
							<form action="<?php echo url_root;?>/new/shop" id="shop_submit_form" method="POST">
								<div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="Nom de la boutique" data-msg-required="Ce champ est obligatoire"/>
								</div>
								<div class="form-group">
									<textarea class="form-control" name="description" placeholder="Expliquez brièvement la boutique" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="4"></textarea>
								</div>
								<div class="form-group">
									<select name="categories[]" placeholder="Domaines d'activité" class="form-control select2" multiple>
										<?php foreach ($available_shop_categories as $c) {?>
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
								<div class="form-group">
									<div class="input-group">
										<input type="text" class="form-control" name="address" data-msg-required="Ce champ est obligatoire"/>
										<span class="input-group-btn">
											<a class="btn btn-default btn-flat" id="shop_find_my_position" data-toggle="tooltip" title="Rechercher ma position"><i class="fa fa-compass" style="font-size:200%"></i></a>
										</span>
									</div>
									<span class="help-block">Recherchez vorte adresse et précisez là en déplaçant le pointeur sur la carte</span>
									<div class="aspectratio-container aspect-4-3 fit-width">
										<div id="shop_geolocation" class="aspectratio-content"></div>
									</div>
									<input type="hidden" name="latitude">
									<input type="hidden" name="longitude">
								</div>

								<input type="hidden" class="form-control" name="tel" placeholder="Numéro de téléphone fixe" data-msg-required="Ce champ est obligatoire"/>
								<input type="hidden" class="form-control" name="mobile" placeholder="Numéro de téléphone mobile"/>
								<input type="hidden" class="form-control" name="email" placeholder="E-mail" data-msg-required="Ce champ est obligatoire"/>

								<input type="hidden" name="user_id" value="">

								<button type="submit" class="btn btn-primary btn-raised btn-lg">Créer la boutique <i class="fa fa-check"></i></button>
							</form>

						</div>

						<div class="tab-pane" id="title3">
							<form action="<?php echo url_root;?>/new/company" id="company_submit_form" method="POST">
								<div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="Nom de la société" data-msg-required="Ce champ est obligatoire"/>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="slogan" placeholder="Slogan"/>
								</div>
								<div class="form-group">
									<textarea class="form-control" name="description" placeholder="Expliquez brièvement la société" data-msg-required="Ce champ est obligatoire" style="max-width:100%; min-with:100%;" rows="4"></textarea>
								</div>
								<div class="form-group">
									<select name="categories[]" placeholder="Domaines d'activité" class="form-control select2" multiple>
										<?php foreach ($available_company_categories as $c) {?>
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
								<div class="form-group">
									<div class="input-group">
										<input type="text" class="form-control" name="address" data-msg-required="Ce champ est obligatoire"/>
										<span class="input-group-btn">
											<a class="btn btn-default btn-flat" id="company_find_my_position" data-toggle="tooltip" title="Rechercher ma position"><i class="fa fa-compass" style="font-size:200%"></i></a>
										</span>
									</div>
									<span class="help-block">Recherchez vorte adresse et précisez là en déplaçant le pointeur sur la carte</span>
									<div class="aspectratio-container aspect-4-3 fit-width">
										<div id="company_geolocation" class="aspectratio-content"></div>
									</div>
									<input type="hidden" name="latitude">
									<input type="hidden" name="longitude">
								</div>

								<input type="hidden" class="form-control" name="tel" placeholder="Numéro de téléphone fixe" data-msg-required="Ce champ est obligatoire"/>
								<input type="hidden" class="form-control" name="mobile" placeholder="Numéro de téléphone mobile"/>
								<input type="hidden" class="form-control" name="email" placeholder="E-mail" data-msg-required="Ce champ est obligatoire"/>

								<input type="hidden" name="user_id" value="">

								<button type="submit" class="btn btn-primary btn-raised btn-lg">Créer la société <i class="fa fa-check"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<script src="<?php echo url_root;?>/pages/new/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
