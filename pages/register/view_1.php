<link href="<?php echo url_root;?>/pages/register/style.css" rel="stylesheet" type="text/css">
<div class="page-head margin-bottom-20">
	<div class="page-title">
		<h1>Créer un compte&nbsp;&nbsp;&nbsp;&nbsp;<small>Créer votre compte et publiez vos entreprises</small></h1>
	</div>
</div>
<div class="row">
	<div class="col-md-7">
        <form role="form">
            <div class="form-body margin-bottom-20">
                <label class="control-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="username">
                <label class="control-label">Mot de passe</label>
                <input type="text" class="form-control" placeholder="Mot de passe" name="password">
                <label class="control-label">E-mail</label>
                <input type="email" class="form-control" placeholder="E-mail" name="email">
                <label class="control-label">Téléphone</label>
                <input type="text" class="form-control" placeholder="Téléphone" name="phone">
            </div>
            <div class="form-actions">
                <button type="submit" class="btn purple pull-right"><i class="icon-check"></i> S'inscrire</button>
            </div>
        </form>
	</div>
    <div class="col-md-5">
        <blockquote>Vous avez déja un compte ? <br><br><a href="<?php echo url_root;?>/login" class="btn btn green">Se connecter</a></blockquote>
    </div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/register/script_1.js" type="text/javascript"></script>
