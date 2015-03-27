<!-- custom page styles -->
<link href="<?php echo url_root;?>/pages/home/style_1.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-6">
				<form id="search_form" class="row">
					<div class="form-group input-group input-lg">
						<input type="text" class="form-control input-lg query" placeholder="What do you want ?">
						<span class="input-group-btn">
							<button class="btn input-lg btn-default" type="submit"><i class="icon-magnifier"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
		<div class="row home-news" data-columns>

			<?php for($i=0;$i<20;$i++){?>

				<div class="item portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="icon-puzzle font-grey-gallery"></i>
							<span class="caption-subject bold font-grey-gallery uppercase">
							Tools <?php echo $i;?> </span>
							<span class="caption-helper">more samples...</span>
						</div>
						<div class="tools">
							<a href="portlet_general2.html#portlet-config" data-toggle="modal" class="config"></a>
							<a href="javascript:;" class="fullscreen"></a>
							<a href="portlet_general2.html" class="remove"></a>
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

<script src="<?php echo cdn;?>/plugins/salvattore.min.js" type="text/javascript"></script>
<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/home/script_1.js" type="text/javascript"></script>
