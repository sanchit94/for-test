/*****************************************
    Template Name: Anjum Coming Soon Template
    Description: This is a Coming Soon Template
    Author: WpOcean
    Version: 1.0
******************************************/
/******************************************
[  Table of contents  ]
*****************************************
    01. Mobile Menu
	02. Ajax Mailchamp
    03. Sticky Menu
	04. mooth scrolling
	05. Countdown
	06. Magnific Popup Video 
    07. Wow js
    08. ScrollUp
	09. preloader
	10. Youtube Video BG 
	
	
 
*****************************************
[ End table content ]
******************************************/

(function ($) {
    "use strict";

    // 1. Mobile Menu
    $('.main-menu nav').meanmenu({
        meanScreenWidth: "991",
        meanMenuContainer: '.mobile-menu'
    });


    // 2. Ajax Mailchamp

    $('#mc-form').ajaxChimp({
        url: 'http://www.wpocean.us13.list-manage.com/subscribe/post?u=e9d729be03847d1a66b143bd2&amp;id=21ac2a3302', //Set Your Mailchamp URL
        callback: function (resp) {
            if (resp.result === 'success') {
                $('.subscribe-form input, .subscribe-form button').fadeOut();
            }
        }
    });

        // 3. Sticky Menu
        $(window).on('scroll', function () {
            var scroll = $(window).scrollTop();
            if (scroll < 10) {
                $(".header-area").removeClass("sticky");
            } else {
                $(".header-area").addClass("sticky");
            }
        });
    
        // 4. smooth scrolling
        $(function () {
            $(".main-menu ul li a , .mobile-menu.mean-container .mean-nav ul li a").bind('click', function (event) {
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 1000, 'easeInOutExpo');
                event.preventDefault();
            });
        });
    
       //5. Countdown
        
        $('#countdown').countdown('2018/07/01', function (event) {
            $(this).html(event.strftime('<ul class="list-unstyled list-inline"><li>%D <span>days</span></li><li>%H <span>Houre</span></li><li>%M <span>min</span></li><li>%S <Span>sec</Span></li></ul>'));
        });
    
        
         // 6. Magnific Popup Video 
        $('.video-play').magnificPopup({
            type: 'video'
        });
    
        // 7. Wow js
        new WOW().init();
        
        // 8. ScrollUp
        $.scrollUp({
            scrollText: '<i class="fa fa-long-arrow-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            animation: 'fade'
        });
        
        
    
        //9. preloader
        $(window).on('load', function () {
            $('.preloader-wave-effect').fadeOut();
            $('#preloader-wrapper').delay(150).fadeOut('slow');
        });
    
        //10. Youtube Video BG
        $('#video-background').YTPlayer({
            videoId: 'jssO8-5qmag',
            fitToBackground: false,
            mute: true,
            pauseOnScroll: false,
            playerVars: {
                modestbranding: 0,
                autoplay: 1,
                controls: 0,
                showinfo: 0,
                wmode: 'transparent',
                branding: 0,
                rel: 0,
                autohide: 0,
                origin: window.location.origin
            }
        });




}(jQuery));