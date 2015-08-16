<?php

	if(isset($_POST["pick_url"])){
		$_POST["pick_url"] = urlencode(str_replace(array(" ", ":", "/", "\\", "&", "\"", "'", "(", ")", "-", "_", "", "", "=", "*", "°", "+", "~", "¬", "¹", "#", "{", "}", "[", "]", "|", "`", "^", "@", "<", ">", ",", ".", ":", "!", "%", "$", "?", "§"), "", $_POST["pick_url"]));
		$i="";
		while (!gf::check_url($_POST["pick_url"].$i)) {
			$i++;
		}
		die($_POST["pick_url"].$i);
	}

	$available_job_categories = category::get_available_for('job');
	$available_shop_categories = category::get_available_for('shop');
	$available_company_categories = category::get_available_for('company');

	include "view_1.php";
?>
