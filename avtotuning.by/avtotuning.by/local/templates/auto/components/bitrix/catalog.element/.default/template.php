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
CModule::IncludeModule("iblock");
//pr($arResult);
$arResult['CATALOG_PRICE_1'] = round(CCurrencyRates::ConvertCurrency($arResult['CATALOG_PRICE_1'], $arResult['CATALOG_CURRENCY_1'], "BYN"),2);
if($arResult['DELAY']){?>
    <style>
        .defer_product p{
            color: #80b6d6;
        }
        .defer_product svg{
            fill: #80b6d6;
        }
    </style>
<?}?>

<div class="shop">
    <h1 class="shop__title rg"><?=$arResult['NAME'];?></h1>
</div>
<div class="item__rating main_flex flex__align-items_center flex__jcontent_between">
    <?$APPLICATION->IncludeComponent(
        "bitrix:iblock.vote",
        "ajax",
        Array(
            "CACHE_TIME" => "36000000",
            "CACHE_TYPE" => "A",
            "DISPLAY_AS_RATING" => "vote_avg",
            "ELEMENT_CODE" => $_REQUEST["code"],
            "ELEMENT_ID" => $arResult["ID"],
            "IBLOCK_ID" => "2",
            "IBLOCK_TYPE" => "catalog",
            "MAX_VOTE" => "5",
            "MESSAGE_404" => "",
            "SET_STATUS_404" => "N",
            "VOTE_NAMES" => array("1", "2", "3", "4", "5", "")
        )
    );?>
    <input type="hidden" value="<?=$arResult['ID'];?>" id="ID_PRODUCT">
    <div class="voting">
        <div class="voting-item like">
            <a href="<?if (!$USER->IsAuthorized()){echo 'javascript:void(0);';}else{echo '#';}?>" class="<?if (!$USER->IsAuthorized()){echo 'btn-login';}?>">
                <img src="<?=SITE_TEMPLATE_PATH?>/img/pictures/like.png" alt="">
            </a>
            <span><?=$arResult['COUNT_LIKES']['LIKES'];?></span>
        </div>
        <div class="voting-item diz">
            <a href="<?if (!$USER->IsAuthorized()){echo 'javascript:void(0);';}else{echo '#';}?>" class="<?if (!$USER->IsAuthorized()){echo 'btn-login';}?>"><img src="<?=SITE_TEMPLATE_PATH?>/img/pictures/dislike.png" alt=""></a>
            <span><?=$arResult['COUNT_LIKES']['DIZ'];?></span>
        </div>
    </div>
    <a href="#" class="item__message main_flex flex__align-items_center item__list--link" data-tab="#ui-id-6" data-target="#ui-id-6">
        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/chat.svg" width="20">
        <p class="rg"><?echo $arResult['COUNT_REVIEWS'].$arResult['COUNT_REVIEWS_TEXT'];?></p>
    </a>
    <a href="javascript://" onclick="addBasket('<?=$arResult['ID'];?>','','','Y');return false;" class="item__message main_flex flex__align-items_center defer_product" onclick>
        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/like.svg" width="20">
        <p class="rg">Отложить товар</p>
    </a>
    <?if($arResult['PROPERTIES']['ARTICUL']['VALUE']){?>
        <p class="rg">Артикул: <?=$arResult['PROPERTIES']['ARTICUL']['VALUE'];?></p>
    <?}?>
</div>

<div class="item__grid main_flex flex__align-items_start">
    <div class="flex__1">
        <div class="container-left">
            <div class="main-img">
                <?if($arResult['DETAIL_PICTURE_408_368']){?>
                    <a class="fancybox" data-fancybox="images" href="<?=$arResult['DETAIL_PICTURE']['SRC'];?>">
                        <img src="<?=$arResult['DETAIL_PICTURE_408_368'];?>" class="minimized" alt="slider" id="current">
                    </a>
                <?}
                else if($arResult['GALLERY'] ) {?>
                        <img src="<?=$arResult['GALLERY'][0];?>" alt="slider" id="current">
                    <?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png" alt="slider" id="current">
                    <?}?>
                <?if($arResult['PROPERTIES']['GIFT_TEXT']['VALUE']){?>
                    <div class="present-block">
                        <a>
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/pictures/present.png" alt="">
                        </a>
                        <p>
                            <?=$arResult['PROPERTIES']['GIFT_TEXT']['VALUE'];?>
                        </p>
                    </div>
                <?}?>
            </div>
            <?if($arResult['GALLERY']){?>
                <div class="thumbs clearfix">
                    <?foreach($arResult['GALLERY'] as $index => $gallery){?>
                        <div>
                            <img src="<?=$gallery;?>" alt="slider" data-full="<?=$arResult['GALLERY_1'][$index];?>">
                            <a class="fancybox" data-fancybox="<?= $index != 0 ? 'images' : 'none'; ?>" href="<?=$arResult['GALLERY_1'][$index];?>"></a>
                        </div>
                    <?}?>
                </div>
            <?}?>
        </div>
    </div>
    <div class="flex__1">
        <div class="container-right">
            <div class="price"><?=$arResult['CATALOG_PRICE_1']?><span>руб.</span>
                <input type="hidden" name="NewPrice" value=""/>
                <?if($arResult['PROPERTIES']['OLD_PRICE']['VALUE']){?>
                    <div class="price__old"><?=round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], $arResult['CATALOG_CURRENCY_1'], "BYN"),2);?><span>руб.</span></div>
                    <div class="saving">Экономия: <?=round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], $arResult['CATALOG_CURRENCY_1'], "BYN"),2)  - $arResult['CATALOG_PRICE_1'];?> руб.</div>
                <?}?>
            </div>
            <?foreach ($arResult['PROPERTIES']['NADBAVKA']["VALUE"] as $key => $elNadbavka){
                $arFilter = Array("IBLOCK_ID"=>17, "ID"=>$elNadbavka);
                $res = CIBlockElement::GetList(Array(), $arFilter);
                if ($ob = $res->GetNextElement()){;
                    $arFields = $ob->GetFields(); // поля элемента
                    $arProps = $ob->GetProperties(); // свойства элемента
                }
                $nadbavka[$key]['ID'] = $arFields['ID'];
                $nadbavka[$key]['NAME'] = $arFields['NAME'];
                $nadbavka[$key]['PRICE'] = $arProps['PRICE_NADBAVKA']['VALUE'];
                $nadbavka[$key]['OPISANIE'] = $arProps['OPISANIE_NADBAVKA']['VALUE'];
            }

            if ($nadbavka && count($nadbavka)>=3){?>
                <div class="dropdown inner-drop-down">
                    <span class="dropdown-button" data-text="Выбрать надбавку">Выбрать надбавку</span>
                    <ul class="dropdown-list">
                        <li data-value="Выбрать надбавку" onclick="nadbavka('-1','0','', '<?=$arResult['CATALOG_PRICE_1']?>', '<?=round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], $arResult['CATALOG_CURRENCY_1'], "BYN"),2)?>')">Выбрать надбавку</li>
                        <? foreach ($nadbavka as $kay => $item) {?>
                            <li data-value="<?=$item["NAME"]?> (+<?=$item["PRICE"]?>)" data-id="<?=$item['ID']?>" onclick="nadbavka('<?=$kay+1;?>','<?=stristr($item["PRICE"], ' ', true)?>','<?=$item['ID']?>', '<?=$arResult['CATALOG_PRICE_1']?>', '<?=round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], $arResult['CATALOG_CURRENCY_1'], "BYN"),2)?>')" ><?=$item["NAME"]?> (+<?=$item["PRICE"]?>)</li>
                            <input type="hidden" name="nadbavka_list<?=$kay+1?>" value="1"/>
                        <?}?>
                    </ul>
                    <img class="svg" src="<?=SITE_TEMPLATE_PATH?>img/icon/cancel.svg" width="8">
                </div>
            <?}else{?>
                <div class="md-ch">
                    <?foreach ($nadbavka as $key=>$items){?>
                        <div class="md-checkbox radio-btn" >
                            <label class="checkcontainer i1">
                                <p><?=$items["NAME"]?> (+<?=$items["PRICE"]?>)</p>
                                <input type="radio" name="checked" id="checked<?=$key?>" onclick="clickRadio(this); nadbavka('checked<?=$key?>', '<?=stristr($items["PRICE"], ' ', true)?>','<?=$items['ID']?>', '<?=$arResult['CATALOG_PRICE_1']?>', '<?=round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['OLD_PRICE']['VALUE'], $arResult['CATALOG_CURRENCY_1'], "BYN"),2)?>')">
                                <span class="radiobtn"></span>
                            </label>

                            <div class="hover-block">
                                <?=$items['OPISANIE']?>
                            </div>
                        </div>
                    <?}?>
                </div>
            <?}?>
            <input type="hidden" name="nadbavka_id" value=""/>


            <?
            if($arResult['PROPERTIES']['AVAIL']['VALUE'] == 'Y')
            {?>
                <button class="abs bd avalaible" onclick="addBasket('<?=$arResult['ID'];?>','')">В корзину</button>
                <button class="abs bd oc-order" onclick="klik('<?=$arResult['ID'];?>')">Купить в 1 клик</button>
            <?}
            else
            {?>
                <div class="abs bd oc-order" onclick="no_avalaible(<?=$arResult['ID']?>)">СООБЩИТЬ О ПОСТУПЛЕНИИ</div>
            <?}
            ?>

            <div class="item__list main_flex flex__align-items_start">
                <div class="w40">
                    <a class="item__list--link" href="#" data-tab="#ui-id-2" data-target="#ui-id-2">
                        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/lorry.svg" width="20">
                        <span>Доставка</span>
                    </a>
                    <a class="item__list--link" href="#" data-tab="#ui-id-2" data-target="#maps">
                        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/gift.svg" width="20">
                        <span>Самовывоз + подарок</span>
                    </a>
                </div>
                <div class="w60">
                    <a class="item__list--link" href="#" data-tab="#ui-id-4" data-target="#ui-id-4">
                        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/settings.svg" width="20">
                        <span>Установка</span>
                    </a>
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH."/include/prog_loyal.php"
                        )
                    );?>

                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .favorite_label {
        padding-right: 10px;
    }
    .modal-review .rating {
        height: 40px;
    }
    .favorite_label > input{
        display: none;
        opacity: 0;
    }
</style>
<!--- popup modal --->
<div class="modal-window web-modal" id="one-click-order"></div>
<div class="modal-window web-modal" id="rewiew">
    <div class="overlay"></div>
    <div class="wrapper">
        <div class="modal one-click-modal modal-review">
            <div class="close main_flex flex__align-items_center flex__jcontent_center">
                <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/cancel.svg" width="22">
            </div>
            <p class="rg account">Оставить отзыв к товару</p>
            <form action="" id="form--modal-2" >
                <input type="hidden" value="<?=$arResult['ID'];?>" name="ID_PRODUCT">
                <div class="mess"></div>
                <div class="form__name clearfix">
                    <div class="image-block">
                        <?if($arResult['DETAIL_PICTURE_408_368']){?>
                            <img width="210px" src="<?=$arResult['DETAIL_PICTURE_408_368'];?>" alt="<?=$arResult['NAME']?>">
                        <?}
                        else if($arResult['GALLERY'] ) {?>
                            <img width="210px" src="<?=$arResult['GALLERY'][0];?>" alt="<?=$arResult['NAME']?>">
                        <?}else{?>
                            <img width="210px" src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png" alt="<?=$arResult['NAME']?>">
                        <?}?>
                        <p class="bd"><?=$arResult['NAME']?></p>
                    </div>
                    <div class="flex__1">
                        <div class="form__name--p main_flex flex__jcontent_between">
                            <p class="rg">Оценка</p>
                            <div class="rating main_flex flex__align-items_center review-mark">
                                <label class="favorite_label">
                                    <img class="svg favorite1" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="1"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite2" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="2"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite3" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="3"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite4" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="4"/>
                                </label>
                                <label class="favorite_label">
                                    <img class="svg favorite5" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <input type="radio" name="favorite" value="5"/>
                                </label>
                            </div>
                        </div>
                        <div class="form__name--p main_flex flex__jcontent_between">
                            <p class="rg">Имя</p>
                            <input type="text" name="name_review" required>
                        </div>
                        <div class="form__name--p main_flex flex__jcontent_between">
                            <p class="rg">Отзыв</p>
                            <textarea style="height:90px;" class="rg" name="comment_review" required></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <button class="abs review">Отправить</button>
        </div>
    </div>
</div>
<script>
    $('input[name="favorite"]').change(function () {
        for( let i = 1; i <= 5; i++){
            $('.favorite'+i).css('fill','#bec9d1');
        }
        var star = $(this).val();
        for( let i = 1; i <= star; i++){
            $('.favorite'+i).css('fill','#ffdb6b');
        }

    });
    $('.review').click(function () {
        var data = $('#form--modal-2').serialize();
        $.ajax({
            type: "POST",
            url: "/ajax/reviews.php",
            data: data,
            success: function(msg){
                // $('#form--modal-2').css('height','370px')
                $('#form--modal-2').css('height','490px')
                $('.mess').html(msg);
            }
        });
        return false;
    })
</script>
<!--- end popup modal --->
<?if($arResult['PROPERTIES']['DISCOUNT_KIT_ACTIV']['VALUE']){
    $skidka = $arResult['PROPERTIES']['KIT_ITEMS_SKIDKA']['VALUE'] ? $arResult['PROPERTIES']['KIT_ITEMS_SKIDKA']['VALUE'] : $arResult['PROPERTIES']['KIT_ITEMS_SKIDKA']['DEFAULT_VALUE'];?>
    <div class="item__discount neon <?if(count($arResult['PROPERTIES']['KIT_ITEMS']['KIT_ITEMS'])>=2){echo 'four-items';}?>">
        <h2 class="shop__title rg">Комплект со скидкой <?=$skidka?>%</h2>
        <div class="item__discount--list main_flex flex__jcontent_center clearfix">
            <div class="item__discount--item">
                <a href="<?=$arResult['DETAIL_PAGE_URL']?>" class="bd__link">
                    <?if($arResult['DETAIL_PICTURE_408_368']){?>
                        <img width="200px" src="<?=$arResult['DETAIL_PICTURE_408_368'];?>">
                    <?}
                    else if($arResult['GALLERY']) {?>
                        <img width="200px" src="<?=$arResult['GALLERY'][0];?>">
                    <?}else{?>
                        <img width="200px" src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                    <?}?>
                    <p class="bd"><?=$arResult["NAME"]?></p>
                    <div class="rg coral">Цена: <?=$arResult["CATALOG_PRICE_1"]?></div>
                </a>
            </div>
            <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol">
            <?if(count($arResult['PROPERTIES']['KIT_ITEMS']['KIT_ITEMS'])>2){
                $ii = 2;
            }else{
                $ii = count($arResult['PROPERTIES']['KIT_ITEMS']['KIT_ITEMS']);
            }
            $p=0;
            foreach ($arResult['PROPERTIES']['KIT_ITEMS']['KIT_ITEMS'] as $KIT_ITEM){
                if($p<2){?>
                    <div class="item__discount--item">
                        <a href="<?=$KIT_ITEM['LIST_PAGE_URL'].$KIT_ITEM['DETAIL_PAGE_URL']?>" class="bd__link">
                            <?if(CFile::GetPath($KIT_ITEM["PREVIEW_PICTURE"])){?>
                                <img width="200px" src="<?=CFile::GetPath($KIT_ITEM["PREVIEW_PICTURE"])?>" class="minimized">
                            <?}else{?>
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                            <?}?>
                            <p class="bd"><?=$KIT_ITEM["NAME"]?></p>
                            <div class="rg coral">Цена: <?=round(CCurrencyRates::ConvertCurrency($KIT_ITEM["CATALOG_PRICE_1"], $KIT_ITEM['CATALOG_CURRENCY_1'], "BYN"),2);?></div>
                        </a>
                    </div>
                    <?if($ii!=1){?><img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol"><?}
                    $ii--;
                    $price_komplect+=round(CCurrencyRates::ConvertCurrency($KIT_ITEM["CATALOG_PRICE_1"], $KIT_ITEM['CATALOG_CURRENCY_1'], "BYN"),2);?>
                <?}
                $p++;?>
            <?}?>
            <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/equals-symbol.svg" width="26" class="symbol">
            <div class="num_bottom">
                <div class="bg-price"><? echo round(($arResult["CATALOG_PRICE_1"]+$price_komplect)*(1-$skidka/100),2);?> <span>руб.</span></div>
                <div class="rg coral mb-1">Цена: <span><? echo round($arResult["CATALOG_PRICE_1"]+$price_komplect,2);?></span></div>
                <div class="rg green">Экономия: <? echo round(($arResult["CATALOG_PRICE_1"]+$price_komplect)*$skidka/100,2);?> руб.</div>
                <input type="hidden" name="komplekt" value="<? echo round(($arResult["CATALOG_PRICE_1"]+$price_komplect)*(1-$skidka/100), 2);?>"/>
                <input type="hidden" name="komplekt_old" value="<? echo round($arResult["CATALOG_PRICE_1"]+$price_komplect,2);?>"/>
            </div>
        </div>
        <div class="bd avalaible-is" onclick="addBasket('<?=$arResult["ID"]?>','KOM');">Купить комплект</div>
    </div>
<?}
//pr($arResult['PROPERTIES']['PRODUCT_GIFT']['PRODUCT_GIFT']);?>
<?if(!$arResult['PROPERTIES']['DISCOUNT_KIT_ACTIV']['VALUE'] && $arResult['PROPERTIES']['GIFT_SET_ACTIV']['VALUE']){?>
    <div class="item__discount neon four-items <?if(count($arResult['PROPERTIES']['PRODUCT_GIFT']['PRODUCT_GIFT'])>=2){echo '';}else{echo 'four-items__lg';}?>">
        <h2 class="shop__title rg">Комплект с подарком</h2>
        <div class="item__discount--list main_flex flex__jcontent_center clearfix">
            <div class="item__discount--item">
                <a href="<?=$arResult['DETAIL_PAGE_URL']?>" class="bd__link">
                    <?if($arResult['DETAIL_PICTURE_408_368']){?>
                        <img src="<?=$arResult['DETAIL_PICTURE_408_368'];?>">
                    <?}
                    else if($arResult['GALLERY']) {?>
                        <img src="<?=$arResult['GALLERY'][0];?>">
                    <?}else{?>
                        <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                    <?}?>
                    <p class="bd"><?=$arResult["NAME"]?></p>
                    <div class="rg coral">Цена: <?=$arResult["CATALOG_PRICE_1"]?></div>
                </a>
            </div>
            <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol">
            <?if(count($arResult['PROPERTIES']['PRODUCT_GIFT']['PRODUCT_GIFT'])>2){
                $ii = 2;
            }else{
                $ii = count($arResult['PROPERTIES']['PRODUCT_GIFT']['PRODUCT_GIFT']);
            }
            $p=0;
            foreach ($arResult['PROPERTIES']['PRODUCT_GIFT']['PRODUCT_GIFT'] as $PRODUCT_GIFT){
                if($p<2){?>
                    <div class="item__discount--item">
                        <a href="<?=$PRODUCT_GIFT['LIST_PAGE_URL'].$PRODUCT_GIFT['DETAIL_PAGE_URL']?>" class="bd__link">
                            <?if(CFile::GetPath($PRODUCT_GIFT["PREVIEW_PICTURE"])){?>
                                <img src="<?=CFile::GetPath($PRODUCT_GIFT["PREVIEW_PICTURE"])?>">
                            <?}else{?>
                                <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                            <?}?>
                            <p class="bd"><?=$PRODUCT_GIFT["NAME"]?></p>
                            <div class="rg coral">Цена: <?=round(CCurrencyRates::ConvertCurrency($PRODUCT_GIFT["CATALOG_PRICE_1"], $PRODUCT_GIFT['CATALOG_CURRENCY_1'], "BYN"),2);?></div>
                        </a>
                    </div>
                    <?if($ii!=1){?><img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol"><?}
                    $ii--;
                    $price_podarok+=round(CCurrencyRates::ConvertCurrency($PRODUCT_GIFT["CATALOG_PRICE_1"], $PRODUCT_GIFT['CATALOG_CURRENCY_1'], "BYN"),2);?>
                <?}
                $p++;?>
            <?}?>
            <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/equals-symbol.svg" width="26" class="symbol">
            <div class="item__discount--item four-item">
                <div class="four-item__wrap">
                    <a href="<?=$arResult['PROPERTIES']['PODAROK']['PODAROK']['LIST_PAGE_URL'].$arResult['PROPERTIES']['PODAROK']['PODAROK']['DETAIL_PAGE_URL']?>" class="bd__link">
                        <?if(CFile::GetPath($arResult['PROPERTIES']['PODAROK']['PODAROK']["PREVIEW_PICTURE"])){?>
                            <img src="<?=CFile::GetPath($arResult['PROPERTIES']['PODAROK']['PODAROK']["PREVIEW_PICTURE"])?>">
                        <?}else{?>
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                        <?}?>
                        <p class="bd"><?=$arResult['PROPERTIES']['PODAROK']['PODAROK']["NAME"]?></p>
                    </a>
                </div>
                <div>
                    <div class="free-gift">
                        В подарок бесплатно
                    </div>
                    <div class="rg coral mb-1">
                        Цена: <span><?=round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['PODAROK']['PODAROK']["CATALOG_PRICE_1"], $arResult['PROPERTIES']['PODAROK']['PODAROK']['CATALOG_CURRENCY_1'], "BYN"),2);?></span>
                    </div>
                </div>
                <div class="your-price">
                    <p>Ваша цена:</p>
                    <? echo number_format($arResult["CATALOG_PRICE_1"]+$price_podarok, 2, '.',' ');?> <span>руб.</span>
                    <input type="hidden" name="komplekt" value="<? echo $arResult["CATALOG_PRICE_1"]+$price_podarok;?>"/>
                    <input type="hidden" name="komplekt_old" value="<? echo $arResult["CATALOG_PRICE_1"]+$price_podarok+round(CCurrencyRates::ConvertCurrency($arResult['PROPERTIES']['PODAROK']['PODAROK']["CATALOG_PRICE_1"], $arResult['PROPERTIES']['PODAROK']['PODAROK']['CATALOG_CURRENCY_1'], "BYN"),2);?>"/>

                </div>
            </div>

        </div>
        <div class="bd avalaible-is" onclick="addBasket('<?=$arResult["ID"]?>','POD');">Купить комплект</div>
    </div>
<?}?>





<div id="tabs">
    <ul class="reg navs main_flex flex__align-items_center flex__jcontent_between">
        <li class="active rg"><a href="#tabs-1">Характеристики</a></li>
        <li class="rg"><a href="#tabs-2">Доставка</a></li>
        <li class="rg"><a href="#tabs-3">Способы оплаты</a></li>
        <li class="rg"><a href="#tabs-4">Установка</a></li>
        <li class="rg"><a href="#tabs-5">Вопрос-ответ</a></li>
        <li class="rg"><a href="#tabs-6">Отзывы</a></li>
    </ul>
<?//pr($arResult['PROPERTIES']['HARAKTER']);?>
    <div id="tabs-1">
        <?if($arResult['MANUFACTURER']){?>
            <div class="tabs__title clearfix">
                <p class="rg pull-left">Производитель</p>
                <div class="filler"></div>
                <div class="rg pull-right has-hint"><?=$arResult['MANUFACTURER']['NAME'];?></div>
                <div class="cloud">
                    <p class="rg"><?=$arResult['MANUFACTURER']['PREVIEW_TEXT'];?></p>
                </div>
            </div>
        <?}?>
        <?if($arResult['PROPERTIES']['HARAKTER']['VALUE']){
            foreach ($arResult['PROPERTIES']['HARAKTER']['VALUE'] as $key =>$HARAKT){?>
                <div class="tabs__title clearfix">
                    <p class="rg pull-left"><?=$HARAKT?></p>
                    <div class="filler"></div>
                    <p class="rg pull-right"><?=$arResult['PROPERTIES']['HARAKTER']['DESCRIPTION'][$key]?></p>
                </div>
            <?}
        }?>
        <div class="rg text-detail" style="margin-top: 15px;">
            <?=$arResult['DETAIL_TEXT'];?>
        </div>
    </div>

    <div id="tabs-2">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH."/include/delivery-products.php"
            )
        );?>
    </div>

    <div id="tabs-3">
        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH."/include/payments-products.php"
            )
        );?>
    </div>

    <div id="tabs-4">
        <p class="rg">
            <?=$arResult['UF_INSTALL'];?>
        </p>
    </div>

    <div id="tabs-5">
        <?if($arResult['UF_FAQ']){
//            pr($arResult['UF_FAQ']);
            foreach($arResult['UF_FAQ'] as $install){
            ?>
                <div class="order cart">
                    <div class="order__block main_flex__nowrap flex__align-items_center flex__jcontent_between">
                        <p class="rg"><?=$install['NAME'];?></p>
                        <div class="arrow"></div>
                    </div>
                    <div class="order__table">
                        <p class="rg">
                            <?=$install['PREVIEW_TEXT'];?>
                        </p>
                    </div>
                </div>
            <?}?>
        <?}?>
    </div>

    <div id="tabs-6">
        <p class="rg">Здесь можно ознакомиться с отзывами клиентов, уже купивших у нас этот товар. 
            <? if(CSite::InGroup(array(5,1))){ ?>
            Также вы можете поделиться собственными впечатлениями, заполнив  <a class="review-btn">форму отзыва.</a>
        
            <?}else{?>Для  того что бы оставить отзыв, нужно быть авторизованным 
            <a href="javascript:void(0);" class="btn-login">
        Вход
    </a>
            <?}?>
        </p>
        <?if($arResult['REVIEWS']){
//            pr($arResult['REVIEWS']);
            foreach($arResult['REVIEWS'] as $review){
            ?>
                <div class="comments">
                    <div class="comments__list main_flex__nowrap flex__align-items_start flex__jcontent_between">
                        <div class="comments__list--user">
                            <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/avatar-inside-a-circle.svg" width="73">
                        </div>
                        <div class="comments__list--comment">
                            <div class="name main_flex__nowrap flex__align-items_center flex__jcontent_between">
                                <p class="rg"><?=$review['PROPERTY_NAME_VALUE'];?></p>
                                <div class="rating main_flex flex__align-items_center">
                                    <?for ($i = 0; $i < $review['PROPERTY_SCORE_VALUE']; $i++) {?>
                                        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>/img/icon/star-favorite.svg" width="20">
                                    <?}?>
                                </div>
                            </div>

                            <p class="rg"><?=$review['PREVIEW_TEXT'];?></p>

                            <div class="date main_flex__nowrap flex__align-items_center flex__jcontent_between">
                                <div class="date__like main_flex flex__align-items_center">
                                    <a href="<?if (!$USER->IsAuthorized()){echo 'javascript:void(0);';}else{echo '#';}?>" class="review_like <?if (!$USER->IsAuthorized()){echo 'btn-login';}?>" data-like="Y" data-review="<?=$review['ID']?>">
                                        <img class="svg cool" src="<?=SITE_TEMPLATE_PATH?>/img/icon/thumbs-up.svg" width="20">
                                    </a>
                                    <p class="rg data_like<?=$review['ID']?>"><?=$review['LIKES']['LIKES'];?></p>
                                    <a href="<?if (!$USER->IsAuthorized()){echo 'javascript:void(0);';}else{echo '#';}?>" class="review_like <?if (!$USER->IsAuthorized()){echo 'btn-login';}?>" data-like="N" data-review="<?=$review['ID']?>">
                                        <img class="svg hate" src="<?=SITE_TEMPLATE_PATH?>/img/icon/thumbs-up.svg" width="20">
                                    </a>
                                    <p class="rg data_diz<?=$review['ID']?>"><?=$review['LIKES']['DIZ'];?></p>
                                </div>
                                <div class="date__in">
                                    <p class="rg"><?=FormatDate("d F Y", MakeTimeStamp($review['ACTIVE_FROM']))?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>
        <?}?>
    </div>
</div>
<?$dbResult = CCatalogStore::GetList(
    array('ID' => 'ASC'),
    array('ACTIVE' => 'Y'),
    false,
    false,
   false
);
while($sklad = $dbResult->Fetch())
{
    $stores = $sklad;
}?>


<div id="maps">
    <div id="map2"></div>
    <div style="padding-top: 10px;">

        <?$APPLICATION->IncludeComponent(
            "bitrix:main.include",
            "",
            Array(
                "AREA_FILE_SHOW" => "file",
                "AREA_FILE_SUFFIX" => "inc",
                "EDIT_TEMPLATE" => "",
                "PATH" => SITE_TEMPLATE_PATH."/include/image-products.php"
            )
        );?>
    </div>
</div>

<script>
    /*
 $('.minimized').click(function(event) {
    var i_path = $(this).attr('src');
    $('body').append('<div id="overlay"></div><div id="magnify"><img src="'+i_path+'"><div id="close-popup"><i></i></div></div>');
    $('#magnify').css({
    left: ($(document).width() - $('#magnify').outerWidth())/2,
    // top: ($(document).height() - $('#magnify').outerHeight())/2 upd: 24.10.2016
            top: ($(window).height() - $('#magnify').outerHeight())/2
  });
    $('#overlay, #magnify').fadeIn('fast');
  });
  */
  
  $('body').on('click', '#close-popup, #overlay', function(event) {
    event.preventDefault();
 
    $('#overlay, #magnify').fadeOut('fast', function() {
      $('#close-popup, #magnify, #overlay').remove();
    });
  });
  
    $('.item__list--link').click(function(e) {
        e.preventDefault();
        $($(this).data('tab')).trigger('click');
        $('html, body').animate({
            scrollTop: $($(this).data('target')).offset().top - 150
        }, 1000);
    });
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
    function klik(id){
        let price_new = $('input[name="NewPrice"]').val();
        $.ajax({
            type: 'POST',
            url: '<?=SITE_DIR?>ajax/1-klik.php',
            data: {id: id, price: price_new},
            success: function(data){
                $('#one-click-order').html(data);
                $('#one-click-order').show();
            }
        });
    }
    $('.order__block').click(function(e) {
        $('.order__block').not($(this)).find('.arrow').removeClass('active');
        $('.order__block').not($(this)).next('.order__table').slideUp();
        $(this).find('.arrow').toggleClass('active');
        $(this).next('.order__table').slideToggle();
    });
    if($("#map2").length>0){
        ymaps.ready(init);
        var myMap,
            Placemarkmain;

        function init(){
            myMap = new ymaps.Map("map2", {
                // center: [53.932357, 27.562675],
                center: [<?=$stores['GPS_N']?>, <?=$stores['GPS_S']?>],
                zoom: 16,

            },{
                autoFitToViewport: 'always'
            });
            var zoomControl = new ymaps.control.ZoomControl({
                options: {
                    size: "small",
                    position: {
                        left: "auto",
                        right: "40px",
                        top: "150px"
                    }
                }
            });
            myMap.controls.remove(zoomControl);
            myMap.controls.remove('geolocationControl');
            myMap.controls.remove('searchControl');
            myMap.controls.remove('trafficControl');
            myMap.controls.remove('typeSelector');
            myMap.controls.remove('fullscreenControl');
            myMap.controls.remove('rulerControl');
            myMap.controls.remove('zoomControl');
            Placemarkmain = new ymaps.Placemark([<?=$stores['GPS_N']?>, <?=$stores['GPS_S']?>], {}, {
                hintContent: "Хинт метки",
                iconLayout: 'default#image',
                iconImageHref: '/local/templates/avto/img/pictures/map-marker.png',
                iconImageSize: [22, 22],
                iconImageOffset: [0, 0]
            });
            // maps__popup
            myMap.geoObjects.add(Placemarkmain);
            myMap.balloon.open([<?=$stores['GPS_N']?>, <?=$stores['GPS_S']?>], '<div class=""> ' +
                '<h4 class="rg">Хотите посмотреть товар в магазине?* Приезжайте к нам!</h4> ' +
                '<div class="header main_flex flex__align-items_center flex__jcontent_between"> ' +
                '<div class="header__address"> ' +
                '<div class="header__address--icon main_flex__nowrap flex__align-items_center"> ' +
                '<img class="svg icon" src="/local/templates/auto/img/icon/maps-and-flags.svg"> ' +
                '<p class="rg">Минск, ул. Орловская, д. 17</p> ' +
                '</div> ' +
                '<div class="header__address--icon main_flex__nowrap flex__align-items_center"> ' +
                '<img class="svg icon" src="/local/templates/auto/img/icon/wall-clock.svg"> ' +
                '<p class="rg">' +
                '<span class="rg">ПН-ПТ ..</span> 10:00 - 19:00</p> ' +
                '</div> <p class="rg fx"><span class="rg">СБ ........</span> 10:00 - 16:00</p> ' +
                '</div> ' +
                '<div class="header__phones"> ' +
                '<div class="header__address--icon main_flex__nowrap flex__align-items_center fx1"> ' +
                '<img class="svg icon" src="/local/templates/auto/img/icon/phone-call.svg"> ' +
                '<p class="rg"><span class="rg">+375 17</span> 364-17-76</p> ' +
                '</div> ' +
                '<div class="header__address--icon main_flex__nowrap flex__align-items_center fx1"> ' +
                '<img class="svg icon" src="/local/templates/auto/img/icon/logo_velcom.svg"> ' +
                '<p class="rg"><span class="rg">+375 29</span> 635-65-65</p> ' +
                '</div> ' +
                '<div class="header__address--icon main_flex__nowrap flex__align-items_center"> ' +
                '<img class="svg icon" src="/local/templates/auto/img/icon/logo_mts.svg"> ' +
                '<p class="rg"><span class="rg">+375 33</span> 635-65-65</p> </div> </div> </div> ' +
                '<p class="rg small">* Предварительно уточняйте наличие товара, позвонив по указанным номерам</p> </div>', {
                // Опция: не показываем кнопку закрытия.
                closeButton: false
            });
            $(window).resize(function () {
                if ($(window).width() <= 389) {
                    myMap.balloon.open([<?=$stores['GPS_N']?>, <?=$stores['GPS_S']?>]);
                }else {
                    myMap.balloon.open([<?=$stores['GPS_N']?>, <?=$stores['GPS_S']?>]);
                }
            });
            if ($(window).width() <= 389) {
                myMap.balloon.open([<?=$stores['GPS_N']?>, <?=$stores['GPS_S']?>]);
            }else {
                myMap.balloon.open([<?=$stores['GPS_N']?>, <?=$stores['GPS_S']?>]);
            }
        }
    }
</script>