<link href="<?php echo url_root;?>/pages/contact/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<h2 class="page-header">Nous contacter</h2>
		<div class="portlet light">
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-6">
						<h3 class="form-section">Informations de contact</h3>
						<div class="box">
							<address>
								<table>
									<tbody>
										<tr>
											<td><i class="fa fa-map-marker"></i></td>
											<td>
												<p>
													<strong>Société tunisienne des services.</strong><br>
													 Rue Imem Al Gazali<br>
													 Kalaa Kebira 4060, Sousse, Tunisie
												</p>
											</td>
										</tr>
										<tr>
											<td><i class="fa fa-phone"></i></td>
											<td>
												<p>
													(+216) 73 35 00 73
												</p>
											</td>
										</tr>
										<tr>
											<td><i class="fa fa-mobile" style="font-size:120%;"></i></td>
											<td>
												<p>
													(+216) 97 83 11 97<br>
													(+216) 55 99 78 57
												</p>
											</td>
										</tr>
										<tr>
											<td><i class="fa fa-envelope"></i></td>
											<td>
												<p>
													<a href="mailto:contact@servicek.net">contact@servicek.net</a>
												</p>
											</td>
										</tr>
									</tbody>
								</table>
							<br>
						</div>
						<h3 class="form-section">Map</h3>
						<div class="aspectratio-container aspect-4-3 fit-width box">
							<div id="contactmap" class="aspectratio-content gmaps margin-bottom-40" style="height:100%;"></div>
						</div>
					</div>
					<div class="col-md-6">

						<div class="space20"></div>
						<h3 class="form-section">Envoyer un message à <b>contact@servicek.net</b></h3>
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
										<b>E-mail :</b>
			              <input type="email" class="form-control" name="email" required>
					        </div>
					        <div class="form-group">
										<b>Sujet :</b>
			              <input type="text" class="form-control" name="subject" required>
					        </div>
									<div class="form-group">
										<b>Fichiers en attachement :</b>
										<input type="file" name="attachments[]" multiple="">
									</div>
					        <div class="form-group">
										<b>Message :</b>
										<textarea class="form-control" rows="10" name="message" id="message" style="max-width:100%;" required></textarea>
					        </div>
						    </fieldset>
				        <button type="submit" form="message_form" class="btn btn-primary">
									<div class="loader btn-loader"><svg class="circular"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>
									<i class="fa fa-paper-plane"></i> Envoyer
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<script src="<?php echo url_root;?>/pages/contact/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
