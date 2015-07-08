<link href="<?php echo url_root;?>/pages/login/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-offset-2 col-md-4 col-sm-7">
				<h2 class="page-header center">Se connecter<br><small>Connectez à votre compte et gérer vos entreprises</small></h2>

        <div class="alert alert-danger username_error" style="display:none;">
            Nom d'utilisateur incorrect !
        </div>
        <div class="alert alert-danger password_error" style="display:none;">
            Mot de passe incorrect, vous avez encore <span class="remaining_attempts"></span> tentatives
        </div>
        <div class="alert alert-danger restricted_host" style="display:none;">
            Vous n'êtes pas autorisé à se connecter a partir de cet appareil
        </div>
        <div class="alert alert-danger waiting_restriction_time" style="display:none;">
            Vous avez encore <span class="remaining_time"></span> minutes pour pouvoir se connecter à cet utilisateur à partir de cet appareil
        </div>
        <div class="alert alert-danger unhandled_error" style="display:none;">
            <strong>Désolé!</strong> une erreur inattendue s'est intervenue :(
        </div>
				<div class="box">
					<form id="login_form" method="post">
						<div class="form-group">
							<input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" required>
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
						</div>
							<button type="submit" class="btn btn-primary btn-raised"><i class="icon-check"></i> Se connecter</button>
					</form>
				</div>
	</div>
    <div class="col-md-4 col-sm-5">
        <div class="alert alert-info">
            <h4>Vous ne disposez pas de compte ?</h4>
            <a href="<?php echo url_root;?>/register" class="btn btn-primary btn-raised ajaxify">Créer mon compte</a>
        </div>
    </div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/login/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
