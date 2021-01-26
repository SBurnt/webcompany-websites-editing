<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$currency = \Nextype\Premium\CLanding::$options['CURRENCY'];
$this->setFrameMode(false);
$uniqueId = $arResult['ID'] . '_' . md5($this->randString());
$jsProduct = CUtil::PhpToJSObject(Array (
    'ID' => $arResult['ID'],
    'NAME' => $arResult['NAME'],
    'PREVIEW_PICTURE' => $arResult['PREVIEW_PICTURE']['SRC'],
    'OLD_PRICE' => $arResult['PRICES']['OLD_PRICE'],
    'PRICE' => $arResult['PRICES']['PRICE'],
));
?>
    <div class="box product">
        <a href="javascript:void(0);" data-close class="close"></a>
        <? if (is_array($arResult['LABELS'])): ?>
        <div class="labels">
            <? foreach ($arResult['LABELS'] as $lKey => $color): ?>
                <div class="label" style="background-color: <?= $color ?>"><?= $arResult['PROPERTIES'][$arParams['LABEL_PROP'][0]]['VALUE_ENUM'][$lKey] ?></div>
            <? endforeach; ?>
        </div>
        <? endif; ?>
        <div class="columns">
            <div class="left">
                <div class="photo">
                    
                    <img id="photo_<?=$uniqueId?>" title="<?=$arResult['PREVIEW_PICTURE']['TITLE']?>" alt="<?=$arResult['PREVIEW_PICTURE']['ALT']?>" src="<?=$arResult['PREVIEW_PICTURE']['SRC']?>" />
                </div>
                <? if (!empty($arResult['MORE_PHOTOS'])): ?>
                <div class="photo-thumbs">
                    <? foreach ($arResult['MORE_PHOTOS'] as $key => $arPhoto): ?>
                    <a href="<?=$arPhoto['detail']?>" onclick="Landing.changePhoto(this, 'photo_<?=$uniqueId?>'); return false;" class="item<?=$key==0 ? ' active' : ''?>"><img src="<?=$arPhoto['preview']?>" /></a>
                    <? endforeach; ?>
                </div>
                <? endif; ?>
            </div>
            <div class="right">
                <div class="top">
                    <h2 class="product-title"><?=$arResult['NAME']?></h2>
                    <? if (!empty($arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE'])): ?>
                    <div class="article"><?=GetMessage('CT_PROP_ARTICLE_TITLE')?>: <?=$arResult['DISPLAY_PROPERTIES']['ARTICLE']['VALUE']?></div>
                    <? endif; ?>

                    <? if (count($arResult['DISPLAY_PROPERTIES']) > 0): ?>
                    <div class="properties">
                        <? foreach ($arResult['DISPLAY_PROPERTIES'] as $arProp): ?>
                            <? if ($arProp['CODE'] == 'ARTICLE') continue; ?>
                        <div class="property">
                            <span><?=$arProp['NAME']?>:</span> <?=$arProp['VALUE']?>
                        </div>
                        <? endforeach; ?>
                    </div>
                    <? endif; ?>

                    <? if (!empty($arResult['PREVIEW_TEXT'])): ?>
                    <div class="preview-text">
                        <h3 class="preview-text-title"><?=GetMessage('CT_PREVIEW_TEXT_TITLE')?></h3>
                        <?=$arResult['PREVIEW_TEXT']?>
                    </div>
                    <? endif; ?>
                </div>

                <div class="price-and-btn">
                    <div class="price currency-<?= strtolower($currency) ?>">
                        <? if (!empty($arResult['PRICES']['PRICE'])): ?>
                            <? if (!empty($arResult['PRICES']['OLD_PRICE']) && $arResult['PRICES']['OLD_PRICE'] > $arResult['PRICES']['PRICE']): ?>
                                <span class="old"><?= number_format($arResult['PRICES']['OLD_PRICE'], 0, '', ' ') ?></span>
                            <? endif; ?>
                            <span class="new"><?= number_format($arResult['PRICES']['PRICE'], 0, '', ' ') ?></span>
                        <? else: ?>
                            <span class="new"><?= GetMessage('PRICE_ON_REQUEST') ?></span>
                        <? endif; ?>
                    </div>
                    <a href="javascript:void(0)" onclick="Landing.buyProduct(this, <?= $jsProduct ?>);<?=\Nextype\Premium\CLanding::$options['EVENT_CLICK_BUY']?>" class="btn"><?= GetMessage('CT_ORDER_BUTTON_TEXT') ?></a>
                </div>
            </div>
        </div>
        
        
    </div>


