<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$APPLICATION->SetPageProperty("PAGE_SUBHEADER", "");

$arVariables = $arResult["VARIABLES"];
unset($arVariables["ID"]);

if (empty($arParams['SEF_URL_TEMPLATES']['catalog']))
{
	$offersPath = '';
	$draftEnabled = 'N';
}
else
{
	$offersPath = trim(SITE_DIR, '/') . $arParams['SEF_URL_TEMPLATES']['catalog'];
	if (substr($offersPath, 0, 1) != '/')
	{
		$offersPath = '/' . $offersPath;
	}
	$draftEnabled = 'Y';
}

?>
<?$APPLICATION->IncludeComponent(
	"citrus:realty.manage.objects.form",
	"",
	Array(
		"ID" => $arResult["VARIABLES"]["ID"],
		//"PARENT_SECTION_ID" => $arResult["VARIABLES"]["GROUP_ID"],
		"FIELD_TITLES" => $arParams["~RF_FIELD_TITLES"],
		"FIELD_CODE" => $arParams["RF_FIELD_CODE"],
		"PROPERTY_CODE" => $arParams["RF_PROPERTY_CODE"],
		"USE_HTML_EDITOR" => $arParams["USE_HTML_EDITOR"],
		//"ALLOW_NEW_ELEMENT" => $arParams["TF_ALLOW_NEW_ELEMENT"],
		"SET_TITLE" => "Y", //$arParams["SET_TITLE"],
		"TITLE" => $arParams["RF_TITLE"],
		"CHAIN_ITEMS" => array(),
		"ADD_ITEM_CHAIN" => $arParams["ADD_ITEM_CHAIN"],
		"SET_STATUS_404" => $arParams["SET_STATUS_404"],

		"PROFILE_PATH" => CComponentEngine::makePathFromTemplate($arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["profile"], $arResult["VARIABLES"]),
		"LIST_PATH" => CComponentEngine::makePathFromTemplate($arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["list"], $arResult["VARIABLES"]),
		"EDIT_PATH" => CComponentEngine::makePathFromTemplate($arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["form"], $arVariables),

		'MAX_FILE_COUNT' => $arParams["RF_MAX_FILE_COUNT"],
		"RIGHTS_PROVIDER" => $arParams['RIGHTS_PROVIDER'],
		'OFFERS_PATH' => $offersPath,
		'DRAFT_ENABLED' => $draftEnabled,
	),
	$component
);
?>