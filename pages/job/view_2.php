<link rel="stylesheet" type="text/css" href="<?php echo cdn;?>/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css"/>
<link href="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo url_root;?>/pages/job/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="profile-sidebar col-md-3">
						<div class="portlet light profile-sidebar-portlet">
							<!--
							<div class="profile-userpic">
								<img src="../../assets/pages/media/profile/profile_user.jpg" class="img-responsive" alt="">
							</div>
							-->
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									 <a href="javascript:;" class="editable" data-name="name" data-type="text" ><?php echo $j->name;?></a>
								</div>
							</div>
						</div>
						<div class="portlet light">
							<h5>A propos :</h5>
							<a href="javascript:;" class="editable" data-name="description" data-type="textarea" ><?php echo $j->description;?></a>
						</div>
					</div>
					<div class="profile-content col-md-9">
						<div class="row">
							<div class="col-md-6">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Contact</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="tab-content">
											<div class="tab-pane active" id="tab_1_1">
												<p class="margin-bottom-30">
													<strong><h5>Adresse :</h5></strong>
													<a href="javascript:;" class="" data-name="address" data-type="textarea" ><?php echo $j->address;?></a>
												</p>
												<p class="margin-bottom-30">
													<strong><h5>Téléphone :</h5></strong>
													<a href="javascript:;" class="editable" data-name="tel" data-type="text" ><?php echo $j->tel;?></a>
												</p>
												<p class="margin-bottom-30">
													<strong><h5>Portable :</h5></strong>
													<a href="javascript:;" class="editable" data-name="mobile" data-type="text" ><?php echo $j->mobile;?></a>
												</p>
												<p class="margin-bottom-30">
													<strong><h5>Email :</h5></strong>
													<a href="javascript:;" class="editable" data-name="email" data-type="text" ><?php echo $j->email;?></a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="portlet light">
									<div class="portlet-title tabbable-line">
										<div class="caption caption-md">
											<i class="icon-globe theme-font hide"></i>
											<span class="caption-subject font-blue-madison bold uppercase">Map</span>
										</div>
									</div>
									<div class="portlet-body">
										<div class="tab-content aspectratio-container aspect-4-3 fit-width">
											<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
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

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/job/script_2<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

