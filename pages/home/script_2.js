page_script({
	init: function () {

		// posts plugin init

		salvattore.rescanMediaQueries();
		setTimeout(function (){
			if($(window).width()>768 && $(".home-news").attr("data-columns")==1) salvattore.rescanMediaQueries();
		},500);
		
		// add news items sample
		/*
		var item = $("<div>",{class:"item portlet light"})[0];
		salvattore['prepend_elements']($(".home-news")[0], [item]);

		var item = $("<div>",{class:"item portlet light"})[0];
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

		// process new post form submit event
		$("#new_post_form").submit(function (e){
			e.preventDefault();

			$(this)[0].reset();
		});

		// enabling/disabling post button on changing image or text
		enable_disable_post = function(){
			if($('#new_post_form textarea[name=text]').val().length > 0 || $('#new_post_form input[name=image]').val()!='') $('#new_post_form button[type=submit]').removeAttr("disabled");
			else $('#new_post_form button[type=submit]').attr("disabled","disabled");
		}
		$('#new_post_form textarea[name=text]').bind('input propertychange', function(){enable_disable_post();} );
		$('#new_post_form input[name=image]').on("change", function(){enable_disable_post();} );
		$("#new_post_form").bind("reset", function() {$('#new_post_form button[type=submit]').attr("disabled","disabled");});
	}
});
