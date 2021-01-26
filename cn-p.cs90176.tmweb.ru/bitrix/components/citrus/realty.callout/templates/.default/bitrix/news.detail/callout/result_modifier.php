<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var array $arParams Parametri, chtenie, izmenenie. Ne zatragivaet odnoimenniy chlen komponenta, no izmeneniya tut vliyayut na $arParams v fayle template.php. */
/** @var array $arResult Rezulytat, chtenie/izmenenie. Zatragivaet odnoimenniy chlen klassa komponenta. */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */

if ($USER->IsAuthorized())
{
	if ($APPLICATION->GetShowIncludeAreas() && \Bitrix\Main\Loader::includeModule("iblock"))
	{
		$arButtons = CIBlock::GetPanelButtons(
			$arParams['IBLOCK_ID'],
			$arResult["ID"],
			0,
			array("SECTION_BUTTONS"=>false, "SESSID"=>false)
		);
		$arResult["PANEL"]["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];

		if ($APPLICATION->GetShowIncludeAreas() && !$this->__component->getParent())
			$this->__component->AddIncludeAreaIcons(CIBlock::GetComponentMenu($APPLICATION->GetPublicShowMode(), $arButtons));
	}
}
