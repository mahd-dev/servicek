<?php
	
	if(isset($_GET["term"])){
		die(json_encode(array(
			$_GET["term"],
			"aaa",
			"bbb",
			"ccc"
			)));
	}
	// definig SEO parameters
	// ...

	// select and display right view
	// ...
	include "view_1.php";
?>
