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
<h2 class="inner-title"><?=$arResult['NAME'];?></h2>
<p class="stock-status">
	<?=$arResult['PROPERTIES']['TIME_ACTIVE']['VALUE'];?>
</p>
<p class="text">
	<?=$arResult['DETAIL_TEXT'];?>
</p>
