<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @global CMain $APPLICATION
 */

CJSCore::Init(array('window', 'ajax', 'swiper'));
$APPLICATION->AddHeadScript('/bitrix/js/main/utils.js');
$APPLICATION->AddHeadScript('/bitrix/js/main/popup_menu.js');
$APPLICATION->AddHeadScript('/bitrix/js/main/dd.js');

$APPLICATION->SetAdditionalCSS('/bitrix/themes/.default/pubstyles.css');

$APPLICATION->SetAdditionalCSS($templateFolder.'/themes/arealty/style.css');

$currentBodyClass = $APPLICATION->GetPageProperty("BodyClass", false);
$APPLICATION->SetPageProperty("BodyClass", ($currentBodyClass ? $currentBodyClass." " : "")."flexible-layout");
