page_script({
	init: function () {

		$("#master_search_form").submit(function (e) {
			e.preventDefault();
			app.ajaxify(location.origin + "/search?q=" + $(this).find("input[name=q]").val());
		});

	}
});
