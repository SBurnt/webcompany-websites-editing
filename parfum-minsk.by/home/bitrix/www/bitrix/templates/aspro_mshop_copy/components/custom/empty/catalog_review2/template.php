<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><script>
    $(function(){
        $('#review_form').submit(function(){
            var err = false;
            $(this).find('.required').each(function(){
                if (!$(this).val()) {$(this).addClass('error'); err=true;}
                else $(this).removeClass('error');
            });
            if (!err) {
                $.post(SITE_DIR() + 'ajax/addReview2.php', $(this).serialize(), function(data){
                    if (data != 'OK') alert(data);
                    else{
                        alert('<?=GetMessage("ASTDESIGN_CLIMATE_THANK_YOU")?>');
                        location.reload();
                    }
                })
            }
            return false;
        })
    })
</script>
<style>
   ul.radio  {
    width:130px;
  }
</style> 
<form id="review_form" method="post">
   
           <ul class="radio">
                <li> <input type="radio" name="rate" value="1"><br/><span>1</span></li>
                <li> <input type="radio" name="rate" value="2"><br/><span>2</span></li>
                <li> <input type="radio" name="rate" value="3"><br/><span>3</span></li>
                <li> <input type="radio" name="rate" value="4"><br/><span>4</span></li>
                <li> <input type="radio" name="rate" value="5"><br/><span>5</span></li>

            </ul>
            <div class="form-comment">
                <div class="control control_1-2">
                    <label>Имя*</label>
                    <input name="name" type="text">
                </div>
                <div class="control control_1-2 right" style="margin:0px!important;">
                    <label>Email*</label>
                    <input name="email" type="text">
                </div>
                <div class="control">
                    <label>Отзыв*</label>
                    <textarea name="review" rows="10"></textarea>
                </div>
                
            </div>
			<?global $USER; if(!$USER->IsAuthorized()):
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
		<br><br><br>
		<button  class="sub-catalog2">Отправить</button>
</form>