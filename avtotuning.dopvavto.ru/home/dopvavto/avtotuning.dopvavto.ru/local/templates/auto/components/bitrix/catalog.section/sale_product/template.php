<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */
$this->setFrameMode(true);

if($arResult['ITEMS'])
{?>
    <div class="shop">
        <h2 class="shop__title rg"><a href="/catalog/sale/">Распродажа по суперцене</a></h2>
        <div id="home-slider-2" class="owl-carousel">
        <?foreach($arResult['ITEMS'] as $item)
        {?>
            <div class="item neon">
                <?if($item['PROPERTIES']['DISCOUNT']['VALUE'] || $item['PROPERTIES']['OLD_PRICE']['VALUE']>0){?>
                    <div class="bd price main_flex flex__align-items_center flex__jcontent_center">
                        <?if($item['PROPERTIES']['DISCOUNT']['VALUE']){
                            echo '-'.$item['PROPERTIES']['DISCOUNT']['VALUE'].'%';
                        }else{
                            echo '-'.round(100-CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN")*100/CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN")).'%';
                        }?>
                    </div>
                <?}?>
                <div class="shop__img">
                    <?if(!empty($item['PREVIEW_PICTURE']['SRC'])){?>
                        <a href="/catalog/<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=$item['PREVIEW_PICTURE']['SRC']?>" alt="<?=$item['NAME']?>"></a>
                    <?}else{?>
                        <a href="/catalog/<?=$item['DETAIL_PAGE_URL']?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png" alt="<?=$item['NAME']?>"></a>
                    <?}?>

                </div>
                <a href="/catalog/<?=$item['DETAIL_PAGE_URL']?>"><p class="bd title"><?=$item['NAME'];?></p></a>
                <? if(is_numeric($item['PROPERTIES']['OLD_PRICE']['VALUE']) && $item['PROPERTIES']['OLD_PRICE']['VALUE']>0 )
                {?>
                    <p class="rg coral">Старая цена: <span><?=round(CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN"));?> руб.</span></p>
                    <p class="rg green">Экономия: <span><?=round(CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN") - CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN"),2);?> руб.</span></p>
                <?}?>
                <div class="bg-price"><?=round(CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN"),2);?><span>руб.</span></div>
                <div class="abs bd" onclick="addBasket(<?=$item['ID'];?>)">В корзину</div>
            </div>
        <?}?>
        </div>
    </div>
<?}

