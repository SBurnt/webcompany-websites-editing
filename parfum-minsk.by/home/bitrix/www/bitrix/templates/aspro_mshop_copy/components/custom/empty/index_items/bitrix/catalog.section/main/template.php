<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
global $USER;
$notifyOption = COption::GetOptionString("sale", "subscribe_prod", "");
$arNotify = unserialize($notifyOption);?>

	<?$i=0; foreach($arResult["ITEMS"] as $arElement):
		$i++;?>
		<div class="item">
		
                	<!--<div class="check-div">
					<input type="checkbox" data-id="<?=$arElement["ID"]?>" class="niceCheck compare compare<?=$arElement["ID"]?>" id="checkbox<?=$arElement["ID"]?>" /> 
					<label for="checkbox<?=$arElement["ID"]?>">Сравнить</label>
					</div>-->
                  	<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" ><img src="<?=Refs::get_resize_src($arElement["DETAIL_PICTURE"], 220)?>" alt="<?=$arElement['NAME']?>" title="<?=$arElement['NAME']?>"/></a>
                  	<div class="info">
                    	<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="title"><?=$arElement['NAME']?>:</a>
                    	<div class="price"><?=($arElement['2PRICES']['main']['USE_FROM']?GetMessage('ASTDESIGN_CLIMATE_OFFER_FROM'):'')?>
						<?=FormatCurrency($arElement['2PRICES']['main']['DISCOUNT_VALUE'], $arElement['2PRICES']['main']['CURRENCY'])?></div>
                	</div>
					<?if($arElement['PROPERTIES']['HOT_ZN']['VALUE']=="Y"):?>
					<div class="hot"></div>
					<?endif;?>
					<?if($arElement['PROPERTIES']['NEW_ZN']['VALUE']=="Y"):?>
					<div class="new"></div>
					<?endif;?>
					<?if($arElement['PROPERTIES']['SALE_ZN']['VALUE']=="Y"):?>
					<div class="sale"></div>
					<?endif;?>
                    <a href="#" data-class="actionBlock" data-id="<?=$arElement["ID"]?>" class="buy add2basket add2basket<?=$arElement["ID"]?>"  >Заказать</a>
	       </div>
		

	<?endforeach?>

