$(document).ready(function(){

    $('body').on('submit', 'form[name=feedback]', function(){
        $.ajax({
            type: "POST",
            url: "/ajax/feedback.php",
            data: $(this).serialize(),
            success: function(msg){
                if(msg['OK'] == 'Y'){
                    $('form[name=feedback]').find('button').remove();
                    $('form[name=feedback]').append(msg['MESS']);
                }
            }
        });
        return false;
    });

    $('body').on('submit', '#form--modal-1', function(){
        if($('input[name=type_user]').val() == '2')
        {
            $.ajax({
                type: "POST",
                url: "/ajax/save_ur_profile.php",
                data: {
                    fio: $('input[name=fio]').val(),
                    org: $('input[name=org]').val(),
                    ur: $('input[name=ur]').val(),
                    unp: $('input[name=unp]').val(),
                    bank: $('input[name=bank]').val(),
                    contact: $('input[name=contact]').val(),
                    email: $('input[name=email]').val(),
                    phone: $('input[name=phone]').val(),
                },
                success: function(msg){
                    if(msg['OK'] == 'Y'){
                        window.location.href = '/personal/';
                        $('#form--modal-1').append('<span>'+$msg['MESS']+'</span>');
                    }
                    else
                    {

                    }
                }
            });
        }
        else
        {
            $.ajax({
                type: "POST",
                url: "/ajax/save_profile.php",
                data: {
                    fio: $('input[name=fio]').val(),
                    email: $('input[name=email]').val(),
                    phone: $('input[name=phone]').val(),
                },
                success: function(msg){
                    if(msg['OK'] == 'Y'){
                        window.location.href = '/personal/';
                        $('#form--modal-1').append('<span>'+$msg['MESS']+'</span>');
                    }
                    else
                    {

                    }
                }
            });
        }


        return false;
    });

    $('body').on('submit', 'form[name=change_password]', function(){
        $.ajax({
            type: "POST",
            url: "/ajax/change_password.php",
            data: $(this).serialize(),
            success: function(msg){
                if(msg['OK'] == 'Y'){
                    $('div.mess').empty().append('<p style="color: green;">Ваш пароль изменен</p>');
                }
                else
                {
                    $('div.mess').empty().append('<p style="color: red;">Ошибка. '+msg['ERROR']+'</p>');
                }
            }
        });
        return false;
    });


    $('body').on('click', '#mark li', function(){
        $.ajax({
            type: "POST",
            url: "/ajax/get_models.php",
            data: {
                mark: $(this).data('id'),
            },
            success: function(msg){
                $('#model').empty().append(msg);
            }
        });
        return false;
    });

    $('body').on('submit', '#form--modal-3', function(){
        $.ajax({
            type: "POST",
            url: "/ajax/save_delivery_address.php",
            data: {
                delivery_address: $('input[name=delivery_address]').val(),
            },
            success: function(msg){
                if(msg['OK'] == 'Y'){
                    window.location.href = '/personal/';
                }
                else
                {

                }
            }
        });
        return false;
    });

    $('body').on('change', '#check-3', function(){
        $.ajax({
            type: "POST",
            url: "/ajax/save_email_send.php",
            data: {
                send: $(this).prop('checked'),
            },
        });
        return false;
    });


    $('body').on('change', '#check-2', function(){
        $.ajax({
            type: "POST",
            url: "/ajax/save_sms_send.php",
            data: {
                send: $(this).prop('checked'),
            },
        });
        return false;
    });

    $('.btn-login').click(function(){
        $('#login-modal').show();
    });

    $('body').on('click', '.voting-item.like', function(){
        var $IDProduct = $('#ID_PRODUCT').val();
        $.ajax({
            type: "POST",
            url: "/ajax/like.php",
            data: {
                like: 'Y',
                IDProduct: $IDProduct
            },
            success: function(msg){
                if(msg.LIKES >= 0 && msg.DIZ >= 0)
                {
                    $('.voting-item.like span').empty().append(msg.LIKES);
                    $('.voting-item.diz span').empty().append(msg.DIZ);
                }
            }
        });
        return false;
    });

    $('body').on('click', '.voting-item.diz', function(){
        var $IDProduct = $('#ID_PRODUCT').val();
        $.ajax({
            type: "POST",
            url: "/ajax/like.php",
            data: {
                like: 'N',
                IDProduct: $IDProduct
            },
            success: function(msg){
                if(msg.LIKES >= 0 && msg.DIZ >= 0)
                {
                    $('.voting-item.like span').empty().append(msg.LIKES);
                    $('.voting-item.diz span').empty().append(msg.DIZ);
                }
            }
        });
        return false;
    });
    $('body').on('click', '.review_like', function(e){
        e.preventDefault();
        var like = $(this).attr('data-like');
        var id = $(this).attr('data-review');
        $.ajax({
            type: "POST",
            url: "/ajax/like-review.php",
            data: {
                like: like,
                id: id
            },
            success: function(msg){
                console.log(msg);
                if(msg.LIKES >= 0 && msg.DIZ >= 0) {
                    $('.data_like'+id).empty().append(msg.LIKES);
                    $('.data_diz'+id).empty().append(msg.DIZ);
                }
            }
        });
        return false;
    });
});


function addBasket(idProd, kompl, idCart, delay){
    if(kompl){
        if(!idCart){
            var price_kom = document.getElementsByName('komplekt')[0].value;
            var price_kom_old = document.getElementsByName('komplekt_old')[0].value;
        }else{
            var price_kom = document.getElementsByName('komplekt'+idCart)[0].value;
            var price_kom_old = document.getElementsByName('komplekt_old'+idCart)[0].value;
        }
    }else{
        if(document.getElementsByName('NewPrice')[0]){
            var price = document.getElementsByName('NewPrice')[0].value;
            var id_nadbavka = document.getElementsByName('nadbavka_id')[0].value;
        }
    }
    $.ajax({
        type: "POST",
        url: "/ajax/addBasket.php",
        data: {ID: idProd,
            PRICE:price,
            idNadbavka: id_nadbavka,
            KOMPL: kompl,
            PRICE_KOM: price_kom,
            IDCART:idCart,
            DELAY: delay,
            PRICE_KOM_OLD: price_kom_old
        },
        success: function(data){
            if(idCart){
                location.reload();
            }else{
                if(!delay){
                    $('#avalaible-modal').show();
                }

            }
        }
    });
    $.ajax({
        type: "POST",
        url: "/ajax/uploadBasket.php",
        data: {width: screen.width},
        success: function(data){
            $('.basket__open').html(data);
        }
    });
}
function nadbavka(i,price, id, priceProd, oldPrice){
    if(!parseInt(i)){
        if (document.getElementById(i).checked){
            proc = '+';
            $('input[name=nadbavka_id]').val(id);
        }else{
            proc = '-';
            $('input[name=nadbavka_id]').val('');
        }
    }else{
        if(i==-1){
            proc = '-';
            $('input[name=nadbavka_id]').val('');
        }else{
            proc = '+';
            $('input[name=nadbavka_id]').val(id);
        }
    }
    $.ajax({
        type: "POST",
        url: "/ajax/nadbavka.php",
        data: {ID: id, PRICE: price, PRICEPROD: priceProd, PROC: proc, OLDPRICE: oldPrice},
        success: function(data){
            $('.price').html(data);
        }
    });
}
function clickRadio(el) {
    var siblings = document.querySelectorAll("input[type='radio'][name='" + el.name + "']");
    for (var i = 0; i < siblings.length; i++) {
        if (siblings[i] != el)
            siblings[i].defaultChecked = false;
    }
    if (el.defaultChecked)
        el.checked = false;
    el.defaultChecked = el.checked;
}
function Basketnad(i,price, priceProd, quantity, action, id, idProd) {
    if(!parseInt(i)){
        if (document.getElementById(i).checked){
            proc = '+';
        }else{
            proc = '-';
        }
    }else{
        if(i==-1){
            proc = '-';
        }else{
            proc = '+';
        }
    }
    let CURRENCY = document.getElementById(action+'_'+idProd).value;
    let deffer;
    if(document.querySelector('#deffer')){
        deffer = document.querySelector('#deffer').value;
    }

    $.ajax({
        type: "POST",
        url: "/ajax/basket.php",
        data: {PRICEPROD: priceProd, PRICE: price, QUANTITY: quantity, ACTION: action, PROC: proc, ID: id, IDPROD: idProd, DEFFER:deffer, CURRENCY: CURRENCY},
        success: function(data){
            $('.shop').html(data);
        }
    });
}

function basket(id, action){
    quantity = $('#basket-item-quantity-'+id).val();
    let deffer;
    let cupon;
    if(action == 'cupon'){
        cupon = document.getElementsByName('cupon')[0].value;
        console.log(cupon);
    }
    if(document.querySelector('#deffer')){
        deffer = document.querySelector('#deffer').value;
    }
    $.ajax({
        type: "POST",
        url: "/ajax/basket.php",
        data: {ID: id, ACTION: action, QUANTITY: quantity, DEFFER:deffer, CUPON: cupon},
        dataType: "html",
        success: function(data){
            $('.shop').html(data);
        }
    });
}
function deliveryID(id, price){
    $.ajax({
        type: "POST",
        url: "/ajax/delivery.php",
        data: {ID: id, PRICE: price},
        dataType: "html",
        success: function(data){
            $('.web-total-block').html(data);
        } 
    });
 
}
/*
  $.ajax({

        type: "POST",
    url: "/ajax/paySystem.php",

        data: {ID: id},	
        dataType: "html",
	
        success: function(data){

            $('.paySystem').html(data);

        }

    });*/
function li_input(a){
    a[0].click();
    $('.tag > li').click(function(){
        $(this).toggleClass('active');
        $(this).parents('.order').find('div.clear').addClass('active');
    });
}


$(function() {
    $('#home-slider-1').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        nav: true,
        smartSpeed: 1500,
        navText: [
            "<img class='svg' src='/local/templates/auto/img/icon/left-angle.svg' height='18'>",
            "<img class='svg' src='/local/templates/auto/img/icon/right-angle.svg' height='18'>"
        ],
        autoplayHoverPause: true
    });

    $("#home-slider-2").owlCarousel({
        margin: 30,
        nav: true,
        autoplay: true,
        loop: true,
        smartSpeed: 1000,
        navText:
            ["<img src='/local/templates/auto/img/pictures/slider-arrow-1.png'>",
                "<img src='/local/templates/auto/img/pictures/slider-arrow-1.png'>"],
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1024:{
                items:3
            }
        },
        autoplayHoverPause: true
    });

    var clock;
    clock = $('.clock').FlipClock({
        clockFace: 'DailyCounter',
        autoStart: false,
        callbacks: {
            stop: function() {
                $('.message').html('The clock has stopped!')
            }
        }
    });
    clock.setTime(220880);
    clock.setCountdown(true);
    clock.start();
});

$(function(){
    $('.profile__edit').click(function(){
        $(this).next('.modal-window').show();
    });
    $('.order.bd').click(function(){
        window.location.href = '/personal/cart/make/';
    });

    $('.check-ios').change(function(){
        $(this).parents('.profile__check--option').toggleClass('active');
    });

    $(".calendar").datepicker({
        dateFormat: 'd MM yy',
        firstDay: 1
    });

    $(document).on('click', '.date-picker .input', function(){
        $(this).parents('.date-picker').toggleClass('open');
    });

    $(".calendar").on("change",function(){
        var $me = $(this),
            $selected = $me.val(),
            $parent = $me.parents('.date-picker');
        $parent.find('.result').children('span').html($selected);
    });
    $('.defer_product').click(function(){
        if ($('.defer_product p').css('color') == 'rgb(128, 182, 214)')
        {
            $('.defer_product p').css('color', '#6a747c');
            // $('.defer_product svg').css('fill', '#6a747c');
            $('.defer_product svg').css('fill', 'transparent');
        }else{
            $('.defer_product p').css('color', '#80b6d6');
            $('.defer_product svg').css('fill', '#80b6d6');
        }
    });
});

$(function() {
    // $('.txt1 .all .toggler > button').click(function(){
    //     $(this).parent().toggleClass('active');
    //     $('.txt1 .all .txt-seo').slideToggle('slow');
    //     if ($(this).parent().hasClass('active')) {
    //         $(this).text('Cкрыть');
    //     } else {
    //         $(this).text('Показать больше');
    //     }
    // });

    $('.tag > li').click(function(){
        $(this).toggleClass('active');
        $(this).parents('.order').find('div.clear').addClass('active');
    });

    $('.order__block .clear').click(function(e) {
        e.stopPropagation();
        dropdownBtn = $(".cart .order__table .dropdown .dropdown-button");
        dropdownBtn.each(function(){
            $(this).text($(this).data('text')).removeClass('active close');
        })
        $(this).parent().next('.order__table').find("input[type=checkbox]").prop('checked', false);
        $( "#slider-range" ).slider({values: [0, 870]});
        $( "#amount-min" ).val($( "#slider-range" ).slider( "values", 0 ));
        $( "#amount-max" ).val($( "#slider-range" ).slider( "values", 1 ));
        $('.tag > li').removeClass('active');
        $(this).removeClass('active');
    });

    $('.order__table .dropdown-list > li').click(function(){
        $(this).parents('.order').find('div.clear').addClass('active');
    });

    $('.order__table input').change(function(){
        $(this).parents('.order').find('div.clear').addClass('active');
    });

    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 870,
        values: [ 0, 870 ],
        animate: true,
        step: 5,
        slide: function( event, ui ) {
            $( "#amount-min" ).val( ui.values[0]);
            $( "#amount-max" ).val( ui.values[1]);
            $(this).parents('.order').find('div.clear').addClass('active');
        }
    });

    $( "#amount-min" ).val($( "#slider-range" ).slider( "values", 0 ));
    $( "#amount-max" ).val($( "#slider-range" ).slider( "values", 1 ));

});

var clock;

$(document).ready(function() {
    var Data = document.getElementsByName('data');
    var clock;

    clock = $('.clock').FlipClock({
        clockFace: 'DailyCounter', //вид счетчика (с количеством дней)
        autoStart: false, //Отключаем автозапуск
        countdown: true, //Отсчет назад
        callbacks: { //Действие после окончания отсчета
            stop: function() {
                $('.message').html('Время вышло!');
            }
        }
    });


    var nowDate = Date.now() / 1000;
    if(Data[0]!=undefined){
        var time = Data[0].value - nowDate;
    }
    clock.setTime(time);
    clock.setCountdown(true);
    clock.start();

    $("#tabs").tabs();

    $('#tabs-1 .has-hint').hover(
        function(){
            $(this).next('.cloud').addClass('is-open');
        }, function(){
            $(this).next('.cloud').removeClass('is-open');
        }
    );

    // // scroll to tabs and open them
    // $('.item__list--link').click(function(e) {
    //     e.preventDefault();
    //     $($(this).data('tab')).trigger('click');
    //     $('html, body').animate({
    //         scrollTop: $($(this).data('target')).offset().top - 150
    //     }, 1000);
    // });

    // one click order
    // $('.oc-order').click(function(){
    //     $('#one-click-order').show();
    // });
    $('.review-btn').click(function(){
        $('#rewiew').show();
    });
    // $('.avalaible').click(function(){
    //     $('#avalaible-modal').show();
    // });
});
// if($("#map2").length>0){
//     ymaps.ready(init);
//     var myMap,
//         Placemarkmain;
//
//     function init(){
//         myMap = new ymaps.Map("map2", {
//             center: [53.932357, 27.562675],
//             zoom: 16,
//
//         },{
//             autoFitToViewport: 'always'
//         });
//         var zoomControl = new ymaps.control.ZoomControl({
//             options: {
//                 size: "small",
//                 position: {
//                     left: "auto",
//                     right: "40px",
//                     top: "150px"
//                 }
//             }
//         });
//         myMap.controls.remove(zoomControl);
//         myMap.controls.remove('geolocationControl');
//         myMap.controls.remove('searchControl');
//         myMap.controls.remove('trafficControl');
//         myMap.controls.remove('typeSelector');
//         myMap.controls.remove('fullscreenControl');
//         myMap.controls.remove('rulerControl');
//         myMap.controls.remove('zoomControl');
//         Placemarkmain = new ymaps.Placemark([53.932357, 27.562675], {}, {
//             hintContent: "Хинт метки",
//             iconLayout: 'default#image',
//             iconImageHref: '/local/templates/avto/img/pictures/map-marker.png',
//             iconImageSize: [22, 22],
//             iconImageOffset: [0, 0]
//         });
//         // maps__popup
//         myMap.geoObjects.add(Placemarkmain);
//         myMap.balloon.open([53.932357, 27.562675], '<div class=""> ' +
//             '<h4 class="rg">Хотите посмотреть товар в магазине?* Приезжайте к нам!</h4> ' +
//             '<div class="header main_flex flex__align-items_center flex__jcontent_between"> ' +
//             '<div class="header__address"> ' +
//             '<div class="header__address--icon main_flex__nowrap flex__align-items_center"> ' +
//             '<img class="svg icon" src="/local/templates/auto/img/icon/maps-and-flags.svg"> ' +
//             '<p class="rg">Минск, ул. Орловская, д. 17</p> ' +
//             '</div> ' +
//             '<div class="header__address--icon main_flex__nowrap flex__align-items_center"> ' +
//             '<img class="svg icon" src="/local/templates/auto/img/icon/wall-clock.svg"> ' +
//             '<p class="rg">' +
//             '<span class="rg">ПН-ПТ ..</span> 9:00 - 19:00</p> ' +
//             '</div> <p class="rg fx"><span class="rg">СБ ........</span> 10:00 - 16:00</p> ' +
//             '</div> ' +
//             '<div class="header__phones"> ' +
//             '<div class="header__address--icon main_flex__nowrap flex__align-items_center fx1"> ' +
//             '<img class="svg icon" src="/local/templates/auto/img/icon/phone-call.svg"> ' +
//             '<p class="rg"><span class="rg">+375 17</span> 210-17-76</p> ' +
//             '</div> ' +
//             '<div class="header__address--icon main_flex__nowrap flex__align-items_center fx1"> ' +
//             '<img class="svg icon" src="/local/templates/auto/img/icon/logo_velcom.svg"> ' +
//             '<p class="rg"><span class="rg">+375 29</span> 635-65-65</p> ' +
//             '</div> ' +
//             '<div class="header__address--icon main_flex__nowrap flex__align-items_center"> ' +
//             '<img class="svg icon" src="/local/templates/auto/img/icon/logo_mts.svg"> ' +
//             '<p class="rg"><span class="rg">+375 33</span> 635-65-65</p> </div> </div> </div> ' +
//             '<p class="rg small">* Предварительно уточняйте наличие товара, позвонив по указанным номерам</p> </div>', {
//             // Опция: не показываем кнопку закрытия.
//             closeButton: false
//         });
//         $(window).resize(function () {
//             if ($(window).width() <= 389) {
//                 myMap.balloon.open([53.932558, 27.560716]);
//             }else {
//                 myMap.balloon.open([53.931991, 27.558010]);
//             }
//         });
//         if ($(window).width() <= 389) {
//             myMap.balloon.open([53.932558, 27.560716]);
//         }else {
//             myMap.balloon.open([53.931991, 27.558010]);
//         }
//     }
// }

$(function() {
    $("#step-1").fadeIn();

    $('#step-1 .resume').click(function(){
        $("#step-1").hide();
        $("#step-2").fadeIn();
        $('.steps-list li').removeClass('active');
        $('.steps-list li:nth-child(2)').addClass('active');
    });
    $('#step-2 .return').click(function(){
        $("#step-2").hide();
        $("#step-1").fadeIn();
        $('.steps-list li').removeClass('active');
        $('.steps-list li:nth-child(1)').addClass('active');
    });
    $('#step-2 .resume').click(function(){
        $("#step-2").hide();
        $("#step-3").fadeIn();
        $('.steps-list li').removeClass('active');
        $('.steps-list li:nth-child(3)').addClass('active');
    });
    $('#step-3 .return').click(function(){
        $("#step-3").hide();
        $("#step-2").fadeIn();
        $('.steps-list li').removeClass('active');
        $('.steps-list li:nth-child(2)').addClass('active');
    });
    $('#step-3 .resume').click(function(){
        $("#step-3").hide();
        $("#success-order").fadeIn();
        $('.steps-list').hide();
    });

    // $('#step-1 .has-hint.remove').click(function() {
    $('#step-1').click(function() {
        $(this).parents('tbody').fadeOut();
    });
    // $('#step-1 .toggler').click(function(){
    //     $(this).toggleClass('active');
    //     $(this).parents('tr').next('.cart__offer').slideToggle('slow');
    // });

    $('#step-2 .has-hint').click(function(){
        $(this).next('.modal-window').show();
    });

    $('#step-2 .add_adress').click(function(){
        $(this).next('.modal-window').show();
    });

    $('.cart__list .cart__list--block').click(function(){
        $('.cart__list--block').removeClass('active');
        $(this).addClass('active');
    });

    $( ".calendar" ).datepicker({
        dateFormat: 'd MM yy',
        firstDay: 1
    });

    $(document).on('click', '.date-picker .input', function(){
        var $me = $(this),
            $parent = $me.parents('.date-picker');
        $parent.toggleClass('open');
    });

    $(".calendar").on("change",function(){
        var $me = $(this),
            $selected = $me.val(),
            $parent = $me.parents('.date-picker');
        $parent.find('.result').children('span').html($selected);
    });
});