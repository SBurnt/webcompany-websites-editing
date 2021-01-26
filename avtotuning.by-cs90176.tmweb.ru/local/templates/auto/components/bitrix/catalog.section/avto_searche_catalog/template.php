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
$this->setFrameMode(true);?>

<?if($arResult['ITEMS'])
{?>
    <div class="sort main_flex flex__align-items_center" style="flex-direction: column;align-items: flex-start;">
        <h2 class="shop__title category rg">Каталог</h2>
        <div class="shop row main_flex">
           <?foreach($arResult['SECTION_NAME'] as $item1){?>
               <div class="web_catalog_title"><?=$item1['NAME']?></div>
<!--               --><?//
//               if ($razdel!=$item['SECTION_NAME']['NAME']){?>
<!--                   <div class="web_catalog_title">-->
<!--                       --><?//=$item['SECTION_NAME']['NAME']?>
<!--                   </div>-->
<!--                   --><?//$razdel = $item['SECTION_NAME']['NAME'];?>
<!--               --><?//}else{
//                   $razdel = $item['SECTION_NAME']['NAME'];
//               }?>
               <?$last = array_slice($arResult['ITEMS'], -1)[0];
               foreach($arResult['ITEMS'] as $item) {
                   if($item['SECTION_NAME']['ID']==$item1['ID']):?>
                        <div class="item neon flex__1 <?=($item['PROPERTIES']['DISCOUNT']['VALUE']) ? 'discount-item' : '';?> <?=$last['ID']==$item['ID'] ? 'last_items mob_last_items' : '';?>">
                            <div>
                                <?if($item['PROPERTIES']['DISCOUNT']['VALUE'] || $item['PROPERTIES']['OLD_PRICE']['VALUE']>0){?>
                                    <div class="bd price main_flex flex__align-items_center flex__jcontent_center">
                                        <?if($item['PROPERTIES']['DISCOUNT']['VALUE']){
                                            echo '-'.$item['PROPERTIES']['DISCOUNT']['VALUE'].'%';
                                        }else{
                                            echo '-'.round(100-CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN")*100/CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN")).'%';
                                        }?>
                                    </div>
                                <?}?>
                                <div class="item__name bd"><a href="/catalog/<?=$item['DETAIL_PAGE_URL'];?>" style="color: white;"><?=$item['NAME'];?></a></div>

                                <div class="item__rating main_flex flex__align-items_center">
                                    <div class="rating main_flex flex__align-items_center">
                                        <?$APPLICATION->IncludeComponent(
                                            "bitrix:iblock.vote",
                                            "ajax_sect",
                                            Array(
                                                "CACHE_TIME" => "36000000",
                                                "CACHE_TYPE" => "A",
                                                "DISPLAY_AS_RATING" => "vote_avg",
                                                "ELEMENT_CODE" => $_REQUEST["code"],
                                                "ELEMENT_ID" => $item["ID"],
                                                "IBLOCK_ID" => "2",
                                                "IBLOCK_TYPE" => "catalog",
                                                "MAX_VOTE" => "5",
                                                "MESSAGE_404" => "",
                                                "SET_STATUS_404" => "N",
                                                "VOTE_NAMES" => array("1", "2", "3", "4", "5", "")
                                            )
                                        );?>
                                    </div>

                                    <div class="item__message main_flex flex__align-items_center">
                                        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/chat.svg" width="16">
                                        <p class="rg">19</p>
                                    </div>

                                    <div class="item__article">
                                        <p class="rg">Артикул: <?=$item['PROPERTIES']['ARTICUL']['VALUE'];?></p>
                                    </div>
                                </div>

                                <div class="item__info main_flex flex__align-items_start flex__jcontent_center">
                                    <div class="item__info--img">
                                        <?if(!empty($item['DETAIL_PICTURE']['SRC'])){?>
                                            <img src="<?=$item['DETAIL_PICTURE']['SRC']?>" alt="item">
                                        <?}else{?>
                                            <img src="<?=SITE_TEMPLATE_PATH?>/components/bitrix/catalog.section/Tovar_nedeli/images/no_photo.png" alt="item">
                                        <?}?>
                                    </div>
                                    <div class="item__info--block flex__1">
                                        <?foreach ($item['DISPLAY_PROPERTIES'] as $prop){?>
                                            <?if ($prop['ID'] != 17 && $prop['ID'] != 16):?>
                                                <p class="rg"><?=$prop['NAME']?>:<?=$prop['VALUE']?></p>
                                            <?endif;?>
                                        <?}?>
                                        <?if($item['PROPERTIES']['AVAIL']['VALUE'] == 'Y')
                                        {?>
                                            <button class="nal bd"><i class="fas fa-check"></i>В наличии</button>
                                        <?}
                                        else
                                        {?>
                                            <button class="nal bd nh"><i class="fas fa-times"></i>Нет в наличии</button>
                                        <?}?>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <? if(is_numeric($item['PROPERTIES']['OLD_PRICE']['VALUE']) && $item['PROPERTIES']['OLD_PRICE']['VALUE']>0 ){?>
                                    <div class="item__price main_flex flex__align-items_start flex__jcontent_between">
                                        <div class="rg coral">Старая цена: <span><?=round(CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN"),2);?> руб.</span></div>
                                        <div class="rg green">Экономия: <span><?=round(CCurrencyRates::ConvertCurrency($item['PROPERTIES']['OLD_PRICE']['VALUE'], $item['CATALOG_CURRENCY_1'], "BYN") - CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN"),2);?> руб.</span></div>
                                    </div>
                                <?}?>
                                <div class="bg-price"><?=round(CCurrencyRates::ConvertCurrency($item['CATALOG_PRICE_1'], $item['CATALOG_CURRENCY_1'], "BYN"),2);?><span>руб.</span></div>
                                <?
                                if($item['PROPERTIES']['AVAIL']['VALUE'] == 'Y') {?>
                                    <div class="abs bd avalaible" onclick="addBasket(<?=$item['ID']?>)">В корзину</div>
                                <?}else{?>
                                    <div class="abs bd no-avalaible" onclick="no_avalaible(<?=$item['ID']?>)">Сообщить о поступлении</div>
                                <?} ?>
                            </div>
                        </div>
                   <?
                   endif;?>
                <?}?>
           <?}?>
        </div>
    </div>
<?}
?>
<?=$arResult['NAV_STRING']?>

<?
if(strlen($arResult['DESCRIPTION']) > 200)
{
    $descr = substr($arResult['DESCRIPTION'], 0, 200);
    $descr_more = substr($arResult['DESCRIPTION'], 200);
}
else
{
    $descr = $arResult['DESCRIPTION'];
}
?>
<div class="txt1">
    <p class="rg"><?=$descr;?></p>
    <?
    if($descr_more)
    {?>
        <div class="all">
            <div class="toggler">
                <button class="rg">Показать больше</button><img class='svg' src='<?=SITE_TEMPLATE_PATH?>/img/icon/right-angle.svg' width="10">
            </div>
            <div class="txt-seo">
                <p class="rg"><?=$descr_more;?></p>
            </div>
            <div class="toggler web-mob-toggler">
                <button class="rg">Показать больше</button><img class='svg' src='<?=SITE_TEMPLATE_PATH?>/img/icon/right-angle.svg' width="10">
            </div>
        </div>
    <?}
    ?>
</div>
<script>
    function no_avalaible(id){
        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>ajax/no-avalaible.php',
            data: {id: id},
            success: function(data){
                $('#no_avalaible').html(data);
                $('#no_avalaible').show();
            }
        });
    }
</script>

