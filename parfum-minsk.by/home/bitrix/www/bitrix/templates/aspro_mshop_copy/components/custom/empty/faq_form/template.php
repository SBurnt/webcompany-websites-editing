<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); global $USER;?><script>
	$(function(){
		$('#faq_form').submit(function(){
			var err = false;
			$(this).find('.required').each(function(){
				if (!$(this).val()) {$(this).addClass('error'); err=true;}
				else $(this).removeClass('error');
			});
			if (!err) {
				$.post(SITE_DIR() + 'ajax/addFaq.php', $(this).serialize(), function(data){
					if (data != 'OK') alert(data);
					else location.reload();
				})
			}
			return false;
		})
	})
</script>
<style>
	#faq_form input {width: 170px!important;margin-right:25px}
	#faq_form textarea {left:33px; width:780px!important}
</style>
<form id="faq_form" method="post">
	<h3><?=GetMessage("ASTDESIGN_CLIMATE_ZADATQ_VOPROS")?></h3>
	<label class="left"><?=GetMessage("ASTDESIGN_CLIMATE_VASE_IMA")?><span>*</span> <input class="required input" name="name" type="text" value="<?=$USER->GetFullName()?>"></label>
	<label class="left">E-mail: <span>*</span> <input class="required input" name="email" type="text" value="<?=$USER->GetEmail()?>"></label>
	<label class="left"><?=GetMessage("ASTDESIGN_CLIMATE_TELEFON")?><input class="input" name="phone" type="text" value=""></label>
	<div class="clear"></div>
	<div class="left"><?=GetMessage("ASTDESIGN_CLIMATE_VOPROS")?><span>*</span></div>
	<textarea name="question" class="required"></textarea>
	<div class="clear"></div>
	<?if(!$USER->IsAuthorized()):
		include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/captcha.php");
		$cpt = new CCaptcha();
		$captchaPass = COption::GetOptionString("main", "captcha_password", "");
		if (strlen($captchaPass) <= 0) {
			$captchaPass = randString(10);
			COption::SetOptionString("main", "captcha_password", $captchaPass);
		}
		$cpt->SetCodeCrypt($captchaPass);?>
		<br>
		<div class="left"><?=GetMessage("ASTDESIGN_CLIMATE_UKAJITE_KOD")?><span>*</span></div>
		<input type="hidden" name="captcha_code" value="<?=htmlspecialchars($cpt->GetCodeCrypt());?>">
		<div class="captcha left"><img src="/bitrix/tools/captcha.php?captcha_code=<?=htmlspecialchars($cpt->GetCodeCrypt());?>"></div>
		<input name="captcha_word" class="required captcha input" type="text">
	<?endif?>
	<div class="btn alt right"><button ><?=GetMessage("ASTDESIGN_CLIMATE_OTPRAVITQ")?></button></div>
	<div class="clear"></div>
</form>