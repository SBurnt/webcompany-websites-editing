<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="items">
    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <div class="item">
            <div class="icon <?= (!empty($arItem['custom_icon'])) ? "zmdi " .$arItem['custom_icon']  : $arItem['icon'] ?>"></div>
            <div class="text"><?= $arItem['name'] ?></div>
        </div>
    <? endforeach; ?>

</div>
