<?php
	// definig SEO parameters
	// ...

	$available_job_categories = category::get_available_for('job');
	$available_shop_categories = category::get_available_for('shop');
	$available_company_categories = category::get_available_for('company');

	include "view_1.php";
?>
