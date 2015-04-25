<link href="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo cdn;?>/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo cdn;?>/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo url_root;?>/pages/company/style.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
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
								<button type="button" class="btn btn-circle btn-danger btn-sm">Message</button>
							</div>
							
						</div>
						<!-- END PORTLET MAIN -->
						<!-- PORTLET MAIN -->
						<div class="portlet light">
							<!-- STAT -->
							<div class="row list-separated profile-stat">
								<div class="col-xs-6">
									<div class="uppercase profile-stat-title">
										 37
									</div>
									<div class="uppercase profile-stat-text">
										 Projects
									</div>
								</div>
								<div class="col-xs-6">
									<div class="uppercase profile-stat-title">
										 51
									</div>
									<div class="uppercase profile-stat-text">
										 Tasks
									</div>
								</div>
								
							</div>
							<!-- END STAT -->
							
						</div>
						<!-- END PORTLET MAIN -->
					</div>
					<!-- END BEGIN PROFILE SIDEBAR -->
					<!-- BEGIN PROFILE CONTENT -->
					<div class="profile-content">
						<div class="row">
							<div class="col-md-6">
								<!-- BEGIN PORTLET -->
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">job name</span>
										</div>
									
									</div>
									<div class="portlet-body">
										<!--BEGIN TABS-->
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1_1">
												<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 320px;"><div class="scroller" style="height: 320px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
													
													<div>
														<strong><h4>Adresse:</h4></strong>
														Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eu tellus sem. Morbi in mattis dui. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. 
													</div>
													<div>
														<strong><h4>Téléphone:</h4></strong>
														+216 xx xxx xxx 
													</div>
													<div>
														<strong><h4>Portable:</h4></strong>
														+216 xx xxx xxx
													</div>
													<div>
														<strong><h4>Email:</h4></strong>
														Exemple@exemple.com
													</div>
												</div></div>
											</div>
									
										</div>
										<!--END TABS-->
									</div>
								</div>
								<!-- END PORTLET -->
							</div>
							<div class="col-md-6">
								<!-- BEGIN PORTLET -->
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Map</span>
										</div>
										
									</div>
									<div class="portlet-body">
										<!--BEGIN TABS-->
										<div class="tab-content">
											 <div id="map-canvas"></div>
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
	</div>
</div>

<!-- custom page script -->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="<?php echo url_root;?>/pages/company/script_1.js" type="text/javascript"></script>

