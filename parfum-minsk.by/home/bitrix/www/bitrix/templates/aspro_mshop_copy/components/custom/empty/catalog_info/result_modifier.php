<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('catalog');
$bid = intval($arParams['BRAND_ID']);
$arResult['BRAND'] = array();
if ($bid) {
	CModule::IncludeModule('iblock');
	$res = CIBlockElement::GetByID($bid)->GetNext();
	$arResult['BRAND'] = $res;
}
if ($arParams['BRAND_NAME']) $arResult['BRAND']['NAME'] = $arParams['BRAND_NAME'];
CModule::IncludeModule('sale');
$res = CSaleDelivery::GetList(array('PRICE'=>'ASC'),array("LID" => SITE_ID, 'ACTIVE'=>'Y'),false,false,array('*'));
while ($r = $res->Fetch()) $arResult['D'][] = $r;

$arResult['I'] = array();
if (is_array($arParams['SERVICE']["VALUE"]) && count($arParams['SERVICE']["VALUE"])) {
	$block_id = $arParams['SERVICE']['LINK_IBLOCK_ID'];
	$filter = array('IBLOCK_ID'=>$block_id, 'ID'=>$arParams['SERVICE']["VALUE"]);
	$res = CIBlockElement::GetList(array('NAME'=>'ASC'), $filter, false, false, array('ID','NAME','PROPERTY_PRICE','DETAIL_PAGE_URL'));
	while ($r = $res->GetNext()) $arResult['I'][$r['ID']] = $r;
}