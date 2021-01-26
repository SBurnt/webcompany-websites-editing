<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
//pr($arResult['ITEMS'][0]['PROPERTIES']['COMPLET_AUTO']);

// Получаем количетсво отзывов на товар