/*Функция генерации цены*/
function clos_clear_calc_() {
    $('.form-transfer input').removeClass("error");
    $('.form-transfer select').removeClass("error");
    $('.form-transfer input[type="text"]').val('');
    $('.form-transfer select option:eq(0)').prop("selected", true);
    $('.form-transfer select option:eq(0)').prop("selected", true);
    $('.form-transfer input[type="checkbox"]').prop("checked", false);
    $('select[name="zone"]').parents('.form-transfer__line').remove();
}

/*Функция обработки цены*/
function format_price(price_by,deg = 2){
	if (price_by != '' && price_by != null && price_by != 'undefined') {
		var ten_deg = Math.pow(10, deg);
		price_by = parseFloat(price_by);
		price_by = Math.round((price_by)*ten_deg)/ten_deg;
	} else {
		price_by = 0;
	}
	return price_by;
}

function price_generation(inProgress) {
    var intermediate_point_price = 5;
    var trasfer_type = $('select[name="transfer_type"]').val();
    var location = $('select[name="location"]').val();
    var where = $('select[name="where"]').val();
    var auto_type = $('select[name="auto_type"]').val();
    var zone = $('select[name="zone"]').val();
    if (zone == null && zone == '' && zone == 'undefined') {
        zone = 0;
    }
    if (trasfer_type != '' && trasfer_type != null && location != '' && location != null && where != '' && where != null && auto_type != '' && auto_type != null) {
        var ajax_url_data_load = 'assets/templates/market/calculatur/ajax/data_load.php';
        var dan_data_load = "&trasfer_type=" + trasfer_type + "&location=" + location + "&where=" + where + "&auto_type=" + auto_type + "&zone=" + zone;
        if (!inProgress) {
            $.ajax({
                type: "GET",
                url: ajax_url_data_load,
                data: dan_data_load,
                beforeSend: function () {
                    $(".spinner").show();
                    inProgress = true;
                },
                success: function (msg) {
                    if (msg != '' && msg != null && msg != 'undefined') {
                        msg2 = $.parseJSON(msg);
                        var price_by = msg2.price.price_by;//Цена заданная
						
						if (price_by != '' && price_by != null && price_by != 'undefined') {
							price_by = format_price(price_by,0);
                        } else {
                            price_by = 0;
                        }
						
						
						if (price_by != undefined) {
                            var add_addres_count = $('.form-transfer #add-input input').size();
                            add_addres_count = parseInt(add_addres_count);
                            if (add_addres_count > 1) {
                                var intermediate_point = parseInt(add_addres_count) - 1;
                                price_by = parseFloat(price_by) + (parseFloat(intermediate_point_price) * intermediate_point);
								price_by = format_price(price_by,0);
								
								var price_usd = msg2.price.price_en;
								price_usd = format_price(price_usd,2);
								var price_euro = msg2.price.price_eu;
								price_euro = format_price(price_euro,2);
								var price_rus = msg2.price.price_ru;
								price_rus = format_price(price_rus,0);
								
								var price_usd_add = (intermediate_point_price * parseFloat(msg2.courses[0]))*intermediate_point;
								price_usd_add = format_price(price_usd_add,2);
								var price_euro_add = (intermediate_point_price * parseFloat(msg2.courses[1]))* intermediate_point;
								price_euro_add = format_price(price_euro_add,2);
								var price_rus_add = (intermediate_point_price * parseFloat(msg2.courses[2]))* intermediate_point;
								price_rus_add = format_price(price_rus_add,0);
								
								price_usd += price_usd_add;
								price_euro += price_euro_add;
								price_rus += price_rus_add;
								
								price_usd = format_price(price_usd,0);
								price_euro = format_price(price_euro,0);
								price_rus = format_price(price_rus,-2);
								
                            }else{
								var price_usd = msg2.price.price_en;
								price_usd = format_price(price_usd,0);
								var price_euro = msg2.price.price_eu;
								price_euro = format_price(price_euro,0);
								var price_rus = msg2.price.price_ru;
								price_rus = format_price(price_rus,-2);
							}
							
                            var price_by_li = "<li>" + price_by + " BYN </li>";
                            var price_usd_li = "<li>" + price_usd + " USD </li>";
                            var price_euro_li = "<li>" + price_euro + " EUR </li>";
                            var price_rus_li = "<li>" + price_rus + " RUB </li>";
                            $('.form-transfer-section.price .form-transfer__price ul').html(price_by_li + price_usd_li +
                                price_euro_li + price_rus_li);
                            $('.form-transfer-section.price').show().removeClass('noselect').attr('price_by', price_by);
                            $('.form-transfer input[name="price"]').val(price_by);
                            $('.form-transfer-section.payment').show().removeClass('noselect');
                        }

                        $(".spinner").hide();
                        inProgress = false;
                    }
                }
            });
        }
    } else {
        $('.form-transfer-section.price').hide().addClass('noselect').attr('price_by', 0);
        $('.form-transfer-section.payment').hide().addClass('noselect');
    }
}

function transfer_type_change(inProgress, location_val, where_val) {
    var trasfer_type = $('select[name="transfer_type"]').val();
    if (trasfer_type != '' && trasfer_type != null) {
        var ajax_url = 'assets/templates/market/calculatur/ajax/location.php';
        var dan = "&trasfer_type=" + trasfer_type;

        if (!inProgress) {

            $.ajax({
                type: "GET",
                url: ajax_url,
                data: dan,
                beforeSend: function () {
                    $(".spinner").show();
                    inProgress = true;
                },
                success: function (msg) {
                    msg2 = $.parseJSON(msg);
                    if (msg2 !== '') {
                        if (msg2.location !== '') {
                            var location_select = '<option disabled="" selected="">Выберите пункт отправления</option> ';
                            msg2.location.forEach(function (item, i, arr) {
                                location_select += '<option value=\'' + item + '\'>' + item + '</option> ';
                            });
                            $('select[name="location"]').html(location_select);
                            $('select[name="location"]').prop('disabled', false);
                        }
                        if (msg2.auto_type !== '') {
                            var auto_type_select = '<option disabled="" selected="">Выберите тип автомобиля</option> ';
                            msg2.auto_type.forEach(function (item2, i2, arr2) {
                                auto_type_select += '<option value=\'' + item2 + '\'>' + item2 + '</option> ';
                            });
                            $('select[name="auto_type"]').html(auto_type_select);
                            $('select[name="auto_type"]').prop('disabled', false);
                        }
                    }
                    $('select[name="where"] option:eq(0)').prop("selected", true);
                    $('select[name="where"]').prop('disabled', true);

                    $('select[name="zone"]').parents('.form-transfer__line').remove();

                    $(".spinner").hide();
                    inProgress = false;
                    location_value_change(inProgress, location_val, where_val);
                    price_generation(inProgress);
                }
            });
        }
    }
}

function location_value_change(inProgress, location_val, where_val) {
    if (location_val != '' && location_val != null) {
        var location = location_val;
        $('select[name="location"] option[value="' + location_val + '"]').prop("selected", true);
    } else {
        var location = $('select[name="location"]').val();
    }
    var trasfer_type = $('select[name="transfer_type"]').val();
    var zone = $('select[name="zone"]').val();
    if (zone == 'undefined' || zone == "" || zone == null) {
        zone = 0;
    }
    if (trasfer_type != '' && trasfer_type != null && location != '' && location != null) {
        var ajax_url_where = 'assets/templates/market/calculatur/ajax/where_select.php';
        var dan_where = "&trasfer_type=" + trasfer_type + "&location=" + location + "&zone=" + zone;

        if (inProgress) {
        } else {
            $.ajax({
                type: "GET",
                url: ajax_url_where,
                data: dan_where,
                beforeSend: function () {
                    $(".spinner").show();
                    inProgress = true;
                },
                success: function (msg) {
                    $('select[name="where"]').html(msg);
                    $(".spinner").hide();
                    $('select[name="where"]').prop('disabled', false);
                    inProgress = false;
                    $('select[name="zone"]').parents('.form-transfer__line').remove();
                    where_value_change(inProgress, where_val)
                    price_generation(inProgress);
                }
            });
        }
    }
}

function where_value_change(inProgress, where_val) {
    var trasfer_type = $('select[name="transfer_type"]').val();
    var location = $('select[name="location"]').val();
    var zone = $('select[name="zone"]').val();
    if (zone == 'undefined' || zone == "" || zone == null) {
        zone = 0;
    }

    if (where_val != '' && where_val != null) {
        var where = where_val;
        $('select[name="where"] option[value="' + where_val + '"]').prop("selected", true);
    } else {
        var where = $('select[name="where"]').val();
    }

    if (trasfer_type != '' && trasfer_type != null && location != '' && location != null
        && where != '' && where != null) {
        var ajax_url_data_load = 'assets/templates/market/calculatur/ajax/description_load.php';
        var dan_data_load = "&trasfer_type=" + trasfer_type + "&location=" + location + "&where=" + where + "&zone=" + zone;
        if (!inProgress) {
            $.ajax({
                type: "GET",
                url: ajax_url_data_load,
                data: dan_data_load,
                beforeSend: function () {
                    $(".spinner").show();
                    inProgress = true;
                },
                success: function (msg) {
                    $('.form-transfer__more-info.road_data').html(msg);
                    $(".spinner").hide();
                    inProgress = false;
                }
            });
        }
    }
}


function payment_error(xhr) {
    var error_text = "<span style='color: red;'>Ошибка: ";
    error_text = error_text + xhr + "К сожалению, при генерации счета на оплату возникли проблемы. Попробуйте отправить позже или обратитесь к владельцам сайта.";
    sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
}

/*Подгрузка значений поля Откуда*/
$(document).ready(function () {


    var inProgress = false;
    $('body').on('change', 'select[name="transfer_type"]', function (event) {
        event.preventDefault();
        transfer_type_change(inProgress);
    });
    $('body').on('change', 'select[name="location"]', function (event) {
        event.preventDefault();
        location_value_change(inProgress);
    });
    $('body').on('change', 'select[name="where"]', function (event) {
        event.preventDefault();
        var transfer_type_wch = $('select[name="transfer_type"]').val();
        if (transfer_type_wch != 'a') {
            where_value_change(inProgress);
        } else {
            //zone_load_change(inProgress);
			where_value_change(inProgress);
        }
    });

    /*$('body').on('change', 'select[name="zone"]', function (event) {
        event.preventDefault();
        where_value_change(inProgress);
    });*/

    $('body').on('change', 'select[name="transfer_type"],select[name="location"],select[name="where"],' +
        'select[name="auto_type"],select[name="zone"]', function (event) {
        event.preventDefault();
        price_generation(inProgress);
    });

    $('body').on('click', '.form-transfer__add-point', function (event) {
        event.preventDefault();
        price_generation(inProgress);
    });

    $('body').on('click', '.del-adress', function (event) {
        event.preventDefault();
        price_generation(inProgress);
    });


    $('.form-transfer input, .form-transfer select').focus(function () {
        $(this).removeClass("error");

    });

    $('.form-transfer input[name="name"]').blur(function () {
        var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
        var s3 = $('.form-transfer input[name="name"]').val();
        $('.form-transfer input[name="name"]').removeClass("error");
        if ((s3.length < 2) || (!regname.test(s3)) || (s3.length >= 60)) {
            $('.form-transfer input[name="name"]').addClass("error");
        }
    });

    $('.form-transfer input[name="phone"]').blur(function () {
        var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
        var s2 = $('.form-transfer input[name="phone"]').val();
        $('.form-transfer input[name="phone"]').removeClass("error");
        if ((s2.length < 11) || (!regphone.test(s2)) || (s2.length >= 60)) {
            $('.form-transfer input[name="phone"]').addClass("error");
        }
    });

    $('.form-transfer input[name="email"]').blur(function () {
        var regmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
        var s3 = $('.form-transfer input[name="email"]').val();
        $('.form-transfer input[name="email"]').removeClass("error");
        if (!regmail.test(s3)) {
            $('.form-transfer input[name="email"]').addClass("error");
        }
    });

    $('.form-transfer input[name="adress"],.form-transfer input[name="voyage_nmr"]').blur(function () {
        var s4 = $(this).val();
        $(this).removeClass("error");
        if (s4.length < 2 && s4 != "") {
            $(this).addClass("error");
        }
    });

    $('body').on('submit', 'form.form-transfer', function (event) {
        event.preventDefault();

        var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
        var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
        var regmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
        var valid = false;

        $('.form-transfer input,.form-transfer select').removeClass("error");

        var trasfer_type_val2 = $('.form-transfer select[name="transfer_type"]').val();
        var location_val2 = $('.form-transfer select[name="location"]').val();
        var where_val2 = $('.form-transfer select[name="where"]').val();
        var auto_type_val2 = $('.form-transfer select[name="auto_type"]').val();
        var date_val2 = $('.form-transfer input[name="date"]').val();
        var time_hours_val2 = $('.form-transfer select[name="time_hours"]').val();
        var time_mins_val2 = $('.form-transfer select[name="time_mins"]').val();
        var name_val2 = $('.form-transfer input[name="name"]').val();
        var phone_val2 = $('.form-transfer input[name="phone"]').val();
        var email_val2 = $('.form-transfer input[name="email"]').val();

        if ((trasfer_type_val2 != '' && trasfer_type_val2 != null)
            && (location_val2 != '' && location_val2 != null)
            && (where_val2 != '' && where_val2 != null)
            && (auto_type_val2 != '' && auto_type_val2 != null)
            && (date_val2 != '' && date_val2 != null)
            && (time_hours_val2 != '' && time_hours_val2 != null)
            && (time_mins_val2 != '' && time_mins_val2 != null)
            && (name_val2 != '' && name_val2 != null && (name_val2.length >= 2)
                && (regname.test(name_val2)) && (name_val2.length < 200))
            && (phone_val2 != '' && phone_val2 != null
                && (phone_val2.length >= 11) && (regphone.test(phone_val2))
                && (phone_val2.length < 60))
            && (regmail.test(email_val2))) {
            $('form.form-transfer input[type="submit"]').prop('readonly', false);
            valid = true;
        } else {
            valid = false;
            if (trasfer_type_val2 == '' || trasfer_type_val2 == null) {
                $('.form-transfer select[name="transfer_type"]').addClass("error");
            }

            if (location_val2 == '' || location_val2 == null) {
                $('.form-transfer select[name="location"]').addClass("error");
            }

            if (where_val2 == '' || where_val2 == null) {
                $('.form-transfer select[name="where"]').addClass("error");
            }

            if (auto_type_val2 == '' || auto_type_val2 == null) {
                $('.form-transfer select[name="auto_type"]').addClass("error");
            }
            if (date_val2 == '' || date_val2 == null) {
                $('.form-transfer select[name="date"]').addClass("error");
            }

            if (time_hours_val2 == '' || time_hours_val2 == null) {
                $('.form-transfer select[name="time_hours"]').addClass("error");
            }

            if (time_mins_val2 == '' || time_mins_val2 == null) {
                $('.form-transfer select[name="time_mins"]').addClass("error");
            }

            if ((name_val2.length < 2) || (!regname.test(name_val2)) || (name_val2.length >= 200)) {
                $('.form-transfer input[name="name"]').addClass("error");
            }

            if ((phone_val2.length < 6) || (!regphone.test(phone_val2)) || (phone_val2.length >= 30)) {
                $('form.form-transfer input[name="phone"]').addClass("error");
            }

            if (!regmail.test(email_val2)) {
                $('form.form-transfer input[name="email"]').addClass("error");
            }

        }
        if (valid === true) {
            var value_form = $(this).serialize();
            var form_url = $(this).attr('action');
            var payment_val = $('.form-transfer-section.payment input[name="payment"]:checked').val();
            if(payment_val==='payment-cash') {
               var form_data_type = 'text';
            }else{
                var form_data_type = 'xml';
            }
			console.log(value_form);
            form_transfer_ajax(value_form, form_url,form_data_type);
        }
    });

    function form_transfer_ajax(val, url_ajax,data_type) {
        $.ajax({
            type: "POST",
            url: url_ajax,
            data: val,
            dataType: data_type,
            error: function (xhr) {
                ajax_error(xhr)
            },
            success: function (response) {
                if(data_type!=='xml') {
                    ajax_success(response);

                    dataLayer.push({'event': 'form_sent'});
                    setTimeout(function () {
                        clos_clear_calc_();
                    }, 5000);
                }else{
                    var result_count = $(response).find("result").attr('count');
                    result_count = parseInt(result_count);
                    if(result_count){
                        var payment_url_domen = $('.form-transfer .payment_url').data('url');
                        var result_hash = $(response).find("result return Hash").text();
                        var payment_url_all = payment_url_domen + 'bill/paybill.cfm?ID=' + result_hash;
                        window.location.assign(payment_url_all);
                    }else{
                        var firstcode_error = $(response).find("result").attr('firstcode');
                        var secondcode_error = $(response).find("result").attr('secondcode');
                        payment_error(firstcode_error +' / '+ secondcode_error);
                    }

                }
            }
        });
    }

});

/*Маска ввода телефона*/
$(document).ready(function () {
    var maskList = $.masksSort($.masksLoad("assets/templates/market/js/inputmask-multi/data/phone-codes.json"),
        ['#'], /[0-9]|#/, "mask");
    var maskOpts = {
        inputmask: {
            definitions: {
                '#': {
                    validator: "[0-9]",
                    cardinality: 1
                }
            },
            //clearIncomplete: true,
            showMaskOnHover: false,
            autoUnmask: true
        },
        match: /[0-9]/,
        replace: '#',
        list: maskList,
        listKey: "mask",
        onMaskChange: function (maskObj, completed) {
            if (completed) {
                var hint = maskObj.name_ru;
                if (maskObj.desc_ru && maskObj.desc_ru != "") {
                    hint += " (" + maskObj.desc_ru + ")";
                }
                $("#descr").html(hint);
            } else {
                $("#descr").html("");
            }
            $(this).attr("placeholder", $(this).inputmask("getemptymask"));
        }
    };
    $('#customer_phone').inputmasks(maskOpts);
});