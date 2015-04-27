page_script({
	init: function () {
        $("#login_form input[name=username]").focus();
        
        var clear_alerts = function () {
            $(".username_error").hide();
            $(".password_error").hide();
            $(".waiting_restriction_time").hide();
            $(".restricted_host").hide();
            $(".unhandled_error").hide();
        };
        
        $("#login_form input[name=username]").change(clear_alerts);
        $("#login_form input[name=password]").change(clear_alerts);
        
        $("#login_form").ajaxForm({
            beforeSubmit: clear_alerts,
            success: function (rslt) {
            
                try{
                    parsed=JSON.parse(rslt);
                    if ( parsed.resp_msg == "logged_in" ) {
                        $(".top-menu .user-btn .username").text(parsed.params.displayname);
                        $(".top-menu .login-btn").hide();
                        $(".top-menu .user-btn").show();
                        Layout.ajaxify(location.origin + "/account");
                    } else if (parsed.resp_msg == "waiting_restriction_time") {
                        $(".waiting_restriction_time .remaining_time").text(parsed.params.remaining_time);
                        $(".waiting_restriction_time").show();
                        $("#login_form input[name=password]").val("");
                        $("#login_form input[name=username]").focus();
                    } else if (parsed.resp_msg == "password_error") {
                        $(".password_error .remaining_attempts").text(parsed.params.remaining_attempts);
                        $(".password_error").show();
                        $("#login_form input[name=password]").val("");
                        $("#login_form input[name=password]").focus();
                    } else {
                        $(".unhandled_error").show();
                    }
                    
                }catch(ex){
                    if(rslt=="username_error"){
                        $(".username_error").show();
                        $("#login_form input[name=password]").val("");
                        $("#login_form input[name=username]").focus();
                    }else if(rslt=="restricted_host"){
                        $(".restricted_host").show();
                        $("#login_form input[name=username]").val("");
                        $("#login_form input[name=password]").val("");
                        $("#login_form input[name=username]").focus();
                    }else{
                        console.log(rslt);
                        $(".unhandled_error").show();
                    }
                }
                
            }
        });
	}
});
