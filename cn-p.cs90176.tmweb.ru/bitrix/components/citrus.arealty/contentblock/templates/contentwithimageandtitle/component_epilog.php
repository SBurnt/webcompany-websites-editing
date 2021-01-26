<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var CBitrixComponent $component Ssilka na tekushtiy vizvanniy komponent, mozhno ispolyzovaty vse metodi klassa. */

/**
 * Esli komponent podklyuchen v sostave citrus.core:include, zapolnim zagolovok i podzagolvok bloa
 */
if ($component->getParent() instanceof \Citrus\Core\IncludeComponent)
{
	if ($arResult['SUBTITLE'])
	{
		$component->getParent()->arParams['DESCRIPTION'] = $arResult['SUBTITLE'];
	}
}