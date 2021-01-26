$(document).ready(function () {

    $('.bxslider-gallery').bxSlider({
        pagerCustom: '#bx-pager-gallery',
        infiniteLoop: false,
        controls: false
    });








    ////////////////////////////////////////////////////
    // $('.mob-button').click(function () {
    //     var This = $(this);
    //     This.children('i').toggleClass('uk-icon-angle-down uk-icon-angle-up');
    //     This.closest("li").toggleClass('active').find('.menu-sub').slideToggle();
    // });
    //
    // $('.button-mobile-menu').click(function () {
    //     $(this).toggleClass('active').next().fadeToggle(300);
    // });
    //
    // $('.spoiler-title ').click(function () {
    //     thisElement = $(this);
    //     thisElement.find('span').toggleClass('uk-icon-angle-down uk-icon-angle-up');
    //     thisElement.toggleClass('active').next().slideToggle();
    // });

    //mobile-menu




















    /*main-menu*/
    $('body').on('click', '.main-menu-left .click-arrow', function () {
        var This = $(this);
        var parent = This.parents('li');
        parent.toggleClass('active').find('.dropdown:first').stop(true, true).slideToggle();
        This.toggleClass('.uk-icon-angle-right uk-icon-angle-up');
    });

    $('#button-search-top').on('click', function () {
        $('#search-panel-top').fadeToggle();
    });
    $('#search-panel-top .close').on('click', function () {
        $('#search-panel-top').fadeOut();
    });








    /**/
    $('.bx-slider').bxSlider({
        auto: true,
        autoHover: true,
        pause: 20000

    });

    /*slider-product*/
    $('.bx-poduct').bxSlider({
        // pagerCustom: '#bx-poduct-pager',
        controls: false
    });
    // $('#bx-poduct-pager').bxSlider({
    //     minSlides: 4,
    //     maxSlides: 4,
    //     slideWidth: 58,
    //     pager: false,
    //     infiniteLoop: false,
    //     slideMargin: 10
    // });


    $('.company-logo').owlCarousel({
        margin: 50,
        loop: true,
        autoWidth: true,
        // items: 1,
        navText: [],
        nav: true,
        items: 6
    });
    /**/
    var owl = $('.preview-product-slider').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
                margin: 15
            },
            480: {
                items: 2,
                margin: 15
            },
            860: {
                items: 3,
                margin: 15
            },
            1200: {
                items: 4,
                margin: 30
            }
        }
    });

    owl.owlCarousel();
// Go to the next item
    $('.customNextBtn').click(function () {
        owl.trigger('next.owl.carousel');
    });
// Go to the previous item
    $('.customPrevBtn').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl.trigger('prev.owl.carousel', [300]);
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
                center:true,
                loop:true,
                responsiveClass: true,
                autoWidth:true,
                margin:10,
            },

            768: {
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

    /**/
    var owl4 = $('.more-buy').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: false,
        responsive: {
            0: {
                items: 1,
                margin: 15
            },
            480: {
                items: 2,
                margin: 15
            },
            768: {
                items: 3,
                margin: 15
            },
            960: {
                items: 3,
                loop: false,
                margin: 30
            }
        }
    });

    owl4.owlCarousel();
// Go to the next item
    $('.customNextBtn').click(function () {
        owl4.trigger('next.owl.carousel');
    });
// Go to the previous item
    $('.customPrevBtn').click(function () {
        // With optional speed parameter
        // Parameters has to be in square bracket '[]'
        owl4.trigger('prev.owl.carousel', [300]);
    });
    /**/


    var owl5 = $('.certif-slider').owlCarousel({
        margin: 10,
        loop: true,
        autoWidth: true,
        items: 6,

        // nav: true,
        // navText: ['<i class="uk-icon-angle-left"></i>', '<i class="uk-icon-angle-right"></i>']
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


    $(".preview-product .owl-stage-outer").attr('data-uk-grid-match', "{target:'.outside-product'}");

    $("body").on("click", ".outside-product .arrow", function () {
        $(this).parents(".outside-product").next(".inside-product").slideDown().parent().addClass("open");

    });
    $("body").on("click", ".inside-product .arrow", function () {
        $(this).parents(".inside-product").slideUp().parent().removeClass("open");

    });


    // $('#menu-flex').flexMenu({
    //     linkText: "Ещё"
    // });

    //копия значения для scroll-menu
    counterValue();

    $(document).on('click', '.buy-btn', function () {
        setTimeout(function () {
            counterValue();
        }, 300)
    });

    function counterValue() {
        var countValue = $('#cartInner > .header-basket__count').text();
        $('.header-scroll .header-basket__count').text(countValue);
    }


});


