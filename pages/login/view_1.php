<link href="<?php echo url_root;?>/pages/login/style.css" rel="stylesheet" type="text/css">
<div class="page-head margin-bottom-20">
	<div class="page-title">
		<h1>Se connecter&nbsp;&nbsp;&nbsp;&nbsp;<small>Connectez à votre compte et gérer vos entreprises</small></h1>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
        <div class="alert alert-danger username_error" style="display:none;">
            Nom d'utilisateur incorrect !
        </div>
        <div class="alert alert-danger password_error" style="display:none;">
            Mot de passe incorrect !
        </div>
        <div class="alert alert-danger unhandled_error" style="display:none;">
            <strong>Désolé!</strong> une erreur inattendue s'est intervenue :(
        </div>
		<form id="login_form" method="post">
			<div class="form-group">
				<label for="username" class="control-label">Nom d'utilisateur</label>
				<input type="text" class="form-control" name="username" placeholder="Entrer votre nom d'utilisateur" required>
			</div>
			<div class="form-group">
				<label for="password" class="control-label">Mot de passe</label>
				<input type="password" class="form-control" name="password" placeholder="Entrer votre mot de passe" required>
			</div>
			<div class="form-group">
				<div class="checkbox"><label><input type="checkbox"> Se souvenir de moi</label></div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn purple pull-right"><i class="icon-check"></i> Se connecter</button>
			</div>
		</form>
	</div>
    <div class="col-md-5">
        <div class="note note-info">
            <h4 class="block">Vous ne disposez pas de compte ?</h4>
            <a href="<?php echo url_root;?>/register" class="btn btn green">Créer mon compte</a>
        </div>
    </div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/login/script_1.js" type="text/javascript"></script>
