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
<div class="shop shop_hidden">
	<div class="owl-carousel" id="home-slider-1">
		<?foreach($arResult["ITEMS"] as $arItem){?>
			<a href="<?=$arItem["PROPERTIES"]['URL']['VALUE'];?>"><div class="item2">
				<div class="skewed">
					<h2 class="skewed ft"><?=$arItem['PREVIEW_TEXT'];?></h2>
				</div>
				<img class="w-100" src="<?=$arItem['PICTURE_SMALL'];?>" alt="<?=$arItem['NAME'];?>">
			</div></a>
        		<?}?>
	</div>
</div>