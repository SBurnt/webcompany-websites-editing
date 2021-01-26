<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

/**
 * @global CMain $APPLICATION
 * @var CBitrixComponent $component
 * @var array $arParams
 * @var array $arResult
 * @var array $arCurSection
 */

if (isset($arParams['USE_COMMON_SETTINGS_BASKET_POPUP']) && $arParams['USE_COMMON_SETTINGS_BASKET_POPUP'] == 'Y') {
    $basketAction = isset($arParams['COMMON_ADD_TO_BASKET_ACTION']) ? $arParams['COMMON_ADD_TO_BASKET_ACTION'] : '';
} else {
    $basketAction = isset($arParams['SECTION_ADD_TO_BASKET_ACTION']) ? $arParams['SECTION_ADD_TO_BASKET_ACTION'] : '';
}

$name = '';
$res = CIBlockSection::GetByID($arCurSection['ID']);
if ($ar_res = $res->GetNext())
    $name = $ar_res['NAME'];
?>

<section class="product-catalog door-catalog pb-none">
  <div class="container">
    <div class="row">
      <div class="section-title">
        <h1 class="title ff-l"><?= $name ?></h1>
      </div>
      <div class="section-body">
        <div class="product-catalog__body flex">
          <div class="product-catalog__sidebar">
            <div class="inner section-filter">
              <div class="product-catalog__filter">
                <div class="btn btn-gradient btn-gradient--2 btn-open-filter js-open-filter2 visible-xs btn-block ff-b">
                  <span>Открыть разделы</span>
                </div>
                <form action="" method="get" class="smartfilter">
                  <!-- <?$APPLICATION->IncludeComponent(
                      "bitrix:catalog.section.list",
                      "menu_section",
                      array(
                          "VIEW_MODE" => "LIST",
                          "SHOW_PARENT_NAME" => "N",
                          "IBLOCK_TYPE" => "Content",
                          "IBLOCK_ID" => "5",
                  //		"SECTION_ID" => $arCurSection['ID'],
                          "SECTION_ID" => 543,
                          "SECTION_CODE" => "",
                          "SECTION_URL" => "",
                          "COUNT_ELEMENTS" => "N",
                          "TOP_DEPTH" => "4",
                          "SECTION_FIELDS" => array(
                              0 => "",
                              1 => "",
                          ),
                          "SECTION_USER_FIELDS" => array(
                              0 => "",
                              1 => "",
                          ),
                          "ADD_SECTIONS_CHAIN" => "N",
                          "CACHE_TYPE" => "A",
                          "CACHE_TIME" => "36000000",
                          "CACHE_NOTES" => "",
                          "CACHE_GROUPS" => "Y",
                          "COMPONENT_TEMPLATE" => ".default",
                          "COUNT_ELEMENTS_FILTER" => "CNT_ACTIVE",
                          "FILTER_NAME" => "sectionsFilter",
                          "CACHE_FILTER" => "N"
                      ),
                      false
                  );?> -->
                  <div class="block">
                    <div class="open-div ff-b">
                      <a class="section-filter__link" href="">Раздел 1</a>
                      <span class="open-button">
                        <i class="open-button-icon"></i>
                      </span>
                    </div>
                    <ul class="menu-sub">
                      <li class="section-filter__item">
                        <div class="open-div">
                          <a class="section-filter__link" href="">Ламинированные</a>
                          <span class="open-button">
                            <i class="open-button-icon"></i>
                          </span>
                        </div>
                        <ul class="menu-sub">
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Дерево</a>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Теплые цвета</a></li>
                          <li class="section-filter__item">
                            <div class="open-div">
                              <a class="section-filter__link" href="">Красные оттенки</a>
                              <span class="open-button">
                                <i class="open-button-icon"></i>
                              </span>
                            </div>
                            <ul class="menu-sub">
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Бордовый</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Малиновый</a>
                              </li>
                              <li class="section-filter__item">
                                <div class="open-div">
                                  <a class="section-filter__link" href="">Алый</a>
                                  <span class="open-button">
                                    <i class="open-button-icon"></i>
                                  </span>
                                </div>
                                <ul class="menu-sub">
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 1</a>
                                  </li>
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 2</a>
                                  </li>
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 2</a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Камень</a>
                          </li>
                          <li class="section-filter__item">
                            <div class="open-div">
                              <a class="section-filter__link" href="">Холодные цвета</a>
                              <span class="open-button">
                                <i class="open-button-icon"></i>
                              </span>
                            </div>
                            <ul class="menu-sub">
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Синий</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Фиолетовый</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Голубой</a>
                              </li>
                            </ul>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Плитка</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="block">
                    <div class="open-div ff-b">
                      <a class="section-filter__link" href="">Раздел 2</a>
                      <span class="open-button">
                        <i class="open-button-icon"></i>
                      </span>
                    </div>
                    <ul class="menu-sub">
                      <li class="section-filter__item">
                        <div class="open-div">
                          <a class="section-filter__link" href="">Ламинированные</a>
                          <span class="open-button">
                            <i class="open-button-icon"></i>
                          </span>
                        </div>
                        <ul class="menu-sub">
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Дерево</a>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Теплые цвета</a></li>
                          <li class="section-filter__item">
                            <div class="open-div">
                              <a class="section-filter__link" href="">Красные оттенки</a>
                              <span class="open-button">
                                <i class="open-button-icon"></i>
                              </span>
                            </div>
                            <ul class="menu-sub">
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Бордовый</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Малиновый</a>
                              </li>
                              <li class="section-filter__item">
                                <div class="open-div">
                                  <a class="section-filter__link" href="">Алый</a>
                                  <span class="open-button">
                                    <i class="open-button-icon"></i>
                                  </span>
                                </div>
                                <ul class="menu-sub">
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 1</a>
                                  </li>
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 2</a>
                                  </li>
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 2</a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Камень</a>
                          </li>
                          <li class="section-filter__item">
                            <div class="open-div">
                              <a class="section-filter__link" href="">Холодные цвета</a>
                              <span class="open-button">
                                <i class="open-button-icon"></i>
                              </span>
                            </div>
                            <ul class="menu-sub">
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Синий</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Фиолетовый</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Голубой</a>
                              </li>
                            </ul>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Плитка</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                  <div class="block">
                    <div class="open-div ff-b">
                      <a class="section-filter__link" href="">Раздел 3</a>
                      <span class="open-button">
                        <i class="open-button-icon"></i>
                      </span>
                    </div>
                    <ul class="menu-sub">
                      <li class="section-filter__item">
                        <div class="open-div">
                          <a class="section-filter__link" href="">Ламинированные</a>
                          <span class="open-button">
                            <i class="open-button-icon"></i>
                          </span>
                        </div>
                        <ul class="menu-sub">
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Дерево</a>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Теплые цвета</a></li>
                          <li class="section-filter__item">
                            <div class="open-div">
                              <a class="section-filter__link" href="">Красные оттенки</a>
                              <span class="open-button">
                                <i class="open-button-icon"></i>
                              </span>
                            </div>
                            <ul class="menu-sub">
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Бордовый</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Малиновый</a>
                              </li>
                              <li class="section-filter__item">
                                <div class="open-div">
                                  <a class="section-filter__link" href="">Алый</a>
                                  <span class="open-button">
                                    <i class="open-button-icon"></i>
                                  </span>
                                </div>
                                <ul class="menu-sub">
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 1</a>
                                  </li>
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 2</a>
                                  </li>
                                  <li class="section-filter__item">
                                    <a href="" class="section-filter__link">Алый 2</a>
                                  </li>
                                </ul>
                              </li>
                            </ul>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Камень</a>
                          </li>
                          <li class="section-filter__item">
                            <div class="open-div">
                              <a class="section-filter__link" href="">Холодные цвета</a>
                              <span class="open-button">
                                <i class="open-button-icon"></i>
                              </span>
                            </div>
                            <ul class="menu-sub">
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Синий</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Фиолетовый</a>
                              </li>
                              <li class="section-filter__item">
                                <a href="" class="section-filter__link">Голубой</a>
                              </li>
                            </ul>
                          </li>
                          <li class="section-filter__item">
                            <a href="" class="section-filter__link">Плитка</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </form>
              </div>
            </div>

            <div class="inner">
              <div class="product-catalog__filter">
                <?
                                $APPLICATION->IncludeComponent(
                                    "bitrix:catalog.smart.filter",
                                    "doors",
                                    array(
                                        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                        "SECTION_ID" => $arCurSection['ID'],
                                        "FILTER_NAME" => $arParams["FILTER_NAME"],
                                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                        "SAVE_IN_SESSION" => "N",
                                        "FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
                                        "XML_EXPORT" => "Y",
                                        "SECTION_TITLE" => "NAME",
                                        "SECTION_DESCRIPTION" => "DESCRIPTION",
                                        'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                        "TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
                                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                        "SEF_MODE" => $arParams["SEF_MODE"],
                                        "SEF_RULE" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["smart_filter"],
                                        "SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
                                        "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                        "INSTANT_RELOAD" => $arParams["INSTANT_RELOAD"],
                                    ),
                                    $component,
                                    array('HIDE_ICONS' => 'N')
                                );
                                ?>
              </div>
            </div>
          </div>
          <div class="product-catalog__main">
            <?
                        $intSectionID = $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section",
                            "doors",
                            array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
                                "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
                                "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
                                "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
                                "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                                "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                                "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
                                "BASKET_URL" => $arParams["BASKET_URL"],
                                "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
                                "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
                                "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
                                "PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
                                "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
                                "FILTER_NAME" => $arParams["FILTER_NAME"],
                                "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                                "CACHE_TIME" => $arParams["CACHE_TIME"],
                                "CACHE_FILTER" => $arParams["CACHE_FILTER"],
                                "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                                "SET_TITLE" => $arParams["SET_TITLE"],
                                "MESSAGE_404" => $arParams["~MESSAGE_404"],
                                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                                "SHOW_404" => $arParams["SHOW_404"],
                                "FILE_404" => $arParams["FILE_404"],
                                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                                "PRICE_CODE" => $arParams["PRICE_CODE"],
                                "USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
                                "SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

                                "PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
                                "USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
                                "ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
                                "PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
                                "PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

                                "DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
                                "DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
                                "PAGER_TITLE" => $arParams["PAGER_TITLE"],
                                "PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
                                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                                "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                                "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                                "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                                "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

                                "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
                                "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                                'LABEL_PROP' => $arParams['LABEL_PROP'],
                                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                                'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
                                'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
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
                                "ADD_SECTIONS_CHAIN" => "N",
                                'ADD_TO_BASKET_ACTION' => $basketAction,
                                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                                'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                                'USE_COMPARE_LIST' => 'Y',
                                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                                'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
                            ),
                            $component
                        );
                        $GLOBALS['CATALOG_CURRENT_SECTION_ID'] = $intSectionID;
                        ?>
          </div>

        </div><!-- .product-catalog__body -->
      </div>
    </div>
  </div>
</section>