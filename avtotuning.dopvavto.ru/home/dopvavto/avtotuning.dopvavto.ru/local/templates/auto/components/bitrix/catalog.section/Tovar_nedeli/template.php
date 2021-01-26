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
$today = strtotime(date("d.m.Y G:i:s"));
if (count($arResult['ITEMS'])>1){
    $dataMin = strtotime($arResult['ITEMS'][0]['PROPERTIES']['ACTION_END']['VALUE']);
    foreach($arResult['ITEMS'] as $key => $item){
        if($today<strtotime($item['PROPERTIES']['ACTION_END']['VALUE']))
        {
            $arr[]=strtotime($item['PROPERTIES']['ACTION_END']['VALUE']);
        }
    }
}
if($arResult['ITEMS'] && !empty($arr))
{?>
    <div class="shop">
        <h2 class="shop__title rg">Товар недели</h2>
        <form method="POST" id="TovarNedeli">
            <?foreach($arResult['ITEMS'] as $item)
            {

                $date = strtotime($item['PROPERTIES']['ACTION_END']['VALUE']);
                if(min($arr)==$date){?>
                    <div class="item item-salon neon clearfix">
                        <?if($item['PROPERTIES']['DISCOUNT']['VALUE'] || $item['PROPERTIES']['OLD_PRICE']['VALUE']>0){?>
                            <div class="bd price main_flex flex__align-items_center flex__jcontent_center">
                                <?if($item['PROPERTIES']['DISCOUNT']['VALUE']){
                                    echo '-'.$item['PROPERTIES']['DISCOUNT']['VALUE'].'%';
                                }else{
                                    echo '-'.round(100-CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN")*100/CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN")).'%';
                                }?>
                            </div>
                        <?}?>
                        <div class="item-salon__content main_flex flex__align-items_start flex__jcontent_center">
                            <h3 class="bd"><a class="bd__link" href="/catalog/<?=$item['DETAIL_PAGE_URL']?>"><?=$item['NAME'];?></a></h3>
                            <a href="<?=$item['DETAIL_PAGE_URL']?>">
                                <?if($item['PREVIEW_PICTURE']){?>
                                    <img class="item__salon--img" src="<?=$item['PREVIEW_PICTURE']['SRC'];?>" alt="<?=$item['NAME'];?>">
                                <?}else{?>
                                    <img class="item__salon--img" src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png" alt="<?=$item['NAME'];?>">
                                <?}?>
                            </a>
                            <div class="item__price main_flex__nowrap flex__1">
                                <div class="main_flex flex__jcontent_between">
                                    <?
                                    if(is_numeric($item['PROPERTIES']['OLD_PRICE']['VALUE']) && $item['PROPERTIES']['OLD_PRICE']['VALUE']>0 )
                                    {?>
                                        <div class="item__price--ecn">
                                            <p class="rg coral">Старая цена: <span><?=round(CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN"));?> руб.</span></p>
                                            <p class="rg green">Экономия: <?=round(CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN") - CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN"),2);?> руб.</p>
                                        </div>
                                    <?}?>
                                    <div class="bg-price"><?=round(CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN"),2);?><span>руб.</span></div>
                                </div>

                                <div class="time">
                                    <h4 class="rg">До конца акции осталось</h4>
                                    <div class="clock flip-clock-wrapper"></div>
                                    <div class="message"></div>

                                </div>
                            </div>
                        </div>
                        <span class="abs bd" onclick="addBasket(<?=$item['ID'];?>)">В корзину</span>
                    </div>
                    <input type="hidden" name="data" value="<?=$date?>"/>
                <?}?>
            <?}?>
        </form>
    </div>
<?}?>
