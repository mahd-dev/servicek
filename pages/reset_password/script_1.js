page_script({
	init: function () {
		$("#reset_form input[name=password]").focus();

		var check_password_confirmation = function () {
			var input = $("#reset_form input[name=password]");
			if($("#reset_form input[name=password]").val().length < 8){
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
			if($("#password_confirmation").val() == "" || $("#password_confirmation").val() == $("#reset_form input[name=password]").val()){
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

		$("#reset_form input[name=password]").change(check_password_confirmation);
		$("#password_confirmation").change(check_password_confirmation);

		$("#reset_form").submit(function (e) {
			e.preventDefault();
			if($("#password_confirmation").val() != $("#reset_form input[name=password]").val()) return false;
			$.post(location.href, $(this).serialize(), function(rslt) {
				try{
					parsed=JSON.parse(rslt);
					if ( parsed.status == "logged_in" ) {
						$(".top-menu .user-btn .username").text(parsed.params.displayname);
						$(".top-menu .login-btn").hide();
						$(".top-menu .user-btn").show();
						app.ajaxify(parsed.params.goto_page);
					} else if (parsed.status == 'password_min_length_error') {
						var input = $("#reset_form input[name=password]");
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
			});
			return false;
		});
	}
});
