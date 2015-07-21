<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" dir="<?php echo(rtl?" rtl ":"ltr ");?>">
<!--<![endif]-->

	<head>
		<meta charset="utf-8" />
		<title>Servicek</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta content="width=device-width, initial-scale=1.0" name="viewport" />
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">

		<?php echo rtrim( $meta, PHP_EOL );?>

		<meta name="twitter:card" content="PLACEHOLDER">
		<meta name="twitter:title" content="<?php echo (isset($ref[" twitter:title "])?$ref["twitter:title "]:"Servicek.net ")?>">
		<meta name="twitter:description" content="<?php echo (isset($ref[" twitter:description "])?$ref["twitter:description "]:$seo_description)?>">
		<meta name="twitter:image:src" content="<?php echo (isset($ref[" twitter:image:src "])?$ref["twitter:image:src "]:cdn."/img/main_ref.png ")?>">
		<meta name="twitter:domain" content="servicek.net">

		<meta name="description" content="<?php echo $seo_description;?>">
		<meta name="author" content="Société Tunisienne des Services" />
		<meta name="og:updated_time" content="<?php echo time();?>">

		<script src="<?php echo cdn;?>/libraries/pace/pace.min.js"></script>
		<link href="<?php echo cdn;?>/libraries/pace/themes/pace-theme-big-counter<?php echo(rtl?"-rtl":"");?><?php if(!debug) echo ".min";?>.css" rel="stylesheet" />

		<link href="<?php echo cdn;?>/fonts/default/default<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css">
		<link href="<?php echo cdn;?>/libraries/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo cdn;?>/libraries/Font-Awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo cdn;?>/libraries/flaticon/flaticon.css" rel="stylesheet" type="text/css">
		<link href="<?php echo cdn;?>/libraries/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo cdn;?>/libraries/bootstrap-fileinput/css/fileinput.min.css" rel="stylesheet" type="text/css">
		<link href="<?php echo cdn;?>/libraries/OwlCarousel/owl-carousel/owl.carousel.css" rel="stylesheet" type="text/css">
		<link href="<?php echo cdn;?>/css/style.css" rel="stylesheet" type="text/css">

		<link href="<?php echo cdn;?>/libraries/bootstrap-switch/css/bootstrap-switch<?php echo(rtl?"-rtl":"");?>.min.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo cdn;?>/libraries/tag-it/css/jquery.tagit<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo cdn;?>/libraries/tag-it/css/tagit.ui-zendesk<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo cdn;?>/libraries/select2/select2<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo cdn;?>/libraries/jquery-multi-select/css/multi-select<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />

		<link href="<?php echo cdn;?>/libraries/aspectratio/aspectratio<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />

		<!-- Material design -->
		<link href="<?php echo cdn;?>/libraries/bootstrap-materialdesign/css/roboto<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo cdn;?>/libraries/bootstrap-materialdesign/css/material<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo cdn;?>/libraries/bootstrap-materialdesign/css/ripples<?php if(!debug) echo ".min";?>.css" rel="stylesheet" type="text/css" />

		<link rel="shortcut icon" href="<?php echo cdn;?>/img/favicons/favicon.png" />

		<script>
			function page_script(sc) {
				if (document.readyState == "complete") sc.init();
				else document.addEventListener('DOMContentLoaded', sc.init, false);
			}
		</script>

	</head>

	<body>

		<div class="page-wrapper">
			<div class="header header-large">
				<div class="container">
					<div class="pace-container"></div>
					<div class="header-inner">
						<div class="header-top">
							<ul class="nav nav-pills top-menu">
								<li class="login-btn dropdown dropdown-user dropdown-dark" <?php if($user!=null) echo ' style="display:none;"';?>>
									<a href="<?php echo url_root;?>/login" class="dropdown-toggle ajaxify">
										<i class="icon-key"></i>&nbsp;&nbsp;
										<span class="username">Se connecter</span>
									</a>
								</li>
								<li class="user-btn dropdown dropdown-user dropdown-dark" <?php if($user==null) echo ' style="display:none;"';?>>
									<a href="<?php echo url_root;?>/account" class="ajaxify">
										<span class="username"><?php if($user) echo $user->displayname;?></span>
									</a>
									<a href="<?php echo url_root;?>/logout" class="ajaxify"><i class="icon-key"></i> Se déconnecter</a>
								</li>
							</ul>

							<ul class="nav nav-pills">
								<li><a href="<?php echo url_root;?>" class="ajaxify">Actualités</a></li>
								<li><a href="<?php echo url_root;?>/about" class="ajaxify">A propos</a></li>
								<li><a href="<?php echo url_root;?>/contact" class="ajaxify">Contact</a></li>
								<li class="hidden-xs"><a>|</a></li>
							</ul>
						</div>

						<div class="header-main">
							<div class="header-title">
								<a href="<?php echo url_root;?>" class="ajaxify">
									<img src="<?php echo cdn;?>/img/logo<?php echo(rtl?"-rtl":"");?>.svg" alt="logo" class="logo-default">
								</a>
							</div>

							<div class="header-search">
								<form id="master_search_form" action="search">
									<div class="input-group">
										<input type="text" placeholder="Rechercher" class="form-control" name="q" required>

										<span class="input-group-btn">
											<button class="btn" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</div>
								</form>
							</div>
						</div>

						<a class="btn btn-fab header-action ajaxify" href="<?php echo url_root;?>/new" title="Ajouter nouveau">
							<i class="fa fa-plus"></i>
							<img src="<?php echo cdn;?>/img/plus_help.svg">
						</a>
					</div>
				</div>
			</div>

			<div class="main">
				<div class="container content">
					<?php echo $content; // inserting requested page content ?>
				</div>
			</div>

			<div id="footer" class="footer">

				<div class="footer-bottom">
					<div class="container">
						<div class="footer-bottom-inner">
							<div class="footer-bottom-left">
								<?php echo date('Y');?> &copy; <a href="<?php echo url_root;?>/about" class="ajaxify">Société tunisienne des services</a>, Tout droits réservés.
							</div>
							<div class="footer-bottom-right">
								Developed with Love <i class="fa fa-heart-o" style="font-size:90%;color:#E91E63;"></i> , by <a href="http://mahd.tn" target="_blank">mahd</a>
							</div>
						</div>
					</div>
				</div>
				<div class="footer-bar">
					<a class="scroll-top">
	        	<div class="container center">
	            <i class="fa fa-angle-up"></i>
	        	</div>
					</a>
	    	</div>
			</div>
		</div>

		<!--[if lt IE 9]>
		<script src="<?php echo cdn;?>/libraries/respond.min.js"></script>
		<script src="<?php echo cdn;?>/libraries/excanvas.min.js"></script>
		<![endif]-->

		<script src="<?php echo cdn;?>/js/jquery.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-transit/jquery.transit.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/bootstrap/assets/javascripts/bootstrap/dropdown.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/bootstrap/assets/javascripts/bootstrap/collapse.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/bootstrap-fileinput/js/fileinput.min.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/autosize/jquery.autosize.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/isotope/dist/isotope.pkgd.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/OwlCarousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery.scrollTo/jquery.scrollTo.min.js" type="text/javascript"></script>

		<script src="//maps.googleapis.com/maps/api/js?libraries=weather,geometry,visualization,places,drawing&amp;sensor=false" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-google-map/infobox.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-google-map/markerclusterer.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-google-map/jquery-google-map.js" type="text/javascript"></script>

		<!--<script src="<?php echo cdn;?>/js/app.js" type="text/javascript"></script>-->
		<script src="<?php echo cdn;?>/js/map.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/js/map_markerwithlabel.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/jquery-migrate.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery.blockui.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery.cokie.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/uniform/jquery.uniform.min.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/masonry/masonry.pkgd.min.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/jquery.form<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/tag-it/js/tag-it<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/js/app<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/bootstrap-editable/bootstrap-editable/js/bootstrap-editable<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/bootstrap-fileinput/js/fileinput<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/locationpicker/locationpicker.jquery<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/select2/select2.min.js" type="text/javascript"></script>
		<script src="<?php echo cdn;?>/libraries/jquery-multi-select/js/jquery.multi-select.js" type="text/javascript"></script>

		<script src="<?php echo cdn;?>/libraries/jquery.pulsate.min.js" type="text/javascript"></script>

		<!-- Material design -->
		<script src="<?php echo cdn;?>/libraries/bootstrap-materialdesign/js/ripples<?php if(!debug) echo ".min";?>.js" type="text/javascript" ></script>
		<script src="<?php echo cdn;?>/libraries/bootstrap-materialdesign/js/material<?php if(!debug) echo ".min";?>.js" type="text/javascript" ></script>

		<script src="<?php echo url_root;?>/master/script_1<?php if(!debug) echo ".min";?>.js" type="text/javascript"></script>
		<script>
			jQuery(document).ready(function() {
				$.material.init();
				app.init();
			});
		</script>
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-65049217-1', 'auto');
		  ga('send', 'pageview');

		</script>
	</body>

</html>
