<?php

	include("secret.php");

	$secret = $release_secret;

	$headers = getallheaders();
	$hubSignature = $headers['X-Hub-Signature'];

	// Split signature into algorithm and hash
	list($algo, $hash) = explode('=', $hubSignature, 2);

	// Get payload
	$payload = file_get_contents('php://input');

	// Calculate hash based on payload and the secret
	$payloadHash = hash_hmac($algo, $payload, $secret);

	// Check if hashes are equivalent
	if ($hash !== $payloadHash) {

		chdir(__DIR__);
		file_put_contents('error.log', 'Unauthorized :\n' . $payload . '\n', FILE_APPEND);
		header($_SERVER['SERVER_PROTOCOL'] . ' 401 Unauthorized', true, 401);
    die('Bad secret');

	}else{

		$output = shell_exec("cd /var/www/servicek && git pull");
		chdir(__DIR__);
		file_put_contents('pull.log', $output.'\n', FILE_APPEND);
		die("pull success");
	}

?>
