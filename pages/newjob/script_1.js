page_script({
	init: function () {

		// handling geolocation picker

		if(!navigator.geolocation){
			var main = $("#find_my_position").parents(".input-group");
			main.before($("input",main));
			main.remove();
		}

		$('#geolocation').locationpicker({
			location: {latitude: 33.881967, longitude: 9.560764},
			radius: 0,
			zoom: 6,
			enableAutocomplete: true,
			scrollwheel: false,
			inputBinding: {
				locationNameInput: $('#submit_form [name=address]'),
				latitudeInput: $('#submit_form [name=latitude]'),
				longitudeInput: $('#submit_form [name=longitude]'),
			}
		});
		$("#find_my_position").click(function (e) {
			e.preventDefault();
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (position) {
					$('#submit_form [name=latitude]').val(position.coords.latitude).change();
					$('#submit_form [name=longitude]').val(position.coords.longitude).change();
				});
			}
		});


		// handling wizard
		var form = $('#submit_form');
		var error = $('.alert-danger.form-error', form);

		var formvalidator = form.validate({
			ignore: "",
			errorElement: 'span',
			errorClass: 'help-block help-block-error',
			focusInvalid: true,
			rules: {
				
				name: {minlength: 3, maxlength: 255, required: true},
				description: {minlength: 50, maxlength: 4095, required: true},
				address: {required: true},
				longitude: {required: true},
				latitude: {required: true},
				tel: {required: true},
				email: {required: true}
				
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
					default:
						error.insertAfter(element);
					break;
				}
			},
			submitHandler: function (form) {
				error.hide();
			}

		});
		
		form.submit(function (e){
			if(!form.valid()) {
				e.preventDefault();
				return false;
			}

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
								$("#success_msg .goto_job").attr("href", p.params.job_url);
								$("#page_wizard").remove();
								$("#success_msg").show();
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
		});

		$("[name=name]", form).focus();
	}
});
