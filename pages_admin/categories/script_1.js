page_script({
	init: function () {

		$.fn.editable.defaults.ajaxOptions = {type: "POST"};
		$.fn.editable.defaults.type = 'text';
		$.fn.editable.defaults.pk = 1;
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.inputclass = 'form-control';
    $.fn.editable.defaults.url = location.href;
    $.fn.editable.defaults.onblur = 'submit';
		$.fn.editable.defaults.emptytext = 'Vide';

		$(".category_editable").editable({params:function (p) { p.element="category"; return p; }});

		$.getScript( $("[data-jsload=sc1]").attr("data-href"), function( data, textStatus, jqxhr ) {
			$('.dd').nestable({
				maxDepth: 25,
				dropCallback: function (dd, details) {
					$.post(location.href, {move: dd.sourceId, paste: dd.destId}, function (r) {
						try {
							var parsed = JSON.parse(r);
							if(parsed.status != "success") console.log(r);
						} catch (e) {
							console.log(r);
						}
						if(r != "success") console.log(r);
					});
				}
			});
		});

		$(".add_category").click(function () {
			$.post(location.href, {add_category: true}, function (r) {
				try {
					var parsed = JSON.parse(r);
					if(parsed.status=="success"){
						var new_item = $(".category_template").clone();
						new_item.attr("data-id", parsed.params.id).removeClass('hide').removeClass('category_template');
						$("[data-pk]", new_item).attr("data-pk", parsed.params.id);
						$(".dd-list.outer").append(new_item);
						$(".category_editable").editable({params:function (p) { p.element="category"; return p; }});
					}else console.log(r);
				} catch (e) {
					console.log(r);
				}
			});
		});

		$(".delete_category").live("click", function () {
			var li = $($(this).parents('[data-id]')[0]);
			$.post(location.href, {"delete_category": li.attr('data-id')}, function (r) {
				try {
					var parsed = JSON.parse(r);
					if(parsed.status=="success"){
						li.remove();
					}else console.log(r);
				} catch (e) {
					console.log(r);
				}
			});
		});

		$(".job_able").live('change', function(event) {
			var container = $($(this).parents(".togglebutton")[0]);
			if(this.checked){
				$(".value", container).removeClass('hide');
			}else{
				$.post(location.href, {element: "category", pk: $(container.parents("[data-id]")[0]).attr("data-id"), name: "job_publish_price", value: null}, function (rslt) {
					$(".value .category_editable", container).editable('setValue', null).editable('submit');
					$(".value", container).addClass('hide');
				});
			}
		});

		$(".shop_able").live('change', function(event) {
			var container = $($(this).parents(".togglebutton")[0]);
			if(this.checked){
				$(".value", container).removeClass('hide');
			}else{
				$.post(location.href, {element: "category", pk: $(container.parents("[data-id]")[0]).attr("data-id"), name: "shop_publish_price", value: null}, function (rslt) {
					$(".value .category_editable", container).editable('setValue', null).editable('submit');
					$(".value", container).addClass('hide');
				});
			}
		});

		$(".company_able").live('change', function(event) {
			var container = $($(this).parents(".togglebutton")[0]);
			if(this.checked){
				$(".value", container).removeClass('hide');
			}else{
				$.post(location.href, {element: "category", pk: $(container.parents("[data-id]")[0]).attr("data-id"), name: "company_publish_price", value: null}, function (rslt) {
					$(".value .category_editable", container).editable('setValue', null).editable('submit');
					$(".value", container).addClass('hide');
				});
			}
		});

		$(".service_able").live('change', function(event) {
			$.post(location.href, {element: "category", pk: $($(this).parents("[data-id]")[0]).attr("data-id"), name: "service", value: (this.checked?"1":"0")});
		});

		$(".product_able").live('change', function(event) {
			$.post(location.href, {element: "category", pk: $($(this).parents("[data-id]")[0]).attr("data-id"), name: "product", value: (this.checked?"1":"0")});
		});

		$(".category_icon input").live('change', function(event) {
			var icon = $('i', $($(this).parents('.category_icon')[0]));
			var input = $(this);
			$.post(location.href, {element: "category", pk: $($(this).parents("[data-id]")[0]).attr("data-id"), name: "icon", value: $(this).val()}, function (r){
				icon.attr("class", input.val());
			});
		});

	}
});
