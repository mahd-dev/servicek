<link href="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo url_root;?>/pages/job/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="profile-sidebar col-md-3">
						<div class="portlet light profile-sidebar-portlet">
							
							<div class="col-sm-offset-3 col-sm-6 col-md-offset-0 col-md-12">
								<img class="public_image" src="<?php $image=$job->image; if($image) echo $paths->job_image->url.$image; else {?>http://www.placehold.it/400x300/EFEFEF/AAAAAA&amp;text=Sélectionner+une+image<?php }?>" alt="image"/>
							</div>
							
							<div class="profile-usertitle">
								<div class="profile-usertitle-name">
									 <?php echo $job->name;?>
								</div>
								
							</div>
						</div>
						<div class="portlet light">
							<h5>A propos :</h5>
							<?php echo $job->description;?>
						</div>
					</div>
					<div class="col-md-9">
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
<script src="<?php echo url_root;?>/pages/company/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

