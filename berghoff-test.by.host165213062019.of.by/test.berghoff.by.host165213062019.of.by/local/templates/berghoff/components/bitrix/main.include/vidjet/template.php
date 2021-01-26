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
<div class="phone-drop">
    <a class="phone-drop__link" href="/info/contacts/">Контактная информация</a>
    <ul class="phone-list">
        <?foreach ($arResult['vidjet'] as $arElement){
            if($arElement['ICONS'] && $arElement['AKTIV']['VALUE']=='Y'){?>
                <li class="phone-list__item">
                    <img src="<?=CFile::GetPath($arElement['ICONS']['VALUE'])?>" alt="phone">
                    <a href="tel:<?echo substr($arElement['NUMBER_TELEFON']['VALUE'], 0,19) ;?>"><span class="phone-list__link"><span class="phone-list__item_gray"><?echo substr($arElement['NUMBER_TELEFON']['VALUE'], 0,9) ;?></span> <? echo substr($arElement['NUMBER_TELEFON']['VALUE'], 10);?></span></a>
                </li>
            <?}?>

        <?}?>
    </ul>
    <span class="phone-drop__note">Не дозвониться?</span>
        <a data-fancybox data-src="#callback-modal" href="javascript:;" class="phone-drop__callback">Заказать звонок</a>
    <ul class="phone-soc">
        <?foreach ($arResult['vidjet'] as $arElementMes){
            if($arElementMes['ICONS_MES'] && $arElementMes['ACTIV_MES']['VALUE']=='Y'){?>
                <li class="phone-soc__item">
                    <a class="phone-soc__link" href="<? if ($arElementMes['A_MES']['VALUE']) echo $arElementMes['A_MES']['VALUE']; else echo '#';?>">
                        <img class="phone-soc__img" src="<?=CFile::GetPath($arElementMes['ICONS_MES']['VALUE'])?>" alt="soc">
                        <?=$arElementMes['NAME_MES']['VALUE']?>
                    </a>
                </li>
            <?}?>
        <?}?>
        <?foreach ($arResult['vidjet'] as $arElementMail){
            if($arElementMail['ICONS_EMAIL'] && $arElementMail['ACTIV_EMAIL']['VALUE']=='Y'){?>
                <li class="phone-soc__item">
                    <a class="phone-soc__link" href="#">
                        <img class="phone-soc__img" src="<?=CFile::GetPath($arElementMail['ICONS_EMAIL']['VALUE'])?>" alt="soc">
                        <?=$arElementMail['NAME_EMAIL']['VALUE']?>
                    </a>
                </li>
            <?}?>
        <?}?>
    </ul>
    <div class="phone-time">
        <span class="phone-time__title"><? echo $arResult['vidjet'][11]['RABOTA_REJ']['NAME'].':';?></span>
<!--        --><?//pr($arResult['vidjet']);?>
        <?foreach ($arResult['vidjet'] as $arElementRej){
            if($arElementRej['RABOTA_REJ'] && $arElementRej['ACTIV_REJ']['VALUE']=='Y'){?>
                <p class="phone-time__text">
                    <?=$arElementRej['RABOTA_REJ']['VALUE']?>
                </p>
            <?}?>
        <?}?>
    </div>
    <ul class="drop-soc">
        <?foreach ($arResult['vidjet'] as $arElementSoc){
//            pr($arElementSoc['A_SEC']);
            if($arElementSoc['SVG_ICONS_SEC'] && $arElementSoc['ACTIV_SEC']['VALUE']=='Y'){?>
                <li class="drop-soc__item">
                    <a target="_blank" href="http://<?=$arElementSoc['A_SEC']['~VALUE']?>">
                        <?=$arElementSoc['SVG_ICONS_SEC']['~VALUE']?>
                    </a>
                </li>
            <?}?>
        <?}?>
    </ul>
</div>