page_script({
	init: function () {
		$.fn.editable.defaults.ajaxOptions = {type: "POST"};
		$.fn.editable.defaults.type = 'text';
		$.fn.editable.defaults.pk = 1;
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = location.href;
        $.fn.editable.defaults.onblur = 'submit';
        
        $('.editable').editable();

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
