<div class="row">
	<div class="col-md-offset-1 col-md-6">
		<div class="alert alert-warning">
			<h4>Vous êtes déja connecté en tant que <?php echo $user->displayname;?></h4>
			<p>
				 <a href="<?php echo url_root;?>/account" class="btn btn-primary btn-raised ajaxify"><i class="icon-user"></i> Aller à mon compte</a>&nbsp;&nbsp;&nbsp;&nbsp;
				 <a href="<?php echo url_root;?>/logout" class="btn ajaxify pull-right"><i class="icon-logout"></i> Se déconnecter</a>
			</p>
		</div>
	</div>
</div>
