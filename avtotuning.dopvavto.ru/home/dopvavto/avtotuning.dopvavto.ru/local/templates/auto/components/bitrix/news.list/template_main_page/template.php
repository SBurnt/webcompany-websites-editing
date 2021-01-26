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

<div class="two__flex flex__4">
    <h2 class="shop__title rg"><?=$arParams['PAGER_TITLE'];?></h2>

    <?foreach($arResult["ITEMS"] as $k => $arItem){?>
        <a href="<?=$arItem['DETAIL_PAGE_URL'];?>" class="bd two__gold two__in"><?=$arItem['NAME'];?></a>
        <?if($k == 0){?>
            <p class="rg"><?=$arItem['PREVIEW_TEXT'];?></p>
        <?}?>
        <div class="span rg"><?=$arItem['DISPLAY_ACTIVE_FROM'];?></div>
    <?}?>

    <a href="/news/" class="bd two__gold">Все новости <img class="svg svg-gold-9" src="<?=SITE_TEMPLATE_PATH;?>/img/icon/double-angle-right.svg" width="9"></a>
</div>
