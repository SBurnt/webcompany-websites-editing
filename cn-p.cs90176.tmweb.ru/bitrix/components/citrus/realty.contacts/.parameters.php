<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!\Bitrix\Main\Loader::includeModule("citrus.arealty"))
	return;

$arComponentParameters = array(
	'GROUPS' => array(
	),
	'PARAMETERS' => array(
		'OFFICE' => array(
			'NAME' => GetMessage("CITRUS_REALTY_OFFICE"),
			'TYPE' => 'LIST',
			'DEFAULT' => "",
			'PARENT' => 'BASE',
			'VALUES' => \Citrus\Arealty\Helper::getOfficesDropdownList(),
			'ADDITIONAL_VALUES' => 'Y',
		),
	),
);
?>