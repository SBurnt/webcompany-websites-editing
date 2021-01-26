<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$brand_id = intval($arParams['BRAND_ID']); if (!$brand_id) $brand_id=-1;
CModule::IncludeModule('iblock');
//get items by brand id group by section
$res = CIBlockElement::GetList(
    array('RAND'=>'ASC'),
    array(
        'IBLOCK_ID'=>$arParams['IBLOCK_ID'],
        'ACTIVE' => 'Y',
        'PROPERTY_BRAND_IBLOCK' => $brand_id
    ),
    false, false, array('IBLOCK_SECTION_ID', 'DETAIL_PICTURE', 'PROPERTY_BRAND','PROPERTY_BRAND_IBLOCK')
);
$arResult['SECTIONS'] = array();
while ($r = $res->Fetch()) {
    $arResult['SECTIONS'][$r['IBLOCK_SECTION_ID']] = $r['DETAIL_PICTURE'];
    $arResult['BRAND'][$r['PROPERTY_BRAND_IBLOCK_VALUE']] = $r['PROPERTY_BRAND_IBLOCK_VALUE'];
}
if (count($arResult['SECTIONS'])) {
    //get section info
    $res = CIBlockSection::GetList(
        array('ID'=>'ASC'),
        array(
            'IBLOCK_ID'=>$arParams['IBLOCK_ID'],
            'ID' => array_keys($arResult['SECTIONS'])
        )
    );
    while ($r = $res->GetNext()) {
        $arResult['SECT'][$r['ID']] = $r;
    }
    $res = CIBlockProperty::GetList(Array("ID"=>"ASC"), Array("IBLOCK_ID"=>$arParams['IBLOCK_ID'], 'CODE'=>'BRAND_IBLOCK'))->Fetch();
    $pid = intval($res['ID']);
    foreach ($arResult['BRAND'] as $key) {
        $key = htmlspecialcharsbx($key);
        $arResult['FILTER_ar'][] = htmlspecialcharsbx("arrFilter_".$pid."_".abs(crc32($key)).'=Y');
    }
    $arResult['FILTER'] = '?' . join('&', $arResult['FILTER_ar']) . '&set_filter=Y';
}