/*Added Rising13*/

/*All function*/
function ajax_error(xhr) {
	var error_text = "<span style='color: red;'>Ошибка ";
	error_text = error_text + xhr + "К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже";
	sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
}

function ajax_success(response) {
	switch (response) {
		case "yes":
			sweetAlert({title:"Успешная отправка",text:"Спасибо, ваше сообщение отправлено, наши менеджеры скоро свяжутся с вами",type:"success",timer:5000});
			break
		case "error":
			sweetAlert({title:"Ошибка",text:"К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже",type:"error",timer:5000});
			break
		case "resubmission_val":
			sweetAlert({title:"Повторная отправка",text:"Ваше сообщение уже отправлено, нет нужды отправлять его повторно",type:"error",timer:5000});
			break

		case "spam":
			sweetAlert({title:"Спам!!!",text:"Сообщение отправлено спам-ботом",type:"error",timer:5000});
			break

		default:
			sweetAlert({title:"Ошибка",text:"К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже",type:"error",timer:5000});	
	}
}

/*Проверяем изменения чекбокса согласия на обработку кофиденциальх данных, запрещаем отправку*/
$(document).on('change', 'input[name="personal_yes"]', function () {
	var this_form = $(this).parents('form');
	var personal_yes_val2 = $(this).prop('checked');
	if(personal_yes_val2){
		this_form.find('input[type="submit"]').prop('disabled',false);
	}else{
		this_form.find('input[type="submit"]').prop('disabled',true);
	}
});


$(document).ready(function () {
	$('form input[name="personal_yes"]').each(function(index, element){
		var personal_yes_val = $(this).prop('checked');
		if(personal_yes_val){
			$(this).parents('form').find('input[type="submit"]').prop('disabled',false);
		}else{
			$(this).parents('form').find('input[type="submit"]').prop('disabled',true);
		}
	});
});

$(document).ready(function () {
	$(document).on('click','.uk-modal-close', function () {
		$('input[name="personal_yes"]').each(function(){
			$(this).removeProp('checked');
			$(this).parent().removeClass('active');
		});
	});
});


/*form form_callback (Заказать звонок)*/

function clos_clear_callback() {
	var form_select = $('#form_callback');
	form_select.find('input').removeClass("error");
	form_select.find('input[type="text"]').val('');
	form_select.find('input[type="email"]').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_callback input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_callback input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s3 = $(this).val();
		$(this).removeClass("error");
		if ((s3.length < 2) || (!regname.test(s3)) || (s3.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_callback input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});


	$('#form_callback').submit(function (event) {
		event.preventDefault();

		var form_select = $(this);
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var valid = false;

		form_select.removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email_back"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length >= 6) && (regphone.test(s2)) && (s2.length < 30)) && (s3.length === 0)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#callback .uk-modal-dialog > h2').html("Спам!!!");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = form_select.attr('action');
			form_callback_ajax(z, a_url);
		}
	});
});

function form_callback_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				$("#callback .uk-modal-close").trigger('click');
			},5000);	
		}
	});
}

/*form form_answer (Задать вопрос)*/

function clos_clear_answer() {
	var form_select = $('#form_answer');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"],input[type="email"],textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_answer input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_answer textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_answer input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $(this).val();
		$(this).removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_answer input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3)){
			$(this).addClass("error");
		}
	});

	$('#form_answer textarea[name="message"]').blur(function() {
		var s4=$(this).val();
		$(this).removeClass("error");
		if(s4.length<2){
			$(this).addClass("error");
		}
	});



	$("#form_answer").submit(function () {
		return false;
	});

	$('#form_answer button').on("click", function () {

		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var valid = false;


		$('#form_answer input[name="name"]').removeClass("error");
		$('#form_answer input[name="email"]').removeClass("error");
		$('#form_answer textarea[name="message"]').removeClass("error");

		var s1 = $('#form_answer input[name="name"]').val();
		var s2 = $('#form_answer input[name="email"]').val();
		var s3 = $('#form_answer input[name="email_back"]').val();
		var s4 = $('#form_answer textarea[name="message"]').val();
		var s5 = $('#form_answer input[name="type_form"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && (regmail.test(s2)) && (s3.length === 0) && (s4.length>2)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				$('#form_answer input[name="name"]').addClass("error");
			}

			if (!regmail.test(s2)) {
				$('#form_answer input[name="email"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#answer .uk-modal-dialog > h2').html("Спам!!!");
			}

			if(s4.length<2){
				$('#form_answer textarea[name="message"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = '&name=' + s1 + '&email=' + s2 + '&email_back=' + s3 + '&message='+s4+'&type_form=' + s5;
			var a_url = $('#form_answer').attr('action');
			form_answer_ajax(z, a_url);
		}
	});
});

function form_answer_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			$("#answer .uk-modal-close").trigger('click');
			var error_text = "<span style='color: red;'>Ошибка ";
			error_text = error_text + xhr + "К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже";
			sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
		},
		success: function (response) {
			switch (response) {
				case "yes":
					sweetAlert({title:"Успешная отправка",text:"Спасибо, ваше сообщение отправлено. После проверки модератором ваш вопрос будет добавлен на сайт",type:"success",timer:5000});
					break
				case "error":
					sweetAlert({title:"Ошибка",text:"К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже",type:"error",timer:5000});
					break
				case "resubmission_val":
					sweetAlert({title:"Повторная отправка",text:"Ваше сообщение уже отправлено, нет нужды отправлять его повторно",type:"error",timer:5000});
					break

				case "spam":
					sweetAlert({title:"Спам!!!",text:"Сообщение отправлено спам-ботом",type:"error",timer:5000});
					break

				default:
					sweetAlert({title:"Ошибка",text:"К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже",type:"error",timer:5000});	
			}
			setTimeout(function () {
				$("#answer .uk-modal-close").trigger('click');
			},5000);	
		}
	});
}

/*form form_review (Добавить отзыв)*/

function clos_clear_review() {
	var form_select = $('#form_review');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"]').val('');
	form_select.find('input[type="file"]').val('');
	form_select.find('.progress2').hide();
}

$(document).ready(function () {

	$('#form_review input,#form_review textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_review input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $(this).val();
		$(this).removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 200)) {
			$(this).addClass("error");
		}
	});

	$('#form_review input[name="email"]').blur(function () {
		var regmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3 = $(this).val();
		$(this).removeClass("error");
		if (!regmail.test(s3)) {
			$(this).addClass("error");
		}
	});

	$('#form_review textarea[name="message"]').blur(function() {
		var s5=$(this).val();
		$(this).removeClass("error");
		if(s5.length<2 && s5 != ''){
			$(this).addClass("error");
		}
	});


	$('#form_review').submit(function (event) {
		event.preventDefault();
		var form_select = $(this);

		var regmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;

		var valid = false;

		form_select.find('input').removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="email"]').val();
		var s3 = form_select.find('textarea[name="message"]').val();
		var s4 = form_select.find('input[name="email_back"]').val();


		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 200)) && (regmail.test(s2)) && (s3.length>2 || s3=='')  && (s4.length === 0)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 200)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if (!regmail.test(s2)) {
				form_select.find('input[name="email"]').addClass("error");
			}

			if (s3.length<=2 && s3!='') {
				form_select.find('textarea[name="message"]').addClass("error");
			}

			if (s4.length !== 0) {
				form_select.find('.user-form__title').html("Спам!!!");
			}
		}
		if (valid === true) {
			form_review_ajax();
		}

	});
});

function form_review_ajax() {
	var form_select = $("#form_review");

	var bar = form_select.find('.bar2');
	var percent = form_select.find('.percent2');
	var status = $('#status2');
	var maxPercent = -5;

	form_select.ajaxSubmit({
		error: function (xhr) {
			ajax_error(xhr)
		},
		beforeSend: function () {
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal)
			percent.html(percentVal);
			form_select.find('.progress2').show();
		},
		uploadProgress: function (event, position, total, percentComplete) {
			if (maxPercent < percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
				maxPercent = percentComplete;
			}
		},
		success: function () {
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		success: function (response) {
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			ajax_success(response);
		},
		complete: function (response) {
			maxPercent = -5;
			console.log(response);
			setTimeout(function () {
				$('#review .uk-modal-close').trigger('click');
			}, 5000);
		}
	});
}


/*form form_modal_service (Всплывающая форма заказать услугу)*/

$(document).ready(function () {
	$('.primary-button[href="#service"]').click(function () {
		var serw_name = $('.primary-button[href="#service"]').data('service');
		$('#form_service input[name="name_service"]').val(serw_name);
	});
});

function clos_clear_service() {
	var form_select = $('#form_service');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"],input[type="email"],textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_service input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_service textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_service input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $('#form_service input[name="name"]').val();
		$('#form_service input[name="name"]').removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$('#form_service input[name="name"]').addClass("error");
		}
	});

	$('#form_service input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $('#form_service input[name="phone"]').val();
		$('#form_service input[name="phone"]').removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$('#form_service input[name="phone"]').addClass("error");
		}
	});

	$('#form_service input[name="calltime_from"]').blur(function() {
		var s3=$('#form_service input[name="calltime_from"]').val();
		$('#form_service input[name="calltime_from"]').removeClass("error");
		if(s3.length<4){
			$('#form_service input[name="calltime_from"]').addClass("error");
		}
	});

	$('#form_service input[name="calltime_before"]').blur(function() {
		var s4=$('#form_service input[name="calltime_before"]').val();
		$('#form_service input[name="calltime_before"]').removeClass("error");
		if(s4.length<4){
			$('#form_service input[name="calltime_before"]').addClass("error");
		}
	});

	$('#form_service textarea[name="message"]').blur(function() {
		var s5=$('#form_service textarea[name="message"]').val();
		$('#form_service textarea[name="message"]').removeClass("error");
		if(s5.length<2){
			$('#form_service textarea[name="message"]').addClass("error");
		}
	});

	$("#form_service").submit(function () {
		return false;
	});

	$('#form_service button').on("click", function () {

		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var valid = false;


		$('#form_service input[name="name"]').removeClass("error");
		$('#form_service input[name="phone"]').removeClass("error");
		$('#form_service input[name="calltime_from"]').removeClass("error");
		$('#form_service input[name="calltime_before"]').removeClass("error");
		$('#form_service textarea[name="message"]').removeClass("error");

		var s1 = $('#form_service input[name="name"]').val();
		var s2 = $('#form_service input[name="phone"]').val();
		var s3 = $('#form_service input[name="email_back"]').val();
		var s4 = $('#form_service textarea[name="message"]').val();
		var s5 = $('#form_service input[name="calltime_from"]').val();
		var s6 = $('#form_service input[name="calltime_before"]').val();
		var s7 = $('#form_service input[name="type_form"]').val();
		var s8 = $('#form_service input[name="name_service"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (s3.length === 0) && (s4.length>2) && (s5.length>=4) && (s6.length>=4)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				$('#form_service input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				$('#form_service input[name="phone"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#service h2').html("Спам!!!");
			}

			if (s4.length <=2) {
				$('#form_service textarea[name="message"]').addClass("error");
			}

			if (s5.length < 4) {
				$('#form_service input[name="calltime_from"]').addClass("error");
			}

			if (s6.length < 4) {
				$('#form_service input[name="calltime_before"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = '&name='+s1+'&phone='+s2+'&email_back='+s3+'&message='+s4+'&calltime_from='+s5+'&calltime_before='+s6+'&type_form='+s7+'&name_service='+s8;
			var a_url = $('#form_service').attr('action');
			form_service_ajax(z, a_url);
		}
	});
});

function form_service_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			$("#service .uk-modal-close").trigger('click');
			var error_text = "<span style='color: red;'>Ошибка ";
			error_text = error_text + xhr + "К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже";
			sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
		},
		success: function (response) {
			switch (response) {
				case "yes":
					sweetAlert({title:"Успешная отправка",text:"Спасибо, ваше сообщение отправлено, наши менеджеры скоро свяжутся с вами",type:"success",timer:5000});
					break
				case "error":
					sweetAlert({title:"Ошибка",text:"К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже",type:"error",timer:5000});
					break
				case "resubmission_val":
					sweetAlert({title:"Повторная отправка",text:"Ваше сообщение уже отправлено, нет нужды отправлять его повторно",type:"error",timer:5000});
					break

				case "spam":
					sweetAlert({title:"Спам!!!",text:"Сообщение отправлено спам-ботом",type:"error",timer:5000});
					break

				default:
					sweetAlert({title:"Ошибка",text:"К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже",type:"error",timer:5000});	
			}
			setTimeout(function () {
				$("#service .uk-modal-close").trigger('click');
			},5000);	
		}
	});
}

/*form form_modal_product (Всплывающая форма заказать товар)*/

$(document).ready(function () {
	$('a[href="#product"]').click(function () {
		var serw_name = $(this).data('product');
		$('#form_product input[name="name_product"]').val(serw_name);
	});
});

function clos_clear_product() {
	var form_select = $('#form_product');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"]').not('input[name="name_product"]').val('');
	form_select.find('textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_product input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_product textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_product input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $(this).val();
		$(this).removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_product input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_product input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3) && s3!=''){
			$(this).addClass("error");
		}
	});

	$('#form_product textarea[name="message"]').blur(function() {
		var s5=$(this).val();
		$(this).removeClass("error");
		if(s5.length<2){
			$(this).addClass("error");
		}
	});

	$('#form_product').submit(function (event) {
		event.preventDefault();
		var form_select = $(this);
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var valid = false;

		form_select.find('input,textarea').removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email_back"]').val();
		var s4 = form_select.find('textarea[name="message"]').val();
		var s5 = form_select.find('input[name="email"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (s3.length === 0) && (s4.length>2) && (regmail.test(s5) || s5=='')) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#product h2').html("Спам!!!");
			}

			if (s4.length <=2) {
				$('#form_product textarea[name="message"]').addClass("error");
			}

			if (!regmail.test(s5) && s5!='') {
				form_select.find('input[name="email"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = form_select.attr('action');
			form_product_ajax(z, a_url);
		}
	});
});

function form_product_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				$("#product .uk-modal-close").trigger('click');
			},5000);
		}
	});
}

/*Added Rising13*/

function clos_clear_form_products_form() {
	var form_select = $('#form_products_form');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"],input[type="email"],textarea').val('');
	form_select.find('input[name="phone"]').val('7');
	form_select.find('input[name="personal_yes"]').prop('checked',false);
	form_select.find('input[name="personal_yes"]').removeClass('active');
}


$(document).ready(function () {

	$('#form_products_form input,#form_products_form textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_products_form input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $(this).val();
		$(this).removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_products_form input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_products_form input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3) && s3!=""){
			$(this).addClass("error");
		}
	});

	$('#form_products_form textarea[name="message"]').blur(function() {
		var s4=$(this).val();
		$(this).removeClass("error");
		if(s4.length<2 && s4!=""){
			$(this).addClass("error");
		}
	});

	$('#form_products_form input[name="service"]').blur(function() {
		var s5=$(this).val();
		$(this).removeClass("error");
		if(((s5.length < 2) || (s5.length >= 200)) && s5!=""){
			$(this).addClass("error");
		}
	});

	$('#form_products_form').submit(function (event) {
		event.preventDefault();

		var form_select = $(this);

		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;

		var valid = false;

		form_select.find('input,textarea').removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email"]').val();
		var s4 = form_select.find('input[name="service"]').val();
		var s5 = form_select.find('textarea[name="message"]').val();
		var s6 = form_select.find('input[name="email_back"]').val();
		var s7 = form_select.find('input[name="type_form"]').val();
		var s8 = form_select.find('input[name="personal_yes"]').prop('checked');

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (regmail.test(s3) || s3=="") && (((s4.length > 2) && (s4.length <= 200)) || s4==="") && ((s5.length >= 2) || (s5.length === 0)) && (s6.length === 0) && (s8!="undefined" && s8)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (!regmail.test(s3) && s3!="") {
				form_select.find('input[name="email"]').addClass("error");
			}

			if ((s4.length < 2)&&(s4.length!==0)){
				form_select.find('input[name="service"]').addClass("error");
			}

			if ((s5.length < 2)&&(s5.length!==0)){
				form_select.find('textarea[name="message"]').addClass("error");
			}

			if (s6.length !== 0) {
				$('.contacts-title').html("Спам!!!");
			}

			if (s8=="undefined" && !s8) {
				$('.contact-page-feedback-form').html("Спам!!!");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = $('#form_products_form').attr('action');
			form_products_form_ajax(z, a_url);
		}
	});
});

function form_products_form_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				clos_clear_form_products_form();
			},5000);
		}
	});
}

/*Added Rising13. Форма подписаться на рассылку*/

function clos_clear_form_footer_subscribe() {
	var form_select = $('#form_footer_subscribe');
	form_select.find('input').removeClass("error");
	form_select.find('input[name="email"],input[name="email_back"]').removeClass("error");
}

$(document).ready(function () {
	$('#form_footer_subscribe input').focus(function () {
		$(this).removeClass("error");
	});
	$('#form_footer_subscribe input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3)){
			$(this).addClass("error");
		}
	});



	$('#form_footer_subscribe').submit(function (event) {
		event.preventDefault();

		var form_select = $('#form_footer_subscribe');

		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var valid = false;


		form_select.find('input').removeClass("error");

		var s1 = form_select.find('input[name="email"]').val();
		var s2 = form_select.find('input[name="email_back"]').val();
		var s3 = form_select.find('input[name="type_form"]').val();

		if ((regmail.test(s1)) && (s2.length === 0)) {
			valid = true;
		} else {

			if (!regmail.test(s1)) {
				form_select.find('input[name="email"]').addClass("error");
			}

			if (s2.length !== 0) {
				form_select.find('.footer-subscribe__title div').html("Спам!!!");
			}
		}
		if (valid === true) {
			var z = '&email='+s1+'&email_back='+s2+'&type_form='+s3;
			var a_url = form_select.attr('action');
			form_footer_subscribe_ajax(z, a_url);
		}
	});

	function form_footer_subscribe_ajax(val, url_ajax) {
		$.ajax({
			type: "POST",
			url: url_ajax,
			data: val,
			error: function (xhr) {
				ajax_error(xhr)
			},
			success: function (response) {
				ajax_success(response);
				setTimeout(function () {
					clos_clear_form_footer_subscribe();
				},5000);
			}
		});
	}

});


/*form form_found_cheaper (Форма Нашли дешевле)*/

function clos_clear_found_cheaper() {
	var form_select = $('#form_found_cheaper');
	form_select.find('input').removeClass("error");
	form_select.find('input[type="text"]').not('input[name="product_name"]').val('');
	form_select.find('textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_found_cheaper input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_found_cheaper textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_found_cheaper input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s3 = $(this).val();
		$(this).removeClass("error");
		if ((s3.length < 2) || (!regname.test(s3)) || (s3.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_found_cheaper input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_found_cheaper input[name="shop_url"]').blur(function () {
		var regurl = /^(?:([a-z]+):(?:([a-z]*):)?\/\/)?(?:([^:@]*)(?::([^:@]*))?@)?((?:[a-z0-9_-]+\.)+[a-z]{2,}|localhost|(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])\.){3}(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])))(?::(\d+))?(?:([^:\?\#]+))?(?:\?([^\#]+))?(?:\#([^\s]+))?$/i;
		var s3 = $(this).val();
		$(this).removeClass("error");
		if (!regurl.test(s3)) {
			$(this).addClass("error");
		}
	});

	$('#form_found_cheaper textarea[name="message"]').blur(function() {
		var s4=$(this).val();
		$(this).removeClass("error");
		if(s4.length<2 && s4!=''){
			$(this).addClass("error");
		}
	});

	$('#form_found_cheaper').submit(function (event) {
		event.preventDefault();

		var form_select = $(this);
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regurl = /^(?:([a-z]+):(?:([a-z]*):)?\/\/)?(?:([^:@]*)(?::([^:@]*))?@)?((?:[a-z0-9_-]+\.)+[a-z]{2,}|localhost|(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])\.){3}(?:(?:[01]?\d\d?|2[0-4]\d|25[0-5])))(?::(\d+))?(?:([^:\?\#]+))?(?:\?([^\#]+))?(?:\#([^\s]+))?$/i;
		var valid = false;

		form_select.removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="shop_url"]').val();
		var s4 = form_select.find('textarea[name="message"]').val();
		var s5 = form_select.find('input[name="email_back"]').val();
		var s6 = form_select.find('input[name="product_name"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length >= 6) && (regphone.test(s2)) && (s2.length < 30)) && (regurl.test(s3)) && ((s4.length > 2) || (s4==''))  && (s5.length === 0)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (!regurl.test(s3)) {
				form_select.find('input[name="shop_url"]').addClass("error");
			}

			if (s4.length<2 && s4!='') {
				form_select.find('textarea[name="message"]').addClass("error");
			}

			if (s5.length !== 0) {
				$('#found_cheaper .uk-modal-dialog > h2').html("Спам!!!");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			z+='&product_name='+s6;
			var a_url = form_select.attr('action');
			form_found_cheaper_ajax(z, a_url);
		}
	});
});

function form_found_cheaper_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				$("#found_cheaper .uk-modal-close").trigger('click');
			},5000);
		}
	});
}

/*form form_new_service_projects (Форма оставить заявку на проект или услугу новая)*/

function clos_clear_new_service_projects() {
	var form_select = $('#form_new_service_projects');
	form_select.find('input').removeClass("error");
	form_select.find('input[type="text"]').val('');
	form_select.find('textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_new_service_projects input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_new_service_projects textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_new_service_projects input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s3 = $(this).val();
		$(this).removeClass("error");
		if ((s3.length < 2) || (!regname.test(s3)) || (s3.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_new_service_projects input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_new_service_projects input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3) && s3!=''){
			$(this).addClass("error");
		}
	});

	$('#form_new_service_projects textarea[name="message"]').blur(function() {
		var s4=$(this).val();
		$(this).removeClass("error");
		if(s4.length<2 && s4!=''){
			$(this).addClass("error");
		}
	});

	$('#form_new_service_projects').submit(function (event) {
		event.preventDefault();

		var form_select = $(this);
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;

		var valid = false;

		form_select.removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email"]').val();
		var s4 = form_select.find('textarea[name="message"]').val();
		var s5 = form_select.find('input[name="email_back"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length >= 6) && (regphone.test(s2)) && (s2.length < 30)) && (regmail.test(s3) || s3=='') && ((s4.length > 2) || (s4==''))  && (s5.length === 0)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (!regurl.test(s3) && s3!='') {
				form_select.find('input[name="email"]').addClass("error");
			}

			if (s4.length<2 && s4!='') {
				form_select.find('textarea[name="message"]').addClass("error");
			}

			if (s5.length !== 0) {
				$('#new_service_projects .uk-modal-dialog > h2').html("Спам!!!");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = form_select.attr('action');
			form_new_service_projects_ajax(z, a_url);
		}
	});
});

function form_new_service_projects_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				$("#new_service_projects .uk-modal-close").trigger('click');
			},5000);
		}
	});
}


/*form form_feedback_question_popap (Форма оставить заявку на обратную связь (вопрос) попап)*/

function clos_clear_feedback_question_popap() {
	var form_select = $('#form_feedback_question_popap');
	form_select.find('input').removeClass("error");
	form_select.find('input[type="text"]').val('');
	form_select.find('textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_feedback_question_popap input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_feedback_question_popap textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_feedback_question_popap input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s3 = $(this).val();
		$(this).removeClass("error");
		if ((s3.length < 2) || (!regname.test(s3)) || (s3.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_feedback_question_popap input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_feedback_question_popap input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3) && s3!=''){
			$(this).addClass("error");
		}
	});

	$('#form_feedback_question_popap textarea[name="message"]').blur(function() {
		var s4=$(this).val();
		$(this).removeClass("error");
		if(s4.length<2){
			$(this).addClass("error");
		}
	});

	$('#form_feedback_question_popap').submit(function (event) {
		event.preventDefault();

		var form_select = $(this);
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;

		var valid = false;

		form_select.removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email"]').val();
		var s4 = form_select.find('textarea[name="message"]').val();
		var s5 = form_select.find('input[name="email_back"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length >= 6) && (regphone.test(s2)) && (s2.length < 30)) && (regmail.test(s3) || s3=='') && (s4.length > 2)  && (s5.length === 0)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (!regurl.test(s3) && s3!='') {
				form_select.find('input[name="email"]').addClass("error");
			}

			if (s4.length<2) {
				form_select.find('textarea[name="message"]').addClass("error");
			}

			if (s5.length !== 0) {
				$('#feedback_question_popap .uk-modal-dialog > h2').html("Спам!!!");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = form_select.attr('action');
			form_feedback_question_popap_ajax(z, a_url);
		}
	});
});

function form_feedback_question_popap_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				$("#feedback_question_popap .uk-modal-close").trigger('click');
			},5000);
		}
	});
}


/*form form_modal_fast_buy (Всплывающая форма заказать товар)*/

$(document).ready(function () {
	$('a[href="#fast_buy"]').click(function () {
		var serw_name = $(this).data('product');
		$('#form_fast_buy input[name="name_product"]').val(serw_name);
	});
});

function clos_clear_fast_buy() {
	var form_select = $('#form_fast_buy');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"]').not('input[name="name_product"]').val('');
	form_select.find('textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_fast_buy input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_fast_buy textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_fast_buy input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $(this).val();
		$(this).removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3) && s3!=''){
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy textarea[name="message"]').blur(function() {
		var s5=$(this).val();
		$(this).removeClass("error");
		if(s5.length<2 && s5!=''){
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy').submit(function (event) {
		event.preventDefault();
		var form_select = $(this);
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var valid = false;

		form_select.find('input,textarea').removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email_back"]').val();
		var s4 = form_select.find('textarea[name="message"]').val();
		var s5 = form_select.find('input[name="email"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (s3.length === 0) && (s4.length>2 || s4 == '') && (regmail.test(s5) || s5=='')) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#fast_buy h2').html("Спам!!!");
			}

			if (s4.length <=2 && s4 != '') {
				$('#form_fast_buy textarea[name="message"]').addClass("error");
			}

			if (!regmail.test(s5) && s5 != '') {
				form_select.find('input[name="email"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = form_select.attr('action');
			form_fast_buy_ajax(z, a_url);
		}
	});
});

function form_fast_buy_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				$("#fast_buy .uk-modal-close").trigger('click');
			},5000);
		}
	});
}


/*form form_jobs_form_new (Форма отправить резюме)*/
function clos_clear_jobs_form_new() {
	var form_select = $('#form_jobs_form_new');
	form_select.find('input').removeClass("error");
	form_select.find('input[type="text"]').val('');
	form_select.find('input[type="file"]').val('');
	form_select.find('.progress2').hide();
	form_select.find('input[name="phone"]').val('375');
}

$(document).ready(function () {

	$('#form_jobs_form_new input').focus(function () {
		$(this).removeClass("error");
	});

	$('a[href="#jobs_form_new"]').click(function () {
		var serw_name = $(this).data('vacancy');
		$('#form_jobs_form_new input[name="vacancy_name"],#form_jobs_form_new input[name="vacancy"]').val(serw_name);
	});

	$('#form_jobs_form_new input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $(this).val();
		$(this).removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 200)) {
			$(this).addClass("error");
		}
	});

	$('#form_jobs_form_new input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_jobs_form_new input[name="email"]').blur(function () {
		var regmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3 = $(this).val();
		$(this).removeClass("error");
		if (!regmail.test(s3)) {
			$(this).addClass("error");
		}
	});


	$('#form_jobs_form_new').submit(function (event) {
		event.preventDefault();
		var form_select = $(this);

		var regmail = /^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;

		var valid = false;

		form_select.find('input').removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email"]').val();
		var s4 = form_select.find('input[name="email_back"]').val();


		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 200)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (regmail.test(s3) || s3=='') && (s4.length === 0)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 200)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (!regmail.test(s3) && s3 != '') {
				form_select.find('input[name="email"]').addClass("error");
			}
			if (s4.length !== 0) {
				form_select.find('.user-form__title').html("Спам!!!");
			}
		}
		if (valid === true) {
			form_jobs_form_new_ajax();
		}

	});
});

function form_jobs_form_new_ajax() {
	var form_select = $("#form_jobs_form_new");

	var bar = form_select.find('.bar2');
	var percent = form_select.find('.percent2');
	var status = $('#status2');
	var maxPercent = -5;

	form_select.ajaxSubmit({
		error: function (xhr) {
			ajax_error(xhr)
		},
		beforeSend: function () {
			status.empty();
			var percentVal = '0%';
			bar.width(percentVal)
			percent.html(percentVal);
			form_select.find('.progress2').show();
		},
		uploadProgress: function (event, position, total, percentComplete) {
			if (maxPercent < percentComplete) {
				var percentVal = percentComplete + '%';
				bar.width(percentVal)
				percent.html(percentVal);
				maxPercent = percentComplete;
			}
		},
		success: function () {
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
		},
		success: function (response) {
			var percentVal = '100%';
			bar.width(percentVal)
			percent.html(percentVal);
			ajax_success(response);
		},
		complete: function (response) {
			maxPercent = -5;
			console.log(response);
			setTimeout(function () {
				$('#jobs_form_new .uk-modal-close').trigger('click');
			}, 5000);
		}
	});
}

/*form form_modal_fast_buy_side_basket (Всплывающая форма заказать товар)*/

function clos_clear_fast_buy_side_basket() {
	var form_select = $('#form_fast_buy_side_basket');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"]').val('');
	form_select.find('textarea').val('');
	form_select.find('input[name="phone"]').val('375');
}


$(document).ready(function () {

	$('#form_fast_buy_side_basket input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_fast_buy_side_basket textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_fast_buy_side_basket input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $(this).val();
		$(this).removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy_side_basket input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $(this).val();
		$(this).removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy_side_basket input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3) && s3!=''){
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy_side_basket textarea[name="message"]').blur(function() {
		var s5=$(this).val();
		$(this).removeClass("error");
		if(s5.length<2 && s5!=''){
			$(this).addClass("error");
		}
	});

	$('#form_fast_buy_side_basket').submit(function (event) {
		event.preventDefault();
		var form_select = $(this);
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var valid = false;

		form_select.find('input,textarea').removeClass("error");

		var s1 = form_select.find('input[name="name"]').val();
		var s2 = form_select.find('input[name="phone"]').val();
		var s3 = form_select.find('input[name="email_back"]').val();
		var s4 = form_select.find('textarea[name="message"]').val();
		var s5 = form_select.find('input[name="email"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (s3.length === 0) && (s4.length>2 || s4 == '') && (regmail.test(s5) || s5=='')) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				form_select.find('input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				form_select.find('input[name="phone"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#fast_buy_side_basket h2').html("Спам!!!");
			}

			if (s4.length <=2 && s4 != '') {
				$('#form_fast_buy_side_basket textarea[name="message"]').addClass("error");
			}

			if (!regmail.test(s5) && s5 != '') {
				form_select.find('input[name="email"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = form_select.attr('action');
			form_fast_buy_side_basket_ajax(z, a_url);
		}
	});
});

function form_fast_buy_side_basket_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			ajax_error(xhr)
		},
		success: function (response) {
			ajax_success(response);
			setTimeout(function () {
				$("#fast_buy_side_basket .uk-modal-close").trigger('click');
				jQuery.emptyCart(undefined);
			},5000);
		}
	});
}