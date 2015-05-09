page_script({
	init: function () {
		var myLatlng = new google.maps.LatLng(33.881967, 9.560764);
		var mapOptions = {
			scrollwheel: false,
		  	zoom: 6,
		  	center: myLatlng
		}
		var map = new google.maps.Map($("#map")[0], mapOptions);
		var marker = new google.maps.Marker({
		    position: myLatlng
		});
		marker.setMap(map);

	}
});
