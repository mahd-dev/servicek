<link href="<?php echo url_root;?>/help/mailconfig/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">Configuration de <?php echo $address; ?> <small>Accéder directement à la boite e-mail depuis votre téléphone ou votre application e-mail préférée.</small></h2>
		<!-- <ul class="nav nav-tabs">
			<li class="active"><a href="#general" data-toggle="tab">Générale</a></li>
			<li><a href="#thunderbird" data-toggle="tab">Thunderbird</a></li>
		</ul> -->
		<div class="portlet light box">
			<div id="myTabContent" class="tab-content">
		    <div class="tab-pane fade active in" id="general">
					<h4>IMAP</h4>
					<p>
						Adresse E-mail : <b><?php echo $address; ?></b>
					</p>
					<p>
						Nom d'utilisateur : <b><?php echo $username; ?></b> ou <b><?php echo $address; ?></b><br>
						Mot de passe : <b>Le même mot de passe de votre compte sur servicek.net</b>
					</p>
					<p>
						Serveur entrant : <b>servicek.net</b><br>
						Port serveur entrant : <b>143</b>
					</p>
					<p>
						Serveur sortant : <b>servicek.net</b><br>
						Port serveur entrant : <b>587</b>
					</p>
					<h4>POP3</h4>
					<p>
						Adresse E-mail : <b><?php echo $address; ?></b>
					</p>
					<p>
						Nom d'utilisateur : <b><?php echo $username; ?></b> ou <b><?php echo $address; ?></b><br>
						Mot de passe : <b>Le même mot de passe de votre compte sur servicek.net</b>
					</p>
					<p>
						Serveur entrant : <b>servicek.net</b><br>
						Port serveur entrant : <b>110</b>
					</p>
					<p>
						Serveur sortant : <b>servicek.net</b><br>
						Port serveur entrant : <b>587</b>
					</p>
		    </div>
		    <!-- <div class="tab-pane fade" id="thunderbird">

		    </div> -->
			</div>
		</div>
	</div>
</div>

<script src="<?php echo url_root;?>/help/mailconfig/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
