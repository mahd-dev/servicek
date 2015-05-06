<link href="<?php echo url_root;?>/pages/search/style<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

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
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/search/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
