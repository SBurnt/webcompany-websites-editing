<?
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

use Bitrix\Main\Web\Json;
use Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$id = $component->getId();
?>

<div id="mortgage-<?=$id?>"></div>
<p class="indent"></p>

<script>
	;(function(){
		new Vue({
			el: '#mortgage-<?=$id?>',
			data: <?=Json::encode(array(
					'fields' => array(
						array (
							'min' => $arResult['minFullPrice'],
							'max'  => (int) $arResult['maxFullPrice'],
							'value' => (int) $arResult['defaultFullPrice'],
							'name' => Loc::getMessage("MORTGAGE_FULL_PRICE"),
							'decimal' => 0,
							'code' => 'fullPrice',
							'sign' => 'currency',
						),
						array (
							'min' => (int) $arResult['minFirstPrice'],
							'max'  => (int) ($arResult['defaultFullPrice'] / 100 * $arResult['maxFirstPercent']),
							'value' => (int) $arResult['defaultFirstPrice'],
							'name' => Loc::getMessage("MORTGAGE_FIRSTPRICE"),
							'decimal' => 0,
							'code' => 'firstPrice',
							'sign' => 'currency',
						),
						array (
							'min' => (int) 0,
							'max'  => (int) $arResult['maxFirstPercent'],
							'value' => (int) $arResult['defaultFirstPrice'] / $arResult['defaultFullPrice'] * 100,
							'name' => '',
							'decimal' => 1,
							'code' => 'firstPercent',
							'sign' => '%',
						),
						array (
							'min' => (int) $arResult['minPercent'],
							'max'  => (int) $arResult['maxPercent'],
							'value' => (int) $arResult['defaultPercent'],
							'name' => Loc::getMessage("MORTGAGE_PERCENT"),
							'decimal' => 1,
							'code' => 'percent',
							'sign' => '%',
						),
						array (
							'min' => (int) $arResult['minYear'],
							'max'  => (int) $arResult['maxYear'],
							'value' => (int) $arResult['defaultYear'],
							'name' => Loc::getMessage("MORTGAGE_YEAR"),
							'decimal' => 0,
							'code' => 'year',
							'sign' => '',
						),
					),
					'lang' => array(
						'resultTitle' => Loc::getMessage("MORTGAGE_RESULT_TITLE"),
						'resultMonth' => Loc::getMessage("MORTGAGE_RESULT_MONTH"),
						'resultOverpay' => Loc::getMessage("MORTGAGE_RESULT_OVERPAY"),
						'resultProfit' => Loc::getMessage("MORTGAGE_RESULT_PROFIT"),
						'yearSign' => [
							Loc::getMessage("MORTGAGE_YEAR_SIGN_1"),
							Loc::getMessage("MORTGAGE_YEAR_SIGN_2"),
							Loc::getMessage("MORTGAGE_YEAR_SIGN_3")],
						'from' => Loc::getMessage("MORTGAGE_FROM"),
						'to' => Loc::getMessage("MORTGAGE_TO")
					),
					'settings' => array(
						'discountPercent' => $arResult['discountPercent'],
						'currency' => $arParams['CURRENCY'],
						'showOverpaymentBlock' => $arParams['SHOW_OVERPAYMENT_BLOCK']
					)
				));?>,
			template: '<mortgage :fields="fields" :lang="lang" :settings="settings" />',
		});
	}());
</script>