<link href="<?php echo url_root;?>/pages/forgotten_password/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-offset-2 col-md-4">
		<h2 class="page-header center">Demande de réinitialisation<br>du mot de passe<br></h2>

		<div class="alert alert-success success" style="display:none;">
				Le ticket de réinitialisation du mot de passe vous a été envoyé avec succès, rendez-vous sur votre boite de réception.
		</div>
		<div class="box">
			<form id="reset_form" method="post" role="form">
				<div class="form-body margin-bottom-20">

					<div class="form-group">
						<div class="input-icon right">
							<input type="text" class="form-control" placeholder="Adresse E-mail" name="email" title="Cette adresse n'existe pas dans notre répertoire." required>
						</div>
						<div class="help-block margin-bottom-20">
							<span id="email_not_exists" style="display:none;">Cette adresse n'existe pas dans notre répertoire</span>
						</div>
					</div>
					<div class="form-group input_accounts" style="display: none;">
						Sélectionnez le compte à réinitialiser :
						<select class="form-control" name="account">
						</select>
					</div>

				</div>
				<button type="submit" class="btn btn-primary btn-raised"><i class="icon-check"></i> Envoyer la demande</button>
				<p>
					Ou <a href="<?php echo url_root;?>/contact" class="ajaxify">contacter le support</a> pour m'aider à résoudre ce problème.
				</p>
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
<script src="<?php echo url_root;?>/pages/forgotten_password/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
