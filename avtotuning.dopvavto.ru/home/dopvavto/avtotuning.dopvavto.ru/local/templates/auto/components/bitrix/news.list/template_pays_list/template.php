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
<!--- client --->
<div id="client">
    <div class="wrapper">
        <div class="client main_flex flex__align-items_center flex__jcontent_between">
            <a class="client__list">Способы оплаты</a>
            <?foreach($arResult["ITEMS"] as $arItem){?>
                <a <?=($arItem['PROPERTIES']['URL']['VALUE']) ? 'href="'.$arItem['PROPERTIES']['URL']['VALUE'].'"' : '';?> class="client__list">
                    <?
                    if($arItem['PREVIEW_PICTURE']['ID'])
                    {?>
                        <img src="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>" alt="">
                    <?}
                    ?>
                </a>
            <?}?>
        </div>
    </div>
</div>
<!--- end client --->