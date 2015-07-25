<link href="<?php echo url_root;?>/pages/job/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="profile-sidebar col-md-3">

				<?php $image=$job->image; if($image){?>
					<img class="public_image" src="<?php echo $paths->job_image->url.$image;?>" alt="image"/>
				<?php }?>

				<div class="portlet light profile-sidebar-portlet box">

					<div class="profile-usertitle">
						<div class="profile-usertitle-name">
							 <?php echo $job->name;?>
						</div>
						<div class="fb-like" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
					</div>
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

				<div class="tab-content aspectratio-container aspect-4-3 fit-width">
					<div class="map-canvas aspectratio-content" data-longitude="<?php echo $geolocation->longitude;?>" data-latitude="<?php echo $geolocation->latitude;?>"></div>
				</div>

			</div>
			<div class="col-md-9">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3><?php echo $job->description;?></h3>
					</div>
					<?php $skills = $job->skills; if(count($skills)) { ?>
					<div class="panel-body skills">
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
				<?php foreach ($job->cv as $cv) { $items = $cv->items; ?>
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
		</div>
	</div>
</div>


<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/company/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
