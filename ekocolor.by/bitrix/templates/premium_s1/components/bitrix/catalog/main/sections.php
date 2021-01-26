<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

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

$arSections = Array ();
$arSectionsID = Array ();

$arSectionFilter = Array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y');

$obCache = new CPHPCache();
if ($obCache->InitCache(36000, serialize($arSectionFilter), "/iblock/catalog_sections"))
{
    $arCacheSections = $obCache->GetVars();
    $arSections = $arCacheSections['arSections'];
    $arSectionsID = $arCacheSections['arSectionsID'];

}
elseif ($obCache->StartDataCache())
{
    $arCurSection = array();
    if (Loader::includeModule("iblock"))
    {
        $rsSections = CIBlockSection::GetTreeList($arSectionFilter);
        
        $currentSectionKey = 0;
        while ($arSection = $rsSections->fetch())
        {
            if ($arSection['DEPTH_LEVEL'] > 1)
            {
                $arCacheSections['arSections'][$currentSectionKey]['SUB'][] = $arSection;
            }
            else
            {
                $currentSectionKey = $arSection['ID'];
                $arCacheSections['arSections'][$currentSectionKey] = $arSection;
            }

            $arCacheSections['arSectionsID'][] = $arSection['ID'];
        }
        
    }
    
    $obCache->EndDataCache($arCacheSections);
    
    $arSections = $arCacheSections['arSections'];
    $arSectionsID = $arCacheSections['arSectionsID'];
}

?>

<? if (!empty($arSections)): ?>

    <div class="tabs center">
        <? $key = 0; ?>
        <? foreach ($arSections as $arSection): ?>
        <a href="javascript:void(0);" onclick="openCatalogTab(this, 'tab-<?=$arSection['ID']?>');" class="tab<?=($key==0) ? ' active' : ''?>"><?=$arSection['NAME']?></a>
        <? $key++; ?>
        <? endforeach; ?>
    </div>

    <? $key = 0; ?>
    <? foreach ($arSections as $arSection): ?>
    <div class="tab-content<?=($key==0) ? ' active' : ''?>" id="tab-<?=$arSection['ID']?>">
        <? if (!empty($arSection['SUB'])): ?>
            <div class="tags center">
                <? $sKey = 0; ?>
                <? foreach ($arSection['SUB'] as $arSubSection): ?>
                <a href="javascript:void(0);" onclick="openCatalogTab(this, 'tab-<?=$arSubSection['ID']?>');" class="tag<?=($sKey==0) ? ' active' : ''?>"><?=$arSubSection['NAME']?></a>
                <? $sKey++; ?>
                <? endforeach; ?>
            </div>
        
            <? $sKey = 0; ?>
            <? foreach ($arSection['SUB'] as $arSubSection): ?>
            <div class="tag-content<?=($sKey==0) ? ' active' : ''?>" id="tab-<?=$arSubSection['ID']?>">
                 <!-- depth == 2 -->

                <?
                $GLOBALS['SECTION_ID'] = $arSubSection['ID'];
                include(__DIR__ . "/section.php");
                ?>
                
                <? $sKey++; ?>
            </div>
            <? endforeach; ?>
        <? else: ?>
            <!-- depth == 1 -->
            <?
            $GLOBALS['SECTION_ID'] = $arSection['ID'];
            include(__DIR__ . "/section.php");
            ?>
        <? endif; ?>
    </div>
    <? $key++; ?>
    <? endforeach; ?>

<script>
function openCatalogTab (element, tab) {
    var tab = $("#" + tab);
    if (tab.length > 0) {
        tab.parent().find('> .tag-content, > .tab-content').removeClass('active');
        tab.addClass('active');
        
        element = $(element);
        element.parent().find('> a').removeClass('active');
        element.addClass('active');
    }
};
</script>

<? else: ?>
<!-- $arSections == empty -->
<? 
$GLOBALS['SECTION_ID'] = false;
include(__DIR__ . "/section.php");
?>

<? endif; ?>