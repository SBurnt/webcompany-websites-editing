<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<div class="items">
    <? foreach ($arResult['ITEMS'] as $arItem): ?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
    <? if (!empty($arItem['PREVIEW_PICTURE'])): ?>
    <? $previewPicture = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 400, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL); ?>
    <div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <img src="<?=$previewPicture['src']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>">
    </div>
    <? endif; ?>
    <? endforeach; ?>
</div>