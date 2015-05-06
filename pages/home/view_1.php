<!-- custom page styles -->
<link href="<?php echo url_root;?>/pages/home/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-8">
				<form id="search_form" class="row">
					<div class="form-group input-group input-lg">
						<ul class="autocomplete form-control input-lg" placeholder="Qu'est-ce que vous voulez?"></ul>
						<span class="input-group-btn">
							<button class="btn input-lg btn-default" type="submit"><i class="icon-magnifier"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
		<div class="row home-news" data-columns>

			<?php for($i=0;$i<20;$i++){?>

				<div class="item portlet light bordered">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-puzzle font-grey-gallery"></i>
							<span class="caption-subject bold font-grey-gallery uppercase">
							Tools <?php echo $i;?> </span>
							<span class="caption-helper">more samples...</span>
						</div>
					</div>
					<div class="portlet-body">
						<h4>Heading text goes here...</h4>
						<p>
							 <?php
								$max = rand(20,70);
								for($j=0;$j<$max;$j++){
									echo "text ";
								}
							 ?>
						</p>
					</div>
				</div>

			<?php }?>

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
