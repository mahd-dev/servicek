page_script({
	init: function () {
		// process search form submit event
		$("#search_form").submit(function (e) {
			e.preventDefault();
			app.ajaxify(location.origin + "/search/" + $(this).find("input.query").val());
		});
	}
});
