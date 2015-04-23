
$(document).ready(function(){

    "use strict";


/*
 ----------------------------------------------------------------------
 Preloader
 ----------------------------------------------------------------------
 */
    $(".loader").delay(400).fadeOut();
    $(".animationload").delay(400).fadeOut("fast");


/*
 ----------------------------------------------------------------------
 Animation
 ----------------------------------------------------------------------
 */
    $('.animated').appear(function() {
        var elem = $(this);
        var animation = elem.data('animation');
        if ( !elem.hasClass('visible') ) {
            var animationDelay = elem.data('animation-delay');
            if ( animationDelay ) {
                setTimeout(function(){
                    elem.addClass( animation + " visible" );
                }, animationDelay);
            } else {
                elem.addClass( animation + " visible" );
            }
        }
    });

/*
 ----------------------------------------------------------------------
 Mobile Menu
 ----------------------------------------------------------------------
 */
    $("#show-mobile-menu").on("click", function(){
        $("#navigation-menu").toggleClass("active-menu");
    });


/*
 ----------------------------------------------------------------------
 Nice scroll
 ----------------------------------------------------------------------
 */
    $("html").niceScroll({
        cursorcolor: '#fff',
        cursoropacitymin: '0',
        cursoropacitymax: '1',
        cursorwidth: '2px',
        zindex: 999999,
        horizrailenabled: false,
        enablekeyboard: false
    });


/*
 ----------------------------------------------------------------------
 Watch
 ----------------------------------------------------------------------
 */
    if($.find('#watch')[0]) {

        $('#watch').countDown({
            targetDate: {
                'day': 		1,
                'month': 	5,
                'year': 	2015,
                'hour': 	0,
                'min': 		0,
                'sec': 		0
            },
            omitWeeks: true
        });
        //enter the count down date using the format year, month, day, time:time

    }



}); // End $(document).ready(function(){





















