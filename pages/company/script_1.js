page_script({
	init: function () {

		salvattore.rescanMediaQueries();
		setTimeout(function (){
			if($(window).width()>768 && $(".home-news").attr("data-columns")==1) salvattore.rescanMediaQueries();
		},500);
		
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

	}
});
