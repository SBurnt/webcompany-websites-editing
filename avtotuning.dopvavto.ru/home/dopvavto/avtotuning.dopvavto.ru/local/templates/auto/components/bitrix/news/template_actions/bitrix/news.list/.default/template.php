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
<h2 class="shop__title category rg"><?=$APPLICATION->ShowTitle();?></h2>
<div class="stock-block">
    <?foreach($arResult["ITEMS"] as $arItem){?>
        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="stock-element">
            <?if($arItem['PICTURE_280_150']){?>
                <img src="<?=$arItem['PICTURE_280_150']?>" alt="">
            <?}?>
            <p class="valid">
                <?=$arItem['PROPERTIES']['TIME_ACTIVE']['VALUE'];?>
            </p>
            <p class="stock-title">
                <?=$arItem['NAME'];?>
            </p>
        </a>
    <?}?>
</div>


<?
if($arResult['DEACTIVE_ACTIONS'])
{?>
    <h2 class="shop__title category rg">Прошедшие акции</h2>
    <div class="stock-block past-stock-block">
        <?foreach($arResult['DEACTIVE_ACTIONS'] as $action){?>
            <a href="#" class="stock-element">
                <?if($action['PICTURE_280_150']){?>
                    <img src="<?=$action['PICTURE_280_150'];?>" alt="">
                <?}?>
                <p class="valid">
                    <?=$action['PROPERTY_TIME_ACTIVE_VALUE'];?>
                </p>
                <p class="stock-title">
                    <?=$action['NAME'];?>
                </p>
            </a>
        <?}?>
    </div>
<?}
?>


<?=$arResult["NAV_STRING"]?>