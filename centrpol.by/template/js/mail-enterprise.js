 $(document).ready(initMailScripts);

function initMailScripts(){
    $("form.enter").submit(function(){
        return false;
    });
    var mailUrl = "https://centrpol.by/template/php/mail.php";
    var successMessage = "<p>Спасибо за заявку, менеджер вскоре с вами свяжется!</p>";
    var errorMessage = "<p>Системная ошибка, попробуйте позже или позвоните нам по телефону: +375 29 381 73 99.</p>";
    // 
    $(".send-site-request-enterprise").click(function(){  
        var form = $(this).parents("form");             
        var type = form.attr("data-form-type");
        var product = form.find("[name='product']").val();
        var amount = form.find("[name='amount']").val();
        var organization = form.find("[name='organization']").val();
        var unp = form.find("[name='unp']").val();
        var address = form.find("[name='address']").val();
        var account = form.find("[name='account']").val();
        var bank = form.find("[name='bank']").val();
        var code = form.find("[name='code']").val();
        var director = form.find("[name='director']").val();
        var base = form.find("[name='base']").val();
        var phone = form.find("[name='phone']").val();
        var email = form.find("[name='email']").val();
        var commentary = form.find("[name='commentary']").val();
        var text = "" + type + " с сайта centrpol.by \r\n<br>" + 
                   "<b>Товар:</b> " + product + "\r\n<br>" + 
                   "<b>Количество, м2:</b> " + amount + "\r\n<br>" + 
                   "<b>Наименование юр. лица:</b> " + organization + "\r\n<br>" + 
                   "<b>УНП:</b> " + unp + "\r\n<br>" + 
                   "<b>Адрес:</b> " + address + "\r\n<br>" + 
                   "<b>Расчетный счет:</b> " + account + "\r\n<br>" + 
                   "<b>Банк:</b> " + bank + "\r\n<br>" + 
                   "<b>Код:</b> " + code + "\r\n<br>" + 
                   "<b>Директор:</b> " + director + "\r\n<br>" + 
                   "<b>На основании:</b> " + base + "\r\n<br>" + 
                   "<b>Телефон:</b> " + phone + "\r\n<br>";
        if (!product)
        {
        	alert("Укажите товар");
        	return false;
        }
        if (!amount)
        {
        	alert("Укажите количество");
        	return false;
        }
		if (!organization)
        {
        	alert("Укажите наименование");
        	return false;
        }
        if (!unp)
        {
        	alert("Укажите УНП");
        	return false;
        }
        if (!address)
        {
        	alert("Укажите адрес");
        	return false;
        }
        if (!account)
        {
        	alert("Укажите счет");
        	return false;
        }
        if (!bank)
        {
        	alert("Укажите банк");
        	return false;
        }
        if (!code)
        {
        	alert("Укажите код банка");
        	return false;
        }
        if (!director)
        {
        	alert("Укажите ФИО директора");
        	return false;
        }
        if (!base)
        {
        	alert("Укажите основание");
        	return false;
        }
		if (!phone)
        {
        	alert("Укажите телефон");
        	return false;
        }
        if (email)
        {
            text = text + "<b>Эл. почта:</b> " + email + "<br>";
        }
        if (commentary)
        {
            text = text + "<b>Комментарий:</b> " + commentary;
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