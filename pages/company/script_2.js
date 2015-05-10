page_script({
	init: function () {
		$.fn.editable.defaults.ajaxOptions = {type: "POST"};
		$.fn.editable.defaults.type = 'text';
		$.fn.editable.defaults.pk = 1;
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = location.href;
        $.fn.editable.defaults.onblur = 'submit';
        
        $(".editable").editable({params:function (p) { p.for="company"; return p; }});
		$(".seat_editable").editable({params:function (p) { p.for="seat"; return p; }});
		$(".product_editable").editable({params:function (p) { p.for="product"; return p; }});
		$(".service_editable").editable({params:function (p) { p.for="service"; return p; }});

		$(".map-canvas").each(function (){
			$(this).locationpicker({
				location: {latitude: $(this).attr("data-latitude"), longitude: $(this).attr("data-longitude")},
				radius: 0,
				zoom: 13,
				enableAutocomplete: true,
				scrollwheel: false,
				onchanged: function(currentLocation, radius, isMarkerDropped) {
					$.ajax({
						url: location.href,
						type: "POST",
						data: {geolocation:$(this).attr("data-pk"), latitude:currentLocation.latitude, longitude:currentLocation.longitude},
						success: function (rslt) {
							try{
								var p = JSON.parse(rslt);
								if(p.status!="success") console.log(rslt);
							}catch(ex){
								console.log(rslt);
							}
						},
						error: function (rslt) {
							console.log(rslt);
						}
					});
				}
			});
		});

		$(".new_service").click(function (e) {
			$.ajax({
				url: location.href,
				type: "POST",
				data: {new_service:true},
				success: function (rslt) {
					try{
						var p = JSON.parse(rslt);
						switch(p.status){
							case "success":
								var new_element = $("#new_service_template").clone();
								
								new_element.attr("data-id", p.id);
								$(".service_editable", new_element).attr("data-pk", p.id).editable({params:function (p) { p.for="service"; return p; }});
								$(".delete", new_element).click(function (e) {service_delete(e, this);});
								$("input[type=file]", new_element).change(function (e) {service_image_change(e, this);});

								new_element.prependTo("#services_list").show();

								$("[href='#services_list']").click();
								app.scrollTo(new_element, -200);
								new_element.pulsate({color: "#399bc3",repeat: 2});
							break;
							default:
								console.log(rslt);
							break;
						}
					}catch(ex){
						console.log(rslt);
					}
				},
				error: function (rslt) {
					console.log(rslt);
				}
			});
		});

		$(".new_product").click(function (e) {
			$.ajax({
				url: location.href,
				type: "POST",
				data: {new_product:true},
				success: function (rslt) {
					try{
						var p = JSON.parse(rslt);
						switch(p.status){
							case "success":
								var new_element = $("#new_product_template").clone();
								
								new_element.attr("data-id", p.id);
								$(".product_editable", new_element).attr("data-pk", p.id).editable({params:function (p) { p.for="product"; return p; }});
								$(".delete", new_element).click(function (e) {product_delete(e, this);});
								$("input[type=file]", new_element).change(function (e) {product_image_change(e, this);});

								new_element.prependTo("#products_list").show();

								$("[href='#products_list']").click();
								app.scrollTo(new_element, -200);
								new_element.pulsate({color: "#399bc3",repeat: 2});
							break;
							default:
								console.log(rslt);
							break;
						}
					}catch(ex){
						console.log(rslt);
					}
				},
				error: function (rslt) {
					console.log(rslt);
				}
			});
		});

		var product_delete = function (e, btn) {
			e.preventDefault();
			var container = $(btn).parents(".product");
			$.ajax({
				url: location.href,
				type: "POST",
				data: {delete_product : container.attr("data-id")},
				success: function (rslt) {
					try{
						var p = JSON.parse(rslt);
						switch(p.status){
							case "success":
								container.remove();
							break;
							default:
								console.log(rslt);
							break;
						}
					}catch(ex){
						console.log(rslt);
					}
				},
				error: function (rslt) {
					console.log(rslt);
				}
			});
		};

		var service_delete = function (e, btn) {
			e.preventDefault();
			var container = $(btn).parents(".service");
			$.ajax({
				url: location.href,
				type: "POST",
				data: {delete_service : container.attr("data-id")},
				success: function (rslt) {
					try{
						var p = JSON.parse(rslt);
						switch(p.status){
							case "success":
								container.remove();
							break;
							default:
								console.log(rslt);
							break;
						}
					}catch(ex){
						console.log(rslt);
					}
				},
				error: function (rslt) {
					console.log(rslt);
				}
			});
		};

		$(".service .delete").click(function (e) {service_delete(e, this);});
		$(".product .delete").click(function (e) {product_delete(e, this);});

		var product_image_change = function (e, input) {
			if(input.files.length == 0) return;
        	var form = $(".product form");
        	var fd = new FormData(form[0]);
            fd.append("file", "product_image");
            fd.append("pk", $(input).parents(".product").attr("data-id"));
            $.ajax({
				url: location.href,
				type: "POST",
				data: fd,
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				success: function (rslt) {
					if(rslt!="success") console.log(rslt);
				},
				error: function (rslt) {
					console.log(rslt);
				}
            });
		};

		var service_image_change = function (e, input) {
			if(input.files.length == 0) return;
        	var form = $(".service form");
        	var fd = new FormData(form[0]);
            fd.append("file", "service_image");
            fd.append("pk", $(input).parents(".service").attr("data-id"));
            $.ajax({
				url: location.href,
				type: "POST",
				data: fd,
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				success: function (rslt) {
					if(rslt!="success") console.log(rslt);
				},
				error: function (rslt) {
					console.log(rslt);
				}
            });
		};

		$(".service input[type=file]").change(function (e) {service_image_change(e, this);});
		$(".product input[type=file]").change(function (e) {product_image_change(e, this);});

		$(".logo input[type=file]").change(function (e) {
        	if(this.files.length == 0) return;
        	var form = $(".logo form");
        	var fd = new FormData(form[0]);
            fd.append("file", "logo");
            $.ajax({
				url: location.href,
				type: "POST",
				data: fd,
				enctype: 'multipart/form-data',
				processData: false,
				contentType: false,
				success: function (rslt) {
					if(rslt!="success") console.log(rslt);
				},
				error: function (rslt) {
					console.log(rslt);
				}
            });
        	
        });

	}
});
