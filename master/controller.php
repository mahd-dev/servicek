<?php

	// defining default SEO parameters
	// ...

	// playing requested page
	ob_start();
	include $req_page;
	$content = ob_get_contents();
	ob_end_clean();

	// select and display right view
	// ...
	include "view_1.php";

?>
