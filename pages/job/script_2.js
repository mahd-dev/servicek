page_script({
	init: function () {
		$.fn.editable.defaults.ajaxOptions = {type: "POST"};
		$.fn.editable.defaults.type = 'text';
		$.fn.editable.defaults.pk = 1;
		$.fn.editable.defaults.mode = 'popup';
		$.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = location.href;
    $.fn.editable.defaults.onblur = 'submit';
    $.fn.editable.defaults.emptytext = 'Vide';

    $('.editable').editable();
    if($(".categories-editable").length>0){
      $('.categories-editable').editable({
      	mode: "popup",
      	inputclass: "input-medium",
      	select2: {multiple: true},
      	source: JSON.parse($('.categories-editable').attr("data-available"))
      });
   	}

		$(".portfolio_editable").editable({mode:"popup", params:function (p) { p.element="portfolio"; return p; }});
		$(".portfolio_categories_editable").editable({
			mode:"popup",
			params:function (p) { p.element="portfolio"; return p; },
			source: JSON.parse($("input[name=available_portfolio_categories]").val()),
			select2: {
           multiple: true
        }
		});

		$(".skill_editable").editable({ params:function (p) { p.element="skill"; return p; }});
		$(".cv_editable").editable({ params:function (p) { p.element="cv"; return p; }});
		$(".cv_item_editable").editable({ params:function (p) { p.element="cv_item"; return p; }});
		$(".cv_item_project_editable").editable({ params:function (p) { p.element="cv_item_project"; return p; }});

		$(".new_portfolio").click(function (e) {
			$.ajax({
				url: location.href,
				type: "POST",
				data: {new_portfolio:true},
				success: function (rslt) {
					try{
						var p = JSON.parse(rslt);
						switch(p.status){
							case "success":
								var new_element = $("#new_portfolio_template").clone();
								new_element.removeAttr("id");
								new_element.prependTo(".portfolio_container").show();

								new_element.attr("data-id", p.id);
								$(".portfolio_editable", new_element).attr("data-pk", p.id).editable({value:null, mode:"popup", params:function (p) { p.element="portfolio"; return p; }});
								$(".portfolio_categories_editable", new_element).attr("data-pk", p.id).editable({
									value: [],
									mode:"popup",
									params:function (p) { p.element="portfolio"; return p; },
									source: JSON.parse($("input[name=available_portfolio_categories]").val()),
									select2: {
					          multiple: true
					        }
								});
								$(".delete", new_element).click(function (e) {portfolio_delete(e, this);});
								$("input[type=file]", new_element).change(function (e) {portfolio_image_change(e, this);});
								$(".price_checkbox", new_element).change(price_checkbox);
								$(".rent_price_checkbox", new_element).change(rent_price_checkbox);
								$(".fb-like", new_element).attr("data-href", p.url);
								window.fbAsyncInit();

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
		var portfolio_delete = function (e, btn) {
			e.preventDefault();
			var container = $(btn).parents(".portfolio");
			$.ajax({
				url: location.href,
				type: "POST",
				data: {delete_portfolio : container.attr("data-id")},
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
		$(".portfolio .delete").click(function (e) {portfolio_delete(e, this);});
		var portfolio_image_change = function (e, input) {
			if(input.files.length == 0) return;
    	var form = $(".portfolio form");
    	var fd = new FormData(form[0]);
      fd.append("file", "portfolio_image");
      fd.append("pk", $(input).parents(".portfolio").attr("data-id"));
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
		$(".portfolio input[type=file]").change(function (e) {portfolio_image_change(e, this);});

		$(".remove_skill").live("click", function () {
			var container = $(this).parents(".skill_item");
			$.post(location.href, {remove: "skill", pk: container.attr("data-id")}, function(rslt){
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
			});
		});
		$(".remove_cv").live("click", function () {
			var container = $(this).parents(".cv_item");
			$.post(location.href, {remove: "cv", pk: container.attr("data-id")}, function(rslt){
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
			});
		});
		$(".remove_cv_item").live("click", function () {
			var container = $(this).parents(".cv_item_item");
			$.post(location.href, {remove: "cv_item", pk: container.attr("data-id")}, function(rslt){
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
			});
		});
		$(".remove_cv_item_project").live("click", function () {
			var container = $(this).parents(".cv_item_project_item");
			$.post(location.href, {remove: "cv_item_project", pk: container.attr("data-id")}, function(rslt){
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
			});
		});

		$(".add_skill").live('click', function () {
			var container = $(".skill_container");
			$.post(location.href, {add:"skill"}, function(rslt){
				try{
					var p = JSON.parse(rslt);
					switch(p.status){
						case "success":
							skill=$(".templates tr.skill_item").clone();
							skill.appendTo(container);
							skill.attr("data-id", p.id);
							$(".skill_editable", skill).attr("data-pk",p.id).editable({ params:function (p) { p.element="skill"; return p; }});
						break;
						default:
							console.log(rslt);
						break;
					}
				}catch(ex){
					console.log(rslt);
				}
			});
		});
		$(".add_cv").live('click', function () {
			var container = $(".cv_container");
			$.post(location.href, {add:"cv"}, function(rslt){
				try{
					var p = JSON.parse(rslt);
					switch(p.status){
						case "success":
							var cv = $(".templates .cv_item").clone();
							cv.appendTo(container);
							cv.attr("data-id", p.id);
							$(".cv_editable", cv).attr("data-pk",p.id).editable({ params:function (p) { p.element="cv"; return p; }});
						break;
						default:
							console.log(rslt);
						break;
					}
				}catch(ex){
					console.log(rslt);
				}
			});
		});
		$(".add_cv_item").live('click', function () {
			var container = $(this).parents(".cv_item").children(".panel-body").children(".cv_item_container");
			$.post(location.href, {add:"cv_item", cv: $(this).parents("[data-id]").attr("data-id")}, function(rslt){
				try{
					var p = JSON.parse(rslt);
					switch(p.status){
						case "success":
							var cv_item = $(".templates .cv_item_item").clone();
							cv_item.appendTo(container);
							cv_item.attr("data-id", p.id);
							$(".cv_item_editable", cv_item).attr("data-pk",p.id).editable({ params:function (p) { p.element="cv_item"; return p; }});
						break;
						default:
							console.log(rslt);
						break;
					}
				}catch(ex){
					console.log(rslt);
				}
			});
		});
		$(".add_cv_item_project").live('click', function () {
			var container = $(this).parents(".cv_item_item").children(".list-group").children(".cv_item_project_container");
			$.post(location.href, {add:"cv_item_project", cv_item: $(this).parents("[data-id]").attr("data-id")}, function(rslt){
				try{
					var p = JSON.parse(rslt);
					switch(p.status){
						case "success":
							var cv_item_project = $(".templates .cv_item_project_item").clone();
							cv_item_project.appendTo(container);
							cv_item_project.attr("data-id", p.id);
							$(".cv_item_project_editable", cv_item_project).attr("data-pk",p.id).editable({ params:function (p) { p.element="cv_item_project"; return p; }});
						break;
						default:
							console.log(rslt);
						break;
					}
				}catch(ex){
					console.log(rslt);
				}
			});
		});

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

		var map = $(".map_container .map-canvas");
		var myLatlng = new google.maps.LatLng(map.attr("data-latitude"), map.attr("data-longitude"));
		var mapOptions = {
			scrollwheel: false,
				zoom: 13,
				center: myLatlng
		}
		var map = new google.maps.Map(map[0], mapOptions);
		var marker = new google.maps.Marker({
				position: myLatlng
		});
		marker.setMap(map);

		$('#map_modal').on('shown.bs.modal', function (e) {
			$("#map_modal .map-canvas").each(function (){
				$(this).locationpicker({
					location: {latitude: $(this).attr("data-latitude"), longitude: $(this).attr("data-longitude")},
					radius: 0,
					zoom: 12,
					enableAutocomplete: true,
					scrollwheel: true,
					onchanged: function(currentLocation, radius, isMarkerDropped) {
						$.ajax({
							url: location.href,
							type: "POST",
							data: {geolocation:$(this).attr("data-pk"), latitude:currentLocation.latitude, longitude:currentLocation.longitude},
							success: function (rslt) {
								try{
									if(rslt=="success"){
										$(".map-canvas").attr("data-latitude", currentLocation.latitude);
										$(".map-canvas").attr("data-longitude", currentLocation.longitude);
										var map = $(".map_container .map-canvas");
										var myLatlng = new google.maps.LatLng(map.attr("data-latitude"), map.attr("data-longitude"));
										var mapOptions = {
											scrollwheel: false,
										  	zoom: 13,
										  	center: myLatlng
										}
										var map = new google.maps.Map(map[0], mapOptions);
										var marker = new google.maps.Marker({
										    position: myLatlng
										});
										marker.setMap(map);
									}else console.log(rslt);
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
		});

		$(".transform_shop").click(function() {
			if(!confirm("Etes vous sûr ?")) return false;
			$.post(location.href, {transform: "shop"}, function(rslt) {
				try{
					if(rslt=="success"){
						app.ajaxify(location.href);
					}else console.log(rslt);
				}catch(ex){
					console.log(rslt);
				}
			});
		});

		$(".transform_company").click(function() {
			if(!confirm("Etes vous sûr ?")) return false;
			$.post(location.href, {transform: "company"}, function(rslt) {
				try{
					if(rslt=="success"){
						app.ajaxify(location.href);
					}else console.log(rslt);
				}catch(ex){
					console.log(rslt);
				}
			});
		});

		$(".delete_page").click(function () {
			if(!confirm($(this).attr("data-confirm") + $('.profile-usertitle-name a[data-name="name"]').text())) return false;
			$.post(location.href, {remove_me: true}, function(rslt) {
				try{
					if(rslt=="success"){
						app.ajaxify("/account");
					}else console.log(rslt);
				}catch(ex){
					console.log(rslt);
				}
			});
		});

		if($(".messages .badge").length) $(".messages").pulsate({color: "#e91e63",repeat: 3});

		window.fbAsyncInit();
	}
});
