<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

if (empty($arResult['ITEM']['PREVIEW_PICTURE']))
    $arResult['ITEM']['PREVIEW_PICTURE'] = Array (
        'SRC' => SITE_TEMPLATE_PATH . "/images/no-photo.jpg",
        'ALT' => "",
        'TITLE' => ""
    );

$arResult['ITEM']['DETAIL_PAGE_URL'] = $APPLICATION->getCurPageParam('ELEMENT_ID=' . $arResult['ITEM']['ID'] . "&is_ajax=product&ncc=Y", Array ('ELEMENT_ID', 'is_ajax'));
$arResult['ITEM']['PRICES_RESULT'] = Array (
    'PRICE' => floatval(str_replace(",", ".", $arResult['ITEM']['PROPERTIES']['PRICE']['VALUE'])),
    'OLD_PRICE' => floatval(str_replace(",", ".", $arResult['ITEM']['PROPERTIES']['OLD_PRICE']['VALUE'])),
);

if (CModule::IncludeModule("sale"))
{
    if (is_array($arResult['ITEM']['MIN_PRICE']) && !empty($arResult['ITEM']['MIN_PRICE']))
    {
        $arResult['ITEM']['PRICES_RESULT'] = Array (
            'PRICE' => $arResult['ITEM']['MIN_PRICE']['DISCOUNT_VALUE'],
            'OLD_PRICE' => $arResult['ITEM']['MIN_PRICE']['VALUE'],
        );
    }
}