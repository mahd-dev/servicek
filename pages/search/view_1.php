<link href="<?php echo url_root;?>/pages/search/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

<div class="row">
	<div class="col-md-12">
        <div class="row">
			<div class="col-md-8">
				<form id="search_form" class="row">
					<div class="form-group input-group input-lg">
						<input type="text" class="query form-control input-lg" placeholder="Qu'est-ce que vous voulez?" value="<?php echo $_GET["q"];?>" required/>
						<!--<ul class="autocomplete form-control input-lg" placeholder="Qu'est-ce que vous voulez?"></ul>-->
						<span class="input-group-btn">
							<button class="btn input-lg btn-default" type="submit"><i class="icon-magnifier"></i></button>
						</span>
					</div>
				</form>
			</div>
		</div>
        <div class="row">
            <div class="col-md-12">
            	<?php if(count($rslt)>0){?>

	            <div class="row home-news" data-columns>
	            
	            <?php foreach ($rslt as $r) {?>
            	
            	<a href="<?php echo $r["url"];?>" class="ajaxify">
		        	<div class="item portlet light bordered">
						<div class="portlet-title">
							<div class="caption">
								<?php if($r["type"]=="company"){?><i class="icon-flag font-grey-gallery"></i><?php }?>
								<span class="caption-subject bold font-grey-gallery uppercase"><?php echo $r["title"];?></span>
								<span class="caption-helper"><?php echo $r["sub_title"];?></span>
							</div>
						</div>
						<div class="portlet-body">
							<?php echo $r["content"];?>
						</div>
					</div>
				</a>
	            
	            <?php } ?>
	            
	            </div>

		        <?php }else{ ?>

		        <div class="note note-warning">

					<h4 class="block"><i class="icon-ban" style="font-size:150%;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Aucun résultat trouvé pour votre requête</h4>
				</div>

		        <?php } ?>

            </div>
        </div>
	</div>
</div>

<!-- plugins -->
<script type="text/javascript" src="<?php echo cdn;?>/plugins/salvattore<?php if(!debug) echo ".min";?>.js"></script>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/search/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
