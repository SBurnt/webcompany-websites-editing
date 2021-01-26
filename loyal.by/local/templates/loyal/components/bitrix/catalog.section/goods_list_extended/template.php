<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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
$this->setFrameMode(true);
?>

<? if (!empty($arResult['ITEMS'])): ?>

<div class="content__section indent_for-aside fl_l mobile-full-width mobile-fl_n">
    <div class="sort desktop-none"></div>
    <div class="catalog-list-type">

        <?
        foreach ($arResult['ITEMS'] as $key => $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
            $strMainID = $this->GetEditAreaId($arItem['ID']);

            switch ($arItem['PROPERTIES']['SEASON']['VALUE_XML_ID']) {

                case 'winter':
                    $season = 'season_mark_winter';
                    break;

                case 'summer':
                    $season = 'season_mark_summer';
                    break;

                default:
                    $season = '';

            }
            ?>
            <?
            //название производителя
            $res = CIBlockElement::GetByID($arItem['ID']);// $_GET["PID"] - ID элемента.
            $ar_res = $res->GetNext();
            $rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 2, 'ID' => $ar_res['IBLOCK_SECTION_ID']), false, array('SECTION_PAGE_URL', 'NAME'));
            $arSection = $rsSections->GetNext();
            ?>
            <?
            $urlTemplate = false;
            if (
                !empty($arItem['PROPERTIES']['DIAMETER']['VALUE']) and
                !empty($arItem['PROPERTIES']['WIDTH']['VALUE']) and
                !empty($arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'])
            ) {
                $urlTemplate = '/brand/' . $arSection['CODE'];
                $urlTemplate .= '-r' . $arItem['PROPERTIES']['DIAMETER']['VALUE'] . '/';
                $urlTemplate .= $arItem['PROPERTIES']['WIDTH']['VALUE'] . '-';
                $urlTemplate .= $arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'] . '/';
            }

            ?>
            <div class="catalog-list-type__el flex_row align_start flex_wrap disc" id="<? echo $strMainID; ?>">
                <div class="catalog__el catalog__el_for-list-type <?= $season ?>">
                    <div class="product__title">
                        <? if ($urlTemplate) { ?>
                            <a class="catalog__options-title1" href="<?= $urlTemplate ?>">
                                <?
                                if (!empty($arItem['PROPERTIES']['WIDTH']['VALUE'])) echo $arItem['PROPERTIES']['WIDTH']['VALUE'];
                                if (!empty($arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'])) echo '/' . $arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'];
                                if (!empty($arItem['PROPERTIES']['DIAMETER']['VALUE'])) echo ' R' . $arItem['PROPERTIES']['DIAMETER']['VALUE'];
                                ?>
                            </a>
                        <? } else { ?>
                            <?
                            if (!empty($arItem['PROPERTIES']['WIDTH']['VALUE'])) echo $arItem['PROPERTIES']['WIDTH']['VALUE'];
                            if (!empty($arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'])) echo '/' . $arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'];
                            if (!empty($arItem['PROPERTIES']['DIAMETER']['VALUE'])) echo ' R' . $arItem['PROPERTIES']['DIAMETER']['VALUE'];
                            ?>
                        <? } ?>
                    </div>
                    <div class="product__image">
                        <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
                            <img src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arResult['NAME'] ?>">
                        </a>
                    </div>
                    <div class="flex_row">
                        <div class="product__rating-wrap" data-raiting-item-id="<?= $arItem['ID'] ?>">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:iblock.vote",
                                "ajax_new",
                                array(
                                    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                                    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                                    "ELEMENT_ID" => $arItem['ID'],
                                    "ELEMENT_CODE" => "",
                                    "MAX_VOTE" => "5",
                                    "VOTE_NAMES" => array("1", "2", "3", "4", "5"),
                                    "SET_STATUS_404" => "N",
                                    "DISPLAY_AS_RATING" => $arParams['VOTE_DISPLAY_AS_RATING'],
                                    "CACHE_TYPE" => $arParams['CACHE_TYPE'],
                                    "CACHE_TIME" => $arParams['CACHE_TIME']
                                ),
                                $component,
                                array("HIDE_ICONS" => "Y")
                            ); ?>
                        </div>

                        <a <? /*href="<?= $arSection['SECTION_PAGE_URL'] ?>"*/ ?> class="product__manufacturer">
                            <?= $arSection['NAME'] ?>
                        </a>
                    </div>
                    <div class="product__marks">
                        <? if (!empty($arItem['PROPERTIES']['SALELEADER']['VALUE_XML_ID'])): ?>
                            <div class="product__mark product__mark_popular"></div>
                        <? endif; ?>
                        <? if (!empty($arItem['PROPERTIES']['NEWPRODUCT']['VALUE_XML_ID'])): ?>
                            <div class="product__mark product__mark_new"></div>
                        <? endif; ?>
                        <? if (!empty($arItem['PROPERTIES']['SPECIALOFFER']['VALUE_XML_ID'])): ?>
                            <div class="product__mark product__mark_best_price"></div>
                        <? endif; ?>
                    </div>
                </div>
                <div class="catalog__el-options-wrap">
                    <a class="catalog__options-title"
                       href="<? echo $arItem['DETAIL_PAGE_URL']; ?>"><?= $arItem['NAME'] ?></a>
                    <div class="catalog__el-options">
                        <? $cnt_prop = 0 ?>
                        <? $arNoCode = ['BRAND', 'OWNER', 'OWNER_SORT']; ?>
                        <? foreach ($arItem['PROPERTIES'] as $property): ?>
                            <? if (!empty($property['VALUE']) && !in_array($property['CODE'], $arNoCode) && $cnt_prop < 7): ?>
                                <div class="catalog__el-option">
                                    <div class="catalog__el-option-title">
                                        <?= $property['NAME'] ?>
                                    </div>
                                    <div class="catalog__el-option-value">
                                        <?= $property['VALUE'] ?>
                                    </div>
                                </div>
                                <? $cnt_prop++; ?>
                            <? endif; ?>
                        <? endforeach; ?>
                    </div>
                </div>
                <div class="catalog__el-addition">
                    <div class="catalog__el-preferences clearfix_">
                        <? if ($arItem['PROPERTIES']['EXTENDED_WARRANTY']['VALUE_XML_ID'] == 'YY'): ?>
                            <div class="catalog__el-preference">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pref-1.png" alt="">
                                <div class="catalog__el-preference-balloon">
                                    Расширенная<br>гарантия
                                </div>
                            </div>
                        <? endif; ?>
                        <? if (empty($arItem['PROPERTIES']['FREE_TIRE_SERVICE']['VALUE_XML_ID'])): ?>
                            <div class="catalog__el-preference">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pref-2.png" alt="">
                                <div class="catalog__el-preference-balloon">
                                    Выберите удобный для вас вид доставки
                                </div>
                            </div>
                        <? endif; ?>
                        <? if (empty($arResult['PROPERTIES']['RETURN_WITHIN']['VALUE_XML_ID'])): ?>
                            <div class="catalog__el-preference">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pref-3.png" alt="">
                                <div class="catalog__el-preference-balloon">
                                    Возврат в течении<br> 14 дней
                                </div>
                            </div>
                        <? endif; ?>
                        <? if ($arItem['PROPERTIES']['OWNER_SORT']['VALUE'] == 50) { ?><span>*</span><? } ?>
                        <? if ($arItem['CATALOG_PRICE_7']) { ?>
                            <div class="halva-small ">
                                <img src="/local/templates/loyal/assets/images/pay/halva-small.png" alt="">
                                <div class="catalog__el-preference-balloon">
                                    При оформлении заказа,<br>
                                    выберете форму рассрочки <br>
                                    (скидки и акции при этом не учитываются)

                                </div>
                            </div>
                        <? } ?>
                        <? if ($arItem['LIST_PRICE_R']) { ?>
                            <div class="halva-small ">
                                <img style="width: 20px" src="/local/templates/loyal/assets/images/pay/poch3.png" alt="">
                                <div class="catalog__el-preference-balloon">
                                    <? foreach ($arItem['LIST_PRICE_R'] as $k => $v) { ?>
                                        <?= $k ?>- <?= $v ?> руб. <br>
                                    <? } ?>
                                </div>
                            </div>
                        <? } ?>
                    </div>
                    <div class="catalog__el-price product__price-wrap flex-blocks">
                        <div>
                            <?global $USER;
                            if($USER->isAdmin()){
//                                pr($arItem['PROPERTIES']['OWNER']);?>
                                <div class="product__price-before-discount product__admin_mob clearfix_" style="padding-bottom: 5px;">
                                    <span class="product__admin-text"><?if($arItem['PROPERTIES']['OWNER']['VALUE']){echo stristr($arItem['PROPERTIES']['OWNER']['VALUE'], ' ', true);}else{echo 'loyal';} echo ' - '.stristr($arItem['TIMESTAMP_X'], ' ', true)?><br></span>
                                </div>
                            <?}?>
                            <div class="product__price-before-discount clearfix_">
                                <? if ($arItem['CATALOG_PRICE_7']): ?>
                                    <div class="product__price">
                                        <?= $arItem['CATALOG_PRICE_7'] ?><span
                                                class="product__price-text">руб.<br></span>
                                    </div>
                                <? endif; ?>

                                <? if ($arItem['CATALOG_PRICE_1'] > $arItem['PRICES']['BASE']['UNROUND_DISCOUNT_VALUE']): ?>
                                    <div class="product__price">
                                        <? if ($arItem['CATALOG_PRICE_7']) { ?><span class="text-price-discount">Цена со скидкой</span><? } ?>
                                        <?= $arItem['CATALOG_PRICE_1'] ?><span class="product__price-text">руб.</span>
                                    </div>
                                <? endif; ?>
                            </div>
                            <div class="product__price-final clearfix_">
                                <? if (!empty($arItem['PRICES']['BASE']['UNROUND_DISCOUNT_VALUE']) && $arItem['PRICES']['BASE']['UNROUND_DISCOUNT_VALUE'] < $arItem['CATALOG_PRICE_1']): ?>
                                    <div class="product__price">
                                        <?= $arItem['PRICES']['BASE']['UNROUND_DISCOUNT_VALUE'] ?> <span
                                                class="product__price-text">руб.</span>
                                    </div>
                                <? elseif (!empty($arItem['PRICES']['BASE']['UNROUND_DISCOUNT_VALUE']) && $arItem['PRICES']['BASE']['UNROUND_DISCOUNT_VALUE'] == $arItem['CATALOG_PRICE_1']): ?>
                                    <div class="product__price">
                                        <? if ($arItem['CATALOG_PRICE_7']) { ?><span class="text-price-discount">Цена со скидкой</span><? } ?>
                                        <?= $arItem['CATALOG_PRICE_1'] ?> <span
                                                class="product__price-text">руб.</span>
                                    </div>
                                <? endif ?>
                            </div>

                        </div>

                    </div>
                    <?
                    if($USER->isAdmin()){
//                                pr($arItem['PROPERTIES']['SEASON']);
                        if ($arItem['PROPERTIES']['OWNER_SORT']['VALUE'] == 50 && !empty($arItem['PROPERTIES']['SEASON']['VALUE'])) {
                            $name = $arItem['PROPERTIES']['SEASON']['VALUE'] =='зимние' ? 'text_zima.php' : ($arItem['PROPERTIES']['SEASON']['VALUE'] =='летние' ? 'text_letto.php' : 'text_vse.php')?>
                            <div class="additional__discount elem2">
                                <div>
                                    <?
                                    $APPLICATION->IncludeComponent(
                                        "bitrix:main.include",
                                        "",
                                        Array(
                                            "AREA_FILE_SHOW" => "file",
                                            "AREA_FILE_SUFFIX" => "inc",
                                            "COMPOSITE_FRAME_MODE" => "A",
                                            "COMPOSITE_FRAME_TYPE" => "AUTO",
                                            "EDIT_TEMPLATE" => "",
                                            "PATH" => "/include/".$name,
                                        )
                                    );?>
                                </div>
                            </div>
                        <?}
                    }?>
                    <div class="catalog__el-count-cart count__cart flex_row">
                        <form class="count__form" method="post" action="" data-trigger="spinner">
                            <button type="button" class="count__form-el count__form-btn" data-spin="down">-</button>
                            <input type="text" data-quantityId="<?= $arItem['ID'] ?>"
                                   class="count__form-el count__form-val" value="1" data-rule="quantity">
                            <button type="button" class="count__form-el count__form-btn" data-spin="up">+</button>
                        </form>
                        <div class="btn__wrap btn_red_theme">
                            <a href="javascript:void(0)" data-putbasket="<?= $arItem['ID'] ?>" class="btn">В корзину</a>
                        </div>
                    </div>
                    <div class="catalog__el-addition-info addition__info clearfix_">
                        <a href="javascript:void(0)" data-adddelay="<?= $arItem['ID'] ?>"
                           class="addition__info-btn addition__info-btn-liked"></a>
                        <a id="bx_3966226736_<?= $arItem['ID'] ?>_compare_link" data-addcompare="<?= $arItem['ID'] ?>"
                           href="javascript:void(0)" class="addition__info-btn addition__info-btn-compare"></a>
                        <div class="addition__info-stock">
                            В наличии: <span class="addition__info-stock-count"><?= $arItem['CATALOG_QUANTITY'] ?>
                                шт.</span>
                        </div>
                    </div>
                </div>
            </div>

        <? } ?>

    </div>

    <!--начало пагинации-->
    <?
    if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
        ?>

        <? echo $arResult["NAV_STRING"]; ?>

        <?
    }
    ?>


    <? endif; ?>
</div>


