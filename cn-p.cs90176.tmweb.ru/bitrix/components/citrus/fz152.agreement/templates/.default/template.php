<?php

use Bitrix\Main\Localization\Loc;

/** @var CBitrixComponent $component Tekushtiy vizvanniy komponent */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */
/** @var array $arResult Massiv rezulytatov raboti komponenta */
/** @var array $arParams Massiv vhodyashtih parametrov komponenta */
/** @var CMain $APPLICATION */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$APPLICATION->SetTitle(Loc::getMessage('CITRUS_FZ152_AGREEMENT_TITLE'));

include $arResult['FILE'];
