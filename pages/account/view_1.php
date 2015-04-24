<link href="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo cdn;?>/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo cdn;?>/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo url_root;?>/pages/account/style.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
<div class="page-content-wrapper">
		<div>
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN PAGE HEADER-->
			<!-- BEGIN PAGE HEAD -->
			<div class="page-head">
				<!-- BEGIN PAGE TITLE -->
				<div class="page-title">
					<h1>New User Profile <small>user profile page sample</small></h1>
				</div>
				<!-- END PAGE TITLE -->
				<!-- BEGIN PAGE TOOLBAR -->
				<div class="page-toolbar">
					<!-- BEGIN THEME PANEL -->
					<div class="btn-group btn-theme-panel">
						<a href="javascript:;" class="btn dropdown-toggle" data-toggle="dropdown">
						<i class="icon-settings"></i>
						</a>
						<div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<h3>THEME</h3>
									<ul class="theme-colors">
										<li class="theme-color theme-color-default active" data-theme="default">
											<span class="theme-color-view"></span>
											<span class="theme-color-name">Dark Header</span>
										</li>
										<li class="theme-color theme-color-light" data-theme="light">
											<span class="theme-color-view"></span>
											<span class="theme-color-name">Light Header</span>
										</li>
									</ul>
								</div>
								<div class="col-md-8 col-sm-8 col-xs-12 seperator">
									<h3>LAYOUT</h3>
									<ul class="theme-settings">
										<li>
											 Theme Style
											<select class="layout-style-option form-control input-small input-sm">
												<option value="square" selected="selected">Square corners</option>
												<option value="rounded">Rounded corners</option>
											</select>
										</li>
										<li>
											 Layout
											<select class="layout-option form-control input-small input-sm">
												<option value="fluid" selected="selected">Fluid</option>
												<option value="boxed">Boxed</option>
											</select>
										</li>
										<li>
											 Header
											<select class="page-header-option form-control input-small input-sm">
												<option value="fixed" selected="selected">Fixed</option>
												<option value="default">Default</option>
											</select>
										</li>
										<li>
											 Top Dropdowns
											<select class="page-header-top-dropdown-style-option form-control input-small input-sm">
												<option value="light">Light</option>
												<option value="dark" selected="selected">Dark</option>
											</select>
										</li>
										<li>
											 Sidebar Mode
											<select class="sidebar-option form-control input-small input-sm">
												<option value="fixed">Fixed</option>
												<option value="default" selected="selected">Default</option>
											</select>
										</li>
										<li>
											 Sidebar Menu
											<select class="sidebar-menu-option form-control input-small input-sm">
												<option value="accordion" selected="selected">Accordion</option>
												<option value="hover">Hover</option>
											</select>
										</li>
										<li>
											 Sidebar Position
											<select class="sidebar-pos-option form-control input-small input-sm">
												<option value="left" selected="selected">Left</option>
												<option value="right">Right</option>
											</select>
										</li>
										<li>
											 Footer
											<select class="page-footer-option form-control input-small input-sm">
												<option value="fixed">Fixed</option>
												<option value="default" selected="selected">Default</option>
											</select>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- END THEME PANEL -->
				</div>
				<!-- END PAGE TOOLBAR -->
			</div>
			<!-- END PAGE HEAD -->
			<!-- BEGIN PAGE BREADCRUMB -->
			<ul class="page-breadcrumb breadcrumb">
				<li>
					<a href="index.html">Home</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="extra_profile.html#">Pages</a>
					<i class="fa fa-circle"></i>
				</li>
				<li>
					<a href="extra_profile.html#">New User Profile</a>
				</li>
			</ul>
			<!-- END PAGE BREADCRUMB -->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PROFILE SIDEBAR -->
					<div class="profile-sidebar" style="width: 250px;">
						<!-- PORTLET MAIN -->
						<div class="portlet light profile-sidebar-portlet">
							<!-- SIDEBAR USERPIC -->
							<div class="profile-userpic">
								<img src="../../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
							</div>
							<!-- END SIDEBAR USERPIC -->
							<!-- SIDEBAR USER TITLE -->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									 Marcus Doe
								</div>
								<div class="profile-usertitle-job">
									 Developer
								</div>
							</div>
							<!-- END SIDEBAR USER TITLE -->
							<!-- SIDEBAR BUTTONS -->
							<div class="profile-userbuttons">
								<button type="button" class="btn btn-circle green-haze btn-sm">Follow</button>
								<button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
							</div>
							<!-- END SIDEBAR BUTTONS -->
							<!-- SIDEBAR MENU -->
							<div class="profile-usermenu">
								<ul class="nav">
									<li class="active">
										<a href="#tab_1_1" data-toggle="tab" aria-expanded="true">
										<i class="icon-home"></i>
										Overview </a>
									</li>
									<li>
										<a  href="#tab_1_2" data-toggle="tab" aria-expanded="false">
										<i class="icon-settings"></i>
										Account Settings </a>
									</li>
									
								</ul>
							</div>
							<!-- END MENU -->
						</div>
						<!-- END PORTLET MAIN -->
						<!-- PORTLET MAIN -->
						
					</div>
					<!-- END BEGIN PROFILE SIDEBAR -->
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row">
						
							<div class="col-md-12">
								<!-- BEGIN PORTLET -->
								<div class="portlet light">
						
									<div class="portlet-body">
										<!--BEGIN TABS-->
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1_1">
												<div class="portlet light">
														<div class="portlet-title tabbable-line">
														
															<ul class="nav nav-tabs">
																
																<li class="active">
																	<a href="extra_profile.html#tab_1_1_1" data-toggle="tab" aria-expanded="true">
																	Sociétés </a>
																</li>
															
															</ul>
															<div class="btn-group btn-group-solid pull-right">
																<a type="button" class="btn  green-haze "  data-toggle="modal" href="#company">Créer une Société</a>
																<a type="button" class="btn  blue-madison" data-toggle="modal" href="#job">Créer une travail</a>&nbsp; &nbsp;
															</div>
														</div>
														<div class="portlet-body">
													<!--BEGIN TABS-->
															<div class="tab-content">
																<div class="tab-pane active" id="tab_1_1_1">
																	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 320px;"><div class="scroller" style="height: 320px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
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
																								 You have 4 pending tasks. <span class="label label-sm label-info">
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
																	<div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 159.750390015601px; background: rgb(215, 220, 226);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
																</div>
																
															</div>
													<!--END TABS-->
														</div>
											</div>
										</div>
											<div class="tab-pane" id="tab_1_2">
												<div class="portlet light">
														<div class="portlet-title tabbable-line">
														
															<ul class="nav nav-tabs">
																
																<li class="active">
																	<a href="extra_profile.html#tab_2_3" data-toggle="tab" aria-expanded="true">
																	Données personnelles </a>
																</li>
																<li >
																	<a href="extra_profile.html#tab_2_4" data-toggle="tab" aria-expanded="false">
																	Mot de passe </a>
																</li>
															</ul>
														</div>
														<div class="portlet-body">
													<!--BEGIN TABS-->
															<div class="tab-content">
																<div class="tab-pane active" id="tab_2_3">
																	<div  style="position: relative; overflow: hidden; width: auto; height: 320px;"><div style="height: 320px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
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
																					<label>Adresse Email</label>
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
																				<button type="submit" class="btn blue">Submit</button>
																				<button type="button" class="btn default">Cancel</button>
																			</div>
																		</form>
																	</div>
																	<div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 159.750390015601px; background: rgb(215, 220, 226);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
																</div>
																<div class="tab-pane" id="tab_2_4">
																	<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 320px;"><div class="scroller" style="height: 320px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
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
																					<label>Confirmé le nouveau mot de passe</label>
																					<div class="input-group">
																						<span class="input-group-addon input-left">
																						<i class="fa fa-phone"></i>
																						</span>
																						<input type="text" class="form-control" placeholder="Confirmé le nouveau mot de passe" name="cconfirme_password">
																					</div>
																				</div>
																				
																			</div>
																			<div class="form-actions">
																				<button type="submit" class="btn blue">Submit</button>
																				<button type="button" class="btn default">Cancel</button>
																			</div>
																		</form>
																	</div>
																	<div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 159.750390015601px; background: rgb(215, 220, 226);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
																</div>
																
															</div>
													<!--END TABS-->
														</div>
											</div>
											</div>
										</div>
										<!--END TABS-->
									</div>
								</div>
								<!-- END PORTLET -->
							</div>
						</div>
					
					</div>
					<!-- END PROFILE CONTENT -->
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	</div>
</div>
<div class="modal fade" id="company" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Modal Title</h4>
			</div>
			<div class="modal-body">
				 Modal body goes here
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="button" class="btn blue">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>

<div class="modal fade" id="job" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Modal Title</h4>
			</div>
			<div class="modal-body">
				 Modal body goes here
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="button" class="btn blue">Save changes</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/account/script_1.js" type="text/javascript"></script>
