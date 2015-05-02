<link href="<?php echo url_root;?>/pages/register/style.css" rel="stylesheet" type="text/css">
<div class="row">
	<div class="col-md-12">
		<div class="page-head margin-bottom-20">
			<div class="page-title">
				<h1>Créer un compte&nbsp;&nbsp;<small>Créer votre compte et publiez vos entreprises</small></h1>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-offset-1 col-md-3">
		<form id="register_form" method="post" role="form">
			<div class="form-body margin-bottom-20">
				<div class="form-group">
					<label class="control-label">Votre nom complet</label>
					<input type="text" class="form-control" placeholder="Nom et prénom" name="displayname" required>
				</div>

				<div class="form-group">
					<label class="control-label">Nom d'utilisateur</label>
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
					<label class="control-label">Mot de passe</label>
					<div class="input-icon right">
						<input type="password" class="form-control" placeholder="Mot de passe" name="password" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
					</div>
					<div class="help-block margin-bottom-20">
						<span id="password_min_length_error" style="display:none;">Le mot de passe doit avoir au moin 8 caractères</span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label">Confirmation mot de passe</label>
					<div class="input-icon right">
						<input type="password" class="form-control" placeholder="Retapez le mot de passe" id="password_confirmation" pattern=".{8,}" title="Le mot de passe doit avoir au moin 8 caractères" required>
					</div>
					<div class="help-block margin-bottom-20">
						<span id="passwords_not_match" style="display:none;">Les mot de passe sne sont pas conformes</span>
					</div>
				</div>

				<div class="form-group">
					<label class="control-label">E-mail</label>
					<input type="email" class="form-control" placeholder="E-mail" name="email" required>
				</div>

				<div class="form-group">
					<label class="control-label">Téléphone</label>
					<input type="tel" class="form-control" placeholder="Téléphone" name="mobile" required>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" class="btn btn-primary pull-right"><i class="icon-check"></i> S'inscrire</button>
			</div>
		</form>
	</div>
	<div class="col-md-3">
		<div class="note note-info">
			<h4 class="block">Vous avez déja un compte ?</h4>
			<a href="<?php echo url_root;?>/login" class="btn green ajaxify">Se connecter</a>
		</div>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/register/script_1.js" type="text/javascript"></script>
