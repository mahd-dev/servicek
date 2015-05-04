page_script({
	init: function () {
		$("#register_form input[name=displayname]").focus();
		
		$("#register_form input[name=username]").change(function () {
			var input = $(this);

			$('.icon-check, .icon-ban, .icon-close', input.closest('.form-group')).remove();
			if (input.val() === "") {
				input.closest('.form-group').removeClass('has-error').removeClass('has-success');
				return;
			}

			input.attr("readonly", true).
			attr("disabled", true).
			addClass("spinner");
			$("#username_unvailable_msg").hide();
			$("#username_error_msg").hide();

			$.post(location.href, { check_username: input.val() }, function (res) {
				input.attr("readonly", false).
				attr("disabled", false).
				removeClass("spinner");

				if (res.status == 'available') {
					$('.icon-ban', input.closest('.form-group')).remove();
					input.closest('.form-group').removeClass('has-error').removeClass('has-success');	
				} else if (res.status == 'not_available') {
					input.closest('.form-group').removeClass('has-success').addClass('has-error');
					$('.fa-check', input.closest('.form-group')).remove();
					input.before('<i class="icon-ban"></i>');
					$("#username_unvailable_msg").show();
					input.focus();
				}else{
					console.log(res);
					input.closest('.form-group').removeClass('has-success').addClass('has-error');
					$('.fa-check', input.closest('.form-group')).remove();
					input.before('<i class="icon-close"></i>');
					$("#username_error_msg").show();
					$("#username_error_msg a").focus();
				}

			}, 'json')
			.fail(function(err) {
				console.log(err);
				input.closest('.form-group').removeClass('has-success').addClass('has-error');
				$('.fa-check', input.closest('.form-group')).remove();
				input.before('<i class="icon-close"></i>');
				$("#username_error_msg").show();
				$("#username_error_msg a").focus();
			});

		});
	
		var check_password_confirmation = function () {
			var input = $("#register_form input[name=password]");
			if($("#register_form input[name=password]").val().length < 8){
				input.closest('.form-group').removeClass('has-success').addClass('has-error');
				$('.fa-check', input.closest('.form-group')).remove();
				input.before('<i class="icon-ban"></i>');
				$("#password_min_length_error").show();
				input.focus();
			}else{
				$('.icon-ban', input.closest('.form-group')).remove();
				input.closest('.form-group').removeClass('has-error').removeClass('has-success');
				$("#password_min_length_error").hide();
			}

			var input = $("#password_confirmation");
			if($("#password_confirmation").val() == "" || $("#password_confirmation").val() == $("#register_form input[name=password]").val()){
				$('.icon-ban', input.closest('.form-group')).remove();
				input.closest('.form-group').removeClass('has-error').removeClass('has-success');
				$("#passwords_not_match").hide();
			}else{
				input.closest('.form-group').removeClass('has-success').addClass('has-error');
				$('.fa-check', $("#password_confirmation").closest('.form-group')).remove();
				input.before('<i class="icon-ban"></i>');
				$("#passwords_not_match").show();
				$("#password_confirmation").focus();
			}
		};

		$("#register_form input[name=password]").change(check_password_confirmation);
		$("#password_confirmation").change(check_password_confirmation);

		$("#register_form").ajaxForm({
			beforeSubmit: function () {
				if($("#password_confirmation").val() != $("#register_form input[name=password]").val()) return false;
			},
			success: function (rslt) {
			
				try{
					parsed=JSON.parse(rslt);
					if ( parsed.status == "logged_in" ) {
						$(".top-menu .user-btn .username").text(parsed.params.displayname);
						$(".top-menu .login-btn").hide();
						$(".top-menu .user-btn").show();
						Layout.ajaxify(location.origin + "/account");
					} else if (res.status == 'username_exists') {
						var input = $("#register_form input[name=username]");
						input.closest('.form-group').removeClass('has-success').addClass('has-error');
						$('.fa-check', input.closest('.form-group')).remove();
						input.before('<i class="icon-ban"></i>');
						$("#username_unvailable_msg").show();
						input.focus();
					} else if (res.status == 'password_min_length_error') {
						var input = $("#register_form input[name=password]");
						input.closest('.form-group').removeClass('has-success').addClass('has-error');
						$('.fa-check', input.closest('.form-group')).remove();
						input.before('<i class="icon-ban"></i>');
						$("#password_min_length_error").show();
						input.focus();
					} else {
						console.log(rslt);
						$(".unhandled_error").show();
					}
					
				}catch(ex){
					console.log(rslt);
					$(".unhandled_error").show();
				}
				
			},
			error: function () {
				console.log(rslt);
				$(".unhandled_error").show();
			}
		});
	}
});
