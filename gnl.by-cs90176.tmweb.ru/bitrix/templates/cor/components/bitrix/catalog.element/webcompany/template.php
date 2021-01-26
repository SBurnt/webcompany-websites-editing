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
 * @var string $templateFolder
 */

$this->setFrameMode(true);

$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
//pr($actualItem);
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-default' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['PRODUCT']['SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}
// pictures
$arImages = array();
if( is_array($arResult["DETAIL_PICTURE"]) ) {
    $arImages[] = $arResult['DETAIL_PICTURE'];
}
if(is_array($arResult["PROPERTIES"][$arParams['ARCORP_PROP_MORE_PHOTO']]['VALUE']) && count($arResult["PROPERTIES"][$arParams['ARCORP_PROP_MORE_PHOTO']]['VALUE'])>0) {
    foreach($arResult["PROPERTIES"][$arParams['ARCORP_PROP_MORE_PHOTO']]['VALUE'] as $arImage) {
        $arImages[] = $arImage;
    }
}
//echo '<pre>',print_r($arImages,1),'<pre>';
$tabDescription = ($arResult['DETAIL_TEXT']!='') ? true : false ;
$tabProperties = (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES'])>0) ? true : false;
$tabDocs = false;

?>
<script src='<?=$templateFolder?>/jquery.elevatezoom.js'></script>

<div class="row" id="<?=$itemIds['ID']?>" itemscope itemtype="http://schema.org/Product">
    <div class="col col-md-3">
        <?$APPLICATION->IncludeComponent("bitrix:menu", "catlog_sidebar_menu", array(
            "ALLOW_MULTI_SELECT" => "N",
            "CATALOG_PATH" => "/catalog/",
            "CHILD_MENU_TYPE" => "topsub",
            "CONVERT_CURRENCY" => "N",
            "DELAY" => "N",
            "IBLOCK_ID" => "",
            "MAX_ITEM" => "9",
            "MAX_LEVEL" => "4",
            "MENU_CACHE_GET_VARS" => "",
            "MENU_CACHE_TIME" => "360000000",
            "MENU_CACHE_TYPE" => "A",
            "MENU_CACHE_USE_GROUPS" => "Y",
            "OFFERS_FIELD_CODE" => array(
                0 => "",
                1 => "",
            ),
            "OFFERS_PROPERTY_CODE" => array(
                0 => "",
                1 => "",
            ),
            "PRICE_CODE" => "",
            "PRICE_VAT_INCLUDE" => "N",
            "PRODUCT_QUANTITY_VARIABLE" => "quan",
            "ROOT_MENU_TYPE" => "topsub",
            "USE_EXT" => "Y",
            "USE_PRODUCT_QUANTITY" => "N"
        ),
            false,
            array(
                "ACTIVE_COMPONENT" => "Y"
            )
        );?>
        <?if ($arResult['PROPERTIES']['LEFT_BLOCK']['VALUE']){
            $arSelect = Array("DETAIL_TEXT");
            $arFilter = Array("ID"=>$arResult['PROPERTIES']['LEFT_BLOCK']['VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                //print_r($arFields["~DETAIL_TEXT"]);
                if($arFields["~DETAIL_TEXT"]){?>
                    <div class="left-block-razdel">
                        <?print_r($arFields["~DETAIL_TEXT"]);?>
                    </div>
                <?}
            }
        }?>
    </div>

	<div class="col col-md-9">
        <div class="js-detail js-element js-elementid<?=$arResult['ID']?> col col-md-12" data-elementid="<?=$arResult['ID']?>" data-elementname="<?=CUtil::JSEscape($arResult['NAME'])?>">
            <a class="js-detail_page_url" href="<?=$arResult['DETAIL_PAGE_URL']?>"></a>
			<div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col col-md-12 brcrtitle">
                            <div class="brcr"></div>
                            <div class="ttl"></div>
                        </div>
                        <div class="col col-md-6" id="<?=$itemIds['BIG_SLIDER_ID']?>">
                            <div class="row">
                                <div class="col col-md-12 pic" data-entity="images-container" >
                                    <?
                                    if (is_array($actualItem['MORE_PHOTO']) && count($actualItem['MORE_PHOTO'])>0) {?>
                                        <a  data-entity="image" data-id="<?=$actualItem['MORE_PHOTO'][0]['ID']?>" class="fancyajax hidden-xs changeFromSlider fancybox.ajax active" href="<?=$arResult["DETAIL_PAGE_URL"]?>" title="<?=$arResult["NAME"]?>">
                                    <?}
                                    if(is_array($actualItem['MORE_PHOTO'][0]) && isset($actualItem['MORE_PHOTO'][0]['SRC'])>0) {?>
                                        <img  class="main_pic" src="<?=$actualItem['MORE_PHOTO'][0]['SRC']?>" alt="<?=$alt?>" title="<?=$title?>" itemprop="image">
                                    <?}
                                    if(is_array($actualItem['MORE_PHOTO']) && count($actualItem['MORE_PHOTO'])>0) {?>
                                        </a>
                                        <a data-entity="image" data-id="<?=$actualItem['MORE_PHOTO'][0]['ID']?>" class="hidden-lg hidden-md hidden-sm active"  title="<?=$arResult["NAME"]?>">
                                    <?}
                                    if(is_array($actualItem['MORE_PHOTO'][0]) && isset($actualItem['MORE_PHOTO'][0]['SRC'])>0) {?>
                                        <img class="main_pic" src="<?=$actualItem['MORE_PHOTO'][0]['SRC']?>" alt="<?=$alt?>" title="<?=$title?>" itemprop="image">
                                    <?}
                                    if(is_array($actualItem['MORE_PHOTO']) && count($actualItem['MORE_PHOTO'])>0){?>
                                        </a>
                                    <?}?>
                                </div>
                                <script>
                                    $(".pic img").elevateZoom({});
                                    $(".pic img").on("load", function () {
                                        $(".pic img").elevateZoom({});
                                    });
                                </script>
                                <?

                                if ($haveOffers){
                                    if(is_array($actualItem['MORE_PHOTO']) && count($actualItem['MORE_PHOTO'])>0){?>
                                        <div class="col col-md-12" id="<?=$itemIds['SLIDER_CONT_OF_ID'].$offer['ID']?>">
                                            <div class="thumbs" data-changeto=".changeFromSlider img">
                                                <div class="owlslider">
                                                    <?$index = 0;
                                                    foreach($actualItem['MORE_PHOTO'] as $arImage) {
                                                        $file = CFile::ResizeImageGet($arImage['ID'], array('width'=>120, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                                                        ?>
                                                        <div class="pic<?=$index?><?if($index<1):?> checked<?endif;?> thumb">
                                                            <a href="<?=$arImage['SRC']?>" data-index="<?=$index?>" style="background-image: url('<?=$file['src']?>');">
                                                                <div class="overlay"></div>
                                                            </a>
                                                        </div>
                                                        <?$index++;
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                    <?}
                                }else{
                                    if(is_array($arImages) && count($arImages)>0) {?>
                                        <div class="col col-md-12">
                                            <div class="thumbs" data-changeto=".changeFromSlider img">
                                                <div class="owlslider">
                                                    <?$index = 0;
                                                    foreach($arImages as $arImage){?>
                                                        <div class="pic<?=$index?><?if($index<1):?> checked<?endif;?> thumb">
                                                            <a href="<?=$arImage['SRC']?>" data-index="<?=$index?>" style="background-image: url('<?=$arImage['RESIZE']['src']?>');">
                                                                <div class="overlay"></div>
                                                            </a>
                                                        </div>
                                                        <?$index++;
                                                    }?>
                                                </div>
                                            </div>
                                        </div>
                                    <?}
                                }?>
                            </div>
                        </div>
                        <div class="col col-md-6">
                            <div class="row">

                                <div class="product-item-detail-info-container">
                                    <?$value_price = preg_replace('~\D+~', '', $price['PRICE']);
                                    $eur = COption::GetOptionString("grain.customsettings", "rate_euro");
                                    $usd = COption::GetOptionString("grain.customsettings", "rate_usd");
                                    $rub = COption::GetOptionString("grain.customsettings", "rate_rub");
                                    $textcurrency = round($value_price / $usd, 2) . ' USD<br><br>' . round($value_price / $eur, 2) . ' EUR<br><br>' . round($value_price / $rub * 100, 2) . ' RUB'; ?>
                                    <div class="" id="<?=$itemIds['PRICE_ID']?>">
                                        <?if($value_price > 0):?>
                                            <div class="tooltipprice">
                                                <?= $price['PRINT_RATIO_PRICE']?>
                                                <span class="tooltiptext"><?= $textcurrency ?></span>
                                            </div>
                                        <? else: ?>
                                            <?= $price['PRINT_RATIO_PRICE'] ?>
                                        <?endif; ?>
                                    </div>
                                </div>

                                <?if( $arResult['PREVIEW_TEXT']!='' ){?>
                                    <div class="col col-md-12 previewtext hidden-xs hidden-sm previewtext-height">
                                        <?=$arResult['PREVIEW_TEXT']?>
                                    </div>
                                    <div class="previewtext__btn-wrap col-md-12 hidden-xs hidden-sm">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect width="18" height="18" rx="9" fill="#F3F3F3"/>
                                            <path d="M6 8L9 11L12 8" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <button class="previewtext__btn" type="button">Раскрыть</button>
                                    </div>
                                <?}?>
                                <div class="buyblock">
                                    <div class="row">
                                        <?if( $arParams['RSMONOPOLY_PROP_QUANTITY']!='' ){?>
                                            <div class="col col-md-12 quantity" style="display:none">
                                            <?=GetMessage('RS.MONOPOLY.QUANTITY')?>:
                                            <?if(IntVal($arResult['PROPERTIES'][$arParams['RSMONOPOLY_PROP_QUANTITY']]['VALUE'])<1){?>
                                                <span class="empty"> <?=GetMessage('RS.MONOPOLY.QUANTITY_EMPTY')?></span>
                                            <?}else{?>
                                                <span class="isset"> <?=GetMessage('RS.MONOPOLY.QUANTITY_ISSET')?></span>
                                            <?}?>
                                            </div>
                                        <?}?>
					                </div>
                                    <div class="row part2">
                                        <div class="col">
                                            <div class="new-param">
                                                <?if ($haveOffers && !empty($arResult['OFFERS_PROP'])){?>
                                                    <div id="<?=$itemIds['TREE_ID']?>" class="card-info__select color-select card-info__color-select size-select card-info__size-select" >
                                                        <?foreach ($arResult['SKU_PROPS'] as $skuProperty){
                                                            if($skuProperty['CODE'] !=='CVET') continue;
                                                            if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
                                                                continue;
                                                            $propertyId = $skuProperty['ID'];
                                                            $skuProps[] = array(
                                                                'ID' => $propertyId,
                                                                'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                                                'VALUES' => $skuProperty['VALUES'],
                                                                'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                                                            );?>
                                                            <p class="color-select__selected"><?=htmlspecialcharsEx($skuProperty['NAME'])?>:</p>
                                                            <ul class="color-select__list" data-entity="sku-line-block">
                                                                <?foreach ($skuProperty['VALUES'] as &$value){
                                                                    $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                                                                    if ($skuProperty['SHOW_MODE'] === 'PICT'){?>
                                                                        <li class="color-select__item" title="<?=$value['NAME']?>"
                                                                            data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
                                                                            data-onevalue="<?=$value['ID']?>">
                                                                            <div class="color-select__btn" title="<?=$value['NAME']?>"
                                                                                 data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
                                                                                 data-onevalue="<?=$value['ID']?>"
                                                                                 style="background-image: url('<?=$value['PICT']['SRC']?>');"></div>
                                                                        </li>
                                                                    <?}else{?>
                                                                        <li class="color-select__item" title="<?=$value['NAME']?>"
                                                                            data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
                                                                            data-onevalue="<?=$value['ID']?>">
                                                                            <div class="color-select__btn" title="<?=$value['NAME']?>"
                                                                                 data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
                                                                                 data-onevalue="<?=$value['ID']?>"><?=$value['NAME']?></div>
                                                                        </li>
                                                                    <?}
                                                                }?>
                                                            </ul>
                                                        <?}?>
                                                        <?foreach ($arResult['SKU_PROPS'] as $skuProperty){
                                                            if($skuProperty['CODE'] !=='RAZMER') continue;
                                                            if (!isset($arResult['OFFERS_PROP'][$skuProperty['CODE']]))
                                                                continue;
                                                            $propertyId = $skuProperty['ID'];
                                                            $skuProps[] = array(
                                                                'ID' => $propertyId,
                                                                'SHOW_MODE' => $skuProperty['SHOW_MODE'],
                                                                'VALUES' => $skuProperty['VALUES'],
                                                                'VALUES_COUNT' => $skuProperty['VALUES_COUNT']
                                                            );
                                                            ?>
                                                            <p class="size-select__selected"><?=htmlspecialcharsEx($skuProperty['NAME'])?>:</p>
                                                            <ul class="size-select__list" data-entity="sku-line-block">
                                                                <?foreach ($skuProperty['VALUES'] as &$value) {
                                                                    $value['NAME'] = htmlspecialcharsbx($value['NAME']);
                                                                    if ($skuProperty['SHOW_MODE'] !== 'PICT'){?>
                                                                        <li class="size-select__item" title="<?=$value['NAME']?>"
                                                                            data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
                                                                            data-onevalue="<?=$value['ID']?>">
                                                                            <div class="size-select__btn" title="<?=$value['NAME']?>"
                                                                                 data-treevalue="<?=$propertyId?>_<?=$value['ID']?>"
                                                                                 data-onevalue="<?=$value['ID']?>"><?=$value['NAME']?></div>
                                                                        </li>
                                                                    <?}
                                                                }?>
                                                            </ul>
                                                            <a href="#modal-size-table" class="size-select__table modal-size-table">Таблица размеров</a>
                                                        <?}?>
                                                    </div>
                                                <?}?>
                                                <div class="buttons__wrap">
                                                    <?foreach ($arParams['PRODUCT_PAY_BLOCK_ORDER'] as $blockName){
                                                        switch ($blockName) {
                                                            case 'quantity':
                                                                if ($arParams['USE_PRODUCT_QUANTITY']){?>
                                                                    <div class="side-basket__product-stepper stepper js-stepper" data-entity="quantity-block">
                                                                        <span class="stepper__btn stepper__btn--minus" id="<?=$itemIds['QUANTITY_DOWN_ID']?>">
                                                                            <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M0.913708 1.4712C0.744147 1.4712 0.609375 1.33318 0.609375 1.16467C0.609375 0.996153 0.744147 0.862213 0.913708 0.862213H8.90936C9.07892 0.862213 9.21807 0.996153 9.21807 1.16467C9.21807 1.33318 9.07892 1.47148 8.90936 1.47148H0.913708V1.4712Z" fill="#535353" />
                                                                            </svg>
                                                                        </span>
                                                                        <input class="product-item-amount-field" id="<?=$itemIds['QUANTITY_ID']?>" type="number" value="<?=$price['MIN_QUANTITY']?>">
                                                                        <span class="stepper__btn stepper__btn--plus" id="<?=$itemIds['QUANTITY_UP_ID']?>">
                                                                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M9.59086 4.41317H5.62891V0.475667C5.62891 0.274308 5.46467 0.111084 5.26206 0.111084C5.05945 0.111084 4.89521 0.274308 4.89521 0.475667V4.41317H0.933254C0.730644 4.41317 0.566406 4.57639 0.566406 4.77775C0.566406 4.97911 0.730644 5.14233 0.933254 5.14233H4.89521V9.07983C4.89521 9.28119 5.05945 9.44442 5.26206 9.44442C5.46467 9.44442 5.62891 9.28119 5.62891 9.07983V5.14233H9.59086C9.79347 5.14233 9.95771 4.97911 9.95771 4.77775C9.95771 4.57639 9.79347 4.41317 9.59086 4.41317Z" fill="#535353" />
                                                                            </svg>
                                                                        </span>
<!--                                                                        <span class="product-item-amount-description-container">-->
<!--                                                                            <span id="--><?//=$itemIds['QUANTITY_MEASURE']?><!--">-->
<!--                                                                                --><?//=$actualItem['ITEM_MEASURE']['TITLE']?>
<!--                                                                            </span>-->
<!--                                                                            <span id="--><?//=$itemIds['PRICE_TOTAL']?><!--"></span>-->
<!--                                                                        </span>-->
                                                                    </div>
                                                                    <?
                                                                }

                                                                break;
                                                            case 'buttons':?>
                                                                <div data-entity="main-button-container">
                                                                    <div id="<?=$itemIds['BASKET_ACTIONS_ID']?>">
                                                                        <?if ($showAddBtn){?>
                                                                            <div class="side-basket__go-to-basket">
                                                                                <a class="side-basket__go-to-basket-link" id="<?=$itemIds['ADD_BASKET_LINK']?>"
                                                                                   href="javascript:void(0);">
                                                                                    <?=$arParams['MESS_BTN_ADD_TO_BASKET']?>
                                                                                </a>
                                                                            </div>
                                                                        <?}
                                                                        if ($showBuyBtn){?>
                                                                            <div class="side-basket__go-to-basket">
                                                                                <a class="side-basket__go-to-basket-link" id="<?=$itemIds['BUY_LINK']?>"
                                                                                   href="javascript:void(0);">
                                                                                    <?=$arParams['MESS_BTN_BUY']?>
                                                                                </a>
                                                                            </div>
                                                                        <?}?>
                                                                    </div>
                                                                </div>
                                                            <?break;
                                                        }
                                                    }?>
                                                </div>
                                                <div class="side-basket__fast-order">
                                                    <?$name = '['.$arResult['ID'].'] '.$arResult['NAME'];?>

                                                    <a href="#modal-fast-wrap"
                                                       class="side-basket__fast-order-link modal-fast-wrap"
                                                       data-insertdata='{"RS_EXT_FIELD_0":"<?=CUtil::JSEscape($name)?>"}'>Купить в 1 клик</a>
                                                </div>

                                            </div>
                                            <?if($_GET['succ'] == 'ok'){?>
                                                <script>
                                                    var url = document.location.pathname.split('?');
                                                    window.history.pushState({}, document.title, "" + url[0]);
                                                    setTimeout(function (){
                                                        $('.modal-fast-wrap').fancybox({
                                                            margin: 0,
                                                            padding: [14, 35, 30, 35],
                                                            maxWidth: 350,
                                                            height: 'auto',
                                                            // autoSize: false,
                                                            autoScale: true,
                                                            wrapCSS: 'modal-fast',
                                                            transitionIn: 'none',
                                                            transitionOut: 'none',
                                                            type: 'inline',
                                                            helpers: {
                                                                overlay: {
                                                                    locked: false,
                                                                },
                                                            },
                                                            beforeShow: function () {
                                                                var $element = $(this.element);
                                                                if ($element.data('insertdata') != '' && typeof $element.data('insertdata') == 'object') {
                                                                    setTimeout(function () {
                                                                        var obj = $element.data('insertdata');
                                                                        for (fieldName in obj) {
                                                                            $('.fancybox-inner')
                                                                                .find('[name="' + fieldName + '"]')
                                                                                .val(obj[fieldName]);
                                                                        }
                                                                    }, 50);
                                                                }
                                                                $(document).trigger('ARCORP_fancyBeforeShow');
                                                            }
                                                        }).trigger('click');
                                                    }, 1000);
                                                </script>

                                            <?}?>
                                            <a name="tabs"></a>
                                            <div class="tabs">
                                                <ul class="nav nav-tabs">
                                                    <?if($tabProperties){?>
                                                        <li>
                                                            <a class="properties" href="#properties" data-toggle="tab"><?= GetMessage('AR.CORP.PROPERTIES') ?></a>
                                                        </li>
                                                    <?}
                                                    if($tabDescription){?>
                                                        <li>
                                                            <a class="detailtext" href="#description" data-toggle="tab"><?= GetMessage('AR.CORP.DESCRIPTION') ?></a>
                                                        </li>
                                                    <?}?>
                                                </ul>
                                                <div class="tab-content"><?
                                                    if ($tabProperties) {?>
                                                        <div class="tab-pane fade" id="properties">
                                                            <div class="row proptable">
                                                                <div class="col col-md-12">
                                                                    <table>
                                                                        <tbody>
                                                                            <?foreach ($arResult['DISPLAY_PROPERTIES'] as $code => $arProp) {?>

                                                                                <tr class="prop_<?= $code ?>">
                                                                                    <?if($code =="PRICE") continue; ?>
                                                                                    <td class="name"><?= $arProp['NAME']?></td>
                                                                                    <?if ($code == 'PRICE'):?>
                                                                                        <? $value_price = preg_replace('~\D+~', '', $arProp['DISPLAY_VALUE']);
                                                                                        $eur = COption::GetOptionString("grain.customsettings", "rate_euro");
                                                                                        $usd = COption::GetOptionString("grain.customsettings", "rate_usd");
                                                                                        $rub = COption::GetOptionString("grain.customsettings", "rate_rub");
                                                                                        $textcurrency = round($value_price / $usd, 2) . ' USD<br><br>' . round($value_price / $eur, 2) . ' EUR<br><br>' . round($value_price / $rub * 100, 2) . ' RUB'; ?>
                                                                                    <?endif; ?>
                                                                                    <td class="val">
                                                                                        <?if($value_price > 0 && $code == 'PRICE'):?>
                                                                                            <div class="tooltipprice"><?= $arProp['DISPLAY_VALUE'] ?>
                                                                                                <span class="tooltiptext"><?= $textcurrency ?></span>
                                                                                            </div>
                                                                                            <style>
                                                                                                .buyblock a.fancyajax {
                                                                                                    border: 1px solid #464450;
                                                                                                    color: #464450;
                                                                                                }

                                                                                                .buyblock a.fancyajax:hover {
                                                                                                    color: #fff;
                                                                                                    background-color: #464450;
                                                                                                    border: 1px solid #464450;
                                                                                                    border-bottom-color: transparent;
                                                                                                    cursor: default;
                                                                                                }

                                                                                                .js-detail .buyblock {
                                                                                                    border: none;
                                                                                                }

                                                                                                .tooltipprice {
                                                                                                    position: relative;
                                                                                                    display: inline-block;
                                                                                                    cursor: pointer;
                                                                                                    border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
                                                                                                }

                                                                                                /* Tooltip text */
                                                                                                .tooltipprice .tooltiptext {
                                                                                                    visibility: hidden;
                                                                                                    width: 120px;
                                                                                                    background-color: #555;
                                                                                                    color: #fff;
                                                                                                    text-align: center;
                                                                                                    padding: 5px 0;
                                                                                                    border-radius: 6px;

                                                                                                    /* Position the tooltip text */
                                                                                                    position: absolute;
                                                                                                    z-index: 1;
                                                                                                    bottom: 125%;
                                                                                                    left: 50%;
                                                                                                    margin-left: -60px;

                                                                                                    /* Fade in tooltip */
                                                                                                    opacity: 0;
                                                                                                    transition: opacity 1s;
                                                                                                }

                                                                                                /* Tooltip arrow */
                                                                                                .tooltipprice .tooltiptext::after {
                                                                                                    content: "";
                                                                                                    position: absolute;
                                                                                                    top: 100%;
                                                                                                    left: 50%;
                                                                                                    margin-left: -5px;
                                                                                                    border-width: 5px;
                                                                                                    border-style: solid;
                                                                                                    border-color: #555 transparent transparent transparent;
                                                                                                }

                                                                                                /* Show the tooltip text when you mouse over the tooltip container */
                                                                                                .tooltipprice:hover .tooltiptext {
                                                                                                    visibility: visible;
                                                                                                    opacity: 1;
                                                                                                }
                                                                                            </style>

                                                                                        <? else: ?>
                                                                                            <?= $arProp['DISPLAY_VALUE'] ?>
                                                                                        <?endif; ?>
                                                                                    </td>
                                                                                </tr>
                                                                            <?}?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?}
                                                    if ($tabDescription) {?>
                                                        <div class="tab-pane fade" id="description"><?= $arResult['DETAIL_TEXT'] ?></div>
                                                    <?}?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
        <div class="print-version">
            <?/*<a href="<?=$APPLICATION->GetCurPageParam("print=y", array("print"));?>" target="_blank">Версия для печати</a>*/?>
        </div>
        <div class="col-md-12 text-center to-top">
            <a><img src="/bitrix/templates/cor/img/up.png" alt="Вверх"></a>
        </div>
	</div>

	<meta itemprop="name" content="<?=$name?>" />
	<meta itemprop="category" content="<?=$arResult['CATEGORY_PATH']?>" />
	<?
	if ($haveOffers){
		foreach ($arResult['JS_OFFERS'] as $offer){
			$currentOffersList = array();
			if (!empty($offer['TREE']) && is_array($offer['TREE'])) {
				foreach ($offer['TREE'] as $propName => $skuId) {
					$propId = (int)mb_substr($propName, 5);
					foreach ($skuProps as $prop) {
						if ($prop['ID'] == $propId) {
							foreach ($prop['VALUES'] as $propId => $propValue) {
								if ($propId == $skuId) {
									$currentOffersList[] = $propValue['NAME'];
									break;
								}
							}
						}
					}
				}
			}

			$offerPrice = $offer['ITEM_PRICES'][$offer['ITEM_PRICE_SELECTED']];
			?>
			<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<meta itemprop="sku" content="<?=htmlspecialcharsbx(implode('/', $currentOffersList))?>" />
				<meta itemprop="price" content="<?=$offerPrice['RATIO_PRICE']?>" />
				<meta itemprop="priceCurrency" content="<?=$offerPrice['CURRENCY']?>" />
				<link itemprop="availability" href="http://schema.org/<?=($offer['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
			</span>
			<?
		}

		unset($offerPrice, $currentOffersList);
	}else{
		?>
		<span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
			<meta itemprop="price" content="<?=$price['RATIO_PRICE']?>" />
			<meta itemprop="priceCurrency" content="<?=$price['CURRENCY']?>" />
			<link itemprop="availability" href="http://schema.org/<?=($actualItem['CAN_BUY'] ? 'InStock' : 'OutOfStock')?>" />
		</span>
		<?
	}
	?>
</div>
<?
if ($haveOffers) {
	$offerIds = array();
	$offerCodes = array();

	$useRatio = $arParams['USE_RATIO_IN_RANGES'] === 'Y';

	foreach ($arResult['JS_OFFERS'] as $ind => &$jsOffer)
	{
		$offerIds[] = (int)$jsOffer['ID'];
		$offerCodes[] = $jsOffer['CODE'];

		$fullOffer = $arResult['OFFERS'][$ind];
		$measureName = $fullOffer['ITEM_MEASURE']['TITLE'];

		$strAllProps = '';
		$strMainProps = '';
		$strPriceRangesRatio = '';
		$strPriceRanges = '';

		if ($arResult['SHOW_OFFERS_PROPS'])
		{
			if (!empty($jsOffer['DISPLAY_PROPERTIES']))
			{
				foreach ($jsOffer['DISPLAY_PROPERTIES'] as $property)
				{
					$current = '<dt>'.$property['NAME'].'</dt><dd>'.(
						is_array($property['VALUE'])
							? implode(' / ', $property['VALUE'])
							: $property['VALUE']
						).'</dd>';
					$strAllProps .= $current;

					if (isset($arParams['MAIN_BLOCK_OFFERS_PROPERTY_CODE'][$property['CODE']]))
					{
						$strMainProps .= $current;
					}
				}

				unset($current);
			}
		}

		if ($arParams['USE_PRICE_COUNT'] && count($jsOffer['ITEM_QUANTITY_RANGES']) > 1)
		{
			$strPriceRangesRatio = '('.Loc::getMessage(
					'CT_BCE_CATALOG_RATIO_PRICE',
					array('#RATIO#' => ($useRatio
							? $fullOffer['ITEM_MEASURE_RATIOS'][$fullOffer['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']
							: '1'
						).' '.$measureName)
				).')';

			foreach ($jsOffer['ITEM_QUANTITY_RANGES'] as $range)
			{
				if ($range['HASH'] !== 'ZERO-INF')
				{
					$itemPrice = false;

					foreach ($jsOffer['ITEM_PRICES'] as $itemPrice)
					{
						if ($itemPrice['QUANTITY_HASH'] === $range['HASH'])
						{
							break;
						}
					}

					if ($itemPrice)
					{
						$strPriceRanges .= '<dt>'.Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_FROM',
								array('#FROM#' => $range['SORT_FROM'].' '.$measureName)
							).' ';

						if (is_infinite($range['SORT_TO']))
						{
							$strPriceRanges .= Loc::getMessage('CT_BCE_CATALOG_RANGE_MORE');
						}
						else
						{
							$strPriceRanges .= Loc::getMessage(
								'CT_BCE_CATALOG_RANGE_TO',
								array('#TO#' => $range['SORT_TO'].' '.$measureName)
							);
						}

						$strPriceRanges .= '</dt><dd>'.($useRatio ? $itemPrice['PRINT_RATIO_PRICE'] : $itemPrice['PRINT_PRICE']).'</dd>';
					}
				}
			}

			unset($range, $itemPrice);
		}

		$jsOffer['DISPLAY_PROPERTIES'] = $strAllProps;
		$jsOffer['DISPLAY_PROPERTIES_MAIN_BLOCK'] = $strMainProps;
		$jsOffer['PRICE_RANGES_RATIO_HTML'] = $strPriceRangesRatio;
		$jsOffer['PRICE_RANGES_HTML'] = $strPriceRanges;
	}

	$templateData['OFFER_IDS'] = $offerIds;
	$templateData['OFFER_CODES'] = $offerCodes;
	unset($jsOffer, $strAllProps, $strMainProps, $strPriceRanges, $strPriceRangesRatio, $useRatio);

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => true,
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
			'OFFER_GROUP' => $arResult['OFFER_GROUP'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'VISUAL' => $itemIds,
		'DEFAULT_PICTURE' => array(
			'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
			'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
		),
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'NAME' => $arResult['~NAME'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		),
		'OFFERS' => $arResult['JS_OFFERS'],
		'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
		'TREE_PROPS' => $skuProps
	);
}
else
{
	$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
	if ($arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y' && !$emptyProductProperties)
	{
		?>
		<div id="<?=$itemIds['BASKET_PROP_DIV']?>" style="display: none;">
			<?
			if (!empty($arResult['PRODUCT_PROPERTIES_FILL']))
			{
				foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propId => $propInfo)
				{
					?>
					<input type="hidden" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]" value="<?=htmlspecialcharsbx($propInfo['ID'])?>">
					<?
					unset($arResult['PRODUCT_PROPERTIES'][$propId]);
				}
			}

			$emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
			if (!$emptyProductProperties)
			{
				?>
				<table>
					<?
					foreach ($arResult['PRODUCT_PROPERTIES'] as $propId => $propInfo)
					{
						?>
						<tr>
							<td><?=$arResult['PROPERTIES'][$propId]['NAME']?></td>
							<td>
								<?
								if (
									$arResult['PROPERTIES'][$propId]['PROPERTY_TYPE'] === 'L'
									&& $arResult['PROPERTIES'][$propId]['LIST_TYPE'] === 'C'
								)
								{
									foreach ($propInfo['VALUES'] as $valueId => $value)
									{
										?>
										<label>
											<input type="radio" name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]"
												value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"checked"' : '')?>>
											<?=$value?>
										</label>
										<br>
										<?
									}
								}
								else
								{
									?>
									<select name="<?=$arParams['PRODUCT_PROPS_VARIABLE']?>[<?=$propId?>]">
										<?
										foreach ($propInfo['VALUES'] as $valueId => $value)
										{
											?>
											<option value="<?=$valueId?>" <?=($valueId == $propInfo['SELECTED'] ? '"selected"' : '')?>>
												<?=$value?>
											</option>
											<?
										}
										?>
									</select>
									<?
								}
								?>
							</td>
						</tr>
						<?
					}
					?>
				</table>
				<?
			}
			?>
		</div>
		<?
	}

	$jsParams = array(
		'CONFIG' => array(
			'USE_CATALOG' => $arResult['CATALOG'],
			'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'SHOW_PRICE' => !empty($arResult['ITEM_PRICES']),
			'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'] === 'Y',
			'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'] === 'Y',
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
			'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
			'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
			'SHOW_CLOSE_POPUP' => $arParams['SHOW_CLOSE_POPUP'] === 'Y',
			'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
			'RELATIVE_QUANTITY_FACTOR' => $arParams['RELATIVE_QUANTITY_FACTOR'],
			'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
			'USE_STICKERS' => true,
			'USE_SUBSCRIBE' => $showSubscribe,
			'SHOW_SLIDER' => $arParams['SHOW_SLIDER'],
			'SLIDER_INTERVAL' => $arParams['SLIDER_INTERVAL'],
			'ALT' => $alt,
			'TITLE' => $title,
			'MAGNIFIER_ZOOM_PERCENT' => 200,
			'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
			'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
			'BRAND_PROPERTY' => !empty($arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']])
				? $arResult['DISPLAY_PROPERTIES'][$arParams['BRAND_PROPERTY']]['DISPLAY_VALUE']
				: null
		),
		'VISUAL' => $itemIds,
		'PRODUCT_TYPE' => $arResult['PRODUCT']['TYPE'],
		'PRODUCT' => array(
			'ID' => $arResult['ID'],
			'ACTIVE' => $arResult['ACTIVE'],
			'PICT' => reset($arResult['MORE_PHOTO']),
			'NAME' => $arResult['~NAME'],
			'SUBSCRIPTION' => true,
			'ITEM_PRICE_MODE' => $arResult['ITEM_PRICE_MODE'],
			'ITEM_PRICES' => $arResult['ITEM_PRICES'],
			'ITEM_PRICE_SELECTED' => $arResult['ITEM_PRICE_SELECTED'],
			'ITEM_QUANTITY_RANGES' => $arResult['ITEM_QUANTITY_RANGES'],
			'ITEM_QUANTITY_RANGE_SELECTED' => $arResult['ITEM_QUANTITY_RANGE_SELECTED'],
			'ITEM_MEASURE_RATIOS' => $arResult['ITEM_MEASURE_RATIOS'],
			'ITEM_MEASURE_RATIO_SELECTED' => $arResult['ITEM_MEASURE_RATIO_SELECTED'],
			'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
			'SLIDER' => $arResult['MORE_PHOTO'],
			'CAN_BUY' => $arResult['CAN_BUY'],
			'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
			'QUANTITY_FLOAT' => is_float($arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO']),
			'MAX_QUANTITY' => $arResult['PRODUCT']['QUANTITY'],
			'STEP_QUANTITY' => $arResult['ITEM_MEASURE_RATIOS'][$arResult['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'],
			'CATEGORY' => $arResult['CATEGORY_PATH']
		),
		'BASKET' => array(
			'ADD_PROPS' => $arParams['ADD_PROPERTIES_TO_BASKET'] === 'Y',
			'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'EMPTY_PROPS' => $emptyProductProperties,
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
			'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
		)
	);
	unset($emptyProductProperties);
}

if ($arParams['DISPLAY_COMPARE'])
{
	$jsParams['COMPARE'] = array(
		'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
		'COMPARE_DELETE_URL_TEMPLATE' => $arResult['~COMPARE_DELETE_URL_TEMPLATE'],
		'COMPARE_PATH' => $arParams['COMPARE_PATH']
	);
}
?>
<script>
	BX.message({
		ECONOMY_INFO_MESSAGE: '<?=GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO2')?>',
		TITLE_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR')?>',
		TITLE_BASKET_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS')?>',
		BASKET_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR')?>',
		BTN_SEND_PROPS: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS')?>',
		BTN_MESSAGE_BASKET_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT')?>',
		BTN_MESSAGE_CLOSE: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE')?>',
		BTN_MESSAGE_CLOSE_POPUP: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP')?>',
		TITLE_SUCCESSFUL: '<?=GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK')?>',
		COMPARE_MESSAGE_OK: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK')?>',
		COMPARE_UNKNOWN_ERROR: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR')?>',
		COMPARE_TITLE: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE')?>',
		BTN_MESSAGE_COMPARE_REDIRECT: '<?=GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT')?>',
		PRODUCT_GIFT_LABEL: '<?=GetMessageJS('CT_BCE_CATALOG_PRODUCT_GIFT_LABEL')?>',
		PRICE_TOTAL_PREFIX: '<?=GetMessageJS('CT_BCE_CATALOG_MESS_PRICE_TOTAL_PREFIX')?>',
		RELATIVE_QUANTITY_MANY: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_MANY'])?>',
		RELATIVE_QUANTITY_FEW: '<?=CUtil::JSEscape($arParams['MESS_RELATIVE_QUANTITY_FEW'])?>',
        CURS_EURO: '<?=COption::GetOptionString("grain.customsettings", "rate_euro")?>',
        CURS_DOL: '<?=COption::GetOptionString("grain.customsettings", "rate_usd")?>',
        CURS_RUB: '<?=COption::GetOptionString("grain.customsettings", "rate_rub")?>',
		SITE_ID: '<?=CUtil::JSEscape($component->getSiteId())?>'
	});

	var <?=$obName?> = new JCCatalogElement(<?=CUtil::PhpToJSObject($jsParams, false, true)?>);
</script>
    <script>
        if($('.js-brcrtitle').length>0 && $('.js-detail').find('.brcrtitle').length>0) {
            $('.js-detail').find('.brcrtitle').find('.brcr').html( $('.js-brcrtitle').html() );
            $('.js-detail').find('.brcrtitle').find('.ttl').html( $('.js-ttl').html() );
            $('html').addClass('detailprodpage');
        }
    </script>
    <style>
        .popupgallery .thumbs {overflow-y: auto!important;}
        .zoomContainer2, .zoomLens {z-index:10000!important}
    </style>
    <style>
        .buyblock a.fancyajax {
            border: 1px solid #464450;
            color: #464450;
        }

        .buyblock a.fancyajax:hover {
            color: #fff;
            background-color: #464450;
            border: 1px solid #464450;
            border-bottom-color: transparent;
            cursor: default;
        }

        .js-detail .buyblock {
            border: none;
        }

        .tooltipprice {
            position: relative;
            display: inline-block;
            cursor: pointer;
            border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
        }

        /* Tooltip text */
        .tooltipprice .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color: #555;
            color: #fff;
            text-align: center;
            padding: 5px 0;
            border-radius: 6px;

            /* Position the tooltip text */
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -60px;

            /* Fade in tooltip */
            opacity: 0;
            transition: opacity 1s;
        }

        /* Tooltip arrow */
        .tooltipprice .tooltiptext::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #555 transparent transparent transparent;
        }

        /* Show the tooltip text when you mouse over the tooltip container */
        .tooltipprice:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }

        .tooltipprice {
            margin-left: 15px;
            font-weight: 500;
            font-size: 30px;
            line-height: 35px;
        }

        .tooltipprice .tooltiptext {
        z-index: 99 !important;
        font-size: 14px;
        font-weight: 400;
        line-height: 18px;
        }
    </style>
<?
unset($actualItem, $itemIds, $jsParams);