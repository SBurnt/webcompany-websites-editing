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
<div class="catalog mobile-slider catalog_main-page">


    <? if (!empty($arResult['ITEMS'])): ?>


        <?
        foreach ($arResult['ITEMS'] as $key => $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
            $strMainID = $this->GetEditAreaId($arItem['ID']);

            /*название производителя*/
            $res = CIBlockElement::GetByID($arItem['ID']);// $_GET["PID"] - ID элемента.
            $ar_res = $res->GetNext();
            $rsSections = CIBlockSection::GetList(array(), array('IBLOCK_ID' => 2, 'ID' => $ar_res['IBLOCK_SECTION_ID']), false, array('SECTION_PAGE_URL', 'NAME'));
            $arSection = $rsSections->GetNext();

            /*получаем цену и скидку*/
            $dbPrice = CPrice::GetList(
                array("QUANTITY_FROM" => "ASC", "QUANTITY_TO" => "ASC", "SORT" => "ASC"),
                array("PRODUCT_ID" => $arItem['ID']),
                false,
                false,
                array("ID", "CATALOG_GROUP_ID", "PRICE", "CURRENCY", "QUANTITY_FROM", "QUANTITY_TO")
            );


            $arPrice = $dbPrice->Fetch();

            $arDiscounts = CCatalogDiscount::GetDiscountByPrice(
                $arPrice["ID"],
                $USER->GetUserGroupArray(),
                "N",
                SITE_ID
            );
            $discountPrice = CCatalogProduct::CountPriceWithDiscount(
                $arPrice["PRICE"],
                $arPrice["CURRENCY"],
                $arDiscounts
            );
            $arPrice["DISCOUNT_PRICE"] = $discountPrice;


            /*if(CModule::IncludeModule('iblock')):

                $arFilterr = Array("IBLOCK_ID"=>2, 'ID' => $arItem['ID'] );
                $res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilterr, false, false, Array("ID","NAME", "SHOW_COUNTER"));
                while($ar_fields = $res->GetNext())
                {
                    echo "У элемента " . $ar_fields['NAME'] . " " . $ar_fields['SHOW_COUNTER'] . " показов<br>";
                }
            endif;*/


            switch ($arItem['PROPERTIES']['SEASON']['VALUE']) {

                case 'зима':
                    $season = 'season_mark_winter';
                    break;

                case 'лето':
                    $season = 'season_mark_summer';
                    break;

                default:
                    $season = '';

            }
            ?>


            <div class="catalog__el <?
            echo $season; ?>" id="<? echo $strMainID; ?>">
                <div class="product__title1">
                    <?
                    if (!empty($arItem['PROPERTIES']['WIDTH']['VALUE'])) echo $arItem['PROPERTIES']['WIDTH']['VALUE'];
                    if (!empty($arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'])) echo '/' . $arItem['PROPERTIES']['HIGHT_PROFILE']['VALUE'];
                    if (!empty($arItem['PROPERTIES']['DIAMETER']['VALUE'])) echo ' R' . $arItem['PROPERTIES']['DIAMETER']['VALUE'];
                    ?>
                </div>
                <div class="product__image">
                    <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>">
                        <img class="lazy" data-src="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" alt="<?= $arResult['NAME'] ?>">
                    </a>
                </div>
                <div class="flex_row">
                    <div class="product__rating-wrap ">
                        <?
                        $APPLICATION->IncludeComponent(
                            "bitrix:iblock.vote",
                            "ajax_new",
                            //   "stars",
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
                    <a href="<? echo $arSection['SECTION_PAGE_URL'] ?>" class="product__manufacturer">
                        <?= $arSection['NAME'] ?>
                    </a>
                </div>
                <div class="product__title-wrap">
                    <a href="<? echo $arItem['DETAIL_PAGE_URL']; ?>" class="product__title">
                        <?= $arItem['NAME'] ?>
                    </a>
                </div>
                <div class="product__price-wrap flex-blocks">
                    <div>
                        <div class="product__price-before-discount clearfix_">
                            <? if ($arItem['CATALOG_PRICE_7']): ?>
                                <div class="product__price">
                                    <?= $arItem['CATALOG_PRICE_7'] ?><span class="product__price-text">руб.</span>
                                </div>
                            <? endif; ?>
                        </div>
                        <div class="product__price-final clearfix_">
                            <div class="product__price">
                                <? if ($arItem['CATALOG_PRICE_7']) { ?><span class="text-price-discount">Цена со скидкой</span><?
                                } ?>
                                <?= round($arPrice['DISCOUNT_PRICE']) ?> <span class="product__price-text">руб.</span>
                            </div>
                            <!--<div class="product__price-old">
                                1 000 000 <span class="product__price-text">руб.</span>
                            </div>-->
                        </div>
                    </div>
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
                </div>
                <?
                global $USER;
                if($USER->isAdmin()){
                    if ($arItem['PROPERTIES']['OWNER_SORT']['VALUE'] == 50 && !empty($arItem['PROPERTIES']['SEASON']['VALUE'])) {
                        $name = $arItem['PROPERTIES']['SEASON']['VALUE'] =='зимние' ? 'text_zima.php' : ($arItem['PROPERTIES']['SEASON']['VALUE'] =='летние' ? 'text_letto.php' : 'text_vse.php')?>
                        <div class="additional__discount elem3">
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
                <div class="product__addition">
                    <div class="count__cart flex_row">
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
                    <div class="addition__info clearfix_">
                        <a href="javascript:void(0)" data-adddelay="<?= $arItem['ID'] ?>"
                           class="addition__info-btn addition__info-btn-liked"></a>
                        <a id="bx_3966226736_<?= $arItem['ID'] ?>_compare_link" data-addcompare="<?= $arItem['ID'] ?>"
                           href="javascript:void(0)" class="addition__info-btn addition__info-btn-compare"></a>
                        <div class="addition__info-stock">
                            В наличии: <span
                                    class="addition__info-stock-count"><?= $arItem['CATALOG_QUANTITY'] ?> шт.</span>
                        </div>
                    </div>
                </div>
                <div class="product__marks">
                    <?
                    if (!empty($arItem['PROPERTIES']['SALELEADER']['VALUE_XML_ID'])): ?>
                        <div class="product__mark product__mark_popular"></div>
                    <?endif; ?>
                    <?
                    if (!empty($arItem['PROPERTIES']['NEWPRODUCT']['VALUE_XML_ID'])): ?>
                        <div class="product__mark product__mark_new"></div>
                    <?endif; ?>
                    <?
                    if (!empty($arItem['PROPERTIES']['SPECIALOFFER']['VALUE_XML_ID'])): ?>
                        <div class="product__mark product__mark_best_price"></div>
                    <?endif; ?>
                </div>
            </div>


            <?
        }
        ?>


    <? endif; ?>
</div>
