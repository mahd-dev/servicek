page_script({
	init: function () {
		var myLatlng = new google.maps.LatLng(35.86384047540425, 10.544368078851221);
		var mapOptions = {
			scrollwheel: false,
		  	zoom: 13,
		  	center: myLatlng
		}
		var map = new google.maps.Map($("#contactmap")[0], mapOptions);
		var marker = new google.maps.Marker({
		    position: myLatlng
		});
		marker.setMap(map);
	}
});
