page_script({
	init: function () {

		$.fn.editable.defaults.ajaxOptions = {type: "POST"};
		$.fn.editable.defaults.type = 'text';
		$.fn.editable.defaults.pk = 1;
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = location.href;
    $.fn.editable.defaults.onblur = 'submit';
    $.fn.editable.defaults.emptytext = 'Vide';

    $(".editable").editable({params:function (p) { p.element="shop"; return p; }});
    if($(".categories-editable").length>0){
      $('.categories-editable').editable({
      	mode: "popup",
      	inputclass: "input-medium",
      	params:function (p) { p.element="shop"; return p; },
      	select2: {multiple: true},
      	source: JSON.parse($('.categories-editable').attr("data-available"))
      });
    }
		$(".seat_editable").editable({params:function (p) { p.element="seat"; return p; }});
		$(".product_editable").editable({mode:"popup", params:function (p) { p.element="product"; return p; }});
		$(".product_categories_editable").editable({
			mode:"popup",
			params:function (p) { p.element="product"; return p; },
			source: JSON.parse($("input[name=available_product_categories]").val()),
			select2: {
           multiple: true
        }
		});
		$(".service_editable").editable({mode:"popup", params:function (p) { p.element="service"; return p; }});
		$(".service_categories_editable").editable({
			mode:"popup",
			params:function (p) { p.element="service"; return p; },
			source: JSON.parse($("input[name=available_service_categories]").val()),
			select2: {
           multiple: true
        }
		});

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
								new_element.removeAttr("id");
								new_element.prependTo("#products_list").show();

								new_element.attr("data-id", p.id);
								$(".product_editable", new_element).attr("data-pk", p.id).editable({value:null, mode:"popup", params:function (p) { p.element="product"; return p; }});
								$(".product_categories_editable", new_element).attr("data-pk", p.id).editable({
									value: [],
									mode:"popup",
									params:function (p) { p.element="product"; return p; },
									source: JSON.parse($("input[name=available_product_categories]").val()),
									select2: {
						           multiple: true
						        }
								});
								$(".delete", new_element).click(function (e) {product_delete(e, this);});
								$("input[type=file]", new_element).change(function (e) {product_image_change(e, this);});
								$(".price_checkbox", new_element).change(price_checkbox);
								$(".rent_price_checkbox", new_element).change(rent_price_checkbox);
								$(".fb-like", new_element).attr("data-href", p.url);
								window.fbAsyncInit();

								$("[href='#products_list']").click();
								//app.scrollTo(new_element, -200);
								$($(".thumbnail", new_element)[0]).pulsate({color: "#399bc3",repeat: 2});
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

		var price_checkbox = function (e) {
			var container = $(this).parents("p");
			var ed = $("[data-name=price]", container);
			var unit = $(".unit", container);
			if($(this).prop('checked')){
				ed.editable('enable');
				unit.show();
			}else{
				$.post(location.href, {element: (ed.hasClass("product_editable")?"product":"service"), pk: ed.attr("data-pk"), name: "price", value: null}, function (rslt) {
					ed.editable('setValue', null).editable('submit').editable('disable');
					unit.hide();
				});

			}
		};
		var rent_price_checkbox = function (e) {
			var container = $(this).parents("p");
			var ed = $("[data-name=rent_price]", container);
			var unit = $(".unit", container);
			if($(this).prop('checked')){
				ed.editable('enable');
				unit.show();
			}else{
				$.post(location.href, {element: (ed.hasClass("product_editable")?"product":"service"), pk: ed.attr("data-pk"), name: "rent_price", value: null}, function (rslt) {
					ed.editable('setValue', null).editable('submit').editable('disable');
					unit.hide();
				});

			}
		};

		$(".price_checkbox").change(price_checkbox);
		$(".rent_price_checkbox").change(rent_price_checkbox);

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

		$(".image input[type=file]").change(function (e) {
    	if(this.files.length == 0) return;
    	var form = $(".image form");
    	var fd = new FormData(form[0]);
      fd.append("file", "image");
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

    $(".cover input[type=file]").change(function (e) {
    	if(this.files.length == 0) return;
    	var form = $(".cover form");
    	var fd = new FormData(form[0]);
      fd.append("file", "cover");
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

		window.fbAsyncInit();
	}
});
