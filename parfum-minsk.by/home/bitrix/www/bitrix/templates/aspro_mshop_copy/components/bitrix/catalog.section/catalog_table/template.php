<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?if( count( $arResult["ITEMS"] ) >= 1 ){?>
    <?$arParams["BASKET_ITEMS"]=($arParams["BASKET_ITEMS"] ? $arParams["BASKET_ITEMS"] : array());?>
    <?if($arParams["AJAX_REQUEST"]=="N"){?>
        <div class="group_description" style="position: relative; z-index: 10;">
            <div>
                <?if(is_array($arResult["DETAIL_PICTURE"])):?>
                    <img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" class="img-in-description">
                <?endif;?>
                <?if(strlen($arResult["~DESCRIPTION"]) > 1000):
                    ?>
                    <div data-height="140px" style="height: 140px; overflow: hidden;" class="full-text"><?=$arResult["~DESCRIPTION"]?> </div>
                    <a href="#" class="show-more-description" data-to-short="<?=GetMessage("CATALOG_HIDE_MORE");?>" data-to-full="<?=GetMessage("CATALOG_SHOW_MORE");?>"><?=GetMessage("CATALOG_SHOW_MORE");?></a>
                <?else:?>
                    <?=$arResult["~DESCRIPTION"]?>
                <?endif;?>
            </div>
            <hr class="long"/>
        </div>
        <table class="module_products_list">
        <tbody>
    <?}?>
    <?$arOfferProps = implode(';', $arParams['OFFERS_CART_PROPERTIES']);?>
    <?foreach($arResult["ITEMS"]  as $arItem){
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
        $totalCount = CMShop::GetTotalCount($arItem);
        $arQuantityData = CMShop::GetQuantityArray($totalCount);

        $strMeasure = '';
        if(!$arItem["OFFERS"] || $arParams['TYPE_SKU'] === 'TYPE_2'){
            if($arParams["SHOW_MEASURE"] == "Y" && $arItem["CATALOG_MEASURE"]){
                $arMeasure = CCatalogMeasure::getList(array(), array("ID" => $arItem["CATALOG_MEASURE"]), false, false, array())->GetNext();
                $strMeasure = $arMeasure["SYMBOL_RUS"];
            }
            $arItem["OFFERS_MORE"]="Y";
            $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"]);
        }
        elseif($arItem["OFFERS"]){
            $strMeasure = $arItem["MIN_PRICE"]["CATALOG_MEASURE_NAME"];
            $arItem["OFFERS_MORE"]="Y";
            $arAddToBasketData = CMShop::GetAddToBasketArray($arItem, $totalCount, $arParams["DEFAULT_COUNT"], $arParams["BASKET_URL"]);
        }
        ?>
        <tr class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <td class="foto-cell">
                <div class="image_wrapper_block">
                    <?if( !empty($arItem["DETAIL_PICTURE"]) || !empty($arItem["PREVIEW_PICTURE"]) ){?>
                        <?
                        $picture=($arItem["PREVIEW_PICTURE"] ? $arItem["PREVIEW_PICTURE"] : $arItem["DETAIL_PICTURE"]);
                        $img_preview = CFile::ResizeImageGet( $picture, array( "width" => 50, "height" => 50 ), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
                        <?if ($arParams["LIST_DISPLAY_POPUP_IMAGE"]=="Y"){?>
                            <a class="popup_image fancy" href="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" title="<?=$arItem["NAME"]?>">
                        <?}?>
                        <img src="<?=$img_preview["src"]?>" alt="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" title="<?=($arItem["PREVIEW_PICTURE"]["ALT"]?$arItem["PREVIEW_PICTURE"]["ALT"]:$arItem["NAME"]);?>" />
                        <?if ($arParams["LIST_DISPLAY_POPUP_IMAGE"]=="Y"){?>
                            </a>
                        <?}?>
                    <?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_small.png" alt="<?=$arItem["NAME"]?>" title="<?=$arItem["NAME"]?>" />
                    <?}?>
                </div>
            </td>
            <td>
                <div class="stickers-gender">

                    <?=GetSexImgs($arItem["PROPERTIES"]["GOODS_TYPE"]["VALUE_XML_ID"]);?>
                </div>

            </td>
            <td class="item-name-cell">
                <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a>
                <?////=$arQuantityData["HTML"];?>
            </td>
            <td class="price-cell">
                <div class="cost prices clearfix">
                    <?
                    /*$frame = $this->createFrame()->begin('');
                    $frame->setBrowserStorage(true);*/
                    ?>
                    <?if( count( $arItem["OFFERS"] ) > 0 ){?>
                        <?$minPrice = false;
                        if (isset($arItem['MIN_PRICE']) || isset($arItem['RATIO_PRICE']))
                            $minPrice = (isset($arItem['RATIO_PRICE']) ? $arItem['RATIO_PRICE'] : $arItem['MIN_PRICE']);
                        $prefix='';
                        if('N' == $arParams['TYPE_SKU'] || $arParams['DISPLAY_TYPE'] =='table'){
                            $prefix=GetMessage("CATALOG_FROM");
                        }
                        if($minPrice["VALUE"]>$minPrice["DISCOUNT_VALUE"]){?>
                            <div class="price">
                                <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                    <?=$prefix;?> <?=$minPrice["PRINT_DISCOUNT_VALUE"];?>
                                    <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                        /<?=$strMeasure?>
                                    <?}?>
                                <?endif;?>
                            </div>
                            <div class="price discount">
                                <strike><?=$minPrice["PRINT_VALUE"];?></strike>
                            </div>
                        <?}else{?>
                            <div class="price">
                                <?if(strlen($minPrice["PRINT_DISCOUNT_VALUE"])):?>
                                    <?=$prefix;?> <?=$minPrice['PRINT_DISCOUNT_VALUE'];?>
                                    <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                        /<?=$strMeasure?>
                                    <?}?>
                                <?endif;?>
                            </div>
                        <?}?>
                    <?}else{?>
                        <?
                        $arCountPricesCanAccess = 0;
                        $min_price_id=0;
                        foreach( $arItem["PRICES"] as $key => $arPrice ) { if($arPrice["CAN_ACCESS"]){$arCountPricesCanAccess++;} }
                        ?>
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
                                <?if($arPrice["VALUE"] > $arPrice["DISCOUNT_VALUE"]){?>
                                    <div class="price">
                                        <?if(strlen($arPrice["PRINT_DISCOUNT_VALUE"])):?>
                                            <?=$arPrice["PRINT_DISCOUNT_VALUE"];?>
                                            <?if (($arParams["SHOW_MEASURE"]=="Y") && $strMeasure){?>
                                                /<?=$strMeasure?>
                                            <?}?>
                                        <?endif;?>
                                    </div>
                                    <div class="price discount">
                                        <strike><?=$arPrice["PRINT_VALUE"];?></strike>
                                    </div>
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
                <div class="adaptive_button">
                    <?=$arAddToBasketData["HTML"]?>
                </div>
            </td>
            <td class="but-cell item_<?=$arItem["ID"]?>">
                <div class="counter_wrapp">
                    <?if($arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] && !count($arItem["OFFERS"]) && $arAddToBasketData["ACTION"] == "ADD"):?>
                        <div class="counter_block" data-item="<?=$arItem["ID"];?>" <?=(in_array($arItem["ID"], $arParams["BASKET_ITEMS"]) ? "style='display: none;'" : "");?>>
                            <span class="minus">-</span>
                            <input type="text" class="text" name="count_items" value="<?=($arParams["DEFAULT_COUNT"] > 0 ? $arParams["DEFAULT_COUNT"] : 1)?>" />
                            <span class="plus">+</span>
                        </div>
                    <?endif;?>
                    <div class="button_block <?=(in_array($arItem["ID"], $arParams["BASKET_ITEMS"])  || $arAddToBasketData["ACTION"] == "ORDER" || !$arAddToBasketData["OPTIONS"]["USE_PRODUCT_QUANTITY_LIST"] ? "wide" : "");?>">
                        <?
                        /*$frame = $this->createFrame()->begin('');
                        $frame->setBrowserStorage(true);*/
                        ?>
                        <!--noindex-->
                        <?=$arAddToBasketData["HTML"]?>
                        <!--/noindex-->
                        <?//$frame->end();?>
                    </div>
                </div>
            </td>
            <?if((!$arItem["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N" ) || ($arParams["DISPLAY_COMPARE"] == "Y")):?>
                <td class="like_icons <?=(((!$arItem["OFFERS"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N" && $arItem["CAN_BUY"]) && ($arParams["DISPLAY_COMPARE"] == "Y")) ? " full" : "")?>">
                    <div class="wrapp_stockers">
                        <div class="like_icons">
                            <?if($arItem["CAN_BUY"] && $arParams["DISPLAY_WISH_BUTTONS"] != "N"):?>
                                <?if(!$arItem["OFFERS"]):?>
                                    <div class="wish_item_button">
                                        <span title="<?=GetMessage('CATALOG_WISH')?>" class="wish_item to" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
                                        <span title="<?=GetMessage('CATALOG_WISH_OUT')?>" class="wish_item in added" style="display: none;" data-item="<?=$arItem["ID"]?>" data-iblock="<?=$arItem["IBLOCK_ID"]?>"><i></i></span>
                                    </div>
                                <?elseif($arItem["OFFERS"]):?>
                                    <?foreach($arItem["OFFERS"] as $arOffer):?>
                                        <?if($arOffer['CAN_BUY']):?>
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
                    </div>
                </td>
            <?endif;?>
        </tr>
    <?}?>
    <?if($arParams["AJAX_REQUEST"]=="N"){?>
        </tbody>
        </table>
    <?}?>
    <?if($arParams["AJAX_REQUEST"]=="Y"){?>
        <div class="wrap_nav">
        <tr style='display: none;'><td>
    <?}?>
    <div class="bottom_nav <?=$arParams["DISPLAY_TYPE"];?>" <?=($arParams["AJAX_REQUEST"]=="Y" ? "style='display: none; '" : "");?>>
        <?if( $arParams["DISPLAY_BOTTOM_PAGER"] == "Y" ){?><?=$arResult["NAV_STRING"]?><?}?>
    </div>
    <?if($arParams["AJAX_REQUEST"]=="Y"){?>
        </td></tr>
        </div>
    <?}else{?>
        <?/*if ($arResult["~DESCRIPTION"]):?>
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
		<?endif;*/?>
    <?}?>
<?}else{?>
    <div class="no_goods">
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