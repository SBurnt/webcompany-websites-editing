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

if (empty($arResult["SECTIONS"]) || ($arParams['HIDE_EMPTY'] && count($arResult["SECTIONS"]) < 2))
{
    return;
}

use Bitrix\Main\Localization\Loc;

$render = function ($arSection, $idx = -1, $addButtons = false) use ($templateFolder)
{
    if ($addButtons)
    {
        $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'],
            CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
        $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'],
            CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"),
            array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
    }

    ?>
    <a href="<?=$arSection['SECTION_PAGE_URL']?>"
       class="line-sections__item<?=($arSection['IS_ACTIVE'] ? ' _selected' : '')?>"
       <?=($addButtons ? sprintf('id="%s"', $this->GetEditAreaId($arSection['ID'])) : '')?>
    >
        <div class="line-sections__item-icon-w"
             style="color: <?=$arSection['UF_SECTION_COLOR'] ?: 'inherit'?>;">
            <img class="line-sections__item-icon"
                 src="<?=\Citrus\Core\array_get($arSection, 'PICTURE.SRC',
				     $templateFolder . '/default-icon.png')?>"
                 alt="">
        </div>
        <div class="line-sections__item-content">
            <div class="line-sections__item-name">
				<?=$arSection['NAME']?>
            </div>
			<? if ($arSection['ELEMENT_CNT']): ?>
                <div class="line-sections__item-count">
					<?=(int)$arSection['ELEMENT_CNT']?> <?=\Citrus\Core\plural($arSection['ELEMENT_CNT'],
						explode('|', Loc::getMessage("LINE_SECTIONS_OBJECTS")))?>
                </div>
			<? endif; ?>
        </div>
    </a>
    <?php
}
?>
<div class="modal-content mfp-hide">
    <div class="modal-header">
        <div class="modal-title"><?=Loc::getMessage("CITRUS_AREALTY3_MENU_CATALOG_TITLE")?></div>
        <button class="btn modal-close-btn mfp-close" data-dismiss="modal">
            <span class="fa fa-times"></span>
        </button>
    </div>
    <div class="modal-body">

    </div><!-- .modal-body -->
</div><!-- .modal-content -->

<div class="line-sections _mobile">
    <a class="hamburger js-line-sections-button"
       href="javascript:void(0)"
       aria-label="<?=Loc::getMessage("CITRUS_AREALTY3_OPEN_HAMBURGER_MENU_CATALOG")?>"
    >
        <span class="lines" aria-hidden="true"></span>
    </a>
	<?php
	$selectedSections = array_filter($arResult["SECTIONS"], function ($s) { return $s['IS_ACTIVE']; }) ?: $arResult["SECTIONS"];
	$render(reset($selectedSections));
    ?>
</div>

<div class="line-sections<?=($arParams['ALIGN_LEFT'] === 'Y' ? ' line-sections--align-left' : '')?>">
<?php
    array_walk($arResult["SECTIONS"], $render, true);
?>
</div>
