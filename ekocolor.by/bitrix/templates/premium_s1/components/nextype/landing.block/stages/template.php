<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
$this->setFrameMode(true);
?>

<div class="items">
<? foreach ($arResult['ITEMS'] as $key => $arItem): ?>
    <div class="item">
        <div class="name"><?= $arItem['name'] ?></div>
        <div class="desc"><?= $arItem['description'] ?></div>
    </div>
<? endforeach; ?>
</div>