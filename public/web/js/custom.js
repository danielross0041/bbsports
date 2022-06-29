$('.responsive').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});




function openCity(evt, cityName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}



// Tab Slider JS
$(function() {
  // Owl Carousel
  // var owl = $(".owl-carousel");
  // owl.owlCarousel({
  //   items: 3,
  //   margin: 10,
  //   loop: true,
  //   nav: false,
  //   dots:false,
  // });
});
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
 window.console = window.console || function(t) {};
 jQuery(document).ready(function ($) {
  var owl = $("#owl-demo-2");
  // owl.owlCarousel({
  //   autoplay: true,
  //   autoplayTimeout: 1000,
  //   autoplayHoverPause: true,
  //   items: 3,
  //   loop: true,
  //   center: false,
  //   rewind: false,
  //   mouseDrag: true,
  //   touchDrag: true,
  //   pullDrag: true,
  //   freeDrag: false,
  //   margin: 0,
  //   stagePadding: 0,
  //   merge: false,
  //   mergeFit: true,
  //   autoWidth: false,
  //   startPosition: 0,
  //   rtl: false,
  //   smartSpeed: 250,
  //   fluidSpeed: false,
  //   dragEndSpeed: false,
  //   responsive: {
  //     0: {
  //       items: 1
  //       // nav: true
  //     },
  //     480: {
  //       items: 2,
  //       nav: false },

  //     768: {
  //       items: 3,
  //       // nav: true,
  //       loop: false },

  //     992: {
  //       items: 4,
  //       // nav: true,
  //       loop: false } },


  //   responsiveRefreshRate: 200,
  //   responsiveBaseElement: window,
  //   fallbackEasing: "swing",
  //   info: false,
  //   nestedItemSelector: false,
  //   itemElement: "div",
  //   stageElement: "div",
  //   refreshClass: "owl-refresh",
  //   loadedClass: "owl-loaded",
  //   loadingClass: "owl-loading",
  //   rtlClass: "owl-rtl",
  //   responsiveClass: "owl-responsive",
  //   dragClass: "owl-drag",
  //   itemClass: "owl-item",
  //   stageClass: "owl-stage",
  //   stageOuterClass: "owl-stage-outer",
  //   grabClass: "owl-grab",
  //   autoHeight: false,
  //   lazyLoad: false });


  $(".next").click(function () {
    owl.trigger("owl.next");
  });
  $(".prev").click(function () {
    owl.trigger("owl.prev");
  });
});

 if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }












      $(document).ready(function() {
     
      // $(".owl-carousel").owlCarousel();
      $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        //e.target // newly activated tab
        //e.relatedTarget // previous active tab
        //$(".owl-carousel").trigger('refresh.owl.carousel');
      });
    });





$('.partner-slider').on('init',function(){
    $(".slick-active").prev().removeClass('nextdiv').addClass('prevdiv');
    $(".slick-active").next().removeClass('prevdiv').addClass('nextdiv');
});

$('.partner-slider').slick({

  dots: true,

  infinite: true,

  speed: 300,

  autoplay: false,

  slidesToShow: 3,

  slidesToScroll: 1,
 
  centerMode: true,

  centerPadding:'0px',

  

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 3,

        slidesToScroll: 3,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }


    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

 

}).on('afterChange',function(){
    console.log($(".slick-active"));
    $(".slick-active").prev().removeClass('nextdiv').addClass('prevdiv');
    $(".slick-active").next().removeClass('prevdiv').addClass('nextdiv');
});
 




$('.work-slider').slick({

  dots: false,

  infinite: true,

  speed: 300,

  autoplay: true,

  slidesToShow: 3,

  slidesToScroll: 1,

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 3,

        slidesToScroll: 3,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }

    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

});

$('.family-slider').slick({

  dots: true,

  infinite: true,

  speed: 300,

  autoplay: true,

  slidesToShow: 9,

  slidesToScroll: 1,

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 3,

        slidesToScroll: 3,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }

    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

});



$('.testi-slider').slick({

  dots: true,

  infinite: true,

  speed: 300,

  autoplay: true,

  slidesToShow: 3,

  slidesToScroll: 1,

  responsive: [

    {

      breakpoint: 1024,

      settings: {

        slidesToShow: 3,

        slidesToScroll: 3,

        infinite: true,

        dots: true

      }

    },

    {

      breakpoint: 600,

      settings: {

        slidesToShow: 2,

        slidesToScroll: 2

      }

    },

    {

      breakpoint: 480,

      settings: {

        slidesToShow: 1,

        slidesToScroll: 1

      }

    }

    // You can unslick at a given breakpoint now by adding:

    // settings: "unslick"

    // instead of a settings object

  ]

});















// Gallery

// 



$(document).ready(function(){



    $(".filter-button").click(function(){

        var value = $(this).attr('data-filter');

        

        if(value == "all")

        {

            //$('.filter').removeClass('hidden');

            $('.filter').show('1000');

        }

        else

        {

//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');

//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');

            $(".filter").not('.'+value).hide('3000');

            $('.filter').filter('.'+value).show('3000');

            

        }

    });

    

    if ($(".filter-button").removeClass("active")) {

$(this).removeClass("active");

}

$(this).addClass("active");



});

















// Menu Js

(function($) {

$.fn.menumaker = function(options) {  

 var cssmenu = $(this), settings = $.extend({

   format: "dropdown",

   sticky: false

 }, options);

 return this.each(function() {

   $(this).find(".button").on('click', function(){

     $(this).toggleClass('menu-opened');

     var mainmenu = $(this).next('ul');

     if (mainmenu.hasClass('open')) { 

       mainmenu.slideToggle().removeClass('open');

     }

     else {

       mainmenu.slideToggle().addClass('open');

       if (settings.format === "dropdown") {

         mainmenu.find('ul').show();

       }

     }

   });

   cssmenu.find('li ul').parent().addClass('has-sub');

multiTg = function() {

     cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');

     cssmenu.find('.submenu-button').on('click', function() {

       $(this).toggleClass('submenu-opened');

       if ($(this).siblings('ul').hasClass('open')) {

         $(this).siblings('ul').removeClass('open').slideToggle();

       }

       else {

         $(this).siblings('ul').addClass('open').slideToggle();

       }

     });

   };

   if (settings.format === 'multitoggle') multiTg();

   else cssmenu.addClass('dropdown');

   if (settings.sticky === true) cssmenu.css('position', 'fixed');

resizeFix = function() {

  var mediasize = 1000;

     if ($( window ).width() > mediasize) {

       cssmenu.find('ul').show();

     }

     if ($(window).width() <= mediasize) {

       cssmenu.find('ul').hide().removeClass('open');

     }

   };

   resizeFix();

   return $(window).on('resize', resizeFix);

 });

  };

})(jQuery);



(function($){

$(document).ready(function(){

$("#cssmenu").menumaker({

   format: "multitoggle"

});

});

})(jQuery);





 $('.slider-for').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: true,
  fade: true,
  asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-for',
  dots: false,
  centerMode: true,
  focusOnSelect: true
});








