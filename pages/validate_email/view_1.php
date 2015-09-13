<div class="row">
	<div class="col-md-offset-1 col-md-6">
		<div class="alert alert-success">
			<h3>Merci, votre adresse mail a été validée.</h3>
			<p>
				 <?php if ($new_user==$user): ?>
					 <a href="<?php echo url_root;?>/account" class="btn green ajaxify"><i class="icon-user"></i> Aller à mon compte</a>&nbsp;&nbsp;&nbsp;&nbsp;
				 <?php else: ?>
					 <a href="<?php echo url_root;?>/login" class="btn btn-primary ajaxify pull-right"><i class="icon-logout"></i> Se connecter</a>
					 <script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
				 <?php endif; ?>
			</p>
		</div>
	</div>
</div>
