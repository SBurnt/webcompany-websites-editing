<?php

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/** @var array $arParams Parametri, chtenie, izmenenie. Ne zatragivaet odnoimenniy chlen komponenta, no izmeneniya tut vliyayut na $arParams v fayle template.php. */
/** @var array $arResult Rezulytat, chtenie/izmenenie. Zatragivaet odnoimenniy chlen klassa komponenta. */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */

$this->getComponent()->setResultCacheKeys(['SUBTITLE']);
$arResult['SUBTITLE'] = $arResult['DISPLAY_PROPERTIES']['subtitle']['VALUE'];
