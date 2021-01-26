 $(document).ready(initMailScripts);

function initMailScripts(){
    $("form.order-form").submit(function(){
        return false;
    });
    var mailUrl = "https://centrpol.by/template/php/mail.php";
    var successMessage = "<p>Спасибо за заявку, менеджер вскоре с вами свяжется!</p>";
    var errorMessage = "<p>Системная ошибка, попробуйте позже или позвоните нам по телефону: +375 29 381 73 99.</p>";
    // 
    $(".send-site-request").click(function(){  
        var form = $(this).parents("form");             
        var type = form.attr("data-form-type");
        var name = form.find("[name='name']").val();
        var phone = form.find("[name='phone']").val();
        var amount = form.find("[name='amount']").val();
        var message = form.find("[name='message']").val();
        var plinth01 = form.find("[name='plinth01']").val();
        var plinth02 = form.find("[name='plinth02']").val();
        var plinth03 = form.find("[name='plinth03']").val();
        var plinth04 = form.find("[name='plinth04']").val();
        var text = "" + type + " с сайта centrpol.by \r\n<br>" + 
                   "<b>Имя:</b> " + name + "\r\n<br>" + 
                   "<b>Телефон:</b> " + phone + "\r\n<br>";
        if (amount)
        {
            text = text + "<b>Количество, м2:</b> " + amount + "\r\n<br>";
        }
        if (message)
        {
            text = text + "<b>Сообщение:</b> " + message + "\r\n<br><br>";
        }
        if (plinth01)
        {
            text = text + "<b>Дополнительно: Плинтус, шт.:</b> " + plinth01 + "\r\n<br>";
        }
        if (plinth02)
        {
            text = text + "<b>Дополнительно: Внутренних угол, шт.:</b> " + plinth02 + "\r\n<br>";
        }
        if (plinth03)
        {
            text = text + "<b>Дополнительно: Наружный угол, шт.:</b> " + plinth03 + "\r\n<br>";
        }
        if (plinth04)
        {
            text = text + "<b>Дополнительно: Соединитель, шт.:</b> " + plinth04 + "\r\n<br>";
        }
        if (!phone)
        {
        	alert("Укажите телефон");
        	return false;
        }
        $.post(mailUrl,{text:text})
        .done(function(res){
			dataLayer.push({'event': 'form_sent'});
			console.log('form_sent');
			
            form.fadeOut(200);
            setTimeout(function(){
                form.html(successMessage);
                form.fadeIn(200);
            },200);
        })
        .fail(function(res){
            form.fadeOut(200);
            setTimeout(function(){
                form.fadeIn(200);
                form.html(errorMessage);
            },200);
        });
        return false;
    });
}