<?
use \Nextype\Premium\CLanding;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$strId = randString(5);
$carousel = array(
    "ID" => "carousel-" . $strId,
    "NAV" => "carousel-nav-" . $strId,
    "DOTS" => "carousel-dots-" . $strId
);

CLanding::getInstance(SITE_ID);

?>
<div class="top-slider">
    <div class="owl-carousel owl-theme" id="<?=$carousel["ID"]?>">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        
            $buttonEvent = "";
            if ($arItem['PROPERTIES']['BUTTON_EVENT']['VALUE_XML_ID'] == "BLOCK" && !empty($arItem['PROPERTIES']['BIND_BLOCK']['VALUE_XML_ID']))
                $buttonEvent = "Landing.goToBlock('".$arItem['PROPERTIES']['BIND_BLOCK']['VALUE_XML_ID']."')";
            elseif ($arItem['PROPERTIES']['BUTTON_EVENT']['VALUE_XML_ID'] == "FORM")
                $buttonEvent = "Landing.buyProduct(this, ". CUtil::PhpToJSObject(Array ('NAME' => $arItem['PROPERTIES']['PRODUCT_NAME']['VALUE'], 'PRICE' => '')) .")";
                
            
        ?>
        <div class="item" style="background-image: url(<?=$arItem['PREVIEW_PICTURE']['SRC']?>)" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="gradient">
                <div class="container">
                    <div class="content position-<?=strtolower($arItem['PROPERTIES']['POSITION']['VALUE_XML_ID'])?>">
                        <div class="text">
                            <div class="title"><?=$arItem['NAME']?></div>
                            <? if (!empty($arItem['PROPERTIES']['BUTTON_TEXT']['VALUE'])): ?>
                            <a href="javascript:void(0)" onclick="<?=$buttonEvent?>" class="btn color"><?=$arItem['PROPERTIES']['BUTTON_TEXT']['VALUE']?></a>
                            <? endif; ?>
                        </div>
                        <img class="image" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="<?=$arItem['DETAIL_PICTURE']['ALT']?>" title="<?=$arItem['DETAIL_PICTURE']['TITLE']?>" />
                    </div>
                </div>
            </div>
        </div>
        <? endforeach; ?>

    </div>
    <div class="container">
        <div class="owl-nav" id="<?=$carousel["NAV"]?>"></div>
        <div class="owl-dots top" id="<?=$carousel["DOTS"]?>"></div>
    </div>
    <script>
        $('#<?=$carousel["ID"]?>').owlCarousel({
            items: 1,
            loop: true,
            dots: true,
            dotsContainer: '#<?=$carousel["DOTS"]?>',
            navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
            navContainer: '#<?=$carousel["NAV"]?>',
            autoplay: <?=CLanding::$options['SLIDER_AUTOPLAY'] == "Y" ? "true" : "false"?>,
            autoplayTimeout: <?=intval(CLanding::$options['SLIDER_AUTOPLAY_TIMEOUT']) > 0 ? intval(CLanding::$options['SLIDER_AUTOPLAY_TIMEOUT']) : "5000"?>,
            responsive : {
                0 : {
                    nav: false
                },
                960 : {
                    navSpeed: 500,
                    nav: true
                },
                1211 : {
                    navSpeed: false,
                    nav: true
                }
            }
        })
    </script>
</div>