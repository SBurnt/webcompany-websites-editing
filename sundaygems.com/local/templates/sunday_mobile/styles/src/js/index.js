import './util/modernizr'; // for sticky footer with flex in ie10
import Tabs from './Tabs';
import Popup from './Popup';
import Inputs from './Inputs.js';
import MaskedInput from './MaskedInput';
import initTabs from './future-group-tabs';
import "slick-carousel";
import Swiper from "swiper";
import Vue from 'vue';

// Вкладки
(() => {
	initTabs('.tabs');
	initTabs({
		selector: '.works-tabs',
		blockClassName: 'works-tabs'
	});
})();

// side-menu
// (() => {
// 	const canvas = $('.canvas');
// 	const slide = $('.js-slide');
// 	const sideButton = $('.js-side-toggle');

// 	sideButton.click((e) => {
// 		if(canvas.hasClass('slide')) {
// 			closeSlide(e);
// 			return;
// 		}
// 		slide.toggleClass('slide');
// 		$('html, body').toggleClass('overflow');
// 		setTimeout(() => {canvas.get(0).addEventListener('click', closeSlide)}, 100);
// 	});

// 	function closeSlide(e) {
// 		e.preventDefault();
// 		slide.removeClass('slide');
// 		$('html, body').removeClass('overflow');
// 		canvas.get(0).removeEventListener('click', closeSlide);
// 	}
// })();


// input[type="file"], custom selector, input fucus class
new Inputs();

// tabs
(() => {
	for(let container of document.querySelectorAll('.js-tabs')) {
		
		container.tabs = new Tabs({
			container,
			toggles: container.querySelectorAll('.js-tabs-toggle'),
			tabs: container.querySelectorAll('.js-tabs-tab'),
		});

	}
})();

// input mask
MaskedInput(
	'.js-inputmask-phone input',
	['+', '7', ' ', '(', /\d/, /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, ' ', /\d/, /\d/, '-', /\d/, /\d/],
	'+7 (___) ___ __-__',
	'+7 ('
	);

// popup
$('.js-popup').each(function () {
	this.popup = new Popup(this, {}, () => {});
});

// slider
$('.js-slider').slick({
	dots: true,
	infinite: true,
	speed: 300,
	cssEase: 'linear',
	autoplay: false,
	autoplaySpeed: 5000,
	arrows: false,
	waitForAnimate: false,
	touchThreshold: 20
});

// slider detail pruduct
$('.js-slider--detail').slick({
	dots: true,
	infinite: true,
	speed: 300,
	cssEase: 'linear',
	autoplay: false,
	autoplaySpeed: 5000,
	arrows: false,
	centerMode: true,
	centerPadding: '20px',
	waitForAnimate: false,
	touchThreshold: 20
});

// accordion
(() => {
	var first = $('.js-accordion').children('.js-accordion-item').first();
	if (! first.hasClass('js-filter')) {
		first.addClass('active');
	}
	$('.js-accordion-toggle').click(function(e) {
		e.preventDefault();
		var	item = $(this).closest('.js-accordion-item'),
			content = item.children('.js-accordion-content');
		content.slideToggle(350);
		item.toggleClass('active');
	});
})();
// count product for cart
$('.js-count-button').click(function(e) {
	let countText = $(this).siblings(".js-count-text"),
		countValue = countText.text(),
		maxValue = countText.data('max'),
		countInput = $(this).closest('.js-count').find('.js-count-input input');
		console.log(countInput);
	if($(this).data('value') == '+') {
		if (countValue < maxValue) {
            countValue++;
		} else {
			return;
		}
	} else {
		if (countValue > 1) {
			countValue--;
		} else {
			return;
		}
	}

	countText.text(countValue);
	countInput.val(countValue);

	let url = "/ajax/basket_quantity.php",
	 	id = $(this).data('id');
	$.get(url, {
		id: id,
		q: countValue
	});

	let item_price = countText.data('price'),
		sum = $('.js-all-price');
	if ($(this).data('value') == '-')
		item_price = -item_price;
	let new_sum = +(sum.data('sum')) + item_price;
	sum.text("Итого: " + new_sum + " руб.");
	sum.data('sum', new_sum);
});


//calculator
(() => {
	// let props_slider = $('.js-slider-select');
    // props_slider.slick({
    //     infinite: false,
    //     speed: 300,
    //     cssEase: 'linear',
    //     arrows: false,
    //     vertical: true,
    //     verticalSwiping: true,
    //     waitForAnimate: false,
    //     centerMode: true,
    //     centerPadding: '22px',
    //     slidesToScroll: 2,
    // });
    // props_slider.on('swipe', function(event, slick, direction){
    //     let props = getProps();
    //     calc(props['carat'], props['form'], props['color'], props['quality']);
    // });

    // let slider = $('.js-slider-rap'),
    // 	slide = slider.data('slide');
    // slider.slick({
    //     infinite: false,
    //     speed: 300,
    //     cssEase: 'linear',
    //     arrows: false,
    //     vertical: true,
    //     verticalSwiping: true,
    //     waitForAnimate: false,
    //     centerMode: true,
    //     centerPadding: '22px',
    //     slidesToScroll: 2,
    //     initialSlide: slide
    // });
    // slider.on('swipe', function(event, slick, direction){
    //     let props = getProps();
    //     calc(props['carat'], props['form'], props['color'], props['quality']);
    // });
	let slider = '.js-slider-rap';

	let rapSwiper;
	let rapSlide = $(slider).data('slide');

	if ($(slider).length > 0) {
         rapSwiper = Swiper(slider, {
            initialSlide: rapSlide,
            direction: 'vertical',
            scrollbarHide: true,
            slidesPerView: '3',
            centeredSlides: true,
			freeModeSticky: true,
            freeMode: true,
        });

        rapSwiper.on('transitionEnd', function () {
            window.Calc.putFocus('carat');
            let props = getProps();
            for (let prop in props)
                window.Calc.setProp(prop, props[prop]);
            window.Calc.calc();
        });
        rapSwiper.on('touchEnd', function () {
            window.Calc.putFocus('carat');
            let props = getProps();
            for (let prop in props)
                window.Calc.setProp(prop, props[prop]);
            window.Calc.calc();
        });

        window.rapSwiper = rapSwiper;
    }

    let props_slider = '.js-slider-select';
	let swiper = [];
    if ($(props_slider).length > 0) {
        $(props_slider).each(function (index) {
            swiper[index] = Swiper($(this)[0], {
                direction: 'vertical',
                scrollbarHide: true,
                slidesPerView: '3',
                centeredSlides: true,
                freeMode: true,
                speed: 100,
            });

            swiper[index].on('transitionEnd', function () {
            	window.Calc.putFocus('carat');
                let props = getProps();
                for (let prop in props)
                	window.Calc.setProp(prop, props[prop]);
                window.Calc.calc();
            });
            swiper[index].on('touchEnd', function () {
                window.Calc.putFocus('carat');
                let props = getProps();
                for (let prop in props)
                    window.Calc.setProp(prop, props[prop]);
                window.Calc.calc();
            });
        });
    }

    $('.js-calc-clear').click(() => {
    	clearSliders();
	});

    // let input_val = $('.js-keyboard-input-text');
    //
    // $('.js-keyboard button').click(function() {
    //     let	buttonValue = $(this).data('value'),
    //         input = $('.js-keyboard-input input'),
    //         inputText = input_val,
    //         inputValue = input.val();
		// switch (buttonValue) {
		// 	case 'del':
    //             inputValue = inputValue.substring(0, inputValue.length - 1);
    //             break;
		// 	case 'compare':
		// 		let curr = $('.js-calc-item[data-status="current"]');
		// 		let num = curr.data('num');
    //             curr.attr('data-status', num);
		// 		num++;
		// 		curr.addClass("panel-light-gray");
		// 		let new_block = `<div class="col-12 panel-bordered js-calc-item" data-status="current" data-num="`+ num +`">
		// 			<div class="row">
		// 				<div class="col-l-6 panel-bordered__item">
		// 					<div class="text-small-caps">Товар ` + num + `</div>
		// 					<h1 class="mt0 text-regular js-calc-price" data-price="0">$0</h1>
		// 				</div>
		// 				<div class="col-l-6 panel-bordered__item">
		// 					<div class="text-small-caps">Итого</div>
		// 					<h1 class="mt0 text-regular js-calc-res">$0</h1>
		// 				</div>
		// 			</div>
    //     		</div>`;
		// 		$('.js-calc-items').prepend(new_block);
    //             inputValue = '';
		// 		break;
		// 	case 'clear':
    //             let block = `<div class="col-12 panel-bordered js-calc-item" data-status="current" data-num="1">
		// 			<div class="row">
		// 				<div class="col-l-6 panel-bordered__item">
		// 					<div class="text-small-caps">Товар 1</div>
		// 					<h1 class="mt0 text-regular js-calc-price" data-price="0">$0</h1>
		// 				</div>
		// 				<div class="col-l-6 panel-bordered__item">
		// 					<div class="text-small-caps">Итого</div>
		// 					<h1 class="mt0 text-regular js-calc-res">$0</h1>
		// 				</div>
		// 			</div>
    //     		</div>`;
    //             $('.js-calc-items').html(block);
    //             inputValue = '';
    //             rapSwiper.slideTo(rapSlide);
    //             swiper.forEach(function (item) {
		// 			item.slideTo(0)
    //             });
		// 		break;
		// 	case ',':
		// 		if (inputValue === '')
		// 			break;
		// 		if (inputValue.indexOf(',') !== -1)
		// 			break;
    //             inputValue +=  buttonValue;
		// 		break;
		// 	default:
    //             inputValue +=  buttonValue;
		// }
    //
    //     input.val(inputValue);
		// // let text = (inputValue === '') ? '0' : inputValue;
    //     inputText.text(inputValue);
    //
    //     let curr_item = $('.js-calc-item[data-status="current"]'),
		// 	price_block = curr_item.find('.js-calc-price'),
    //     	res_block = curr_item.find('.js-calc-res');
    //
    //     if (inputValue === '' || inputValue === '0') {
    //     	$(price_block).data('price', 0);
    //     	$(price_block).text("$" + 0);
    //         $(res_block).text("$" + 0);
		// } else {
    //     	let props = getProps();
		// 	calc(props['carat'], props['form'], props['color'], props['quality']);
		// }
    //
    // });
    //
    // function calc(carat, form, color, quality) {
    // 	// old method with request to server for get price
    // 	// let url = '/ajax/calc_get_price.php';
    // 	// $.post(url, {carat, form, color, quality})
		// 	// .done(data => {
    //      //        let curr = $('.js-calc-item[data-status="current"]'),
    //      //            price_block = curr.find('.js-calc-price'),
    //      //            percent = $('.js-calc-rap .slick-current input').val(),
    //      //            res_block = curr.find('.js-calc-res');
		// 	// 	if (data.status) {
    //      //            price_block.data('price', data.price);
    //      //            price_block.text("$" + data.price);
		// 	// 		let sum = +(data.price) + (data.price/100 * percent);
    //      //            res_block.text("$" + sum);
    //      //        } else {
    //      //            price_block.data('price', 0);
    //      //            price_block.text("$0");
    //      //            res_block.text("$0");
		// 	// 	}
		// 	// });
		// // new method for get price on client side
		// carat = carat.replace(',', '.');
		// let carat_num = +(carat);
    //     if (carat_num < 0.3) {
    //     	carat = "0";
		// } else if (carat_num <= 0.39) {
    //     	carat = "3_39";
    //     } else if (carat_num <= 0.49) {
    //     	carat = "4_49"
    //     } else if (carat_num <= 0.69) {
    //     	carat = "5_69";
    //     } else {
    //     	carat = 0;
    //     }
    //
	 //   let curr = $('.js-calc-item[data-status="current"]'),
		//    price_block = curr.find('.js-calc-price'),
		//    percent = $('.js-calc-rap .swiper-slide-active input').val(),
		//    res_block = curr.find('.js-calc-res');
	 //   let price = false;
		// $('.js-price-item').each(function () {
		// 	let item_carat = $(this).data('carat'),
    //             item_color = $(this).data('color'),
    //             item_form = $(this).data('form'),
    //             item_quality = $(this).data('qual');
    //
		// 	if (item_carat === carat
		// 		&& item_color === color
		// 		&& item_form === form
		// 		&& item_quality === quality
		// 	) {
		// 		price = $(this).data('price');
		// 	}
    //     });
		// if (price) {
		// 	price = +(price) + (price/100 * percent);
		//    	price_block.data('price', price);
		//    	price_block.html("$<span contenteditable='true'>" + price_new + '</span>');
		//    	let sum = Math.round(price * carat_num);
		//    	res_block.html("$<span class='js-sum-span'>" + sum + '</span>');
		//    	$('.js-sum-span').click(function () {
		// 	   $('.fake-input-pulse').removeClass('fake-input-pulse')
		// 	   $(this).addClass('fake-input-pulse')
    //        	})
	 //   } else {
		//    price_block.data('price', 0);
		//    price_block.text("$0");
		//    res_block.text("$0");
		// }
    // }
    //
    function getProps() {
        let props = [];
        $('.js-calc-props').each(function(i, item) {
            let prop = $(item).data('prop'),
                mark = $(item).data('alone');
            let val = 'nothing';
            if (mark === 'Y') {
                val = $(item).find('h1').data('id');
            } else {
                val = $(item).find('.swiper-slide-active input').val()
            }
            props[prop] = val;
        });
        props['rap'] = $('.js-slider-rap .swiper-slide-active input').val();
        return props
    }

    function clearSliders() {
		rapSwiper.slideTo(rapSlide);
		swiper.forEach(function (item) {
		item.slideTo(0)
		});
	}

})();

// personal agreement
(() => {
	$('.js-personal-agreement').click(function () {
		let input = $(this).find('input');
		if (input.prop('checked') == true) {
            input.val("N");
            input.prop('checked', false)
        } else {
            input.val("Y");
            input.prop('checked', true)
        }
    });
})();

//load more
(() => {
    $(".js-more-btn").click(function (e) {
        e.preventDefault();
        let page = $(this).data('page');
        let endPage = $(this).data('endpage');
        let url = $(this).data('href') + page;
        $('.pagination').hide();

        $.ajax({
            url: url,
            type: 'GET'
        }).done((data) => {
            let elems = $(data).find('.js-more-container');
            console.log(elems)
            $('.js-more-container').append(elems.html());
            activateAdd2basket();
        });

        page++;
        if (page > endPage)
            $(this).hide();
        else
            $(this).data('page', page);

        return false;
    });
})();

//add2basket
function activateAdd2basket() {
    $('.js-add2basket').click(function() {
        let id = $(this).data('id');
        $.get('/ajax/add2basket.php?id=' + id);
    });
}
activateAdd2basket();

// vue component for calc
// let arRes;
// $.get('/eshop_app/calc/?json=y', res => {
//     console.log(res);

    // let calculator = Vue.component('calculator', {
    //     data() {
    //         return {
    //             items: res.ITEMS,
    //             focusProps: {
    //                 carat: {
    //                     text: '',
    //                     classing: {
    //                         fakeInputPulse: false
    //                     }
    //                 },
    //                 sum: {
    //                     text: 0,
    //                     classing: {
    //                         fakeInputPulse: false
    //                     }
    //                 },
    //             },
    //             carat: {
    //                 text: '',
    //                 classing: {
    //                     fakeInputPulse: false
    //                 }
    //             },
    //             focus: 'carat',
    //             props: {
    //                 color: res.HL.colors.items[0].UF_XML_ID,
    //                 form: res.HL.form.items[0].UF_XML_ID,
    //                 quality: res.HL.quantity.items[0].UF_XML_ID,
    //                 rap: 0
    //             },
    //             prices: [{
    //                 classing: {
    //                     "panel-light-gray": false
    //                 },
    //                 price: 0,
    //                 sum: 0,
    //                 fixedPrice: 0,
    //                 sumClass: {
    //                     fakeInputPulse: false
    //                 }
    //             }],
    //         }
    //     },
    //     methods: {
    //         putFocus: function (name) {
    //             if (name === 'sum' && this.focusProps.sum.text == '0')
    //                 return;
    //             this.focus = name;
    //             this.activateFocus();
    //         },
    //         activateFocus: function () {
    //             for (let prop in this.focusProps)
    //                 this.focusProps[prop].classing.fakeInputPulse = false;
    //             this.focusProps[this.focus].classing.fakeInputPulse = true;
    //             this.activateProps()
    //         },
    //         btnNum: function (val) {
    //             this.focusProps[this.focus].text += '' + val;
    //             this.activateProps()
    //             this.calc()
    //         },
    //         btnComma: function () {
    //             var curr = this.focusProps[this.focus].text;
    //             var comma = ',';
    //
    //             if (curr.length < 1)
    //                 curr = '0' + comma;
    //             if (curr.indexOf(',') !== -1)
    //                 comma = '';
    //             curr += comma;
    //
    //             this.focusProps[this.focus].text = curr;
    //             this.activateProps()
    //             this.calc()
    //         },
    //         del: function () {
    //             var curr = this.focusProps[this.focus].text + '';
    //             if (curr === '0,') {
    //                 this.focusProps[this.focus].text = '';
    //             } else {
    //                 this.focusProps[this.focus].text = curr.substring(0, curr.length - 1);
    //             }
    //             this.activateProps();
    //             this.calc()
    //         },
    //         calc: function () {
    //             if (this.focus === 'carat')
    //                 this.calcCaratPrice();
    //             else
    //                 this.calcRapPrice();
    //         },
    //         calcCaratPrice: function() {
    //             var carat = this.focusProps.carat.text;
    //             carat = carat.replace(',', '.');
    //             var carat_num = +(carat);
    //             if (carat_num < 0.3) {
    //                 carat = "0";
    //             } else if (carat_num <= 0.39) {
    //                 carat = "3_39";
    //             } else if (carat_num <= 0.49) {
    //                 carat = "4_49"
    //             } else if (carat_num <= 0.69) {
    //                 carat = "5_69";
    //             } else {
    //                 carat = 0;
    //             }
    //             var price = 0;
    //             for (var index in this.items) {
    //                 var curr_item = this.items[index];
    //                 if (curr_item.carat == carat
    //                     &&
    //                     curr_item.color == this.props.color
    //                     &&
    //                     curr_item.form == this.props.form
    //                     &&
    //                     curr_item.quality == this.props.quality
    //                 ) {
    //                     price = curr_item.price;
    //                 }
    //             }
    //             this.prices[0].fixedPrice = price;
    //             var percent = this.props.rap;
    //             if (price) {
    //                 this.prices[0].price = Math.round(+(price) + (price/100 * percent));
    //                 this.prices[0].sum = Math.round(this.prices[0].price * carat_num);
    //             } else {
    //                 this.prices[0].price = 0;
    //                 this.prices[0].sum = 0;
    //             }
    //             this.focusProps.sum.text = this.prices[0].sum;
    //         },
    //         calcRapPrice: function () {
    //             var carat = this.focusProps.carat.text;
    //             carat = carat.replace(',', '.');
    //
    //             var carat_num = +(carat);
    //             var price = this.prices[0].fixedPrice;
    //             var sum = this.focusProps.sum.text;
    //             var old_sum = Math.round(this.prices[0].fixedPrice * carat_num);
    //
    //             var percent = sum / old_sum * 100;
    //             if (isNaN(percent))
    //                 this.prices[0].price = 0;
    //             else
    //                 this.prices[0].price = Math.round(price / 100 * percent);
    //         },
    //         compare: function () {
    //             this.prices[0].classing['panel-light-gray'] = true;
    //             this.prices[0].sumClass.fakeInputPulse = false;
    //             this.prices.unshift({
    //                 classing: {
    //                     "panel-light-gray": false
    //                 },
    //                 price: 0,
    //                 sum:0,
    //                 sumClass: {
    //                     fakeInputPulse: false
    //                 }
    //             });
    //             this.calc()
    //         },
    //         clear: function () {
    //             this.focusProps.carat.text = '';
    //             this.focusProps.sum.text = 0;
    //             this.prices = [{
    //                 classing: {
    //                     "panel-light-gray": false
    //                 },
    //                 price: 0,
    //                 sum:0,
    //                 sumClass: {
    //                     fakeInputPulse: false
    //                 }
    //             }];
    //             this.activateProps()
    //         },
    //         setProp: function(name, val) {
    //             this.props[name] = val;
    //         },
    //         activateProps : function () {
    //             this.carat.text = this.focusProps.carat.text;
    //             this.carat.classing.fakeInputPulse = this.focusProps.carat.classing.fakeInputPulse;
    //             this.prices[0].sum = this.focusProps.sum.text;
    //             this.prices[0].sumClass.fakeInputPulse = this.focusProps.sum.classing.fakeInputPulse;
    //         }
    //     },
    //
    //     mounted() {
    //         this.activateProps()
    //         this.activateFocus()
    //     }
    // });
    //
    // const app = new Vue({
    //     el: '#app',
    // })

    // calculator .activateFocus()

    // window.Calc = calculator ;
// });
