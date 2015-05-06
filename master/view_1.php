<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="<?php echo(rtl?"rtl":"ltr");?>">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Servicek</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta content="" name="description" />
	<meta content="" name="author" />

	<script src="<?php echo cdn;?>/plugins/pace/pace.min.js"></script>
	<link href="<?php echo cdn;?>/plugins/pace/themes/pace-theme-minimal<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" />

	<link href="<?php echo cdn;?>/fonts/default/default<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/simple-line-icons/simple-line-icons<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/bootstrap/css/bootstrap<?php echo(rtl?"-rtl":"");?>.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo cdn;?>/plugins/uniform/css/uniform.default<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">

	<link href="<?php echo cdn;?>/plugins/bootstrap-switch/css/bootstrap-switch<?php echo(rtl?"-rtl":"");?>.min.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo cdn;?>/css/components-rounded<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" id="style_components" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/plugins<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/layout<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/themes/default<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/css/custom<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo cdn;?>/plugins/tag-it/css/jquery.tagit<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo cdn;?>/plugins/tag-it/css/tagit.ui-zendesk<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />

	<link href="<?php echo cdn;?>/plugins/aspectratio/aspectratio<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />

	<link rel="shortcut icon" href="<?php echo cdn;?>/img/favicons/favicon.png" />

	<script>
		function page_script(sc) {
			if (document.readyState == "complete") sc.init();
			else document.addEventListener('DOMContentLoaded', sc.init, false);
		}
	</script>

</head>

<body>
	<div class="page-header">
		<div class="page-header-top">
			<div class="container">

				<div class="page-logo">
					<a href="<?php echo url_root;?>" class="ajaxify">
					<img src="<?php echo cdn;?>/img/logo<?php echo(rtl?"-rtl":"");?>.svg" alt="logo" class="logo-default">
				</a>
				</div>

				<a href="javascript:;" class="menu-toggler"><i class="fa fa-bars"></i></a>

				<div class="top-menu">
					<ul class="nav navbar-nav pull-right">

						<li class="login-btn dropdown dropdown-user dropdown-dark" <?php if($user!=null) echo ' style="display:none;"';?>>
							<a href="<?php echo url_root;?>/login" class="dropdown-toggle ajaxify">
								<i class="icon-key"></i>&nbsp;&nbsp;<span class="username">Se connecter</span>
							</a>
						</li>
						<li class="user-btn dropdown dropdown-user dropdown-dark" <?php if($user==null) echo ' style="display:none;"';?>>
							<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
								<span class="username"><?php if($user) echo $user->displayname;?></span>&nbsp;&nbsp;<i class="icon-user"></i>
							</a>
							<ul class="dropdown-menu dropdown-menu-default">
								<li>
									<a href="<?php echo url_root;?>/account" class="ajaxify">
										<i class="icon-settings"></i> Mon compte</a>
								</li>
								<li>
									<a href="<?php echo url_root;?>/logout" class="ajaxify">
										<i class="icon-key"></i> Se déconnecter</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-header-menu">
			<div class="container">
				<form id="master_search_form" class="search-form">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" name="q">
						<span class="input-group-btn">
						<a class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
					</div>
				</form>
				<div class="hor-menu ">
					<ul class="nav navbar-nav">
						<li>
							<a href="<?php echo url_root;?>" class="ajaxify">Actualités</a>
						</li>
						<!--
						<li class="menu-dropdown mega-menu-dropdown active">
							<a data-close-others="true" data-toggle="dropdown" href="javascript:;" class="dropdown-toggle">
								Features <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="min-width: 710px">
								<li>
									<div class="mega-menu-content">
										<div class="row">
											<div class="col-md-4">
												<ul class="mega-menu-submenu">
													<li>
														<h3>eCommerce</h3>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</li>

						<li class="menu-dropdown classic-menu-dropdown ">
							<a data-close-others="true" data-toggle="dropdown" href="javascript:;">
						Extra <i class="fa fa-angle-down"></i>
						</a>
							<ul class="dropdown-menu pull-left">
								<li class=" dropdown-submenu">
									<a href=javascript:;>
										<i class="icon-briefcase"></i> Data Tables </a>
									<ul class="dropdown-menu">
										<li class=" ">
											<a href="table_basic.html">
										Basic Datatables </a>
										</li>
									</ul>
								</li>
							</ul>
						</li>
						-->
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="page-container">
		<div class="page-content">
			<div class="container">
				<?php echo $content; // inserting requested page content ?>
			</div>
		</div>
	</div>

	<div class="page-footer">
		<div class="container">
			<?php echo date( 'Y');?> &copy; <a href="https://servicek.tn/about">Servicek</a> | Powered by <a href="http://mahd.tn">Mahd Company</a>.
		</div>
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
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
	
	<script src="<?php echo cdn;?>/plugins/jquery.form<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
	
	<script src="<?php echo cdn;?>/plugins/tag-it/js/tag-it<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
	
	<script src="<?php echo cdn;?>/scripts/app<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/scripts/layout<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

	<script src="<?php echo cdn;?>/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

	<script src="<?php echo cdn;?>/plugins/bootstrap-fileinput/bootstrap-fileinput<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

	<script src="<?php echo cdn;?>/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

	<script src="<?php echo cdn;?>/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

	<script src='http://maps.google.com/maps/api/js?sensor=false&libraries=places' type="text/javascript"></script>
	<script src="<?php echo cdn;?>/plugins/locationpicker/locationpicker.jquery<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

	<script src="<?php echo url_root;?>/master/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
	<script>
		jQuery(document).ready(function () {
			app.init();
			Layout.init();
		});
	</script>
</body>

</html>