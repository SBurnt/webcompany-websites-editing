/*Изменение конфигурации сайта*/
function ajax_settings_error(xhr) {
    var error_text = "<span style='color: red;'>Ошибка ";
    error_text = error_text + xhr + "К сожалению, при изменении конфигурации сайта возникла ошибка";
    sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
}
function setting_change_ajax(val, url_ajax) {
    $.ajax({
        type: "POST",
        url: url_ajax,
        data: val,
        error: function (xhr) {
            ajax_settings_error(xhr)
        },
        beforeSend: function () {
            if($('form.customer-settings').hasClass('loaded')){
                $('form.customer-settings').removeClass('loaded');
            }
            inProgress = true;
            //$(".spinner:not(.custom-pages)").show();
        },
        success: function (response) {
            if(!$('form.customer-settings').hasClass('loaded')){
                $('form.customer-settings').addClass('loaded');
            }
            inProgress = false;
            //$(".spinner:not(.custom-pages)").hide();
            //location.replace(url_ajax);
            /*AJAX получение контента*/
            // var $responce_val_obj = $("<div/>", {
            //     "class": "responce_val",
            //     html: response
            // });
            // var $dom = $('#main_wrap', $responce_val_obj).contents();
            // $('#main_wrap').html($dom);
        }
    });
}
$(document).ready(function () {
    inProgress = false;
    $('.customer-settings-line label.radio input').on("click", function () {
        var input_name = $(this).prop('name');
        var input_value = $(this).prop('value');
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        setting_change_ajax(post_date,setting_ajax_url);
    });

    $('.customer-settings .customer-settings-main label.radio input').on("click", function () {
        var input_name = $(this).prop('name');
        var input_value = $(this).prop('value');
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        setting_change_ajax(post_date,setting_ajax_url);
    });

    $('.ordered-list-dots label.radio input').on("click", function () {
        var input_name = $(this).prop('name');
        var input_value = $(this).prop('value');
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        setting_change_ajax(post_date,setting_ajax_url);
    });

    $('.customer-settings-line[data-id="customer__basket"] label.checkbox input').on("change", function () {
        var input_name = $(this).prop('name');
        //var input_value = $(this).prop('value');
        var is_active = $(this).prop('checked');
       if (is_active){
            input_value = 0;
       }else{
           input_value = 1;
       }
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        console.log(post_date);
        setting_change_ajax(post_date,setting_ajax_url);
    });

    $('.customer-settings-line label.checkbox input').on("change", function () {
        var input_name = $(this).prop('name');
        //var input_value = $(this).prop('value');
        var is_active = $(this).prop('checked');
        if(input_name == 'busket_change') {
            if (is_active) {
                input_value = 0;
            } else {
                input_value = 1;
            }
        }else{
            input_value = Number(is_active);
        }
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        console.log(post_date);
        setting_change_ajax(post_date,setting_ajax_url);
    });

    $('.settings-table .settings-table-row label.radio input').on("change", function () {
        var input_name = $(this).prop('name');
        var input_value = $(this).prop('value');
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        console.log(post_date);
        setting_change_ajax(post_date,setting_ajax_url);
    });


    $(document).on('change', '.settings-table .settings-table-row label.checkbox input', function (e) {
       if(!!$(e.target).closest('input')){
           var input_name = $(e.target).prop('name');
           var input_value = 0;
           if($(e.target).get(0).checked){
               input_value = 1;
           }else{
               input_value = 0;
           }
           var setting_ajax_url = $(e.target).parents('form.customer-settings').prop('action');
           var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
           console.log(post_date);
           setting_change_ajax(post_date,setting_ajax_url);
       }
    });

    $('.customer-settings-main label.select-color input').on("change", function () {
        var input_name = $(this).prop('name');
        var input_value = $(this).prop('value');
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        console.log(post_date);
        setting_change_ajax(post_date,setting_ajax_url);
    });

    $('#set-color__ok').on("click", function () {
        var input_name = $(this).parents('.picker-window-wrap').find('input.input-color').prop('name');
        var input_value = $(this).parents('.picker-window-wrap').find('input.input-color').prop('value');
        var setting_ajax_url = $(this).parents('form.customer-settings').prop('action');
        var post_date = '&' + input_name + '=' + input_value + '&change_site_config=1';
        console.log(post_date);
        setting_change_ajax(post_date,setting_ajax_url);
    });

});