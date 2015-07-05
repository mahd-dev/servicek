page_script({
	init: function () {
		$('input[name=type]').change(function(){
			$('a[href=#title' + $("input[name=type]:checked").val() +']').tab('show');
		});
		// NEW JOB Start
		// handling geolocation picker

		if(!navigator.geolocation){
			var main = $("#job_find_my_position").parents(".input-group");
			main.before($("input",main));
			main.remove();
		}

		$('#job_geolocation').locationpicker({
			location: {latitude: 33.881967, longitude: 9.560764},
			radius: 0,
			zoom: 6,
			enableAutocomplete: true,
			scrollwheel: false,
			inputBinding: {
				locationNameInput: $('#job_submit_form [name=job_address]'),
				latitudeInput: $('#job_submit_form [name=job_latitude]'),
				longitudeInput: $('#job_submit_form [name=job_longitude]'),
			}
		});
		$("#job_find_my_position").click(function (e) {
			e.preventDefault();
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (position) {
					$('#job_submit_form [name=job_latitude]').val(position.coords.latitude).change();
					$('#job_submit_form [name=job_longitude]').val(position.coords.longitude).change();
				});
			}
		});


		// handling wizard
		var form = $('#job_submit_form');
		var error = $('.alert-danger.form-error', form);

		var formvalidator = form.validate({
			ignore: "",
			errorElement: 'span',
			errorClass: 'help-block help-block-error',
			focusInvalid: true,
			rules: {

				name: {minlength: 3, maxlength: 255, required: true},
				description: {minlength: 50, maxlength: 4095, required: true},
				categories: {required: true},
				address: {required: true},
				longitude: {required: true},
				latitude: {required: true},
				tel: {required: true},
				email: {required: true}

			},

			invalidHandler: function (event, validator) { //display error alert on form submit
				error.show();
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

				switch($(element).attr("job_name")){
					default:
						error.insertAfter(element);
					break;
				}
			},
			submitHandler: function (form) {
				error.hide();
			}

		});

		$("[name='job_categories[]']", form).select2();

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

		$("[name=job_name]", form).focus();
		// NEW JOB End

		// NEW CAMPANY Start
		// handling geolocation picker

		if(!navigator.geolocation){
			var main = $("#company_find_my_position").parents(".input-group");
			main.before($("input",main));
			main.remove();
		}

		$('#company_geolocation').locationpicker({
			location: {latitude: 33.881967, longitude: 9.560764},
			radius: 0,
			zoom: 6,
			enableAutocomplete: true,
			scrollwheel: false,
			inputBinding: {
				locationNameInput: $('#company_submit_form [name=company_address]'),
				latitudeInput: $('#company_submit_form [name=company_latitude]'),
				longitudeInput: $('#company_submit_form [name=company_longitude]'),
			}
		});
		$("#company_find_my_position").click(function (e) {
			e.preventDefault();
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function (position) {
					$('#company_submit_form [name=company_latitude]').val(position.coords.latitude).change();
					$('#company_submit_form [name=company_longitude]').val(position.coords.longitude).change();
				});
			}
		});

		// handling wizard
		var form = $('#company_submit_form');
		var error = $('.alert-danger.form-error', form);

		var formvalidator = form.validate({
			ignore: "",
			errorElement: 'span',
			errorClass: 'help-block help-block-error',
			focusInvalid: true,
			rules: {

				name: {minlength: 3, maxlength: 255, required: true},
				description: {minlength: 50, maxlength: 4095, required: true},
				categories: {required: true},
				url: {
					minlength: 5,
					remote: {
						url: location.href,
						type: "post",
						data: {
							check_url: function() {
								return $("[name=company_url]",form).val();
							}
						}
					}
				},

				address: {required: true},
				longitude: {required: true},
				latitude: {required: true},
				tel: {required: true},
				email: {required: true}

			},

			invalidHandler: function (event, validator) { //display error alert on form submit
				error.show();
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

				switch($(element).attr("company_name")){
					case "url":
						error.appendTo($(element.parents(".form-group")[0]).find(".error_msg"));
					break;
					default:
						error.insertAfter(element);
					break;
				}
			},
			submitHandler: function (form) {
				error.hide();
			}

		});

		$("[name='company_categories[]']", form).select2();

		form.submit(function (e){
			if(!form.valid()){
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
								$("#success_msg .goto_company").attr("href", p.params.company_url);
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
		$("[name=company_name]", form).focus();
		// NEW CAMPANY End

	}
});
