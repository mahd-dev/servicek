<?php
	
    if($user!=null) { // already logged in
        include"view_2.php";
        goto logged_in;
    }
    
    // Handling query
    
    if(isset($_POST["username"]) && isset($_POST["password"])){
        
        $login_resp=user::login($_POST["username"], $_POST["password"]); // checking login parameters
        
        if ($login_resp instanceof user){ // login parameters are valid
            
            $_SESSION["user"]=serialize($login_resp); // storing user to session
            
            die(json_encode(array(
                "resp_msg" => "logged_in",
                "params" => array(
                    "displayname" => $login_resp->displayname
                )
            )));
        }else die($login_resp); // username_error || password_error
    }
    
    // definig page SEO parameters
	// ...
    
    
	// select and display right view
	
	include "view_1.php";

    logged_in: // jump to end for already logged in
?>
