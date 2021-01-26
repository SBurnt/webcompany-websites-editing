<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
foreach ($arResult['ITEMS'] as &$arElement)
{
	if(is_array($arElement["DETAIL_PICTURE"]))
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array("name" => "sharpen", "precision" => $arParams["SHARPEN"]);
		}

		$arFileTmp = CFile::ResizeImageGet(
			$arElement['DETAIL_PICTURE'],
			array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, $arFilter
		);

		$arElement["PREVIEW_IMG"] = array(
			"SRC" => $arFileTmp["src"],
			'WIDTH' => $arFileTmp["width"],
			'HEIGHT' => $arFileTmp["height"],
		);
	}
}

/*SKU -- */
$basePriceType = CCatalogGroup::GetBaseGroup();
$basePriceTypeName = $basePriceType["NAME"];

/* -- SKU */
$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
$arNotify = unserialize($notifyOption);
$section_ids = array();

foreach($arResult["ITEMS"] as &$arElement)
{
	$arElement["DELETE_COMPARE_URL"] = htmlspecialcharsbx($APPLICATION->GetCurPageParam("action=DELETE_FROM_COMPARE_LIST&id=".$arElement["ID"], array("action", "id")));

	//prices
	$arElement['2PRICES'] = array();
	$min_price = array(PHP_INT_MAX, PHP_INT_MAX, '');
	foreach ($arParams['MAIN_PRICES'] as $code) {
		$price = $arElement['PRICES'][$code];
		//DISCOUNT_VALUE or VALUE
		if ($price["CAN_ACCESS"] == 'Y' && $price["CAN_BUY"] == 'Y' && ($price['VALUE'] < $min_price[0] || $price['DISCOUNT_VALUE'] < $min_price[1])) {
			$min_price[0] = $price['VALUE'];
			$min_price[1] = $price['DISCOUNT_VALUE'];
			$min_price[2] = $code;
		}
	}
	$arElement['2PRICES']['main'] = $arElement['PRICES'][$min_price[2]];
	$arElement['2PRICES']['main']['CODE'] = $min_price[2];

	$min_price = array(PHP_INT_MAX, PHP_INT_MAX, '');
	foreach ($arParams['OTHER_PRICES'] as $code) {
		$price = $arElement['PRICES'][$code];
		//DISCOUNT_VALUE or VALUE
		if ($price["CAN_ACCESS"] == 'Y' && ($price['VALUE'] < $min_price[0] || $price['DISCOUNT_VALUE'] < $min_price[1])) {
			$min_price[0] = $price['VALUE'];
			$min_price[1] = $price['DISCOUNT_VALUE'];
			$min_price[2] = $code;
		}
	}
	$arElement['2PRICES']['other'] = $arElement['PRICES'][$min_price[2]];
	$arElement['2PRICES']['other']['CODE'] = $min_price[2];

	$arElement['CAN_BUY'] = ($arElement['CATALOG_QUANTITY'] > 0);
	$sid = intval($arElement['IBLOCK_SECTION_ID']);
	$section_ids[$sid] = $sid;
	if (count($arElement['OFFERS'])) {
		include dirname(__FILE__).'/../../../../../../bitrix/catalog.section/_offer_logic.php';
	}
}
unset($arElement);

$arResult['SECTIONS'] = array();
if (count($section_ids)) {
	$res = CIBlockSection::GetList(
		array('ID'=>'ASC'),
		array("IBLOCK_ID" => $arParams["IBLOCK_ID"],"ID" => $section_ids),
		false,
		array("ID", "DEPTH_LEVEL", "SECTION_PAGE_URL", "UF_USE_COUNT")
	);
	while ($r = $res->Fetch()) {
		$arResult['SECTIONS'][$r['ID']] = $r;
	}
}
// cache hack to use items list in component_epilog.php
$this->__component->arResult["IDS"] = array();
$this->__component->arResult["DELETE_COMPARE_URLS"] = array();
//$this->__component->arResult["OFFERS_IDS"] = array();

if(isset($arParams["DETAIL_URL"]) && strlen($arParams["DETAIL_URL"]) > 0)
	$urlTemplate = $arParams["DETAIL_URL"];
else
	$urlTemplate = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "DETAIL_PAGE_URL");

//2 Sections subtree
$arSections = array();
$rsSections = CIBlockSection::GetList(
	array(),
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"LEFT_MARGIN" => $arResult["LEFT_MARGIN"],
		"RIGHT_MARGIN" => $arResult["RIGHT_MARGIN"],
	),
	false,
	array("ID", "DEPTH_LEVEL", "SECTION_PAGE_URL")
);

while($arSection = $rsSections->Fetch())
	$arSections[$arSection["ID"]] = $arSection;

foreach ($arResult["ITEMS"] as $key => $arElement)
{
	$this->__component->arResult["IDS"][] = $arElement["ID"];
	$this->__component->arResult["DELETE_COMPARE_URLS"][$arElement["ID"]] = $arElement["DELETE_COMPARE_URL"];
	/*if(is_array($arElement["OFFERS"]) && !empty($arElement["OFFERS"])){
		foreach($arElement["OFFERS"] as $arOffer){
			$this->__component->arResult["OFFERS_IDS"][] = $arOffer["ID"];
		}
	}    */

	if(is_array($arElement["DETAIL_PICTURE"]))
	{
		$arFilter = '';
		if($arParams["SHARPEN"] != 0)
		{
			$arFilter = array("name" => "sharpen", "precision" => $arParams["SHARPEN"]);
		}
		$arFileTmp = CFile::ResizeImageGet(
			$arElement["DETAIL_PICTURE"],
			array("width" => $arParams["DISPLAY_IMG_WIDTH"], "height" => $arParams["DISPLAY_IMG_HEIGHT"]),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true, $arFilter
		);

		$arResult["ITEMS"][$key]["PREVIEW_IMG"] = array(
			"SRC" => $arFileTmp["src"],
			'WIDTH' => $arFileTmp["width"],
			'HEIGHT' => $arFileTmp["height"],
		);
	}

	$section_id = $arElement["~IBLOCK_SECTION_ID"];

	if(array_key_exists($section_id, $arSections))
	{
		$urlSection = str_replace(
			array("#SECTION_ID#", "#SECTION_CODE#"),
			array($arSections[$section_id]["ID"], $arSections[$section_id]["CODE"]),
			$urlTemplate
		);

		$arResult["ITEMS"][$key]["DETAIL_PAGE_URL"] = CIBlock::ReplaceDetailUrl(
			$urlSection,
			$arElement,
			true,
			"E"
		);
	}

}

$this->__component->SetResultCacheKeys(array("IDS"));
$this->__component->SetResultCacheKeys(array("DELETE_COMPARE_URLS"));
//$this->__component->SetResultCacheKeys(array("OFFERS_IDS"));
?>