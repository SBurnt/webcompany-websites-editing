$(document).ready(function(){
	$('.text-about-btn.web_show_more').click(function(){
		$('.text-about-btn.web_show_more').toggleClass('active');
		$('.txt-about').toggleClass('active');
		if($('.text-about-btn.web_show_more').hasClass('active')) {
			$('.text-about-btn.web_show_more span').html('Скрыть');
		}else {
			$('.text-about-btn.web_show_more span').html('Показать больше');
		}
	});

  $('.checkout-block .ways-nav').click(function(){
    var el = $('.checkout-block.ways-block'),
    curHeight = el.height(),
    autoHeight = el.css('height', 'auto').height();
    el.height(curHeight).animate({height: autoHeight}, 500);
    $('.checkout-block.ways-block').addClass('opened');
  });

	$('.catalog-new__drop-btn').click(function(){
		$(this).siblings('.catalog-new__drop-list').slideToggle();
	});

	$('.form__wrap input').focus(function(){
		console.log($(this).length);
		$(this).siblings('label').css('display', 'none');
	})
	$('.form__wrap input').blur(function(){
		if($(this).val() === ''){
			$(this).siblings('label').css('display', 'inline-block');
		}
	})
  $('.checkout-block .payment-nav').click(function(){
    var el2 = $('.checkout-block.payment-element'),
    curHeight2 = el2.height(),
    autoHeight2 = el2.css('height', 'auto').height();
    el2.height(curHeight2).animate({height: autoHeight2}, 500);
    $('checkout-block.payment-element').addClass('opened');
  });

  $('.checkout-block .customer-nav').click(function(){
    var el3 = $('.checkout-block.customer-block'),
    curHeight3 = el3.height(),
    autoHeight3 = el3.css('height', 'auto').height();
    el3.height(curHeight3).animate({height: autoHeight3+100}, 500);
    $('.checkout-block.customer-block').addClass('opened');
  });
	$('input[type="radio"]').click(function(){
		if($('#ID_DELIVERY_ID_5').is(':checked')) {
			var el4 = $('.checkout-block.pickup-block'),
	    curHeight4 = el4.height(),
	    autoHeight4 = el4.css('height', 'auto').height();
	    el4.height(curHeight4).animate({height: autoHeight4}, 500);
	    $('.checkout-block.pickup-block').addClass('opened');
    } else {
			var el4 = $('.checkout-block.pickup-block'),
	    curHeight4 = el4.height(),
	    autoHeight4 = el4.css('height', '0').height();
	    el4.height(curHeight4).animate({height: autoHeight4}, 500);
	    $('.checkout-block.pickup-block').removeClass('opened');
		}
	})
  $('.checkout-block .pickup-nav').click(function(){


  });

  $('.physical-nav').click(function(){
    //$('.checkout-block .checkout-buttons.juridical').removeClass('opened');
    $('.checkout-block .checkout-buttons.juridical').removeClass('active');
    $('.checkout-block .checkout-buttons.physical').addClass('active');
var el2 = $('.checkout-block.payment-element'),
    curHeight2 = el2.height(),
    autoHeight2 = el2.css('height', 'auto').height();
    el2.height(curHeight2).animate({height: autoHeight2}, 500);
  });

  $('.juridical-nav').click(function(){
      //$('.checkout-block .checkout-buttons.juridical').removeClass('opened');
      $('.checkout-block .checkout-buttons.physical').removeClass('active');
      $('.checkout-block .checkout-buttons.juridical').addClass('active');
   var el2 = $('.checkout-block.payment-element'),
    curHeight2 = el2.height(),
    autoHeight2 = el2.css('height', 'auto').height();
    el2.height(curHeight2).animate({height: autoHeight2}, 500);
   // $('.customer-block').addClass('active');
  });

  // $('.current__max').click(function(){
  //   $(this).closest('.current').find('.current__num').html(function(i, val) { return val*1+1 });
  // });

  // $('.current__min').click(function(){
  //   $(this).closest('.current').find('.current__num').html(function(i, val) { return val*1-1});
  // });


  $('.header__mob-item').click(function(){
    $('.header__mob-item .hover-block').toggleClass('active');
  });

  // $('.basket a').click(function(){
  //   $('.basket__open').toggleClass('active-element');
  // });

  $('.nav .basket a').click(function(){
    if($(window).width()<=767) {
      $('.nav .basket__open').toggleClass('active-element');
   //           $('.nav .basket__open').removeClass('active');
    }
  });
      $(document).click(function(){
    if($(window).width()<=767) {
        
      $('.nav .basket__open').removeClass('active-element');
    }
  });

    
  // if($(window).width()<=767) {
  //       $('.nav .basket').click(function(){
  //         $('.nav .basket__open').toggleClass('active-element');
  //         $('.nav .basket__open').removeClass('active');
  //       });
  //   }
  //   $(window).resize(function() {
  //       if($(window).width()<=767) {
  //           $('.nav .basket').click(function(){
  //             $('.nav .basket__open').toggleClass('active-element');
  //             $('.nav .basket__open').removeClass('active');
  //           });
  //       }
  //   }
  //   );


  // var total = 2; // - РєРѕР»РёС‡РµСЃС‚РІРѕ РѕС‚РѕР±СЂР°Р¶Р°РµРјС‹С… РЅРѕРІРѕСЃС‚РµР№
  // // hidenews = "- СЃРєСЂС‹С‚СЊ СЃС‚Р°СЂС‹Рµ РЅРѕРІРѕСЃС‚Рё";
  // // shownews = "+ РїРѕРєР°Р·Р°С‚СЊ РІСЃРµ РЅРѕРІРѕСЃС‚Рё";

  // if( $(".checkbox-block .md-checkbox:eq("+total+")").is(":hidden") )
  //   {
  //     $(".show_dropdown").show();
  //     $(".checkbox-block").hide();
  //   }
  //   else
  //   {
  //     $(".show_dropdown").hide();
  //     $(".checkbox-block").show();
  //   }
  //   $('.order .order__table tbody .div .show_dropdown').click(function(){
  //     $('.checkbox-block').slideToggle();
  //     $(this).toggleClass('active');
  //     if($('.order .order__table tbody .div .show_dropdown').hasClass('active')) {
  //       $('.order .order__table tbody .div .show_dropdown').html('РЎРєСЂС‹С‚СЊ');
  //     }else {
  //       $('.order .order__table tbody .div .show_dropdown').html('Р Р°Р·РІРµСЂРЅСѓС‚СЊ');
  //     }
  //   });

});



$(document).on('click', '.dropdown.multiple li', function(e){
  $(this).toggleClass('active');
  var attr = $(this).attr('data-value');
  if($(this).hasClass('active')) {
    $('<span></span>').appendTo('.dropdown-tags').attr('data-value', attr).html(attr + '<a class="remove" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 21.9 21.9" enable-background="new 0 0 21.9 21.9" class="svg replaced-svg"> <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0 c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4 s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3 s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7 s-0.1-0.5-0.3-0.7L14.1,11.3z"></path> </svg></a>');
  } else {
    $(".dropdown-tags span[data-value='"+attr+"']").remove();
  }
  // $('.dropdown-tags .remove').click(function(){
  //   $(this).closest('span').remove();
  //   var attr2 = $(this).closest('span').attr('data-value');
  //   $(".dropdown.multiple .dropdown-list li[data-value='"+attr2+"']").removeClass('active');
  // });
  e.stopImmediatePropagation();
  e.preventDefault();
  e.stopPropagation();
  return false;
});

$(document).on('click','.dropdown-tags .remove',function () {
  $(this).closest('span').remove();
    var span_attr = $(this).closest('span').attr('data-value');
    $(".dropdown.multiple .dropdown-list li[data-value='"+span_attr+"']").removeClass('active');
});


$(document).on('ready', function(){
    var loading = false;
    $(window).scroll(function() {
        if ($('#infinity-next-page').size() && !loading) {
            if ($(window).scrollTop()+1500 >= $(document).height()-$(window).height()) {
                loading = true;
                $.get($('#infinity-next-page').attr('href'), {is_ajax: 'y'}, function(data){
                  //  $('.txt1').remove();
                    $('.accordion__prev').remove();
                 //   
                    // $('.cat__text').remove();
                    $('#infinity-next-page').after(data);
                    $('#infinity-next-page').remove();
                    $('#docks').remove();
                   // $('.cat__text').remove();
                  //  $('.sort__controls').remove();
                  //  $('.shop').remove();
                    loading = false;
                });
            }
        }
    });
});
