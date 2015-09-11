page_script({
	init: function () {


		var $grid = $('.grid').isotope({});
		$('.filter-button').click(function() {
		  var filterValue = $(this).attr('data-filter');
			console.log(filterValue);
		  $grid.isotope({ filter: filterValue });
		});

		var current_item = undefined;

		$(".po").click(function () {
			var b = $(this);
			current_item = b.parent();
			var m = $("#show_po");

			m.find(".modal-title").text(b.attr("data-name"));

			if(b.find(".prod_srv_image").length) m.find(".prod_srv_image").attr("style", "background-image:url(" + b.find(".prod_srv_image").attr("src") + ")").show();
			else m.find(".prod_srv_image").hide();

			if(b.attr("data-description")!="") m.find(".description").text(b.attr("data-description")).show();
			else m.find(".description").hide();

			history.pushState(undefined, document.title, b.attr("data-url"));
			m.find(".fb-like").attr("data-href", b.attr("data-url"));
			m.find(".fb-comments").attr("data-href", b.attr("data-url"));
			window.fbAsyncInit();

			m.modal("show");
		});

		$(".modal .next").click(function () {
			var l = current_item.parent().children(':visible').length;
			var p = current_item.index();
			if(p>=l-1) current_item.parent().children(':visible').eq(0).find('.po').click();
			else current_item.parent().children(':visible').eq(p+1).find('.po').click();
		});
		$(".modal .previous").click(function () {
			var l = current_item.parent().children(':visible').length;
			var p = current_item.index();
			if(p<=0) current_item.parent().children(':visible').eq(l-1).find('.po').click();
			else current_item.parent().children(':visible').eq(p-1).find('.po').click();
		});

		$(window).keydown(function (e) {
			if(current_item){
				switch (e.keyCode) {
					case 39: $(".modal .next").click(); break;
					case 37: $(".modal .previous").click(); break;
				}
			}
		});

		if($("input[name=po_id]").length==1){
			setTimeout(function () {
				$(".po[data-id=" + $("input[name=po_id]").val() + "]").click();
			},1000);
		}

		$("#show_po").on("hide.bs.modal", function () {
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
