<!-- custom page styles -->
<link href="<?php echo cdn;?>/pages/css/error<?php echo (rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css"/>

<!-- BEGIN PAGE CONTENT-->
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
				<!-- /input-group -->
			</form>
		</div>
	</div>
</div>
<!-- END PAGE CONTENT-->

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/404/script_1.js" type="text/javascript"></script>
