<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$strId = randString(5);
$carousel = array(
    "ID" => "carousel-" . $strId,
    "NAV" => "carousel-nav-" . $strId,
    "DOTS" => "carousel-dots-" . $strId,
);
?>

<div class="slider">
    <div class="owl-carousel owl-theme carousel" id="<?=$carousel['ID']?>">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="name"><?=$arItem['NAME']?></div>
            <div class="review"><?=$arItem['PREVIEW_TEXT']?></div>
        </div>
        <? endforeach; ?>
    </div>
    <div class="owl-nav" id="<?=$carousel['NAV']?>"></div>
    <div class="owl-dots" id="<?=$carousel['DOTS']?>"></div>
    <script>
            $('#<?=$carousel['ID']?>').owlCarousel({
                items: 1,
                loop: true,
                dots: true,
                dotsContainer: '#<?=$carousel['DOTS']?>',
                responsive : {
                    0 : {
                        nav: false
                    },
                    960 : {
                        nav: true,
                        navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
                        navContainer: '#<?=$carousel['NAV']?>'
                    },
                }
        });
    </script>
</div>