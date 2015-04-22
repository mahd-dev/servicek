<!-- custom page styles
<link href="<?php echo url_root;?>/pages/login/style.css" rel="stylesheet" type="text/css">
-->

<link href="<?php echo url_root;?>/pages/login/style.css" rel="stylesheet" type="text/css">
<div class="page-head margin-bottom-20">
	<div class="page-title">
		<h1>Login <small>Login to your account</small></h1>
	</div>
</div>
<div class="row-fluid">
	<div class="col-md-offset-3 col-md-12">
		<form class="form">
			<div class="form-group">
				<label for="username" class="control-label">Username</label>
				<input type="email" class="form-control" id="username" name="username" placeholder="Enter your username">
			</div>
			<div class="form-group">
				<label for="password" class="control-label">Password</label>
				<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
			</div>
			<div class="form-group">
				<div class="checkbox"><label><input type="checkbox"> Remember me</label></div>
			</div>
			<div class="form-group">
				<button type="submit" class="btn purple pull-right">Log in</button>
			</div>
		</form>
	</div>
</div>

<!-- custom page script -->
<script src="<?php echo url_root;?>/pages/login/script_1.js" type="text/javascript"></script>
