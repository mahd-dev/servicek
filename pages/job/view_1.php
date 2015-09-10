<link href="<?php echo url_root;?>/pages/job/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="profile-sidebar col-md-3">

				<?php $image=$job->image; if($image){?>
					<img style="max-width: 100%;" class="public_image" src="<?php echo $paths->job_image->url.$image;?>" alt="image"/>
				<?php }?>

				<div class="portlet light profile-sidebar-portlet box">

					<div class="profile-usertitle">
						<div class="profile-usertitle-name">
							 <?php echo $job->name;?>
						</div>
						<button class="btn btn-primary btn-raised btn-sm message" data-toggle="modal" data-target="#message_modal"><i class="fa fa-envelope"></i> Envoyer un message</button>
						<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
					</div>

					<?php if($count_p_list && $count_cv) { ?>
					<div class="profile-usermenu">
						<ul class="nav">
							<li class="active">
								<a href="#portfolio" data-toggle="tab" aria-expanded="true">
									<i class="fa fa-suitcase"></i>
									Portefeuille
								</a>
							</li>
							<li>
								<a href="#cv" data-toggle="tab" aria-expanded="false">
									<i class="fa fa-trophy"></i>
									CV
								</a>
							</li>
						</ul>
					</div>
					<?php } ?>
				</div>
				<div class="portlet light box">
					<strong><h5>Domaine<?php if($nb_categories>1) echo "s";?>  d'activité :</h5></strong>
					<?php echo $categories;?>

					<hr>

					<p class="margin-bottom-30">
						<strong><h5>Adresse :</h5></strong>
						<?php echo $job->address;?>
					</p>
					<p class="margin-bottom-30">
						<strong><h5>Téléphone :</h5></strong>
						<?php echo $job->tel;?>
					</p>
					<p class="margin-bottom-30">
						<strong><h5>Portable :</h5></strong>
						<?php echo $job->mobile;?>
					</p>
					<p class="margin-bottom-30">
						<strong><h5>Email :</h5></strong>
						<?php echo $job->email;?>
					</p>

				</div>

				<div class="map_portlet portlet light">
					<a href="javascript:;" class="map_show" data-toggle="modal" data-target="#map_modal"></a>
					<div class="map_container tab-content aspectratio-container aspect-4-3 fit-width">
						<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
					</div>
				</div>

			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3><?php echo $job->description;?></h3>
					</div>
					<?php $skills = $job->skills; if(count($skills)) { ?>
					<div class="panel-body skills">
						<h4>Compétences :</h4>
						<table class="table">
							<tbody>
								<?php foreach ($skills as $skill) { ?>
								<tr>
									<td><?php echo $skill->title; $desc = $skill->description; if($desc){ ?> - <small> <?php echo $skill->description; ?></small><?php } ?></td>
									<td>
										<div class="progress">
                      <div class="progress-bar" style="width: <?php $p = $skill->percent; echo ($p<0?0:($p>100?100:$p)); ?>%;"></div>
                    </div>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<?php } ?>
				</div>

				<div class="tab-content">

					<?php if($count_p_list) { ?>
						<div class="tab-pane active" id="portfolio">
							<h3>Portefeuille :</h3>
							<div class="btn-toolbar">
								<div class="btn-group">
								  <button class="btn btn-default filter-button" data-filter="*">Tout</button>
								  <?php foreach ($p_list_categories as $c) { ?>
										<button class="btn btn-default filter-button" data-filter=".<?php echo $c->id; ?>"><?php echo $c->name; ?></button>
									<?php } ?>
								</div>
							</div>
							<div class="row grid">
								<?php foreach ($p_list as $p) {
									if( $p["name"] || $p["image"] ){
								?>
									<div class="col-xs-12 col-sm-6 col-md-4 element-item<?php foreach($p["categories"] as $c) echo " ".$c; ?>">
										<a class="item po"
											data-type="<?php echo $p["type"]; ?>"
											data-id="<?php echo $p["id"]; ?>"
											data-name="<?php if($p["name"]){ echo $p["name"]; }?>"
											data-description="<?php echo $p["description"]; ?>"
											data-url="<?php if($p["url"]){ echo $p["url"]; }?>"
										>

											<div class="property-box">
												<div class="property-box-image">
													<?php if($p["image"]){?>
														<div class="po_image po_public_image aspectratio-container aspect-4-3 fit-width">
															<div class="aspectratio-content">
																<img class="prod_srv_image" src="<?php echo $p["image"];?>" alt="image"/>
															</div>
														</div>
													<?php }else{ ?>
														<div class="aspectratio-container aspect-4-3 fit-width">
															<div class="aspectratio-content"></div>
														</div>
													<?php }?>
												</div>
												<div class="property-box-content">
													<h3><?php echo $p["name"]; ?></h3>
													<p><?php echo $p["description"]; ?></p>
													<div class="fb-like" data-href="<?php echo url_root."/".$p["url"];?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
												</div>
											</div>

										</a>
									</div>
								<?php }}?>
							</div>
						</div>
					<?php }?>
					<?php if($count_cv){ ?>
						<div class="tab-pane<?php if(!$count_p_list) echo " active"; ?>" id="cv">
							<?php foreach ($cv_list as $cv) { $items = $cv->items; ?>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2><?php echo $cv->title; ?></h2>
									<p><?php echo $cv->description; ?></p>
								</div>
								<div class="panel-body">
									<?php foreach ($items as $item) { $projects = $item->projects; ?>
										<h3><?php echo $item->title; $at=$item->at; if($at) {?> <small> à <?php echo $at; ?></small> <?php } ?></h3>
										<p><?php echo $item->description; ?></p>
										<p>Depuis <?php echo date("j M Y", strtotime($item->date_from)); $to = $item->date_to; $loc = $item->location; if($to) {?> jusqu'à <?php echo date("j M Y", strtotime($to)); } if($loc){ ?> - <small><?php echo $loc; ?></small><?php } ?></p>
										<?php if(count($projects)){ ?>
											<h4>Projet<?php if(count($projects)>1) echo "s";?> :</h4>

											<div class="list-group">
												<?php foreach ($projects as $project) { ?>
											    <div class="list-group-item">
									            <h5 class="list-group-item-heading"><?php echo $project->title; ?> <small> <?php echo $project->description; ?></small></h5>
											    </div>
											    <?php if (next($items)==true) { ?><div class="list-group-separator"></div><?php } ?>
												<?php } ?>
											</div>
										<?php } ?>
									<?php if (next($items)!=true) echo "<hr>";} ?>
								</div>
							</div>
							<?php } ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal po_modal fade bs-example-modal-lg" id="show_po" tabindex="-1" role="dialog" aria-labelledby="show product-service">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="row">
				<div class="col-md-9 col-sm-8">
					<div class="po_image aspectratio-container">
						<div class="aspectratio-content prod_srv_image"></div>
					</div>
				</div>
				<div class="col-md-3 col-sm-4">
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-flat pull-right" data-dismiss="modal"><i class="fa fa-times"></i></button>
								<button class="btn btn-flat previous"><i class="fa fa-arrow-left"></i></button>
								<button class="btn btn-flat next"><i class="fa fa-arrow-right"></i></button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<h2 class="modal-title"></h2>
								<div class="caption">
									<p class="description"></p>
								</div>
								<p>
									<div class="fb-like" data-href="<?php echo url_root;?>" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div></p>
									<div class="fb-comments" data-href="<?php echo url_root;?>" data-width="100%" data-numposts="5"></div>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="message_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Envoyer un message à <b><?php echo $job->url; ?>@servicek.net</b></h4>
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
				</form>
      </div>
      <div class="modal-footer">
        <button type="reset" form="message_form" class="btn btn-default" data-dismiss="modal">Fermer</button>
        <button type="submit" form="message_form" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Envoyer</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="map_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
      <div class="modal-body">
				<div class="aspectratio-container aspect-4-3 fit-width">
					<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
				</div>
      </div>
    </div>
	</div>
</div>

<input type="hidden" name="root_url" value="<?php echo url_root.'/'.$job->url; ?>"/>

<?php if(isset($po)){ ?>
<input type="hidden" name="po_id" value="<?php echo $po->id; ?>"/>
<input type="hidden" name="po_type" value="<?php echo get_class($po); ?>"/>
<?php } ?>

<script src="<?php echo cdn;?>/libraries/isotope/dist/isotope.pkgd.min.js" type="text/javascript"></script>
<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/job/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
