page_script({
	init: function () {

		// personal informations tab
		$.fn.editable.defaults.ajaxOptions = {type: "POST"};
		$.fn.editable.defaults.type = 'text';
		$.fn.editable.defaults.pk = 1;
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = location.origin + '/account/set_user_attrib';
    $.fn.editable.defaults.onblur = 'submit';
		$.fn.editable.defaults.emptytext = 'Vide';

        $('#displayname').editable({ name: 'displayname', success: function (response, newValue) {
        	$(".top-menu .user-btn .username").text(newValue);
        	$(".profile-usertitle-name").text(newValue);
        }});
        $('#email').editable({ name: 'email'});
        $('#mobile').editable({ name: 'mobile'});


        // password tab
        var clear_alerts = function () {
            $(".success_msg").hide();
            $(".new_password_min_length_error").hide();
            $(".old_password_error").hide();
            $(".unhandled_error").hide();
        };

        $("#login_form input[name=oldpassword]").change(clear_alerts);
        $("#login_form input[name=newpassword]").change(clear_alerts);

		$("#password_form").ajaxForm({
			beforeSubmit: clear_alerts,
			success: function (rslt) {
				try{
                    parsed=JSON.parse(rslt);
                    if (parsed.status == "success") {
                    	$(".success_msg").show();
                    	$("#password_form")[0].reset();
                	} else if (parsed.status == "new_password_min_length_error") {
                        $(".new_password_min_length_error").show();
                        $("#login_form input[name=newpassword]").val("");
                        $("#login_form input[name=newpassword]").focus();
                    } else if (parsed.status == "not_logged_in") {
                        app.logout(location.origin + "/login");
                    } else if (parsed.status == "old_password_error") {
                        $(".old_password_error .remaining_attempts").text(parsed.params.remaining_attempts);
                        $(".old_password_error").show();
                        $("#login_form input[name=oldpassword]").val("");
                        $("#login_form input[name=oldpassword]").focus();
                    } else {
                    	console.log(rslt);
                        $(".unhandled_error").show();
                    }
                }catch(ex){
                    console.log(rslt);
                    $(".unhandled_error").show();
                }
			}
		});

	}
});
