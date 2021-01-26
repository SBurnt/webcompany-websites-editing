/*Added Rising13*/
/*form form_callback (Заказать звонок)*/

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


$(document).ready(function () {
	$('#callback .uk-modal-close').click(function () {
		clos_clear_callback();
	});
});

function clos_clear_callback() {
	$('#form_callback input[name="name"]').removeClass("error");
	$('#form_callback input[name="phone"]').removeClass("error");
	$('#form_callback textarea[name="message"]').removeClass("error");

	$('#form_callback input[name="name"]').val('');
	$('#form_callback input[name="phone"]').val('');
	$('#form_callback textarea[name="message"]').val('');
	$('#form_callback input[name="email_back"]').val('');
	$('#form_callback input[name="agree_personal_data"]').removeAttr("checked");
}


$(document).ready(function () {

	$('#form_callback input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_callback textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_callback input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s3 = $('#form_callback input[name="name"]').val();
		$('#form_callback input[name="name"]').removeClass("error");
		if ((s3.length < 2) || (!regname.test(s3)) || (s3.length >= 60)) {
			$('#form_callback input[name="name"]').addClass("error");
		}
	});

	$('#form_callback input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $('#form_callback input[name="phone"]').val();
		$('#form_callback input[name="phone"]').removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$('#form_callback input[name="phone"]').addClass("error");
		}
	});

	$('#form_callback textarea[name="message"]').blur(function() {
		var s4=$('#form_callback textarea[name="message"]').val();
		$('#form_callback textarea[name="message"]').removeClass("error");
		if(s4.length<2 && s4!=""){
			$('#form_callback textarea[name="message"]').addClass("error");
		}
	});



	$("#form_callback").submit(function () {
		return false;
	});

	$('#form_callback button').on("click", function () {

		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var valid = false;


		$('#form_callback input[name="name"]').removeClass("error");
		$('#form_callback input[name="phone"]').removeClass("error");
		$('#form_callback textarea[name="message"]').removeClass("error");

		var s1 = $('#form_callback input[name="name"]').val();
		var s2 = $('#form_callback input[name="phone"]').val();
		var s3 = $('#form_callback input[name="email_back"]').val();
		var s4 = $('#form_callback textarea[name="message"]').val();
		var s5 = $('#form_callback input[name="type_form"]').val();
		var s6 = $('#form_callback input[name="agree_personal_data"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length >= 6) && (regphone.test(s2)) && (s2.length < 30)) && (s3.length === 0) && ((s4.length>2) || (s4==""))) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				$('#form_callback input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				$('#form_callback input[name="phone"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#callback .uk-modal-dialog > h2').html("Спам!!!");
			}

			if(s4.length<2 && s4!=""){
				$('#form_callback textarea[name="message"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = '&name=' + s1 + '&phone=' + s2 + '&email_back=' + s3 + '&message='+s4+'&type_form=' + s5 + '&agree_personal_data=' + s6;
			var a_url = $('#form_callback').attr('action');
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
			$("#callback .uk-modal-close").trigger('click');
			var error_text = "<span style='color: red;'>Ошибка ";
			error_text = error_text + xhr + "К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже";
			sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
		},
		success: function (response) {
			switch (response) {
				case "yes":
					dataLayer.push({'event': 'form_sent'});
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
				$("#callback .uk-modal-close").trigger('click');
			},5000);
		}
	});
}

/*form form_answer (Задать вопрос)*/

$(document).ready(function () {
	$('#answer .uk-modal-close').click(function () {
		clos_clear_answer();
	});
});

function clos_clear_answer() {
	$('#form_answer input[name="name"]').removeClass("error");
	$('#form_answer input[name="email"]').removeClass("error");
	$('#form_answer textarea[name="message"]').removeClass("error");

	$('#form_answer input[name="name"]').val('');
	$('#form_answer input[name="email"]').val('');
	$('#form_answer textarea[name="message"]').val('');
	$('#form_answer input[name="email_back"]').val('');
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
		var s1 = $('#form_answer input[name="name"]').val();
		$('#form_answer input[name="name"]').removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$('#form_answer input[name="name"]').addClass("error");
		}
	});

	$('#form_answer input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$('#form_answer input[name="email"]').val();
		$('#form_answer input[name="email"]').removeClass("error");
		if(!regmail.test(s3)){
			$('#form_answer input[name="email"]').addClass("error");
		}
	});

	$('#form_answer textarea[name="message"]').blur(function() {
		var s4=$('#form_answer textarea[name="message"]').val();
		$('#form_answer textarea[name="message"]').removeClass("error");
		if(s4.length<2){
			$('#form_answer textarea[name="message"]').addClass("error");
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
					dataLayer.push({'event': 'form_sent'});
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

$(document).ready(function () {
	$('#review .uk-modal-close').click(function () {
		clos_clear_review();
	});
});

function clos_clear_review() {
	$('#form_review input[name="name"]').removeClass("error");
	$('#form_review input[name="email"]').removeClass("error");
	$('#form_review textarea[name="message"]').removeClass("error");

	$('#form_review input[name="name"]').val('');
	$('#form_review input[name="email"]').val('');
	$('#form_review textarea[name="message"]').val('');
	$('#form_review input[name="email_back"]').val('');
}


$(document).ready(function () {

	$('#form_review input').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_review textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_review input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $('#form_review input[name="name"]').val();
		$('#form_review input[name="name"]').removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$('#form_review input[name="name"]').addClass("error");
		}
	});

	$('#form_review input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$('#form_review input[name="email"]').val();
		$('#form_review input[name="email"]').removeClass("error");
		if(!regmail.test(s3)){
			$('#form_review input[name="email"]').addClass("error");
		}
	});

	$('#form_review textarea[name="message"]').blur(function() {
		var s4=$('#form_review textarea[name="message"]').val();
		$('#form_review textarea[name="message"]').removeClass("error");
		if(s4.length<2){
			$('#form_review textarea[name="message"]').addClass("error");
		}
	});



	$("#form_review").submit(function () {
		return false;
	});

	$('#form_review button').on("click", function () {

		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var valid = false;


		$('#form_review input[name="name"]').removeClass("error");
		$('#form_review input[name="email"]').removeClass("error");
		$('#form_review textarea[name="message"]').removeClass("error");

		var s1 = $('#form_review input[name="name"]').val();
		var s2 = $('#form_review input[name="email"]').val();
		var s3 = $('#form_review input[name="email_back"]').val();
		var s4 = $('#form_review textarea[name="message"]').val();
		var s5 = $('#form_review input[name="type_form"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && (regmail.test(s2)) && (s3.length === 0) && (s4.length>2)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				$('#form_review input[name="name"]').addClass("error");
			}

			if (!regmail.test(s2)) {
				$('#form_review input[name="email"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#review .uk-modal-dialog > h2').html("Спам!!!");
			}

			if(s4.length<2){
				$('#form_review textarea[name="message"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = '&name=' + s1 + '&email=' + s2 + '&email_back=' + s3 + '&message='+s4+'&type_form=' + s5;
			var a_url = $('#form_review').attr('action');
			form_review_ajax(z, a_url);
		}
	});
});

function form_review_ajax(val, url_ajax) {
	$.ajax({
		type: "POST",
		url: url_ajax,
		data: val,
		error: function (xhr) {
			$("#review .uk-modal-close").trigger('click');
			var error_text = "<span style='color: red;'>Ошибка ";
			error_text = error_text + xhr + "К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже";
			sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
		},
		success: function (response) {
			switch (response) {
				case "yes":
					dataLayer.push({'event': 'form_sent'});
					sweetAlert({title:"Успешная отправка",text:"Спасибо, ваше сообщение отправлено. После проверки модератором ваш отзвыв будет добавлен на сайт",type:"success",timer:5000});
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
				$("#review .uk-modal-close").trigger('click');
			},5000);
		}
	});
}

/*form form_modal_service (Всплывающая форма заказать услугу)*/

$(document).ready(function () {
	$('#service .uk-modal-close').click(function () {
		clos_clear_service();
	});
	$('a[href="#service"]').click(function () {
		var serw_name = $(this).data('service');
		$('#form_service input[name="name_service"]').val(serw_name);
	});
});

function clos_clear_service() {
	var form_select = $('#form_service');
	form_select.find('input,textarea').removeClass("error");
	form_select.find('input[type="text"]').val('');
	form_select.find('textarea').val('');
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

	$('#form_service input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$(this).val();
		$(this).removeClass("error");
		if(!regmail.test(s3) && s3!=''){
			$(this).addClass("error");
		}
	});


	$('#form_service textarea[name="message"]').blur(function() {
		var s5=$('#form_service textarea[name="message"]').val();
		$('#form_service textarea[name="message"]').removeClass("error");
		if(s5.length<2 && s5!=''){
			$('#form_service textarea[name="message"]').addClass("error");
		}
	});


	$('#form_service').submit(function (event) {
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

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (s3.length === 0) && (s4.length>2 || s4=='') && (regmail.test(s5) || s5=='')) {
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

			if (s4.length <=2 && s4!='') {
				form_select.find('textarea[name="message"]').addClass("error");
			}

			if(!regmail.test(s5) && s5!=''){
				$('#form_service input[name="email"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = form_select.serialize();
			var a_url = form_select.attr('action');
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
			ajax_success(response);
			setTimeout(function () {
				$("#service .uk-modal-close").trigger('click');
			},5000);
		}
	});
}

/*form form_modal_product (Всплывающая форма заказать товар)*/

$(document).ready(function () {
	$('#product .uk-modal-close').click(function () {
		clos_clear_product();
	});
	$('.primary-button[href="#product"]').click(function () {
		var serw_name = $('.primary-button[href="#product"]').data('product');
		$('#form_product input[name="name_product"]').val(serw_name);
	});
});

function clos_clear_product() {
	$('#form_product input[name="name"]').removeClass("error");
	$('#form_product input[name="phone"]').removeClass("error");
	$('#form_product input[name="calltime_from"]').removeClass("error");
	$('#form_product input[name="calltime_before"]').removeClass("error");
	$('#form_product textarea[name="message"]').removeClass("error");

	$('#form_product input[name="name"]').val('');
	$('#form_product input[name="phone"]').val('');
	$('#form_product input[name="calltime_from"]').val('');
	$('#form_product input[name="calltime_before"]').val('');
	$('#form_product textarea[name="message"]').val('');
	$('#form_product input[name="email_back"]').val('');
	$('#form_product input[name="name_product"]').val('');
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
		var s1 = $('#form_product input[name="name"]').val();
		$('#form_product input[name="name"]').removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$('#form_product input[name="name"]').addClass("error");
		}
	});

	$('#form_product input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $('#form_product input[name="phone"]').val();
		$('#form_product input[name="phone"]').removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$('#form_product input[name="phone"]').addClass("error");
		}
	});

	$('#form_product input[name="calltime_from"]').blur(function() {
		var s3=$('#form_product input[name="calltime_from"]').val();
		$('#form_product input[name="calltime_from"]').removeClass("error");
		if(s3.length<4){
			$('#form_product input[name="calltime_from"]').addClass("error");
		}
	});

	$('#form_product input[name="calltime_before"]').blur(function() {
		var s4=$('#form_product input[name="calltime_before"]').val();
		$('#form_product input[name="calltime_before"]').removeClass("error");
		if(s4.length<4){
			$('#form_product input[name="calltime_before"]').addClass("error");
		}
	});

	$('#form_product textarea[name="message"]').blur(function() {
		var s5=$('#form_product textarea[name="message"]').val();
		$('#form_product textarea[name="message"]').removeClass("error");
		if(s5.length<2){
			$('#form_product textarea[name="message"]').addClass("error");
		}
	});

	$("#form_product").submit(function () {
		return false;
	});

	$('#form_product button').on("click", function () {

		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var valid = false;


		$('#form_product input[name="name"]').removeClass("error");
		$('#form_product input[name="phone"]').removeClass("error");
		$('#form_product input[name="calltime_from"]').removeClass("error");
		$('#form_product input[name="calltime_before"]').removeClass("error");
		$('#form_product textarea[name="message"]').removeClass("error");

		var s1 = $('#form_product input[name="name"]').val();
		var s2 = $('#form_product input[name="phone"]').val();
		var s3 = $('#form_product input[name="email_back"]').val();
		var s4 = $('#form_product textarea[name="message"]').val();
		var s5 = $('#form_product input[name="calltime_from"]').val();
		var s6 = $('#form_product input[name="calltime_before"]').val();
		var s7 = $('#form_product input[name="type_form"]').val();
		var s8 = $('#form_product input[name="name_product"]').val();

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (s3.length === 0) && (s4.length>2) && (s5.length>=4) && (s6.length>=4)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				$('#form_product input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				$('#form_product input[name="phone"]').addClass("error");
			}

			if (s3.length !== 0) {
				$('#product h2').html("Спам!!!");
			}

			if (s4.length <=2) {
				$('#form_product textarea[name="message"]').addClass("error");
			}

			if (s5.length < 4) {
				$('#form_product input[name="calltime_from"]').addClass("error");
			}

			if (s6.length < 4) {
				$('#form_product input[name="calltime_before"]').addClass("error");
			}
		}
		if (valid === true) {
			var z = '&name='+s1+'&phone='+s2+'&email_back='+s3+'&message='+s4+'&calltime_from='+s5+'&calltime_before='+s6+'&type_form='+s7+'&name_product='+s8;
			var a_url = $('#form_product').attr('action');
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
			$("#product .uk-modal-close").trigger('click');
			var error_text = "<span style='color: red;'>Ошибка ";
			error_text = error_text + xhr + "К сожалению, при отправке сообщения возникли проблемы. Попробуйте отправить позже";
			sweetAlert({title:"Ошибка",text:error_text,type:"error",timer:5000});
		},
		success: function (response) {
			switch (response) {
				case "yes":
					dataLayer.push({'event': 'form_sent'});
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
				$("#product .uk-modal-close").trigger('click');
			},5000);
		}
	});
}

/*Added Rising13*/
function clos_clear_form_products_form() {
	$('#form_products_form input,#form_products_form textarea').removeClass("error");

	$('#form_products_form input[name="name"]').val('');
	$('#form_products_form input[name="phone"]').val('');
	$('#form_products_form input[name="email"]').val('');
	$('#form_products_form input[name="service"]').val('');
	$('#form_products_form input[name="email_back"]').val('');
	$('#form_products_form textarea[name="message"]').val('');
	$('#form_products_form input[name="personal_yes"]').prop('checked',false);
	$('#form_products_form input[name="personal_yes"]').removeClass('active');
}


$(document).ready(function () {
	var personal_yes_val = $('#form_products_form input[name="personal_yes"]').prop('checked');

	if(!personal_yes_val){
		$('.feedback-form__submit').prop('disabled',true);
	}else{
		$('.feedback-form__submit').prop('disabled',false);
	}


	$('#form_products_form input,#form_products_form textarea').focus(function () {
		$(this).removeClass("error");
	});

	$('#form_products_form input[name="name"]').blur(function () {
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var s1 = $('#form_products_form input[name="name"]').val();
		$('#form_products_form input[name="name"]').removeClass("error");
		if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
			$('#form_products_form input[name="name"]').addClass("error");
		}
	});

	$('#form_products_form input[name="phone"]').blur(function () {
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var s2 = $('#form_products_form input[name="phone"]').val();
		$('#form_products_form input[name="phone"]').removeClass("error");
		if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
			$('#form_products_form input[name="phone"]').addClass("error");
		}
	});

	$('#form_products_form input[name="email"]').blur(function() {
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var s3=$('#form_products_form input[name="email"]').val();
		$('#form_products_form input[name="email"]').removeClass("error");
		if(!regmail.test(s3) && s3!=""){
			$('#form_products_form input[name="email"]').addClass("error");
		}
	});

	$('#form_products_form textarea[name="message"]').blur(function() {
		var s4=$('#form_products_form textarea[name="message"]').val();
		$('#form_products_form textarea[name="message"]').removeClass("error");
		if(s4.length<2 && s4!=""){
			$('#form_products_form textarea[name="message"]').addClass("error");
		}
	});

	$('#form_products_form input[name="service"]').blur(function() {
		var s5=$('#form_products_form input[name="service"]').val();
		$('#form_products_form input[name="service"]').removeClass("error");
		if(((s5.length < 2) || (s5.length >= 200)) && s5!=""){
			$('#form_products_form input[name="service"]').addClass("error");
		}
	});

	$(document).on('change', 'input[name="personal_yes"]', function () {
		var personal_yes_val2 = $('#form_products_form input[name="personal_yes"]').prop('checked');
		if(personal_yes_val2){
			$('.feedback-form__submit').prop('disabled',false);
		}else{
			$('.feedback-form__submit').prop('disabled',true);
		}
	});

	$('#form_products_form').submit(function (event) {
		event.preventDefault();
		var regphone = /(\+)?([-\._\(\) ]?[\d]{2,20}[-\._\(\) ]?){2,10}/;
		var regname = /^[а-яА-ЯёЁa-zA-Z -]+$/;
		var regmail=/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/;
		var valid = false;


		$('#form_products_form input,#form_products_form textarea').removeClass("error");

		var s1 = $('#form_products_form input[name="name"]').val();
		var s2 = $('#form_products_form input[name="phone"]').val();
		var s3 = $('#form_products_form input[name="email"]').val();
		var s4 = $('#form_products_form input[name="service"]').val();
		var s5 = $('#form_products_form textarea[name="message"]').val();
		var s6 = $('#form_products_form input[name="email_back"]').val();
		var s7 = $('#form_products_form input[name="type_form"]').val();
		var s8 = $('#form_products_form input[name="personal_yes"]').prop('checked');

		if (((s1.length >= 2) && (regname.test(s1)) && (s1.length < 60)) && ((s2.length>=6) && (regphone.test(s2)) && (s2.length<30)) && (regmail.test(s3) || s3=="") && (((s4.length > 2) && (s4.length <= 200)) || s4=="") && ((s5.length >= 2) || (s5.length === 0)) && (s6.length === 0) && (s8!="undefined" && s8)) {
			valid = true;
		} else {
			if ((s1.length < 2) || (!regname.test(s1)) || (s1.length >= 60)) {
				$('#form_products_form input[name="name"]').addClass("error");
			}

			if ((s2.length < 6) || (!regphone.test(s2)) || (s2.length >= 30)) {
				$('#form_products_form input[name="phone"]').addClass("error");
			}

			if (!regmail.test(s3) && s3!="") {
				$('#form_products_form input[name="email"]').addClass("error");
			}

			if ((s4.length < 2)&&(s4.length!==0)){
				$('#form_products_form input[name="service"]').addClass("error");
			}

			if ((s5.length < 2)&&(s5.length!==0)){
				$('#form_products_form textarea[name="message"]').addClass("error");
			}

			if (s6.length !== 0) {
				$('.contacts-title').html("Спам!!!");
			}

			if (s8=="undefined" && !s8) {
				$('.contact-page-feedback-form').html("Спам!!!");
			}
		}
		if (valid === true) {
			var z = '&name='+s1+'&phone='+s2+'&email='+s3+'&service='+s4+'&message='+s5+'&email_back='+s6+'&type_form='+s7+'&personal_yes='+s8;
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
			dataLayer.push({'event': 'form_sent'});
			setTimeout(function () {
				clos_clear_form_products_form();
			},5000);
		}
	});
}