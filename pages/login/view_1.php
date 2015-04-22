<!-- custom page styles
<link href="<?php echo url_root;?>/pages/login/style.css" rel="stylesheet" type="text/css">
-->
<div class="row">
	<div class="col-md-8 col-md-ofset-2">
		<form class="form-horizontal" role="form">
            <div class="form-group">
                <label for="inputEmail1" class="col-md-2 control-label">Username</label>
                <div class="col-md-4">
                    <input type="email" class="form-control" id="inputUsername" placeholder="Username">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword12" class="col-md-2 control-label">Password</label>
                <div class="col-md-4">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-4">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox"> Remember me </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-offset-2 col-md-10">
                    <button type="submit" class="btn blue">Sign in</button>
                </div>
            </div>
        </form>
	</div>
</div>

<!-- custom page scripts -->
<script src="<?php echo url_root;?>/pages/login/script_1.js" type="text/javascript"></script>
