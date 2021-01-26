<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

if (! \Bitrix\Main\Loader::includeModule('nextype.premium') )
    die();

$uniqueId = $arResult['ITEM']['ID'] . '_' . md5($this->randString());
$currency = \Nextype\Premium\CLanding::$options['CURRENCY'];
$exProductPage = \Nextype\Premium\CLanding::$options['EXTENDED_PRODUCT_PAGE'];
$inStock = $arResult['ITEM']['PROPERTIES']['IN_STOCK'];
$arLabels = $arResult['ITEM']['PROPERTIES'][$arParams['LABEL_PROP']]['VALUE_XML_ID'];
$arPrices = $arResult['ITEM']['PRICES_RESULT'];

$jsProduct = CUtil::PhpToJSObject(Array (
    'ID' => $arResult['ITEM']['ID'],
    'NAME' => $arResult['ITEM']['NAME'],
    'PREVIEW_PICTURE' => $arResult['ITEM']['PREVIEW_PICTURE']['SRC'],
    'OLD_PRICE' => $arPrices['OLD_PRICE'],
    'PRICE' => $arPrices['PRICE'],
));
?>
<? if (isset($arResult['ITEM'])): ?>
<div class="product" id="<?=$arResult['AREA_ID']?>" <?=($arParams['SHOW_SCHEMA'] == "Y") ? 'itemscope itemtype="http://schema.org/Product"' : '' ?> >
    <? if ($arParams['SHOW_LABEL_TOP'] == "Y"): ?>
    <div class="label hit"><?=GetMessage('LABEL_BEST')?></div>
    <? endif; ?>
    <? if ($arParams['SHOW_TAGS'] == "Y" && !empty($arLabels)): ?>
    <div class="labels">
        <? foreach ($arLabels as $lKey => $color): ?>
        <div class="label" style="background-color: <?=$color?>"><?=$arResult['ITEM']['PROPERTIES'][$arParams['LABEL_PROP']]['VALUE_ENUM'][$lKey]?></div>
        <? endforeach; ?>
    </div>
    <? endif; ?>
    
    <? if ($exProductPage == "Y"): ?>
    <a href="javascript:void(0);" onclick="Landing.viewProduct('<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>');" class="img" rel="nofollow">
    <? else: ?>
    <a href="<?=$arResult['ITEM']['PREVIEW_PICTURE']['SRC']?>" rel="nofollow" title="<?=$arResult['ITEM']['NAME']?>" data-lightbox="<?=$uniqueId ?>" class="img">
    <? endif; ?>
        <img <?=($arParams['SHOW_SCHEMA'] == "Y") ? 'itemprop="image"' : '' ?> src="<?=$arResult['ITEM']['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arResult['ITEM']['NAME']?>" title="<?=$arResult['ITEM']['NAME']?>" />
    </a>
        
    <? if (!empty($arResult['ITEM']['PROPERTIES']['MORE_PHOTOS']['VALUE'])): ?>
        <? foreach ($arResult['ITEM']['PROPERTIES']['MORE_PHOTOS']['VALUE'] as $imageId): ?>
        <? $path = CFile::GetPath($imageId); ?>
        <a href="<?=$path?>" rel="nofollow" title="<?=$arResult['ITEM']['NAME']?>" data-lightbox="<?=$uniqueId ?>"></a>
        <? endforeach; ?>
    <? endif; ?>
    
    <? if ($exProductPage == "Y"): ?>
    <a href="javascript:void(0)" rel="nofollow" onclick="Landing.viewProduct('<?=$arResult['ITEM']['DETAIL_PAGE_URL']?>');" class="name" <?=($arParams['SHOW_SCHEMA'] == "Y") ? 'itemprop="name"' : '' ?>><?=$arResult['ITEM']['NAME']?></a>
    <? else: ?>
    <div class="name"<?=($arParams['SHOW_SCHEMA'] == "Y") ? ' itemprop="name"' : '' ?>><?=$arResult['ITEM']['NAME']?></div>
    <? endif; ?>
    
    <? if (!empty($arResult['ITEM']['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])): ?>
    <div class="text"><?=GetMessage('PROPERTY_ARTICLE')?> <?=$arResult['ITEM']['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></div>
    <? endif; ?>
    <? if ($arParams['SHOW_SCHEMA'] == "Y"): ?>
    <meta itemprop="description" content="<?=trim(strip_tags($arResult['ITEM']['PREVIEW_TEXT']))?>">
    <? endif; ?>
    <div class="price-and-btn">
        <div class="price currency-<?=strtolower($currency)?>" <?=($arParams['SHOW_SCHEMA'] == "Y") ? 'itemprop="offers" itemscope itemtype="http://schema.org/Offer"' : '' ?> >
            <? if (!empty($arPrices['PRICE'])): ?>
                <? if (!empty($arPrices['OLD_PRICE']) && $arPrices['OLD_PRICE'] > $arPrices['PRICE']): ?>
                <span class="old"><?= number_format($arPrices['OLD_PRICE'], 0, '', ' ')?></span>
                <? endif; ?>
            <span class="new"><?=number_format($arPrices['PRICE'], 0, '', ' ')?></span>
            <? else: ?>
            <span class="new zero-price"><?=GetMessage('PRICE_ON_REQUEST')?></span>
            <? endif; ?>
            
            <? if ($arParams['SHOW_SCHEMA'] == "Y"): ?>
            <meta itemprop="price" content="<?=$arPrices['PRICE']?>">
            <meta itemprop="priceCurrency" content="<?=$currency?>">
            <? if ($inStock['VALUE_XML_ID'] == "Y"): ?>
            <link itemprop="availability" href="http://schema.org/InStock">
            <? endif; ?>
            <? endif; ?>
        </div>
        <a href="javascript:void(0)" rel="nofollow" onclick="Landing.buyProduct(this, <?=$jsProduct?>);<?=\Nextype\Premium\CLanding::$options['EVENT_CLICK_BUY']?>" class="btn"><?=(!empty($arParams['MESS_BTN_BUY'])) ? $arParams['MESS_BTN_BUY'] : GetMessage('BUY_BUTTON_TEXT')?></a>
    </div>
</div>
<? endif; ?>