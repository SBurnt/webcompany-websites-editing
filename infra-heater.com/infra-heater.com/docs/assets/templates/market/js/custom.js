// возвращает куки с указанным name,
// или undefined, если ничего не найдено
function getCookie(name) {
    let matches = document.cookie.match(
        new RegExp('(?:^|; )' + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + '=([^;]*)')
    );
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

//поиск родителя
function getParents(e) {
    var result = [];
    for (var p = e && e.parentElement; p; p = p.parentElement) {
        result.push(p);
    }
    return result;
}

//Задаем куки
function setCookie(name, value, options = {}) {
    options = {
        path: '/',
        // при необходимости добавьте другие значения по умолчанию ...options
    };

    if (options.expires instanceof Date) {
        options.expires = options.expires.toUTCString();
    }

    let updatedCookie = encodeURIComponent(name) + '=' + encodeURIComponent(value);

    for (let optionKey in options) {
        updatedCookie += '; ' + optionKey;
        let optionValue = options[optionKey];
        if (optionValue !== true) {
            updatedCookie += '=' + optionValue;
        }
    }

    document.cookie = updatedCookie;
}

//Удаляет куки
function deleteCookie(name) {
    setCookie(name, '', {
        'max-age': -1,
    });
}

/*
function Tabs() {
    var counter = 1;
    var bindAll = function () {
        var menuElements = document.querySelectorAll("[data-tab]");
        var swTabs = document.querySelectorAll("[switch-tab]");
        for (var i = 0; i < menuElements.length; i++) {
            menuElements[i].addEventListener("click", change, false);
        }
        for (var y = 0; y < swTabs.length; y++) {
            swTabs[y].addEventListener("click", changeTab, false);
        }
    };

    var clear = function () {
        var menuElements = document.querySelectorAll("[data-tab]");
        for (var i = 0; i < menuElements.length; i++) {
            menuElements[i].parentElement.classList.remove("active");
            var id = menuElements[i].getAttribute("data-tab");
            document.getElementById(id).classList.remove("active");
        }
    };

    var change = function (e) {
        clear();
        e.target.parentElement.classList.add("active");
        var menuElements = document.querySelectorAll("[data-tab]");
        for (var i = 0; i < menuElements.length; i++) {
            if (menuElements[i] == e.target) {
                counter = i + 1;
                break;
            }
        }
        var id = e.currentTarget.getAttribute("data-tab");
        document.getElementById(id).classList.add("active");
    };

    var changeTab = function (e) {
        var swCount = document.querySelectorAll("[data-tab]");
        //var swCount = e.currentTarget.parentNode.parentNode.parentNode.querySelectorAll("[data-tab]");
        var side = e.currentTarget.getAttribute("switch-tab");
        var swActive = document.querySelector(".services-ten__tabs__switch.active");
        //var swActive = e.currentTarget.parentNode.parentNode.parentNode.querySelector(".services-ten__tabs__switch.active");
        // console.log(swActive);
        // console.log(swActive_test);
        swActive.classList.remove("active");
        if (side == "next" && counter < swCount.length) {
            swActive.nextElementSibling.classList.add("active");
            swActive.nextElementSibling.firstElementChild.click();
        } else if (side == "next" && counter >= swCount.length) {
            swCount[0].click();
            counter = 1;
        } else if (side == "prev" && counter > 1) {
            swActive.previousElementSibling.classList.add("active");
            swActive.previousElementSibling.firstElementChild.click();
        } else {
            swCount[swCount.length - 1].click();
            counter = swCount.length;
        }
    };
    bindAll();
}

var connectTabs = new Tabs();
*/

function servicesTenTabs() {
    $('.services-ten__tabs__switch').on('click', function () {
        var attrID = $(this).find('a').attr('data-tab');

        $(this)
            .closest('.services-ten')
            .find('.services-ten__tabs__switch, .services-ten__tabs__item')
            .removeClass('active');

        $(this)
            .addClass('active')
            .closest('.services-ten')
            .find('.services-ten__tabs__item[data-id="' + attrID + '"]')
            .addClass('active');
    });

    $('.services-ten__nav-prev').on('click', function () {
        var $tabs = $(this).closest('.services-ten').find('.services-ten__tabs__switch'),
            currentIndex = $tabs.index($(this).closest('.services-ten').find('.services-ten__tabs__switch.active'));

        if (!currentIndex) {
            $($tabs[$tabs.length - 1]).trigger('click');
        } else {
            $($tabs[currentIndex - 1]).trigger('click');
        }
    });

    $('.services-ten__nav__next').on('click', function () {
        var $tabs = $(this).closest('.services-ten').find('.services-ten__tabs__switch'),
            currentIndex = $tabs.index($(this).closest('.services-ten').find('.services-ten__tabs__switch.active'));

        if (currentIndex === $tabs.length - 1) {
            $($tabs[0]).trigger('click');
        } else {
            $($tabs[currentIndex + 1]).trigger('click');
        }
    });
}

/*Вывод прайса на печать*/

$(document).ready(function () {
    $('.print_bat').click(function (event) {
        event.preventDefault();

        $(this).parents('.table-price').addClass('printing');

        window.print();
    });

    //добавить файл

    $(document).on('change', 'input[type=file]', function () {
        var $self = $(this),
            filename = $self.val().replace(/.*\\/, ''),
            defaultValue = 'Выберите файл';

        $self.prev('.file-title').addClass('filled').text(filename);

        if ($self.val() !== defaultValue) {
            //появляется крестик

            $self.closest('.label-wrap-file').next('.file-remove-btn').fadeIn();
        }
    });

    //обработка input:file по нажатию крестика

    $(document).on('click', '.file-remove-btn', function () {
        var $self = $(this),
            defaultValue = 'Выберите файл';

        if ($self.closest('.field__wrap').find('.file-wrapper').length > 1) {
            $self.closest('.file-wrapper').remove();
        } else {
            $self
                .fadeOut()
                .closest('.file-wrapper')

                .find('.file-title')
                .text(defaultValue)

                .next('.filename')
                .val('');
        }
    });

    //Расширять изображения слайдера баннера если h менее 406 px
    var imgsSlider = $('.slider-main .slide-img');
    var normalHeight = 406;

    if (imgsSlider.length !== 0) {
        imgsSlider.each(function () {
            var curWidth = $(this).height();
            if (curWidth !== 406) {
                $(this).parent().addClass('bg-cover');
            }
        });
    }
    //

    //костыли для лого webcompany стандартного светлого подвала
    //и темного подвала с подпиской
    //удалить, когда лого сделают в svg

    // (function () {
    //   if ($(".footer-theme_gray").length) {
    //     $(".develop").find("img").attr("src", "assets/templates/market/img/webcompany-gray.png");
    //   }

    //   if ($(".footer-theme_dark").length) {
    //     $(".develop").find("img").attr("src", "assets/templates/market/img/webcompany.png");
    //   }
    // })();

    //тултип

    (function () {
        $(document).on('click', '.tooltip-wrap img', function () {
            if ($(this).parent().hasClass('active')) {
                $(this).parent().removeClass('active');
            } else {
                $('.tooltip-wrap').removeClass('active');

                $(this).parent().addClass('active');

                biggerThanWindow($(this).next('.tooltip-content'));
            }
        });

        function biggerThanWindow(el) {
            el.css({top: '', bottom: '', left: ''});

            var width = $(window).width(),
                left = el.offset().left,
                elWidth = el.outerWidth(),
                correctionLeft = width - left - elWidth - 20;

            if (correctionLeft < 0 && width >= 768) {
                el.css({top: 'auto', bottom: '145%', left: correctionLeft + 'px'});
            } else if (width < 400) {
                el.css({left: correctionLeft - 40 + 'px'});
            }
        }

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.tooltip-wrap').length && $('.tooltip-wrap').hasClass('active')) {
                $('.tooltip-wrap').removeClass('active');
            }
        });
    })();

    $("input[type='number']").stylerNumber();

    $('.slider-sale-item').setMaxHeights();

    // $('.select-radio-img-list li').setMaxHeights();

    $('.header-scroll-main-menu').css({overflow: 'visible'});

    window.fromDesktop = 0;

    basketMobileMarkup();

    onMobileBasket();

    flexMenuArrow();

    asideFilterSlideToggle();

    checkedInput();

    customSelect();

    filterSpoilar();

    preventEnterSubmit();

    filterSelectPosition();

    filterArrowMobile();

    filterResize();

    currentActiveTopNav();

    customPlaceholderInit();

    validateForms();

    calcWindowWidth();

    setHeightMainSliderMobile();

    addInputTypeFile();

    addFile();

    tabs();
    tabsPanelService();
    tabsPanelProject();
    tabsPanelCatalog();

    setCounterValue();

    setMaxHeightTextarea();

    delScrollMenu();

    sideBasket();

    customSettingsInit();

    colorPickerInit();

    // checkboxDragNDrop();

    // calculateCatalogElHeight();
    deleteClassOrder480();

    catalogElements();

    noBorderInfoHeader();
    noArticleAvail();

    if ($('.services-ten__tabs__switch').length) {
        servicesTenTabs();
    }

    if ($('.left-bar .left-bar__banners-wrap').length) {
        console.log('.left-bar .left-bar__banners-wrap');
        // scrollLeftBarBanners();
    }

    setTimeout(function () {
        scrollMenu();
    }, 1200);

    $(document).on('click', '.customer-settings', function (e) {
        if (!!e.target.closest('label.radio') || !!e.target.closest('label.checkbox')) {
            $('.customer-settings').addClass('js_footer-show');
        }
    });
});

$(window).resize(function () {
    basketMobileMarkup();

    onMobileBasket();

    flexMenuArrow();

    filterArrowMobile();

    filterResize();

    filterSpoilar();

    calcWindowWidth();

    setHeightMainSliderMobile();

    closeSideBasketOnMobile();

    calculateCatalogElHeight();

    catalogElements();

    setTimeout(function () {
        scrollMenu();
    }, 1200);

    (function () {
        if ($(window).width() < 1025) {
            $('.wrap-menu').css('opacity', '1');
        }
    })();
});

/*Расшариваем ресурсы. social buttons. Added Rising13*/

Share = {
    vkontakte: function (purl, ptitle, pimg, text) {
        url = 'http://vkontakte.ru/share.php?';

        url += 'url=' + encodeURIComponent(purl);

        url += '&title=' + encodeURIComponent(ptitle);

        url += '&description=' + encodeURIComponent(text);

        url += '&image=' + encodeURIComponent(pimg);

        url += '&noparse=true';

        Share.popup(url);
    },

    odnoklassniki: function (purl, text) {
        url = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';

        url += '&st.comments=' + encodeURIComponent(text);

        url += '&st._surl=' + encodeURIComponent(purl);

        Share.popup(url);
    },

    facebook: function (purl, ptitle, pimg, text) {
        url = 'http://www.facebook.com/sharer.php?s=100';

        url += '&p[title]=' + encodeURIComponent(ptitle);

        url += '&p[summary]=' + encodeURIComponent(text);

        url += '&p[url]=' + encodeURIComponent(purl);

        url += '&p[images][0]=' + encodeURIComponent(pimg);

        Share.popup(url);
    },

    twitter: function (purl, ptitle) {
        url = 'http://twitter.com/share?';

        url += 'text=' + encodeURIComponent(ptitle);

        url += '&url=' + encodeURIComponent(purl);

        url += '&counturl=' + encodeURIComponent(purl);

        Share.popup(url);
    },

    mailru: function (purl, ptitle, pimg, text) {
        url = 'http://connect.mail.ru/share?';

        url += 'url=' + encodeURIComponent(purl);

        url += '&title=' + encodeURIComponent(ptitle);

        url += '&description=' + encodeURIComponent(text);

        url += '&imageurl=' + encodeURIComponent(pimg);

        Share.popup(url);
    },

    googleplus: function (purl) {
        url = 'https://plus.google.com/share?';

        url += 'url=' + encodeURIComponent(purl);

        Share.popup(url);
    },

    popup: function (url) {
        window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
    },
};

$(document).ready(function () {
    //добавление поля для промежуточной точки

    function intermediatePoint() {
        var itemInput = 1;

        $('.form-transfer').on('click', '.form-transfer__add-point', function () {
            var cloneWrap = $('.clone-wrap:first').clone(true);

            var delAddress = '<div class="del-adress">отменить</div>';

            var input = cloneWrap.find('input');

            if ((itemInput = 1)) {
                cloneWrap.append(delAddress);
            }

            input.attr('name', function () {
                itemInput++;

                return 'address' + itemInput;
            });

            input.val('');

            cloneWrap.appendTo('#add-input');
        });

        $('.form-transfer').on('click', '.del-adress', function () {
            $(this).parent('.clone-wrap').remove();
        });
    }

    intermediatePoint();

    $('.datepicker').datepicker({
        weekStart: 1,

        daysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],

        months: [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь',
        ],

        monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],

        format: 'dd/mm/yyyy',

        autoPick: true,
    });

    $('.datepicker-form').datepicker({
        weekStart: 1,

        daysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],

        months: [
            'Январь',
            'Февраль',
            'Март',
            'Апрель',
            'Май',
            'Июнь',
            'Июль',
            'Август',
            'Сентябрь',
            'Октябрь',
            'Ноябрь',
            'Декабрь',
        ],

        monthsShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],

        format: 'dd/mm/yyyy',

        // autoPick: false,

        hide: function () {
            var self = $(this);

            setTimeout(function () {
                self.blur();
            }, 0);
        },

        autoHide: true,

        zIndex: 22048,
    });

    // $(document).on('click', '.datepicker-form',function () {

    //     datapickerForm

    // })

    // $(".datepicker-form").datepicker({create:function(){alert("Привет")}}).

    /*Раскрываем левое меню*/

    $('.main-menu-left ul.dropdown li.active').parents('li').addClass('active');

    $('.main-menu-left li.active > ul.dropdown').show();

    $('.main-menu-left li.active > .wrap > span').addClass('uk-icon-angle-up');

    $('.main-menu-left li.active > .wrap > span').addClass('uk-icon-angle-up');

    /*цвет блока availability*/

    function availabilityColor() {
        $('span.in-stock').parent().css({color: '#1bcc7b'});

        $('span.reservation').parent().css({color: '#e2821b'});

        $('span.not-available').parent().css({color: '#e51528'});
    }

    availabilityColor();

    /*стрелки в меню + активный верхний пункт*/

    $('ul.menu-sub').parent('li').addClass('nav-arrow');

    $('li.active').parents('li').addClass('active');

    //цветные изображения при ховере

    function hoverColorImg(target, dataName) {
        var newSrc, src, oldSrc, thisImg;

        $(document).on('mouseenter', target, function () {
            thisImg = $(this).find('img');

            newSrc = thisImg.attr(dataName);

            oldSrc = thisImg.attr('src');

            src = thisImg.attr('src', newSrc);
        });

        $(document).on('mouseleave', target, function () {
            thisImg.attr('src', oldSrc);
        });

        if ($(window).width() <= 768 && !~target.indexOf('footer')) {
            $(target).each(function () {
                thisImg = $(this).find('img');

                newSrc = thisImg.attr(dataName);

                src = thisImg.attr('src', newSrc);
            });
        }
    }

    hoverColorImg('div.company-element', 'data-srchover');

    hoverColorImg('.footer-var-1 div.footer-top div.social a', 'data-src_soc_icon_bottom');

    hoverColorImg('.footer .develop a', 'data-srchover');

    function flexMenuTxt(header) {
        $(header + ' #menu-flex').flexMenu({
            linkText: '• • •',
        });
    }

    setTimeout(function () {
        flexMenuTxt('.header-top-var-1');

        flexMenuTxt('.header-top-var-2');

        flexMenuTxt('.header-top-var-1_1');

        flexMenuTxt('.header-top-var-1_2');

        flexMenuTxt('.header-top-var-1_3');

        flexMenuTxt('.header-top-var-1_4');

        flexMenuTxt('.header-top-var-2_1');

        flexMenuTxt('.header-top-var-2_2');

        flexMenuTxt('.header-top-var-2_3');

        flexMenuTxt('.header-top-var-3_1');

        flexMenuTxt('.header-top-var-3_2');

        flexMenuTxt('.header-top-var-4_1');

        flexMenuTxt('.header-top-var-4_2');

        flexMenuTxt('.header-top-var-4_3');

        flexMenuTxt('.header-top-var-4_4');

        flexMenuTxt('.header-top-var-4_5');

        flexMenuTxt('.header-top-var-5_1');

        flexMenuTxt('.header-top-var-5_2');

        flexMenuTxt('.header-top-var-5_3');

        flexMenuTxt('.header-top-var-5_4');

        flexMenuTxt('.header-top-var-6_1');

        flexMenuTxt('.header-top-var-6_2');

        flexMenuTxt('.header-top-var-6_3');

        flexMenuTxt('.header-top-var-7_1');

        flexMenuTxt('.header-top-var-7_2');

        $('#menu-flex').flexMenu({
            linkText: 'Ещё',
        });

        $('#menu-flex-scroll, #header-trim-nav').flexMenu({
            linkText: 'Меню',
        });

        $('.header-variable-2__nav .menu').flexMenu({
            linkText: '• • •',
        });
    }, 0);

    //перемещение корзины в мобильный хеадер

    if ($('.flex-center-bar #shopCart').length && $(window).width() <= 1024) {
        var cart = $('#shopCart');

        cart.appendTo($('.search-wrap'));
    }

    // -------------------------------------------------------------------------------

    fileType($('a[download]'), '.card-documents__el-img');

    //выпадающая корзина в header

    $('.scroll-floating-basket-items, .side-basket tbody').mCustomScrollbar({
        axis: 'y',

        scrollInertia: 300,

        scrollbarPosition: 'outside',

        mouseWheel: {preventDefault: true},
    });

    var leaveBasket = true;

    function checkLeaveBasket() {
        setTimeout(function () {
            if (leaveBasket) {
                $('.basket-under-header').removeClass('active');
            }
        }, 500);
    }

    $('body').on('mouseenter', '#cartInner, .basket-under-header', function () {
        leaveBasket = false;

        $('.basket-under-header').addClass('active');
    });

    $('body').on('mouseleave', '#cartInner, .basket-under-header', function () {
        leaveBasket = true;

        checkLeaveBasket();
    });

    //обрезка текста по длине

    function cropText(item, size) {
        item.each(function () {
            var newsText = $(this).text();

            if (newsText.length > size) {
                $(this).text(newsText.slice(0, size) + '...');
            }
        });
    }

    cropText($('.side-basket__lnk'), 62);

    //вычисляем top для заголовка услуг

    if ($(document).width() > 1025) {
        servicesTop();

        $(document).on('click', '.services-main .view-more', function () {
            setTimeout(function () {
                servicesTop();
            }, 500);
        });
    }

    function servicesTop() {
        $('div.services-element div.content').each(function (i, item) {
            var topPosition = $(this).position().top + 'px';

            $(this).css({top: topPosition});
        });
    }

    if ($(document).width() < 1025) {
        $('.dignity-main-element').setMaxHeights();
    }

    // вычисляем bottom и right для выполненых проектов
    // задержка задана из-за слайдера
    // не понял для чего этот код все и так стилями задано, поэтому заккоментил,
    // т.к. при ширине экрана >1300px фон заголовка расширялся
    // setTimeout(function () {
    //   $("div.completed-project-content").each(function (i, item) {
    //     var projectBottom = $(this).prev().height() - $(this).height() + "px";

    //     //-1px из-за дробной части в пикселях
    //     var projectRight = $(this).prev().outerWidth() - $(this).outerWidth() - 1 + "px";

    //     $(this).css({ bottom: projectBottom, right: projectRight });
    //   });
    // }, 500);

    // отмена центрирования при переполнении контента услуг
    function overflowInfo(el, maxHeight) {
        $(el).each(function (i, item) {
            var innerBlocks = $(this).children();

            var infoHeight = 0;

            innerBlocks.each(function () {
                infoHeight += $(this).outerHeight(true);
            });

            if (infoHeight > maxHeight) {
                $(this).addClass('flex-start');
            }
        });
    }

    overflowInfo('.projects-page .completed-projects-slider__info', 159);

    overflowInfo('.catalog-element__info', 122);

    //кнопка поиска скролл-меню

    $('.header-scroll').on('click', '.header-scroll__search-btn', function () {
        $('#search-panel-top').toggleClass('fix').show();
    });

    //аккордеон

    $('.question-wrap').on('click', '.question-el', function (e) {
        var el = $(this);

        if (!$(e.target).closest('.upload-file').length) {
            if (el.hasClass('active')) {
                el.removeClass('active').find('.question-answer').slideUp();

                return false;
            }

            $('.question-el').removeClass('active').find('.question-answer').slideUp();

            el.addClass('active').find('.question-answer ').slideToggle();
        }
    });

    //страница проекты, поверка на пустой правый блок

    function projectBlocks() {
        $('.projects-card').each(function () {
            var elems = $(this).find($('.projects-card-info-wrap > *').not($('.projects-card-info-lnk-wrap')));

            if (!elems.length && $(this).find($('.projects-card-info-lnk-wrap')).length) {
                $('.projects-card-info-wrap').addClass('empty');
            }
        });
    }

    projectBlocks();

    //копирование телефонов в мобильную версию из шапки

    mobilePhone();

    function mobilePhone() {
        var $phonesSource = $('.center-bar .header-phone-wrap a'),
            $ul = $('<ul class="mobile-menu__phones-list"></ul>');

        $phonesSource.each(function () {
            $ul.append($('<li>' + $(this).get(0).outerHTML + '</li>'));
        });

        $('.mobile-menu__callback-hidden').prepend($ul);

        $('.mobile-menu__phones-list').find('a').removeClass().addClass('mobile-menu__phones');
    }

    hasBasket();

    //мобильное меню

    var mobileMenuBtn = $('span.button-mobile-menu');

    var menuMobileContainer = $('div.wrap-menu');

    var mobileMenuInner = $('div.mobile-menu-inner');

    var scrollAxisY = 0;

    mobileMenuBtn.on('click', function () {
        if (!$('body').hasClass('mobile-active')) {
            scrollAxisY = $(window).scrollTop();
        }

        $(this).toggleClass('active');

        menuMobileContainer.toggleClass('active');

        $('body').toggleClass('mobile-active');

        if (mobileMenuInner.hasClass('active')) {
            mobileMenuInner.removeClass('active');

            $(window).scrollTop(scrollAxisY);
        } else {
            mobileMenuInner.addClass('active');
        }
    });

    $(document).on('click', function (e) {
        if (menuMobileContainer.hasClass('active') && !$(e.target).closest(menuMobileContainer).length) {
            mobileMenuBtn.removeClass('active');
            menuMobileContainer.removeClass('active');
            mobileMenuInner.removeClass('active');
            $('body').removeClass('mobile-active');
            e.preventDefault();
            e.stopPropagation();
        }
    });

    $('div.mobile-menu-inner').on('click', '.mob-button', function () {
        $(this).toggleClass('active').parent().next('ul.menu-sub').slideToggle();
    });

    //скролл хлебных крошек в мобилке

    $('.breadcrumbs-wrap').mCustomScrollbar({
        axis: 'x',

        scrollInertia: 300,

        scrollbarPosition: 'inside',
    });

    //телефоны хеадера мобилка

    $('div.mobile-menu__callback').on('click', function () {
        $('.mobile-menu__callback-hidden-wrap').toggleClass('active');
    });

    $(document).on('click', function (e) {
        if (
            $('.mobile-menu__callback-hidden-wrap').hasClass('active') &&
            !$(e.target).closest('.mobile-menu__callback').length
        ) {
            $('.mobile-menu__callback-hidden-wrap').removeClass('active');
        }
    });

    //ширина слайдера новинок

    function prewievSliderWidth() {
        if ($(document).width() <= 1300 && $('.preview-product').length) {
            var doubleMargin =
                parseFloat(
                    $('.preview-product')
                        .find('.container')

                        .css('margin-left')
                ) *
                2 +
                'px';

            $('.preview-product .preview-product-slider, .preview-product .preview-product-slider-second').css({
                width: 'calc(100% + ' + doubleMargin + ')',
            });
        }
    }

    //меняем z-index кнопки получить консультаию при ховере на слайдер

    $('.preview-product-element').hover(
        function () {
            $('.callback-main__button').css({'z-index': '0'});
        },

        function () {
            $('.callback-main__button').css({'z-index': ''});
        }
    );

    //слайдер карточки товара

    $('.main-first-image-slider').slick({
        prevArrow:
        '<div class="customPrevBtn">' +
        '<img src="assets/templates/market/img/sprite/arr-slider-prev.png" alt="">' +
        '</div>',

        nextArrow:
        '<div class="customNextBtn">' +
        '<img src="assets/templates/market/img/sprite/arr-slider-next.png" alt="">' +
        '</div>',

        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,

        customPaging: function (slider, i) {
            var source = $(slider.$slides[i]).find('img').attr('src') + '';

            return '<a class="pager__item"><img src=' + source + '></a>';
        },

        responsive: [
            {
                breakpoint: 960,
                dots: false,
            },
        ],
    });

    cropText($('.completed-project-content__title p'), 90);

    //слайдер выполненных проектов
    if ($(window).width() <= '990') {
        $('.index-completed-project-slider .completed-project-inner').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
            dots: false,
            responsive: [
                {
                    breakpoint: 990,
                    settings: {
                        slidesToShow: 2,
                        centerMode: true,
                        centerPadding: '20px',
                    },
                },
                {
                    breakpoint: 769,
                    settings: {
                        slidesToShow: 1,
                        centerMode: true,
                        centerPadding: '20px',
                    },
                },
            ],
        });
    }

    // слайдер новостей в разделе "О компании"
    (function () {
        // убираем flex для обертки .about-wrap, если отключен блок "О компании", иначе плывет слайдер
        var $company = $('.information-main .company');
        if ($company.length > 0) {
            $('.information-main .about-wrap').css('display', 'flex');
        } else {
            $('.information-main .about-wrap').css('display', 'block');
        }

        var $el = $('.news-wrap-mobile');
        var countEl = $el.find('.news-element').length;

        if (countEl > 1) {
            $el.slick({
                slidesToShow: 2,
                slidesToScroll: 1,
                // centerMode: true,
                arrows: false,
                dots: false,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            centerMode: true,
                            centerPadding: '20px',
                        },
                    },
                    {
                        breakpoint: 481,
                        settings: {
                            slidesToShow: 1,
                            centerMode: true,
                            centerPadding: '20px',
                        },
                    },
                ],
            });
        } else {
            $el.css({margin: '0'});
        }
    })();

    //слайдер отзывов
    if ($(document).width() <= 769) {
        window.onload = function () {
            $('.card-reviews-wrap')
                .slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    arrows: false,
                    dots: false,
                    centerPadding: '20px',
                })
                .find('.card-reviews-el')
                .setMinHeights();
        };
        $('.news-element .text').setMaxHeights();
    }

    (function () {
        var slider = $('.card-gallery-slider');

        slider.each(function (i) {
            $(this)
                .addClass('card-gallery-slider-' + i)
                .slick({
                    asNavFor: '.card-gallery-slider-pager-' + i,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    responsive: [
                        {
                            breakpoint: 768,
                            settings: {
                                dots: true,
                                asNavFor: null,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                infinite: true,
                                arrows: true,
                            },
                        },
                        {
                            breakpoint: 481,
                            settings: {
                                dots: true,
                                asNavFor: null,
                                slidesToShow: 1,
                                slidesToScroll: 1,
                                infinite: true,
                                arrows: false,
                            },
                        },
                    ],
                });

            if ($(window).width() > 767) {
                $(this)
                    .next('.card-gallery-slider-pager')

                    .addClass('card-gallery-slider-pager-' + i)
                    .slick({
                        asNavFor: '.card-gallery-slider-' + i,

                        slidesToShow: 9,

                        slidesToScroll: 1,

                        infinite: true,

                        focusOnSelect: true,

                        responsive: [
                            {
                                breakpoint: 1301,

                                settings: {
                                    arrows: false,

                                    slidesToShow: 8,

                                    variableWidth: true,
                                },
                            },
                        ],
                    });
            }
        });
    })();

    //слайдер выполненных проектов

    $('.completed-projects-slider').slick({
        slidesToShow: 1,

        slidesToScroll: 1,

        infinite: true,

        arrow: false,

        responsive: [
            {
                breakpoint: 768,

                settings: {
                    arrows: false,

                    slidesToShow: 2,

                    centerMode: true,

                    centerPadding: '30px',
                },
            },

            {
                breakpoint: 561,

                settings: {
                    arrows: false,

                    slidesToShow: 1,

                    centerMode: true,

                    centerPadding: '30px',
                },
            },
        ],
    });

    //кастомное управление для completed-projects-slider-wrap

    $('.completed-projects-slider-wrap .customNextBtn').on('click', function () {
        $('.completed-projects-slider').slick('slickNext');
    });

    $('.completed-projects-slider-wrap .customPrevBtn').on('click', function () {
        $('.completed-projects-slider').slick('slickPrev');
    });

    //пэйджер страницы проектов

    (function () {
        var slider = $('.projects-card-slider');

        slider.each(function (i) {
            $(this)
                .addClass('projects-card-slider-' + i)
                .slick({
                    slidesToShow: 1,

                    slidesToScroll: 1,

                    infinite: true,

                    asNavFor: '.projects-card-slider-pager-' + i,

                    prevArrow: '<div class="customPrevBtn"><img src="assets/templates/market/img/left-progect.svg" alt=""></div>',

                    nextArrow:
                        '<div class="customNextBtn"><img src="assets/templates/market/img/right-progect.svg" alt=""></div>',
                });

            $(this)
                .next('.projects-card-slider-pager')

                .addClass('projects-card-slider-pager-' + i)
                .slick({
                    slidesToShow: 5,

                    slidesToScroll: 1,

                    focusOnSelect: true,

                    asNavFor: '.projects-card-slider-' + i,

                    arrows: false,

                    responsive: [
                        {
                            breakpoint: 420,

                            settings: {
                                slidesToShow: 3,
                            },
                        },

                        {
                            breakpoint: 580,

                            settings: {
                                slidesToShow: 4,
                            },
                        },

                        {
                            breakpoint: 768,

                            settings: {
                                // slidesToShow: 1,
                                // centerMode: true,
                                // arrows: false,
                                // centerPadding: '30px'
                            },
                        },
                    ],
                });
        });
    })();

    //слайдер услуг

    $('.card-services-slider').slick({
        slidesToShow: 2,

        slidesToScroll: 1,

        arrow: false,

        responsive: [
            {
                breakpoint: 1025,

                settings: {
                    slidesToShow: 2,
                },
            },

            {
                breakpoint: 768,

                settings: {
                    slidesToShow: 1,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },
        ],
    });

    $('.card-services-slider-wrap .customNextBtn').on('click', function () {
        $('.card-services-slider').slick('slickNext');
    });

    $('.card-services-slider-wrap .customPrevBtn').on('click', function () {
        $('.card-services-slider').slick('slickPrev');
    });

    //слайдер услуг

    $('.recomended-slider').slick({
        slidesToShow: 2,

        slidesToScroll: 1,

        arrows: false,

        responsive: [
            {
                breakpoint: 768,

                settings: {
                    slidesToShow: 2,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },

            {
                breakpoint: 561,

                settings: {
                    slidesToShow: 1,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },
        ],
    });

    $('.recomended-slider-wrap .customNextBtn').on('click', function () {
        $('.recomended-slider').slick('slickNext');
    });

    $('.recomended-slider-wrap .customPrevBtn').on('click', function () {
        $('.recomended-slider').slick('slickPrev');
    });

    //слайдер новостей

    $('.news-element-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        responsive: [
            {
                breakpoint: 1042,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerMode: true,
                    arrows: false,
                    centerPadding: '30px',
                },
            },
            {
                breakpoint: 561,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    arrows: false,
                    centerPadding: '30px',
                },
            },
        ],
    });

    $('.news-date.news-slider-wrap .customNextBtn').on('click', function () {
        $(this).parents('.news-date').find('.news-element-slider').slick('slickNext');
        // $(".news-date .news-element-slider").slick("slickNext");
    });

    $('.news-date.news-slider-wrap .customPrevBtn').on('click', function () {
        $(this).parents('.news-date').find('.news-element-slider').slick('slickPrev');
        // $(".news-date .news-element-slider").slick("slickPrev");
    });

    //слайдер новостей без даты

    $('.no-date.news-element-slider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: false,
        responsive: [
            {
                breakpoint: 1042,
                settings: {
                    slidesToShow: 2,
                },
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    centerMode: true,
                    arrows: false,
                    centerPadding: '30px',
                },
            },
            {
                breakpoint: 561,
                settings: {
                    slidesToShow: 1,
                    centerMode: true,
                    arrows: false,
                    centerPadding: '30px',
                },
            },
        ],
    });

    $('.no-date.news-slider-wrap .customNextBtn').on('click', function () {
        $(this).parents('.no-date').find('.news-element-slider').slick('slickNext');
        // $(".no-date .news-element-slider").slick("slickNext");
    });

    $('.no-date.news-slider-wrap .customPrevBtn').on('click', function () {
        $(this).parents('.no-date').find('.news-element-slider').slick('slickPrev');
        // $(".no-date .news-element-slider").slick("slickPrev");
    });

    //слайдер сертификатов

    $('.sertificates-slider:not(.second-page-full .sertificates-slider)').slick({
        slidesToShow: 4,

        slidesToScroll: 1,

        arrows: false,

        responsive: [
            {
                breakpoint: 768,

                settings: {
                    slidesToShow: 4,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },

            {
                breakpoint: 561,

                settings: {
                    slidesToShow: 3,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },

            {
                breakpoint: 360,

                settings: {
                    slidesToShow: 1,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },
        ],
    });

    $('.second-page-full .sertificates-slider').slick({
        slidesToShow: 6,

        slidesToScroll: 1,

        arrows: false,

        responsive: [
            {
                breakpoint: 768,

                settings: {
                    slidesToShow: 4,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },

            {
                breakpoint: 561,

                settings: {
                    slidesToShow: 3,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },

            {
                breakpoint: 360,

                settings: {
                    slidesToShow: 1,

                    centerMode: true,

                    arrows: false,

                    centerPadding: '30px',
                },
            },
        ],
    });

    $('.sertificates-slider-wrap .customNextBtn').on('click', function () {
        $('.sertificates-slider').slick('slickNext');
    });

    $('.sertificates-slider-wrap .customPrevBtn').on('click', function () {
        $('.sertificates-slider').slick('slickPrev');
    });

    //слайдер сертификатов планшет

    if ($(window).width() < 768) {
        $('.sertificates').slick({
            slidesToShow: 4,

            slideToScroll: 1,

            centerMode: true,

            centerPadding: '30px',

            arrows: false,

            responsive: [
                {
                    breakpoint: 561,

                    settings: {
                        slidesToShow: 3,

                        slidesToScroll: 1,

                        centerMode: true,

                        arrows: false,

                        centerPadding: '30px',
                    },
                },

                {
                    breakpoint: 360,

                    settings: {
                        slidesToShow: 1,

                        centerMode: true,

                        arrows: false,

                        centerPadding: '30px',
                    },
                },
            ],
        });
    }

    //слайдер сотрудников

    if ($(window).width() < 1025) {
        $('.our-specialists-wrap').slick({
            slidesToShow: 2,

            slidesToScroll: 1,

            prevArrow:
                '<div class="customPrevBtn"><img src="assets/templates/market/img/sprite/arr-slider-prev.png" alt=""></div>',

            nextArrow:
                '<div class="customNextBtn"><img src="assets/templates/market/img/sprite/arr-slider-next.png" alt=""></div>',

            centerMode: true,

            responsive: [
                {
                    breakpoint: 768,

                    settings: {
                        slidesToShow: 2,

                        slidesToScroll: 1,

                        centerMode: true,

                        arrows: false,
                    },
                },

                {
                    breakpoint: 581,

                    settings: {
                        slidesToShow: 1,

                        slidesToScroll: 1,

                        centerMode: true,

                        arrows: false,
                    },
                },
            ],
        });
    }

    $(
        ' .fancyshow'

        // ' div.card-gallery-slider__el a'
    ).fancybox({
        closeBtn: true,

        padding: 0,

        helpers: {
            overlay: {
                css: {
                    background: 'rgba(51,51,51,0.7)',
                },
            },
        },
    });

    //подчеркнутый текст из админки

    function underlineTxt() {
        var arrSpan = $('span[style]');

        arrSpan.each(function () {
            var attr = $(this).attr('style');

            if (~attr.indexOf('text-decoration: underline;')) {
                $(this).addClass('underline-txt');
            }
        });

        var arrTable = $('table[border]');

        arrTable.each(function () {
            $(this).removeAttr('border').addClass('table-border');
        });
    }

    underlineTxt();

    //удаление стрелки для выпадающего списка в телефонах header

    (function () {
        var phone = document.querySelectorAll('.header-phone-wrap');

        if (phone.length) {
            [].slice.call(phone).forEach(function (item) {
                if (!item.querySelector('.header-phones')) {
                    item.classList.add('single-phone');
                }
            });
        }
    })();

    //буквица

    var paragraphCap = $('.cap-fill');

    paragraphCap.each(function () {
        var letter = $(this).text().charAt(0);

        if (letter === 'Q' || letter === 'Д' || letter === 'Ц' || letter === 'Щ') {
            $(this).addClass('letter-padding-bottom');
        } else if (letter === 'Ё' || letter === 'Й') {
            $(this).addClass('letter-padding-top');
        } else if (letter === 'J') {
            $(this).addClass('letter-padding-bottom letter-padding-left');
        }
    });

    //перемещение блоков в карточке товара

    if ($(window).width() < 1025) {
        //сокращене слова "артикул" в карточке товара

        var artNo = $('.main-first-info__articul span').text();

        $('.main-first-info__articul').html('Арт.: ' + '<span>' + artNo + '</span>');

        //перемещение блока экономии в карточке товара

        // var $mobileCardPrice = $('<div class="mobile-price-wrap"></div>'),
        //     $cardPrice = $(
        //         '.main-first-info-presence-wrap-inner .price:not(#fast-view .main-first-info-presence-wrap-inner .price)'
        //     ),
        //     $economy = $('.card-buy-economy:not(#fast-view .card-buy-economy)');

        // $('.main-first-info').after($mobileCardPrice.append($cardPrice, $economy));

        //перемещение блоков акции и нашли дешевле

        var $actionMobie = $('<div class="action-mobile-wrap"></div>'),
            $timer = $('.card-buy__promo:not(#fast-view .card-buy__promo)'),
            $lowCost = $('.card-buy__low-cost:not(#fast-view .card-buy__low-cost)');

        $('.main-first-info-presence-wrap-inner .buy-block').before($actionMobie.append($timer, $lowCost));
    }

    //расписание дилеры, разбивка строк по разделителю

    function dividerString(el) {
        el.each(function () {
            var self = $(this),
                newArr = self.text().trim().split(';');

            self.empty();

            newArr.forEach(function (item) {
                var newEl = '<div><div class="contact-dealers-region__schedule-item">' + item + '</div></div>';

                self.append(newEl);
            });

            self.css({opacity: '1'});
        });
    }

    dividerString($('.contact-dealers-region__schedule'));

    //центрирование по высоте кнопок слайдера карточки товара

    var cardSliderTop = $('div.main-first-image-slider-el a').height() / 2 + 'px';

    $('div.main-first-image-slider .slick-arrow').css({top: cardSliderTop});

    //карточка товара, сворачивание таблицы
    // var tableMoreTxt = $(".table-more").text();
    $('.card-description').on('click', '.table-more', function () {
        $(this).prev('.card-description__table-wrap').toggleClass('hidden');

        $(this).toggleClass('active');

        if ($(this).hasClass('active')) {
            $(this)
                .text('Свернуть')

                .prev('.card-description__table-wrap')

                .css({'max-height': ''});
        } else {
            // $(this).text(tableMoreTxt);
            $(this).text('Показать весь список');
            descriptionTableMaxHeight();
        }
    });

    //max-height таблицы характеристик

    function descriptionTableMaxHeight() {
        if ($('.card-description__table').length) {
            var maxHeight = 0;

            $('.card-description__table tr').each(function (i) {
                if (i < 9) {
                    maxHeight += $(this).height();
                }
            });

            $('.card-description__table-wrap.hidden').css({
                'max-height': maxHeight + 1 + 'px',
            });
        }
    }

    descriptionTableMaxHeight();

    //карточка товара

    function cardMore() {
        //карточка товара - описание - кнопка подробнее

        // var moreBtnTxt = $(".card-description-more__btn").text();

        $('.card-description-more').on('click', '.card-description-more__btn', function () {
            $(this).prev('.card-description-more__txt').toggleClass('hidden');

            $(this).toggleClass('active');

            if ($(this).hasClass('active')) {
                $(this).text('Свернуть');
            } else {
                // $(this).text(moreBtnTxt);
                $(this).text('Подробнее');
            }
        });

        //карточка товара - краткое описание - клик по кнопке "подробнее"

        $('body').on('click', 'span.presence-description-more', function () {
            var scrollToDescription = $('.card-description-more').offset().top - $('.header-scroll').height();

            $('.card-description-more__txt').removeClass('hidden');

            $('.card-description-more__btn').addClass('active').text('Свернуть');

            $('body, html').animate({scrollTop: scrollToDescription}, 500);
        });

        $('.hidden_text').on('click', '.card-description-more__btn', function () {
            $(this).prev('.js-catalog_content').children().toggleClass('visible-all');
            // $(this).prev('.js-catalog_content').children().first().removeClass('visible-all').toggleClass('visible-first');

            // var cont = $(this).prev('.catalog_content').children('p').first();
            // var cont = $(this).prev('.catalog_content').children('p:nth-child(2)');
            // console.log('cont ', cont.innerText);

            $(this).toggleClass('active');

            if ($(this).hasClass('active')) {
                $(this).text('Roll up');
            } else {
                $(this).text('More details');
            }

            // calculate = function(obj){
            //     other = obj.clone();
            //     other.html('a<br>b').hide().appendTo('body');
            //     size = other.height() / 2;
            //     other.remove();
            //     return obj.height() /  size;
            // }
            
            // n = calculate($('.catalog_content').children('p:nth-child(5)'));
            // console.log('lines ', n);
            // console.log('lines ', n2);
            // if (n < 5) {
            //     $('.hidden_text .card-description-more__btn').hide();
            // }
        });

        function cardMoreFirst() {
            $('.js-catalog_content').children().toggleClass('hidden-all');
            $('.js-catalog_content').children().first().removeClass('hidden-all').toggleClass('hidden-first');
        }

        // cardMoreFirst();
    }

    cardMore();

    //скролл кнопки все характеристики для страницы проектов

    $('body').on('click', '.projects-card-description-more', function () {
        var scrollToDescription = $('.card-description.progect-page').offset().top - $('.header-scroll').height();

        $('body, html').animate({scrollTop: scrollToDescription}, 500);
    });

    //кнопка открытия карты для мобилок

    var mapButton = $('.map-button-mobile').html();

    var mapButtonActive = '<img src="assets/templates/market/img/update/map-loc-cl__m.svg" alt="">' + 'CLOSE MAP';

    $('.main-map-wrapper').on('click', '.map-button-mobile', function () {
        $(this).prev().find('.content').fadeToggle();

        $(this).toggleClass('active');

        if ($(this).hasClass('active')) {
            $(this).html(mapButtonActive);
        } else {
            $(this).html(mapButton);
        }
    });

    //печать документа

    $('.main-first-info__print').on('click', function () {
        window.print();
    });

    //custom scroll table

    $("table[data-table='scroll']").wrap('<div class="table-scroll"></div>');

    $('.table-scroll, .cost-table-scroll').mCustomScrollbar({
        axis: 'x',

        scrollInertia: 300,

        scrollbarPosition: 'outside',

        mouseWheel: {preventDefault: true},
    });

    //кнопка наверх

    $(window).scroll(function () {
        if ($(this).scrollTop() > 700) {
            $('#toup').show();
        } else {
            $('#toup').hide();
        }
    });

    $(document).on('click', '#toup', function () {
        $('html, body').animate({scrollTop: 0}, 500);
    });

    //блок вы смотрели, белый фон если элемент не пустой

    $('.watched-el').each(function () {
        var $self = $(this);

        if ($self.find('img').length) {
            $self.css({'background-color': '#fff'});
        }
    });

    //удаление пустых параграфов в услугах

    $('.completed-projects-slider__info').each(function () {
        var strInfo = $(this).find('p.description').text();

        if (!strInfo.length) {
            $(this).find('p.description').hide();
        }
    });

    /*Обрезание пунктов меню в повале (вар 1, 2)*/
    function cropFooterNavItems() {
        var items = $('.footer .footer-center ul li a');
        cropText(items, 21);
    }

    // cropFooterNavItems();
});

//появление изображений на слайдерах после загрузки

jQuery(window).bind('load', function () {
    var hiddenBeforLoad =
        '.slider-main li, ' +
        '.certificates-element, ' +
        '.company-element, ' +
        '.main-first-image-slider-el, ' +
        '.projects-card-slider-pager-el, ' +
        '.projects-card-slider-el, ' +
        '.card-gallery-slider__el, ' +
        '.card-gallery-slider-pager__el, ' +
        '.completed-project-wrapper, ' +
        '.slider-sale-wrap, ' +
        '.custom-select, ' +
        '.filter-select, ' +
        '.desktop-menu, ' +
        '.slider-sale ';

    $(hiddenBeforLoad).css({opacity: '1'});
});

//определение максимальной высоты

$.fn.setMaxHeights = function () {
    var maxHeight = this.map(function (i, e) {
        return $(e).height();
    }).get();

    return this.height(Math.max.apply(this, maxHeight));
};

$.fn.setMinHeights = function () {
    var maxHeight = this.map(function (i, e) {
        return $(e).height();
    }).get();

    this.css({'min-height': Math.max.apply(this, maxHeight) + 'px'});

    return this;
};

//Промотать до верха по клику на логотип скролменю на главной

$(document).on('click', '.logo_scroll_toup', function () {
    $('html, body').animate({scrollTop: 0}, 500);
});

//разметка корзины товаров для мобилки

function basketMobileMarkup() {
    var $row = $('.products_list tr:not([class])'),
        $wrap = $('<div class="basket-wrap-inner"></div>');

    if ($(window).width() < 769 && $('.products_list').length && !$('.basket-wrap-inner').find('.image').length) {
        $row.wrap($wrap);

        $row.each(function () {
            $(this).parent().prepend($(this).find('.image'));
        });

        $('.products_list').css('opacity', '1');
    } else if ($(window).width() > 768 && $('.products_list').length && $('.basket-wrap-inner').find('.image').length) {
        $row.each(function () {
            $(this).prepend($(this).prev('.image')).unwrap();
        });
    }
}

//проверка наличия корзины

function hasBasket() {
    if ($('.header #shopCart').length || $('#shopCart.side-basket').length) {
        $('.header').addClass('has-basket');

        return true;
    } else {
        $('.header').addClass('no-basket');

        return false;
    }
}

//мобильная корзина в скролл-меню

function onMobileBasket() {
    if (hasBasket() && $(window).width() < 1025) {
        $('.search-wrap').show();
    }
}

//вставка иконки svg после надписи "ещё" во flex-menu

function flexMenuArrow() {
    if (calcWindowWidth() > 1024 && $('#menu-flex').length) {
        var timerID = setInterval(function () {
            var $linkTitle = $('#menu-flex .flexMenu-viewMore').children('a'),
                linkTitleText = $linkTitle.text().trim().toLowerCase();

            if (linkTitleText === 'ещё' && !$('#flexMenuArrowDown').length) {
                var options = {
                        type: 'image/svg+xml',

                        data: 'assets/templates/market/img/update/flexMenu-arrow.svg',

                        id: 'flexMenuArrowDown',
                    },
                    objectEl = new NewElCreate('object', options);

                $linkTitle.append(objectEl);

                flexMenuArrowHover();

                clearInterval(timerID);
            } else if (calcWindowWidth() < 1025) {
                clearInterval(timerID);
            }
        }, 300);
    }
}

function flexMenuArrowHover() {
    var timerId = setInterval(function () {
        if ($('#flexMenuArrowDown').length) {
            var object = document.getElementById('flexMenuArrowDown');

            (content = object.contentDocument),
                (idel = content.getElementById('id__flexMenuArrow')),
                (currentColor = $('#menu-flex .flexMenu-viewMore > a').css('color'));

            if (idel) {
                idel.setAttribute('fill', currentColor);

                $('#menu-flex').on('mouseenter', '.flexMenu-viewMore', function () {
                    idel.setAttribute('fill', '#ffffff');
                });

                $('#menu-flex').on('mouseleave', '.flexMenu-viewMore', function () {
                    idel.setAttribute('fill', currentColor);
                });

                if (content) {
                    clearInterval(timerId);
                }
            }
        }
    }, 100);
}

/**

 *

 * @param tagName - string

 * @param attrOptions object for attributes

 * @param innerHtml string innerHTML

 * @param appendChildArr array appendChild elements

 * @returns {DOM Element}

 * @constructor

 */

function NewElCreate(tagName, attrOptions, innerHtml, appendChildArr) {
    var el = document.createElement(tagName),
        i;

    if (attrOptions) {
        for (key in attrOptions) {
            el.setAttribute(key, attrOptions[key]);
        }
    }

    if (innerHtml) {
        el.innerHTML = innerHtml;
    }

    if (appendChildArr && appendChildArr.length) {
        for (i = 0; i < appendChildArr.length; i++) {
            el.appendChild(appendChildArr[i]);
        }
    }

    return el;
}

//показываем содержимое svg image

function svgInner() {
    jQuery('img.svg').each(function (i, item) {
        var $img = jQuery(this);

        var imgID = $img.attr('id');

        var imgClass = $img.attr('class');

        var imgURL = $img.attr('src');

        jQuery.get(
            imgURL,
            function (data) {
                // Get the SVG tag, ignore the rest

                var $svg = jQuery(data).find('svg');

                // Add replaced image's ID to the new SVG

                if (typeof imgID !== 'undefined') {
                    $svg = $svg.attr('id', imgID);
                }

                // Add replaced image's classes to the new SVG

                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + ' replaced-svg');
                }

                // Remove any invalid XML tags as per http://validator.w3.org

                $svg = $svg.removeAttr('xmlns:a');

                // Replace image with new SVG

                $img.replaceWith($svg);
            },
            'xml'
        );
    });
}

//определение расширения файла

function fileType(el, target) {
    if (el.length) {
        el.each(function () {
            var text = $(this).attr('href'),
                arr = text.split('.'),
                extention = arr[arr.length - 1];

            $(this)
                .parent()
                .parent()
                .find(target)
                .append('<div>' + extention + '</div>');
        });
    }
}

//определение primary-color

function primaryColor() {
    return (activeColor = $('.main-menu-left ul.dropdown li.active > .wrap > a').css('color'));
}

//стили фильтра при ресайзе

function filterResize() {
    if ($(window).width() < 768 && fromDesktop) {
        fromDesktop = 0;

        $('.filter-section-wrapper').slideUp(0);

        $('.filter').css('opacity', '1');
    } else if ($(window).width() >= 768) {
        setTimeout(function () {
            fromDesktop = 1;
        }, 1000);

        $('.filter-section-wrapper').slideDown(0);

        $('.filter').removeClass('show');
    }
}

//сворачивание блоков фильтра

function asideFilterSlideToggle() {
    if ($(window).width() < 768) {
        $('.filter-arrow')
            .closest('.filter-section')

            .addClass('active')

            .find('.filter-section__item')

            .slideUp(0);

        $('.filter-section-wrapper').slideUp(0);

        $('.filter').css('opacity', '1');
    }

    $(document).on('click', '.filter-arrow', function () {
        if ($(window).width() < 768 && !$(this).closest('.filter-section').find('.filter-section__more').length) {
            $(this)
                .closest('.filter-section')

                .toggleClass('active')

                .find('.filter-section__item')

                .stop()

                .slideToggle(0);

            setTimeout(function () {
                filterSpoilar();
            }, 0);
        } else {
            $(this)
                .closest('.filter-section')

                .toggleClass('active')

                .find('.filter-section__item')

                .stop()

                .slideToggle();
        }
    });
}

//кнопка сворачивания для мобильного фильтра

function filterArrowMobile() {
    var $target = $('.primary-block .filter h4'),
        $span = $('<span class="filter-arrow-mobile uk-icon-angle-down"></span>');

    if ($(window).width() < 768 && !$('.filter-arrow-mobile').length) {
        $target.append($span);
    } else if ($(window).width() >= 768 && $span.length) {
        $span.remove();
    }
}

$(document).on('click', '.filter-form-title', function () {
    $('.filter-section-wrapper').slideToggle();

    $('.filter').toggleClass('show');
});

/**

 * inputs have to parent element label

 */

function checkedInput() {
    var reset = document.querySelectorAll('input[type="reset"]');

    inspectionInputs(document.querySelectorAll('input[type="checkbox"], input[type="radio"]'));

    document.addEventListener('change', function (e) {
        if (e.target.closest('.checkbox') && !e.target.hasAttribute('disabled')) {
            e.target.closest('.checkbox').classList.toggle('active');
        }

        if (e.target.closest('.radio')) {
            inspectionInputs(document.querySelectorAll('input[type="radio"]'));
        }

        if (e.target.closest('.checkbox')) {
            inspectionInputs(document.querySelectorAll('input[type="checkbox"]'));
        }
    });

    document.addEventListener('click', function (e) {
        for (var i = 0; i < reset.length; i++) {
            if (e.target === reset[i]) {
                setTimeout(function () {
                    inspectionInputs(document.querySelectorAll('input[type="checkbox"], input[type="radio"]'));
                }, 0);

                $('select', e.target.closest('form')).select2('val', '');

                if ($('#filter-range', e.target.closest('form')).get(0)) {
                    //сброс ползунка
                    setTimeout(function () {
                        document.getElementById('filter-range').noUiSlider.reset();
                    }, 0);
                } else {
                    //сброс ползунка
                    setTimeout(function () {
                        document.getElementById('filter-range-content').noUiSlider.reset();
                    }, 0);
                }
            }
        }
    });
}

function inspectionInputs(arr) {
    var span;

    for (var i = 0; i < arr.length; i++) {
        if (arr[i].checked) {
            arr[i].parentElement.classList.add('active');
        } else {
            arr[i].parentElement.classList.remove('active');
        }

        if (arr[i].hasAttribute('disabled')) {
            arr[i].parentElement.classList.add('disabled');
        }

        if (arr[i].parentElement.classList.contains('select-color') && !arr[i].nextElementSibling) {
            span = document.createElement('span');

            span.style.background = arr[i].value;

            arr[i].parentElement.appendChild(span);
        }

        if (arr[i].checked && arr[i].parentElement.classList.contains('select-color')) {
            arr[i].parentElement.style.borderColor = arr[i].value;
        } else if (!arr[i].checked && arr[i].parentElement.classList.contains('select-color')) {
            arr[i].parentElement.style.borderColor = '';
        }
    }
}

//переинициализация кастомного селекта (для аяксов)

function customSelectReinit() {
    var $selectInit = $('select')
        .select2({
            minimumResultsForSearch: Infinity,

            width: '100%',

            theme: 'classic',
        })
        .css('opacity', '1');

    $(document).on('select2-open', 'select', function () {
        $('.select2-results').jScrollPane({
            mouseWheelSpeed: 40,
        });

        centeredArrowMultiselect();
    });

    $(document).on('select2-close', 'select', function () {
        if ($('.select2-results').data('jsp')) {
            $('.select2-results').data('jsp').destroy();

            centeredArrowMultiselect();
        }

        $('select').select2({
            minimumResultsForSearch: Infinity,

            width: '100%',

            theme: 'classic',
        });
    });

    $(document).on('click', function (e) {
        if (e.target.closest('.modal') && $('.select2-drop-active').length) {
            $selectInit.each(function () {
                $(this).select2('close');
            });
        }
    });

    $(document).on('change.select2', function () {
        centeredArrowMultiselect();
    });

    centeredArrowMultiselect(1000);

    $('.filter-select').css('opacity', '1');
}

function customSelect() {
    var $selectInit = $('select')
        .select2({
            minimumResultsForSearch: Infinity,

            width: '100%',

            theme: 'classic',
        })
        .css('opacity', '1');

    $('#js-select-region').select2({
        placeholder: 'Выберите область',

        minimumResultsForSearch: Infinity,

        allowClear: true,
    });

    $('#js-select-city').select2({
        placeholder: 'Выберите город',

        minimumResultsForSearch: Infinity,

        allowClear: true,
    });

    $(document).on('select2-open', 'select', function () {
        $('.select2-results').jScrollPane({
            mouseWheelSpeed: 40,
        });

        centeredArrowMultiselect();
    });

    $(document).on('select2-close', 'select', function () {
        $('.select2-results').data('jsp').destroy();

        $('select').select2({
            minimumResultsForSearch: Infinity,

            width: '100%',

            theme: 'classic',
        });

        centeredArrowMultiselect();
    });

    $(document).on('click', function (e) {
        if (e.target.closest('.modal') && $('.select2-drop-active').length) {
            $selectInit.each(function () {
                $(this).select2('close');
            });
        }
    });

    $(document).on('change.select2', function () {
        centeredArrowMultiselect();
    });

    centeredArrowMultiselect(1000);
    // var arrrr = $('.select2-container-multi').next('select').attr('placeholder');
}

//выравнивание стрелки мультиселекта

function centeredArrowMultiselect(time) {
    if (time) {
        setTimeout(function () {
            addClassMultiselect();
        }, time);
    } else {
        addClassMultiselect();
    }

    function addClassMultiselect() {
        var arrrr = $('.select2-container-multi'),
            placeholder;

        arrrr.each(function () {
            var self = $(this);

            //копируем плейсхолдер для мультиселекта

            placeholder = self.next('select').attr('placeholder');

            self.find('.select2-search-field input').attr('placeholder', placeholder);

            if (self.find('.select2-search-choice').length) {
                self.addClass('multi-no-empty');
            } else {
                self.removeClass('multi-no-empty');
            }
        });
    }
}

//спойлер для фильтра

function filterSpoilar() {
    var spoilerArr = document.querySelectorAll('.js-spoiler'),
        fieldArr, // массив полей
        marginHeight, // margin bottom
        fullHeight, //полная высота блока
        height; // вычисленная сумма высот блоков с отступами

    if (spoilerArr.length) {
        for (var i = 0; i < spoilerArr.length; i++) {
            fieldArr = spoilerArr[i].querySelectorAll('.label-field');

            fullHeight = getComputedStyle(spoilerArr[i]).height;

            height = 0;

            //если количество label-field > 5 для бокового фильтра

            if (fieldArr.length > 5 && spoilerArr[i].closest('.left-bar')) {
                for (var k = 0; k < 5; k++) {
                    marginHeight = parseInt(getComputedStyle(fieldArr[k]).marginBottom);

                    height += fieldArr[k].offsetHeight + marginHeight;
                }

                spoilarMoreBtn(spoilerArr[i], fullHeight, height);
            }

            //если высота больше 75px для фильтра контента

            if (spoilerArr[i].offsetHeight > 75 && spoilerArr[i].closest('.primary-block') && $(window).width() > 767) {
                spoilarMoreBtn(spoilerArr[i], fullHeight, 75);
            } else if (
                spoilerArr[i].offsetHeight > 120 &&
                spoilerArr[i].closest('.primary-block') &&
                $(window).width() < 768
            ) {
                spoilarMoreBtn(spoilerArr[i], fullHeight, 120);
            }
        }
    }
}

//кнопки "показать еще" / "скрыть"

function spoilarMoreBtn(el, fullHeight, hiddenHeight) {
    var txtBtnHidden = 'Показать еще',
        txtBtnShow = 'Скрыть',
        btn = document.createElement('div'),
        html = el.innerHTML,
        wrapperHTML = '<div class="filter-section__wrap">' + html + '</div>',
        wrapperEl;

    if (!$(el).find('.filter-section__more').length) {
        el.innerHTML = wrapperHTML;

        btn.textContent = txtBtnHidden;

        btn.classList.add('filter-section__more');

        html = el.innerHTML;

        wrapperEl = el.firstElementChild;

        wrapperEl.style.height = hiddenHeight - 3 + 'px';

        wrapperEl.classList.add('hidden');

        el.appendChild(btn);

        btn.addEventListener('click', function () {
            this.classList.toggle('show');

            if (this.classList.contains('show')) {
                this.textContent = txtBtnShow;

                wrapperEl.style.height = parseInt(fullHeight) + 5 + 'px';
            } else {
                this.textContent = txtBtnHidden;

                wrapperEl.style.height = hiddenHeight - 3 + 'px';
            }
        });
    }
}

//текущий активный пункт меню

function currentActiveTopNav() {
    var currentLocation = location.pathname.slice(1),
        arrLinksTopNav = document.querySelectorAll('.top-menu a');

    for (var i = 0; i < arrLinksTopNav.length; i++) {
        if (arrLinksTopNav[i].getAttribute('href') === currentLocation) {
            arrLinksTopNav[i].parentElement.classList.add('active');
        }
    }
}

//отключение отправки формы по вводу в input:text

function preventEnterSubmit() {
    $(document).on('keydown', 'input[type=text]', function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();

            return false;
        }
    });
}

//левая позиция блока счетчика выбранных элементов фильтра

function filterSelectPosition() {
    if ($('.left-bar').length) {
        var aside = document.querySelector('.left-bar'),
            target = document.querySelectorAll('.filter-selected'),
            leftPosition = aside.offsetLeft + aside.offsetWidth + 'px';

        for (var i = 0; i < target.length; i++) {
            target[i].style.left = leftPosition;

            target[i].style.opacity = 1;
        }
    }
}

//скрипт работы ползунков

//https://refreshless.com/nouislider/

/**

 * @param sliderId - id ползунка

 * @param min - минимальное значение

 * @param max - максимальное значение

 * @param step - шаг слайдера

 * @param initPositionArr - массив начального значения ползунков

 *

 * getData - получение значений

 * setData - установка значений, array

 */

function noUiSliderInit(sliderId, min, max, step, initPositionArr) {
    var keypressSlider = document.getElementById(sliderId);

    var input0 = document.getElementById(sliderId + '__0');

    var input1 = document.getElementById(sliderId + '__1');

    var inputs = [input0, input1];

    noUiSlider.create(keypressSlider, {
        start: initPositionArr,

        connect: true,

        range: {
            //второе число в массиве - это шаг

            min: [min, step],

            max: [max, step],
        },
    });

    keypressSlider.noUiSlider.on('update', function (values, handle) {
        //если нужны копейки, убрать parseInt

        inputs[handle].value = parseInt(values[handle]);
        //$('#eFiltr').submit();
    });

    keypressSlider.noUiSlider.on('change', function (values, handle) {
        $('#eFiltr').submit();
    });

    keydownEventsNoUiSlider(inputs);

    //ввод данных с клавиатуры

    function setSliderHandle(i, value) {
        var r = [null, null];

        r[i] = value;

        keypressSlider.noUiSlider.set(r);
    }

    // Listen to keydown events on the input field.

    function keydownEventsNoUiSlider(inputs) {
        inputs.forEach(function (input, handle) {
            input.addEventListener('change', function () {
                setSliderHandle(handle, this.value);
            });

            input.addEventListener('keydown', function (e) {
                var values = keypressSlider.noUiSlider.get();

                var value = Number(values[handle]);

                // [[handle0_down, handle0_up], [handle1_down, handle1_up]]

                var steps = keypressSlider.noUiSlider.steps();

                // [down, up]

                var step = steps[handle];

                var position;

                // 13 is enter,

                // 38 is key up,

                // 40 is key down.

                switch (e.which) {
                    case 13:
                        setSliderHandle(handle, this.value);

                        break;

                    case 38:
                        // Get step to go increase slider value (up)

                        position = step[1];

                        // false = no step is set

                        if (position === false) {
                            position = 1;
                        }

                        // null = edge of slider

                        if (position !== null) {
                            setSliderHandle(handle, value + position);
                        }

                        break;

                    case 40:
                        position = step[0];

                        if (position === false) {
                            position = 1;
                        }

                        if (position !== null) {
                            setSliderHandle(handle, value - position);
                        }

                        break;
                }
            });
        });
    }

    this.getData = function () {
        return keypressSlider.noUiSlider.get();
    };

    this.setData = function (data) {
        keypressSlider.noUiSlider.set(data);
    };
}

//спойлер отзывов для главной страницы

(function () {
    var showedTxt = 'Скрыть',
        hiddenTxt = 'Читать подробнее...';

    $('.card-reviews-el__more').on('click', function (e) {
        e.preventDefault();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active').find('span').text(hiddenTxt);
        } else {
            $(this).addClass('active').find('span').text(showedTxt);
        }

        $(this).closest('.card-reviews-el-inner').toggleClass('show');
    });
})();

function customPlaceholderInit() {
    var els = $('.custom-placeholder-wrap');

    els.each(function () {
        $(this).on('click', clickHandler);

        $(this).find('input, textarea').on('focus', focusHandler);

        $(this).find('a[data-event]').on('click', clickControl);
    });

    textareaDetect();

    function textareaDetect() {
        els.each(function () {
            var textarea = $(this).find('textarea');

            if (textarea.length) {
                $(this).find('.custom-placeholder').addClass('textarea-custom-placeholder');
            }
        });
    }

    function clickControl(e) {
        var el = findParent($(e.target), 'custom-placeholder-wrap');

        el.addClass('custom-placeholder-active');
    }

    function clickHandler(e) {
        var el = findParent($(e.target), 'custom-placeholder-wrap'),
            input = el.find('input, textarea');

        el.addClass('custom-placeholder-active');

        input

            .focus()

            .focusout(function () {
                var self = $(this),
                    val = self.val().trim();

                if (!val && !$(e.target).hasClass('datepicker-form')) {
                    el.removeClass('custom-placeholder-active');
                } else if (!val && $(e.target).hasClass('datepicker-form')) {
                    var that = $(this);

                    $(document).on('click', function () {
                        setTimeout(function () {
                            if (!that.val().trim() && !$('.datepicker-container').is(':visible')) {
                                el.removeClass('custom-placeholder-active');
                            }
                        }, 200);
                    });
                }
            });
    }

    function focusHandler(e) {
        var el = findParent($(e.target), 'custom-placeholder-wrap');

        el.addClass('custom-placeholder-active');

        $(e.target).focusout(function () {
            var val = $(this).val().trim();

            if (!val && !$(e.target).hasClass('datepicker-form')) {
                el.removeClass('custom-placeholder-active');
            } else if (!val && $(e.target).hasClass('datepicker-form')) {
                var that = $(this);

                $(document).on('click', function () {
                    setTimeout(function () {
                        if (!that.val().trim() && !$('.datepicker-container').is(':visible')) {
                            el.removeClass('custom-placeholder-active');
                        }
                    }, 200);
                });
            }
        });
    }
}

function findParent(el, class_) {
    var parent = el.parent();

    if (parent.hasClass(class_)) {
        return parent;
    } else {
        return findParent(parent, class_);
    }
}

//ширина экрана

function calcWindowWidth() {
    window.windowWidht = $(window).width();

    return windowWidht;
}

//слайдер на главой

function setHeightMainSliderMobile() {
    if (windowWidht < 481) {
        setTimeout(function () {
            $('.slider-main ul.bx-slider > li').setMaxHeights();
        }, 0);
    }
}

/**

 * jQuery Form Validator

 * ------------------------------------------

 *

 * Russian language package

 *

 * @website http://formvalidator.net/

 */

//валидатор формы попап

function validateForms() {
    var myLanguage = {
        errorTitle: 'Ошибка отправки формы!',

        requiredField: 'Обязательное поле',

        requiredFields: 'Вы задали не все обязательные поля',

        badTime: 'Вы задали некорректное время',

        badEmail: 'Вы задали некорректный e-mail',

        badTelephone: 'Вы задали некорректный номер телефона',

        badSecurityAnswer: 'Вы задали некорректный ответ на секретный вопрос',

        badDate: 'Вы задали некорректную дату',

        lengthBadStart: 'Значение должно быть в диапазоне',

        lengthBadEnd: ' символов',

        lengthTooLongStart: 'Значение длинее, чем ',

        lengthTooShortStart: 'Значение меньше, чем ',

        notConfirmed: 'Введённые значения не могут быть подтверждены',

        badDomain: 'Некорректное значение домена',

        badUrl: 'Некорретный URL',

        badCustomVal: 'Введённое значение неверно',

        andSpaces: ' и пробелы ',

        badInt: 'Значение - не число',

        badSecurityNumber: 'Введённый защитный номер - неправильный',

        badUKVatAnswer: 'Некорректный UK VAT номер',

        badStrength: 'Пароль не достаточно надёжен',

        badNumberOfSelectedOptionsStart: 'Вы должны выбрать как минимум ',

        badNumberOfSelectedOptionsEnd: ' ответов',

        badAlphaNumeric: 'Значение должно содержать только числа и буквы ',

        badAlphaNumericExtra: ' и ',

        wrongFileSize: 'Загружаемый файл слишком велик (максимальный размер %s)',

        wrongFileType: 'Принимаются файлы следующих типов %s',

        groupCheckedRangeStart: 'Выберите между ',

        groupCheckedTooFewStart: 'Выберите как минимум ',

        groupCheckedTooManyStart: 'Выберите максимум из ',

        groupCheckedEnd: ' элемент(ов)',

        badCreditCard: 'Номер кредитной карты некорректен',

        badCVV: 'CVV номер некорректно',

        wrongFileDim: 'Неверные размеры графического файла,',

        imageTooTall: 'изображение не может быть уже чем',

        imageTooWide: 'изображение не может быть шире чем',

        imageTooSmall: 'изображение слишком мало',

        min: 'минимум',

        max: 'максимум',

        imageRatioNotAccepted: 'Изображение с таким соотношением сторон не принимается',

        badBrazilTelephoneAnswer: 'Введённый номер телефона неправильный',

        badBrazilCEPAnswer: 'CEP неправильный',

        badBrazilCPFAnswer: 'CPF неправильный',
    };

    $.formUtils.addValidator({
        name: 'datepicker-date-required',

        validatorFunction: function (value, $el, config, language, $form) {
            return parseInt(value, 10) % 2 === 0;
        },

        errorMessage: 'You have to answer an even number',

        errorMessageKey: 'badEvenNumber',
    });

    $.validate({
        modules: 'file,security',

        borderColorOnError: '#F82900',

        //language: myLanguage,
    });

    // Add custom validation rule
}

/*

*	Styler number input[type="range"]

*/

(function ($) {
    $.fn.stylerNumber = function () {
        var styler = function () {
            var id;

            var min = false;

            var max = false;

            var step = 1;

            var self = $(this);

            if (self.attr('id')) {
                id = self.attr('id');
            } else {
                return;
            }

            if (self.attr('min')) {
                min = self.attr('min');
            }

            if (self.attr('max')) {
                max = self.attr('max');
            }

            if (self.attr('step')) {
                if (getLengthDecimal(self.attr('step')) >= 0 && getLengthDecimal(self.attr('step')) <= 20)
                    step = Number(self.attr('step'));
                else return;
            }

            function getLengthDecimal(number) {
                var number = new String(number);

                var pos = number.indexOf('.');

                if (pos == -1) return 0;

                number = number.substr(pos + 1);

                number = Number(number.length);

                return number;
            }

            $("[data-for='" + id + "']").on('selectstart', function (even) {
                return false;
            });

            $("[data-for='" + id + "']").on('click', function (event) {
                var e = $(this).attr('data-event');

                var f = $(this).attr('data-for');

                var btnClicked = $(this);

                if (!f || !e) return false;

                if (e == 'sub') {
                    var value = Number(self.val());

                    var newvalue = Number((value - step).toFixed(getLengthDecimal(step)));

                    if (!min) {
                        self.val(newvalue);

                        self.change();
                    } else if (newvalue >= min) {
                        self.val(newvalue);

                        if (newvalue == min) {
                            btnClicked.addClass('select_none');
                        }

                        self.change();
                    } else if (newvalue < min) {
                        self.val(min);
                    }

                    if (value <= min) {
                        btnClicked.addClass('select_none');
                    }

                    if (btnClicked.parent().find('a[data-event="add"]').hasClass('select_none')) {
                        btnClicked.parent().find('a[data-event="add"]').removeClass('select_none');
                    }
                } else if (e == 'add') {
                    var value = Number(self.val());

                    var newvalue = Number((value + step).toFixed(getLengthDecimal(step)));

                    if (!max) {
                        self.val(newvalue);

                        self.change();
                    } else if (newvalue <= max && newvalue >= min) {
                        self.val(newvalue);

                        if (newvalue == max) {
                            btnClicked.addClass('select_none');
                        }

                        self.change();
                    } else if (newvalue < min) {
                        self.val(min);
                    }

                    if (!value) {
                        btnClicked.next().addClass('select_none');
                    }

                    if (btnClicked.parent().find('a[data-event="sub"]').hasClass('select_none') && value) {
                        btnClicked.parent().find('a[data-event="sub"]').removeClass('select_none');
                    }

                    if (value == max) {
                        btnClicked.addClass('select_none');
                    }
                }

                btnClicked.parent().find('input').focus().blur();

                return false;
            });
        };

        return this.each(styler);
    };
})($);

function addInputTypeFile() {
    var fileBtn = new NewElCreate('span', {class: 'file-btn'}, 'Добавить файл'),
        fileTitle = new NewElCreate('span', {class: 'file-title'}, 'Выберите файл'),
        inputTypeFile = new NewElCreate('input', {
            class: 'filename',
            type: 'file',
        }),
        inputWrapper = new NewElCreate('label', {class: 'label-wrap-file'}, null, [fileBtn, fileTitle, inputTypeFile]),
        closeBtn = new NewElCreate('span', {class: 'file-remove-btn'}, ''),
        labelWrapper = new NewElCreate('div', {class: 'file-wrapper'}, null, [inputWrapper, closeBtn]);

    return labelWrapper;
}

function addFile() {
    $(document).on('click', '.add-file-field', function () {
        var $self = $(this);

        if ($self.closest('.field__wrap').find('.file-wrapper').last().find('.filename').val() !== '') {
            $self.before(addInputTypeFile());
        } else {
            $self
                .closest('.field__wrap')

                .find('.file-wrapper')
                .last()
                .find('.label-wrap-file')

                .css('animation', 'blinkBg 0.5s ease');

            setTimeout(function () {
                $self
                    .closest('.field__wrap')

                    .find('.file-wrapper')
                    .last()
                    .find('.label-wrap-file')

                    .css('animation', '');
            }, 500);
        }
    });
}

function tabs() {
    $('.tab').on('click', function () {
        $(this).closest('.tabs-wrap').find('.tab, .panel').removeClass('active');

        $(this)
            .addClass('active')
            .closest('.tabs-wrap')

            .find('div[data-id="' + $(this).attr('data-id') + '"]')
            .addClass('active');
    });
}

// переключение разделов внутри услуги
function tabsPanelService() {
    $('.panel__tab.service').on('click', function () {
        $(this).closest('.tabs-wrap').find('.panel__tab.service, .panel__info.service').removeClass('active');

        $(this)
            .addClass('active')
            .closest('.tabs-wrap')

            .find('div[data-id="' + $(this).attr('data-id') + '"]')
            .addClass('active');
    });
}

// переключение разделов внутри проекты
function tabsPanelProject() {
    $('.panel__tab.project').on('click', function () {
        $(this).closest('.tabs-wrap').find('.panel__tab.project, .panel__info.project').removeClass('active');

        $(this)
            .addClass('active')
            .closest('.tabs-wrap')

            .find('div[data-id="' + $(this).attr('data-id') + '"]')
            .addClass('active');
    });
}

// переключение разделов внутри каталог
function tabsPanelCatalog() {
    $('.panel__tab.catalog').on('click', function () {
        $(this).closest('.tabs-wrap').find('.panel__tab.catalog, .panel__info.catalog').removeClass('active');

        $(this)
            .addClass('active')
            .closest('.tabs-wrap')

            .find('div[data-id="' + $(this).attr('data-id') + '"]')
            .addClass('active');
    });
}

//счетчик товаров
function setCounterValue() {
    var counterValue =
        parseInt($('#cartInner .header-basket__count').text()) || parseInt($('.side-basket__count').text()) || 0;

    $('.header-scroll .header-basket__count').html(counterValue);
}

//растягивание textarea по высоте колонки

function setMaxHeightTextarea() {
    var height = $('.feedback-form-wrap .field-half-wrap:first-of-type').height(),
        $target = $('textarea.js_full-height');

    $target.css({height: height + 'px', opacity: '1'});
}

//scroll-menu

function scrollMenu() {
    var showPosition = $('.header').outerHeight() - $('.header-scroll').outerHeight();

    $(window).scroll(function () {
        $('#search-panel-top').removeClass('fix').hide();

        if ($(this).scrollTop() >= showPosition) {
            $('.header-scroll.active').addClass('show');
        } else {
            $('.header-scroll.active').removeClass('show');

            $('.basket-under-header').stop().removeClass('active');
        }
    });

    if ($(window).scrollTop() >= showPosition) {
        $('.header-scroll.active').addClass('show');
    } else {
        $('.header-scroll.active').removeClass('show');

        $('.basket-under-header').stop().removeClass('active');
    }
}

//удаление лишних scroll-menu

function delScrollMenu() {
    var scrollMenus = $('.header-scroll');

    scrollMenus.each(function () {
        if (!$(this).hasClass('active')) {
            $(this).remove();
        }
    });
}

//боковая плавающая корзина-----------------------

function sideBasket() {
    //отключение выпадающей корзины в header

    if ($('.side-basket').hasClass('enabled')) {
        $('.basket-under-header').remove();
    }

    if (calcWindowWidth() > 767) {
        $(document).off('click', sideBasketMobileListener);

        $(document).on('click', '.side-basket__label', sideBasketDesktopListener);
    } else {
        $(document).off('click', '.side-basket__label', sideBasketDesktopListener);

        $(document).on('click', '.side-basket__label', sideBasketMobileListener);
    }

    $(document).on('click', function (e) {
        if (
            $('.side-basket.enabled').hasClass('show') &&
            !$(e.target).closest('.side-basket').length &&
            !$(e.target).closest('#stuffHelper').length
        ) {
            e.preventDefault();

            $('.side-basket').removeClass('show');

            $('html').removeClass('side-basket-enabled');

            $('#stuffHelper').remove();

            //действия при клике на кнопку "продолжить покупки"
        } else if ($('.side-basket.enabled').hasClass('show') && $(e.target).closest('.side-basket__continue').length) {
            e.preventDefault();

            $('.side-basket').removeClass('show');

            $('html').removeClass('side-basket-enabled');

            $('#stuffHelper').remove();
        }
    });
}

function sideBasketDesktopListener() {
    $('.side-basket').toggleClass('show');

    $('html').toggleClass('side-basket-enabled');

    if (!$(this).hasClass('show')) {
        $('#stuffHelper').remove();
    }

    // что бы кнопка избранные и сравнение также смещались влево
    $('.side-favorits').toggleClass('show');
    $('.side-compare').toggleClass('show');
}

function sideBasketMobileListener() {
    location.pathname = $(this).data('href');
}

function closeSideBasketOnMobile() {
    if (calcWindowWidth() < 768) {
        $('.side-basket').removeClass('show');
    }
}

//панель кастомных настроек

function customSettingsInit() {
    var $overlay = $('.fixed-overlay'),
        $mainEl = $('.customer-settings'),
        $mainElBtn = $mainEl.find('.customer-settings__btn'),
        $content = $('.customer-settings-content');

    //отключение скрола на неактивных блоках

    $('.customer-settings-content').bind('mousewheel DOMMouseScroll', offScroll);

    $overlay.bind('mousewheel DOMMouseScroll', offScroll);

    function offScroll(e) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += (delta < 0 ? 1 : -1) * 30;

        e.preventDefault();
    }

    //логика работы попап

    $(document).on('click', function (e) {
        if ($(e.target).closest('.customer-settings__btn').length) {
            $mainEl.toggleClass('active');

            $overlay.fadeToggle();

            $mainElBtn.toggleClass('active');
        }

        if ($(e.target).hasClass('fixed-overlay') && $mainEl.hasClass('active')) {
            $mainEl.removeClass('active');

            $overlay.fadeOut();

            $mainElBtn.removeClass('active');
        }
    });

    $('.customer-settings-content-wrap').jScrollPane({
        mouseWheelSpeed: 0,

        autoReinitialise: true,
    });
}

function colorPickerInit() {
    if (!$('div').is('#picker-window')) {
        return false;
    }
    var colorPicker = $.farbtastic('#picker-window'),
        $picker = $('#picker-window'), //куда вставляется пикер
        $customColor;

    //установка фона кастомных кнопок

    $('.input-color').each(function () {
        var self = $(this),
            color = self.val();

        self.prev().css({'background-color': color});
    });

    if ($picker) {
        $picker.append(
            $('<input>', {
                type: 'text',

                id: 'set-custom-color',
            }).attr('autocomplete', 'off'),

            $('<span />', {
                id: 'set-color__ok',

                text: 'Ок',
            }),

            $('<span />', {
                id: 'set-color__cancel',

                text: 'Закрыть',
            })
        );

        $customColor = $('#set-custom-color');

        colorPicker.linkTo(pickerUpdate);
    }

    function pickerUpdate(color) {
        //цвета input в окне выбора

        $customColor.closest('.picker-window-wrap').find('.input-color').val(color);

        $customColor.val(color).css('background-color', color);

        //цвет иконки и фона кнопки

        $customColor.closest('.picker-window-wrap').css({'border-color': color});

        $customColor.closest('.picker-window-wrap').find('.custom-color__vis').css({'background-color': color});

        autoColor();
    }

    //автоподстройка цвета текста и заливки иконки (было 0,5)

    function autoColor() {
        if (colorPicker.hsl[2] > 0.6) {
            $customColor.css('color', '#000000');

            $customColor.closest('.picker-window-wrap').find('.custom-color__vis').css({fill: '#000000'});
        } else {
            $customColor.css('color', '#ffffff');

            $customColor.closest('.picker-window-wrap').find('.custom-color__vis').css({fill: '#ffffff'});
        }
    }

    //обработчики

    $(document).on('click', function (e) {
        var valueColor = $(e.target).find('.input-color').val(),
            $currentEl = $(e.target);

        if ($currentEl.hasClass('custom-color') && $currentEl.next('#picker-window').length) {
            //сработал в блоке, где был вставлен

            $picker.toggle();
        } else if ($currentEl.hasClass('custom-color') && !$currentEl.next('#picker-window').length) {
            //переключили на другой блок

            $picker.hide();

            $currentEl.parent().append($picker);

            $picker.show();

            //установка цветов при открытии окна

            colorPicker.setColor(valueColor);

            pickerUpdate(valueColor);
        }

        //закрыть пикер по клику вне его

        if ($picker.is(':visible') && !$currentEl.closest('.picker-window-wrap').length) {
            $picker.hide();
        }

        setTimeout(function () {
            //если ушли с выбора цвета на предустановленный

            if (
                $currentEl.closest('.select-color').length &&
                !$currentEl.closest('.settings-bordered-item').find('.custom-color').hasClass('active')
            ) {
                $currentEl.closest('.settings-bordered-item').find('.picker-window-wrap').css({'border-color': ''});
            }

            //установка цвета активного бордера

            if ($currentEl.hasClass('custom-color') && $currentEl.hasClass('active')) {
                $currentEl.parent().css({'border-color': valueColor});
            }
        }, 0);
    });

    $(document).on('keydown', '#set-custom-color', function (event) {
        var self = $(this);

        setTimeout(function () {
            var value = self.val(),
                isOk = /(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(value);

            if (isOk) {
                colorPicker.setColor(value);

                autoColor();
            }
        }, 0);
    });

    $(document).on('click', '#set-color__cancel', function () {
        $picker.hide();
    });

    $(document).on('click', '#set-color__ok', function () {
        console.log($('#set-custom-color').get(0).value, $('#set-custom-color'));
    });
}

/*Кнопка продолжить покупку в плавающей корзине*/

/*$(document).ready(function () {

$(document).on('click', '.side-basket__continue', function (event) {

event.preventDefault();

$('.filter-section-wrapper').slideToggle();

$('#shopCart').toggleClass('show');

});

});*/

/*Маска ввода телефона в форме обратной связи*/

$(document).ready(function () {
    var maskList = $.masksSort(
        $.masksLoad('../assets/templates/market/libs/inputmask-multi/data/phone-codes.json'),

        ['#'],
        /[0-9]|#/,
        'mask'
    );

    var maskOpts = {
        inputmask: {
            definitions: {
                '#': {
                    validator: '[0-9]',

                    cardinality: 1,
                },
            },

            //clearIncomplete: true,

            showMaskOnHover: false,

            autoUnmask: true,
        },

        match: /[0-9]/,

        replace: '#',

        list: maskList,

        listKey: 'mask',

        onMaskChange: function (maskObj, completed) {
            if (completed) {
                var hint = maskObj.name_ru;

                if (maskObj.desc_ru && maskObj.desc_ru != '') {
                    hint += ' (' + maskObj.desc_ru + ')';
                }

                //$(".descr").html(hint);
            } else {
                //$(".descr").html("");
            }

            $(this).attr('placeholder', $(this).inputmask('getemptymask'));
        },
    };

    //$('input[name="phone"],input[name="registerPhone"],input[name="profilePhone"]').inputmasks(maskOpts);
});

//высота элементов каталога

function calculateCatalogElHeight() {
    if (calcWindowWidth() > 1200) {
        /*определение высоты элемента каталога*/

        var elCard = $('.outside-product:first').children();

        //верхний и нижний отступы + border

        var sumHeight = 0;

        elCard.each(function (i, item) {
            sumHeight += item.clientHeight;
        });

        sumHeight -= 66 + 'px';

        $('.preview-product-element').css({height: sumHeight});

        $('.catalog-spisok .title, .catalog-spisok .price').css({height: ''});
    } else {
        $('.preview-product-element').css({height: ''});

        $('.catalog-spisok .title, .catalog-spisok .price').css({height: ''});

        $('.catalog-spisok .title').setMaxHeights();

        $('.catalog-spisok .price').setMaxHeights();
    }
}

function catalogElements() {
    var $els = document.querySelectorAll('.catalog-plitka .element'),
        i;

    for (i = 0; i < $els.length; i++) {
        if (calcWindowWidth() > 1200 && $els[i].querySelectorAll('.outside-product .order-block .count-form').length) {
            $els[i].querySelector('.order-block').after($els[i].querySelector('.buy-block.shk-item'));
        } else if (
            calcWindowWidth() > 1200 &&
            $els[i].querySelectorAll('.outside-product .order-block .in-basket-btn').length
        ) {
            $els[i].querySelector('.buy-block').appendChild($els[i].querySelector('.in-basket-btn'));
        } else if (
            calcWindowWidth() <= 1200 &&
            document.querySelectorAll('.outside-product .buy-block .count-form').length &&
            !$els[i].querySelectorAll('.order').length &&
            !$els[i].querySelectorAll('.in-basket').length
        ) {
            $els[i].querySelector('.order-block').appendChild($els[i].querySelector('.buy-block.shk-item'));
        } else if (
            calcWindowWidth() <= 1200 &&
            document.querySelectorAll('.buy-block.in-basket').length &&
            !$els[i].querySelectorAll('.order').length
        ) {
            $els[i].querySelector('.order-block').appendChild($els[i].querySelector('.buy-block.shk-item'));
        }
    }

    calculateCatalogElHeight();
}

function deleteClassOrder480() {
    var el = $('.preview-product.card-preview .more-buy .preview-product-element.order').length;
    if (calcWindowWidth() <= 480 && el > 0) {
        $('.preview-product.card-preview .more-buy .preview-product-element').removeClass('order');
    }
}

function customCounter() {
    $('.count__form-btn').on('click', function (e) {
        $counter = $(this).closest('.count-block').find('.count__form-val');

        if ($(this).data('spin') === 'up') {
            $counter.val(parseInt($counter.val()) + 1);
        } else {
            $counter.val(parseInt($counter.val()) - 1);

            if (parseInt($counter.val()) < 1) {
                $counter.val(1);
            }
        }
    });
}

/*Обработка нажатия кнопки Enter в формах поиска*/

$('html').keydown(function (e) {
    //отлавливаем нажатие клавиш

    if (e.keyCode == 13) {
        //если нажали Enter, то true

        /*Проверяем, заполнены ли поля поиска */

        var search = $('input[name="s"]:focus');

        var search_val = search.val();
        if (search_val != undefined) {
            if (search_val.length > 0) {
                search.parents('form').submit();
            }
        }
    }
});

$(window).load(function () {
    var btnShowFastView = $('.btn-show-fast-view');

    // -- Functions reinit BEGIN
    function reInitSliderFastView() {
        var $curSlider = $('.modal-fast-view .fast-view-slider');
        if ($curSlider.length) $curSlider.slick('unslick');
    }

    function reInitScrollBar() {
        var $blockProductInfo = $('.modal-fast-view .wrap-product-info');
        $blockProductInfo.mCustomScrollbar('destroy');
    }

    // -- Functions reinit END

    btnShowFastView.click(function () {
        $('.modal-fast-view .uk-modal-close').on('click', function () {
            reInitSliderFastView();
            reInitScrollBar();
        });
    });
});

$(document).ready(function () {
    // var labels = $("label.checkbox");
    // var svgCheck = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="45.701px" height="45.7px" viewBox="0 0 45.701 45.7" xml:space="preserve"><g><g><path fill="#3E5B69" d="M20.687,38.332c-2.072,2.072-5.434,2.072-7.505,0L1.554,26.704c-2.072-2.071-2.072-5.433,0-7.504 c2.071-2.072,5.433-2.072,7.505,0l6.928,6.927c0.523,0.522,1.372,0.522,1.896,0L36.642,7.368c2.071-2.072,5.433-2.072,7.505,0 c0.995,0.995,1.554,2.345,1.554,3.752c0,1.407-0.559,2.757-1.554,3.752L20.687,38.332z"/></g></g></svg>';
    // labels.prepend(svgCheck);

    //Table tr check height START
    var tableTrCheckHeight = function () {
        var trTitle = $('.compare-product__table_titles tr');
        var tables = $('.compare-product__table:not(.compare-product__table_titles)');

        var trInfo = tables.find('tr');

        tables.each(function () {
            var curTr = $(this).find('tr');

            curTr.each(function () {
                var index = $(this).index();
                var arrHeight = [$(this).height(), trTitle.eq(index).height()];

                if (arrHeight[0] !== arrHeight[1]) {
                    $(this).height(Math.max(...arrHeight));
                    $('.compare-product__table').each(function () {
                        var tr = $(this).find('tr:not(.row-subtitles-mobile)');
                        tr.eq(index).height(Math.max(...arrHeight));
                    });
                }
            });
        });
        setHeightWrapTables();
    };
    //Table tr check height END

    //Compare product page START
    //Set height wrapper tables
    var setHeightWrapTables = function () {
        var wrap = $('.compare-product__tables');
        var tables = $('.compare-product__tables .wrap-my-table.active');

        if (tables.length) {
            var arrHeight = [];
            var counter = 0;
            tables.each(function () {
                arrHeight[0] = $(this).outerHeight(true);
            });
            wrap.height(Math.max(...arrHeight));
        }
    };
    //

    //Scroll bar compare product
    var customScrollbar = function () {
        var blockProductsRow = $('.compare-product .compare-product__product-line');
        var blockTable = $('.compare-product .compare-product__table_scroll');

        if (blockProductsRow.length) {
            blockProductsRow.mCustomScrollbar({
                axis: 'x',
                scrollInertia: 0,
                scrollButtons: {
                    enable: true,
                },
                mouseWheel: {
                    scrollAmount: '50',
                },
                callbacks: {
                    whileScrolling: function () {
                        var left = this.mcs.left;
                        blockTable.css({left: left + 'px'});

                        if ($(window).width() < 576) {
                            $('.title-mobile').css({left: -left + 'px'});
                        }
                    },
                },
            });

            var btnsScroll = $('.compare-product .compare-product__product-line .mCSB_scrollTools > a');

            if (btnsScroll.length) {
                btnsScroll.html(`<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1.09267 9.90012L5.89687 5.23037C5.96559 5.16366 6 5.0869 6 5.00007C6 4.91324 5.96559 4.83634 5.89687 4.76959L1.09267 0.100236C1.02385 0.0333418 0.944879 0 0.855507 0C0.766172 0 0.687092 0.033447 0.618412 0.100236L0.103092 0.601134C0.0343757 0.667923 3.52859e-05 0.744785 3.52859e-05 0.831614C3.52859e-05 0.918443 0.0343757 0.995304 0.103092 1.06209L4.15466 5.00007L0.102839 8.93819C0.0341229 9.00494 -4.76837e-07 9.08184 -4.76837e-07 9.16853C-4.76837e-07 9.2555 0.0343394 9.33236 0.102839 9.39911L0.618376 9.90008C0.687056 9.96683 0.766172 10 0.855471 10C0.944878 10 1.02396 9.96687 1.09267 9.90012Z" fill="#292929"/>
        </svg>
        `);
            }
        }
    };
    //

    //Table characteristic tabs
    var tableTabs = function () {
        var tabs = $('.compare-product .compare-product__tab');
        var tables = $('.compare-product .wrap-my-table');

        if (tabs.length && tables.length) {
            tabs.click(function () {
                tabs.removeClass('compare-product__tab_active');
                $(this).addClass('compare-product__tab_active');

                tables.removeClass('active');
                tables.eq($(this).index()).addClass('active');
                setHeightWrapTables();
            });
        }
    };
    //

    // //Сравнение товаров.
    var compareProducCharacteristicsDel = function () {
        // $(document).ready(function () {
        //Скрытие параметра фильтрации
        $(document).on('click', '.compare-product__table .compare-product__btn-delete', function (event) {
            event.preventDefault();
            var tvid = $(this).data('tvid');
            $(this).parents('tr').toggleClass('hide');
            $('.compare-product__table')
                .find('tr[data-tvid="' + tvid + '"]')
                .toggleClass('hide');
            $('.compare-product__selects-characterictics')
                .find('div[data-tvid="' + tvid + '"]')
                .toggleClass('hide');
            setHeightWrapTables();
        });
        //Возврат к отображению параметра для фильтрации
        $(document).on('click', '.compare-product__selects-characterictics-item', function (event) {
            event.preventDefault();
            var tvid = $(this).data('tvid');
            $(this).addClass('hide');
            $('.compare-product__table')
                .find('tr[data-tvid="' + tvid + '"]')
                .removeClass('hide');
            $('.compare-product__table')
                .find('.compare-product__btn-delete[data-tvid="' + tvid + '"]')
                .parents('tr')
                .toggleClass('hide');
            setHeightWrapTables();
        });

        //Убрать товар из сравнения
        //Возврат к отображению параметра для фильтрации
        $(document).on('click', '.btn-remove-product', function (event) {
            //event.preventDefault();
            var docid = $(this).data('id');
            $(this).parents('.compare-product__product').addClass('hide');
            $('.compare-product__table')
                .find('td[data-docid="' + docid + '"]')
                .addClass('hide');
        });

        //Очистить сравнение товаров
        $(document).on('click', '.compare-product__btn-clear', function (event) {
            event.preventDefault();
            deleteCookie('eFavorite_compare');
            eFavorite_compare.init();
            $('div.compare-product').html('<div class="no-compare">Товары для сравнения отсутствуют</div>');
            //var docid = $(this).data('id');
            //$(this).parents('.compare-product__product').addClass("hide");
            //$('.compare-product__table').find('td[data-docid="' + docid + '"]').addClass("hide");
        });
        // });
    };
    compareProducCharacteristicsDel();

    customScrollbar();
    tableTabs();
    // setHeightWrapTables();
    tableTrCheckHeight();
    //Compare product page END

    //Personal aria START
    //Btn show/hide content START
    var personalAreaBtnShowHide = function () {
        var btn = $('.btn-show-info');

        if (btn.length) {
            btn.click(function () {
                $(this).toggleClass('btn-show-info_active');

                if ($(this).hasClass('btn-show-info_active')) {
                    $(this).find('.btn-show-info-text').text($(this).attr('data-active-text'));
                } else {
                    $(this).find('.btn-show-info-text').text($(this).attr('data-text'));
                }

                var content = $(this).closest('.wrap-show-info').find('.show-info');
                content.slideToggle();
            });
        }
    };
    //Btn show/hide content END

    //Toggle class cash items START
    var toggleClassCashItems = function () {
        var items = $('.wrap-cash-img-btn');

        if (items.length) {
            items.click(function () {
                var curWrap = $(this).closest('.wrap-cash-items');
                curWrap.find('.wrap-cash-img-btn').removeClass('wrap-cash-img-active');
                $(this).addClass('wrap-cash-img-active');
            });
        }
    };
    //Toggle class cash items END

    //Preloader table products START
    var personalAreaPrelaoderTable = function () {
        var wrapTable = $('.orders__item-wrap-table');

        if (wrapTable.length && $(window).width() > 576) {
            wrapTable.mCustomScrollbar({
                axis: 'x',
                mouseWheel: {
                    scrollAmount: '200',
                },
            });
        }
    };
    //Preloader table products END

    //Select price START
    var selectPrice = function () {
        var items = $('.price-var .price-var-item');
        var field = $('.price-result input');

        if (items.length) {
            items.click(function () {
                items.removeClass('active');
                $(this).addClass('active');

                field.val($(this).find('input').val());
            });
        }
    };
    //Select price END

    personalAreaPrelaoderTable();
    personalAreaBtnShowHide();
    toggleClassCashItems();
    selectPrice();
    //Personal aria START

    //Product card START
    var blockOtherProductScrollbar = function () {
        var blockOtherProduct = $('.wrap-product-vars-content');
        blockOtherProduct.mCustomScrollbar({
            axis: 'x',
            scrollButtons: {
                enable: true,
            },
            mouseWheel: {
                scrollAmount: '200',
            },
        });

        var btnsScroll = $('.wrap-product-vars .mCSB_scrollTools > a');

        if (btnsScroll.length) {
            btnsScroll.html(`<svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M1.09267 9.90012L5.89687 5.23037C5.96559 5.16366 6 5.0869 6 5.00007C6 4.91324 5.96559 4.83634 5.89687 4.76959L1.09267 0.100236C1.02385 0.0333418 0.944879 0 0.855507 0C0.766172 0 0.687092 0.033447 0.618412 0.100236L0.103092 0.601134C0.0343757 0.667923 3.52859e-05 0.744785 3.52859e-05 0.831614C3.52859e-05 0.918443 0.0343757 0.995304 0.103092 1.06209L4.15466 5.00007L0.102839 8.93819C0.0341229 9.00494 -4.76837e-07 9.08184 -4.76837e-07 9.16853C-4.76837e-07 9.2555 0.0343394 9.33236 0.102839 9.39911L0.618376 9.90008C0.687056 9.96683 0.766172 10 0.855471 10C0.944878 10 1.02396 9.96687 1.09267 9.90012Z" fill="#292929"/>
    </svg>
    `);
        }
    };

    // $(".region__select").select2();

    blockOtherProductScrollbar();
    //Product card END
});

document.addEventListener(
    'DOMContentLoaded',
    function () {
        const tasksListElement = document.querySelector('.tasks__list');
        const taskElements = tasksListElement.querySelectorAll('.tasks__item');

        let dataNmr = function () {
            for (let i = 0; i < taskElements.length; i++) {
                taskElements[i].setAttribute('data-nmr', `${i + 1}`);
            }
        };
        dataNmr();

        var sortable = UIkit.sortable('.tasks__list', {
            // options
            // change: function (event, ui) {
            //   console.log("test");
            // },
        });
    },
    false
);

// фиксация элемента "Консультация" фиксируем в нижней части экрана
// $(document).ready(function () {
//   const objectsContentRight = document.querySelector(".consultation__wrap");
//   if (objectsContentRight) {
//     const offsetConsultation = function () {
//       // const objectsContentRight = document.querySelector(".consultation__wrap");
//       const pagebuilderRight = document.querySelector(".pagebuilder__right");
//       const pagebuilderRightCoord = pagebuilderRight.getBoundingClientRect();
//       const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
//       const height = window.innerHeight;

//       const fixOffsetConsultation = function () {
//         const top = $(document).scrollTop();
//         const rect = objectsContentRight.getBoundingClientRect();

//         if (height > rect.bottom) {
//           $(".consultation__wrap").addClass("fixed");
//         } else {
//           $(".consultation__wrap").removeClass("fixed");
//         }

//         // убираем fixed когда доскролили до footer
//         if (top > pagebuilderRightCoord.bottom - height + scrollTop) {
//           $(".consultation__wrap").removeClass("fixed");
//           $(".pagebuilder__right").css("display", "flex");
//           $(".pagebuilder__right").css("align-items", "flex-end");
//         } else {
//           $(".pagebuilder__right").css("display", "");
//           $(".pagebuilder__right").css("align-items", "");
//         }

//         // убираем fixed когда доскролили до верха страницы
//         // 20 - padding-bottom в fixed .consultation__wrap
//         if (pagebuilderRightCoord.top - height > 0) {
//           if (top - $(".consultation__wrap").outerHeight() + 20 <= pagebuilderRightCoord.top - height) {
//             $(".consultation__wrap").removeClass("fixed");
//           }
//         }

//         // убираем fixed когда доскролили до верха страницы и .consultation__wrap спрятон за экраном
//         if (pagebuilderRightCoord.top - height < 0) {
//           const p = pagebuilderRightCoord.top - height;
//           const newP = -p;
//           if (top <= newP) {
//             $(".consultation__wrap").removeClass("fixed");
//           }
//         }
//       };

//       $(window).scroll(function () {
//         fixOffsetConsultation();
//       });

//       fixOffsetConsultation();
//     };
//     offsetConsultation();
//   } else {
//     return false;
//   }
// });

// фиксация элемента "Консультация" фиксируем в верхней части экрана
// document.addEventListener(
//   'DOMContentLoaded',
//   function () {
//     const pagebuilderRight = document.querySelector('.no_left_bar_service .pagebuilder__right');

//     if (pagebuilderRight) {
//       const windowInnerHeight = window.innerHeight;

//       // фиксируем при скролле страницы
//       const offsetConsultation = function () {
//         const heightHeaderScroll = document.querySelector('.header-scroll').offsetHeight;
//         const heightConsultationWrap = document.querySelector('.consultation__wrap').offsetHeight;
//         const rect = pagebuilderRight.getBoundingClientRect();
//         const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

//         const fixOffsetConsultation = function () {
//           const rect2 = pagebuilderRight.getBoundingClientRect();
//           const top = $(document).scrollTop();

//           if (top > rect.top - heightHeaderScroll + scrollTop) {
//             $('.consultation__wrap').addClass('fixed');
//           } else {
//             $('.consultation__wrap').removeClass('fixed');
//           }

//           // останавливаем в конце обертки
//           if (rect2.bottom <= heightConsultationWrap + heightHeaderScroll) {
//             $('.consultation__wrap').removeClass('fixed');
//             $('.pagebuilder__right').css('display', 'flex');
//             $('.pagebuilder__right').css('align-items', 'flex-end');
//           } else {
//             $('.pagebuilder__right').css('display', '');
//             $('.pagebuilder__right').css('align-items', '');
//           }
//         };

//         $(window).scroll(function () {
//           fixOffsetConsultation();
//         });

//         fixOffsetConsultation();
//       };

//       offsetConsultation();
//     } else {
//       return false;
//     }
//   },
//   false
// );

$(document).ready(function () {
    $('.owl-nav').hide();
});

// убираем бордер если отключили рейтинг, артикул, бренд в самом товаре каталога подробное описание
function noBorderInfoHeader() {
    const mainFirstInfoHeader = document.querySelector('.main-first-info-header');

    if (mainFirstInfoHeader) {
        const mainFirstInfoHeaderArticul = document.querySelector('.main-first-info-header .main-first-info__articul');
        const mainFirstInfoHeaderRating = document.querySelector('.main-first-info-header .main-first-info__rating');
        const mainFirstInfoHeaderBrand = document.querySelector('.main-first-info-header .main-first-info__brand');

        if (!mainFirstInfoHeaderArticul & !mainFirstInfoHeaderRating & !mainFirstInfoHeaderBrand) {
            mainFirstInfoHeader.style.display = 'none';
        }
    }
}

// высота элемента если отключили наличие, артикул в разделе товаров каталога
function noArticleAvail() {
    const windowInnerWidth = document.documentElement.clientWidth;
    const articleAvailability = document.querySelector('.article-and-availability');

    if (articleAvailability && windowInnerWidth > 1200) {
        const availability = document.querySelector('.article-and-availability .availability');
        const article = document.querySelector('.article-and-availability .article');

        if (!availability & !article) {
            $('.outside-product').addClass('not-article-and-availability');
        } else {
            $('.outside-product').removeClass('not-article-and-availability');
        }
    }
}

// прокрутка табов
$(document).ready(function () {
    // код по переключению самих табов находится в файле assets\templates\market\libs\jqueryScrolltabs\jquery.scrolltabs.js
    // строки 285-292
    $('.tabScrollInit').scrollTabs({
        scroll_distance: 100,
        // scroll_duration: 350,
        left_arrow_size: 21,
        right_arrow_size: 21,
    });
});

// function scrollLeftBarBanners() {
//   var el = $(".left-bar__banners-wrap");
//   var elX = el.offset();
//   var elTop = elX.top;
//   console.log('elTop ', elTop);
//   var elBot = elTop + el.height();
//   console.log('elBot ', elBot);

//   $(window).scroll(function () {
//     var scrollTop = $(window).scrollTop();
//     var winHei = $(window).height();
//     // var footerTopHei = $('footer.footer').offset().top + 35;
//     // if ($('.left-bar__banners-wrap').length && $(window).scrollTop() > $('.left-bar__banners-wrap').offset().top) {
//     //   console.log('left 1');
//     //   $('.left-bar__banners-wrap').addClass('fixed');
//     // } else {
//     //   console.log('left 1');
//     //   $('.left-bar__banners-wrap').removeClass('fixed');
//     // }

//     // if ($('footer.footer').length > 0 && $('footer.footer').offset().top + 35 < scrollTop + winHei) {
//     //   console.log('foot 1');
//     //   // $('.left-bar__banners-wrap').css('bottom', 35 + scrollTop + winHei - footerTopHei);
//     //   $('.left-bar__banners-wrap').css('bottom', 0);
//     // } else {
//     //   console.log('foot 2');
//     //   $('.left-bar__banners-wrap').css('bottom', 35);
//     // }
//   });
// }

// function scrollLeftBarBanners() {
//   function is_fully_shown(target) {
//     var wt = $(window).scrollTop();
//     var wh = $(window).height();
//     var eh = $(target).height();
//     var et = $(target).offset().top;

//     if (et >= wt && et + eh <= wh + wt) {
//       return true;
//     } else {
//       return false;
//     }
//   }

//   $(window).scroll(function () {
//     if (is_fully_shown('.left-bar__banners-wrap')) {
//       console.log(true);
//     } else {
//       console.log(false);
//     }
//   });
// }

function scrollLeftBarBanners() {
    function elementInViewport(el) {
        var bounds = el.getBoundingClientRect();
        // console.log('ниже верхней  ', bounds.top + bounds.height);
        // console.log('Выше нижней ', window.innerHeight - bounds.top);

        return (
            // (bounds.top + bounds.height > 0) && // Елемент ниже верхней границы
            // (window.innerHeight - bounds.top > 0) && // Выше нижней
            // (bounds.left + bounds.width > 0) && // Правее левой
            // (window.innerWidth - bounds.left > 0)// Левее правой
            window.innerHeight > bounds.bottom
            // bounds.top + bounds.height > 0 && // Елемент ниже верхней границы
            // window.innerHeight - bounds.top > 0 // Выше нижней
        );
    }

    var el = document.querySelector('.left-bar__banners-wrap');
    var el2 = $('.left-bar__banners-wrap');

    let wrapper = $('.left-bar');
    let menu = $('.main-menu-left')
    let foot = $('.footer');
    let hei = wrapper.outerHeight() - menu.outerHeight()
    console.log('foot.offset().top ', foot.offset().top);
    console.log('hei ', hei);
    console.log('summ ', foot.offset().top - $(window).height());
    console.log('el2.outerHeight() ', el2.outerHeight());
    console.log('$(window).height() ', $(window).height());


    document.addEventListener('scroll', (e) => {
        var inViewport = elementInViewport(el);
        // console.log('inViewport ', inViewport);
        console.log('$(window).scrollTop() ', $(window).scrollTop());
        if (inViewport) {
            el.classList.remove('absolute');
            el.classList.add('fixed');
        } else {
            // el.classList.remove('fixed');
        }

        if ($(window).scrollTop() > foot.offset().top - $(window).height()) {
            el.classList.remove('fixed');
            el.classList.add('absolute');
        } else {
            el.classList.remove('absolute');
        }
    });
}
