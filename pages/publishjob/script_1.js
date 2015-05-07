page_script({
	init: function () {

		// handling wizard
		var form = $('#submit_form');
		var error = $('.alert-danger.form-error', form);
		var payment_error = $('.alert-danger.payment_unhandled_error', form);

		form.submit(function(e){ e.preventDefault(); });

		var formvalidator = form.validate({
			ignore: "",
			doNotHideMessage: true,
			errorElement: 'span',
			errorClass: 'help-block help-block-error',
			focusInvalid: true,
			rules: {

				offer: {required: true},
				accept_contract: {required: true},
				
				credit_card_number: {required: true, creditcard: true},
				credit_card_password: {required: true}
				
			},

			invalidHandler: function (event, validator) { //display error alert on form submit   
				var cr = $(validator.currentElements[0]);
				$('#page_wizard').bootstrapWizard("show", $(cr.parents(".tab-pane")[0]).index());
				error.show();
				app.scrollTo(cr, -200);
			},

			highlight: function (element) { // hightlight error inputs
				$(element)
					.closest('.form-group').removeClass('has-success').addClass('has-error'); // set error class to the control group
			},

			unhighlight: function (element) { // revert the change done by hightlight
				$(element)
					.closest('.form-group').removeClass('has-error'); // set error class to the control group
			},

			success: function (label) {
				
			},
			errorPlacement: function (error, element) {

				switch($(element).attr("name")){
					case "accept_contract":
						error.appendTo($(element.parents(".form-group")[0]).find(".error_msg"));
					break;
					default:
						error.insertAfter(element);
					break;
				}
			},
			submitHandler: function (form) {
				error.hide();
				payment_error.hide();
			}

		});
		
		form.submit(function (e){ e.preventDefault(); });

		var displayConfirm = function() {
			$('#validation .form-control-static', form).each(function(){
				if($(this).attr("data-display")=="amount"){
					$("strong", this).html($('[name="offer"]:checked', form).attr("data-amount"));
					return;
				}

				var input = $('[name="'+$(this).attr("data-display")+'"]', form);
				if (input.is(":radio")) {
					input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
				}
				if (input.is("select")) {
					$("strong", this).html(input.find('option:selected').text());

				} else if (input.is(":radio") && input.is(":checked")) {
					$("strong", this).html(input.attr("data-title"));

				}else{
					$("strong", this).html(input.val());
				}
			});
		}

		var handleTitle = function(tab, navigation, index) {
			var total = navigation.find('li').length;
			var current = index + 1;
			// set wizard title
			$('.step-title', $('#page_wizard')).text('Step ' + (index + 1) + ' of ' + total);
			// set done steps
			jQuery('li', $('#page_wizard')).removeClass("done");
			var li_list = navigation.find('li');
			for (var i = 0; i < index; i++) {
				jQuery(li_list[i]).addClass("done");
			}

			if (current == 1) {
				$('#page_wizard').find('.button-previous').hide();
			} else {
				$('#page_wizard').find('.button-previous').show();
			}

			if (current >= total) {
				$('#page_wizard').find('.button-next').hide();
				$('#page_wizard').find('.button-submit').show();
				displayConfirm();
			} else {
				$('#page_wizard').find('.button-next').show();
				$('#page_wizard').find('.button-submit').hide();
			}
			app.scrollTo($('.page-title'));
		}

		$('#page_wizard').bootstrapWizard({
			'nextSelector': '.button-next',
			'previousSelector': '.button-previous',
			onTabClick: function (tab, navigation, index, clickedIndex) {
				return false;
			},
			onNext: function (tab, navigation, index) {
				error.hide();
				payment_error.hide();
			},
			onPrevious: function (tab, navigation, index) {
				error.hide();
				payment_error.hide();
			},
			onTabShow: function (tab, navigation, index) {
				var total = navigation.find('li').length;
				var current = index + 1;
				var $percent = (current / total) * 100;
				$('#page_wizard').find('.progress-bar').css({
					width: $percent + '%'
				});
				handleTitle(tab, navigation, index);
			}
		});

		$('#page_wizard').find('.button-previous').hide();
		$('#page_wizard .button-submit').click(function (e){
			if(!form.valid()) return false;

			app.blockUI({iconOnly:true, animate:true});
			$.ajax({
				url: location.href,
				type: "POST",
				data: $(form).serialize(),
				success: function (rslt) {
					app.unblockUI();
					try{
						p=JSON.parse(rslt);
						switch(p.status){
							case "success":
								if(p.params.payment_recipt) $("#success_msg .payment_recipt").html(p.params.payment_recipt);
								else $("#success_msg .payment_recipt").parent().hide();
								$("#success_msg .goto_job").attr("href", p.params.job_url);
								$("#page_wizard").remove();
								$("#success_msg").show();
							break;
							case "already_done":
								$("#already_done_msg .payment_recipt").html(p.params.payment_recipt);
								$("#already_done_msg .goto_job").attr("href", p.params.job_url);
								$("#page_wizard").remove();
								$("#already_done_msg").show();
							break;
							case "invalid_card_number":
								$('#page_wizard').bootstrapWizard("show",1); // goto payment page
								formvalidator.showErrors({credit_card_number: $("[name=credit_card_number]", form).attr("data-msg-error")});
							break;
							case "error_card_password":
								$('#page_wizard').bootstrapWizard("show",1); // goto payment page
								formvalidator.showErrors({credit_card_password: $("[name=credit_card_password]", form).attr("data-msg-error")});
							break;
							case "insufficient_balance":
								$('#page_wizard').bootstrapWizard("show",1); // goto payment page
								formvalidator.showErrors({credit_card_number: $("[name=credit_card_number]", form).attr("data-msg-balance-error")});
							break;
							case "unhandled_payment_error":
								$('#page_wizard').bootstrapWizard("show",1); // goto payment page
								payment_error.show();
							break;
							default:
								console.log(p);
								return false;
							break;
						}
					}catch(ex){
						console.log(rslt);
						return false;
					}
				},
				error: function (rslt) {
					app.unblockUI();
					console.log(rslt);
					return false;
				}
			});
		}).hide();
		
		$('a[data-toggle="tab"].payment_type').on('shown.bs.tab', function (e) {
			var target = $(e.target).attr("href");
			switch(target){
				case "local_pay":
					$(".agent_warning").show();
					$(".agent_request_success").hide();

					$("[name=agent_code]", form).rules( "add", {
						required: true
					});
					$("[name=credit_card_number]", form).val("");
					$("[name=credit_card_password]", form).val("");
					$("[name=credit_card_number]", form).rules( "remove" );
					$("[name=credit_card_password]", form).rules( "remove" );
				break;
				case "pay_online":
					$("[name=credit_card_number]", form).rules( "add", {
						required: true, creditcard: true
					});
					$("[name=credit_card_password]", form).rules( "add", {
						required: true
					});
					$("[name=agent_code]", form).val("");
					$("[name=agent_code]", form).rules( "remove" );
				break;
			}
		});

		$(".get_agent").click(function () {
			$.post(location.href, {request_agent:true}, function (rslt) {
				try{
					p=JSON.parse(rslt);
					if(p.status="success"){
						$(".agent_warning").hide();
						$(".agent_request_success").show();
					}else{
						console.log(rslt);
					}
				}catch(ex){
					console.log(rslt);
				}
			}).fail(function (rslt) {
				console.log(rslt);
			});
		});
	}
});
