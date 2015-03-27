page_script({
	init: function () {

		salvattore.rescanMediaQueries();

		// add news items sample
		/*
		var item = $('<article>',{text:"aaa"})[0];
		salvattore['prepend_elements']($(".home-news")[0], [item]);

		var item = $('<article>',{text:"aaa"})[0];
		salvattore['append_elements']($(".home-news")[0], [item]);
		*/

		// process search form submit event
		$("#search_form").submit(function (e) {
			e.preventDefault();
			Layout.ajaxify(location.origin + "/search/" + $(this).find("input.query").val());
		});

	}
});
