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

if (!$arResult["NavShowAlways"])
{
	if (0 == $arResult["NavRecordCount"] || (1 == $arResult["NavPageCount"] && false == $arResult["NavShowAll"]))
		return;
}
if ('' != $arResult["NavTitle"])
	$arResult["NavTitle"] .= ' ';

$strSelectPath = $arResult['sUrlPathParams'].($arResult["bSavePage"] ? '&PAGEN_'.$arResult["NavNum"].'='.(true !== $arResult["bDescPageNumbering"] ? 1 : '').'&' : '').'SHOWALL_'.$arResult["NavNum"].'=0&SIZEN_'.$arResult["NavNum"].'=';

?>
<div class="pagination__catalog-door">
    <?if (1 < $arResult["NavPageNomer"]){?>
        <a class="pagination__prev" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>">
            <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.1498 3.42321L3.42322 0.14979C3.62294 -0.0499299 3.94684 -0.0499299 4.14656 0.14979C4.34632 0.34955 4.34632 0.673373 4.14656 0.873134L1.74629 3.27341H10.4885C10.771 3.27341 11 3.50243 11 3.78488C11 4.0673 10.771 4.29635 10.4885 4.29635H1.74629L4.14648 6.69663C4.34624 6.89639 4.34624 7.22021 4.14648 7.41997C4.04664 7.51977 3.91571 7.56977 3.78481 7.56977C3.65391 7.56977 3.52302 7.51977 3.42314 7.41997L0.1498 4.14655C-0.0499601 3.94679 -0.0499601 3.62297 0.1498 3.42321Z" fill="#9A9A9A" />
            </svg>
        </a>
    <?}else{?>
        <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0.1498 3.42321L3.42322 0.14979C3.62294 -0.0499299 3.94684 -0.0499299 4.14656 0.14979C4.34632 0.34955 4.34632 0.673373 4.14656 0.873134L1.74629 3.27341H10.4885C10.771 3.27341 11 3.50243 11 3.78488C11 4.0673 10.771 4.29635 10.4885 4.29635H1.74629L4.14648 6.69663C4.34624 6.89639 4.34624 7.22021 4.14648 7.41997C4.04664 7.51977 3.91571 7.56977 3.78481 7.56977C3.65391 7.56977 3.52302 7.51977 3.42314 7.41997L0.1498 4.14655C-0.0499601 3.94679 -0.0499601 3.62297 0.1498 3.42321Z" fill="#9A9A9A" />
        </svg>
    <?}?>
    <ul class="pagination__list">
        <?if (true === $arResult["bDescPageNumbering"]){
            $NavRecordGroup = $arResult["NavPageCount"];
            while ($NavRecordGroup >= 1)
            {
                $NavRecordGroupPrint = $arResult["NavPageCount"] - $NavRecordGroup + 1;
                $strTitle = GetMessage(
                    'nav_page_num_title',
                    array('#NUM#' => $NavRecordGroupPrint)
                );
                if ($NavRecordGroup == $arResult["NavPageNomer"])
                {
                    ?><li class="pagination__item active" title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroupPrint; ?></li><?
                }
                elseif ($NavRecordGroup == $arResult["NavPageCount"] && $arResult["bSavePage"] == false)
                {
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
                }
                else
                {
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
                }
                if (1 == ($arResult["NavPageCount"] - $NavRecordGroup) && 2 < ($arResult["NavPageCount"] - $arResult["nStartPage"]))
                {
                    $middlePage = floor(($arResult["nStartPage"] + $NavRecordGroup)/2);
                    $NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
                    $strTitle = GetMessage(
                        'nav_page_num_title',
                        array('#NUM#' => $NavRecordGroupPrint)
                    );
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
                    $NavRecordGroup = $arResult["nStartPage"];
                }
                elseif ($NavRecordGroup == $arResult["nEndPage"] && 3 < $arResult["nEndPage"])
                {
                    $middlePage = ceil(($arResult["nEndPage"] + 2)/2);
                    $NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
                    $strTitle = GetMessage(
                        'nav_page_num_title',
                        array('#NUM#' => $NavRecordGroupPrint)
                    );
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
                    $NavRecordGroup = 2;
                }
                else
                {
                    $NavRecordGroup--;
                }
            }
	    }else{
            $NavRecordGroup = 1;
            while($NavRecordGroup <= $arResult["NavPageCount"])
            {
                $strTitle = GetMessage(
                    'nav_page_num_title',
                    array('#NUM#' => $NavRecordGroup)
                );
                if ($NavRecordGroup == $arResult["NavPageNomer"])
                {
                    ?><li class="pagination__item active" title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroup; ?></li><?
                }
                elseif ($NavRecordGroup == 1 && $arResult["bSavePage"] == false)
                {
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
                }
                else
                {
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
                }
                if ($NavRecordGroup == 2 && $arResult["nStartPage"] > 3 && $arResult["nStartPage"] - $NavRecordGroup > 1)
                {
                    $middlePage = ceil(($arResult["nStartPage"] + $NavRecordGroup)/2);
                    $strTitle = GetMessage(
                        'nav_page_num_title',
                        array('#NUM#' => $middlePage)
                    );
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
                    $NavRecordGroup = $arResult["nStartPage"];
                }
                elseif ($NavRecordGroup == $arResult["nEndPage"] && $arResult["nEndPage"] < ($arResult["NavPageCount"] - 2))
                {
                    $middlePage = floor(($arResult["NavPageCount"] + $arResult["nEndPage"] - 1)/2);
                    $strTitle = GetMessage(
                        'nav_page_num_title',
                        array('#NUM#' => $middlePage)
                    );
                    ?><li class="pagination__item"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
                    $NavRecordGroup = $arResult["NavPageCount"]-1;
                }
                else
                {
                    $NavRecordGroup++;
                }
            }
	    }?>
    </ul>
    <?if ($arResult["NavPageNomer"] < $arResult["NavPageCount"]){?>
        <a class="pagination__next" href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_next_title'); ?>">
            <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.8502 3.42321L7.57678 0.14979C7.37706 -0.0499299 7.05316 -0.0499299 6.85344 0.14979C6.65368 0.34955 6.65368 0.673373 6.85344 0.873134L9.25371 3.27341H0.511472C0.229017 3.27341 0 3.50243 0 3.78488C0 4.0673 0.229017 4.29635 0.511472 4.29635H9.25371L6.85352 6.69663C6.65376 6.89639 6.65376 7.22021 6.85352 7.41997C6.95336 7.51977 7.08429 7.56977 7.21519 7.56977C7.34609 7.56977 7.47698 7.51977 7.57686 7.41997L10.8502 4.14655C11.05 3.94679 11.05 3.62297 10.8502 3.42321Z" fill="#9A9A9A" />
            </svg>
        </a>
    <?}else{?>
        <svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.8502 3.42321L7.57678 0.14979C7.37706 -0.0499299 7.05316 -0.0499299 6.85344 0.14979C6.65368 0.34955 6.65368 0.673373 6.85344 0.873134L9.25371 3.27341H0.511472C0.229017 3.27341 0 3.50243 0 3.78488C0 4.0673 0.229017 4.29635 0.511472 4.29635H9.25371L6.85352 6.69663C6.65376 6.89639 6.65376 7.22021 6.85352 7.41997C6.95336 7.51977 7.08429 7.56977 7.21519 7.56977C7.34609 7.56977 7.47698 7.51977 7.57686 7.41997L10.8502 4.14655C11.05 3.94679 11.05 3.62297 10.8502 3.42321Z" fill="#9A9A9A" />
        </svg>
    <?}?>
</div>
