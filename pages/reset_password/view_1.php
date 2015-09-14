<link href="<?php echo url_root;?>/pages/reset_password/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-offset-2 col-md-4">
		<h2 class="page-header center">Réinitialisation du mot de passe<br></h2>

		<div class="box">
			<h4>
				Nom d'utilisateur: <b><?php echo $new_user->username; ?></b>
			</h4>
			<form id="reset_form" method="post">
				<div class="form-body margin-bottom-20">

					<div class="form-group">
						<div class="input-icon right">
							<input type="password" class="form-control" placeholder="Nouveau mot de passe" name="password" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
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
							<span id="passwords_not_match" style="display:none;">Les mot de passes ne sont pas conformes</span>
						</div>
					</div>

				</div>
				<button type="submit" class="btn btn-primary btn-raised"><i class="icon-check"></i> Réinitialiser</button>
			</form>
		</div>
	</div>
	<div class="col-md-4">
		<div class="alert alert-info">
			<h4>Vous souvenez-vous de votre mot de passe ?</h4>
			<a href="<?php echo url_root;?>/login" class="btn btn-primary btn-raised ajaxify">Se connecter</a>
		</div>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/reset_password/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

<script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
