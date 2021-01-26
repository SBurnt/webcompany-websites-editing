<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

$parentComponentName = 'bitrix:catalog.section';
CBitrixComponent::includeComponentClass($parentComponentName);

class CitrusRealtyCatalogSectionComponent extends CatalogSectionComponent
{
	protected function getFilter()
	{
		$filterFields = parent::getFilter();
		$filterFields['ACTIVE_DATE'] = \Citrus\Arealty\Entity\SettingsTable::getValue('USE_ACTIVE_DATE') == 'N' ? '' : 'Y';
		$filterFields['PROPERTY_draft_for'] = false;

		return $filterFields;
	}
}