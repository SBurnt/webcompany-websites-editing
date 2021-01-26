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
<div id="custom-cta-tag">
    <a href="<?=$arResult["PROPERTIES"]["url_podarka"]["VALUE"]?>" class="cta-toggle"></a>
    <div class="cta-content">
        <div class="cta-title">
            <span style="font-size:65px;margin-bottom: 5px"><?=str_replace("|"," ",$arResult["PROPERTIES"]["sum_podarka"]["VALUE"]);?></span>
            <?=$arResult["PROPERTIES"]["text_podarka"]["VALUE"]?>
        </div>
        <a href="<?=$arResult["PROPERTIES"]["url_podarka"]["VALUE"]?>" class="cta-knop" target="_blank"><?=$arResult["PROPERTIES"]["text_cnopka"]["VALUE"]?></a>
    </div>
</div>