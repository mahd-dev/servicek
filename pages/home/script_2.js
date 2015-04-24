page_script({
	init: function () {

        // posts plugin init

		salvattore.rescanMediaQueries();

		// add news items sample
		/*
		var item = $("<div>",{class:"item portlet light"})[0];
		salvattore['prepend_elements']($(".home-news")[0], [item]);

		var item = $("<div>",{class:"item portlet light"})[0];
		salvattore['append_elements']($(".home-news")[0], [item]);

		*/

		// process search form submit event
		$("#search_form").submit(function (e) {
			e.preventDefault();
			Layout.ajaxify(location.origin + "/search/" + $(this).find("input.query").val());
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
