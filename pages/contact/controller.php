<?php

	if(isset($_POST["email"]) && isset($_POST["subject"]) && isset($_POST["message"])){

		chdir(__DIR__);
		include_once '../../core/PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = 'servicek.net';
		$mail->SMTPAuth = true;
		$mail->Username = "no-reply@servicek.net";
		$mail->Password = $db_password;
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		$mail->From = "no-reply@servicek.net";
		$mail->FromName = "servicek.net";
		$mail->addAddress("contact@servicek.net");

		$mail->addReplyTo($_POST["email"]);

		if(isset($_FILES["attachments"])){
			for ($i=0; $i < count($_FILES["attachments"]["name"]); $i++) {
				$mail->addAttachment($_FILES["attachments"]["tmp_name"][$i], $_FILES["attachments"]["name"][$i]);
			}
		}

		$mail->isHTML(true);

		$mail->Subject = $_POST["subject"];
		$mail->Body    = $_POST["message"];
		$mail->AltBody = strip_tags(str_replace(array("</p>"), "\r\n", str_replace(array("<br>", "</br>", "<br/>"), "\r\n", $_POST["message"])));

		if(!$mail->send()) die($mail->ErrorInfo);
		else {
			die(json_encode(array("status"=>"success")));
		}
	}

	include "view_1.php";
?>
