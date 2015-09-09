<?php

	if ($user==null || $user->is_master || (get_class($page)=="company" && !$page->is_assigned_to_admin($user)) || ((get_class($page)=="shop" || get_class($page)=="job") && !$page->admin == $user)) {include __DIR__."/../404/controller.php";goto skip_this_page;}

	$address = $page->url."@servicek.net";

	$mailbox = 'servicek.net';
	$username = $address;
	$password = $_SESSION["pwd"];
	$encryption = 'tls';

	$imap = new imap($mailbox, $username, $password, $encryption);

	if($imap->isConnected()===false) die($imap->getError());

	if(isset($_GET["refresh"])){
		$imap->selectFolder($_GET["refresh"]);
		die(json_encode(array(
			"status"=>"success",
			"messages"=>$imap->getMessages(false)
		)));
	}elseif (isset($_GET["folder"]) && isset($_GET["message"])) {
		$imap->selectFolder($_GET["folder"]);
		if(isset($_GET["attachment"])) {
			$attachment = $imap->getAttachment($_GET["message"], $_GET["attachment"]);
			header('Content-Description: File Transfer');
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename="'.$attachment["name"].'"');
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . $attachment["size"]);
			die($attachment["content"]);
		}else{
			$msg = $imap->getMessage(intval($_GET["message"]));
			$imap->setUnseenMessage(intval($_GET["message"]));
			die(($msg["html"]?$msg["html"]:$msg["body"]));
		}
	}elseif (isset($_POST["message"])) {

		chdir(__DIR__);
		require '../../core/PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = 'servicek.net';
		$mail->SMTPAuth = true;
		$mail->Username = $username;
		$mail->Password = $password;
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;
		$mail->SMTPOptions = array(
		    'ssl' => array(
		        'verify_peer' => false,
		        'verify_peer_name' => false,
		        'allow_self_signed' => true
		    )
		);

		$mail->From = $username;
		$mail->FromName = $page->name;
		foreach (array_filter(explode(";", $_POST["email"])) as $address) {
			$mail->addAddress($address);
		}

		$mail->addReplyTo($username);

		if(isset($_FILES["attachments"])){
			for ($i=0; $i < count($_FILES["attachments"]["name"]); $i++) {
				$mail->addAttachment($_FILES["attachments"]["tmp_name"][$i], $_FILES["attachments"]["name"][$i]);
			}
		}

		$mail->isHTML(true);

		$mail->Subject = $_POST["subject"];
		$mail->Body    = $_POST["message"];

		if(!$mail->send()) die($mail->ErrorInfo);
		else die(json_encode(array("status"=>"success")));

	}

	$folders = $imap->getFolders();

	include "view_1.php";

	skip_this_page:
?>
