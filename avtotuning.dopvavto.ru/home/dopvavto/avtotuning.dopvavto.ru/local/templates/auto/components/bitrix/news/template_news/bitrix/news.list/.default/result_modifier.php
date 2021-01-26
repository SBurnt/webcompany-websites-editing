<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult["ITEMS"] as $k => $arItem)
{
    if($arItem['PREVIEW_PICTURE']['ID'])
    {
        $arResult["ITEMS"][$k]['PREVIEW_280_150'] = resizeImg($arItem['PREVIEW_PICTURE']['ID'], 280, 150);
    }
}
?>
