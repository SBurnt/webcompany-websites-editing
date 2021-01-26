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

<div class="video-block">
    <?foreach($arResult["ITEMS"] as $arItem){?>
        <div class="video-element">
            <iframe width="100%" height="215" src="https://www.youtube.com/embed<?=strrchr($arItem['PROPERTIES']['URL_YOUTUBE']['VALUE'], '/');?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <p><?=$arItem['NAME'];?></p>
        </div>
    <?}?>
</div>