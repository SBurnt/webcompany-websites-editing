<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<style>
   ul.radio  {
    width:130px;
  }
</style> 
<form id="review_form" method="post">
   
           
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
	
		<br><br>
		<input type="submit" name="submit_review" class="button medium" value="Отправить">
</form>