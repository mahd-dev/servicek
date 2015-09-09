<?php

	if(isset($_POST["pick_url"])){
		$_POST["pick_url"] = str_replace(array(" ", ":", "/", "\\", "&", "\"", "'", "(", ")", "-", "_", "", "", "=", "*", "°", "+", "~", "¬", "¹", "#", "{", "}", "[", "]", "|", "`", "^", "@", "<", ">", ",", ".", ":", "!", "%", "$", "?", "§"), "", str_replace(array("é", "è", "ê", "ë"), "e", str_replace(array("ï", "î"), "i", str_replace(array("à", "â", "ä"), "a", str_replace(array("ç"), "c", str_replace(array("ù"), "u", str_replace(array("ô", "ö"), "o", strtolower($_POST["pick_url"]))))))));
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
