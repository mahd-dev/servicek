<link href="<?php echo cdn;?>/pages/css/tasks.css" rel="stylesheet" type="text/css" />
<link href="<?php echo url_root;?>/pages/account/style.css" rel="stylesheet" type="text/css">
<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="profile-sidebar col-md-3">
				<div class="portlet light profile-sidebar-portlet">
					<div class="profile-usertitle">
						<div class="profile-usertitle-name">Marcus Doe</div>
					</div>
					<div class="profile-usermenu">
						<ul class="nav">
							<li class="active">
								<a href="#companies_tab" data-toggle="tab" aria-expanded="true">
									<i class="icon-badge"></i>
									Pages administées
								</a>
							</li>
							<li>
								<a href="#settings" data-toggle="tab" aria-expanded="false">
									<i class="icon-settings"></i>
									Paramètres
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="profile-content col-md-9">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet light">
							<div class="portlet-body">
								<div class="tab-content">
									<div class="tab-pane active" id="companies_tab">
										<div class="portlet light">
											<div class="portlet-title tabbable-line">
												<ul class="nav nav-tabs pull-left">
													<li class="active">
														<a href="#" data-toggle="tab" aria-expanded="true">
															Sociétés
														</a>
													</li>
												</ul>
												<div class="btn-group btn-group-solid pull-right">
													<a type="button" class="btn  green-haze " data-toggle="modal" href="#new_company_modal">Créer une Société</a>
													<a type="button" class="btn  blue-madison" data-toggle="modal" href="#new_job_modal">Créer un travail</a>&nbsp; &nbsp;
												</div>
											</div>
											<div class="portlet-body">
												<div class="tab-content">
													<div class="tab-pane active">
														<ul class="feeds">
															<li>
																<div class="col1">
																	<div class="cont">
																		<div class="cont-col1">
																			<div class="label label-sm label-success">
																				<i class="fa fa-bell-o"></i>
																			</div>
																		</div>
																		<div class="cont-col2">
																			<div class="desc">
																				You have 4 pending tasks.
																				<span class="label label-sm label-info">
																					Take action <i class="fa fa-share"></i>
																				</span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col2">
																	<div class="date">
																		Just now
																	</div>
																</div>
															</li>
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="tab-pane" id="settings">
										<div class="portlet light">
											<div class="portlet-title tabbable-line">
												<ul class="nav nav-tabs">
													<li class="active">
														<a href="#personal_data" data-toggle="tab" aria-expanded="true">Données personnelles</a>
													</li>
													<li>
														<a href="#passoword_tab" data-toggle="tab" aria-expanded="false">Mot de passe</a>
													</li>
												</ul>
											</div>
											<div class="portlet-body">
												<div class="tab-content">
													<div class="tab-pane active" id="personal_data" style="height:250px;">
														<form role="form" class="col-md-6">
															<div class="form-body">
																<div class="form-group">
																	<label>Nom complet</label>
																	<div class="input-group">
																		<span class="input-group-addon input-left">
																				<i class="fa fa-user"></i>
																				</span>
																		<input type="text" class="form-control" placeholder="Nom complet" name="displayname">
																	</div>
																</div>
																<div class="form-group">
																	<label>E-mail</label>
																	<div class="input-group">
																		<span class="input-group-addon">
																				<i class="fa fa-envelope"></i>
																				</span>
																		<input type="text" class="form-control" placeholder="Adresse Email" name="email">
																	</div>
																</div>

																<div class="form-group">
																	<label>Téléphone</label>
																	<div class="input-group">
																		<span class="input-group-addon input-left">
																				<i class="fa fa-phone"></i>
																				</span>
																		<input type="text" class="form-control" placeholder="Téléphone" name="mobile">
																	</div>
																</div>

															</div>
															<div class="form-actions">
																<button type="submit" class="btn blue pull-right">Enregistrer</button>
															</div>
														</form>
													</div>
													<div class="tab-pane" id="passoword_tab" style="height:250px;">
														<form role="form" class="col-md-6">
															<div class="form-body">
																<div class="form-group">
																	<label>Ancien mot de passe</label>
																	<div class="input-group">
																		<span class="input-group-addon input-left">
																				<i class="fa fa-user"></i>
																				</span>
																		<input type="text" class="form-control" placeholder="Ancien mot de passe" name="old_password">
																	</div>
																</div>
																<div class="form-group">
																	<label>Nouveau mot de passe</label>
																	<div class="input-group">
																		<span class="input-group-addon">
																				<i class="fa fa-envelope"></i>
																				</span>
																		<input type="text" class="form-control" placeholder="Nouveau mot de passe" name="new_password">
																	</div>
																</div>

																<div class="form-group">
																	<label>Confirmation du mot de passe</label>
																	<div class="input-group">
																		<span class="input-group-addon input-left">
																				<i class="fa fa-phone"></i>
																				</span>
																		<input type="text" class="form-control" placeholder="Confirmé le nouveau mot de passe" name="cconfirme_password">
																	</div>
																</div>

															</div>
															<div class="form-actions">
																<button type="submit" class="btn blue pull-right">Modifier</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="new_company_modal" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Modal Title</h4>
			</div>
			<form>
			<div class="modal-body">
			
				 <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">Nom</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Nom">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">Slogan</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Slogan">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputDesc3" class="col-sm-2 control-label">Déscription</label>
				    <div class="col-sm-10">
				    	<textarea class="form-control" rows="3" placeholder="Déscription"></textarea>
				    </div>
				    
				  </div>
				 
				  <div class="form-group">
				    <label for="exampleInputFile" class="col-sm-2 control-label">Logo</label>
				    <div class="col-sm-10">
				    <input type="file" id="InputFile">				    	
				    </div>
				    <p class="help-block">&nbsp;</p>
				    
				  </div>
				   <div class="form-group">
				    <label for="exampleInputFile" class="col-sm-2 control-label">Cover</label>
				    <div class="col-sm-10">
				    <input type="file" id="InputFile">				    	
				    </div>
				    <p class="help-block">&nbsp;</p>
				    
				  </div>
				</div>
			<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Fermer</button>
				<button type="button" class="btn blue">Ajouter</button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="new_job_modal" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Modal Title</h4>
			</div>
			<form>
			<div class="modal-body">
			
				 <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">Nom</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Nom">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputDesc3" class="col-sm-2 control-label">Adresse</label>
				    <div class="col-sm-10">
				    	<textarea class="form-control" rows="3" placeholder="Adresse"></textarea>
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">E-mail</label>
				    <div class="col-sm-10">
				      <input type="email" class="form-control" id="inputEmail3" placeholder="Slogan">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">Téléphone</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Téléphone">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputNom3" class="col-sm-2 control-label">Portable</label>
				    <div class="col-sm-10">
				      <input type="text" class="form-control" id="inputEmail3" placeholder="Portable">
				    </div>
				    
				  </div>
				  <div class="form-group">
				    <label for="inputDesc3" class="col-sm-2 control-label">Déscription</label>
				    <div class="col-sm-10">
				    	<textarea class="form-control" rows="3" placeholder="Déscription"></textarea>
				    </div>
				    
				  </div>
				 
				  <div class="form-group">
				    <label for="exampleInputFile" class="col-sm-2 control-label">image</label>
				    <div class="col-sm-10">
				    <input type="file" id="InputFile">				    	
				    </div>
				    <p class="help-block">&nbsp;</p>
				    
				  </div>
				   
				</div>
			<div class="modal-footer">
					<button type="button" class="btn default" data-dismiss="modal">Fermer</button>
				<button type="button" class="btn blue">Ajouter</button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/account/script_1.js" type="text/javascript"></script>
