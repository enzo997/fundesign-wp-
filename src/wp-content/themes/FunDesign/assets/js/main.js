var $ = jQuery;
// jQuery(document).ready(function($) {
//     // JS select
//     $('select:not(.wpcf7-form-control)').each(function() {
//         var $this = jQuery(this);
//         numberOfOptions = jQuery(this).children('option').length;
//         var val = $(this).val();
//         $this.addClass('select-hidden');
//         $this.wrap('<div class="select"></div>');
//         $this.after('<div class="select-styled"></div>');
//         var $styledSelect = $this.next('div.select-styled');
//         var $list = jQuery('<ul />', {
//             'class': 'select-options'
//         }).insertAfter($styledSelect);
//         for (var i = 0; i < numberOfOptions; i++) {
//             var html = $this.children('option').eq(i).text();
//             if (val == $this.children('option').eq(i).val()) {
//                 $styledSelect.text($this.children('option').eq(i).text());
//             }
//             jQuery('<li />', {
//                 html: html,
//                 rel: $this.children('option').eq(i).val(),
//                 class: (val == $this.children('option').eq(i).val()) ? 'active' : '',
//             }).appendTo($list);
//         }
//         var $listItems = $list.children('li');
//         $styledSelect.click(function(e) {
//             e.stopPropagation();
//             jQuery('div.select-styled.active').not(this).each(function() {
//                 jQuery(this).removeClass('active').next('ul.select-options').hide();
//             });
//             jQuery(this).toggleClass('active').next('ul.select-options').toggle();
//         });
//         $listItems.click(function(e) {
//             e.stopPropagation();
//             $styledSelect.text($(this).text()).removeClass('active');
//             if ((val != $(this).attr('rel') || $(this).attr('rel') == '') && !$(this).hasClass('active')) {
//                 $list.children('li').removeClass('active');
//                 $(this).addClass('active');
//                 $this.val($(this).attr('rel'));
//                 $this.trigger('change');
//             }
//             $list.hide();
//         });
//         jQuery(document).click(function() {
//             $styledSelect.removeClass('active');
//             $list.hide();
//         });
//     });


// });
// Google map
(function($) {
    /*
    *  render_map
    *
    *  This function will render a Google Map onto the selected jQuery element
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$el (jQuery element)
    *  @return	n/a
    */
    function render_map( $el ) {
        // var
        var $markers = $el.find('.marker');
        // Custom map styles
        var styles = [
            {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            }
        ];
        var styledMap = new google.maps.StyledMapType(styles, {name: "Styled Map"} );
        var args = {
            zoom		: 16,
            center		: new google.maps.LatLng(0, 0),
            mapTypeId	: google.maps.MapTypeId.ROADMAP,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'map_style']
            }
        };
        var map = new google.maps.Map($el[0], args);
        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');
        // add a markers reference
        map.markers = [];
        // add markers
        $markers.each(function(a){
            add_marker( $(this), map );
        });
        // center map
        center_map( map );
    }
    /*
    *  add_marker
    *
    *  This function will add a marker to the selected Google Map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	$marker (jQuery element)
    *  @param	map (Google Map object)
    *  @return	n/a
    */
    function add_marker( $marker, map ) {
        // var
        var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
        // create marker
        var marker = new google.maps.Marker({
            position	: latlng,
            map			: map
        });
        // add to array
        map.markers.push( marker );
        // if marker contains HTML, add it to an infoWindow
        if( $marker.html() )
        {
            // create info window
            var infowindow = new google.maps.InfoWindow({
                content		: $marker.html()
            });
            // show info window when marker is clicked
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
        }
    }
    /*
    *  center_map
    *
    *  This function will center the map, showing all markers attached to this map
    *
    *  @type	function
    *  @date	8/11/2013
    *  @since	4.3.0
    *
    *  @param	map (Google Map object)
    *  @return	n/a
    */
    function center_map( map ) {
        // vars
        var bounds = new google.maps.LatLngBounds();
        // loop through all markers and create bounds
        $.each( map.markers, function( i, marker ) {
            var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
            bounds.extend( latlng );
        });
        // only 1 marker?
        if( map.markers.length == 1 ) {
            // set center of map
            map.setCenter( bounds.getCenter() );
            map.setZoom( 16 );
        } else {
            // fit to bounds
            map.fitBounds( bounds );
        }
    }
    $(document).ready(function(){
        $('.acf-map').each(function(){
            render_map( $(this) );
        });
    });
    })(jQuery);
// Animation WOW 
wow = new WOW(
    {
    boxClass:     'wow',      // default
    animateClass: 'animated', // default
    offset:       0,          // default
    mobile:       false,       // default
    live:         true        // default
    }
)
wow.init();