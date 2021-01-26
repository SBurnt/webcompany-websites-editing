<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CitrusArealtyCatalogSectionComponent $component Tekushtiy vizvanniy komponent */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */
/** @var array $arResult Massiv rezulytatov raboti komponenta */
/** @var array $arParams Massiv vhodyashtih parametrov komponenta, mozhet ispolyzovatysya dlya ucheta zadannih parametrov pri vivode shablona (naprimer, otobrazhenii detalynih izobrazheniy ili ssilok). */
/** @var string $templateFile Puty k shablonu otnositelyno kornya sayta, naprimer /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName Imya shablona komponenta (naprimer: .default) */
/** @var string $templateFolder Puty k papke s shablonom ot DOCUMENT_ROOT (naprimer /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData Massiv dlya zapisi, obratite vnimanie, takim obrazom mozhno peredaty dannie iz template.php v fayl component_epilog.php, prichem eti dannie popadayut v kesh, t.k. fayl component_epilog.php ispolnyaetsya na kazhdom hite */
/** @var string $parentTemplateFolder Papka roditelyskogo shablona. Dlya podklyucheniya dopolnitelynih izobrazheniy ili skriptov (resursov) udobno ispolyzovaty etu peremennuyu. Ee nuzhno vstavlyaty dlya formirovaniya polnogo puti otnositelyno papki shablona */
/** @var string $componentPath Puty k papke s komponentom ot DOCUMENT_ROOT (napr. /bitrix/components/bitrix/iblock.list) */

$this->setFrameMode(true);

if (!empty($arParams['VIEW_TARGET']))
{
	$this->SetViewTarget($arParams['VIEW_TARGET']);
}

$APPLICATION->IncludeComponent(
	'bitrix:catalog.section.list',
	$templateName,
	$arParams,
	$component
);
