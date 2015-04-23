<link href="<?php echo url_root;?>/pages/register/style.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="portlet box purple ">
						<div class="portlet-title">
							<div class="caption">
							 Inscription
							</div>
							
						</div>
						<div class="portlet-body form" style="display: block;">
							<form class="form-horizontal" role="form">
								<div class="form-body">
									<div class="form-group">
										<label class="col-md-3 control-label">Nom d'utilisateur</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Mot de passe</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Mot de passe" name="password">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">E-mail</label>
										<div class="col-md-9">
											<input type="email" class="form-control" placeholder="E-mail" name="email">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-3 control-label">Téléphone</label>
										<div class="col-md-9">
											<input type="text" class="form-control" placeholder="Téléphone" name="phone">
										</div>
									</div>
								</div>
								<div class="form-actions right1">
									<button type="button" class="btn default">Cancel</button>
									<button type="submit" class="btn green pull-right">S'inscrire</button>
								</div>
							</form>
						</div>
					</div>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/register/script_1.js" type="text/javascript"></script>
