<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/** @var \Citrus\Arealty\PropertesComponent $component Tekushtiy vizvanniy komponent */
/** @var CBitrixComponentTemplate $this Tekushtiy shablon (obaekt, opisivayushtiy shablon) */
/** @var array $arResult Massiv rezulytatov raboti komponenta */
/** @var array $arParams Massiv vhodyashtih parametrov komponenta, mozhet ispolyzovatysya dlya ucheta zadannih parametrov pri vivode shablona (naprimer, otobrazhenii detalynih izobrazheniy ili ssilok). */
/** @var string $templateFile Puty k shablonu otnositelyno kornya sayta, naprimer /bitrix/components/bitrix/iblock.list/templates/.default/template.php) */
/** @var string $templateName Imya shablona komponenta (naprimer: .default) */
/** @var string $templateFolder Puty k papke s shablonom ot DOCUMENT_ROOT (naprimer /bitrix/components/bitrix/iblock.list/templates/.default) */
/** @var array $templateData Massiv dlya zapisi, obratite vnimanie, takim obrazom mozhno peredaty dannie iz template.php v fayl component_epilog.php, prichem eti dannie popadayut v kesh, t.k. fayl component_epilog.php ispolnyaetsya na kazhdom hite */
/** @var string $parentTemplateFolder Papka roditelyskogo shablona. Dlya podklyucheniya dopolnitelynih izobrazheniy ili skriptov (resursov) udobno ispolyzovaty etu peremennuyu. Ee nuzhno vstavlyaty dlya formirovaniya polnogo puti otnositelyno papki shablona */
/** @var string $componentPath Puty k papke s komponentom ot DOCUMENT_ROOT (napr. /bitrix/components/bitrix/iblock.list) */

$this->setFrameMode(true);

$properties = $component->getProperties();

?>
<div class="properties <?=$component->getCssClass()?>">
	<?foreach ( $component->getDisplayProperties() as $propertyCode):

		$value = $properties->getValue($propertyCode);
		if (empty($value))
		{
			continue;
		}

		?>
        <div class="property__it<?=($arParams['SHOW_HEADINGS'] == 'Y' ? 'property__it--with-title' : '')?>" data-property-code="<?=$propertyCode?>">
	        <?php
	        if ($arParams['SHOW_HEADINGS'] == 'Y')
	        {
	        	?>
		        <div class="property__title <?=$arParams['HEADINGS_CLASS']?>">
			        <?=$properties->getName($propertyCode)?>
		        </div>
		        <?php
	        }
	        ?>
			<?if($icon = $component->getProperties()->getPropertyIcon($propertyCode)):?>
		        <div class="property__icon">
                    <span class="<?=$icon?>"></span>
	            </div>
			<?endif;?>

            <div class="property__value-list">
				<?
				$desc = $component->getProperties()->getDescription($propertyCode);
				$values = (is_array($value) && $value[0]) ? $value : [$value]
				?>
				<? foreach ($values as $key => $value): ?>
                    <div class="property__value-it">
                        <div class="property__value-it__value"><?=$component->getProperties()->formatValue($propertyCode, $value)?></div>
						<?if($description = $component->getProperties()->getDescription($propertyCode, $key)):?>
                            <div class="property__value-it__description"> - <?=$description;?></div>
						<?endif;?>
                    </div>
				<?
				endforeach;?>
            </div>
        </div>
	<?endforeach;?>
</div><!-- .properties -->