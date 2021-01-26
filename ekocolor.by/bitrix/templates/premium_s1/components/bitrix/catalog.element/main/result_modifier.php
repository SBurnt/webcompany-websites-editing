<?

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$arResult['MORE_PHOTOS'] = Array ();
$arPreviewParams = array("width" => 210, "height" => 210);
if (!empty($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE']))
{
    $arPreview = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]['ID'], $arPreviewParams, BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
    if (!empty($arPreview['src']))
        $arResult['MORE_PHOTOS'][] = Array (
            'preview' => $arPreview['src'],
            'detail' => $arResult["PREVIEW_PICTURE"]['SRC']
        );
    
    foreach ($arResult['PROPERTIES']['MORE_PHOTOS']['VALUE'] as $fileId)
    {
        $arPreview = CFile::ResizeImageGet($fileId, $arPreviewParams, BX_RESIZE_IMAGE_PROPORTIONAL_ALT);
        
        $arResult['MORE_PHOTOS'][] = Array (
            'preview' => $arPreview['src'],
            'detail' => CFile::GetPath($fileId)
        );
    }
}

if (isset($arResult['PROPERTIES'][$arParams['LABEL_PROP'][0]]['VALUE_XML_ID']))
    $arResult['LABELS'] = $arResult['PROPERTIES'][$arParams['LABEL_PROP'][0]]['VALUE_XML_ID'];

if (empty($arResult['PREVIEW_PICTURE']))
    $arResult['PREVIEW_PICTURE'] = Array (
        'SRC' => SITE_TEMPLATE_PATH . "/images/no-photo.jpg",
        'ALT' => "",
        'TITLE' => ""
    );

$arResult['PRICES'] = Array (
    'PRICE' => floatval(str_replace(",", ".", $arResult['PROPERTIES']['PRICE']['VALUE'])),
    'OLD_PRICE' => floatval(str_replace(",", ".", $arResult['PROPERTIES']['OLD_PRICE']['VALUE'])),
);

if (CModule::IncludeModule("sale"))
{
    if (is_array($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']))
    {
        $arResult['PRICES'] = Array (
            'PRICE' => $arResult['MIN_PRICE']['DISCOUNT_VALUE'],
            'OLD_PRICE' => $arResult['MIN_PRICE']['VALUE'],
        );
        
    }
}