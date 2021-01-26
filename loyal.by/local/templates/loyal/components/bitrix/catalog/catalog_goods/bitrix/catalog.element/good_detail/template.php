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

switch ($arResult['PROPERTIES']['SEASON']['VALUE_XML_ID']) {

    case 'winter':
        $season = 'season_mark_winter';
        $tyre_style = 'зимней';
        break;

    case 'summer':
        $season = 'season_mark_summer';
        $tyre_style = 'летней';
        break;

    default:
        $season = '';
}

//PR($arResult['PRICES']['INSTALLMENTS']);

?>

<div class="main-content basic_width">
    <input type="hidden" value="<?= $arResult['ID'] ?>" id="Idgood">

    <div class="product-advantages container flex_row flex_start">
        <? if (!empty($arResult['PROPERTIES']['SALELEADER']['VALUE_XML_ID'])): ?>
            <div class="pr__advantage">
                <div class="pr__advantage-item pr__advantage-image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/product-adv-1.png" alt="">
                </div>
                <div class="pr__advantage-item">
                    Хит продаж
                </div>
            </div>
        <? endif; ?>
        <? if (!empty($arResult['PROPERTIES']['NEWPRODUCT']['VALUE_XML_ID'])): ?>
            <div class="pr__advantage">
                <div class="pr__advantage-item pr__advantage-image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/product-adv-2.png" alt="">
                </div>
                <div class="pr__advantage-item">
                    Новинка
                </div>
            </div>
        <? endif; ?>
        <? if (!empty($arResult['PROPERTIES']['SPECIALOFFER']['VALUE_XML_ID'])): ?>
            <div class="pr__advantage">
                <div class="pr__advantage-item pr__advantage-image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/product-adv-3.png" alt="">
                </div>
                <div class="pr__advantage-item">
                    Лучшая цена
                </div>
            </div>
        <? endif; ?>

        <? if ($arResult['PROPERTIES']['EXTENDED_WARRANTY']['VALUE_XML_ID'] == 'YY'): ?>
            <div class="pr__advantage">
                <div class="pr__advantage-item pr__advantage-image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/product-adv-4.png" alt="">
                </div>
                <div class="pr__advantage-item">
                    Расширенная<br>гарантия
                </div>
            </div>
        <? endif; ?>

        <? if (empty($arResult['PROPERTIES']['FREE_TIRE_SERVICE']['VALUE_XML_ID'])): ?>
            <div class="pr__advantage">
                <div class="pr__advantage-item pr__advantage-image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/product-adv-5.png" alt="">
                </div>
                <div class="pr__advantage-item">
                    Доставка
                </div>
            </div>
        <? endif; ?>

        <? if (empty($arResult['PROPERTIES']['RETURN_WITHIN']['VALUE_XML_ID'])): ?>
            <div class="pr__advantage">
                <div class="pr__advantage-item pr__advantage-image">
                    <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/product-adv-6.png" alt="">
                </div>
                <div class="pr__advantage-item">
                    Возврат в течение<br>14 дней
                </div>
            </div>
        <? endif; ?>

    </div>
    <div class="product-wrap clearfix_">
        <div class="product__images">
            <div class="catalog__el product__card-catalog-el <?= $season ?>">
                <div class="product__title product__card-title">
                    <?= $arResult['PROPERTIES']['WIDTH']['VALUE'] ?><? if (!empty($arResult['PROPERTIES']['WIDTH']['VALUE']) && !empty($arResult['PROPERTIES']['HIGHT_PROFILE']['VALUE'])) echo '/'; ?><?= $arResult['PROPERTIES']['HIGHT_PROFILE']['VALUE'] ?><? if (!empty($arResult['PROPERTIES']['DIAMETER']['VALUE'])) echo "R" . $arResult['PROPERTIES']['DIAMETER']['VALUE']; ?>
                </div>
                <div class="product__gallery clearfix_">
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= $arResult['DETAIL_PICTURE']['SRC'] ?>" alt="<?= $arResult['NAME'] ?>"
                                     title="<?= $arResult['NAME'] ?>">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="product__image product__card-image">
                            <div class="product__card-image-link">
                                <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/wire.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex_row">
                    <div class="product__rating-wrap product__card-rating-wrap">
                        <div class="rating product__card-rating">
                            <? $APPLICATION->IncludeComponent(
                                "bitrix:iblock.vote",
                                "ajax_new",
                                array(
                                    "IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
                                    "IBLOCK_ID" => $arParams['IBLOCK_ID'],
                                    "ELEMENT_ID" => $arResult['ID'],
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
                        <a class="product__card-reviews-count">
                            <? $arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_GOOD_ID");
                            $arFilter = Array("IBLOCK_ID" => IntVal(52), "ACTIVE" => "Y", "PROPERTY_GOOD_ID" => $arResult['ID']);
                            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 5000), $arSelect);
                            $cnt_reviews = 0;
                            while ($ob = $res->GetNextElement()) {
                                $cnt_reviews++;
                            }
                            echo $cnt_reviews . ' отзыва';
                            ?>
                        </a>
                    </div>
                    <? if (empty($arResult['PROPERTIES']['BRAND']['VALUE'])): ?>
                        <a href="<?= $arResult['SECTION']['SECTION_PAGE_URL'] ?>"
                           class="product__manufacturer product__card-manufacturer">
                            <?= $arParams['SECTION_CODE'] ?>
                        </a>
                    <? else: ?>
                        <a href="<?= $arResult['SECTION']['SECTION_PAGE_URL'] ?>"
                           class="product__manufacturer product__card-manufacturer">
                            <?= $arResult['PROPERTIES']['BRAND']['VALUE'] ?>
                        </a>
                    <? endif; ?>
                </div>
                <div class="product__marks">
                    <? if (!empty($arResult['PROPERTIES']['SALELEADER']['VALUE_XML_ID'])): ?>
                        <div class="product__mark product__mark_popular"></div>
                    <? endif; ?>
                    <? if (!empty($arResult['PROPERTIES']['NEWPRODUCT']['VALUE_XML_ID'])): ?>
                        <div class="product__mark product__mark_new"></div>
                    <? endif; ?>
                    <? if (!empty($arResult['PROPERTIES']['SPECIALOFFER']['VALUE_XML_ID'])): ?>
                        <div class="product__mark product__mark_best_price"></div>
                    <? endif; ?>
                </div>
            </div>
            <div class="product__gallery-pager">
                <div class="product__gallery-list clearfix_" id="product__gallery-list">
                    <?
                    $i = 0;
                    foreach ($arResult['PROPERTIES']['MORE_PHOTO']['VALUE'] as $photo_id):
                        $photo_path = CFile::GetPath($photo_id);
                        ?>

                        <a href="" class="product__gallery-list-item" data-slide-index="<?
                        echo $i; ?>">
                            <img src="<?= $photo_path ?>" alt="">
                            <div class="product__gallery-list-item-overlay"></div>
                        </a>

                        <?
                        $i++;
                    endforeach;
                    ?>
                    <!--  <a href="" class="product__gallery-list-item" data-slide-index="0">
                        <img src="<? /*= SITE_TEMPLATE_PATH*/ ?>/assets/images/gal-el.png" alt="">
                        <div class="product__gallery-list-item-overlay"></div>
                    </a>-->
                </div>
                <div class="product__gallery-controls">
                    <div class="product__gallery-controls-item product__gallery-prev" id="product__gallery-prev"></div>
                    <div class="product__gallery-controls-item product__gallery-next" id="product__gallery-next"></div>
                </div>
            </div>
            <? if ($arResult['PROPERTIES']['FUEL_ECONOMY']['VALUE'] and $arResult['PROPERTIES']['COUPLING_WITH_WET_ROAD']['VALUE']) { ?>
                <!--eurolabel pictures-->
                <div class="product__categories">
                    <div class="flex_row">
                        <div class="product__categories-item">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pr-cat-icon-1.jpg"
                                 alt="<?= $arResult['PROPERTIES']['FUEL_ECONOMY']['NAME'] ?>">
                            <div class="product__category-value"><?= $arResult['PROPERTIES']['FUEL_ECONOMY']['VALUE'] ?></div>
                        </div>
                        <div class="product__categories-item">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pr-cat-icon-2.jpg"
                                 alt="<?= $arResult['PROPERTIES']['COUPLING_WITH_WET_ROAD']['NAME'] ?>">
                            <div class="product__category-value"><?= $arResult['PROPERTIES']['COUPLING_WITH_WET_ROAD']['VALUE'] ?></div>
                        </div>
                        <div class="product__categories-item">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/pr-cat-icon-3.jpg"
                                 alt="<?= $arResult['PROPERTIES']['NOISE_LAVEL']['NAME'] ?>">
                            <div class="product__category-value"><?= $arResult['PROPERTIES']['NOISE_LAVEL']['VALUE'] ?></div>
                        </div>
                    </div>
                    <div class="product__euro-card">
                        <img data-fuel="<?= $arResult['PROPERTIES']['FUEL_ECONOMY']['VALUE'] ?>"
                             src="<?= SITE_TEMPLATE_PATH ?>/assets/images/evro/1-1.png" alt=""
                             class="product__euro-card-img">
                        <img data-road="<?= $arResult['PROPERTIES']['COUPLING_WITH_WET_ROAD']['VALUE'] ?>"
                             src="<?= SITE_TEMPLATE_PATH ?>/assets/images/evro/2-1.png" alt=""
                             class="product__euro-card-img">
                        <div class="clear container">
                            <img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/evro/3.png" alt="">
                            <div class="parametr-val"><?= $arResult['PROPERTIES']['NOISE_LAVEL']['VALUE'] ?></div>
                        </div>
                    </div>
                </div>
            <? } ?>
            <!--end eurolabel picitures-->

            <div class="product__addition-info clearfix_">
                <a href="javascript:void(0)" data-adddelay="<?= $arResult['ID'] ?>"
                   class="product__addition-info-btn-wrap">
                    <span class="addition__info-btn addition__info-btn-liked"></span>
                    <span class="addition__info-text mobile-none">Добавить в избранное</span>
                    <span class="addition__info-text desktop-none">В избранное</span>
                </a>
                <a id="bx_3966226736_<?= $arResult['ID'] ?>_compare_link" data-addcompare="<?= $arResult['ID'] ?>"
                   href="javascript:void(0)" class="product__addition-info-btn-wrap">
                    <span class="addition__info-btn addition__info-btn-compare"></span>
                    <span class="addition__info-text mobile-none">Добавить в сравнение</span>
                    <span class="addition__info-text desktop-none">В сравнение</span>
                </a>
            </div>
        </div>
        <div class="product__char">
            <div class="product__price-wrap theme_yel-bord">
                <div class="product__price-top">
                    <span class="product__price-top-item">
                        <span class="text_theme-red  mobile-text_theme-gray">Артикул: </span><span
                                class="dark_text"><?= $arResult['PROPERTIES']['ARTNUMBER']['VALUE'] ?></span>
                    </span>
                    <span class="product__price-top-item">
                        <span class="text_theme-in-stock  mobile-text_theme-gray"><? if (!empty($arResult['CATALOG_QUANTITY'])) echo "В наличии"; else echo "Нет в наличии"; ?></span>
                    </span>
                    <span class="product__price-top-item  mobile-none">
                        <a href="#storage" class="storage__link">Посмотреть наличие на складах</a>
                    </span>
                </div>
                <div class="product__price-bottom flex_row align_start  mobile-flex-wrap">
                    <div class="product__price-wrap product__card-price-wrap clearfix_">
                        <div class="fl_l">
                            <?if($arResult['CATALOG_PRICE_7']){?>
                            <div class="product__price-before-discount clearfix_">
                                <div class="product__price"><?= $arResult['CATALOG_PRICE_7'] ?> <span class="product__price-text">руб.</span>

                                </div>
                            </div>
                            <?}?>
                            <div class="product__price-final clearfix_">
                                <div class="product__price">
                                    <?if($arResult['CATALOG_PRICE_7']){?><span class="text-price-discount">Цена со скидкой</span><?}?>
                                    <?= ($arResult['PRICES']['BASE']['UNROUND_DISCOUNT_VALUE']) ?> <span
                                            class="product__price-text">руб.</span>
                                </div>
                            </div>
                        </div>
                        <div class="fl_l">
                        </div>
                    </div>

                    <? if ($arResult['PROPERTIES']['OWNER_SORT']['VALUE'] == 50) { ?>
                        <div class="halva-small ">
                            <img src="/local/templates/loyal/assets/images/pay/halva-card-page.png" alt="">
                            <div class="catalog__el-preference-balloon">
                                При оформлении заказа,<br>
                                выберете форму рассрочки <br>
                                (скидки и акции при этом не учитываются)
                            </div>
                        </div>
                    <? } ?>
                    <div class="product__card-count-form-wrap">
                        <div class="count__form-title">
                            Количество:
                        </div>
                        <form class="count__form" method="post" action="" data-trigger="spinner">
                            <button type="button" class="count__form-el count__form-btn" data-spin="down">-</button>
                            <input type="text" data-quantityId="<?= $arResult['ID'] ?>"
                                   class="count__form-el count__form-val" value="1" data-rule="quantity">
                            <button type="button" class="count__form-el count__form-btn" data-spin="up">+</button>
                        </form>
                    </div>
                    <div class="product__card-btns clearfix_">
                        <div class="btn__wrap btn_orange_theme fl_l btn__one-click">
                            <a data-fancybox data-src="#user-buy-form" href="javascript:;"
                               class="btn show-oneclick-form">Купить в 1 клик</a>
                        </div>
                        <div class="btn__wrap btn_red_theme fl_r">
                            <a href="javascript:void(0)" data-putbasket="<?= $arResult['ID'] ?>" class="btn">В
                                корзину</a>
                        </div>
                    </div>
                </div>
                <?
                        global $USER;
                        if($USER->isAdmin()){
                            if ($arResult['PROPERTIES']['OWNER_SORT']['VALUE'] == 50 && !empty($arResult['PROPERTIES']['SEASON']['VALUE'])) {
                                $name = $arResult['PROPERTIES']['SEASON']['VALUE'] =='зимние' ? 'text_zima.php' : ($arResult['PROPERTIES']['SEASON']['VALUE'] =='летние' ? 'text_letto.php' : 'text_vse.php')?>
                                <div class="additional__discount elem4">
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
            </div>
            <div class="product__char-table">
                <?
                $arNoCode = array('BRAND','THORNS' ,'OWNER','HALVA', 'OWNER_SORT','META_DESCRIPTION','KEYWORDS','MINIMUM_PRICE','MAXIMUM_PRICE', 'PROP_UPD', 'PRICE_UPD');
                ?>
                <? foreach ($arResult['PROPERTIES'] as $property): ?>
                    <? if (!empty($property['VALUE']) && !in_array($property['CODE'], $arNoCode)): ?>
                        <div class="product__char-table-row">
                            <div class="product__char-table-el">
                                <?= $property['NAME'] ?>
                            </div>
                            <div class="product__char-table-el bold">
                                <?= $property['VALUE'] ?>
                            </div>
                        </div>
                    <? endif; ?>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div class="product-tabs product-tabs_theme" id="storage">
    <div class="product-tabs-titles product-tabs-titles_theme">
        <ul class="product-tabs-titles__list basic_width flex_row">
            <li class="product-tabs-titles__list-item product-tabs-titles__list-item-active" data-tab="1">ТИПОРАЗМЕРЫ
                ЦЕНЫ И НАЛИЧИЕ
            </li>
            <li class="product-tabs-titles__list-item" data-tab="2">описание</li>
            <li class="product-tabs-titles__list-item" data-tab="3">
                отзывы
                <span class="product__reviews-count">
					<?
                    echo $cnt_reviews;
                    ?>
				</span>
            </li>
            <li class="product-tabs-titles__list-item" data-tab="4">статьи</li>
            <li class="product-tabs-titles__list-item" data-tab="5">магазины</li>
            <li class="product-tabs-titles__list-item" data-tab="6">оплата</li>
            <li class="product-tabs-titles__list-item" data-tab="7">доставка</li>
            <li class="product-tabs-titles__list-item" data-tab="8">гарантия</li>
            <li class="product-tabs-titles__list-item" data-tab="9">модель класса</li>
            <li class="product-tabs-titles__list-item" data-tab="10">евроэтикетка</li>
        </ul>
    </div>
    <div class="product-tabs-container basic_width">
        <div class="product-tabs-content" data-tab-content="1">
            <div class="product__sizes-tab">
                <div class="product__tab-title">Список размеров <?= $tyre_style ?> шины <?= $arResult['NAME'] ?></div>
                <div class="product__sizes-types">
                    <div class="product__sizes-types-list flex_row flex_start">
                        <span class="product__sizes-type product__sizes-type-active">Все размеры</span>
                        <?
                        /*Количество типоразмеров*/
                        $z = 1;
                        foreach ($arResult['DIAMETERS'] as $url => $d):
                            if ($z < 11):
                                ?>
                                <a href="<?= $url ?>" class="product__sizes-type"><span><?= $d ?></span></a>
                                <?
                            endif;
                            $z++;
                        endforeach;
                        ?>
                    </div>
                    <div class="product__sizes-types-table-wrap">
                        <table class="product__sizes-types-table">
                            <tr>
                                <th>артикул</th>
                                <th>Типоразмер</th>
                                <th>Стоимость</th>
                                <th>Наличие</th>
                                <th>Магазины</th>
                            </tr>

                            <? foreach ($arResult['STORES'] as $store): ?>
                                <tr>
                                    <td><?= $store[0] ?></td>
                                    <td><?= $store[1] ?></td>
                                    <td><span class="white_text"><? if (!empty($store[3])) {
                                                echo $store[3];
                                            } else {
                                                echo $store[2];
                                            } ?></span> <span class="product__sizes-types_sm-text">руб./ шт.</span></td>
                                    <td><span class="product__sizes-types_sm-text">В наличии <span
                                                    class="white_text"><?= $store[4] ?> шт.</span></span></td>
                                    <td><span class="product__sizes-types_sm-text"><?= $store[5] ?></span></td>
                                </tr>
                            <? endforeach; ?>

                            <!--<tr>
								<td><? /*=$arResult['PROPERTIES']['ARTICLE']['VALUE']*/ ?></td>
								<td><? /*= $arResult['NAME']*/ ?></td>
								<td><span class="white_text">2 140</span> <span class="product__sizes-types_sm-text">руб./ шт.</span></td>
								<td><span class="product__sizes-types_sm-text">В наличии <span class="white_text">2 618 шт.</span></span></td>
								<td><span class="product__sizes-types_sm-text">Магазин-склад, г. Минск, <br>ул. Солтыса, 106</span></td>
							</tr>-->

                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="product-tabs-content" data-tab-content="2">
            <div class="product__sizes-tab">
                <div class="product__tab-title">Описание <?= $tyre_style ?> шины <?= $arResult['NAME'] ?></div>
                <div class="product__tab-content">
                    <h1>Огромный ассортимент шин различных размеров и индексов предоставляет возможность подобрать нужный Вам товар. Автомобильные <?=$arResult['NAME']?> и другие товары можно заказать с доставкой в любой город Беларуси, получив гарантию и скидки на следующие покупки!</h1>
                </div>
            </div>
        </div>
        <div class="product-tabs-content" data-tab-content="3">
            <div class="product__sizes-tab">
                <div id="reviews">
                    <div class="product__tab-title">Отзывы о <?= $tyre_style ?> шины <?= $arResult['NAME'] ?></div>
                    <!--<div class="product__tab-reviews">-->

                    <?
                    global $arReviewFilter;
                    $arReviewFilter = Array("IBLOCK_ID" => IntVal(52), "ACTIVE" => "Y", "PROPERTY_GOOD_ID" => $arResult['ID']);
                    ?>
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "reviews_list_detail_page",
                        array(
                            "COMPONENT_TEMPLATE" => "reviews_list_detail_page",
                            "IBLOCK_TYPE" => "-",
                            "IBLOCK_ID" => "52",
                            "NEWS_COUNT" => "5",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "arReviewFilter",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "ADVANTAGES",
                                1 => "NAME",
                                2 => "DISADVANTAGES",
                                3 => "RAITING",
                                4 => "MESSAGE",
                                5 => "SURNAME",
                                6 => "EMAIL",
                                7 => "",
                            ),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "PAGER_TEMPLATE" => "pagination_for_articles_and_rewies_detail_page",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Отзывы",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <!--статьи о товаре-->
            <div class="product-tabs-content" data-tab-content="4">
                <div class="product__sizes-tab">
                    <div class="product__tab-title">Статьи о <?= $tyre_style ?> шине <?= $arResult['NAME'] ?></div>
                </div>
                <div class="product__tab-articles">
                    <?
                    global $filterArticleByGood;
                    $filterArticleByGood = array(
                        "ACTIVE" => "Y",
                        "PROPERTY_GOODS_ARTICLE" => $arResult['ID'],
                    );
                    ?>


                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "goods_articles",
                        array(
                            "COMPONENT_TEMPLATE" => ".default",
                            "IBLOCK_TYPE" => "aricles",
                            "IBLOCK_ID" => "21",
                            "NEWS_COUNT" => "20",
                            "SORT_BY1" => "ACTIVE_FROM",
                            "SORT_ORDER1" => "DESC",
                            "SORT_BY2" => "SORT",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "filterArticleByGood",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "GOODS_ARTICLE	",
                                1 => "",
                            ),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "DISPLAY_DATE" => "Y",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                        ),
                        false
                    ); ?>
                </div>
            </div>

            <div class="product-tabs-content" data-tab-content="5">
                <div class="product__sizes-tab">
                    <div class="product__tab-title">Наличие <?= $tyre_style ?> шины <?= $arResult['NAME'] ?> в
                        магазинах
                    </div>
                    <div class="product__sizes-types">
                        <div class="product__sizes-types-table-wrap">
                            <table class="product__sizes-types-table">
                                <tr>
                                    <th>Магазин</th>
                                    <th colspan="2">Контакты</th>
                                    <th>Наличие товара в магазине</th>
                                </tr>
                                <? foreach ($arResult['STORES'] as $store): ?>
                                    <tr>
                                        <td><span class="product__sizes-types_sm-text"><?= $store[5] ?></span></td>
                                        <td><span class="white_text"><?= $store[6] ?></span></td>
                                        <td><span class="white_text"></span></td>
                                        <td><span class="product__sizes-types_sm-text">В наличии <span
                                                        class="white_text"><?= $store[4] ?> шт.</span></span></td>
                                    </tr>
                                <? endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!--payments for goods-->
            <div class="product-tabs-content" data-tab-content="6">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "good_detail_payments",
                    array(
                        "COMPONENT_TEMPLATE" => "good_detail_payments",
                        "IBLOCK_TYPE" => "general_info_detail_product",
                        "IBLOCK_ID" => "26",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    ),
                    false
                ); ?>
            </div>
            <!-- end payments for goods -->
            <!--deliveries products -->
            <div class="product-tabs-content" data-tab-content="7">
                <div class="product__sizes-tab">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.detail",
                        "good_detail_deliveries",
                        array(
                            "COMPONENT_TEMPLATE" => "good_detail_deliveries",
                            "IBLOCK_TYPE" => "general_info_detail_product",
                            "IBLOCK_ID" => "27",
                            "ELEMENT_ID" => "148373",
                            "ELEMENT_CODE" => "",
                            "CHECK_DATES" => "Y",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "IBLOCK_URL" => "",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_GROUPS" => "Y",
                            "SET_TITLE" => "N",
                            "SET_CANONICAL_URL" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "BROWSER_TITLE" => "-",
                            "SET_META_KEYWORDS" => "N",
                            "META_KEYWORDS" => "-",
                            "SET_META_DESCRIPTION" => "N",
                            "META_DESCRIPTION" => "-",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "USE_PERMISSIONS" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "USE_SHARE" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Страница",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <!--end deliveries products-->
            <!--goods warranty-->
            <div class="product-tabs-content" data-tab-content="8">
                <div class="product__sizes-tab">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.detail",
                        "good_detail_deliveries",
                        array(
                            "COMPONENT_TEMPLATE" => "good_detail_deliveries",
                            "IBLOCK_TYPE" => "general_info_detail_product",
                            "IBLOCK_ID" => "28",
                            "ELEMENT_ID" => "148374",
                            "ELEMENT_CODE" => "",
                            "CHECK_DATES" => "Y",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "IBLOCK_URL" => "",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_GROUPS" => "Y",
                            "SET_TITLE" => "N",
                            "SET_CANONICAL_URL" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "BROWSER_TITLE" => "-",
                            "SET_META_KEYWORDS" => "N",
                            "META_KEYWORDS" => "-",
                            "SET_META_DESCRIPTION" => "N",
                            "META_DESCRIPTION" => "-",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "ADD_ELEMENT_CHAIN" => "N",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "USE_PERMISSIONS" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "N",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "N",
                            "USE_SHARE" => "N",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "Y",
                            "PAGER_TITLE" => "Страница",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <!--end goods warranty-->
            <!-- models class-->
            <div class="product-tabs-content" data-tab-content="9">
                <div class="product__sizes-tab">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:news.list",
                        "good_detail_model_class",
                        array(
                            "COMPONENT_TEMPLATE" => "good_detail_model_class",
                            "IBLOCK_TYPE" => "general_info_detail_product",
                            "IBLOCK_ID" => "29",
                            "NEWS_COUNT" => "20",
                            "SORT_BY1" => "SORT",
                            "SORT_ORDER1" => "ASC",
                            "SORT_BY2" => "ID",
                            "SORT_ORDER2" => "ASC",
                            "FILTER_NAME" => "",
                            "FIELD_CODE" => array(
                                0 => "",
                                1 => "",
                            ),
                            "PROPERTY_CODE" => array(
                                0 => "CLASS_SYMBOL",
                                1 => "",
                            ),
                            "CHECK_DATES" => "Y",
                            "DETAIL_URL" => "",
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "N",
                            "AJAX_OPTION_HISTORY" => "N",
                            "AJAX_OPTION_ADDITIONAL" => "",
                            "CACHE_TYPE" => "A",
                            "CACHE_TIME" => "36000000",
                            "CACHE_FILTER" => "N",
                            "CACHE_GROUPS" => "Y",
                            "PREVIEW_TRUNCATE_LEN" => "",
                            "ACTIVE_DATE_FORMAT" => "d.m.Y",
                            "SET_TITLE" => "N",
                            "SET_BROWSER_TITLE" => "N",
                            "SET_META_KEYWORDS" => "N",
                            "SET_META_DESCRIPTION" => "N",
                            "SET_LAST_MODIFIED" => "N",
                            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            "ADD_SECTIONS_CHAIN" => "N",
                            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            "PARENT_SECTION" => "",
                            "PARENT_SECTION_CODE" => "",
                            "INCLUDE_SUBSECTIONS" => "N",
                            "DISPLAY_DATE" => "N",
                            "DISPLAY_NAME" => "Y",
                            "DISPLAY_PICTURE" => "Y",
                            "DISPLAY_PREVIEW_TEXT" => "Y",
                            "PAGER_TEMPLATE" => ".default",
                            "DISPLAY_TOP_PAGER" => "N",
                            "DISPLAY_BOTTOM_PAGER" => "N",
                            "PAGER_TITLE" => "Новости",
                            "PAGER_SHOW_ALWAYS" => "N",
                            "PAGER_DESC_NUMBERING" => "N",
                            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            "PAGER_SHOW_ALL" => "N",
                            "PAGER_BASE_LINK_ENABLE" => "N",
                            "SET_STATUS_404" => "N",
                            "SHOW_404" => "N",
                            "MESSAGE_404" => ""
                        ),
                        false
                    ); ?>
                </div>
            </div>
            <!--end models class-->
            <!--eurolabel-->
            <div class="product-tabs-content" data-tab-content="10">

                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "good_detail_eurolabel",
                    array(
                        "COMPONENT_TEMPLATE" => "good_detail_eurolabel",
                        "IBLOCK_TYPE" => "general_info_detail_product",
                        "IBLOCK_ID" => "30",
                        "NEWS_COUNT" => "20",
                        "SORT_BY1" => "SORT",
                        "SORT_ORDER1" => "ASC",
                        "SORT_BY2" => "ID",
                        "SORT_ORDER2" => "ASC",
                        "FILTER_NAME" => "",
                        "FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "CHECK_DATES" => "Y",
                        "DETAIL_URL" => "",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "CACHE_TYPE" => "A",
                        "CACHE_TIME" => "36000000",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "SET_TITLE" => "N",
                        "SET_BROWSER_TITLE" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "DISPLAY_DATE" => "N",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "DISPLAY_TOP_PAGER" => "N",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "PAGER_TITLE" => "Новости",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "SET_STATUS_404" => "N",
                        "SHOW_404" => "N",
                        "MESSAGE_404" => ""
                    ),
                    false
                ); ?>
            </div>
            <!--end eurolabel-->
        </div>
    </div>

    <!-- добавил для мобилки -->
    <div class="product__articles-shop desktop-none">
        <div class="basic_width">
            <p class="title-mobile">
                Типоразмеры наличие и цены
            </p>
            <div class="product__articles-inner-mobile">
                <div class="bold title-availability">
                    Наличие летней шины <?= $arResult['NAME'] ?> в магазинах
                </div>

            </div>
            <h2 class="title-minor-mobile">
                Магазины
            </h2>
            <? $g = 1; ?>
            <? foreach ($arResult['STORES'] as $store): ?>
                <div class="shop-phone-accordion">
                    <input type="checkbox" name="accordion_check" id="shop<?= $g ?>">
                    <label for="shop1">
                            <span class="shop-arrow-toggle">
                                <?= $store[5] ?>
                            </span>
                    </label>
                    <div class="shop-phone-accordion-inner">
                        <div>в наличии <?= $store[4] ?> шт.</div>
                        <div class="bold shop-phone-accordion__pnones">Телефоны</div>
                        <div class="mobile-fl_l shop-phone-block">
                            <span class="shop-phone-number"><?= $store[6] ?></span>
                        </div>
                    </div>
                </div>
                <? $g++; ?>
            <? endforeach; ?>
        </div>
    </div>

    <div class="product__articles-reviews desktop-none">
        <div id="reviews_mobile">
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "reviews_list_detail_page_mobile",
                array(
                    "COMPONENT_TEMPLATE" => "reviews_list_detail_page",
                    "IBLOCK_TYPE" => "-",
                    "IBLOCK_ID" => "52",
                    "NEWS_COUNT" => "20",
                    "SORT_BY1" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "DESC",
                    "SORT_BY2" => "SORT",
                    "SORT_ORDER2" => "ASC",
                    "FILTER_NAME" => "arReviewFilter",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "PROPERTY_CODE" => array(
                        0 => "ADVANTAGES",
                        1 => "NAME",
                        2 => "DISADVANTAGES",
                        3 => "RAITING",
                        4 => "MESSAGE",
                        5 => "SURNAME",
                        6 => "EMAIL",
                        7 => "",
                    ),
                    "CHECK_DATES" => "Y",
                    "DETAIL_URL" => "",
                    "AJAX_MODE" => "N",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "N",
                    "AJAX_OPTION_HISTORY" => "N",
                    "AJAX_OPTION_ADDITIONAL" => "",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "36000000",
                    "CACHE_FILTER" => "N",
                    "CACHE_GROUPS" => "Y",
                    "PREVIEW_TRUNCATE_LEN" => "",
                    "ACTIVE_DATE_FORMAT" => "d.m.Y",
                    "SET_TITLE" => "N",
                    "SET_BROWSER_TITLE" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "ADD_SECTIONS_CHAIN" => "N",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "PARENT_SECTION" => "",
                    "PARENT_SECTION_CODE" => "",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "DISPLAY_DATE" => "Y",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "PAGER_TEMPLATE" => ".default",
                    "DISPLAY_TOP_PAGER" => "N",
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "PAGER_TITLE" => "Отзывы",
                    "PAGER_SHOW_ALWAYS" => "N",
                    "PAGER_DESC_NUMBERING" => "N",
                    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    "PAGER_SHOW_ALL" => "N",
                    "PAGER_BASE_LINK_ENABLE" => "N",
                    "SET_STATUS_404" => "N",
                    "SHOW_404" => "N",
                    "MESSAGE_404" => ""
                ),
                false
            ); ?>
        </div>
    </div>

    <div class="product__articles-pay desktop-none">
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.list",
            "good_detail_payments_mobile",
            array(
                "COMPONENT_TEMPLATE" => "good_detail_payments",
                "IBLOCK_TYPE" => "general_info_detail_product",
                "IBLOCK_ID" => "26",
                "NEWS_COUNT" => "20",
                "SORT_BY1" => "SORT",
                "SORT_ORDER1" => "ASC",
                "SORT_BY2" => "ID",
                "SORT_ORDER2" => "ASC",
                "FILTER_NAME" => "",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "CHECK_DATES" => "Y",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "Y",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_FILTER" => "N",
                "CACHE_GROUPS" => "Y",
                "PREVIEW_TRUNCATE_LEN" => "",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "SET_TITLE" => "N",
                "SET_BROWSER_TITLE" => "N",
                "SET_META_KEYWORDS" => "N",
                "SET_META_DESCRIPTION" => "N",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                "PARENT_SECTION" => "",
                "PARENT_SECTION_CODE" => "",
                "INCLUDE_SUBSECTIONS" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "Y",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "Y",
                "PAGER_TEMPLATE" => ".default",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Новости",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => ""
            ),
            false
        ); ?>
    </div>
    <!-- доставка -->
    <div class="product__articles-shipping desktop-none">
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "good_detail_deliveries_mobile",
            array(
                "COMPONENT_TEMPLATE" => "good_detail_deliveries",
                "IBLOCK_TYPE" => "general_info_detail_product",
                "IBLOCK_ID" => "27",
                "ELEMENT_ID" => "148373",
                "ELEMENT_CODE" => "",
                "CHECK_DATES" => "Y",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "IBLOCK_URL" => "",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "SET_TITLE" => "N",
                "SET_CANONICAL_URL" => "N",
                "SET_BROWSER_TITLE" => "N",
                "BROWSER_TITLE" => "-",
                "SET_META_KEYWORDS" => "N",
                "META_KEYWORDS" => "-",
                "SET_META_DESCRIPTION" => "N",
                "META_DESCRIPTION" => "-",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_ELEMENT_CHAIN" => "N",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "USE_PERMISSIONS" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "USE_SHARE" => "N",
                "PAGER_TEMPLATE" => ".default",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Страница",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => ""
            ),
            false
        ); ?>
    </div>
    <!-- гарантия -->
    <div class="product__articles-warranty desktop-none">
        <? $APPLICATION->IncludeComponent(
            "bitrix:news.detail",
            "good_detail_deliveries_mobile",
            array(
                "COMPONENT_TEMPLATE" => "good_detail_deliveries",
                "IBLOCK_TYPE" => "general_info_detail_product",
                "IBLOCK_ID" => "28",
                "ELEMENT_ID" => "148374",
                "ELEMENT_CODE" => "",
                "CHECK_DATES" => "Y",
                "FIELD_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "PROPERTY_CODE" => array(
                    0 => "",
                    1 => "",
                ),
                "IBLOCK_URL" => "",
                "DETAIL_URL" => "",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "AJAX_OPTION_ADDITIONAL" => "",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000000",
                "CACHE_GROUPS" => "Y",
                "SET_TITLE" => "N",
                "SET_CANONICAL_URL" => "N",
                "SET_BROWSER_TITLE" => "N",
                "BROWSER_TITLE" => "-",
                "SET_META_KEYWORDS" => "N",
                "META_KEYWORDS" => "-",
                "SET_META_DESCRIPTION" => "N",
                "META_DESCRIPTION" => "-",
                "SET_LAST_MODIFIED" => "N",
                "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                "ADD_SECTIONS_CHAIN" => "N",
                "ADD_ELEMENT_CHAIN" => "N",
                "ACTIVE_DATE_FORMAT" => "d.m.Y",
                "USE_PERMISSIONS" => "N",
                "DISPLAY_DATE" => "N",
                "DISPLAY_NAME" => "N",
                "DISPLAY_PICTURE" => "Y",
                "DISPLAY_PREVIEW_TEXT" => "N",
                "USE_SHARE" => "N",
                "PAGER_TEMPLATE" => ".default",
                "DISPLAY_TOP_PAGER" => "N",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Страница",
                "PAGER_SHOW_ALL" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SET_STATUS_404" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => ""
            ),
            false
        ); ?>
    </div>
    <!-- конец -->

<?
//здесь работает верстак
    $code_section = explode("/",$arResult['DETAIL_PAGE_URL']);
    $arFilter3 = Array('IBLOCK_ID'=>2, 'GLOBAL_ACTIVE'=>'Y', 'CODE'=>$code_section[2]);
    $db_list3 = CIBlockSection::GetList(Array($by=>$order), $arFilter3, true, array("ID"));
    if($ar_result3 = $db_list3->Fetch())
    {
        $SECTION_ID = $ar_result3["ID"];
    }
    $arFilter2 = Array('IBLOCK_ID'=>2, 'GLOBAL_ACTIVE'=>'Y', 'SECTION_ID'=>$SECTION_ID,'DEPTH_LEVEL'=>2);
    $db_list2 = CIBlockSection::GetList(Array($by=>$order), $arFilter2, true,array("SECTION_PAGE_URL","NAME"));

    ?>
    <div class=' basic_width'>
        <h3 class='manufacture-detail__title'>Ещё <span>шины от:</span></h3>
        <ul class='manufacture__list'>
            <?
            while($ar_result = $db_list2->GetNext())
            {
                echo "<li><a href=\"".$ar_result["SECTION_PAGE_URL"]."\">".$ar_result["NAME"]."</a></li>";

            }?>
        </ul>
    </div>

    <!--похожие товары-->
    <?
    global $filterRelativeGoods;
    if ($arResult['SECTION']['CODE'] == 'shiny' || $arResult['SECTION']['PATH'][0]['CODE'] == 'shiny') {
        $arResult["VARIABLES"]["SECTION_ID"] = 90872;
        $filterRelativeGoods = array(
            "IBLOCK_ID" => IntVal($arResult['IBLOCK_ID']),
            "ACTIVE" => "Y",
            "PROPERTY_WIDTH" => $arResult['PROPERTIES']['WIDTH']['VALUE'],
            "PROPERTY_HIGHT_PROFILE" => $arResult['PROPERTIES']['HIGHT_PROFILE']['VALUE'],
            "PROPERTY_DIAMETER" => $arResult['PROPERTIES']['DIAMETER']['VALUE'],
            "!ID" => $arResult["ID"],


        );
    }

    if ($arResult['SECTION']['CODE'] == 'diski' || $arResult['SECTION']['PATH'][0]['CODE'] == 'diski') {
        $arResult["VARIABLES"]["SECTION_ID"] = 17;
        $filterRelativeGoods = array(
            "IBLOCK_ID" => IntVal($arResult['IBLOCK_ID']),
            "ACTIVE" => "Y",
            "PROPERTY_WIDTH" => $arResult['PROPERTIES']['WIDTH']['VALUE'],
            "PROPERTY_DIAMETER" => $arResult['PROPERTIES']['DIAMETER']['VALUE'],
            "PROPERTY_PCD" => $arResult['PROPERTIES']['PCD']['VALUE'],
            "PROPERTY_VILET_FROM" => $arResult['PROPERTIES']['VILET_FROM']['VALUE'],
            "PROPERTY_VILET_TO" => $arResult['PROPERTIES']['VILET_TO']['VALUE'],
            "!ID" => $arResult["ID"]
        );
    }
    ?>

    <? $intSectionID = $APPLICATION->IncludeComponent(
        "bitrix:catalog.section",
        "relative_goods",
        array(
            "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
            "IBLOCK_ID" => $arResult["IBLOCK_ID"],
            "ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
            "ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
            "ELEMENT_SORT_FIELD2" => $arParams["ELEMENT_SORT_FIELD2"],
            "ELEMENT_SORT_ORDER2" => $arParams["ELEMENT_SORT_ORDER2"],
            "PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
            "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
            "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
            "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
            "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
            "INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
            "BASKET_URL" => $arParams["BASKET_URL"],
            "ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
            "PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
            "SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
            "PRODUCT_QUANTITY_VARIABLE" => 51,
            "PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
            "FILTER_NAME" => 'filterRelativeGoods',
            //"FILTER_NAME" => $arParams["FILTER_NAME"],
            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
            "CACHE_TIME" => $arParams["CACHE_TIME"],
            "CACHE_FILTER" => $arParams["CACHE_FILTER"],
            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
            "SET_TITLE" => $arParams["SET_TITLE"],
            "MESSAGE_404" => $arParams["MESSAGE_404"],
            "SET_STATUS_404" => $arParams["SET_STATUS_404"],
            "SHOW_404" => $arParams["SHOW_404"],
            "FILE_404" => $arParams["FILE_404"],
            "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
            "PAGE_ELEMENT_COUNT" => 51,
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

            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
            "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
            "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
            "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
            "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
            "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
            "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
            "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

            "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            //"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
            "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
            "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
			"DETAIL_URL" =>'/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/',
            "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
            'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
            'CURRENCY_ID' => $arParams['CURRENCY_ID'],
            'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

            'LABEL_PROP' => $arParams['LABEL_PROP'],
            'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
            'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

            'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
            'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
            'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
            'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
            'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
            'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
            'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
            'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
            'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
            'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

            'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
            "ADD_SECTIONS_CHAIN" => "N",
            'ADD_TO_BASKET_ACTION' => $basketAction,
            'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
            'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
            'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
            'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')
        ),
        $component
    );


//    echo"<pre>";
//    print_r( $arResult);
//    echo"</pre>";
    ?>
    <!-- конец похоижх товаров -->

</div>
