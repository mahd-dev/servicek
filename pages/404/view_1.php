<link href="<?php echo url_root;?>/pages/404/style<?php echo (rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
<div class="row">
	<div class="col-md-12 page-404">
		<div class="number">404</div>
		<div class="details">
			<h3>Oops! You're lost.</h3>
			<p>
				We can not find the page you're looking for.<br/>
				<a href="<?php echo url_root;?>" class="ajaxify">
				Return home </a>
				or try the search bar below.
			</p>
			<form id="search_form">
				<div class="input-group input-medium">
					<input type="text" class="form-control query" placeholder="keyword...">
					<span class="input-group-btn">
					<button type="submit" class="btn btn-default"><i class="icon-magnifier"></i></button>
					</span>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo url_root;?>/pages/404/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
