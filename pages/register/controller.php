<?php
	$master = $user!=null && ($user->is_master || $user->is_agent);
	if($user!=null && !$master) { // already logged in
        include"view_2.php";
        goto skip_this_page;
    }

	if(isset($_POST["check_username"])) die(json_encode(array("status" => (user::username_exists($_POST["check_username"]) ? "not_available":"available"))));

	elseif (isset($_POST["displayname"]) && isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["email"]) && isset($_POST["mobile"])) {
		if(strlen($_POST["password"]) < 8) die(json_encode(array("status" => "password_min_length_error")));
		$new_user=user::create($_POST["username"],$_POST["password"]);
		if($new_user instanceOf user){
			$new_user->displayname = $_POST["displayname"];
			$new_user->email = $_POST["email"];
			$new_user->mobile = $_POST["mobile"];

			$validation_token = $new_user-set_email_validation_token();

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

			$mail->addReplyTo("support@servicek.net");

			$mail->isHTML(true);

			$mail->Subject = "Validation de l'adresse sur servicek.net";

			$body = "";

			$mail->Body    = $body;
			$mail->AltBody = strip_tags(str_replace(array("</p>"), "\r\n", str_replace(array("<br>", "</br>", "<br/>"), "\r\n", $body)));

			$mail->send();

			if(!$master) {
				$_SESSION["user"]=serialize($new_user); // storing user to session
				$_SESSION["pwd"]=$_POST["password"];
	      die(json_encode(array(
	          "status" => "logged_in",
	          "params" => array(
	              "displayname" => $new_user->displayname
	          )
	      )));
			}else die(json_encode(array( "status" => "registered", "params" => array("user_id" => $new_user->id ))));
		}else die(json_encode(array("status"=>"username_exists")));
	}

	// definig SEO parameters
	// ...

	// select and display right view
	// ...
	include "view_1.php";

	skip_this_page:
?>
