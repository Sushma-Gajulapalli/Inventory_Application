$(document).ready(function() { 

    'use strict';
    
    $("#pageloader").delay(1200).fadeOut("slow");
    $(".loader-item").delay(700).fadeOut();

});
/* ==============================================
Custom Javascript
=============================================== */

$(document).ready(function() {  
  'use strict'

    // On Scroll Animation
    new WOW().init();


  	// Dropdown Menu For Mobile
	$('.dropdown-menu a.dropdown-toggle-mob').on('click', function(e) {
      if (!$(this).next().hasClass('show')) {
        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
      }
      var $subMenu = $(this).next(".dropdown-menu");
      $subMenu.toggleClass('show');

      $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
        $('.dropdown-submenu .show').removeClass("show");
      });

      return false;
    });

    $('[data-toggle="tooltip"]').tooltip()


	// On Scroll Header Style One
	$(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('.header-fullpage').addClass('fixed');
        } else {
            $('.header-fullpage').removeClass('fixed');
        }
    });

    $('#search_home, .overlay-close').on( "click", function($e) {
      $e.preventDefault();
      $(".overlay").toggleClass("open");     
   });

	// On Scroll Back To Top Arrow
   	$(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#mkdf-back-to-top').addClass('on');
        } else {
            $('#mkdf-back-to-top').removeClass('on');
        }
    });

   	$('#mkdf-back-to-top').click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    // Flickr Photostream
    $('#basicuse').jflickrfeed({
        limit: 9,
        qstrings: {
            id: '52617155@N08'
        },
        itemTemplate: '<li><a href="{{image_b}}"><img src="{{image_s}}" alt="{{title}}" /></a></li>'
    });

    // Bootstrap Collapse
    // $('.collapse').on('shown.bs.collapse', function(){
    //     $(this).parent().find(".icofont-rounded-down").removeClass("icofont-rounded-down").addClass("icofont-rounded-up");
    //     }).on('hidden.bs.collapse', function(){
    //     $(this).parent().find(".icofont-rounded-up").removeClass("icofont-rounded-up").addClass("icofont-rounded-down");
    // });

        $('.toggle').click(function () {
    
   // alert();
 
    $('.toggle').removeClass("arrow-down");

  if ( !$(this).next().hasClass('show') ) {
      $(this).parent().children('.collapse.show').collapse('hide');
      $(this).toggleClass('arrow-down');
      
    } 
  $(this).next().collapse('toggle');

  
    });
    
    // Animated Skill Bars      
    $('.skillbar').appear();
        $('.skillbar').on('appear', function () {           
        $(this).find('.skillbar-bar').animate({
            width: $(this).attr('data-percent')
        }, 3000);           
    });

    $('.chart').easyPieChart({
        easing: 'easeInSine',
        barColor: "#2f3985",
        lineCap: 'round',
        scaleColor: false,
        size: '100',
        onStep: function(from, to, percent) {
            $(this.el).find('.percent').text(Math.round(percent));
        }
    });

    // Twitter Feed
    $(".tweet-stream").tweet({
        username: "envato",
        modpath: "twitter/",
        count: 1,
        template: "{text}{time}",
        loading_text: "loading twitter feed..."
    });

    // Open Video
    jQuery('.play-video').on('click', function(e) {
        var videoContainer = jQuery('.video-box');
        videoContainer.prepend('<iframe src="http://player.vimeo.com/video/7449107" width="500" height="281" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        videoContainer.fadeIn(300);
        e.preventDefault();
    });
    // Close Video
    jQuery('.close-video').on('click', function(e) {
        jQuery('.video-box').fadeOut(400, function() {
            jQuery("iframe", this).remove().fadeOut(300);
        });
    });

    $("#home-client-testimonials").owlCarousel({
        items: 2,
        margin: 30,
        loop: true,
        nav: true,
        slideBy: 1,
        dots: false,
        center: false,
        autoplay: true,
        autoheight: true,
        navText: ['<i class="icofont-thin-left"></i>', '<i class="icofont-thin-right"></i>'],
        responsive: {
            320: {
                items: 1,
            },
            480: {
                items: 1,
            },
            600: {
                items: 1,
            },
            1000: {
                items: 2,
                loop: true,
            },
            1200: {
                items: 2,
                loop: true,
            }
        }
    }); 

    $("#client-testimonials-bg").owlCarousel({
        items: 1,
        margin: 30,
        loop: true,
        nav: true,
        slideBy: 1,
        dots: false,
        center: false,
        autoplay: true,
        autoheight: true,
        navText: ['<i class="icofont-thin-left"></i>', '<i class="icofont-thin-right"></i>']
    }); 

    $("#home-clients").owlCarousel({
        items: 2,
        margin: 30,
        loop: true,
        nav: false,
        slideBy: 1,
        dots: false,
        center: false,
        autoplay: true,
        autoheight: true,
        navText: ['<i class="icofont-thin-left"></i>', '<i class="icofont-thin-right"></i>'],
        responsive: {
            320: {
                items: 2,
            },
            600: {
                items: 3,
            },
            767: {
                items: 4,
            },
            1000: {
                items: 4,
                loop: true,
            },
            1200: {
                items: 6,
                loop: true,
            }
        }
    }); 

    /* Conter */
    $('.counter').counterUp({
        delay: 10,
        time: 1000
    });


    // Google Map
    $("#map_extended").gMap({
        markers: [{
            address: "",
            html: '<h4>Office</h4>' +
                '<address>' +
                '<div>' +
                '<div><b>Address:</b></div>' +
                '<div>Envato Pty Ltd, 13/2<br> Elizabeth St Melbourne VIC 3000,<br> Australia</div>' +
                '</div>' +
                '<div>' +
                '<div><b>Phone:</b></div>' +
                '<div>+1 (408) 786 - 5117</div>' +
                '</div>' +
                '<div>' +
                '<div><b>Fax:</b></div>' +
                '<div>+1 (408) 786 - 5227</div>' +
                '</div>' +
                '<div>' +
                '<div><b>Email:</b></div>' +
                '<div><a href="mailto:info@well&spa.com">info@well&spa.com</a></div>' +
                '</div>' +
                '</address>',
            latitude: -33.87695388579145,
            longitude: 151.22183918952942,
            icon: {
                image: "images/pin.png",
                iconsize: [35, 48],
                iconanchor: [17, 48]
            }
        }, ],
        icon: {
            image: "images/pin.png",
            iconsize: [35, 48],
            iconanchor: [17, 48]
        },
        latitude: -33.87695388579145,
        longitude: 151.22183918952942,
        zoom: 16
    });
    
 

});


var tpj=jQuery;
        
var revapi1078;
tpj(document).ready(function() {
  if(tpj("#rev_slider_1078_1").revolution == undefined){
    revslider_showDoubleJqueryError("#rev_slider_1078_1");
  }else{
    revapi1078 = tpj("#rev_slider_1078_1").show().revolution({
      sliderType:"standard",
      jsFileLocation:"revolution/js/",
      sliderLayout:"",
      dottedOverlay:"none",
      delay:9000,
      navigation: {
        keyboardNavigation:"off",
        keyboard_direction: "horizontal",
        mouseScrollNavigation:"off",
        mouseScrollReverse:"default",
        onHoverStop:"off",
        touch:{
          touchenabled:"on",
          swipe_threshold: 75,
          swipe_min_touches: 1,
          swipe_direction: "horizontal",
          drag_block_vertical: false
        }
        ,
        arrows: {
          style:"metis",
          enable:true,
          hide_onmobile:true,
          hide_under:600,
          hide_onleave:true,
          hide_delay:200,
          hide_delay_mobile:1200,
          //tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
          left: {
            h_align:"left",
            v_align:"center",
            h_offset:30,
            v_offset:0
          },
          right: {
            h_align:"right",
            v_align:"center",
            h_offset:30,
            v_offset:0
          }
        }
        ,
        bullets: {
          style: 'hades',
          tmp: '<span class="tp-bullet-image"></span>',
          enable:false,
          hide_onmobile:true,
          hide_under:600,
          //style:"metis",
          hide_onleave:true,
          hide_delay:200,
          hide_delay_mobile:1200,
          direction:"horizontal",
          h_align:"center",
          v_align:"bottom",
          h_offset:0,
          v_offset:30,
          space:5,
          //tmp:'<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">{{title}}</span>'
        }
      },
      viewPort: {
        enable:true,
        outof:"pause",
        visible_area:"80%",
        presize:false
      },
      responsiveLevels:[1240,1024,778,480],
      visibilityLevels:[1240,1024,778,480],
      gridwidth:[1240,1024,778,480],
      gridheight:[600,600,500,400],
      lazyType:"none",
      parallax: {
        type:"mouse",
        origo:"slidercenter",
        speed:2000,
        levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55],
        type:"mouse",
      },
      shadow:0,
      spinner: 'spinner2',
      stopLoop:"off",
      stopAfterLoops:-1,
      stopAtSlide:-1,
      shuffle:"off",
      autoHeight:"off",
      hideThumbsOnMobile:"off",
      hideSliderAtLimit:0,
      hideCaptionAtLimit:0,
      hideAllCaptionAtLilmit:0,
      debugMode:false,
      fallbacks: {
        simplifyAll:"off",
        nextSlideOnWindowFocus:"off",
        disableFocusListener:false,
      }
    });
  }
}); /*ready*/


jQuery("#contactoption").validate({
    meta: "validate",
    /* */
    rules: {
        name: "required",

        lastname: "required",
        // simple rule, converted to {required:true}
        email: { // compound rule
            required: true,
            email: true
        },
        phone: {
            required: true,
        },
        cment: {
            required: true
        },
        subject: {
            required: true
        }
    },
    messages: {
        name: "Please enter your name.",
        lastname: "Please enter your last name.",
        email: {
            required: "Please enter email.",
            email: "Please enter valid email"
        },
        phone: "Please enter a phone.",
        subject: "Please enter a subject.",
        cment: "Please enter a comment."
    },
}); /*========================================*/

