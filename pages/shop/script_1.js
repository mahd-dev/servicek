page_script({
	init: function () {

		$('.property-carousel').owlCarousel({
			items: 3,
			itemsDesktop: [1199, 4],
			itemsDesktopSmall: [979, 3],
			itemsTablet: [768, 2],
			itemsTabletSmall: [1, 2],
			itemsMobile: false,
			navigation: true,
			navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
		});

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

		var current_item = undefined;

		$(".ps").click(function (e) {
			var b = $(this);
			current_item = b.parent().parent();
			var m = $("#show_ps");

			m.find(".modal-title").text(b.attr("data-name"));

			if(b.find(".prod_srv_image").length) m.find(".prod_srv_image").attr("style", "background-image:url(" + b.find(".prod_srv_image").attr("src") + ")").show();
			else m.find(".prod_srv_image").hide();

			if(b.attr("data-description")!="") m.find(".description").text(b.attr("data-description")).show();
			else m.find(".description").hide();

			if(b.attr("data-sale-price")!="") {
				m.find(".sale_price>.price_val").text(b.attr("data-sale-price"));
				m.find(".sale_price").show();
			} else m.find(".sale_price").hide();

			if(b.attr("data-rent-price")!="") {
				m.find(".rent_price>.price_val").text(b.attr("data-rent-price"));
				m.find(".rent_price").show();
			} else m.find(".rent_price").hide();

			if(e.originalEvent) history.pushState(undefined, document.title, b.attr("data-url"));
			m.find(".fb-like").attr("data-href", b.attr("data-url"));
			m.find(".fb-comments").attr("data-href", b.attr("data-url"));
			window.fbAsyncInit();

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

		$(window).keydown(function (e) {
			if(current_item){
				switch (e.keyCode) {
					case 39: $(".modal .next").click(); break;
					case 37: $(".modal .previous").click(); break;
				}
			}
		});

		if($("input[name=ps_id]").length==1){
			setTimeout(function () {
				$(".ps[data-id=" + $("input[name=ps_id]").val() + "]").click();
			},1000);
		}

		$("#show_ps").on("hide.bs.modal", function () {
			history.pushState(undefined, document.title, $("input[name=root_url]").val());
			current_item = undefined;
		});

		CKEDITOR.replace('message');
		CKEDITOR.instances.message.on('change', function() { CKEDITOR.instances.message.updateElement() });

		$("#message_form").ajaxForm({
			beforeSubmit: function () {
				$(".btn-loader", $("#message_modal")).show();
				$(".success_msg", $("#message_form")).hide();
				$(".unhandled_error", $("#message_form")).hide();
			},
			success: function (rslt) {
				$(".btn-loader", $("#message_modal")).hide();
				try{
          parsed=JSON.parse(rslt);
          if (parsed.status == "success") {
          	$(".success_msg", $("#message_form")).show();
						$("#message_form")[0].reset();
      		} else {
          	console.log(rslt);
            $(".unhandled_error", $("#message_form")).show();
          }
	      }catch(ex){
	        console.log(rslt);
	        $(".unhandled_error", $("#message_form")).show();
	      }
			}
		});
		$("#message_modal").on("hide.bs.modal", function () {
			$("#message_form")[0].reset();
			$(".success_msg", $("#message_form")).hide();
			$(".unhandled_error", $("#message_form")).hide();
		});

		$('#map_modal').on('shown.bs.modal', function (e) {
			$(".map-canvas", $(this)).each(function () {
	      var myLatlng = new google.maps.LatLng($(this).attr("data-latitude"), $(this).attr("data-longitude"));
				var mapOptions = {
					scrollwheel: true,
				  	zoom: 12,
				  	center: myLatlng
				}
				var map = new google.maps.Map($(this)[0], mapOptions);
				var marker = new google.maps.Marker({
				    position: myLatlng
				});
				marker.setMap(map);
	    });
		});

		window.fbAsyncInit();

	}
});
