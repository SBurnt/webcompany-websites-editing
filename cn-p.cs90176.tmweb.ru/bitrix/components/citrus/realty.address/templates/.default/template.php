<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Config\Option;

/*
	 'smallMapDefaultSet';
	'mediumMapDefaultSet' (po umolchaniyu);
	'largeMapDefaultSet'.

	"rulerControl" - lineyka i masshtabniy otrezok control.RulerControl;
	"searchControl" - panely poiska control.SearchControl;
	"trafficControl" - panely probok control.TrafficControl;
	"typeSelector" - panely pereklyucheniya tipa karti control.TypeSelector;
	"zoomControl" - polzunok masshtaba control.ZoomControl;
	"geolocationControl" - element upravleniya geolokatsiey control.GeolocationControl;
	"routeEditor" - redaktor marshrutov control.RouteEditor.
 */


$mapId = $arParams['MAP_ID'];
$params = array(
	'id' => $mapId,
	'address' => $arParams['ADDRESS'],
	'header' => $arParams["~NAME"],
	'body' => empty($arParams["BODY"]) ? false : $arParams["~BODY"],
	'footer' => empty($arParams["FOOTER"]) ? false : $arParams["~FOOTER"],
	'controls' => array('smallMapDefaultSet'),
	'openBallon' => $arParams["OPEN_BALOON"],
);

$yandexMapsApiKey = Option::get('citrus.core', 'yandex_maps_api_key');
$APPLICATION->AddHeadScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU' . ($yandexMapsApiKey ? '&apikey=' . urlencode($yandexMapsApiKey) : ''));

?><div id="<?=$mapId?>" style="width: <?=$arParams['MAP_WIDTH']?>;height: <?=$arParams['MAP_HEIGHT']?>"></div><?

?>
<script type="text/javascript">
$().citrusRealtyAddress(<?=CUtil::PhpToJSObject($params)?>);
</script>
