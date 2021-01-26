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
if($_POST['id']){
    $_SESSION['id'] = $_POST['id'];
}
$arFilter = Array("IBLOCK_ID"=>2, "ID"=>$_SESSION['id'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, array("CATALOG_GROUP_1", "NAME","PREVIEW_PICTURE", "LIST_PAGE_URL", "DETAIL_PAGE_URL"));
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
}
//pr($arFields);
?>
<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
    <div class="form__name clearfix">
        <div class="image-block">
            <img width="220px" src="<?if(CFile::GetPath($arFields["PREVIEW_PICTURE"])){echo CFile::GetPath($arFields["PREVIEW_PICTURE"]);}else{echo SITE_TEMPLATE_PATH.'/img/no_photo.png';}?>" alt="<?=$arFields["NAME"]?>">
            <p class="bd"><?=$arFields['NAME']?></p>
            <div class="rg" style="font-size: 30px;"><?=round(CCurrencyRates::ConvertCurrency($arFields['CATALOG_PRICE_1'], $arFields['CATALOG_CURRENCY_1'], "BYN"),2)?> <span style="font-size: 16px;">руб.</span></div>
        </div>
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
        <input type="hidden" name="aprod" value="<?=$arFields["LIST_PAGE_URL"].$arFields["DETAIL_PAGE_URL"]?>">
<!--        <input type="submit" name="submit" class="abs" value="Заказать">-->
        </div>
    </div>
    <input type="submit" name="submit" class="abs" value="Заказать">

</form>