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

<div class="photos-block">
	<?foreach($arResult["ITEMS"] as $arItem){?>
		<a class="photos-element" data-fancybox="gallery" href="<?=$arItem['PREVIEW_PICTURE']['SRC'];?>">
			<img class="main-img" src="<?=$arItem['PICTURE_272_145'];?>" alt="">
			<span class="hover-block">
				<img class="zoom-img" src="<?=SITE_TEMPLATE_PATH;?>/img/pictures/plus-zoom.png" alt="">
			</span>
		</a>
	<?}?>
</div>
