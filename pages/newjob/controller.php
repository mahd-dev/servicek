<?php
	if($user==null){ // must be connected to access account page
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}

	// definig SEO parameters
	// ...

	// select and display right view
	// ...
	
	$new_job_token = gf::generate_guid();
	$_SESSION["new_job_token"] = $new_job_token;

	include "view_1.php";

	skip_this_page:
?>
