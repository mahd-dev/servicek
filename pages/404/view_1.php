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
				<a href="index.html">
				Return home </a>
				or try the search bar below.
			</p>
			<form action="extra_404_option1.html#">
				<div class="input-group input-medium">
					<input type="text" class="form-control" placeholder="keyword...">
					<span class="input-group-btn">
					<button type="submit" class="btn blue"><i class="fa fa-search"></i></button>
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
