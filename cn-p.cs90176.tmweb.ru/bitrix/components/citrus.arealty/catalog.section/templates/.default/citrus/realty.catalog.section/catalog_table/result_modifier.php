<?php

$arResult['FIELDS'] = $arParams['~UF_TABLE_COLS'] ?: \Citrus\Core\SortedProperties::getColsFrom($arResult['~UF_TABLE_COLS']);

$arResult['FIELDS'] = array_map(function($arProperty) use($arParams){

	global $APPLICATION;

	$arProperty['SORT_CODE'] = 'PROPERTY_'.(array_shift(explode('|', $arProperty['code'])));

	$arProperty['SELECTED'] = $arProperty['SORT_CODE'] === $arParams['ELEMENT_SORT_FIELD'];

	$arProperty['ORDER'] =  $arProperty['SELECTED'] && $arParams['ELEMENT_SORT_ORDER'] ? $arParams['ELEMENT_SORT_ORDER'] : 'ASC' ;

	$linkOrder = $arProperty['SELECTED'] && $arProperty['ORDER'] === 'ASC' ? 'DESC' : 'ASC';

	$arProperty['SORT_LINK'] = $APPLICATION->GetCurPageParam("sort={$arProperty['SORT_CODE']}&order={$linkOrder}", array("sort", "order"));

	return $arProperty;
}, is_array($arResult['FIELDS']) ? $arResult['FIELDS'] : []);

/**
 * Obrabotchik dlya polucheniya ssilok na detalynie stranitsi
 */
if (array_key_exists('~ON_DETAIL_URL', $arParams) && is_callable($arParams['~ON_DETAIL_URL']))
{
	$arResult['ON_DETAIL_URL'] = $arParams['~ON_DETAIL_URL'];
}
unset($arParams['ON_DETAIL_URL'], $arParams['~ON_DETAIL_URL']);