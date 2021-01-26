$(document).ready(function () {



    $('.bxslider-gallery').bxSlider({

        pagerCustom: '#bx-pager-gallery',

        infiniteLoop: false,

        controls: false

    });



    $('.spoiler-title ').click(function () {

        thisElement = $(this);

        thisElement.find('span').toggleClass('uk-icon-angle-down uk-icon-angle-up');

        thisElement.toggleClass('active').next().slideToggle();

    });



    //mobile-menu

    /*main-menu*/

    $('body').on('click', '.main-menu-left .click-arrow', function () {

        var This = $(this);

        var parent = This.parents('li');

        parent.toggleClass('active').find('.dropdown:first').stop(true, true).slideToggle();

        This.toggleClass('.uk-icon-angle-right uk-icon-angle-up');

    });



    var $searchButton = $('#button-search-top');

    var $searchButtonContainer = $('.js-search-button');



    $searchButton.on('click', function () {

        $('#search-panel-top').removeClass('fix').fadeToggle();

    });

    $('#search-panel-top .close').on('click', function () {

        $('#search-panel-top').fadeOut();

    });



    if ($searchButtonContainer.length) {

        $searchButton.appendTo($searchButtonContainer);

    }





    /**/

    $('.bx-slider').bxSlider({

        auto: true,

        // autoHover: true,

        // speed: 800,

        pause: 10000,

    });



    /*slider-product*/

    $('.bx-poduct').bxSlider({

        controls: false

    });



    $('.company-logo').owlCarousel({

        margin: 50,

        loop: true,

        autoWidth: true,

        navText: [],

        nav: true,

        items: 6,

        responsive: {

            0: {

                items: 1,

                margin: 10,

                center: false,

                autoWidth: false

            },



            420: {

                items: 2,

                margin: 10,

                autoWidth: false

            },



            600: {

                items: 4,

                margin: 10,

                autoWidth: false

            },



            768: {

                items: 6,

                margin: 10,

                center: false,

                autoWidth: false

            }

        }

    });

    /**/

    var owl = $('.preview-product-slider').owlCarousel({

        loop: true,

        responsiveClass: true,

        nav: false,

        center: true,

        mouseDrag: false,



        responsive: {

            0: {

                items: 1,

                margin: 10,

                center: false

            },



            580: {

                items: 2,

                margin: 10,

                center: true,

                mouseDrag: true

            },



            850: {

                items: 3,

                margin: 10,

                center: true

            },

            1130: {

                items: 4,

                margin: 15,

                center: true

            },

            1300: {

                items: 4,

                margin: 30,

                center: false

            }

        }

    });



    owl.owlCarousel();

//Go to the next item

    $('.preview-product-slider + .slider-controls .customNextBtn').click(function () {

        $(this).closest('.slider-controls').prev().trigger('next.owl.carousel', [300]);

    });

// Go to the previous item

    $('.preview-product-slider + .slider-controls .customPrevBtn').click(function () {

        // With optional speed parameter

        // Parameters has to be in square bracket '[]'

        // owl.trigger('prev.owl.carousel', [300]);

        $(this).closest('.slider-controls').prev().trigger('prev.owl.carousel', [300]);

    });



    /**/

    var owl2 = $('.preview-product-slider-second').owlCarousel({

        loop: true,

        responsiveClass: true,

        nav: false,

        responsive: {

            0: {

                items: 1,

                loop: false,

                margin: 30

            },

            480: {

                items: 1,

                loop: false,

                margin: 30

            },

            768: {

                items: 2,

                margin: 30,

                loop: false

            },

            960: {

                items: 2,

                loop: false,

                margin: 30

            }

        }

    });



    owl2.owlCarousel();

    // Go to the next item

    $('.customNextBtn').click(function () {

        owl2.trigger('next.owl.carousel');

    });

    // Go to the previous item

    $('.customPrevBtn').click(function () {

        // With optional speed parameter

        // Parameters has to be in square bracket '[]'

        owl2.trigger('prev.owl.carousel', [300]);

    });

    /**/





    var owl3 = $('.slider-sale').owlCarousel({

        loop: true,

        nav: false,

        items: 1,

        dots: false,



        responsive: {

            0: {

                items: 1,

                center: true,

                loop: true,

                responsiveClass: true,

                autoWidth: true,

                margin: 10

            },



            769: {

                center: false

            },



            1024: {

                items: 2

            }

        }

    });



    owl3.owlCarousel();

    // Go to the next item

    $('.slider-sale-wrap .customNextBtn').click(function () {

        owl3.trigger('next.owl.carousel');

    });

// Go to the previous item

    $('.slider-sale-wrap .customPrevBtn').click(function () {

        // With optional speed parameter

        // Parameters has to be in square bracket '[]'

        owl3.trigger('prev.owl.carousel', [300]);

    });

    /**/



    if ($(window).width() > 480) {

        var owl4 = $('.more-buy:not(.second-page-full .more-buy)').owlCarousel({

            loop: true,

            responsiveClass: true,

            nav: true,

            responsive: {

                0: {

                    items: 1,

                    margin: 15

                },

                480: {

                    items: 2,

                    margin: 15

                },

                767: {

                    items: 2,

                    margin: 15

                },

                1300: {

                    items: 3,

                    margin: 30

                }

            }

        });

        var owl4 = $('.second-page-full .more-buy').owlCarousel({

            loop: true,

            responsiveClass: true,

            nav: true,

            responsive: {

                0: {

                    items: 1,

                    margin: 15

                },

                576: {

                    items: 2,

                    margin: 15

                },

                768: {

                    items: 3,

                    margin: 15

                },

                992: {

                    items: 4,

                    margin: 30

                }

            }

        });

        // Go to the next item

        $('.more-buy + .slider-controls .customNextBtn').click(function () {

             $(this).closest('.slider-controls').prev().trigger('next.owl.carousel', [300]);

        });

        // Go to the previous item

        $('.more-buy + .slider-controls .customPrevBtn').click(function () {

            // With optional speed parameter

            // Parameters has to be in square bracket '[]'

            $(this).closest('.slider-controls').prev().trigger('prev.owl.carousel', [300]);

        });



    }



    if ($('.certificates-element').length > 1) {

    var owl5 = $('.certif-slider').owlCarousel({

        margin: 10,

        loop: true,

        autoWidth: true,

        items: 6,

        responsive: {

            0: {

                items: 1,

                margin: 10,

                loop: true,

                autoWidth: false

            },

            400: {

                margin: 10,

                loop: true,

                autoWidth: true,

                items: 6

            },

            1200: {

                margin: 10,

                loop: true,

                autoWidth: true,

                items: 6

            }

        }

    });



    owl5.owlCarousel();





    // Go to the next item

    $('.certif-slider-wrap .customNextBtn').click(function () {

        owl5.trigger('next.owl.carousel');

    });

    // Go to the previous item

    $('.certif-slider-wrap .customPrevBtn').click(function () {

        // With optional speed parameter

        // Parameters has to be in square bracket '[]'

        owl5.trigger('prev.owl.carousel', [300]);

    });

    /**/



    //убираем стрелки у слайдера, когда мало елементов

    (function () {

        if ($('.certif-slider').length) {



            var clearId = setInterval(function () {

                if (

                    $('.certif-slider .owl-stage-outer').width()

                    && $('.certif-slider .owl-stage').width()

                ) {

                    var outerWidth = $('.certif-slider .owl-stage-outer').width(),

                        innerWidth = $('.certif-slider .owl-stage').width() - 12;



                    if (innerWidth < outerWidth) {

                        $('.certif-slider-wrap .customNextBtn, .certif-slider-wrap .customPrevBtn').hide();

                    }

                    clearInterval(clearId);

                }

            }, 100);

        }

    })();



    } else {

        $('.certif-slider-wrap .customNextBtn').hide();

        $('.certif-slider-wrap .customPrevBtn').hide();

    }



    $(".preview-product .owl-stage-outer").attr('data-uk-grid-match', "{target:'.outside-product'}");



    $("body").on("click", ".outside-product .arrow", function () {

        $(this).parents(".outside-product").next(".inside-product").slideDown().parent().addClass("open");



    });

    $("body").on("click", ".inside-product .arrow", function () {

        $(this).parents(".inside-product").slideUp().parent().removeClass("open");



    });

});