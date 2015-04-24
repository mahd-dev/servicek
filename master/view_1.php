<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="<?php echo(rtl?"rtl":"ltr");?>">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>loop</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description" />
	<meta content="" name="author" />

	<script src="<?php echo cdn;?>/plugins/pace/pace.min.js"></script>
	<link href="<?php echo cdn;?>/plugins/pace/themes/pace-theme-minimal<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" />

	<link href="<?php echo cdn;?>/fonts/default/default.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/bootstrap/css/bootstrap<?php echo(rtl?"-rtl":"");?>.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/bootstrap-switch/css/bootstrap-switch<?php echo(rtl?"-rtl":"");?>.min.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo cdn;?>/css/components-rounded<?php echo(rtl?"-rtl":"");?>.css" id="style_components" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/plugins<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/layout<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/themes/default<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/custom<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />

	<link rel="shortcut icon" href="<?php echo cdn;?>/img/favicons/favicon.png" />

	<script>
		function page_script(sc){
			if(document.readyState == "complete") sc.init();
			else document.addEventListener('DOMContentLoaded', sc.init, false);
		}
	</script>

</head>

<body class="page-header-fixed">
	<div class="page-header navbar navbar-fixed-top">
		<div class="page-header-inner">
			<div class="page-logo">
				<a href="<?php echo url_root;?>" class="ajaxify">
					<img src="<?php echo cdn;?>/img/logo<?php echo(rtl?"-rtl":"");?>.svg" alt="loop" class="logo-default">
				</a>
			</div>

			<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"></a>

			<div class="page-top">
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<li class="login-btn btn"<?php if($user!=null) echo ' style="display:none;"';?>>
							<a href="<?php echo url_root;?>/login" class="ajaxify">
								<i class="icon-login"></i>
								<span>Se connecter</span>
							</a>
						</li>
						<li class="user-btn dropdown dropdown-user dropdown-dark"<?php if($user==null) echo ' style="display:none;"';?>>
							<a href="layout_blank_page.html#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
								<span class="username username-hide-on-mobile"><?php echo $user->displayname;?> </span>

							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="<?php echo url_root;?>/account" class="ajaxify">
										<i class="icon-user"></i> Mon compte </a>
								</li>
								<li>
									<a href="<?php echo url_root;?>/logout" class="ajaxify">
										<i class="icon-logout"></i> Se déconnecter </a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>

	</div>
	<div class="clearfix"></div>
	<div class="page-container">
		<div class="page-sidebar-wrapper">
			<!--
			<div class="page-sidebar">
				aaa
			</div>
			-->
			<div class="page-sidebar navbar-collapse collapse">
				<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<li class="start ">
						<a href="<?php echo url_root;?>" class="ajaxify">
							<i class="icon-home"></i>
							<span class="title">Home</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="page-content-wrapper">
			<div class="page-content">
				<?php echo $content; // inserting requested page content ?>
			</div>
		</div>
	</div>

	<div class="page-footer">
		<div class="page-footer-inner">
			2015 &copy; loop company.
		</div>
		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>

	<!--[if lt IE 9]>
	<script src="<?php echo cdn;?>/plugins/respond.min.js"></script>
	<script src="<?php echo cdn;?>/plugins/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo cdn;?>/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

	<script src="<?php echo cdn;?>/scripts/app.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/scripts/layout.js" type="text/javascript"></script>

	<script type="text/javascript" src="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
	
	<script src="<?php echo url_root;?>/master/script_1.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function () {
			app.init();
			Layout.init();
		});
	</script>
</body>
</html>
