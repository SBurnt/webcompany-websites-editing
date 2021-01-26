<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="tovarAside">
	<?if($arResult['BRAND']['NAME']):?>
	    <div class="made"><?=GetMessage("ASTDESIGN_CLIMATE_PROIZVODITELQ")?></div>
	    <?if($arResult['BRAND']['ID']):?>
    		<a href="<?=$arResult['BRAND']['DETAIL_PAGE_URL']?>">
    			<img class="made" src="<?=Refs::get_resize_src($arResult['BRAND']['DETAIL_PICTURE'], 160)?>" alt="<?=$arResult['BRAND']['NAME']?>">
    		</a>
	    <?else:?>
			<b><?=$arResult['BRAND']['NAME']?></b>
	    <?endif?>
    <?endif?>
    <?if(count($arResult['I'])):?>
    	<div class="service"><span></span></div>
    	<p><?=GetMessage("ASTDESIGN_CLIMATE_USTANOVKA")?></p>
    	<?foreach ($arResult['I'] as $i):?>
			<p>
				<b><a href="<?=$i['DETAIL_PAGE_URL']?>" title="<?=$i['NAME']?>"><?=$i['NAME']?></a></b><?
				if($i['PROPERTY_PRICE_VALUE']):
					?>:<br />
					<?=FormatCurrency($i['PROPERTY_PRICE_VALUE'], COption::GetOptionString('sale', 'default_currency'))?>
				<?else:
					?><br />
				<?endif?>
			</p>
    	<?endforeach?>
    <?endif?>
    <div class="courier"><span></span></div>
    <p><?=GetMessage("ASTDESIGN_CLIMATE_DOSTAVKA")?></p>
    <?foreach ($arResult['D'] as $d):?>
    <p>
    	<b><?=$d['NAME']?></b><?
    	if($arParams['SHOW_DELIVERY_PRICE'] == 'Y'):
    		?>, <?=$d["PRICE"]>0?FormatCurrency($d["PRICE"], $d['CURRENCY']):GetMessage("ASTDESIGN_CLIMATE_BESPLATNO")?><?
		endif;?>
    	<br>
    	<?if ($d["PERIOD_TO"]):?>
    		<?=GetMessage("ASTDESIGN_CLIMATE_SROKI_OT")?><?=$d["PERIOD_FROM"]?> <?=GetMessage("ASTDESIGN_CLIMATE_DO")?><?=$d["PERIOD_TO"]?>
    		<?switch($d["PERIOD_TYPE"]) {
				case 'D': echo GetMessage("ASTDESIGN_CLIMATE_DNEY"); break;
				case 'M': echo GetMessage("ASTDESIGN_CLIMATE_MESACEV"); break;
				case 'H': echo GetMessage("ASTDESIGN_CLIMATE_CASOV"); break;
    		}?>
    	<?endif?>
    </p>
    <?endforeach?>
</div>