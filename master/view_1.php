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
	<!-- pace -->
	<script data-pace-options='{ "ajax": true }' src="<?php echo cdn;?>/plugins/pace/pace.min.js"></script>
	<link href="<?php echo cdn;?>/plugins/pace/themes/pace-theme-minimal<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" />

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<link href="<?php echo cdn;?>/fonts/default/default.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/bootstrap/css/bootstrap<?php echo(rtl?"-rtl":"");?>.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/bootstrap-switch/css/bootstrap-switch<?php echo(rtl?"-rtl":"");?>.min.css" rel="stylesheet" type="text/css" />
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN THEME STYLES -->
	<link href="<?php echo cdn;?>/css/components-rounded<?php echo(rtl?"-rtl":"");?>.css" id="style_components" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/plugins<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/layout<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/themes/default<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/custom<?php echo(rtl?"-rtl":"");?>.css" rel="stylesheet" type="text/css" />
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="<?php echo cdn;?>/img/favicons/favicon.png" />

	<!-- CONTENT PAGES INIT SCRIPTS -->
	<script>
		function page_script(sc){
			if(document.readyState == "complete") sc.init();
			else document.addEventListener('DOMContentLoaded', sc.init, false);
		}
	</script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed">
	<!-- BEGIN HEADER -->
	<div class="page-header navbar navbar-fixed-top">
		<!-- BEGIN HEADER INNER -->
		<div class="page-header-inner">
			<!-- BEGIN LOGO -->
			<div class="page-logo">
				<a href="<?php echo url_root;?>" class="ajaxify">
					<img src="<?php echo cdn;?>/img/logo<?php echo(rtl?"-rtl":"");?>.svg" alt="loop" class="logo-default">
				</a>
			</div>
			<!-- END LOGO -->
			<!-- BEGIN RESPONSIVE MENU TOGGLER -->
			<a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
			</a>
			<!-- END RESPONSIVE MENU TOGGLER -->

			<!-- BEGIN PAGE TOP -->
			<div class="page-top">
				<!-- BEGIN TOP NAVIGATION MENU -->
				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">
						<li class="btn">
							<a href="<?php echo url_root;?>/login" class="ajaxify">
								<i class="icon-login"></i>
								<span>Login</span>
							</a>
						</li>
						<!-- BEGIN USER LOGIN DROPDOWN -->
						<li class="dropdown dropdown-user dropdown-dark">
							<a href="layout_blank_page.html#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
								<span class="username username-hide-on-mobile">Nick </span>
								<!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
								<img alt="" class="img-circle" src="<?php echo cdn;?>/img/avatar9.jpg" />
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="<?php echo url_root;?>/account" class="ajaxify">
										<i class="icon-user"></i> My account </a>
								</li>
								<li>
									<a href="<?php echo url_root;?>/logout" class="ajaxify">
										<i class="icon-logout"></i> Logout </a>
								</li>
							</ul>
						</li>
						<!-- END USER LOGIN DROPDOWN -->
					</ul>
				</div>
				<!-- END TOP NAVIGATION MENU -->
			</div>
			<!-- END PAGE TOP -->
		</div>
		<!-- END HEADER INNER -->
	</div>
	<!-- END HEADER -->
	<div class="clearfix">
	</div>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
		<!-- BEGIN SIDEBAR -->
		<div class="page-sidebar-wrapper">
			<!--
			<div class="page-sidebar">
				aaa
			</div>
			-->
			<div class="page-sidebar navbar-collapse collapse">
				<!-- BEGIN SIDEBAR MENU -->
				<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
					<li class="start ">
						<a href="<?php echo url_root;?>" class="ajaxify">
							<i class="icon-home"></i>
							<span class="title">Home</span>
						</a>
					</li>
				</ul>
				<!-- END SIDEBAR MENU -->
			</div>
			<div class="page-sidebar">
				aaa
			</div>
		</div>
		<!-- END SIDEBAR -->
		<!-- BEGIN CONTENT -->
		<div class="page-content-wrapper">
			<div class="page-content">
				<?php echo $content; // inserting requested page content ?>
			</div>
		</div>
		<!-- END CONTENT -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<div class="page-footer">

		<div class="page-footer-inner">
			2015 &copy; loop company.
		</div>

		<div class="scroll-to-top">
			<i class="icon-arrow-up"></i>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
	<script src="<?php echo cdn;?>/plugins/respond.min.js"></script>
	<script src="<?php echo cdn;?>/plugins/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo cdn;?>/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery-migrate.min.js" type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script src="<?php echo cdn;?>/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery.blockui.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery.cokie.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<script src="<?php echo cdn;?>/scripts/app.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/scripts/layout.js" type="text/javascript"></script>

	<!-- BEGIN PLUGINS -->
	<script type="text/javascript" src="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
	<!-- END PLUGINS -->
	
	<script src="<?php echo url_root;?>/master/script_1.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function () {
			app.init(); // init app core components
			Layout.init(); // init current layout
		});
	</script>
	<!-- END JAVASCRIPTS -->
</body>

<!-- END BODY -->

</html>
