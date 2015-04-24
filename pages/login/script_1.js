page_script({
	init: function () {
        var clear_alerts = function () {
            $(".username_error").hide();
            $(".password_error").hide();
            $(".unhandled_error").hide();
        };
        
        $("#login_form input[name=username]").change(clear_alerts);
        $("#login_form input[name=password]").change(clear_alerts);
        
        $("#login_form").ajaxForm({
            beforeSubmit: clear_alerts,
            success: function (rslt) {
                if(rslt=="username_error"){
                    $(".username_error").show();
                    $("#login_form input[name=password]").val("");
                    $("#login_form input[name=username]").focus();
                }else if(rslt=="password_error"){
                    $(".password_error").show();
                    $("#login_form input[name=password]").val("");
                    $("#login_form input[name=password]").focus();
                }else{
                    try{
                        rslt=JSON.parse(rslt);
                        $(".top-menu .user-btn .username").text(rslt.params.displayname);
                        $(".top-menu .login-btn").hide();
                        $(".top-menu .user-btn").show();
                        Layout.ajaxify(location.origin + "/account");
                    }catch(ex){
                        $(".unhandled_error").show();
                    }
                    
                }
            }
        });
	}
});
