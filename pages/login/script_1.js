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

				$("#login_form").submit(function (e) {
					e.preventDefault();
					clear_alerts();
					$.post(location.href, $(this).serialize(), function(rslt) {
						try{
							parsed=JSON.parse(rslt);
							if ( parsed.status == "logged_in" ) {
									$(".top-menu .user-btn .username").text(parsed.params.displayname);
									$(".top-menu .login-btn").hide();
									$(".top-menu .user-btn").show();
									app.ajaxify(parsed.params.goto_page);
							} else if (parsed.status == "username_error") {
									$(".username_error").show();
									$("#login_form input[name=password]").val("");
									$("#login_form input[name=username]").focus();
							} else if (parsed.status == "waiting_restriction_time") {
									$(".waiting_restriction_time .remaining_time").text(parsed.params.remaining_time);
									$(".waiting_restriction_time").show();
									$("#login_form input[name=password]").val("");
									$("#login_form input[name=username]").focus();
							} else if (parsed.status == "password_error") {
									$(".password_error .remaining_attempts").text(parsed.params.remaining_attempts);
									$(".password_error").show();
									$("#login_form input[name=password]").val("");
									$("#login_form input[name=password]").focus();
							} else if (parsed.status == "restricted_host") {
									$(".restricted_host").show();
									$("#login_form input[name=username]").val("");
									$("#login_form input[name=password]").val("");
									$("#login_form input[name=username]").focus();
							} else {
									console.log(rslt);
									$(".unhandled_error").show();
							}
						}catch(ex){
								console.log(rslt);
								$(".unhandled_error").show();
						}
					});
					return false;
				});

	}
});
