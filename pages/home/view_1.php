<!-- custom page styles -->
<link href="<?php echo url_root;?>/pages/home/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="aspectratio-container fit-width map" data-displayin=".main">
	<div id="map_canvas" class="aspectratio-content"></div>
</div>

<?php foreach ($rslt as  $item) { $c = $item["category"]; ?>
	<div class="property-carousel-wrapper box">
		<h3><i class="category-icon <?php echo $c->icon; ?>"></i> <?php echo $c->name; ?></h3>
		<hr>
	  <div class="property-carousel">
				<?php foreach ($item["childrens"] as $r) { ?>
					<div class="property-carousel-item">
						<a href="<?php echo $r["url"];?>" class="ajaxify item">
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
										<h3><?php echo $r["title"];?></h3>
										<p><?php echo $r["content"];?></p>
		            </div>
			        </div>
						</a>
	      	</div>
				<?php } ?>
	  </div>
	</div>
<?php } ?>

<input type="hidden" name="map_elements" value='<?php echo htmlspecialchars(json_encode($map), ENT_QUOTES, 'UTF-8'); ?>'/>

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/home/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php if(isset($logout) && $logout){?>
<script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php }?>
