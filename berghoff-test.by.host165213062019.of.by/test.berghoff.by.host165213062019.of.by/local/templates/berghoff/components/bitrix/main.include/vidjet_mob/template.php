<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
//pr($arResult);?>
<div class="phone-drop" id="phone-drop">
    <ul class="phone-list">
        <?$i=1;
        foreach ($arResult['vidjet_mob'] as $arElement){
            if($i<=3){
                if($arElement['ICONS'] && $arElement['AKTIV']['VALUE']=='Y'){?>
                    <li class="phone-list__item">
                        <img src="<?=CFile::GetPath($arElement['ICONS']['VALUE'])?>" alt="phone">
                        <a class="phone-list__link" href="tel:<?echo str_replace([' ', '(', ')', '-'], '', $arElement['NUMBER_TELEFON']['VALUE']);?>"><span class="phone-list__item_gray"><?echo substr($arElement['NUMBER_TELEFON']['VALUE'], 0,9) ;?></span> <? echo substr($arElement['NUMBER_TELEFON']['VALUE'], 10);?></a>
                    </li>
                    <?$i++;?>
                <?}
            }
        }?>
    </ul>
</div>
