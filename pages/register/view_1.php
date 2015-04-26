<link href="<?php echo url_root;?>/pages/register/style.css" rel="stylesheet" type="text/css">
<div class="page-head margin-bottom-20">
	<div class="page-title">
		<h1>Créer un compte&nbsp;&nbsp;&nbsp;&nbsp;<small>Créer votre compte et publiez vos entreprises</small></h1>
	</div>
</div>
<div class="row">
	<div class="col-md-offset-1 col-md-3">
        <form role="form">
            <div class="form-body margin-bottom-20">
                <label class="control-label">Votre nom complet</label>
                <input type="text" class="form-control" placeholder="Nom et prénom" name="displayname" required>
                <label class="control-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username" required>
                <label class="control-label">Mot de passe</label>
                <input type="text" class="form-control" placeholder="Mot de passe" name="password" required>
                <label class="control-label">E-mail</label>
                <input type="email" class="form-control" placeholder="E-mail" name="email" required>
                <label class="control-label">Téléphone</label>
                <input type="text" class="form-control" placeholder="Téléphone" name="phone" required>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn purple pull-right"><i class="icon-check"></i> S'inscrire</button>
            </div>
        </form>
	</div>
    <div class="col-md-3">
        <div class="note note-info">
            <h4 class="block">Vous avez déja un compte ?</h4>
            <a href="<?php echo url_root;?>/login" class="btn btn green">Se connecter</a>
        </div>
    </div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/register/script_1.js" type="text/javascript"></script>
