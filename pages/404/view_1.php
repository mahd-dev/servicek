<link href="<?php echo url_root;?>/pages/404/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
<div class="row">
	<div class="col-md-12 page-404">
		<div class="number">404</div>
		<div class="details">
			<h3>Oops! Vous êtes perdu.</h3>
			<p>
				on n'a pas pu trouver la page que vous demandez.<br/>
				<a href="<?php echo url_root;?>" class="ajaxify">
				Retour à l'accueil </a>
			</p>
		</div>
	</div>
</div>

<script src="<?php echo url_root;?>/pages/404/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
