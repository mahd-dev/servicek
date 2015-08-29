page_script({
	init: function () {

		$(".tree .dropdown-toggle").click(function () {
			$($(this).parents('li')[0]).children('ul').toggleClass('collapsed');
		});

		// process search form submit event
		$("#search_form").submit(function (e) {
			e.preventDefault();
			//app.ajaxify(location.origin + "/search?q=" + $(this).find("ul.autocomplete").tagit("assignedTags").join(" "));
			app.ajaxify(location.origin + "/search?q=" + $(this).find(".query").val());
		});

		$(".tree input[type=checkbox], .type input[type=checkbox]").change(function (e) {
			if(e.originalEvent) $($(this).parents('li')[0]).children('ul').find('input[type=checkbox]').attr("checked", $(this).is(":checked"));

			var params = {
				ca : [],
				lo : []
			};
			if(!$(".type .job").is(":checked") || !$(".type .shop").is(":checked") || !$(".type .company").is(":checked")){
				if($(".type .job").is(":checked")) params.jo = 1;
				if($(".type .shop").is(":checked")) params.sh = 1;
				if($(".type .company").is(":checked")) params.co = 1;
			}

			$(".categories input[type=checkbox]").each(function(index, el) {
				var p = $(this);
				var check = p.is(":checked");
				do {
					p = $($("input[type=checkbox]", $(p.parents('li')[1]))[0]);
					if(p.is(":checked")) check = false;
				} while(p.length && check);

				if(check) params.ca.push($(this).attr("data-id"));
			});
			$(".localities input[type=checkbox]").each(function(index, el) {
				var p = $(this);
				var check = p.is(":checked");
				do {
					p = $($("input[type=checkbox]", $(p.parents('li')[1]))[0]);
					if(p.is(":checked")) check = false;
				} while(p.length && check);

				if(check) params.lo.push($(this).attr("data-id"));
			});
			$(".items_container").empty();
			var req_params = $.param(params);
			history.pushState({href: "/",method: "GET",params: req_params}, document.title, "/" + (req_params?"?":"") + req_params);
			params.fetchdata=true;
			$.get("/",$.param(params), function (r) {
				try {
					var p = JSON.parse(r);
					$(".filter-title").text(p.title);
					if(p.rslt.length){
						p.rslt.forEach(function(el) {
							var itm = $("#item_template").clone().removeAttr('id');
							itm.find('[href]').attr('href', decodeURI(el.url));
							itm.find('[data-href]').attr('data-href', decodeURI(el.url));
							itm.find('.image').attr('style', "background-image:url('" + el.image_url + "');");
							itm.find('.title-text').text(el.title);
							itm.find('.content-text').text(el.content);
							itm.appendTo('.items_container').show();
						});
						window.fbAsyncInit();
					}
					if(p.empty) $(".home").show();
					else $(".home").hide();
					
				} catch (e) {
					console.log(r);
				}
			});
		});
	}
});
