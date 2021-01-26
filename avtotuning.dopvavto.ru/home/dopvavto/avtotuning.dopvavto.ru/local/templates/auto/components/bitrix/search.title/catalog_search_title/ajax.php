<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"]) && $arResult['CATEGORIES_ITEMS_EXISTS']){?>
    <div class="search-block">
        <?
        foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
            <?foreach($arCategory["ITEMS"] as $i => $arItem):?>
                <?if($arItem['NAME'] !='остальные'):?>
                    <?if($category_id === "all"):?>
                        <a href="<?echo $arItem["URL"]?>" class="all-resault">
                            Все результаты
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle class="item1" cx="6" cy="6" r="6"/>
                                <rect class="item2" x="2.87866" y="6.12109" width="4" height="4" transform="rotate(-45 2.87866 6.12109)"/>
                                <rect class="item1" x="2" y="6.12109" width="4" height="4" transform="rotate(-45 2 6.12109)"/>
                            </svg>
                        </a>
                    <?else:?>
                        <a href="/catalog/<?echo $arItem["URL"]?>" class="search-elements">
                            <?if(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
                                $arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]]; ?>
                            <?endif?>
                            <img src="<?echo $arElement["PICTURE"]["src"]?>" alt="" width="<?echo $arElement["PICTURE"]["width"]?>" height="<?echo $arElement["PICTURE"]["height"]?>">
                            <div class="info-block">
                                <p class="title"><?echo $arItem["NAME"]?></p>
                                <p class="articul"><? echo 'Артикул: '.$arResult['ELEMENTS'][$arItem['ITEM_ID']]['PROPERTY_ARTICUL_VALUE']?></p>
                                <p class="price"><?=round(CCurrencyRates::ConvertCurrency($arResult['ELEMENTS'][$arItem['ITEM_ID']]['CATALOG_PRICE_1'], $arResult['ELEMENTS'][$arItem['ITEM_ID']]['CATALOG_CURRENCY_1'], "BYN"),2).' руб.';?></p>
                            </div>
                        </a>
                    <?endif?>
                <?endif?>
            <?endforeach;?>
        <?endforeach;?>
    </div>
<?}else{?>
   <? if($arResult['FIND_ARTNUMBER']){?>
        <div class="search-block">
            <?for($i=0; $i<5; $i++){?>
                <a href="/catalog/<?=$arResult['FIND_ARTNUMBER'][$i]["DETAIL_PAGE_URL"]?>" class="search-elements">
                    <img src="<?echo $arResult['FIND_ARTNUMBER'][$i]["PICTURE"]["src"]?>" alt="" width="<?echo $arResult['FIND_ARTNUMBER'][$i]["PICTURE"]["width"]?>" height="<?echo $arResult['FIND_ARTNUMBER'][$i]["PICTURE"]["height"]?>">
                    <div class="info-block">
                        <p class="title"><?echo $arResult['FIND_ARTNUMBER'][$i]["NAME"]?></p>
                        <p class="articul"><? echo 'Артикул: '.$arResult['FIND_ARTNUMBER'][$i]['PROPERTY_ARTICUL_VALUE']?></p>
                        <p class="price"><?=$arResult['FIND_ARTNUMBER'][$i]['PRICE'].' руб.';?></p>
                    </div>
                </a>
            <?}?>
            <a href="<?echo $arResult['FIND_ARTNUMBER']["URL"]?>" class="all-resault">
                Все результаты
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle class="item1" cx="6" cy="6" r="6"/>
                    <rect class="item2" x="2.87866" y="6.12109" width="4" height="4" transform="rotate(-45 2.87866 6.12109)"/>
                    <rect class="item1" x="2" y="6.12109" width="4" height="4" transform="rotate(-45 2 6.12109)"/>
                </svg>
            </a>
        </div>
    <?}?>
<?}?>