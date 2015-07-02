<!-- custom page styles -->
<link href="<?php echo url_root;?>/pages/home/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row">

			<?php foreach ($rslt as $r) {?>

				<div class="col-sm-6 col-md-4">
	        <div class="property-box">
            <div class="property-box-image">
							<?php if($r["image_url"]){?>
								<div class="aspectratio-container aspect-4-3 fit-width">
									<div class="aspectratio-content image" style="background-image:url('<?php echo $r["image_url"];?>');"></div>
								</div>
							<?php }?>
							<?php if(!$r["image_url"]){?>
								<div class="aspectratio-container aspect-4-3 fit-width">
									<div class="aspectratio-content"></div>
								</div>
							<?php }?>
            </div>
            <div class="property-box-content">
								<h1><?php echo $r["title"];?></h1>
								<p><?php echo $r["content"];?></p>
            </div>
            <div class="property-box-bottom">
							<a href="<?php echo $r["url"];?>" class="ajaxify">Afficher plus</a>
            </div>
	        </div>
		    </div>

      <?php } ?>

		</div>
	</div>
</div>

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/home/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php if(isset($logout) && $logout){?>
<script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php }?>
