<?php
	if($user==null){ // must be connected to access account page
		include __DIR__."/../404/controller.php";
		goto skip_this_page;
	}elseif ($user->is_master) {
		include __DIR__."/../../pages_admin/account/controller.php";
		goto skip_this_page;
	}

	if(isset($set_user_attrib) && $set_user_attrib && isset($_POST["name"]) && isset($_POST["value"])){
		switch ($_POST["name"]) {
			case "displayname":
				if($_POST["value"]==""){
					header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
					die("Le nom ne doit pas être vide");
				}
				$user->displayname=$_POST["value"];
			break;
			case "email":
				$user->email=$_POST["value"];

				$validation_token = $user->set_email_validation_token();

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
				$mail->addAddress("");

				$mail->addReplyTo("contact@servicek.net");

				$mail->isHTML(true);

				$mail->Subject = "Validation de l'adresse sur servicek.net";

				$body = file_get_contents(srv_root."/resources/email_validation.html");
				$body = str_replace("@displayname", $user->displayname, $body);
				$body = str_replace("@url", url_root."/validate_email/".$validation_token, $body);
				$body = str_replace("@year", date("Y"), $body);

				$mail->Body    = $body;
				$mail->AltBody = strip_tags(str_replace(array("</p>"), "\r\n", str_replace(array("<br>", "</br>", "<br/>"), "\r\n", $body)));

				$mail->send();

			break;
			case "mobile":$user->mobile=$_POST["value"];break;
		}
		die("success");
	}

	if(isset($_POST["old_password"]) && isset($_POST["new_password"])){
		if(strlen($_POST["new_password"]) < 8) die(json_encode(array("status"=>"new_password_min_length_error")));
		$check_password=user::login($user->username, $_POST["old_password"], gf::getClientIP());
		if($check_password instanceOf user){
			$user->password=$_POST["new_password"];
			$_SESSION["pwd"] = $_POST["new_password"];
			die(json_encode(array(
				"status"=>"success"
			)));
		}elseif (is_array($check_password)) {
            if($check_password["status"] == "waiting_restriction_time"){
            	session_destroy();
                die(json_encode(array(
                    "status" => "not_logged_in"
                )));
            }elseif($check_password["status"] == "password_error"){
                die(json_encode(array(
                    "status" => "old_password_error",
                    "params" => array(
                        "remaining_attempts" => $check_password["remaining_attempts"]
                    )
                )));
            }else die("unhandled_error");
        }else die("unhandled_error");
	}

	// definig SEO parameters
	// ...

	// init page variables to display
	$num_pages = $user->count_pages;

	$pages=array();
	foreach ($user->pages as $p) {
		$pages[]=array(
			"type"=>get_class($p),
			"url"=>$p->url,
			"name"=>$p->name
		);
	}

	// selecting and including view
	include "view_1.php";

	skip_this_page:
?>
