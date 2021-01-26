<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="flex__1">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if(strlen($arResult["OK_MESSAGE"]) > 0)
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
	<div class="form__name--p main_flex flex__jcontent_between mt-0">
        <p class="rg">Имя*</p>
        <input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>" required>
	</div>
    <div class="form__name--p main_flex flex__jcontent_between">
        <p class="rg">Телефон*</p>
        <input type="text" name="user_phone" value="<?=$arResult["AUTHOR_PHONE"]?>" placeholder="+___ (__) ___-__-__" required>
    </div>

	<div class="form__name--p main_flex flex__jcontent_between">
        <p class="rg">Электр. почта</p>
        <input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
	</div>

	<div class="form__name--p main_flex flex__jcontent_between">
        <p class="rg">Сообщение</p>
        <textarea name="MESSAGE" class="rg" style="height: 90px;"><?=$arResult["MESSAGE"]?></textarea>
	</div>
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
</form>
</div>