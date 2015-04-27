/**
Core script to handle the entire theme and core functions
**/
var Layout = function () {

	var layoutImgPath = 'img/';

	var layoutCssPath = 'css/';

	var resBreakpointMd = app.getResponsiveBreakpoint('md');

	//* BEGIN:CORE HANDLERS *//
	// this function handles responsive layout on screen size resize or mobile device rotate.


	// Handle sidebar menu links
	var handleSidebarMenuActiveLink = function (mode, el) {
		var url = location.hash.toLowerCase();

		var menu = $('.page-sidebar-menu');

		if (mode === 'click' || mode === 'set') {
			el = $(el);
		} else if (mode === 'match') {
			menu.find("li > a").each(function () {
				var path = $(this).attr("href").toLowerCase();
				// url match condition
				if (path.length > 1 && url.substr(1, path.length - 1) == path.substr(1)) {
					el = $(this);
					return;
				}
			});
		}

		if (!el || el.size() == 0) {
			return;
		}

		if (el.attr('href').toLowerCase() === 'javascript:;' || el.attr('href').toLowerCase() === '#') {
			return;
		}

		var slideSpeed = parseInt(menu.data("slide-speed"));
		var keepExpand = menu.data("keep-expanded");

		// disable active states
		menu.find('li.active').removeClass('active');
		menu.find('li > a > .selected').remove();

		if (menu.hasClass('page-sidebar-menu-hover-submenu') === false) {
			menu.find('li.open').each(function () {
				if ($(this).children('.sub-menu').size() === 0) {
					$(this).removeClass('open');
					$(this).find('> a > .arrow.open').removeClass('open');
				}
			});
		} else {
			menu.find('li.open').removeClass('open');
		}

		el.parents('li').each(function () {
			$(this).addClass('active');
			$(this).find('> a > span.arrow').addClass('open');

			if ($(this).parent('ul.page-sidebar-menu').size() === 1) {
				$(this).find('> a').append('<span class="selected"></span>');
			}

			if ($(this).children('ul.sub-menu').size() === 1) {
				$(this).addClass('open');
			}
		});

		if (mode === 'click') {
			if (app.getViewPort().width < resBreakpointMd && $('.page-sidebar').hasClass("in")) { // close the menu on mobile view while laoding a page
				$('.page-header .responsive-toggler').click();
			}
		}
	};

	// Handles main menu
	var handleMainMenu = function () {

		// handle menu toggler icon click
		$(".page-header .menu-toggler").on("click", function (event) {
			if (app.getViewPort().width < resBreakpointMd) {
				var menu = $(".page-header .page-header-menu");
				if (menu.hasClass("page-header-menu-opened")) {
					menu.slideUp(300);
					menu.removeClass("page-header-menu-opened");
				} else {
					menu.slideDown(300);
					menu.addClass("page-header-menu-opened");
				}

				if ($('body').hasClass('page-header-top-fixed')) {
					app.scrollTop();
				}
			}
		});

		// handle sub dropdown menu click for mobile devices only
		$(".dropdown-submenu > a").on("click", function (e) {
			if (app.getViewPort().width < resBreakpointMd) {
				if ($(this).next().hasClass('dropdown-menu')) {
					e.stopPropagation();

					if ($(this).parent().hasClass("open")) {
						$(this).parent().removeClass("open");
						$(this).next().hide();
					} else {
						$(this).parent().addClass("open");
						$(this).next().show();
					}
				}
			}
		});

		// handle hover dropdown menu for desktop devices only
		if (app.getViewPort().width >= resBreakpointMd) {
			$('[data-hover="megamenu-dropdown"]').not('.hover-initialized').each(function () {
				$(this).dropdownHover();
				$(this).addClass('hover-initialized');
			});
		}

		$(document).on('click', '.mega-menu-dropdown .dropdown-menu', function (e) {
			e.stopPropagation();
		});

		// handle fixed mega menu(minimized) 
		$(window).scroll(function () {
			var offset = 75;
			if ($('body').hasClass('page-header-menu-fixed')) {
				if ($(window).scrollTop() > offset) {
					$(".page-header-menu").addClass("fixed");
				} else {
					$(".page-header-menu").removeClass("fixed");
				}
			}

			if ($('body').hasClass('page-header-top-fixed')) {
				if ($(window).scrollTop() > offset) {
					$(".page-header-top").addClass("fixed");
				} else {
					$(".page-header-top").removeClass("fixed");
				}
			}
		});
	};

	// Handle sidebar menu
	var handleSidebarMenu = function () {
		$('.page-sidebar').on('click', 'li > a', function (e) {

			if (app.getViewPort().width >= resBreakpointMd && $(this).parents('.page-sidebar-menu-hover-submenu').size() === 1) { // exit of hover sidebar menu
				return;
			}

			if ($(this).next().hasClass('sub-menu') === false) {
				if (app.getViewPort().width < resBreakpointMd && $('.page-sidebar').hasClass("in")) { // close the menu on mobile view while laoding a page
					$('.page-header .responsive-toggler').click();
				}
				return;
			}

			if ($(this).next().hasClass('sub-menu always-open')) {
				return;
			}

			var parent = $(this).parent().parent();
			var the = $(this);
			var menu = $('.page-sidebar-menu');
			var sub = $(this).next();

			var autoScroll = menu.data("auto-scroll");
			var slideSpeed = parseInt(menu.data("slide-speed"));
			var keepExpand = menu.data("keep-expanded");

			if (keepExpand !== true) {
				parent.children('li.open').children('a').children('.arrow').removeClass('open');
				parent.children('li.open').children('.sub-menu:not(.always-open)').slideUp(slideSpeed);
				parent.children('li.open').removeClass('open');
			}

			var slideOffeset = -200;

			if (sub.is(":visible")) {
				$('.arrow', $(this)).removeClass("open");
				$(this).parent().removeClass("open");
				sub.slideUp(slideSpeed, function () {
					if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
						if ($('body').hasClass('page-sidebar-fixed')) {
							menu.slimScroll({
								'scrollTo': (the.position()).top
							});
						} else {
							app.scrollTo(the, slideOffeset);
						}
					}
				});
			} else {
				$('.arrow', $(this)).addClass("open");
				$(this).parent().addClass("open");
				sub.slideDown(slideSpeed, function () {
					if (autoScroll === true && $('body').hasClass('page-sidebar-closed') === false) {
						if ($('body').hasClass('page-sidebar-fixed')) {
							menu.slimScroll({
								'scrollTo': (the.position()).top
							});
						} else {
							app.scrollTo(the, slideOffeset);
						}
					}
				});
			}

			e.preventDefault();
		});

	};


	// Helper function to calculate sidebar height for fixed sidebar layout.
	var _calculateFixedSidebarViewportHeight = function () {
		var sidebarHeight = app.getViewPort().height - $('.page-header').outerHeight() - 30;
		if ($('body').hasClass("page-footer-fixed")) {
			sidebarHeight = sidebarHeight - $('.page-footer').outerHeight();
		}

		return sidebarHeight;
	};

	// Handles fixed sidebar
	var handleFixedSidebar = function () {
		var menu = $('.page-sidebar-menu');

		app.destroySlimScroll(menu);

		if ($('.page-sidebar-fixed').size() === 0) {
			return;
		}

		if (app.getViewPort().width >= resBreakpointMd) {
			menu.attr("data-height", _calculateFixedSidebarViewportHeight());
			app.initSlimScroll(menu);
		}
	};

	// Handles sidebar toggler to close/hide the sidebar.
	var handleFixedSidebarHoverEffect = function () {
		var body = $('body');
		if (body.hasClass('page-sidebar-fixed')) {
			$('.page-sidebar').on('mouseenter', function () {
				if (body.hasClass('page-sidebar-closed')) {
					$(this).find('.page-sidebar-menu').removeClass('page-sidebar-menu-closed');
				}
			}).on('mouseleave', function () {
				if (body.hasClass('page-sidebar-closed')) {
					$(this).find('.page-sidebar-menu').addClass('page-sidebar-menu-closed');
				}
			});
		}
	};

	// Hanles sidebar toggler
	var handleSidebarToggler = function () {
		var body = $('body');
		if ($.cookie && $.cookie('sidebar_closed') === '1' && app.getViewPort().width >= resBreakpointMd) {
			$('body').addClass('page-sidebar-closed');
			$('.page-sidebar-menu').addClass('page-sidebar-menu-closed');
		}

		// handle sidebar show/hide
		$('body').on('click', '.sidebar-toggler', function (e) {
			var sidebar = $('.page-sidebar');
			var sidebarMenu = $('.page-sidebar-menu');
			$(".sidebar-search", sidebar).removeClass("open");

			if (body.hasClass("page-sidebar-closed")) {
				body.removeClass("page-sidebar-closed");
				sidebarMenu.removeClass("page-sidebar-menu-closed");
				if ($.cookie) {
					$.cookie('sidebar_closed', '0');
				}
			} else {
				body.addClass("page-sidebar-closed");
				sidebarMenu.addClass("page-sidebar-menu-closed");
				if (body.hasClass("page-sidebar-fixed")) {
					sidebarMenu.trigger("mouseleave");
				}
				if ($.cookie) {
					$.cookie('sidebar_closed', '1');
				}
			}

			$(window).trigger('resize');
		});

		handleFixedSidebarHoverEffect();

		// handle the search bar close
		$('.page-sidebar').on('click', '.sidebar-search .remove', function (e) {
			e.preventDefault();
			$('.sidebar-search').removeClass("open");
		});

		// handle the search query submit on enter press
		$('.page-sidebar .sidebar-search').on('keypress', 'input.form-control', function (e) {
			if (e.which == 13) {
				$('.sidebar-search').submit();
				return false; //<---- Add this line
			}
		});

		// handle the search submit(for sidebar search and responsive mode of the header search)
		$('.sidebar-search .submit').on('click', function (e) {
			e.preventDefault();
			if ($('body').hasClass("page-sidebar-closed")) {
				if ($('.sidebar-search').hasClass('open') === false) {
					if ($('.page-sidebar-fixed').size() === 1) {
						$('.page-sidebar .sidebar-toggler').click(); //trigger sidebar toggle button
					}
					$('.sidebar-search').addClass("open");
				} else {
					$('.sidebar-search').submit();
				}
			} else {
				$('.sidebar-search').submit();
			}
		});

		// handle close on body click
		if ($('.sidebar-search').size() !== 0) {
			$('.sidebar-search .input-group').on('click', function (e) {
				e.stopPropagation();
			});

			$('body').on('click', function () {
				if ($('.sidebar-search').hasClass('open')) {
					$('.sidebar-search').removeClass("open");
				}
			});
		}
	};

	// Handles the horizontal menu
	var handleHeader = function () {
		// handle search box expand/collapse
		$('.page-header').on('click', '.search-form', function (e) {
			$(this).addClass("open");
			$(this).find('.form-control').focus();

			$('.page-header .search-form .form-control').on('blur', function (e) {
				$(this).closest('.search-form').removeClass("open");
				$(this).unbind("blur");
			});
		});

		// handle hor menu search form on enter press
		$('.page-header').on('keypress', '.hor-menu .search-form .form-control', function (e) {
			if (e.which == 13) {
				$(this).closest('.search-form').submit();
				return false;
			}
		});

		// handle header search button click
		$('.page-header').on('mousedown', '.search-form.open .submit', function (e) {
			e.preventDefault();
			e.stopPropagation();
			$(this).closest('.search-form').submit();
		});
	};
	
	var handleContentHeight = function () {
		var height;

		if ($('body').height() < app.getViewPort().height) {
			height = app.getViewPort().height -
				$('.page-header').outerHeight() -
				($('.page-container').outerHeight() - $('.page-content').outerHeight()) -
				$('.page-prefooter').outerHeight() -
				$('.page-footer').outerHeight();

			$('.page-content').css('min-height', height);
		}
	};

	// Handles the go to top button at the footer
	var handleGoTop = function () {
		var offset = 300;
		var duration = 500;

		if (navigator.userAgent.match(/iPhone|iPad|iPod/i)) { // ios supported
			$(window).bind("touchend touchcancel touchleave", function (e) {
				if ($(this).scrollTop() > offset) {
					$('.scroll-to-top').fadeIn(duration);
				} else {
					$('.scroll-to-top').fadeOut(duration);
				}
			});
		} else { // general
			$(window).scroll(function () {
				if ($(this).scrollTop() > offset) {
					$('.scroll-to-top').fadeIn(duration);
				} else {
					$('.scroll-to-top').fadeOut(duration);
				}
			});
		}

		$('.scroll-to-top').click(function (e) {
			e.preventDefault();
			$('html, body').animate({
				scrollTop: 0
			}, duration);
			return false;
		});
	};

	var handleAjaxify = function () {

			// handle ajax link within main content
			$(document).on('click', '.ajaxify', function (e) { // required : href; optional : data-method, data-params, data-container
				e.preventDefault();
				app.scrollTop();

				var url = $(this).attr("href");

				var method = $(this).attr("data-method");
				var params = $(this).attr("data-params");
				var container = $(this).attr("data-container");
				var prevent_history_state = ($(this).attr("data-prevent_history_state") == "true" ? true : false);
				Layout.ajaxify(url, method, params, container, prevent_history_state);
			});

			// handle scrolling to top on responsive menu toggler click when header is fixed for mobile view
			$(document).on('click', '.page-header-fixed-mobile .responsive-toggler', function () {
				app.scrollTop();
			});

			// handle history popstate event
			$(window).bind("popstate", function (e) {
				var s = e.originalEvent.state;
				if (s) Layout.ajaxify(s.href, s.method, s.params, s.container, true);
				else Layout.ajaxify(location.href, undefined, undefined, undefined, true);
			});
		}
		//* END:CORE HANDLERS *//

	return {

		// Main init methods to initialize the layout
		// IMPORTANT!!!: Do not modify the core handlers call order.

		initHeader: function () {
			handleHeader(); // handles horizontal menu
		},

		initMainMenu: function () {
			handleMainMenu();
		},

		setSidebarMenuActiveLink: function (mode, el) {
			handleSidebarMenuActiveLink(mode, el);
		},

		initSidebar: function () {
			//layout handlers
			handleFixedSidebar(); // handles fixed sidebar menu
			handleSidebarMenu(); // handles main menu
			handleSidebarToggler(); // handles sidebar hide/show

			if (app.isAngularJsApp()) {
				handleSidebarMenuActiveLink('match'); // init sidebar active links
			}

			app.addResizeHandler(handleFixedSidebar); // reinitialize fixed sidebar on window resize
		},

		initContent: function () {
			return;
		},

		initFooter: function () {
			handleGoTop(); //handles scroll to top functionality in the footer
		},

		initAjaxify: function () {
			handleAjaxify();
		},
		init: function () {
			this.initHeader();
			this.initMainMenu();
			this.initSidebar();
			this.initContent();
			this.fixContentHeight();
			this.initFooter();
			this.initAjaxify();
		},

		//public function to fix the sidebar and content height accordingly
		fixContentHeight: function () {
			handleContentHeight();
		},

		initFixedSidebarHoverEffect: function () {
			handleFixedSidebarHoverEffect();
		},

		initFixedSidebar: function () {
			handleFixedSidebar();
		},

		getLayoutImgPath: function () {
			return app.getAssetsPath() + layoutImgPath;
		},

		getLayoutCssPath: function () {
			return app.getAssetsPath() + layoutCssPath;
		},
		ajaxify: function (href, method, params, container, prevent_history_state) {
			var method = (method === undefined ? "GET" : method);
			var params = (params === undefined ? null : params);
			var container = (container === undefined ? $('.page-content .container') : $(container));

			$.ajax({
				type: method,
				url: href,
				data: params,
				dataType: "html",
				success: function (res) {
					container.addClass("animate");
					setTimeout(function () {
						if (prevent_history_state != true) history.pushState({
							href: href,
							method: method,
							params: params,
							container: container.selector
						}, document.title, href);
						container.html(res);
						container.removeClass("animate");
						Layout.fixContentHeight(); // fix content height
						app.initAjax(); // initialize core stuff
					}, 50);
				},
				error: function (xhr, ajaxOptions, thrownError) {}
			});
		}
	};

}();