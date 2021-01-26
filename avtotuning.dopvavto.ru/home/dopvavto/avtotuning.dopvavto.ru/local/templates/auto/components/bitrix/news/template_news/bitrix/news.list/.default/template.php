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
$this->setFrameMode(true);
?>

<div class="stock-block news-block">
    <?foreach($arResult["ITEMS"] as $arItem){?>
        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="stock-element">
            <p class="date">
                <?=$arItem['DISPLAY_ACTIVE_FROM'];?>
            </p>
            <?if($arItem['PREVIEW_280_150']){?>
                <img src="<?=$arItem['PREVIEW_280_150'];?>" alt="">
            <?}?>
            <p class="stock-title">
                <?=$arItem['NAME'];?>
            </p>
        </a>
    <?}?>
</div>

<?=$arResult["NAV_STRING"];?>