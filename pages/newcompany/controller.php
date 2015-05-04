<?php
	if($user==null){ // must be connected to access account page
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}

	if(isset($_POST["check_url"])) die((company::check_url($_POST["check_url"])?"true":"false"));
	
	// definig SEO parameters
	// ...

	// select and display right view
	// ...
	include "view_1.php";

	skip_this_page:
?>
