<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams Parametri, chtenie/izmenenie ne zatragivaet odnoimenniy chlen komponenta. */
/** @var array $arResult Rezulytat, chtenie/izmenenie ne zatragivaet odnoimenniy chlen klassa komponenta. */
/** @var string $componentPath Puty k papke s komponentom ot DOCUMENT_ROOT (naprimer /bitrix/components/bitrix/iblock.list). */
/** @var CBitrixComponent $component Ssilka na $this. */
/** @var CBitrixComponent $this Ssilka na tekushtiy vizvanniy komponent, mozhno ispolyzovaty vse metodi klassa. */
/** @var string $epilogFile Puty k faylu component_epilog.php otnositelyno DOCUMENT_ROOT */
/** @var string $templateName Imya shablona komponenta (naprimer: .default) */
/** @var string $templateFile Puty k faylu shablona ot DOCUMENT_ROOT (napr. /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateFolder Puty k papke s shablonom ot DOCUMENT_ROOT (napr. /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData Obratite vnimanie, takim obrazom mozhno peredaty dannie iz template.php v fayl component_epilog.php, prichem eti dannie zakeshiruyutsya i budut dostupni v component_epilog.php na kazhdom hite */
/** @var \CMain $APPLICATION */

if ($arParams['SHOW_BANK_LOGOS'])
{
    $APPLICATION->AddViewContent('addTitle', ' <img src="' . $templateFolder .'/assets/banks.png" class="ipoteka-banks">');
}