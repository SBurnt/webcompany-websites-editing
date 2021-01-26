<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult["ITEMS"] as $k => $arItem)
{
    if($arItem['PREVIEW_PICTURE']['ID'])
    {
        $arResult["ITEMS"][$k]['PICTURE_280_150'] = resizeImg($arItem['PREVIEW_PICTURE']['ID'], 280, 150);
    }
}

// Находим прошедшие акции
$arResult['DEACTIVE_ACTIONS'] = array();
$i = 0;
$arSelect = Array("ID", "NAME", "PREVIEW_PICTURE", "PROPERTY_TIME_ACTIVE", "PROPERTY_ACTIVE", "DETAIL_PAGE_URL");
$arFilter = Array("IBLOCK_ID"=> 7, "ACTIVE"=>"Y", '!PROPERTY_ACTIVE_VALUE' => 'Да');
$res = CIBlockElement::GetList(Array('SORT' => 'DESC'), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arResult['DEACTIVE_ACTIONS'][$i] = $arFields;
    $arResult['DEACTIVE_ACTIONS'][$i]['PICTURE_280_150'] = resizeImg($arFields['PREVIEW_PICTURE'], 280, 150);
    $i++;
}
?>
