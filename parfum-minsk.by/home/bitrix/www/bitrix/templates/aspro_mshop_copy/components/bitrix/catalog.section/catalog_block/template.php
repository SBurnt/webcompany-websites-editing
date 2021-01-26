<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);?><pre><?//print_r($arResult["ITEMS"])?></pre>
<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
    <?if(($arParams["AJAX_REQUEST"]=="N") || !isset($arParams["AJAX_REQUEST"])){?>
        <div class="top_wrapper">
        <div class="catalog_block">
        <div class="group_description" style="position: relative; z-index: 10;">
            <div>
                <?if(is_array($arResult["DETAIL_PICTURE"])):?>
                    <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="img-in-description">
                <?endif;?>
                <?if(strlen($arResult["~DESCRIPTION"]) > 1000):
                    ?>
                    <div data-height="80px" style="height: 80px; overflow: hidden;" class="full-text"><?=$arResult["~DESCRIPTION"]?> </div>
                    <a href="#" class="show-more-description" data-to-short="<?=GetMessage("CATALOG_HIDE_MORE");?>" data-to-full="<?=GetMessage("CATALOG_SHOW_MORE");?>"><?=GetMessage("CATALOG_SHOW_MORE");?></a>
                <?else:?>
                    <?=$arResult["~DESCRIPTION"]?>
                <?endif;?>
            </div>
            <hr class="long"/>
        </div>
    <?}?>
    <?
    $currencyList = '';
    if (!empty($arResult['CURRENCIES'])){
        $templateLibrary[] = 'currency';
        $currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
    }
    $templateData = array(
        'TEMPLATE_LIBRARY' => $templateLibrary,
        'CURRENCIES' => $currencyList
    );
    unset($currencyList, $templateLibrary);

    $arSkuTemplate = array();
    if (!empty($arResult['SKU_PROPS'])){
        $arSkuTemplate=CMShop::GetSKUPropsArray($arResult['SKU_PROPS'], $arResult["SKU_IBLOCK_ID"], $arParams["DISPLAY_TYPE"]);
    }
    $arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());

    $arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);

    ?>
    <?foreach($arResult["ITEMS"] as $arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));

        $arItemIDs=CMShop::GetItemsIDs($arItem);

        $totalCount = CMShop::GetTotalCount($arItem);
        $arQuantityData = CMShop::GetQuantityArray($totalCount, $arItemIDs["ALL_ITEM_IDS"]);

        $item_id = $arItem["ID"];
        $strMeasure = '';
        if(!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'){
            if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
                $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
                $strMeasure = $arMeasure["SYMBOL_RUS"];
            }
            $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"]);
        }
        elseif($arItem["OFFERS"]){
            $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
        }


        ?>
        <?/*?><div onclick="window.open('<?=$arItem["DETAIL_PAGE_URL"]?>');return false;" class="catalog_item_wrapp"><?*/?>
        <div class="catalog_item_wrapp">
            <div class="catalog_item item_wrap <?=(($_GET['q'])) ? 's' : ''?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div>
                    <div class="image_wrapper_block">
                        <?/*$frame = $this->createFrame()->begin('');
							$frame->setBrowserStorage(true);*/?>
                        <?if((!$arItem["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N" ) || ($arParams["DISPLAY_COMPARE"] == "Y")):?>
                            <div class="like_icons">
                                <!--										--><?//var_dump($arItem["CAN_BUY"]);?>
                                <?if($arItem["CAN_BUY"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                    <?if(!$arItem["OFFERS"]):?>
                                        <div class="wish_item_button">
                                            <span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
                                            <span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
                                        </div>
                                    <?elseif($arItem["OFFERS"]):?>
                                        <?foreach($arItem["OFFERS"] as $arOffer):?>
                                            <?if($arOffer['CAN_BUY'] || true):?>
                                                <div class="wish_item_button o_<?=$arOffer["ID"];?>" style="display: none;">
                                                    <span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to <?=$arParams["TYPE_SKU"];?>" data-item="<?=$arOffer["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>" data-offers="Y" data-props="<?=$arOfferProps?>"><i></i></span>
                                                    <span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-item="<?=$arOffer["ID"]?>" data-iblock="<?=$arOffer["IBLOCK_ID"]?>"><i></i></span>
                                                </div>
                                            <?endif;?>
                                        <?endforeach;?>
                                    <?endif;?>
                                <?endif;?>
                                <?if($arParams["DISPLAY_COMPARE"] == "Y"):?>
                                    <?if(!$arItem["OFFERS"] || $arParams["TYPE_SKU"] !== 'TYPE_1'):?>
                                        <div class="compare_item_button">
                                            <span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>" ><i></i></span>
                                            <span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arItem["ID"]?>"><i></i></span>
                                        </div>
                                    <?elseif($arItem["OFFERS"]):?>
                                        <?foreach($arItem["OFFERS"] as $arOffer):?>
                                            <div class="compare_item_button o_<?=$arOffer["ID"];?>" style="display: none;">
                                                <span title="<?=GetMessage('CATALOG_COMPARE')?>" class="compare_item to <?=$arParams["TYPE_SKU"];?>" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arOffer["ID"]?>" ><i></i></span>
                                                <span title="<?=GetMessage('CATALOG_COMPARE_OUT')?>" class="compare_item in added <?=$arParams["TYPE_SKU"];?>" style="display: none;" data-iblock="<?=$arParams["IBLOCK_ID"]?>" data-item="<?=$arOffer["ID"]?>"><i></i></span>
                                            </div>
                                        <?endforeach;?>
                                    <?endif;?>
                                <?endif;?>
                            </div>
                        <?endif;?>
                        <?//$frame->end();?>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="thumb" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PICT']; ?>">
                            <div class="stickers">
                                <?if (is_array($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"])):?>
                                    <?foreach($arItem["PROPERTIES"]["HIT"]["VALUE_XML_ID"] as $key=>$class){
                                        $class = strtolower($class);?>
                                        <div class="sticker_<?=$class?>" title="<?=$arItem["PROPERTIES"]["HIT"]["VALUE"][$key]?>"></div>
                                    <?}?>
                                <?endif;?>
                            </div>
                            <?if( !empty($arItem["PREVIEW_PICTURE"]) && $arItem['PREVIEW_PICTURE']['WIDTH'] >= 300 ):?>
                                <img border="0" src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"]?$arItem["PREVIEW_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
                            <?elseif( !empty($arItem["DETAIL_PICTURE"])):?>
                                <?$img = CFile::ResizeImageGet($arItem["DETAIL_PICTURE"], array( "width" => 300, "height" => 300 ), BX_RESIZE_IMAGE_PROPORTIONAL,true );?>
                                <img border="0" src="<?=$img["src"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"]?$arItem["PREVIEW_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
                            <?else:?>
                                <img border="0" src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["TITLE"]?$arItem["PREVIEW_PICTURE"]["TITLE"]:$arItem["NAME"]);?>" />
                            <?endif;?>
                        </a>
                    </div>
                    <div class="item_info">

                        <div class="stickers-gender">
                            <span class="gender_text"><?//=$arItem["PROPERTIES"]["GOODS_TYPE"]['VALUE'][0]?></span>
                            <?=GetSexImgs($arItem["PROPERTIES"]["GOODS_TYPE"]["VALUE_XML_ID"]);?>
                        </div>

                        <div class="item-title">
                            <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span><?=$arItem["NAME"]?></span></a>
                        </div>
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="small read_more"><i></i><span><?=GetMessage("CATALOG_READ_MORE");?></span></a>
                        <?////=$arQuantityData["HTML"];?>
                        <div class="cost prices clearfix" >
                            <?
                            /*$frame = $this->createFrame()->begin('');
                            $frame->setBrowserStorage(true);*/
                            ?>
                            <?if( $arItem["OFFERS"]){?>
                                <?$minPrice = false;
                                if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
                                    $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
                                $min_price_id=$minPrice["MIN_PRICE_ID"];
                                if($minPrice["MIN_ITEM_ID"])
                                    $item_id=$minPrice["MIN_ITEM_ID"];
                                $prefix = '';
                                if('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] !== 'block'){
                                    $prefix = GetMessage("CATALOG_FROM");
                                }
                                if($minPrice["VALUE"]>$minPrice["DISCOUNT_VALUE"] && $arParams["SHOW_OLD_PRICE"]=="Y"){?>
                                    <div class="price" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PRICE']; ?>">
                                        <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                            <?=$prefix;?> <?=$minPrice["PRINT_DISCOUNT_VALUE"];?>
                                            <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                                /<?=$strMeasure?>
                                            <?}?>
                                        <?endif;?>
                                    </div>
                                    <div class="price discount" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PRICE_OLD']; ?>">
                                        <strike><?=$minPrice["PRINT_VALUE"];?></strike>
                                    </div>
                                    <?if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
                                        <div class="sale_block">
                                            <?$percent=round(($minPrice["DISCOUNT_DIFF"]/$minPrice["VALUE"])*100, 2);?>
                                            <?if($percent && $percent<100){?>
                                                <div class="value">-<?=$percent;?>%</div>
                                            <?}?>
                                            <div class="text"><?=GetMessage("CATALOG_ECONOMY");?> <span><?=$minPrice["PRINT_DISCOUNT_DIFF"];?></span></div>
                                            <div class="clearfix"></div>
                                        </div>
                                    <?}?>
                                <?}else{?>
                                    <div class="price" id="<?=$arItemIDs["ALL_ITEM_IDS"]['PRICE']?>">
                                        <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                            <?=$prefix;?> <?=$minPrice['PRINT_DISCOUNT_VALUE'];?>
                                            <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                                /<?=$strMeasure?>
                                            <?}?>
                                        <?endif;?>
                                    </div>
                                <?}?>
                            <?}elseif ( $arItem["PRICES"] ){?>
                                <? $arCountPricesCanAccess = 0;
                                $min_price_id=0;
                                foreach( $arItem["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} } ?>
                                <?foreach($arItem["PRICES"] as $key => $arPrice){?>
                                    <?if($arPrice["CAN_ACCESS"]){
                                        $percent=0;
                                        if($arPrice["MIN_PRICE"]=="Y"){
                                            $min_price_id=$arPrice["PRICE_ID"];
                                        }?>
                                        <?$price = CPrice::GetByID($arPrice["ID"]);?>
                                        <?if($arCountPricesCanAccess > 1):?>
                                            <div class="price_name"><?=$price["CATALOG_GROUP_NAME"];?></div>
                                        <?endif;?>
                                        <?if($arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"] && $arParams["SHOW_OLD_PRICE"]=="Y"){?>
                                            <div class="price">
                                                <?if(strlen($arPrice["PRINT_VALUE"])):?>
                                                    <?=$arPrice["PRINT_DISCOUNT_VALUE"];?>
                                                    <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                                        /<?=$strMeasure?>
                                                    <?}?>
                                                <?endif;?>
                                            </div>
                                            <div class="price discount">
                                                <strike><?=$arPrice["PRINT_VALUE"];?></strike>
                                            </div>
                                            <?if($arParams["SHOW_DISCOUNT_PERCENT"]=="Y"){?>
                                                <div class="sale_block">
                                                    <?$percent=round(($arPrice["DISCOUNT_DIFF"]/$arPrice["VALUE"])*100, 2);?>
                                                    <?if($percent && $percent<100){?>
                                                        <div class="value">-<?=$percent;?>%</div>
                                                    <?}?>
                                                    <div class="text"><?=GetMessage("CATALOG_ECONOMY");?> <span><?=$arPrice["PRINT_DISCOUNT_DIFF"];?></span></div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            <?}?>
                                        <?}else{?>
                                            <div class="price">
                                                <?if(strlen($arPrice["PRINT_VALUE"])):?>
                                                    <?=$arPrice["PRINT_VALUE"];?>
                                                    <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                                        /<?=$strMeasure?>
                                                    <?}?>
                                                <?endif;?>
                                            </div>
                                        <?}?>
                                    <?}?>
                                <?}?>
                            <?}?>
                            <?//$frame->end();?>
                        </div>
                        <?
                        /*$frame = $this->createFrame()->begin('');
                        $frame->setBrowserStorage(true);*/
                        ?>
                        <?$arDiscounts = CCatalogDiscount::GetDiscountByProduct( $arItem["ID"], $USER->GetUserGroupArray(), "N", $min_price_id, SITE_ID );
                        $arDiscount=array();
                        if($arDiscounts)
                            $arDiscount=current($arDiscounts);
                        if($arDiscount["ACTIVE_TO"]){?>
                            <div class="view_sale_block" style="display: none;">
                                <div class="count_d_block">
                                    <span class="active_to_<?=$arItem["ID"]?> hidden"><?=$arDiscount["ACTIVE_TO"];?></span>
                                    <div class="title"><?=GetMessage("UNTIL_AKC");?></div>
                                    <span class="countdown countdown_<?=$arItem["ID"]?> values"></span>
                                    <script>
                                        $(document).ready(function(){
                                            if( $('.countdown').size() ){
                                                var active_to = $('.active_to_<?=$arItem["ID"]?>').text(),
                                                    date_to = new Date(active_to.replace(/(\d+)\.(\d+)\.(\d+)/, '$3/$2/$1'));
                                                $('.countdown_<?=$arItem["ID"]?>').countdown({until: date_to, format: 'dHMS', padZeroes: true, layout: '{d<}<span class="days item">{dnn}<div class="text">{dl}</div></span>{d>} <span class="hours item">{hnn}<div class="text">{hl}</div></span> <span class="minutes item">{mnn}<div class="text">{ml}</div></span> <span class="sec item">{snn}<div class="text">{sl}</div></span>'}, $.countdown.regionalOptions['ru']);
                                            }
                                        })
                                    </script>
                                </div>
                                <div class="quantity_block">
                                    <div class="title"><?=GetMessage("TITLE_QUANTITY_BLOCK");?></div>
                                    <div class="values">
												<span class="item">
													<?=(int)$totalCount;?>
                                                    <div class="text"><?=GetMessage("TITLE_QUANTITY");?></div>
												</span>
                                    </div>
                                </div>
                            </div>
                        <?}?>
                        <?//$frame->end();?>
                        <div class="hover_block" style="display: none;">
                            <?if($arItem["OFFERS"]){?>
                                <?if(!empty($arItem['OFFERS_PROP'])){?>
                                    <div class="sku_props">
                                        <div class="bx_catalog_item_scu wrapper_sku" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['PROP_DIV']; ?>">
                                            <?foreach ($arSkuTemplate as $code => $strTemplate){
                                                if (!isset($arItem['OFFERS_PROP'][$code]))
                                                    continue;
                                                echo '<div>', str_replace('#ITEM#_prop_', $arItemIDs["ALL_ITEM_IDS"]['PROP'], $strTemplate), '</div>';
                                            }?>
                                        </div>
                                        <?$arItemJSParams=CMShop::GetSKUJSParams($arResult, $arParams, $arItem);?>
                                        <script >
                                            var <? echo $arItemIDs["strObName"]; ?> = new JCCatalogSection(<? echo CUtil::PhpToJSObject($arItemJSParams, false, true); ?>);
                                        </script>
                                    </div>
                                <?}?>
                            <?}?>
                            <?if(!$arItem["OFFERS"] || $arParams['TYPE_SKU'] !== 'TYPE_1'):?>
                                <div class="counter_wrapp <?=($arItem["OFFERS"] && $arParams["TYPE_SKU"] == "TYPE_1" ? 'woffers' : '')?>">
                                    <?if(($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && $arAddToBasketData["ACTION"] == "ADD") /*|| $arItem["CAN_BUY"]*/):?>
                                        <div class="counter_block" data-offers="<?=($arItem["OFFERS"] ? "Y" : "N");?>" data-item="<?=$arItem["ID"];?>">
                                            <span class="minus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_DOWN']; ?>">-</span>
                                            <input type="text" class="text" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY']; ?>" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<?=($arParams["DEFAULT_COUNT"] > 0 ? $arParams["DEFAULT_COUNT"] : 1)?>" />
                                            <span class="plus" id="<? echo $arItemIDs["ALL_ITEM_IDS"]['QUANTITY_UP']; ?>">+</span>
                                        </div>
                                    <?endif;?>
                                    <div id="<?=$arItemIDs["ALL_ITEM_IDS"]['BASKET_ACTIONS']; ?>" class="button_block <?=(($arAddToBasketData["ACTION"] == "ORDER"/*&& !$arItem["CAN_BUY"]*/) || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] || $arAddToBasketData["ACTION"] == "SUBSCRIBE" ? "wide" : "");?>">
                                        <!--noindex-->
                                        <?=$arAddToBasketData["HTML"]?>
                                        <!--/noindex-->
                                    </div>
                                </div>
                            <?elseif($arItem["OFFERS"]):?>
                                <?foreach($arItem["OFFERS"] as $arOffer):?>
                                    <?
                                    $totalCount = CMShop::GetTotalCount($arOffer);
                                    $arAddToBasketData = CMShop::GetAddToBasketArray($arOffer, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"], false, $arItemIDs["ALL_ITEM_IDS"], "small read_more");
                                    ?>
                                    <?if($arAddToBasketData["ACTION"] != "NOTHING"):?>
                                        <div class="counter_wrapp o_<?=$arOffer["ID"];?> <?=($arItem["OFFERS"] && $arParams["TYPE_SKU"] == "TYPE_1" ? 'woffers' : '')?>" style="display: none;">
                                            <?if(($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && $arAddToBasketData["ACTION"] == "ADD") /*|| $arOffer["CAN_BUY"]*/):?>
                                                <div class="counter_block" data-item="<?=$arOffer["ID"];?>" <?=(($arItem["OFFERS"] && $arParams["TYPE_SKU"] !== "TYPE_1") ? "style='display: none;'" : "");?>>
                                                    <span class="minus">-</span>
                                                    <input type="text" class="text" name="<? echo $arParams["PRODUCT_QUANTITY_VARIABLE"]; ?>" value="<?=($arParams["DEFAULT_COUNT"] > 0 ? $arParams["DEFAULT_COUNT"] : 1)?>" />
                                                    <span class="plus">+</span>
                                                </div>
                                            <?endif;?>
                                            <div class="button_block <?=(($arAddToBasketData["ACTION"] == "ORDER" /*&& !$arOffer["CAN_BUY"]*/) || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] || $arAddToBasketData["ACTION"] == "SUBSCRIBE" ? "wide" : "");?>">
                                                <!--noindex-->
                                                <?=$arAddToBasketData["HTML"]?>
                                                <!--/noindex-->
                                            </div>
                                        </div>
                                    <?endif;?>
                                <?endforeach;?>
                            <?endif;?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?}?>
    <?if(($arParams["AJAX_REQUEST"]=="N") || !isset($arParams["AJAX_REQUEST"])){?>
        </div>
        </div>

    <?}?>
    <?if($arParams["AJAX_REQUEST"]=="Y"){?>
        <div class="wrap_nav">
    <?}?>
    <div class="bottom_nav <?=$arParams["DISPLAY_TYPE"];?>" <?=($arParams["AJAX_REQUEST"]=="Y" ? "style='display: none; '" : "");?>>
        <?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?><?=$arResult["NAV_STRING"]?><?}?>
    </div>
    <?if($arParams["AJAX_REQUEST"]=="Y"){?>
        </div>
    <?}/*else{?>
		<?if ($arResult["~DESCRIPTION"]):?>
			<div class="group_description">
				<hr class="long"/>
				<div><?=$arResult["~DESCRIPTION"]?></div>
			</div>
		<?else:?>
			<?$arSection = CIBlockSection::GetList(array(), array( "IBLOCK_ID" => $arResult["IBLOCK_ID"], "ID" => $arResult["ID"] ), false, array( "ID", "UF_SECTION_DESCR"))->GetNext();?>
			<?if ($arSection["UF_SECTION_DESCR"]):?>
				<div class="group_description">
					<hr class="long"/>
					<div><?=$arSection["UF_SECTION_DESCR"]?></div>
				</div>
			<?endif;?>
		<?endif;?>
	<?}*/?>
<?}else{?>
    <div class="no_goods catalog_block_view">
        <div class="no_products">
            <div class="wrap_text_empty">
                <?if($_REQUEST["set_filter"]){?>
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products_filter.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
                <?}else{?>
                    <?$APPLICATION->IncludeFile(SITE_DIR."include/section_no_products.php", Array(), Array("MODE" => "html",  "NAME" => GetMessage('EMPTY_CATALOG_DESCR')));?>
                <?}?>
            </div>
        </div>
        <?if($_REQUEST["set_filter"]){?>
            <span class="button wide"><?=GetMessage('RESET_FILTERS');?></span>
        <?}?>
    </div>
<?}?>
<?if(($arParams["AJAX_REQUEST"]=="N") || !isset($arParams["AJAX_REQUEST"])){?>
    <div class="clear"></div>
<?}?>
<script>
    var fRand = function() {return Math.floor(arguments.length > 1 ? (999999 - 0 + 1) * Math.random() + 0 : (0 + 1) * Math.random());};
    var waitForFinalEvent = (function (){
        var timers = {};
        return function (callback, ms, uniqueId){
            if(!uniqueId){
                uniqueId = fRand();
            }
            if (timers[uniqueId]){
                clearTimeout (timers[uniqueId]);
            }
            timers[uniqueId] = setTimeout(callback, ms);
        };
    })();

    $('.catalog_block').ready(function(){
        $('.catalog_block').equalize({children: '.catalog_item .cost', reset: true});
        $('.catalog_block').equalize({children: '.catalog_item .item-title', reset: true});
        //$('.catalog_block').equalize({children: '.catalog_item .counter_block', reset: true});
        $('.catalog_block').equalize({children: '.catalog_item_wrapp', reset: true});
    })
    BX.message({
        QUANTITY_AVAILIABLE: '<? echo COption::GetOptionString("aspro.mshop", "EXPRESSION_FOR_EXISTS", GetMessage("EXPRESSION_FOR_EXISTS_DEFAULT"), SITE_ID); ?>',
        QUANTITY_NOT_AVAILIABLE: '<? echo COption::GetOptionString("aspro.mshop", "EXPRESSION_FOR_NOTEXISTS", GetMessage("EXPRESSION_FOR_NOTEXISTS"), SITE_ID); ?>',
        ADD_ERROR_BASKET: '<? echo GetMessage("ADD_ERROR_BASKET"); ?>',
        ADD_ERROR_COMPARE: '<? echo GetMessage("ADD_ERROR_COMPARE"); ?>',
    })
</script>