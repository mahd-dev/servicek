<link href="<?php echo url_root;?>/pages/contact/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="page-head">
			<div class="page-title">
				<h1>Nous contacter</h1>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-6">
						<div class="space20"></div>
						<h3 class="form-section">Map</h3>
						<div class="aspectratio-container aspect-4-3 fit-width">
							<div id="map" class="aspectratio-content gmaps margin-bottom-40" style="height:100%;"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="space20"></div>
						<h3 class="form-section">Informations de contact</h3>
						<div class="well">
							<h4>Address</h4>
							<address>
							<strong>Société tunisienne des services.</strong><br>
							 Rue Imem Al Gazali<br>
							 Kalaa Kebira, Sousse<br>
							<abbr title="Téléphone">Tel:</abbr> (+216) 97 83 11 97 </address>
							<address>
							<strong>Email</strong><br>
							<a href="mailto:contact@servicek.net">
							contact@servicek.net</a>
							</address>
							<ul class="social-icons margin-bottom-10">
								<li>
									<a href="https://www.facebook.com/www.servicek.net" data-original-title="facebook" class="facebook"></a>
								</li>
							</ul>
						</div>
					</div>
					<!--
					<div class="col-md-6">
						<div class="space20">
						</div>
						<form action="javascript:;">
							<h3 class="form-section">Proposer une idée</h3>
							<div class="form-group">
								<div class="input-icon">
									<i class="fa fa-check"></i>
									<input type="text" class="form-control" placeholder="Sujet">
								</div>
							</div>
							<div class="form-group">
								<div class="input-icon">
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" placeholder="Nom">
								</div>
							</div>
							<div class="form-group">
								<div class="input-icon">
									<i class="fa fa-envelope"></i>
									<input type="password" class="form-control" placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<textarea class="form-control" rows="3=6" placeholder="Message" style="max-width:100%;"></textarea>
							</div>
							<button type="submit" class="btn green">Envoyer</button>
						</form>
					</div>
					-->
				</div>
			</div>
		</div>

	</div>
</div>

<script src="<?php echo url_root;?>/pages/contact/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
