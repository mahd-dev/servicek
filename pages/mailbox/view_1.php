<link href="<?php echo url_root;?>/pages/mailbox/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<h2 class="page-header"><?php echo $address;?></h2>
<div class="row">
	<div class="profile-sidebar col-md-3 col-sm-4">
		<button class="btn btn-primary new-btn" data-toggle="modal" data-target="#message_modal"><i class="fa fa-pencil"></i> Nouveau message</button>
		<div class="portlet light profile-sidebar-portlet box">
			<div class="profile-usermenu">
				<ul class="nav folders">
					<?php foreach (array_reverse($folders) as $folder): ?>
						<li<?php if(strtolower($folder)=="inbox"){ ?> class="active"<?php $f=0; } ?>>
							<a href="#" data-toggle="tab" data-folder="<?php echo $folder; ?>">
								<i class="icon-badge"></i>
								<?php
									switch (strtolower($folder)) {
										case 'inbox': echo "Boite de réception"; break;
										case 'draft': echo "Brouillon"; break;
										case 'sent': echo "Envoyé"; break;
										case 'trash': echo "Corbeille"; break;
										default: echo $folder; break;
									}
								?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="hidden-xs">
			<h4>Autres méthodes :</h4>
			<a href="http://webmail.servicek.net/?_user=<?php echo $page->url; ?>" target="_blank">Utiliser le Webmail</a><br>
			<a href="/help/mail-config/<?php echo $page->url; ?>" target="_blank">Configurer une application</a>
		</div>
	</div>
	<div class="profile-content col-md-9 col-sm-8">
		<div class="row messages-list" style="display: none;">
			<div class="col-md-12">
				<div class="box">
					<h4 class="empty-msg" style="display: none;">
						Aucun message
					</h4>
					<table class="table table-hover" style="display: none;">
				    <thead>
			        <tr>
		            <th>Objet</th>
		            <th>De</th>
		            <th>Date</th>
			        </tr>
				    </thead>
				    <tbody>
				    </tbody>
					</table>

				</div>
			</div>
		</div>
		<div class="row message-details" style="display:none;">
			<div class="col-md-12">
				<div class="box">
					<div class="row">
						<div class="col-md-12 toolbar">
							<button class="btn btn-flat back_to_list"><i class="fa fa-arrow-left"></i></button>
							<button class="btn btn-flat reply"><i class="fa fa-reply"></i> Répondre</button>
							<button class="btn btn-flat pull-right delete"><i class="fa fa-trash"></i> Supprimer</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="toolbar">
								<span class="pull-right">Envoyé le :<br><b><span class="date"></span></b></span>
								De : <b><span class="from"></span></b> , à : <b><span class="to"></span></b><br>
								Objet: <b><h3 class="subject"></h3></b>
							</div>
							<div class="toolbar attachments">
								Fichiers en attachement :<br>
								<div class="list">
								</div>
							</div>
							<div class="aspectratio-container aspect-1-1 fit-width">
								<div class="aspectratio-content">
									<iframe src="" width="100%" height="100%" frameborder="0" allowtransparency="true" allowfullscreen="true"></iframe>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="visible-xs-block">
			<h4>Autres méthodes :</h4>
			<a href="http://webmail.servicek.net/?_user=<?php echo $page->url; ?>" target="_blank">Utiliser le Webmail</a><br>
			<a href="/help/mail-config/<?php echo $page->url; ?>" target="_blank">Configurer une application</a>
		</div>

	</div>
</div>

<div class="modal fade" id="message_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Nouveau message</h4>
      </div>
      <div class="modal-body">
				<form id="message_form" method="post">
					<div class="alert alert-success success_msg" style="display: none;">
					    <strong>Merci, </strong> votre message a été envoyé avec succès.
					</div>
					<div class="alert alert-danger unhandled_error" style="display: none;">
					    <strong>Désolé, </strong> une erreur s'est parvenue lors de l'envoi du message.
					</div>
			    <fieldset>
						<div class="form-group">
							Destinations :
              <input type="text" class="form-control" name="email" placeholder="destination_1@exemple.com; destination_2@exemple.com;" required>
		        </div>
		        <div class="form-group">
							Sujet :
              <input type="text" class="form-control" name="subject" required>
		        </div>
						<div class="form-group">
							Attachements :
							<input type="file" class="form-control" name="attachments[]" multiple="">
						</div>
		        <div class="form-group">
							Message :
              <textarea class="form-control" name="message" style="max-width:100%; min-height:300px;" required></textarea>
		        </div>
			    </fieldset>
				</form>
      </div>
      <div class="modal-footer">
        <button type="reset" form="message_form" class="btn btn-default" data-dismiss="modal">Annuler</button>
        <button type="submit" form="message_form" class="btn btn-primary"><img src="<?php echo cdn; ?>/img/loader.gif" class="loader" alt="" /> <i class="fa fa-paper-plane"></i> Envoyer</button>
      </div>
    </div>
  </div>
</div>


<script src="<?php echo url_root;?>/pages/mailbox/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
