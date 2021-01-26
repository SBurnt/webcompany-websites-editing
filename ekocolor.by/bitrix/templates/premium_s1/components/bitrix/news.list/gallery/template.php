<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$strId = randString(5);
$carousel = array(
    "ID" => "carousel-" . $strId,
    "NAV" => "carousel-nav-" . $strId,
    "DOTS" => "carousel-dots-" . $strId,
    "GALLERY" => "gallery-" . $strId,
);
?>

<div class="slider">
    <div class="owl-carousel owl-theme" id="<?= $carousel['ID'] ?>">
        <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <? if (!empty($arItem['PREVIEW_PICTURE'])): ?>
            <? $previewPicture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 600, 'height' => 600), BX_RESIZE_IMAGE_PROPORTIONAL); ?>
            <a href="<?= $arItem['PREVIEW_PICTURE']['SRC'] ?>" title="<?=strip_tags($arItem['NAME'])?>" data-lightbox="<?= $carousel['GALLERY'] ?>">
                <div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="item" style="background-image:url(<?= $previewPicture['src'] ?>)">
                    <div class="gradient">
                        <div class="name"><?= $arItem['NAME'] ?></div>
                    </div>
                </div>
            </a>
        <? endif; ?>
        <? endforeach; ?>
    </div>  
    <div class="owl-dots" id="<?= $carousel['DOTS'] ?>"></div>   
</div>
<script>
    lightbox.option({
        'showImageNumberLabel': false,
        'wrapAround': true
    });
    $('#<?= $carousel['ID'] ?>').owlCarousel({
        margin: 30,
        loop: true,
        // autoWidth:true,
        dots: true,
        dotsContainer: '#<?= $carousel['DOTS'] ?>',
        navText: ["<div class='prev icon icon-back'></div>", "<div class='next icon icon-forward'></div>"],
        navContainer: '#gallery-navigation',
        responsive : {
            0 : {
                items: 1,
                nav: false
            },
            640 : {
                items: 2,
                nav: true
            },
            960 : {
                loop: false,
                items: 3,
                nav: true
            }
        }
    });
</script>   