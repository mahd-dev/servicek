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

		$(".map-canvas").each(function () {
        	var myLatlng = new google.maps.LatLng($(this).attr("data-latitude"), $(this).attr("data-longitude"));
			var mapOptions = {
				scrollwheel: false,
			  	zoom: 13,
			  	center: myLatlng
			}
			var map = new google.maps.Map($(this)[0], mapOptions);
			var marker = new google.maps.Marker({
			    position: myLatlng
			});
			marker.setMap(map);
        });

		$("#new_product_modal form").submit(function (e) {
			e.preventDefault();
			var new_product_form = $(this);
			$.ajax({
				url: location.href,
				type: "POST",
				data: $(new_product_form).serialize(),
				success: function (rslt) {
					try{
						var p = JSON.parse(rslt);
						switch(p.status){
							case "success":
								var new_element = $("#new_product_template").clone();
								
								new_element.attr("data-id", p.id);
								$(".name", new_element).text($("[name='product_name']", new_product_form).val()).attr("data-pk", p.id);
								$(".description", new_element).text($("[name='product_description']", new_product_form).val()).attr("data-pk", p.id);
								$(".price", new_element).text($("[name='product_price']", new_product_form).val()).attr("data-pk", p.id);
								$(".product_editable", new_element).editable({params:function (p) { p.for="product"; return p; }});

								$("#new_product_modal").modal('hide');
								new_product_form[0].reset();

								new_element.prependTo("#products_list").show();

								$("[href='#products_list']").click();

								new_element.pulsate({color: "#399bc3",repeat: false});
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

		$("#new_service_modal form").submit(function (e) {
			e.preventDefault();
			var new_service_form = $(this);
			$.ajax({
				url: location.href,
				type: "POST",
				data: $(new_service_form).serialize(),
				success: function (rslt) {
					try{
						var p = JSON.parse(rslt);
						switch(p.status){
							case "success":
								var new_element = $("#new_service_template").clone();
								
								new_element.attr("data-id", p.id);
								$(".name", new_element).text($("[name='service_name']", new_service_form).val()).attr("data-pk", p.id);
								$(".description", new_element).text($("[name='service_description']", new_service_form).val()).attr("data-pk", p.id);
								$(".price", new_element).text($("[name='service_price']", new_service_form).val()).attr("data-pk", p.id);
								$(".service_editable", new_element).editable({params:function (p) { p.for="service"; return p; }});

								$("#new_service_modal").modal('hide');
								new_service_form[0].reset();

								new_element.prependTo("#services_list").removeAttr("id").show();

								$("[href='#services_list']").click();

								new_element.pulsate({color: "#399bc3",repeat: false});
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
		

		$(".product .delete").live("click", function (e) {
			e.preventDefault();
			var container = $(this).parents(".product");
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
		});

		$(".service .delete").live("click", function (e) {
			e.preventDefault();
			var container = $(this).parents(".service");
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
		});

	}
});
