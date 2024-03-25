/*
 Project Name : Primax HTML template
 Author Company : themecanyon
 Project Date: 18 jan, 2017
 Author Website : http://demo.themecanyon.org
 Template Developer: themesfoundry@gmail.com
 */


/* Table of Content
 ==================================================
 1.Parallax
 2.Header
 3.Count Function
 4.Map
 5.Progress bar
 6.Contact Form
 7.Testimonials
 8.Tooltip
*/

jQuery(function($) {

    "use strict";

    //============================================
    //Screen height
    //=============================================
    $(".screen-height").css({
        'height': window.innerHeight
    });

    $(window).resize(function() {
        $(".screen-height").css({
            'height': window.innerHeight
        });
    });
    //============================================
    //Parallax
    //=============================================
    $('.parallax').parallax("50%", 0.1);
    $('.parallax1').parallax("100%", 0.1);
    $('.parallax2').parallax("100%", 0.1);
    $('.parallax3').parallax("100%", 0.1);
    $('.parallax4').parallax("100%", 0.1);

    //============================================
    //Header
    //=============================================
    //offCanvas menu
    $("div.offcanvas-inner ul > li.parent").append('<div class="more"></div>');
    $("div.offcanvas-inner .sp-module-content").on("click", ".more", function(e) {
        e.stopPropagation();
        $(this).parent().toggleClass("current")
            .children("div.offcanvas-inner ul > li.parent").toggleClass("open");
    });

    var $body = $('body'),
        $wrapper = $('.body-innerwrapper'),
        $toggler = $('#offcanvas-toggler'),
        $close = $('.close-offcanvas'),
        $offCanvas = $('.offcanvas-menu');

    $toggler.on('click', function(event) {
        event.preventDefault();
        stopBubble(event);
        setTimeout(offCanvasShow, 50);
    });

    $close.on('click', function(event) {
        event.preventDefault();
        offCanvasClose();
    });

    var offCanvasShow = function() {
        $body.addClass('offcanvas');
        $wrapper.on('click', offCanvasClose);
        $close.on('click', offCanvasClose);
        $offCanvas.on('click', stopBubble);

    };

    var offCanvasClose = function() {
        $body.removeClass('offcanvas');
        $wrapper.off('click', offCanvasClose);
        $close.off('click', offCanvasClose);
        $offCanvas.off('click', stopBubble);
    };

    var stopBubble = function(e) {
        e.stopPropagation();
        return true;
    };
    //============================================
    //Accordion
    //=============================================
    var selectIds = $('#panel1,#panel2,#panel3,#panel4');
    $(function ($) {
        selectIds.on('show.bs.collapse hidden.bs.collapse', function () {
            $(this).prev().find('.fa').toggleClass('fa-plus fa-minus');
        })
    });
    //========================================
    // count function
    //======================================
    $('.count').each(function() {
        jQuery(this).appear(function() {
            var $this = $(this);
            jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
                duration: 1000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.ceil(this.Counter));
                }
            });
        });
    });
    //============================================
    //Features slider
    //=============================================
    $('.oc-feature-slider').owlCarousel({
        loop:true,
        margin:10,
        items:3,
        autoPlay:true,
        navigation:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:5
            }
        }
    });
    //============================================
    //Testimonials
    //=============================================
    var owl = $(".testi_slider");

    owl.owlCarousel({
        navigation : true,
        singleItem : true,
        autoPlay:true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
    });
    //============================================
    //Partner Logo
    //=============================================
    $('.partner-logo').owlCarousel({
        loop:true,
        margin:10,
        items:6,
        pagination:false,
        autoPlay:true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        navigation:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:5
            }
        }
    });
    //===============================================
    //animation
    //==============================================
    // Show element on scroll

    var $elems = $('.animate-in');
    var winheight = $(window).height();
    var fullheight = $(document).height();

    $(window).scroll(function() {
        animate_elems();
    });
    $(window).load(function() {
        animate_elems();
    });

    function animate_elems() {
        var wintop = $(window).scrollTop(); // calculate distance from top of window
        // loop through each item to check when it animates
        $elems.each(function() {
            var $elm = $(this);

            var topcoords = $elm.offset().top; // element's distance from top of page in pixels

            if (wintop > (topcoords - (winheight * .99999))) {
                // animate when top of the window is 3/4 above the element
                $elm.addClass('animated');

            }

        });
    } // end animate_elems()
    //================================================
    //Progress Bar
    //=================================================
    $('.skill').each(function() {
        $(this).appear(function() {
            $(this).find('.skill-box').animate({
                width: jQuery(this).attr('data-percent')
            }, 1000);
            $(this).find('span').animate({
                left: jQuery(this).attr('data-percent')
            }, 1000);
        });
    });
    //============================================
    //Heading Rotate
    //=============================================
    $(".js-rotating").Morphext({
        // The [in] animation type. Refer to Animate.css for a list of available animations.
        animation: "flipInX",
        // An array of phrases to rotate are created based on this separator. Change it if you wish to separate the phrases differently (e.g. So Simple | Very Doge | Much Wow | Such Cool).
        separator: ",",
        // The delay between the changing of each phrase in milliseconds.
        speed: 2000,
        complete: function () {
            // Called after the entrance animation is executed.
        }
    });

    /* ---------------------------------------------------------------------- */
    /*  Contact Form
     /* ---------------------------------------------------------------------- */

    var submitContact = $('#submit_contact'),
        message = $('#msg');

    submitContact.on('click', function(e) {
        e.preventDefault();

        var $this = $(this);

        $.ajax({
            type: "POST",
            url: 'contact.php',
            dataType: 'json',
            cache: false,
            data: $('#contact-form').serialize(),
            success: function(data) {

                if (data.info !== 'error') {
                    $this.parents('form').find('input[type=text],textarea,select').filter(':visible').val('');
                    message.hide().removeClass('success').removeClass('error').addClass('success').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
                } else {
                    message.hide().removeClass('success').removeClass('error').addClass('error').html(data.msg).fadeIn('slow').delay(5000).fadeOut('slow');
                }
            }
        });
    });
    //============================================
    //Blog slider
    //=============================================
    $("#cont-slider").owlCarousel({

        navigation: true, // Show next and prev buttons
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        navigationText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
        pagination: false

    });
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();
    //============================================
    //Google map
    //=============================================
    google.maps.event.addDomListener(window, 'load', function(){

        $('.map-canvas').each(function(index){
            var mapId = 'sppb-addon-gmap' + (index + 1);
            var self = this;

            $(this).attr('id', mapId);

            var zoom = $(self).data('mapzoom');
            var mousescroll = $(self).data('mousescroll');

            var latlng = new google.maps.LatLng($(self).data('lat'), $(self).data('lng'));
            var mapOptions = {
                zoom: zoom,
                center: latlng,
                scrollwheel: mousescroll
            };
            var map = new google.maps.Map(document.getElementById(mapId), mapOptions);
            var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(41.760971, -8.581531),
                    map: map,
                    title: 'metrics',
                    icon: 'images/marker3.png'
                });

        });

    });
    //================================================
    // Event count down
    //================================================
    $('#countdown').countdown('2020/05/11', function(event) {
        $(this).html(event.strftime('<div class="days count-down"><div class="inner"><span class="number">%-D</span><span class="string">%!D:Day,Days;</span></div></div> <div class="hours count-down"><div class="inner"><span class="number">%H</span><span class="string">%!H:Hour,Hours;</span></div> </div><div class="minutes count-down"><div class="inner"><span class="number">%M</span><span class="string">%!M:Minute,Minutes;</span></div> </div><div class="seconds count-down"><div class="inner"><span class="number">%S</span><span class="string">%!S:Second,Seconds;</span></div> </div>'));
    });
    //================================================
    //Coming Soon count down
    //================================================
    $('#countdown_2').countdown('2018/10/05', function(event) {
        $(this).html(event.strftime('<div class="days count-down"><div class="inner"><span class="number">%-D</span><span class="string">%!D:Day,Days;</span></div></div> <div class="hours count-down"><div class="inner"><span class="number">%H</span><span class="string">%!H:Hour,Hours;</span></div> </div><div class="minutes count-down"><div class="inner"><span class="number">%M</span><span class="string">%!M:Minute,Minutes;</span></div> </div><div class="seconds count-down"><div class="inner"><span class="number">%S</span><span class="string">%!S:Second,Seconds;</span></div> </div>'));
    });
});
