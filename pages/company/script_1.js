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

		$(".ps").click(function (argument) {
			var b = $(this);
			var m = $("#show_ps");

			m.find(".modal-title").text(b.attr("data-name"));
			
			if(b.find(".prod_srv_image").length) m.find(".prod_srv_image").attr("src", b.find(".prod_srv_image").attr("src")).show();
			else m.find(".prod_srv_image").hide();
			
			if(b.attr("data-description")!="") m.find(".description").text(b.attr("data-description")).show();
			else m.find(".description").hide();

			if(b.attr("data-sale-price")!="") m.find(".sale_price>.price_val").text(b.attr("data-sale-price")).show();
			else m.find(".sale_price").hide();

			if(b.attr("data-rent-price")!="") m.find(".rent_price>.price_val").text(b.attr("data-rent-price"));
			else m.find(".rent_price").hide();

			m.modal("show");
		});
	}
});
