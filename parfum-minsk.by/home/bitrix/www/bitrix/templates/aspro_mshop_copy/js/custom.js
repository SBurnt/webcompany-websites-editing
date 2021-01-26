/*
 You can use this file with your scripts.
 It will not be overwritten when you upgrade solution.
 */
$(document).ready(function () {
    //$('.cat_menu a[href="/catalog/jil-sander/"]:eq(0)').remove();
    $('.cat_desc_more').click(function () {
        $('.description_block_custom').css({'height': '100%'});
    });

//описание в каталоге
    $('.show-more-description').on('click', function (e) {
        e.preventDefault();
        $(this).toggleClass('active').prev('.full-text').toggleClass('full');

        if ($(this).hasClass('active')) {
            $(this).text($(this).data('to-short'));
        } else {
            $(this).text($(this).data('to-full'));
        }
    });

//делаем непрозрачной кнопку "под закаказ" в карточке товара
    $('.prices_tab .buy .to-order').removeClass('transparent');

    $(window).bind('load', function () {
        var hiddenBeforLoad = '.prices_tab .buy .to-order';
        $(hiddenBeforLoad).css({'opacity': '1'})
    });

function sliceBYN () {
	var text = "бел.руб.";
	var price = $(".prices_tab .cost.prices .price:not(.discount)");
	console.log( price.length );

	if ( price.length !== 0 ) {
		console.log( 2 );
		price.each(function(){
			console.log( 3 );
			var resultText = $(this).text().replace(text, "");	

			$(this).text( resultText );
			$(this).append("<span class='accent-price-text'>" + text + "</span>");
		} );
	}
}
sliceBYN();


var cardDescr = $(".item_wrap .description .preview_text");
cardDescr.height(74);
var textBefore = $(".item_wrap .description .show-full-descr").eq(1).text();
var textAfter = "Скрыть описание";


$('.item_wrap .description .show-full-descr').on('click', function (e) {
  e.preventDefault();
  $(this).toggleClass('active').prev('.preview_text').toggleClass('full');

  if ( !!$(this).hasClass("active") ) {
    $(this).text(textAfter);
  } else {
    $(this).text(textBefore);
  }
});






});



