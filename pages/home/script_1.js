page_script({
	init: function () {

        // posts plugin init

		salvattore.rescanMediaQueries();
		setTimeout(function (){
			if($(window).width()>768 && $(".home-news").attr("data-columns")==1) salvattore.rescanMediaQueries();
		},500);
		
		// add news items sample
		/*
		var item = $('<article>',{text:"aaa"})[0];
		salvattore['prepend_elements']($(".home-news")[0], [item]);

		var item = $('<article>',{text:"aaa"})[0];
		salvattore['append_elements']($(".home-news")[0], [item]);
		*/

		/*
		$("#search_form .autocomplete").tagit({
			placeholderText: $("#search_form .autocomplete").attr("placeholder"),
			afterTagAdded: function () {
				$("#search_form .autocomplete .tagit-new input").attr("placeholder","");
			},
			afterTagRemoved: function () {
				if($("#search_form ul.autocomplete").tagit("assignedTags").length == 0)
				$("#search_form .autocomplete .tagit-new input").attr("placeholder",$("#search_form .autocomplete").attr("placeholder"));
			},
			tagSource: function( request, response ) {
	            $.ajax({
	                url: location.origin + "/search/autocomplete", 
	                data: { term:request.term },
	                dataType: "json",
	                success: function( data ) {
	                    response( $.map( data, function( item ) {
	                        return { label: item }
	                    }));
	                }
	            });
	        }
		});
		*/

		// process search form submit event
		$("#search_form").submit(function (e) {
			e.preventDefault();
			//Layout.ajaxify(location.origin + "/search?q=" + $(this).find("ul.autocomplete").tagit("assignedTags").join(" "));
			Layout.ajaxify(location.origin + "/search?q=" + $(this).find(".query").val());
		});

	}
});
