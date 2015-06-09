page_script({
	init: function () {

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

		$('a[data-toggle="tab"].sp_tabs').on('shown.bs.tab', function (e) {
			$($(e.target).attr("href")).masonry();
		});
		settimeout(function (){
        	$('.js-masonry').masonry();
        },1000);

	}
});
