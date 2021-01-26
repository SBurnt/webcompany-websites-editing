/*Вывод прайса на печать*/
$(document).ready(function () {
	$('.print_bat').click(function (event) {
		event.preventDefault();
		$(this).parents('.table-price').addClass('printing');
		window.print();
	});
});

//правый бордер в слайдере спец. предложения на главной
// setTimeout(function () {
//     $('.sale .active:eq(1)').addClass('border-right');
// }, 1000);


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
		Share.popup(url)
	},

	googleplus: function (purl) {
		url = 'https://plus.google.com/share?';
		url += 'url=' + encodeURIComponent(purl);
		Share.popup(url)
	},

	popup: function (url) {
		window.open(url, '', 'toolbar=0,status=0,width=626,height=436');
	}
};


$(document).ready(function () {
	itemInput = 1;
	//добавление поля для промежуточной точки
	function intermediatePoint() {
		// $('.form-transfer').on('click', '.form-transfer__add-point', function () {
		// 	$(this).prev().children('input:first').clone(true).attr('name', function(){
		// 		itemInput++;
		// 		return 'address' + itemInput;
		// 	}).css({'margin-top':'15px'}).appendTo('#add-input');
		// 	$(this).parent().find('.form-transfer__label')
		// 		.addClass('active');
		// 	$(this).parent().find('.form-transfer__add-point')
		// 		.addClass('active');
		// 	// return false;
		// });


		//перемещение кнопки заказать в слайдере главной страницы
        var buyBtnMain = $('.slider-main .buy-button:first'),
			linkBtnMain = $('.slider-main .more-button:first'),
			linkBtnMainWrap = $('<div class="buy-btn-center"></div>').append(linkBtnMain),
            buyBtnMainWrap = $('<div class="buy-btn-center"></div>').append(buyBtnMain);

		if ($(window).width() < 481) {
			$('.slider-main').after(linkBtnMainWrap);
            $('.slider-main').after(buyBtnMainWrap);
		}






        $('.form-transfer').on('click', '.form-transfer__add-point', function () {
            var cloneWrap = $('.clone-wrap:first').clone(true);
            var delAddress = '<div class="del-adress">отменить</div>';
            var input = cloneWrap.find('input');
			
			cloneWrap.append(delAddress);

            /*if (itemInput != 1) {
                cloneWrap.append(delAddress);
			}*/
			console.log(itemInput);
			itemInput++;
            input.attr('name', function(){
						console.log(itemInput);
                		return 'address' + itemInput;
                	});
            input.val('');
			
            cloneWrap.appendTo('#add-input');
        });


        $('.form-transfer').on('click', '.del-adress', function () {
            $(this).parent('.clone-wrap').hide();
            $(this).parent('.clone-wrap').find('input').remove();
			$(this).parent('.clone-wrap').setTimeout(function () {
				$(this).remove();
			},1000);
        });

	}

	intermediatePoint();


	// function intermediatePoint() {
	//     var itemInput = 1;
	//     var newLine = $('.form-transfer__add-point')
	//                 .parent('.form-transfer__line')
	//                 .clone().find()
	//
	//     $('.form-transfer').on('click', '.form-transfer__add-point', function () {
	//
	//     });
	// }


	$(".datepicker").datepicker({
		weekStart: 1,
		daysMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
		months: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
		monthsShort: [ "Янв","Фев","Мар","Апр","Май","Июн", "Июл","Авг","Сен","Окт","Ноя","Дек" ],
		format: 'dd/mm/yyyy',
		autoPick:true
	});


	/*Раскрываем левое меню*/
	$('.main-menu-left ul.dropdown li.active').parents('li').addClass('active');
	$('.main-menu-left li.active > ul.dropdown').show();
	$('.main-menu-left li.active > .wrap > span').addClass('uk-icon-angle-up');


	/*цвет блока availability*/
	function availabilityColor() {
		$('span.in-stock').parent().css({"color": "#1bcc7b"});
		$('span.reservation').parent().css({"color": "#e2821b"});
		$('span.not-available').parent().css({"color": "#e51528"});
	}

	availabilityColor();

	/*определение высоты элемента каталога*/
	var elCard = $('.outside-product:first').children();

	//верхний и нижний отступы + border
	var sumHeight = 0;

	elCard.each(function (i, item) {
		sumHeight += item.clientHeight;
	});

	sumHeight += "px";

	$('.preview-product-element').css({"height": sumHeight});

	/*стрелки в меню + активный верхний пункт*/
	$('ul.menu-sub').parent('li').addClass('nav-arrow');
	// $('li.active').parents('#menu-flex > li').addClass('active');
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
	}

	hoverColorImg('div.company-element', 'data-srchover');
	hoverColorImg('.footer-var-1 div.footer-top div.social a', 'data-src_soc_icon_bottom');


	/*
     $('div.company-element').mouseenter(function () {
     thisImg = $(this).find('img');
     newSrc = thisImg.attr("data-srchover");
     oldSrc = thisImg.attr("src");
     src = thisImg.attr("src", newSrc );
     });

     $('div.company-element').mouseleave(function () {
     thisImg.attr("src", oldSrc );
     });
     */

	if ($('.header-top-var-1').length) {
		$('.header-top-var-1 #menu-flex').flexMenu({
			linkText: ""
		});
	} else if ($('.header-top-var-2').length) {
		$('.header-top-var-2 #menu-flex').flexMenu({
			linkText: ""
		});
	} else {
		$('#menu-flex').flexMenu({
			linkText: "Ещё"
		});
	}


	$('#menu-flex-scroll').flexMenu({
		linkText: "Меню"
	});

	//счетчик количества товаров
	/*
     $("body").on("click", ".count-form", function(evt) {
     var elem = evt.target;
     var container = evt.currentTarget;
     var input = container.getElementsByClassName('count__form-val')[0];
     //var sum = container.getElementsByClassName('sum')[0];
     var count = parseInt(input.getAttribute('data-count'), 10);
     //var price = parseInt(input.getAttribute('data-price'), 10);

     if (elem.classList.contains('down')) {
     count = count == 1 ? count : (count - 1);
     } else if (elem.classList.contains('up')){
     count += 1;
     }
     console.log(count);
     input.value = count;
     //sum.innerHTML = price * count;
     input.setAttribute('data-count', count);
     });
     */

	// $('.buy-btn').on('click',function (e) {
	//     console.log($(this).prev().find('.count__form-val').val());
	// })

	//вычисляем top для заголовка услуг
	if ($(document).width() > 1025) {
		$('div.services-element div.content').each(function (i, item) {
			var topPosition = $(this).position().top + "px";
			$(this).css({"top": topPosition});
		});
	}

	if ($(document).width() < 1025) {
		$('.dignity-main-element').setMaxHeights();


		// $('.slider-sale .owl-item').setMaxHeights();
	}


	// $('.news-element').setMaxHeights();


	//вычисляем bottom и right для выполненых проектов
	//задержка задана из-за слайдера
	setTimeout(function () {
		$('div.completed-project-content').each(function (i, item) {

			var projectBottom = $(this).prev().height() - $(this).height() + "px";

			//-1px из-за дробной части в пикселях
			var projectRight = $(this).prev().outerWidth() - $(this).outerWidth() - 1 + "px";

			$(this).css({"bottom": projectBottom, "right": projectRight});
		});
	}, 500);

	//отмена центрирования при переполнении контента услуг
	function overflowInfo(el, maxHeight){
		$(el).each(function (i, item) {

			var innerBlocks = $(this).children();
			var infoHeight = 0;
			// var maxHeight = 159;

			innerBlocks.each(function () {
				infoHeight += $(this).outerHeight(true);
			});

			if (infoHeight > maxHeight) {
				$(this).addClass('flex-start');
			}
		});
	}

	overflowInfo('.projects-page .completed-projects-slider__info', 159);
	overflowInfo('.catalog-element__info', 122)




	//scroll-menu
	var menuHeight = $('.header-scroll.active').outerHeight();
	var headerCenterBarHeight = $('.center-bar').outerHeight();
	var topBarHeight = $('.top-bar').outerHeight();

	var showPosition = headerCenterBarHeight + topBarHeight - menuHeight;


	$(window).scroll(function () {
		if ($(this).scrollTop() >= showPosition) {
			$('.header-scroll.active').addClass('show');
		}
		else {
			$('.header-scroll.active').removeClass('show');
		}
	});

	//удаляем слова руб при пустом old-price
	// function removeRubWord() {
	//     $('.price_old_rub_val').each(function () {
	//         var valEl = $(this).text();
	//
	//         if (!valEl) {
	//             $(this).next('.price_old_rub').hide();
	//         }
	//     });
	// }

	//removeRubWord();

	//удаляем слова руб при аякс запросе
	// $(document).on('click', '.sorting-catalog-view', function () {
	//     setTimeout(function () {
	//         //removeRubWord();
	//         availabilityColor();
	//     }, 400)
	// });

	//проверка наличия корзины
	function hasBasket() {
		setTimeout(function () {
			if ($('.wrap-menu #shopCart').length) {
				return true;
			} else {
				return false;
			}
		}, 1000)

	}

	//проверка подключения корзины
	if ( !hasBasket() ) {
		$('.search-wrap').hide();
	} else {
		$('.wrap-menu').addClass('has-basket');
	}


	// function scrollbarWidth() {
	//     var documentWidth = parseInt(document.documentElement.clientWidth);
	//     var windowsWidth = parseInt(window.innerWidth);
	//     var scrollbarWidth = windowsWidth - documentWidth;
	//     return scrollbarWidth;
	// }




	//мобильное меню
	var mobileMenuBtn = $('span.button-mobile-menu');
	var menuMobileContainer = $('div.wrap-menu');
	var mobileMenuInner = $('div.mobile-menu-inner');
	var scrollAxisY = 0;

	mobileMenuBtn.on('click', function () {

		if ( !$('body').hasClass('mobile-active') ) {
			scrollAxisY = $(window).scrollTop();
		}

		$(this).toggleClass('active');
		menuMobileContainer.toggleClass('active');
		$('body').toggleClass('mobile-active');

		if ( mobileMenuInner.hasClass('active') ) {

			mobileMenuInner.removeClass('active');
			$(window).scrollTop(scrollAxisY);

		} else {

			// setTimeout(function () {
			mobileMenuInner.addClass('active');
			// }, 600);

		}
	});

	$(document).on('click', function (e) {
		if ( menuMobileContainer.hasClass('active')
			&& !$(e.target).closest(menuMobileContainer).length
		   ) {

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
		// .toggleClass('show-submenu');
	});














	// $('.mob-button').click(function () {
	//     var This = $(this);
	//     This.children('i').toggleClass('uk-icon-angle-down uk-icon-angle-up');
	//     This.closest("li").toggleClass('active').find('.menu-sub').slideToggle();
	// });
	//
	// $('.button-mobile-menu').click(function () {
	//     // $(this).toggleClass('active').next().fadeToggle(300);
	//     $(this).addClass('active').next().addClass('show-menu-mobile');
	// });
	//
	// $('.spoiler-title ').click(function () {
	//     thisElement = $(this);
	//     thisElement.find('span').toggleClass('uk-icon-angle-down uk-icon-angle-up');
	//     thisElement.toggleClass('active').next().slideToggle();
	// });







	//телефоны хеадера мобилка
	// $('div.mobile-menu__callback').on('click', function () {
	// 	$('.mobile-menu__callback-hidden-wrap').toggleClass('active');
	// });

	$(document).on('click', function (e) {
		if ( $('.mobile-menu__callback-hidden-wrap').hasClass('active')
			&& !$(e.target).closest('.mobile-menu__callback').length
		   ) {

			$('.mobile-menu__callback-hidden-wrap').removeClass('active');
		}
	});















	//удаляем корзину из скролл-меню, если ее нет хеадере
	//если нет корзины удалям счетчик товара для заказа в карточке
	// if ( !hasBasket() ) {
	//     $('.header-scroll.active').find('.header-basket').hide();
	//
	//     $('.preview-product-element').addClass();
	//
	//
	// }


	//меняем z-index кнопки получить консультаию при ховере на слайдер
	$('.preview-product-element').hover(
		function () {
			$('.callback-main__button').css({'z-index': '0'});
		},

		function () {
			$('.callback-main__button').css({'z-index': ''});
		});


	//слайдер карточки товара
	$('.main-first-image-slider').slick({
		slickPrev: '<div class="card-left"></div>',
		slickNext: '<div class="card-right"></div>',
		// asNavFor: '.main-first-image-pager',
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		customPaging: function (slider, i) {
			var source = $(slider.$slides[i]).find('img').attr('src') + "";
			return '<a class="pager__item"><img src=' + source + '></a>';
		}
		// focusOnSelect: true

	});

	//слайдер выполненных проектов
	if ($(document).width() < 1025) {
		$('.completed-project-inner').slick({
			slidesToShow: 2,
			slidesToScroll: 1,
			arrows: false,
			dots: false,
			responsive: [
				{
					breakpoint: 769,
					settings: {
						slidesToShow: 1,
						centerMode: true
					}
				}
			]
		});
	}

	//слайдер новостей
	// if ($(document).width() < 769) {

	$('.news-wrap-mobile').slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		centerMode: true,
		arrows: false,
		dots: false,
		responsive: [
			{
				breakpoint: 415,
				settings: {
					slidesToShow: 1,
					centerMode: true,
					centerPadding: '20px'
				}
			}
		]
	});


	// $('.news-wrap-mobile').owlCarousel({
	//     loop: true,
	//     responsiveClass: false,
	//     nav: false,
	//     items: 2,
	//     center: true,
	//     margin: 10
	//
	// });

	// }


	//слайдер галлереи карточки товара с пэйджером
	$('.card-gallery-slider').slick({
		asNavFor: '.card-gallery-slider-pager',
		slidesToShow: 1,
		slidesToScroll: 1
	});

	$('.card-gallery-slider-pager').slick({
		asNavFor: '.card-gallery-slider',
		slidesToShow: 9,
		slidesToScroll: 1,
		arrows: false,
		focusOnSelect: true
	});

	//слайдер выполненных проектов
	$('.completed-projects-slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		prevArrow: '<div class="customPrevBtn"><img src="assets/templates/market/img/sprite/arr-slider-prev.png" alt=""></div>',
		nextArrow: '<div class="customNextBtn"><img src="assets/templates/market/img/sprite/arr-slider-next.png" alt=""></div>',
	});

	//пэйджер страницы проектов
	$('.projects-card-slider').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		infinite: true,
		asNavFor: '.projects-card-slider-pager',
		prevArrow: '<div class="customPrevBtn"><img src="assets/templates/market/img/left-progect.svg" alt=""></div>',
		nextArrow: '<div class="customNextBtn"><img src="assets/templates/market/img/right-progect.svg" alt=""></div>',
	});

	$('.projects-card-slider-pager').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		focusOnSelect: true,
		asNavFor: '.projects-card-slider',
		arrows: false
	});

	//слайдер услуг
	$('.card-services-slider').slick({
		slidesToShow: 2,
		slidesToScroll: 1,
		prevArrow: '<div class="customPrevBtn"><img src="assets/templates/market/img/sprite/arr-slider-prev.png" alt=""></div>',
		nextArrow: '<div class="customNextBtn"><img src="assets/templates/market/img/sprite/arr-slider-next.png" alt=""></div>',
	});


	$('div.main-first-image-slider-el a,' +
	  ' .fancyshow,' +
	  ' div.projects-card-slider-el a,' +
	  ' div.card-gallery-slider__el a'
	 ).fancybox({
		closeBtn: true,
		padding: 0,
		helpers: {
			overlay: {
				css: {
					'background': 'rgba(51,51,51,0.7)'
				}
			}
		}
	});

	//центрирование по высоте кнопок слайдера карточки товара
	var cardSliderTop = $('div.main-first-image-slider-el a').height() / 2 + 'px';
	$('div.main-first-image-slider .slick-arrow').css({'top': cardSliderTop});

	//какрточка товара, сворачивание таблицы
	var tableMoreTxt = $('.table-more').text();
	$('.card-description').on('click', '.table-more', function () {
		$(this).prev('.card-description__table-wrap').toggleClass('hidden')
		$(this).toggleClass('active');

		if ($(this).hasClass('active')) {
			$(this).text('Свернуть');
		} else {
			$(this).text(tableMoreTxt);
		}
	});

	//карточка товара
	function cardMore() {
		//карточка товара - описание - кнопка подробнее
		var moreBtnTxt = $('.card-description-more__btn').text();
		$('.card-description-more').on('click', '.card-description-more__btn', function () {

			console.log(moreBtnTxt);
			$(this).prev('.card-description-more__txt').toggleClass('hidden');

			$(this).toggleClass('active');

			if ($(this).hasClass('active')) {
				$(this).text('Свернуть');
			} else {
				$(this).text(moreBtnTxt);
			}
		});

		//карточка товара - краткое описание - клик по кнопке "подробнее"
		$('body').on('click', 'span.presence-description-more', function () {

			var scrollToDescription = $('.card-description-more').offset().top -
				$('.header-scroll').height();

			$('.card-description-more__txt').removeClass('hidden');
			$('.card-description-more__btn').addClass('active').text('Свернуть');
			// $('.card-description-more__btn').text('Свернуть');

			$('body, html').animate({scrollTop: scrollToDescription}, 500);

		});
	}

	cardMore();

	//скролл кнопки все характеристики для страницы проектов
	$('body').on('click', 'span.projects-card-description-more', function () {

		var scrollToDescription = $('.card-description.progect-page').offset().top -
			$('.header-scroll').height();

		$('body, html').animate({scrollTop: scrollToDescription}, 500);

	});


	//печать документа
	$('.main-first-info__print').on('click', function () {
		window.print();
	});

	//галочка для кастомного input
	$('label.checkbox').on('click', function () {
		if ($(this).find('input').prop("checked")) {
			$(this).addClass('active');
		} else {
			$(this).removeClass('active');
		}
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

	//кастомный двухцветный placeholder
	$("form").on('click', '.placeholder_custom, input[name="fiocont"]', function () {
		$(this).removeClass('active');
		$(this).prev().focus();
	});

	$("form").on('focusout', 'input[name="fiocont"], .js_custom-input', function () {
		if ($(this).val().trim() == '') {
			$(this).next().addClass('active');
		}
	});

	$(".contact-page-feedback-form").on('focus', '.contact-page-feedback__textarea', function () {
		$(this).focus().attr('placeholder', '');
	});



	//показываем содержимое svg image
	function svgInner() {
		jQuery('img.svg').each(function(){
			var $img = jQuery(this);
			var imgID = $img.attr('id');
			var imgClass = $img.attr('class');
			var imgURL = $img.attr('src');

			jQuery.get(imgURL, function(data) {
				// Get the SVG tag, ignore the rest
				var $svg = jQuery(data).find('svg');

				// Add replaced image's ID to the new SVG
				if(typeof imgID !== 'undefined') {
					$svg = $svg.attr('id', imgID);
				}
				// Add replaced image's classes to the new SVG
				if(typeof imgClass !== 'undefined') {
					$svg = $svg.attr('class', imgClass+' replaced-svg');
				}

				// Remove any invalid XML tags as per http://validator.w3.org
				$svg = $svg.removeAttr('xmlns:a');

				// Replace image with new SVG
				$img.replaceWith($svg);

			}, 'xml');

		});
	}

	svgInner();

	//удаление пустых параграфов в услугах
	$('.completed-projects-slider__info').each(function () {
		var strInfo = $(this).find('p.description').text();

		if ( !strInfo.length ) {
			$(this).find('p.description').hide();
		}
	})



	if ( !$('#shopCart').length ) {

	}



});

//появление изображений на слайдерах после загрузки
jQuery(window).bind('load', function () {
	var hiddenBeforLoad = '.slider-main li, ' +
		'.preview-product-element, ' +
		'.certificates-element, ' +
		'.company-element, ' +
		'.main-first-image-slider-el, ' +
		'.projects-card-slider-pager-el, ' +
		'.projects-card-slider-el, ' +
		'.card-gallery-slider__el, ' +
		'.wrap-menu, ' +
		'.slider-sale ';
	$(hiddenBeforLoad).css({'opacity': '1'})
});


//определение максимальной высоты
$.fn.setMaxHeights = function () {
	var maxHeight = this.map(function (i, e) {
		return $(e).height();
	}).get();

	return this.height(Math.max.apply(this, maxHeight));
};


//Промотать до верха по клику на логотип скролменю на главной
$(document).on('click', '.logo_scroll_toup', function () {
	$('html, body').animate({scrollTop: 0}, 500);
});

//Added Rising13 25.08.2017
$(document).ready(function () {
	$('body').on('click', 'a[href="#callback"]', function () {
		var form_name = $(this).data('form-name');
		if(form_name!='' && form_name!=undefined){
			$('#callback h2').html(form_name);
		}
	});
});