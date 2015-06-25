<!-- custom page styles -->
<link href="<?php echo url_root;?>/pages/home/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row margin-bottom-20">
			<div class="col-md-8">
				<form id="search_form" class="row">
					<div class="form-group input-group input-lg">
						<input type="text" class="query form-control input-lg" placeholder="Qu'est-ce que vous voulez?" required/>
						<!--<ul class="autocomplete form-control input-lg" placeholder="Qu'est-ce que vous voulez?"></ul>-->
						<span class="input-group-btn">
							<button class="btn input-lg btn-default" type="submit"><i class="icon-magnifier"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
		<div class="row">

			<?php foreach ($rslt as $r) {?>
        	
	        	<a href="<?php echo $r["url"];?>" class="item col-xs-12 col-sm-6 col-md-4 col-lg-3 ajaxify">
		        	<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<span class="caption-subject bold font-grey-gallery uppercase"><?php echo $r["title"];?></span>
								<span class="caption-helper"><?php echo $r["sub_title"];?></span>
							</div>
						</div>
						<div class="portlet-body">
							<?php if($r["image_url"]){?>
								<div class="aspectratio-container aspect-4-3 fit-width">
									<div class="aspectratio-content image" style="background-image:url('<?php echo $r["image_url"];?>');"></div>
								</div>
							<?php }?>
							<p><?php echo $r["content"];?></p>
							<?php if(!$r["image_url"]){?>
								<div class="aspectratio-container aspect-4-3 fit-width">
									<div class="aspectratio-content"></div>
								</div>
							<?php }?>
						</div>
					</div>
				</a>
            
            <?php } ?>

		</div>
	</div>
</div>

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/home/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php if(isset($logout) && $logout){?>
<script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php }?>
