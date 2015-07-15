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


		$(".skill_editable").editable({ params:function (p) { p.element="skill"; return p; }});
		$(".cv_editable").editable({ params:function (p) { p.element="cv"; return p; }});
		$(".cv_item_editable").editable({ params:function (p) { p.element="cv_item"; return p; }});
		$(".cv_item_project_editable").editable({ params:function (p) { p.element="cv_item_project"; return p; }});

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
						data: {geolocation:true, latitude:currentLocation.latitude, longitude:currentLocation.longitude},
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
	}
});
