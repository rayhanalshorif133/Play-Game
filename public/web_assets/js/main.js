(function ($) {
  "use strict";
  // Preloader
  $(window).on("load", function () {
    if ($("#preloader").length) {
      $("#preloader")
        .delay(100)
        .fadeOut("slow", function () {
          $(this).remove();
        });
    }
  });

  /*--/ Carousel owl /--*/
  $("#carousel").owlCarousel({
    loop: true,
    margin: -1,
    items: 1,
    nav: true,
    navText: [
      '<i class="fa fa-angle-left" aria-hidden="true"></i>',
      '<i class="fa fa-angle-right" aria-hidden="true"></i>',
    ],
    navText: [
      "<i class='fa fa-chevron-left'></i>",
      "<i class='fa fa-chevron-right'></i>",
    ],
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause: true,
    autoHeight: true,
    smartSpeed: 900,
  });

  /*--/ Animate Carousel /--*/
  $(".intro-carousel").on("translate.owl.carousel", function () {
    $(".intro-content .intro-title").removeClass("zoomIn animated").hide();
    $(".intro-content .intro-price").removeClass("fadeInUp animated").hide();
    $(".intro-content .intro-title-top, .intro-content .spacial")
      .removeClass("fadeIn animated")
      .hide();
  });

  $(".intro-carousel").on("translated.owl.carousel", function () {
    $(".intro-content .intro-title").addClass("zoomIn animated").show();
    $(".intro-content .intro-price").addClass("fadeInUp animated").show();
    $(".intro-content .intro-title-top, .intro-content .spacial")
      .addClass("fadeIn animated")
      .show();
  });

  /*--/ one carousel /--*/
  $("#one_carousel").owlCarousel({
    loop: true,

    margin: 10,
    responsive: {
      0: {
        items: 1.5,
      },
      769: {
        items: 1.5,
      },
      992: {
        items: 1.5,
      },
    },
  });

  /*--/ Property owl owl /--*/
  // $('#property_single_carousel').owlCarousel({
  // 	loop: true,
  // 	margin: 0,
  // 	nav: true,
  // 	navText: ['<i class="ion-ios-arrow-back" aria-hidden="true"></i>', '<i class="ion-ios-arrow-forward" aria-hidden="true"></i>'],
  // 	responsive: {
  // 		0: {
  // 			items: 3,
  // 		}
  // 	}
  // });

  /*--/ two carousel /--*/
  $("#two_carousel").owlCarousel({
    loop: true,
    margin: 10,
    responsive: {
      0: {
        items: 3,
      },
      769: {
        items: 3,
      },
      992: {
        items: 3,
      },
    },
  });
  /*--/ three carousel /--*/
  $("#three_carousel").owlCarousel({
    loop: true,
    margin: 10,
    responsive: {
      0: {
        items: 3,
      },
      769: {
        items: 3,
      },
      992: {
        items: 3,
      },
    },
  });
  /*--/ animation-clips /--*/
  $("#four_carousel").owlCarousel({
    loop: true,
    margin: 10,
    responsive: {
      0: {
        items: 3,
      },
      769: {
        items: 3,
      },
      992: {
        items: 3,
      },
    },
  });

  /*--/ Testimonials owl /--*/
  $("#testimonial-carousel").owlCarousel({
    margin: 0,
    autoplay: true,
    nav: true,
    animateOut: "fadeOut",
    animateIn: "fadeInUp",
    navText: [
      '<i class="ion-ios-arrow-back" aria-hidden="true"></i>',
      '<i class="ion-ios-arrow-forward" aria-hidden="true"></i>',
    ],
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive: {
      0: {
        items: 3,
      },
    },
  });
})(jQuery);
