<?php

	try {

	  $payload = json_decode($_POST['payload']);

	}
	catch(Exception $e) {

		chdir(__DIR__);
		file_put_contents('error.log', $e . ' :\n' . $payload . '\n', FILE_APPEND);
		echo $e;
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		die();

	}

	include("secret.php");

	if ($payload->hook->config->secret == $pull_secret) {

		$output = shell_exec("cd /var/www/next_servicek && git pull");
		chdir(__DIR__);
		file_put_contents('pull.log', $output, FILE_APPEND);
		echo "pull success";
		die();

	}else{

		chdir(__DIR__);
		file_put_contents('error.log', 'Unauthorized :\n' . $payload . '\n', FILE_APPEND);
		header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized', true, 401);
		die();
	}

?>