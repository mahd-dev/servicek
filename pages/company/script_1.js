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

		var current_item;

		$(".ps").click(function () {
			var b = $(this);
			current_item = b.parent();
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

			var ps;
			switch (current_item.parent(".tab-pane").attr("id")) {
				case "products": ps="product"; break;
				case "services": ps="service"; break;
			}
			history.pushState(undefined, document.title, $("input[name=root_url]").val() + "/" + ps + "/" + b.attr("data-id"));

			m.modal("show");
		});

		$(".modal .next").click(function () {
			var l = current_item.parent().children().length;
			var p = current_item.index();
			if(p>=l-1) current_item.parent().children().eq(0).find('.ps').click();
			else current_item.parent().children().eq(p+1).find('.ps').click();
		});
		$(".modal .previous").click(function () {
			var l = current_item.parent().children().length;
			var p = current_item.index();
			if(p<=0) current_item.parent().children().eq(l-1).find('.ps').click();
			else current_item.parent().children().eq(p-1).find('.ps').click();
		});

		if($("input[name=ps_id]").length==1){
			setTimeout(function () {
				switch ($("input[name=ps_type]").val()) {
					case 'product': $("a[href=#products]").click(); $("#products .ps[data-id=" + $("input[name=ps_id]").val() + "]").click(); break;
					case 'service': $("a[href=#services]").click(); $("#services .ps[data-id=" + $("input[name=ps_id]").val() + "]").click(); break;
				}
			},1000);
		}

		$("#show_ps").on("hide.bs.modal", function () {
			history.pushState(undefined, document.title, $("input[name=root_url]").val());
		});

	}
});
