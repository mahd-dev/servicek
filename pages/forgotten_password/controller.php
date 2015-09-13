<?php
	if($user!=null) {
    include srv_root."/pages/404/controller.php";
    goto skip_this_page;
  }

	function sendmail($account){
		global $smtp_noreply_password;

		$validation_token = $account->set_reset_password_token();
		chdir(__DIR__);
		include_once '../../core/PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = 'servicek.net';
		$mail->SMTPAuth = true;
		$mail->Username = "no-reply@servicek.net";
		$mail->Password = $smtp_noreply_password;
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
		$mail->addAddress($account->email);

		$mail->addReplyTo("contact@servicek.net");

		$mail->isHTML(true);

		$mail->Subject = "Ticket de réinitialisation du mot de passe du compte servicek.net";

		$body = file_get_contents(srv_root."/resources/password_reset_ticket.html");
		$body = str_replace("@displayname", $account->displayname, $body);
		$body = str_replace("@username", $account->username, $body);
		$email_validation_token = $account->email_validation_token;
		$body = str_replace("@url", url_root."/validate_email/".$validation_token.($email_validation_token?"/".$email_validation_token:""), $body);
		$body = str_replace("@year", date("Y"), $body);

		$mail->Body    = $body;
		$mail->AltBody = strip_tags(str_replace(array("</p>"), "\r\n", str_replace(array("<br>", "</br>", "<br/>"), "\r\n", $body)));

		if(!$mail->send()) die($mail->ErrorInfo);
		else {
			die(json_encode(array("status"=>"success")));
		}
	}

	if (isset($_POST["email"])) {
		$email_users = user::get_by_email($_POST["email"]);
		if(count($email_users)==1){
			sendmail($email_users[0]);
			die(json_encode(array( "status" => "success" )));
		}elseif (count($email_users)>1) {
			if(isset($_POST["account"]) && $_POST["account"]){
				$account = new user($_POST["account"]);
				if($account->isvalid){
					sendmail($account);
					die(json_encode(array( "status" => "success" )));
				}
			}
			$accounts = array();
			foreach ($email_users as $email_user) {
				$accounts[] = array("id"=>$email_user->id, "text"=>$email_user->username." ( ".$email_user->displayname." )");
			}
			die(json_encode(array( "status" => "accounts_required", "params"=> array(
				"accounts"=>$accounts
			))));
		}else{
			die(json_encode(array( "status" => "email_not_exists" )));
		}
	}

	include "view_1.php";

	skip_this_page:
?>
