<link href="<?php echo url_root;?>/pages/contact/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">Nous contacter</h2>
		<div class="portlet light">
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-6">
						<div class="space20"></div>
						<h3 class="form-section">Map</h3>
						<div class="aspectratio-container aspect-4-3 fit-width box">
							<div id="contactmap" class="aspectratio-content gmaps margin-bottom-40" style="height:100%;"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="space20"></div>
						<h3 class="form-section">Informations de contact</h3>
						<div class="box">
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
						</div>

						<div class="space20"></div>
						<h3 class="form-section">Envoyer un message</h3>
						<div class="box">
							<form id="message_form" method="post">
								<div class="alert alert-success success_msg" style="display: none;">
								    <strong>Merci, </strong> votre message a été envoyé avec succès.
								</div>
								<div class="alert alert-danger unhandled_error" style="display: none;">
								    <strong>Désolé, </strong> une erreur s'est parvenue lors de l'envoi du message.
								</div>
						    <fieldset>
									<div class="form-group">
			              <input type="email" class="form-control" name="email" placeholder="E-mail" required>
					        </div>
					        <div class="form-group">
			              <input type="text" class="form-control" name="subject" placeholder="Sujet" required>
					        </div>
					        <div class="form-group">
			              <textarea class="form-control" rows="3" name="message" style="max-width:100%;" placeholder="Message" required></textarea>
					        </div>
						    </fieldset>
				        <button type="submit" form="message_form" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Envoyer</button>
								<button type="reset" form="message_form" class="btn btn-default" data-dismiss="modal">Annuler</button>
							</form>
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
