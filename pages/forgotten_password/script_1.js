page_script({
	init: function () {
		$("#reset_form input[name=email]").focus();

		$("#reset_form").ajaxForm({
			beforeSubmit: function () {
				$("#email_not_exists").hide();
				$(".success").hide();
				if($("#password_confirmation").val() != $("#reset_form input[name=password]").val()) return false;
			},
			success: function (rslt) {

				try{
					parsed=JSON.parse(rslt);
					if ( parsed.status == "success" ) {
						$("#reset_form input[name=email]").val("");
						$("#reset_form .input_accounts").hide();
						$("#reset_form .input_accounts select").empty();
						$(".success").show();
						app.ajaxify(parsed.params.goto_page);
					} else if (parsed.status == 'email_not_exists') {
						var input = $("#reset_form input[name=email]");
						input.closest('.form-group').removeClass('has-success').addClass('has-error');
						$("#email_not_exists").show();
						input.focus();
					} else if (parsed.status == 'accounts_required') {
						$("#reset_form .input_accounts select").empty();
						for (var account in parsed.params.accounts) {
							if (parsed.params.accounts.hasOwnProperty(account)) {
								$("#reset_form .input_accounts select").append($("<option>", {value: account.id, text: account.text}));
							}
						}
						$("#reset_form .input_accounts").show();
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
