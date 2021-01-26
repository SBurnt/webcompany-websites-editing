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
<?
foreach($arResult["ITEMS"] as $arItem)
{?>
	<a <?=($arItem['PROPERTIES']['URL']['VALUE']) ? 'href="'.$arItem['PROPERTIES']['URL']['VALUE'].'"' : '';?> class="loal web-item">
		<p class="bd"><?=$arItem['NAME'];?></p>
		<img style="margin-top: -113px" src="<?=$arItem['PICTURE_SMALL'];?>" alt="">
	</a>
<?}
?>