<?php

	if(isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"])){
		$headers  = 'MIME-Version: 1.0'."\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8'."\r\n";
    $headers .= 'From: noreply@servicek.net\r\n';
		$headers .= 'Reply-To: '.$_POST["email"];
		if(mail("contact@servicek.net", $_POST["email"]." : ".$_POST["subject"], $_POST["message"])){
			die(json_encode(array("status"=>"success")));
		}else {
			die(json_encode(array("status"=>"error")));
		}
	}

	include "view_1.php";
?>
