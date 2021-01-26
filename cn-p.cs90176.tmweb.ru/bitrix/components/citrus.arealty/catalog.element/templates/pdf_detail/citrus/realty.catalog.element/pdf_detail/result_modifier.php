<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Text\Encoding;
use Bitrix\Main\Web\Json;
use Citrus\Arealty\Object\Address;
use Citrus\Arealty;
use Citrus\Arealty\Object\GeoProperty;
use function \Citrus\Core\array_get;

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */

$this->__component->setResultCacheKeys(["DEAL_TYPE", "CONTACT", 'COMPLEX', 'OFFERS', 'OFFERS_FIELDS']);

$contactId = array_get($arResult, 'PROPERTIES.contact.VALUE');
$arResult["CONTACT"] = null;
if ($contactId)
{
	$contactDataset = CIBlockElement::GetList([],
		['IBLOCK_ID' => \Citrus\Arealty\Helper::getIblock('staff'), '=ID' => $contactId])
		->GetNextElement(true, false);
	if ($arResult["CONTACT"] = $contactDataset->GetFields())
	{
		$arResult["CONTACT"]["PROPERTIES"] = $contactDataset->GetProperties();
	}
}

if ($dealType = array_get($arResult, 'PROPERTIES.deal_type.VALUE'))
{
	$arResult['DEAL_TYPE'] = is_array($dealType) ? reset($dealType) : $dealType;
}

$arResult['ADDRESS'] = $address = Address::createFromFields($arResult);

// ubraty svoystva kotorie ne vibrani u razdela (vkladka "Svoystva elementov")
$displayProperties = array_column(\CIBlockSectionPropertyLink::GetArray(
	$arResult['IBLOCK_ID'],
	$arResult['IBLOCK_SECTION_ID']
), null, 'PROPERTY_ID');
foreach ($arResult['DISPLAY_PROPERTIES'] as $k => $v)
{
	if (!isset($displayProperties[$v['ID']]))
	{
		unset($arResult['DISPLAY_PROPERTIES'][$k]);
	}
}

$arResult['NAME'] = trim(str_replace(GeoProperty::getSeoValue($address->getGeo()), '', $arResult['NAME']), ', ');

if (array_get($arParams, 'DETAIL_DISPLAY_NUMBER', 'N') == 'Y')
{
	$arResult['NAME'] .= Loc::getMessage('CITRUS_AREALTY_DETAIL_TITLE_NUMBER', array('#NUM#' => $arResult['ID']));
}

if (!empty($arParams['IS_JK']) && $arParams['IS_JK'] == 'Y')
{
	// Svoystva obaektov dlya otobrazheniya, vibrannie v Dop. poley razdela
	$displayProperties = new Arealty\DisplayProperties($arResult['IBLOCK_ID']);
	$displayPropertiesByXmlId = [
		$arResult['XML_ID'] => $displayProperties->getForSection($arResult['IBLOCK_SECTION_ID'], $isDefault),
	];

	try
	{
		$complexService = new Arealty\ComplexService(Arealty\Helper::getIblock("offers", SITE_ID));
		$arResult['OFFERS_FIELDS'] = reset($complexService->getOfferFields(array($arResult['XML_ID']), [],
			$displayPropertiesByXmlId));
	}
	catch (\Exception $e)
	{
		ShowError($e->getMessage());
		$arResult['OFFERS_FIELDS'] = null;
	}
}
else
{
	$arResult['COMPLEX'] = array_get($arResult, 'PROPERTIES.complex.VALUE');
}

// fix data for pdf
$arResult["CONTACT"] = false;
if ($contact = is_array($arResult["PROPERTIES"]["contact"]) ? $arResult["PROPERTIES"]["contact"]["VALUE"] : false)
{
	$arResult["CONTACT"] = \Citrus\Arealty\Helper::getContactInfo($contact);
}
// esli kontakt dlya predlozheniya ne ukazan ili ne nayden, viberem perviy kontakt iz spiska, budem ispolyzovaty ego
if (!$arResult["CONTACT"])
{
	$arResult["CONTACT"] = \Citrus\Arealty\Helper::getContactInfo();
}
if (!empty($arResult['CONTACT']['PREVIEW_PICTURE']))
{
	$contactImageFile = \CFile::ResizeImageGet($arResult['CONTACT']['PREVIEW_PICTURE_ID'], [
		'width' => 200, 'height' => 200,
	], BX_RESIZE_IMAGE_EXACT, true);
	$arResult['CONTACT']['PREVIEW_PICTURE'] = $contactImageFile['src'];
}

// clear styles
$reStyles = <<<RESTYLES
{style=[\"\'][^\'\"]+[\'\"]}si
RESTYLES;
$arResult["DETAIL_TEXT"] = preg_replace($reStyles, '', $arResult["DETAIL_TEXT"]);
$arResult["PREVIEW_TEXT"] = preg_replace($reStyles, '', $arResult["PREVIEW_TEXT"]);
// TODO clear other HTML properties

$offerFields = \Citrus\Core\array_get($arResult, 'OFFERS_FIELDS.display');
if (is_array($offerFields))
{
	foreach ($arResult["OFFERS_FIELDS"]['display'] as $title => $val)
	{
		$arResult["DISPLAY_PROPERTIES"][$title] = [
			'NAME' => $title,
			'DISPLAY_VALUE' => $val,
		];
	}
}

// dannie ob ipoteke - menyaem kodirovku
if ($arParams['ADDITIONAL'])
{
	//TODO!!! pochemu to poluchaem dvoynoe ekranirovanie v parametrah i dublirovanie (~ADDITIONAL, ~~ADDITIONAL i t.p.)
	$pdfAdditionalParams = $arParams['~ADDITIONAL'];
	if (substr($pdfAdditionalParams, 0, 11) == '{&amp;quot;')
	{
		$pdfAdditionalParams = htmlspecialcharsback($pdfAdditionalParams);
	}
	if (substr($pdfAdditionalParams, 0, 7) == '{&quot;')
	{
		$pdfAdditionalParams = htmlspecialcharsback($pdfAdditionalParams);
	}
	$pdfAdditionalParams = Encoding::convertEncodingToCurrent($pdfAdditionalParams);
	$pdfAdditionalParams = Encoding::convertEncoding($pdfAdditionalParams, SITE_CHARSET, 'utf-8');
	$arParams['ADDITIONAL'] = Json::decode($pdfAdditionalParams);
}
