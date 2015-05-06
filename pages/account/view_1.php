<link rel="stylesheet" type="text/css" href="<?php echo cdn;?>/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css"/>

<link href="<?php echo url_root;?>/pages/account/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="page-head">
			<div class="page-title">
				<h1>Mon compte&nbsp;&nbsp;<small>Gérer vos sociétés, modifier vos attributs...</small></h1>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="profile-sidebar col-md-3">
				<div class="portlet light profile-sidebar-portlet">
					<div class="profile-usertitle">
						<div class="profile-usertitle-name"><?php echo $user->displayname;?></div>
					</div>
					<div class="profile-usermenu">
						<ul class="nav">
							<li class="active">
								<a href="#companies_tab" data-toggle="tab" aria-expanded="true">
									<i class="icon-badge"></i>
									Pages administées
								</a>
							</li>
							<li>
								<a href="#settings" data-toggle="tab" aria-expanded="false">
									<i class="icon-settings"></i>
									Paramètres
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="profile-content col-md-9">
				<div class="tab-content">
					<div class="tab-pane active" id="companies_tab">
						<?php if($num_pages==0){?>

							<div class="note note-info">
								<h3 class="block">Démarrez ici ..</h3>
								<p>
									 <div class="btn-group btn-group-solid margin-bottom-20">
										<a type="button" class="btn btn-lg green-haze ajaxify" href="<?php echo url_root;?>/new/company"><i class="icon-flag"></i> Publier ma Société</a>
										<a type="button" class="btn btn-lg blue-madison ajaxify" href="<?php echo url_root;?>/new/job"><i class="icon-pointer"></i> Publier mon travail</a>
									</div>
								</p>
							</div>

						<?php }else{?>
							<div class="portlet light">
								<div class="portlet-title">
									<div class="btn-group btn-group-solid pull-right">
										<a type="button" class="btn green-haze " href="<?php echo url_root;?>/new/company"><i class="icon-flag"></i> Publier une autre Société</a>
										<a type="button" class="btn blue-madison" href="<?php echo url_root;?>/new/job"><i class="icon-pointer"></i> Publier un autre travail</a>
									</div>
								</div>
								<div class="portlet-body">
									<div class="list-group">
										<?php foreach($pages as $p){?>
											<a href="<?php echo $p["url"];?>" class="ajaxify list-group-item">
												<h4>
													<i class="icon-<?php echo($p["type"]=="company" ? "flag" : "pointer");?>"></i>
													<?php echo $p["name"];?>
												</h4>
											</a>
										<?php }?>
									</div>
								</div>
							</div>

						<?php }?>

					</div>
					<div class="tab-pane" id="settings">
						<div class="portlet light">
							<div class="portlet-title tabbable-line">
								<ul class="nav nav-tabs pull-left">
									<li class="active">
										<a href="#personal_data" data-toggle="tab" aria-expanded="true">Données personnelles</a>
									</li>
									<li>
										<a href="#passoword_tab" data-toggle="tab" aria-expanded="false">Mot de passe</a>
									</li>
								</ul>
							</div>
							<div class="portlet-body">
								<div class="tab-content">
									<div class="tab-pane margin-bottom-30 active" id="personal_data">
									<p class="margin-bottom-30">
										<strong><h5>Nom complet</h5></strong>
										<a href="javascript:;" id="displayname" data-type="text" data-original-title="Entrer votre nom complet"><?php echo $user->displayname;?></a>
									</p>
									<p class="margin-bottom-30">
										<strong><h5>E-mail</h5></strong>
										<a href="javascript:;" id="email" data-type="email" data-original-title="Entrer adresse électronique"><?php echo $user->email;?></a>
									</p>
									<p class="margin-bottom-30">
										<strong><h5>Téléphone</h5></strong>
										<a href="javascript:;" id="mobile" data-type="tel" data-original-title="Entrer votre numéro de téléphone"><?php echo $user->mobile;?></a>
									</p>
									</div>
									<div class="tab-pane" id="passoword_tab" style="height:350px;">
										<div class="alert alert-success success_msg" style="display:none;">
								            Votre mot de passe a été modifiée avec succès
								        </div>
								        <div class="alert alert-danger new_password_min_length_error" style="display:none;">
								            Le nouveau mot de passe doit avoir au moin 8 caractères
								        </div>
										<div class="alert alert-danger old_password_error" style="display:none;">
								            L'ancien mot de passe est incorrect, vous avez encore <span class="remaining_attempts"></span> tentatives
								        </div>
								        <div class="alert alert-danger unhandled_error" style="display:none;">
								            <strong>Désolé!</strong> une erreur inattendue s'est intervenue :(
								        </div>
										<form id="password_form" method="POST" role="form" class="col-md-6">
											<div class="form-body">
												<div class="form-group">
													<label>Ancien mot de passe</label>
													<input type="password" class="form-control" placeholder="Ancien mot de passe" name="old_password" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
												</div>
												<div class="form-group">
													<label>Nouveau mot de passe</label>
													<input type="password" class="form-control" placeholder="Nouveau mot de passe" name="new_password" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
												</div>

												<div class="form-group">
													<label>Confirmation du mot de passe</label>
													<input type="password" class="form-control" placeholder="Confirmer le nouveau mot de passe" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
												</div>

											</div>
											<div class="form-actions">
												<button type="submit" class="btn blue pull-right">Modifier</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo url_root;?>/pages/account/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
