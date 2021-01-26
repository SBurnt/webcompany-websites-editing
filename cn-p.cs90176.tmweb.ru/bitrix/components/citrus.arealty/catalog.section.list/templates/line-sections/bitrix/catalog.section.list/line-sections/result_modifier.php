<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams Parametri, chtenie, izmenenie. Ne zatragivaet odnoimenniy chlen komponenta, no izmeneniya tut vliyayut na $arParams v fayle template.php. */
/** @var array $arResult Rezulytat, chtenie/izmenenie. Zatragivaet odnoimenniy chlen klassa komponenta. */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */

array_walk($arResult['SECTIONS'], function (&$arSection) use ($arParams) {
	$arSection['IS_ACTIVE'] = in_array($arParams['ACTIVE_SECTION'], [$arSection['CODE'], $arSection['ID']], true);
});

if (isset($arParams['FILTER_IDS']) && is_array($arParams['FILTER_IDS']))
{
	$arParams['FILTER_IDS'] = array_filter(array_map(function ($id) {
		return $id > 0 ? (int)$id : null;
	}, $arParams['FILTER_IDS']));

	$arResult['SECTIONS'] = array_filter($arResult['SECTIONS'], function ($s) use ($arParams) {
		return in_array($s['ID'], $arParams['FILTER_IDS']);
	});
}

/**
 * Podschet kolichestva elementov tolyko iz ukazannih (pod)razdelov
 */
if (isset($arParams['COUNT_ELEMENTS_FROM_IDS']) && is_array($arParams['COUNT_ELEMENTS_FROM_IDS']))
{
	$arParams['COUNT_ELEMENTS_FROM_IDS'] = array_filter(array_map(function ($id) {
		return $id > 0 ? (int)$id : null;
	}, $arParams['COUNT_ELEMENTS_FROM_IDS']));

	$sectFilter = [
		'ID' => $arParams['COUNT_ELEMENTS_FROM_IDS'],
		'ACTIVE' => "Y",
		'GLOBAL_ACTIVE' => "Y",
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'CNT_ACTIVE' => "Y",
	];

	$rsSections = CIBlockSection::GetList(["left_margin"=>"asc"], $sectFilter, true, ['ID', 'IBLOCK_SECTION_ID', 'NAME']);
	$sectElements = [];
	while ($sect = $rsSections->Fetch())
	{
		$sectElements[$sect['IBLOCK_SECTION_ID']] += (int)$sect['ELEMENT_CNT'];
	}

	array_walk($arResult['SECTIONS'], function (&$section) use ($sectElements) {
		if (isset($sectElements[$section['ID']]))
		{
			$section['ELEMENT_CNT'] = $sectElements[$section['ID']];
		}
	});
}

if ($arParams['COUNT_ELEMENTS'] && isset($arParams['HIDE_EMPTY']) && $arParams['HIDE_EMPTY'] === 'Y')
{
	$arResult['SECTIONS'] = array_filter($arResult['SECTIONS'], function ($s) use ($arParams) {
		return $s['ELEMENT_CNT'] > 0 || $s['IS_ACTIVE'];
	});
}