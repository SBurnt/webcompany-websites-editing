<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

<div class="items <?=( count($arResult['ITEMS']) > 2 ) ? "top" : "" ?>">
<? foreach ($arResult['ITEMS'] as $key => $arItem): ?>
    <? if ($key > 3) break; ?>
    <div class="item">
        <? if (!empty($arItem['icon']) || !empty($arItem['custom_icon'])): ?>
        <div class="icon <?= (!empty($arItem['custom_icon'])) ? "zmdi " .$arItem['custom_icon']  : $arItem['icon'] ?>"></div>
        <? endif; ?>
        <div class="name"><?= $arItem['name'] ?></div>
        <div class="desc"><?= $arItem['description'] ?></div>
    </div>
<? endforeach; ?>
</div>