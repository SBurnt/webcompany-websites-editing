<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

foreach ($arResult['ITEMS'] as $key => $arItem)
{
    $arSectionList = array();
    $rsSections = CIBlockElement::GetElementGroups($arItem['ID'], true);
    while ($arSection = $rsSections->Fetch())
    {
        if($arSection['ID'] == 86){
            continue;
        }else{
            $arSectionList = array(
                'ID' => $arSection['ID'],
                'NAME' => $arSection['NAME'],
            );
        }
        $ar[$arSection['ID']] = $arSectionList;
    }
//    pr($arSection);


    $arItem['SECTION_NAME'] = $arSectionList;
    $arResult['ITEMS'][$key] = $arItem;
}
$arResult['SECTION_NAME'] =  $ar;


// Получаем количетсво отзывов на товар