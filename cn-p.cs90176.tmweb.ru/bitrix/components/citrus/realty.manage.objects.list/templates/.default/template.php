<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (is_set($arResult, "MESSAGE"))
	ShowMessage($arResult["MESSAGE"]);

if (is_set($arResult, "ERROR"))
	ShowError($arResult["ERROR"]);
?>

<?
if (!empty($arResult["TOOLBAR_BUTTONS"]))
{
	?><? $APPLICATION->IncludeComponent(
	"bitrix:main.interface.toolbar",
	"",
	Array(
		"BUTTONS" => $arResult["TOOLBAR_BUTTONS"],
		"TOOLBAR_ID" => $arResult["FORM_ID"] . "_toolbar",
	),
	false
); ?><?
}
?>

<?$APPLICATION->IncludeComponent(
	"citrus:main.interface.grid",
	"",
	Array(
		"GRID_ID" => $arResult["GRID_ID"],
		"HEADERS" => $arResult["COLUMNS"],
		"ROWS" => $arResult["DATA"],
		"FOOTER" => Array(Array('title' => GetMessage("CITRUS_AREALTY_MANAGE_OBJECTS_LIST_ALL"), 'value' => $arResult["TOTAL_CNT"])),
		"EDITABLE" => 'Y',
		"NAV_OBJECT" => $arResult["NAV_OBJECT"],
		"SORT" => Array(
			$arResult["SORT"]['by'] => $arResult["SORT"]['order'],
		),
//		"ACTION_ALL_ROWS" => "Y",
		"ACTIONS" => $arResult["ACTIONS"],
        'FILTER' => $arResult["FILTER"],
		'SHOW_ALL_COUNT' => $arParams['SHOW_ALL_COUNT']
	),
	false
);?>
