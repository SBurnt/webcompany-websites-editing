<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult['ITEMS'] as $k => $arItem)
{
    $arResult['ITEMS'][$k]['PICTURE_272_145'] = resizeImg($arItem['PREVIEW_PICTURE']['ID'], 272, 145);
}
?>
