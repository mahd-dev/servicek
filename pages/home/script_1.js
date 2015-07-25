page_script({
	init: function () {

		$('.property-carousel').owlCarousel({
			items: 4,
			itemsDesktop: [1199, 5],
			itemsDesktopSmall: [979, 3],
			itemsTablet: [768, 2],
			itemsTabletSmall: [1, 2],
			itemsMobile: false,
			navigation: true,
			navigationText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>']
		});

		// process search form submit event
		$("#search_form").submit(function (e) {
			e.preventDefault();
			//app.ajaxify(location.origin + "/search?q=" + $(this).find("ul.autocomplete").tagit("assignedTags").join(" "));
			app.ajaxify(location.origin + "/search?q=" + $(this).find(".query").val());
		});

		$("[data-displayin]").prependTo($("[data-displayin]").attr("data-displayin")).show();

		var map;
    var bounds = new google.maps.LatLngBounds();
		var map_styles = [
	    {
	        "featureType": "administrative",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "color": "#444444"
	            }
	        ]
	    },
	    {
	        "featureType": "landscape",
	        "elementType": "all",
	        "stylers": [
	            {
	                "color": "#f2f2f2"
	            }
	        ]
	    },
	    {
	        "featureType": "poi",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "all",
	        "stylers": [
	            {
	                "saturation": -100
	            },
	            {
	                "lightness": 45
	            }
	        ]
	    },
	    {
	        "featureType": "road",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "visibility": "on"
	            },
	            {
	                "color": "#f1b5c9"
	            }
	        ]
	    },
	    {
	        "featureType": "road.highway",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "simplified"
	            }
	        ]
	    },
	    {
	        "featureType": "road.arterial",
	        "elementType": "labels.icon",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "transit",
	        "elementType": "all",
	        "stylers": [
	            {
	                "visibility": "off"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "all",
	        "stylers": [
	            {
	                "color": "#46bcec"
	            },
	            {
	                "visibility": "on"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "geometry.fill",
	        "stylers": [
	            {
	                "color": "#1e88e5"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "labels.text.fill",
	        "stylers": [
	            {
	                "color": "#ffffff"
	            }
	        ]
	    },
	    {
	        "featureType": "water",
	        "elementType": "labels.text.stroke",
	        "stylers": [
	            {
	                "color": "#555555"
	            }
	        ]
	    }
		]
    var mapOptions = {
			styles: map_styles,
			scrollwheel: false,
      mapTypeId: 'roadmap'
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    // Multiple Markers
    var markers = JSON.parse($("[name=map_elements]").val());
		var clusterer_markers = [];
    // Display multiple markers on a map
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    // Loop through our array of markers & place each one on the map
    for( i = 0; i < markers.length; i++ ) {
      var position = new google.maps.LatLng(markers[i].latitude, markers[i].longitude);
      bounds.extend(position);
      marker = new MarkerWithLabel({
        position: position,
        map: map,
				icon: ' ',
				labelContent: '<i class="' + markers[i].icon + '"></i>',
       	labelAnchor: new google.maps.Point(20, 20),
				labelClass: "labels"
      });

      // Allow each marker to have an info window
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
					var content = $("<div>")
						.append($("<img>", {"src": markers[i].image_url, "style": "max-width:100%; max-height: 300px;"}))
						.append($("<h3>", {"text": markers[i].title}))
						.append($("<p>", {"text": markers[i].content}))
						.append($("<hr>"))
						.append($("<div>", {"data-href": markers[i].url, "data-layout": "button_count", "data-action": "like", "data-show-faces": "false", "data-share": "true"}))
						.append($("<a>", {"class": "ajaxify", "href": markers[i].url, "text": "Voir plus"}))
					;
          infoWindow.setContent(content[0].innerHTML);
          infoWindow.open(map, marker);
        }
      })(marker, i));

			clusterer_markers.push(marker);

      // Automatically center the map fitting all markers on the screen
      map.fitBounds(bounds);
    }

		var mc = new MarkerClusterer(map, clusterer_markers);

		window.fbAsyncInit();
	}
});
