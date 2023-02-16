/*
WP Theme: Finix - Technology & IT Solutions WordPress Theme
Author: powersquall.com
Version: 1.4  
Design and Developed by: Power Squall
*/

/*=============================================
[  Table of contents  ]
===============================================
:: Predefined Variables
:: Preloader
:: ClassAdd Loading
:: Check Exists
:: Header Sticky
:: Slicknav
:: Header Search
:: Header Sidemenu
:: Page Header Mobile
:: Swiper Slider
:: Magnific Popup
:: Progressbar
:: Rounded Skill
:: Masonry
:: Isotope
:: Sticky Footer
:: Countdown
:: Woocommerce SwitchToGrid
:: Back to Top
:: Mobile Click
:: Mobile Bottom Navbar
:: THEMEMAX Window load and functions

==============================================
[ End table content ]
============================================*/


/*-------------------------*/
/* Predefined Variables */
/*-------------------------*/
(function($){
  "use strict";


/*-------------------------*/
/* Predefined Variables */
/*-------------------------*/
var THEMEMAX = {},
    $window = $(window),
    $document = $(document),
    $body = $('body'),
    $bar = $('.bar'),
    $header = $('header'),
    $progressBar = $('.progress-bar'),
    $counter = $('.counter');


/*-------------------------*/
/* Preloader */
/*-------------------------*/ 
THEMEMAX.preloader = function () {
    $('#preloader').delay(0).fadeOut('slow');
};

/*-------------------------*/
/* Class Add Loading */
/*-------------------------*/
THEMEMAX.classAdd = function () {
  $('#site-header').removeClass('header-loading');
};

/*-------------------------*/
/* Check if Function Exists */
/*-------------------------*/
$.fn.exists = function () {
    return this.length > 0;
};

/*----------------------------*/
/* Header Sticky */
/*----------------------------*/
THEMEMAX.stickyHeader = function () {
  var headerHeight = $('.site-header').height();
  var stickyHeaderheight = $('.site-header .header-main').height();
  $("#page").css("padding-top", (headerHeight) + "px");
  $(".header-transparnt .page-header").css("padding-top", (headerHeight) + "px");
  $(".header-transparnt-light .page-header").css("padding-top", (headerHeight) + "px");
  $(".elementor-column.sticky-top").css("top", (stickyHeaderheight) + 20 + "px");
  $(".admin-bar .elementor-column.sticky-top").css("top", (stickyHeaderheight) + 50 + "px");

  $(window).scroll(function () {
    if ($(this).scrollTop() > 250) {
      $('.site-header.sticky-on').addClass('sticky');
    } else {
      $('.site-header.sticky-on').removeClass('sticky');
    }
  });
};

/*-------------------------*/
/* Slicknav */
/*-------------------------*/
THEMEMAX.slickNav = function () {
  $('#menu').slicknav({prependTo:'#slicknav_menu'});
  $('.slicknav_nav').slicknav({
      label: '',
      prependTo:'.primary-nav #slicknav_menu',
      closedSymbol: "&#43;",  // Character after collapsed parents. "&#9658;"
      openedSymbol: "&#45;",  // Character after expanded parents. "&#9660;"
      allowParentLinks: true,  // Allow clickable links as parent elements. 
  });
};

/*-------------------------*/
/* One Page Menu */
/*-------------------------*/
THEMEMAX.onePageMenu = function () {
  var pageSections = $('.elementor-section');
    var onepageNav = $('#primary-menu .navbar-nav, #slicknav_menu .slicknav_nav');
    var navHeight = $('#site-header').height();

    $(window).on('scroll', function () {
      var curPosition = $(this).scrollTop();
      
      pageSections.each(function() {
        var top = $(this).offset().top - navHeight - (-20),
            bottom = top + $(this).outerHeight();
        
        if (curPosition >= top && curPosition <= bottom) {
          onepageNav.find('a').parent().removeClass('current-menu-item');
          onepageNav.find('a[href="#'+$(this).attr('id')+'"]').parent().addClass('current-menu-item');
          pageSections.removeClass('active');
          $(this).addClass('active');
        }
      });
    });

    onepageNav.find('a').on('click', function () {
      var $el = $(this);
      var id = $el.attr('href');
      
      $('html, body').animate({
        scrollTop: $(id).offset().top - navHeight - (-20)
      }, 700);
      return false;
    });
};

/*-------------------------*/
/* Header Search */
/*-------------------------*/
THEMEMAX.headerSearch = function () {
  $('.header-search .search-btn, #mobile-search').on('click', function() {
      $('.search-main').addClass('search-show');
  });

  $('.search-main .search-close').on('click', function() {
      $(this).parent().removeClass('search-show');
  });
};

/*-------------------------*/
/* Header Sidemenu */
/*-------------------------*/
THEMEMAX.headerSidemenu = function () {
  $('.site-header .header-sidemenu').on('click', function() {
      $('body').addClass('sidemenu-open');
  });

  $('.sidemenu-main .sidemenu-close, .sidemenu-main .sidemenu-overlay').on('click', function() {
      $('body').removeClass('sidemenu-open');
  });
};

/*-------------------------*/
/* Page Header - Mobile */
/*-------------------------*/
THEMEMAX.pageHeaderMobile = function () {
  if ($(window).width() < 975) {
    $('.page-header').addClass('mobile-page-header');
  } else {
    $('.page-header').removeClass('mobile-page-header');
  }
};

/*-------------------------*/
/* Swiper Slider */
/*-------------------------*/
THEMEMAX.swiperSlider = function () {
  $( '.swiper-container' ).each(function () {
      var swiper = new Swiper( $( this ), {
      slidesPerView:  (($(this).attr('data-items')) ? $(this).attr('data-items') : 4),
      spaceBetween:   (($(this).attr('data-space')) ? $(this).data('space') : 15),
      autoplay:       (($(this).attr('data-autoplay')) ? $(this).data('autoplay') : false),
      loop:           (($(this).attr('data-loop')) ? $(this).data('loop') : false),
      centeredSlides: (($(this).attr('data-centered')) ? $(this).data('centered') : false),
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        1200: {slidesPerView: (($(this).attr('data-items')) ? $(this).attr('data-items') : 4),},
        992:  {slidesPerView: (($(this).attr('data-lg-items')) ? $(this).attr('data-lg-items') : 3),},
        768:  {slidesPerView: (($(this).attr('data-md-items')) ? $(this).attr('data-md-items') : 2),},
        480:  {slidesPerView: (($(this).attr('data-sm-items')) ? $(this).attr('data-sm-items') : 1),},
        0:  {slidesPerView: (($(this).attr('data-xs-items')) ? $(this).attr('data-xs-items') : 1),}
      }
      });
  });
};


/*-------------------------*/
/* Magnific Popup */
/*-------------------------*/
THEMEMAX.mediaPopups = function () {
  if ($(".popup-youtube, .popup-vimeo, .popup-gmaps").exists()) {
       $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
      });
  }
}


/*-------------------------*/
/* Progressbar */
/*-------------------------*/ 
THEMEMAX.progressBar = function () {
    if ($progressBar.exists()) {
        $progressBar.each(function (i, elem) {
            var $elem = $(this),
                percent = $elem.attr('data-percent') || "100",
                delay = $elem.attr('data-delay') || "100",
                type = $elem.attr('data-type') || "%";
            if (!$elem.hasClass('progress-animated')) {
                $elem.css({
                    'width': '0%'
                });
            }
        var progressBarRun = function () {
            $elem.animate({
                'width': percent + '%'
            }, 'easeInOutCirc').addClass('progress-animated');
             $elem.delay(delay).append('<div class="progress-value"><span class="progress-number animated fadeIn">' + percent + '</span><span class="progress-type animated fadeIn">' + type + '</span></div>');
        };
        $(elem).appear(function () {
                setTimeout(function () {
                    progressBarRun();
                }, delay);
            });
        });
      }
};

/*-------------------------*/
/* Parallax Banner */
/*-------------------------*/
THEMEMAX.parallaxBanner = function () {
  if($(".parallax-banner").length != 0) {
     $('.js-scene').parallax();
  }
};

/*-------------------------*/
/* Counters Skill */
/*-------------------------*/
THEMEMAX.counters = function () {
  if ($counter.exists()) {
    var timer = $('.timer');
      if(timer.length) {
        timer.appear(function () {
          timer.countTo();
      });
    }
  }
};

/*-------------------------*/
/* Rounded Skill */
/*-------------------------*/
THEMEMAX.roundedSkill = function () {
      var $roundedSkillEl = $('.rounded-skill');
      if( $roundedSkillEl.length > 0 ){
        $roundedSkillEl.each(function(){
          var element = $(this);
          var roundSkillSize = element.attr('data-size');
          var roundSkillSpeed = element.attr('data-speed');
          var roundSkillWidth = element.attr('data-width');
          var roundSkillColor = element.attr('data-color');
          var roundSkillCap = element.attr('data-cap');
          var roundSkillTrackColor = element.attr('data-trackcolor');
          if( !roundSkillSize ) { roundSkillSize = 140; }
          if( !roundSkillSpeed ) { roundSkillSpeed = 2000; }
          if( !roundSkillWidth ) { roundSkillWidth = 8; }
          if( !roundSkillColor ) { roundSkillColor = '#0093BF'; }
          if( !roundSkillCap ) { roundSkillCap = 'square'; }
		     if( !roundSkillTrackColor ) { roundSkillTrackColor = 'rgba(200,200,200,0.2)'; }
          var properties = {roundSkillSize:roundSkillSize, roundSkillSpeed:roundSkillSpeed, roundSkillWidth:roundSkillWidth, roundSkillColor:roundSkillColor, roundSkillCap:roundSkillCap, roundSkillTrackColor:roundSkillTrackColor};
           element.css({'width':roundSkillSize+'px','height':roundSkillSize+'px','line-height':roundSkillSize+'px'}).animate({opacity:0}, 10);
            element.appear(function () {
              if (!element.hasClass('skills-animated')) {
                var t = setTimeout( function(){ element.css({opacity: 1}); }, 100 );
                runRoundedSkills( element, properties );
                element.addClass('skills-animated');
              }
            });
        });      

       }
    function runRoundedSkills( element, properties){
      element.easyPieChart({
        size: Number(properties.roundSkillSize),
        animate: Number(properties.roundSkillSpeed),
        scaleColor: false,
        trackColor: properties.roundSkillTrackColor,
        lineWidth: Number(properties.roundSkillWidth),
        lineCap: properties.roundSkillCap,
        barColor: properties.roundSkillColor
      });
    }
}


/*-------------------------*/
/* Masonry */
/*-------------------------*/
THEMEMAX.masonry = function () {
    var $masonry = $('.masonry-main .masonry'),
      $itemElement = '.masonry-main .masonry-item';
      if ($masonry.exists()) {
        $masonry.isotope({
          resizable: true,
          itemSelector: $itemElement,
          masonry: {
            gutterWidth: 10
          }
        });
     }  
}

/*-------------------------*/
/* Isotope */
/*-------------------------*/
THEMEMAX.Isotope = function () {
      if ($('.b-isotope').length > 0) {
        var $container = $('.b-isotope-grid');
        // init Isotope
        var $grid = $('.grid').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });

        // layout Isotope after each image loads
        $grid.imagesLoaded().progress(function() {
            $grid.isotope('layout');
        });
        // filter items when filter link is clicked
        $('.b-isotope-filter a').on('click', function() {
            var selector = $(this).attr('data-filter');
            $container.isotope({
                filter: selector
            });
            return false;
        });
        $('.b-isotope-filter a').on('click', function() {
            $('.b-isotope-filter').find('.current').removeClass('current');
            $(this).parent().addClass('current');
        });
    }
}

/*-------------------------*/
/* Footer Sticky */
/*-------------------------*/
THEMEMAX.footerSticky = function () {
  var footer = $(".site-footer").height();
  $(".sticky-footer .site-content-contain").css({'margin-bottom': footer})
}

/*-------------------------*/
/* Countdown */
/*-------------------------*/
THEMEMAX.countdownTimer = function () {
  $('[data-countdown]').each(function () {
      var $this = $(this),
          finalDate = $(this).data('countdown');
      if (!$this.hasClass('countdown-full-format')) {
          $this.countdown(finalDate, function (event) {
              $this.html(event.strftime('<div class="single"><h3>%D</h3><span>Days</span></div> <div class="single"><h3>%H</h3><span>Hrs</span></div> <div class="single"><h3>%M</h3><span>Mins</span></div> <div class="single"><h3>%S</h3><span>Secs</span></div>'));
          });
      } else {
          $this.countdown(finalDate, function (event) {
              $this.html(event.strftime('<div class="single"><h3>%Y</h3><span>Years</span></div> <div class="single"><h3>%m</h3><span>Months</span></div> <div class="single"><h3>%W</h3><span>Weeks</span></div> <div class="single"><h3>%d</h3><span>Days</span></div> <div class="single"><h3>%H</h3><span>Hrs</span></div> <div class="single"><h3>%M</h3><span>Mins</span></div> <div class="single"><h3>%S</h3><span>Secs</span></div>'));
          });
      }
    });
};

/*----------------------------*/
/* Woocommerce SwitchToGrid */
/*----------------------------*/
THEMEMAX.woocommerceSwitch = function () {
    $('.list.switchToGrid').on('click', function() {
        $('.products').addClass('product-grid-view');
        $('.products').removeClass('product-list-view');                        
    });
    
    $('.grid.switchToList').on('click', function() {  
        $('.products').removeClass('product-grid-view');               
        $('.products').addClass('product-list-view');                        
    });
};

/*-------------------------*/
/* Back to Top */
/*-------------------------*/
THEMEMAX.goToTop = function () {
  var $goToTop = $('#back-to-top');
      $goToTop.hide();
    	$window.scroll(function(){
  		  if ($window.scrollTop()>100) $goToTop.fadeIn();
  		  else $goToTop.fadeOut();
  	  });

  	$goToTop.on("click", function () {
  		$('body,html').animate({scrollTop:0},1000);
  		return false;
    });
}

THEMEMAX.mobileGoTop = function () {
  var $mobileGoTop = $('#mobile-go-top');
  $mobileGoTop.on("click", function () {
      $('body,html').animate({scrollTop:0},1000);
      $('body').removeClass('mobile-navbar_activated');
      return false;
  });
}

/*-------------------------*/
/* Mobile Click */
/*-------------------------*/
THEMEMAX.mobileClick = function () {
  $('.slicknav_btn').attr('id','slickbtn');
  if ($("#click-audio").exists()) {
      var audio = $("#click-audio")[0];
      $("#slickbtn, .navbar-trigger").click(function() {
          audio.volume = 0.7;
          audio.play();
      });
  }
}

/*-------------------------*/
/* Mobile Bottom Navbar */
/*-------------------------*/
THEMEMAX.mobileBottomNavbar = function () {
    $(".navbar-trigger").click(function () {
        $("body").toggleClass("mobile-navbar_activated");
    });
};

/*===============================================*/
/* THEMEMAX Window load and functions */
/*===============================================*/
//Window load Resize functions
$window.bind("load resize", function() {
    THEMEMAX.pageHeaderMobile();
});

//Window load functions
$window.load(function () {
    THEMEMAX.preloader(),
    THEMEMAX.classAdd(),  
    THEMEMAX.stickyHeader(),
    THEMEMAX.slickNav(),
    THEMEMAX.onePageMenu(),
    THEMEMAX.masonry(),
    THEMEMAX.Isotope(),
    THEMEMAX.footerSticky(),
    THEMEMAX.progressBar(),
    THEMEMAX.mobileClick();
});

//Document ready functions
$document.ready(function () {
	  THEMEMAX.headerSearch(),
    THEMEMAX.headerSidemenu(),
    THEMEMAX.swiperSlider(),
    THEMEMAX.mediaPopups(),
    THEMEMAX.parallaxBanner(),
    THEMEMAX.counters(),
    THEMEMAX.roundedSkill(),
    THEMEMAX.countdownTimer(),
    THEMEMAX.woocommerceSwitch(),
    THEMEMAX.goToTop(),
    THEMEMAX.mobileGoTop(),
    THEMEMAX.mobileBottomNavbar(); 
});

})(jQuery);