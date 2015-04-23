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
								<div class="portlet light ">
									<div class="portlet-title">
										<div class="caption caption-md">
											<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Your Activity</span>
											<span class="caption-helper hide">weekly stats...</span>
										</div>
										<div class="actions">
											<div class="btn-group btn-group-devided" data-toggle="buttons">
												<label class="btn btn-transparent grey-salsa btn-circle btn-sm active">
												<input type="radio" name="options" class="toggle" id="option1">Today</label>
												<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
												<input type="radio" name="options" class="toggle" id="option2">Week</label>
												<label class="btn btn-transparent grey-salsa btn-circle btn-sm">
												<input type="radio" name="options" class="toggle" id="option2">Month</label>
											</div>
										</div>
									</div>
									<div class="portlet-body">
										<div class="row number-stats margin-bottom-30">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="stat-left">
													<div class="stat-chart">
														<!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
														<div id="sparkline_bar">
														</div>
													</div>
													<div class="stat-number">
														<div class="title">
															 Total
														</div>
														<div class="number">
															 246
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="stat-right">
													<div class="stat-chart">
														<!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
														<div id="sparkline_bar2">
														</div>
													</div>
													<div class="stat-number">
														<div class="title">
															 New
														</div>
														<div class="number">
															 719
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="table-scrollable table-scrollable-borderless">
											<table class="table table-hover table-light">
											<thead>
											<tr class="uppercase">
												<th colspan="2">
													 MEMBER
												</th>
												<th>
													 Earnings
												</th>
												<th>
													 CASES
												</th>
												<th>
													 CLOSED
												</th>
												<th>
													 RATE
												</th>
											</tr>
											</thead>
											<tbody><tr>
												<td class="fit">
													<img class="user-pic" src="../../assets/img/avatar4.jpg">
												</td>
												<td>
													<a href="extra_profile.html#" class="primary-link">Brain</a>
												</td>
												<td>
													 $345
												</td>
												<td>
													 45
												</td>
												<td>
													 124
												</td>
												<td>
													<span class="bold theme-font">80%</span>
												</td>
											</tr>
											<tr>
												<td class="fit">
													<img class="user-pic" src="../../assets/img/avatar5.jpg">
												</td>
												<td>
													<a href="extra_profile.html#" class="primary-link">Nick</a>
												</td>
												<td>
													 $560
												</td>
												<td>
													 12
												</td>
												<td>
													 24
												</td>
												<td>
													<span class="bold theme-font">67%</span>
												</td>
											</tr>
											<tr>
												<td class="fit">
													<img class="user-pic" src="../../assets/img/avatar6.jpg">
												</td>
												<td>
													<a href="extra_profile.html#" class="primary-link">Tim</a>
												</td>
												<td>
													 $1,345
												</td>
												<td>
													 450
												</td>
												<td>
													 46
												</td>
												<td>
													<span class="bold theme-font">98%</span>
												</td>
											</tr>
											<tr>
												<td class="fit">
													<img class="user-pic" src="../../assets/img/avatar7.jpg">
												</td>
												<td>
													<a href="extra_profile.html#" class="primary-link">Tom</a>
												</td>
												<td>
													 $645
												</td>
												<td>
													 50
												</td>
												<td>
													 89
												</td>
												<td>
													<span class="bold theme-font">58%</span>
												</td>
											</tr>
											</tbody></table>
										</div>
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
						<div class="row">
							<div class="col-md-6">
								<!-- BEGIN PORTLET -->
								<div class="portlet light">
									<div class="portlet-title">
										<div class="caption caption-md">
											<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Customer Support</span>
											<span class="caption-helper">45 pending</span>
										</div>
										<div class="inputs">
											<div class="portlet-input input-inline input-small ">
												<div class="input-icon right">
													<i class="icon-magnifier"></i>
													<input type="text" class="form-control form-control-solid" placeholder="search...">
												</div>
											</div>
										</div>
									</div>
									<div class="portlet-body">
										<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 305px;"><div class="scroller" style="height: 305px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
											<div class="general-item-list">
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<img class="item-pic" src="../../assets/img/avatar4.jpg">
															<a href="extra_profile.html" class="item-name primary-link">Nick Larson</a>
															<span class="item-label">3 hrs ago</span>
														</div>
														<span class="item-status"><span class="badge badge-empty badge-success"></span> Open</span>
													</div>
													<div class="item-body">
														 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<img class="item-pic" src="../../assets/img/avatar3.jpg">
															<a href="extra_profile.html" class="item-name primary-link">Mark</a>
															<span class="item-label">5 hrs ago</span>
														</div>
														<span class="item-status"><span class="badge badge-empty badge-warning"></span> Pending</span>
													</div>
													<div class="item-body">
														 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat tincidunt ut laoreet.
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<img class="item-pic" src="../../assets/img/avatar6.jpg">
															<a href="extra_profile.html" class="item-name primary-link">Nick Larson</a>
															<span class="item-label">8 hrs ago</span>
														</div>
														<span class="item-status"><span class="badge badge-empty badge-primary"></span> Closed</span>
													</div>
													<div class="item-body">
														 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<img class="item-pic" src="../../assets/img/avatar7.jpg">
															<a href="extra_profile.html" class="item-name primary-link">Nick Larson</a>
															<span class="item-label">12 hrs ago</span>
														</div>
														<span class="item-status"><span class="badge badge-empty badge-danger"></span> Pending</span>
													</div>
													<div class="item-body">
														 Consectetuer adipiscing elit Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<img class="item-pic" src="../../assets/img/avatar9.jpg">
															<a href="extra_profile.html" class="item-name primary-link">Richard Stone</a>
															<span class="item-label">2 days ago</span>
														</div>
														<span class="item-status"><span class="badge badge-empty badge-danger"></span> Open</span>
													</div>
													<div class="item-body">
														 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, ut laoreet dolore magna aliquam erat volutpat.
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<img class="item-pic" src="../../assets/img/avatar8.jpg">
															<a href="extra_profile.html" class="item-name primary-link">Dan</a>
															<span class="item-label">3 days ago</span>
														</div>
														<span class="item-status"><span class="badge badge-empty badge-warning"></span> Pending</span>
													</div>
													<div class="item-body">
														 Lorem ipsum dolor sit amet, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
													</div>
												</div>
												<div class="item">
													<div class="item-head">
														<div class="item-details">
															<img class="item-pic" src="../../assets/img/avatar2.jpg">
															<a href="extra_profile.html" class="item-name primary-link">Larry</a>
															<span class="item-label">4 hrs ago</span>
														</div>
														<span class="item-status"><span class="badge badge-empty badge-success"></span> Open</span>
													</div>
													<div class="item-body">
														 Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
													</div>
												</div>
											</div>
										</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 135.604956268222px; background: rgb(215, 220, 226);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
									</div>
								</div>
								<!-- END PORTLET -->
							</div>
							<div class="col-md-6">
								<!-- BEGIN PORTLET -->
								<div class="portlet light tasks-widget">
									<div class="portlet-title">
										<div class="caption caption-md">
											<i class="icon-bar-chart theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Tasks</span>
											<span class="caption-helper">16 pending</span>
										</div>
										<div class="inputs">
											<div class="portlet-input input-small input-inline">
												<div class="input-icon right">
													<i class="icon-magnifier"></i>
													<input type="text" class="form-control form-control-solid" placeholder="search...">
												</div>
											</div>
										</div>
									</div>
									<div class="portlet-body">
										<div class="task-content">
											<div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 282px;"><div class="scroller" style="height: 282px; overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="0" data-handle-color="#D7DCE2" data-initialized="1">
												<!-- START TASK LIST -->
												<ul class="task-list">
													<li>
														<div class="task-checkbox">
															<input type="hidden" value="1" name="test">
															<div class="checker"><span><input type="checkbox" class="liChild" value="2" name="test"></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															Present 2013 Year IPO Statistics at Board Meeting </span>
															<span class="label label-sm label-success">Company</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															Hold An Interview for Marketing Manager Position </span>
															<span class="label label-sm label-danger">Marketing</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															AirAsia Intranet System Project Internal Meeting </span>
															<span class="label label-sm label-success">AirAsia</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															Technical Management Meeting </span>
															<span class="label label-sm label-warning">Company</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															Kick-off Company CRM Mobile App Development </span>
															<span class="label label-sm label-info">Internal Products</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															Prepare Commercial Offer For SmartVision Website Rewamp </span>
															<span class="label label-sm label-danger">SmartVision</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															Sign-Off The Comercial Agreement With AutoSmart </span>
															<span class="label label-sm label-default">AutoSmart</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li>
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															Company Staff Meeting </span>
															<span class="label label-sm label-success">Cruise</span>
															<span class="task-bell">
															<i class="fa fa-bell-o"></i>
															</span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
													<li class="last-line">
														<div class="task-checkbox">
															<div class="checker"><span><input type="checkbox" class="liChild" value=""></span></div>
														</div>
														<div class="task-title">
															<span class="task-title-sp">
															KeenThemes Investment Discussion </span>
															<span class="label label-sm label-warning">KeenThemes </span>
														</div>
														<div class="task-config">
															<div class="task-config-btn btn-group">
																<a class="btn btn-xs default" href="extra_profile.html#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
																<i class="fa fa-cog"></i><i class="fa fa-angle-down"></i>
																</a>
																<ul class="dropdown-menu pull-right">
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-check"></i> Complete </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-pencil"></i> Edit </a>
																	</li>
																	<li>
																		<a href="extra_profile.html#">
																		<i class="fa fa-trash-o"></i> Cancel </a>
																	</li>
																</ul>
															</div>
														</div>
													</li>
												</ul>
												<!-- END START TASK LIST -->
											</div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 216.097826086957px; background: rgb(215, 220, 226);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
										</div>
										<div class="task-footer">
											<div class="btn-arrow-link pull-right">
												<a href="extra_profile.html#">See All Tasks</a>
											</div>
										</div>
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

