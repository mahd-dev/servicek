<link rel="stylesheet" type="text/css" href="<?php echo cdn;?>/libraries/bootstrap-editable/bootstrap-editable/css/bootstrap-editable<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css"/>

<link href="<?php echo url_root;?>/pages_admin/account/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">Mon compte <small> | Gérer servicek...</small></h2>
		<div class="row">
			<div class="profile-sidebar col-md-3">
				<div class="portlet light profile-sidebar-portlet box">
					<div class="profile-usertitle">
						<div class="profile-usertitle-name"><?php echo $user->displayname;?></div>
					</div>
					<div class="profile-usermenu">
						<ul class="nav">
							<li class="active">
								<a href="#dashboard_tab" data-toggle="tab" aria-expanded="true">
									<i class="icon-badge"></i>
									Tableau de bord
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
				<div class="box">
					<div class="tab-content">

						<div class="tab-pane active" id="dashboard_tab">
							<div class="row">
								<div class="col-md-4">
									<div class="panel panel-danger">
								    <div class="panel-heading" style="text-align:center;">
							        <h3 class="panel-title" style="font-size: 200%;">Métiers</h3>
											<span>Contractés / Visibles / Total</span>
								    </div>
								    <div class="panel-body">
							        <p style="font-size:35px;text-align: center;"><?php echo $count_contracted_jobs." / ".$count_visible_jobs." / ".$count_all_jobs; ?></p>
								    </div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel panel-success">
										<div class="panel-heading" style="text-align:center;">
							        <h3 class="panel-title" style="font-size: 200%;">Boutiques</h3>
											<span>Contractés / Visibles / Total</span>
								    </div>
								    <div class="panel-body">
							        <p style="font-size:35px;text-align: center;"><?php echo $count_contracted_shops." / ".$count_visible_shops." / ".$count_all_shops; ?></p>
								    </div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="panel panel-info">
										<div class="panel-heading" style="text-align:center;">
							        <h3 class="panel-title" style="font-size: 200%;">Sociétés</h3>
											<span>Contractés / Visibles / Total</span>
								    </div>
								    <div class="panel-body">
							        <p style="font-size:35px;text-align: center;"><?php echo $count_contracted_companies." / ".$count_visible_companies." / ".$count_all_companies; ?></p>
								    </div>
									</div>
								</div>
							</div>
							<a href="/admin/categories" class="btn btn-primary btn-raised ajaxify">Gérer les catégories</a>
						</div>

						<div class="tab-pane" id="settings">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#personal_data" data-toggle="tab" aria-expanded="true">Données personnelles</a>
								</li>
								<li>
									<a href="#passoword_tab" data-toggle="tab" aria-expanded="false">Mot de passe</a>
								</li>
							</ul>
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
								<div class="tab-pane" id="passoword_tab">
									<div style="display:flex; margin-top:20px;">
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
													<input type="password" class="form-control" placeholder="Ancien mot de passe" name="old_password" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
												</div>
												<div class="form-group">
													<input type="password" class="form-control" placeholder="Nouveau mot de passe" name="new_password" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
												</div>
												<div class="form-group">
													<input type="password" class="form-control" placeholder="Confirmer le nouveau mot de passe" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
												</div>
											</div>
											<div class="form-actions">
												<button type="submit" class="btn btn-raised blue pull-right">Modifier</button>
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

<script src="<?php echo url_root;?>/pages_admin/account/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
