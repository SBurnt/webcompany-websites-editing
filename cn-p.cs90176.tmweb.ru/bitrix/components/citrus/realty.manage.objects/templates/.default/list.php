<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

$APPLICATION->SetPageProperty('PAGE_SUBHEADER', Loc::getMessage('CITRUS_REALTY_MANAGE_OBJECTS_SUBTITLE'));

?>
<?$APPLICATION->IncludeComponent(
	"citrus:realty.manage.objects.list",
	"",
	Array(
		//"IBLOCK_SECTION_ID" => \Citrus\DemoService\SiteRequest::ACCEPTED_SECTION_ID,
		"FIELD_CODE" => $arParams["RL_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["RL_PROPERTY_CODE"],
		"FIELD_TITLES" => $arParams["RL_FIELD_TITLES"],
		"TITLE" => "",
		"DEFAULT_SORT_FIELD" => $arParams["RL_DEFAULT_SORT_FIELD"],
		"DEFAULT_SORT_ORDER" => $arParams["RL_DEFAULT_SORT_ORDER"],
		//"SITE_FILTER_PATH" => SITE_DIR . "managers/sites/?id_from=#ID#&id_to=#ID#",

		"EDIT_PATH" => CComponentEngine::makePathFromTemplate($arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["form"], $arResult["VARIABLES"]),
		"PROFILE_PATH" => CComponentEngine::makePathFromTemplate($arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["profile"], $arResult["VARIABLES"]),
		"RIGHTS_PROVIDER" => $arParams['RIGHTS_PROVIDER'],
		"RL_FILTER_FIELDS" => $arParams["RL_FILTER_FIELDS"],
		"SHOW_ALL_COUNT" => $arParams['SHOW_ALL_COUNT'],
		"ALLOW_NEW_ELEMENT" => $arParams['ALLOW_NEW_ELEMENT'],
	),
	$component
);?>
