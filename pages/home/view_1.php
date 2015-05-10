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
		<div class="row home-news" data-columns>

			<?php foreach ($rslt as $r) {?>
        	
        	<a href="<?php echo $r["url"];?>" class="item_a ajaxify">
	        	<div class="item portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<span class="caption-subject bold font-grey-gallery uppercase"><?php echo $r["title"];?></span>
							<span class="caption-helper"><?php echo $r["sub_title"];?></span>
						</div>
					</div>
					<div class="portlet-body">
						<p>
							<?php if($r["image_url"]){?><img class="image" src="<?php echo $r["image_url"];?>" alt="image"/><?php }?>
							<?php echo $r["content"];?>
						</p>
					</div>
				</div>
			</a>
            
            <?php } ?>

		</div>
	</div>
</div>

<!-- plugins -->
<script type="text/javascript" src="<?php echo cdn;?>/plugins/salvattore<?php if(!debug) echo ".min";?>.js"></script>

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/home/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php if(isset($logout) && $logout){?>
<script src="<?php echo url_root;?>/pages/login/logout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
<?php }?>
