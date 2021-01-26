<?php

use Bitrix\Main\Web\Json;
use Bitrix\Main\Localization\Loc;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/** @var CitrusRealtyMortage $component Tekushtiy vizvanniy komponent */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */
/** @var array $arResult Massiv rezulytatov raboti komponenta */
/** @var array $arParams Massiv vhodyashtih parametrov komponenta, mozhet ispolyzovatysya dlya ucheta zadannih parametrov pri vivode shablona (naprimer, otobrazhenii detalynih izobrazheniy ili ssilok). */
/** @var string $templateFile Puty k shablonu otnositelyno kornya sayta, naprimer /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName Imya shablona komponenta (naprimer: .default) */
/** @var string $templateFolder Puty k papke s shablonom ot DOCUMENT_ROOT (naprimer /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData Massiv dlya zapisi, obratite vnimanie, takim obrazom mozhno peredaty dannie iz template.php v fayl component_epilog.php, prichem eti dannie popadayut v kesh, t.k. fayl component_epilog.php ispolnyaetsya na kazhdom hite */
/** @var string $parentTemplateFolder Papka roditelyskogo shablona. Dlya podklyucheniya dopolnitelynih izobrazheniy ili skriptov (resursov) udobno ispolyzovaty etu peremennuyu. Ee nuzhno vstavlyaty dlya formirovaniya polnogo puti otnositelyno papki shablona */
/** @var string $componentPath Puty k papke s komponentom ot DOCUMENT_ROOT (napr. /bitrix/components/bitrix/iblock.list) */
/** @var CMain $APPLICATION */
/** @var CUser $USER */

$this->setFrameMode(true);

CJSCore::Init(array('jquery'));
$this->addExternalJs($templateFolder . '/assets/jquery-ui-1.12.0.custom/jquery-ui.js');
$this->addExternalJs($templateFolder . '/assets/jquery.ui.touch-punch.min.js');
$this->addExternalJs($templateFolder . '/assets/wNumb.js');
$this->addExternalCss($templateFolder . '/assets/jquery-ui-1.12.0.custom/jquery-ui.css');
if (isset($arResult['theme']))
{
	$this->addExternalCss($templateFolder . '/assets/theme-' . $arResult['theme'] . '.css');
}

$id = $component->getId();

?>

<div class="citrus-realty-mortgage" id="<?=$id?>">
	<form action class="calc-content">
		<div class="service-form-row">
			<label class="payment service-form-label" for="<?=$id?>-full-price-val"><?=Loc::getMessage('CITRUS_AREALTY_MORTGAGE_FULL_PRICE')?>:</label>
			<div class="field inline">
				<input
					class="input-short full-price-val"
					id="<?=$id?>-full-price-val"
					type="text"
					value="<?=$arParams['defaultFullPrice']?>">
				<?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_CURRENCY")?>
			</div>
			<div class="slider-cont">
				<div class="full-price"></div>
			</div>
		</div>
		<div class="service-form-row">
			<label class="payment service-form-label" for="<?=$id?>-first-price-val"><?=Loc::getMessage('CITRUS_AREALTY_MORTGAGE_FIRST_PRICE')?>:</label>
			<div class="field inline">
				<input
					class="input-short first-price-val"
					id="<?=$id?>-first-price-val"
					type="text"
					value="<?=$arParams['defaultFirstPrice']?>">
				<?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_CURRENCY")?>
			</div>
			<div class="slider-cont">
				<div class="first-price"></div>
			</div>
		</div>
		<div class="payment service-form-row">
			<label class="payment service-form-label" for="<?=$id?>-first-percent-val"></label>
			<div class="field inline">
				<input
					id="<?=$id?>-first-percent-val"
					class="input-short input-percent first-percent-val"
					type="text"
					value="<?=$arParams['defaultFirstPercent']?>">
				%
			</div>
			<div class="slider-cont">
				<div class="first-percent"></div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="service-form-row">
			<label class="payment service-form-label" for="<?=$id?>-percent-val"><?=Loc::getMessage('CITRUS_AREALTY_MORTGAGE_PERCENT')?>:</label>
			<div class="field inline">
				<input
					id="<?=$id?>-percent-val"
					class="input-short input-percent percent-val"
					type="text"
					value="<?=$arParams['defaultPercent']?>">
				%
			</div>
			<div class="slider-cont">
				<div class="percent"></div>
			</div>
		</div>
		<div class="service-form-row">
			<label class="payment service-form-label" for="<?=$id?>-years-val"><?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_YEAR")?>:</label>
			<div class="field inline">
				<input
					id="<?=$id?>-years-val"
					class="input-short years-val"
					name="years"
					type="text"
					value="<?=$arParams['defaultYear']?>">
				<?= Loc::getMessage("CITRUS_AREALTY_MORTGAGE_YEARS") ?></div>
			<div class="slider-cont">
				<div class="years"></div>
			</div>
		</div>
	</form>
	<div class="result-block hypothec_result">
		<div class="block-title"><?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_RESULTS")?>:</div>
		<div class="result-row big-row">
			<?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_MONTHLY")?>:
			<span>
                <strong class="monthly-payment"></strong>
                <?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_CURRENCY")?></span>
		</div>
		<?
		if ($arParams['SHOW_OVERPAYMENT_BLOCK'])
		{
			?>
			<div class="result-row">
				<?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_FULL")?>:
				<span>
                <strong class="overpayment"></strong>
					<?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_CURRENCY")?></span>
			</div>
			<?
		}

		if ($arParams['RESULT_DECLAIMER'])
		{
			?>
			<div class="result-row result-row-notice">
				<?=$arParams['RESULT_DECLAIMER']?>
			</div>
			<?
		}

        ?>
        <div class="result-row">
            <?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_DISCOUNT")?><br> <span class="fw700"><?

            $site = $APPLICATION->GetSiteByDir();
            echo $site['NAME'];

            ?></span>
            <span class="goods-price fs30">
            <strong class="economy"></strong>
                <?=Loc::getMessage("CITRUS_AREALTY_MORTGAGE_CURRENCY")?></span>
        </div>
	</div>
</div>

<script type="text/javascript">
BX.message({'citrus.year.titles': '<?=CUtil::JSEscape(Loc::getMessage('CITRUS_AREALTY_MORTGAGE_YEAR_TITLES'))?>'});
$(function () {
	$('#<?=CUtil::JSEscape($component->getId())?>').citrusRealtyMortgage(<?=Json::encode($arResult)?>);
});
</script>
