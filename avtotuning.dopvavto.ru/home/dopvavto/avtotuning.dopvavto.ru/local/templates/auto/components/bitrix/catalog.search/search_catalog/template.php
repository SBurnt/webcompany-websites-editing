<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

use Bitrix\Main\Loader;

$this->setFrameMode(true);

global $searchFilter;

if (Loader::includeModule('search'))
{?>
<div style="display: none">
<?php
    $arElements = $APPLICATION->IncludeComponent(
        "bitrix:search.page",
        ".default",
        Array(
            "RESTART" => $arParams["RESTART"],
            "NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
            "USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
            "CHECK_DATES" => $arParams["CHECK_DATES"],
            "arrFILTER" => array("iblock_".$arParams["IBLOCK_TYPE"]),
            "arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
            "USE_TITLE_RANK" => $arParams['USE_TITLE_RANK'],
            "DEFAULT_SORT" => "rank",
            "FILTER_NAME" => "",
            "SHOW_WHERE" => "N",
            "arrWHERE" => array(),
            "SHOW_WHEN" => "N",
            "PAGE_RESULT_COUNT" => (isset($arParams["PAGE_RESULT_COUNT"]) ? $arParams["PAGE_RESULT_COUNT"] : 50),
            "DISPLAY_TOP_PAGER" => "N",
            "DISPLAY_BOTTOM_PAGER" => "N",
            "PAGER_TITLE" => "",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => "N",
        ),
        $component,
        array('HIDE_ICONS' => 'Y')
    );?>
</div>
    <?
    if (!empty($arElements) && is_array($arElements))
    {
        $searchFilter = array(
            "ID" => $arElements,
        );
        if ($arParams['USE_SEARCH_RESULT_ORDER'] === 'Y')
        {
            $elementOrder = array(
                "ELEMENT_SORT_FIELD" => "ID",
                "ELEMENT_SORT_ORDER" => $arElements
            );
        }
    }
    else
    {
        if (is_array($arElements))
        {
            echo GetMessage("CT_BCSE_NOT_FOUND");
            return;
        }
    }
}
else {
    $searchQuery = '';
//	if (isset($_REQUEST['q']) && is_string($_REQUEST['q']))
    if (isset($_REQUEST['q']) && is_string($_REQUEST['q']))
        $searchQuery = trim($_REQUEST['q']);
    if ($searchQuery !== '') {
        $art = '%' . $searchQuery . '%';
        $searchFilter = array(
//		        'LOGIC'=>'OR',
//            array('PROPERTY_ARTICUL' => $art),

            array('*SEARCHABLE_CONTENT' => $searchQuery),
        );
    }
//	pr($searchFilter);
    unset($searchQuery);
}
?>
<div id="content" class="category-content">
    <div class="wrapper">
        <div class="content clearfix">
            <? include $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/include/inc/left-sidebar.php';?>
            <div class="right-col rad">
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "template_bread",
                    Array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );?>
                <div class="shop">
                    <h2 class="shop__title category rg">Поиск</h2>
                </div>
                <div class="cat__text">
                    <p>
                        <?$APPLICATION->IncludeComponent(
                            "bitrix:main.include",
                            "",
                            Array(
                                "AREA_FILE_SHOW" => "file",
                                "AREA_FILE_SUFFIX" => "inc",
                                "EDIT_TEMPLATE" => "",
                                "PATH" => SITE_TEMPLATE_PATH."/include/search-text.php"
                            )
                        );?>
                    </p>
                </div>
                <?if (isset($_GET["sort"]) && isset($_GET["order"]) && (
                        $_GET["sort"] == "name" ||
                        $_GET["sort"] == "catalog_PRICE_1" ||
                        $_GET["sort"] == "property_rating" ||
                        $_GET["sort"] == "timestamp_x"))
                {
                    $arParams["ELEMENT_SORT_FIELD"] =  $_GET["sort"];
                    $arParams["ELEMENT_SORT_ORDER"] = $_GET["order"];
                }
                ?>
                <div class="sort main_flex flex__align-items_center">
                    <div class="sort__controls">
                        <span class="rg">Сортировать по:</span>
                        <ul>
                            <a href="<?=$arResult["SECTION_PAGE_URL"]?>?q=<?=trim($_REQUEST['q'])?>&sort=name&order=<?if ($_GET["order"] == "asc" && $_GET["sort"] == "name"): echo 'desc'; else: echo 'asc'; endif;?>">
                                <li <?if ($_GET["sort"] == "name"):?> class="active" <?endif;?>>названию<span class="arrow"></span></li>
                            </a>
                            <a href="<?=$arResult["SECTION_PAGE_URL"]?>?q=<?=trim($_REQUEST['q'])?>&sort=catalog_PRICE_1&order=<?if ($_GET["order"] == "asc" && $_GET["sort"] == "catalog_PRICE_1"): echo 'desc'; else: echo 'asc'; endif;?>">
                                <li <?if ($_GET["sort"] == "catalog_PRICE_1"):?> class="active" <?endif;?>>цене<span class="arrow"></span></li>
                            </a>
                            <a href="<?=$arResult["SECTION_PAGE_URL"]?>?q=<?=trim($_REQUEST['q'])?>&sort=property_rating&order=<?if ($_GET["order"] == "asc" && $_GET["sort"] == "property_rating"): echo 'desc'; else: echo 'asc'; endif;?>">
                                <li <?if ($_GET["sort"] == "property_rating"):?> class="active" <?endif;?>>рейтингу<span class="arrow"></span></li>
                            </a>
                            <a href="<?=$arResult["SECTION_PAGE_URL"]?>?q=<?=trim($_REQUEST['q'])?>&sort=timestamp_x&order=<?if ($_GET["order"] == "asc" && $_GET["sort"] == "timestamp_x"): echo 'desc'; else: echo 'asc'; endif;?>">
                                <li <?if ($_GET["sort"] == "timestamp_x"):?> class="active" <?endif;?>>дате поступления<span class="arrow"></span></li>
                            </a>
                        </ul>
                        <div class="show-items">

                            <?
                            $count_view = $APPLICATION->get_cookie("COUNT_VIEW");

                            if(!(int)$count_view)
                                $count_view = 10;

                            if($_GET['count'] == 10)
                                $count_view = 10;
                            if($_GET['count'] == 50)
                                $count_view = 50;
                            if($_GET['count'] == 100)
                                $count_view = 100;

                            if($_GET['count'])
                            {
                                global $APPLICATION;
                                $APPLICATION->set_cookie("COUNT_VIEW", $count_view, time()+60*60*24*30);
                            }

                            ?>

                            <span>
                    Показывать по:
                </span>
                            <ul>
                                <li <?=($count_view != 50 && $count_view != 100) ? ' class="active"' : '';?>>
                                    <a href="?q=<?=trim($_REQUEST['q'])?>&count=20">
                                        20
                                    </a>
                                </li>
                                <li <?=($count_view == 50) ? ' class="active"' : '';?>>
                                    <a href="?q=<?=trim($_REQUEST['q'])?>&count=50">
                                        50
                                    </a>
                                </li>
                                <li <?=($count_view == 100) ? ' class="active"' : '';?>>
                                    <a href="?q=<?=trim($_REQUEST['q'])?>&count=100">
                                        100
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                <?
                $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    ".default",
                    array(
                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                        "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                        "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                        "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                        "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                        "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                        "PROPERTY_CODE" => $arParams["PROPERTY_CODE"],
                        "PROPERTY_CODE_MOBILE" => (isset($arParams["PROPERTY_CODE_MOBILE"]) ? $arParams["PROPERTY_CODE_MOBILE"] : []),
                        "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                        "OFFERS_FIELD_CODE" => $arParams["OFFERS_FIELD_CODE"],
                        "OFFERS_PROPERTY_CODE" => $arParams["OFFERS_PROPERTY_CODE"],
                        "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                        "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                        "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                        "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                        "OFFERS_LIMIT" => $arParams["OFFERS_LIMIT"],
                        "SECTION_URL" => $arParams["SECTION_URL"],
                        "DETAIL_URL" => $arParams["DETAIL_URL"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                        "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                        "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                        "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                        "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "DISPLAY_COMPARE" => $arParams["DISPLAY_COMPARE"],
                        "PRICE_CODE" => $arParams["~PRICE_CODE"],
                        "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                        "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
                        "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                        "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],
                        "USE_PRODUCT_QUANTITY" => $arParams["USE_PRODUCT_QUANTITY"],
                        "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                        "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                        "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                        "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                        "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
                        "HIDE_NOT_AVAILABLE_OFFERS" => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                        "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                        "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                        "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                        "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                        "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                        "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                        "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                        "LAZY_LOAD" => (isset($arParams["LAZY_LOAD"]) ? $arParams["LAZY_LOAD"] : 'N'),
                        "MESS_BTN_LAZY_LOAD" => (isset($arParams["~MESS_BTN_LAZY_LOAD"]) ? $arParams["~MESS_BTN_LAZY_LOAD"] : ''),
                        "LOAD_ON_SCROLL" => (isset($arParams["LOAD_ON_SCROLL"]) ? $arParams["LOAD_ON_SCROLL"] : 'N'),
                        "FILTER_NAME" => "searchFilter",
                        "SECTION_ID" => "",
                        "SECTION_CODE" => "",
                        "SECTION_USER_FIELDS" => array(),
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "SHOW_ALL_WO_SECTION" => "Y",
                        "META_KEYWORDS" => "",
                        "META_DESCRIPTION" => "",
                        "BROWSER_TITLE" => "",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "SET_TITLE" => "N",
                        "SET_STATUS_404" => "N",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "N",

                        'LABEL_PROP' => (isset($arParams['LABEL_PROP']) ? $arParams['LABEL_PROP'] : ''),
                        'LABEL_PROP_MOBILE' => (isset($arParams['LABEL_PROP_MOBILE']) ? $arParams['LABEL_PROP_MOBILE'] : ''),
                        'LABEL_PROP_POSITION' => (isset($arParams['LABEL_PROP_POSITION']) ? $arParams['LABEL_PROP_POSITION'] : ''),
                        'ADD_PICT_PROP' => (isset($arParams['ADD_PICT_PROP']) ? $arParams['ADD_PICT_PROP'] : ''),
                        'PRODUCT_DISPLAY_MODE' => (isset($arParams['PRODUCT_DISPLAY_MODE']) ? $arParams['PRODUCT_DISPLAY_MODE'] : ''),
                        'PRODUCT_BLOCKS_ORDER' => (isset($arParams['PRODUCT_BLOCKS_ORDER']) ? $arParams['PRODUCT_BLOCKS_ORDER'] : ''),
                        'PRODUCT_ROW_VARIANTS' => (isset($arParams['PRODUCT_ROW_VARIANTS']) ? $arParams['PRODUCT_ROW_VARIANTS'] : ''),
                        'ENLARGE_PRODUCT' => (isset($arParams['ENLARGE_PRODUCT']) ? $arParams['ENLARGE_PRODUCT'] : ''),
                        'ENLARGE_PROP' => (isset($arParams['ENLARGE_PROP']) ? $arParams['ENLARGE_PROP'] : ''),
                        'SHOW_SLIDER' => (isset($arParams['SHOW_SLIDER']) ? $arParams['SHOW_SLIDER'] : 'Y'),
                        'SLIDER_INTERVAL' => (isset($arParams['SLIDER_INTERVAL']) ? $arParams['SLIDER_INTERVAL'] : '3000'),
                        'SLIDER_PROGRESS' => (isset($arParams['SLIDER_PROGRESS']) ? $arParams['SLIDER_PROGRESS'] : 'N'),

                        'OFFER_ADD_PICT_PROP' => (isset($arParams['OFFER_ADD_PICT_PROP']) ? $arParams['OFFER_ADD_PICT_PROP'] : ''),
                        'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
                        'PRODUCT_SUBSCRIPTION' => (isset($arParams['PRODUCT_SUBSCRIPTION']) ? $arParams['PRODUCT_SUBSCRIPTION'] : ''),
                        'SHOW_DISCOUNT_PERCENT' => (isset($arParams['SHOW_DISCOUNT_PERCENT']) ? $arParams['SHOW_DISCOUNT_PERCENT'] : ''),
                        'SHOW_OLD_PRICE' => (isset($arParams['SHOW_OLD_PRICE']) ? $arParams['SHOW_OLD_PRICE'] : ''),
                        'SHOW_MAX_QUANTITY' => (isset($arParams['SHOW_MAX_QUANTITY']) ? $arParams['SHOW_MAX_QUANTITY'] : ''),
                        'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                        'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                        'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                        'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                        'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                        'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                        'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                        'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                        'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                        'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                        'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                        'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                        'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                        'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                        'ADD_TO_BASKET_ACTION' => (isset($arParams['ADD_TO_BASKET_ACTION']) ? $arParams['ADD_TO_BASKET_ACTION'] : ''),
                        'SHOW_CLOSE_POPUP' => (isset($arParams['SHOW_CLOSE_POPUP']) ? $arParams['SHOW_CLOSE_POPUP'] : ''),
                        'COMPARE_PATH' => (isset($arParams['COMPARE_PATH']) ? $arParams['COMPARE_PATH'] : ''),
                        'COMPARE_NAME' => (isset($arParams['COMPARE_NAME']) ? $arParams['COMPARE_NAME'] : ''),
                        'USE_COMPARE_LIST' => (isset($arParams['USE_COMPARE_LIST']) ? $arParams['USE_COMPARE_LIST'] : '')
                    ),
                    $arResult["THEME_COMPONENT"],
                    array('HIDE_ICONS' => 'Y')
                );?>
                </div>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:breadcrumb",
                    "template_bread",
                    Array(
                        "PATH" => "",
                        "SITE_ID" => "s1",
                        "START_FROM" => "0"
                    )
                );?>
            </div>
        </div>
    </div>
</div>
