<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

// pictures
$arImages = array();
if( is_array($arResult["DETAIL_PICTURE"]) ) {
	$arImages[] = $arResult['DETAIL_PICTURE'];
}
if(is_array($arResult["PROPERTIES"][$arParams['ARCORP_PROP_MORE_PHOTO']]['VALUE']) && count($arResult["PROPERTIES"][$arParams['ARCORP_PROP_MORE_PHOTO']]['VALUE'])>0) {
	foreach($arResult["PROPERTIES"][$arParams['ARCORP_PROP_MORE_PHOTO']]['VALUE'] as $arImage) {
		$arImages[] = $arImage;
	}
}

$tabDescription = ($arResult['DETAIL_TEXT']!='') ? true : false ;
$tabProperties = (is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES'])>0) ? true : false;
$tabDocs = false;


?>
<script src='<?=$templateFolder?>/jquery.elevatezoom.js'></script>
<div class="row">
	<?/*<div class="js-detail">
		<div class="col brcrtitle">
			<div class="brcr"></div>
		</div>
	</div>*/?>
<?
//echo "<pre>";print_r($arResult);echo "</pre>";
?>
	<div class="col col-md-3">
	<?$APPLICATION->IncludeComponent("bitrix:menu", "catlog_sidebar_menu", array(
	"ALLOW_MULTI_SELECT" => "N",
		"CATALOG_PATH" => "/catalog/",
		"CHILD_MENU_TYPE" => "topsub",
		"CONVERT_CURRENCY" => "N",
		"DELAY" => "N",
		"IBLOCK_ID" => "",
		"MAX_ITEM" => "9",
		"MAX_LEVEL" => "4",
		"MENU_CACHE_GET_VARS" => "",
		"MENU_CACHE_TIME" => "360000000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PRICE_CODE" => "",
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quan",
		"ROOT_MENU_TYPE" => "topsub",
		"USE_EXT" => "Y",
		"USE_PRODUCT_QUANTITY" => "N"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "Y"
	)
);?>
		<?if ($arResult['PROPERTIES']['LEFT_BLOCK']['VALUE']){
			$arSelect = Array("DETAIL_TEXT");
			$arFilter = Array("ID"=>$arResult['PROPERTIES']['LEFT_BLOCK']['VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
			$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
			while($ob = $res->GetNextElement())
			{
			 $arFields = $ob->GetFields();
			 //print_r($arFields["~DETAIL_TEXT"]);
			 if($arFields["~DETAIL_TEXT"]){?>
			 <div class="left-block-razdel">
				<?print_r($arFields["~DETAIL_TEXT"]);?>
			 </div>
			 <?}
			}
	}?>
	</div>
	<div class="col col-md-9">
<?
	?><div class="js-detail js-element js-elementid<?=$arResult['ID']?> col col-md-12" <?
		?>data-elementid="<?=$arResult['ID']?>" <?
		?>data-elementname="<?=CUtil::JSEscape($arResult['NAME'])?>" <?
		?>><?
		?><a class="js-detail_page_url" href="<?=$arResult['DETAIL_PAGE_URL']?>"></a><?

		?><div class="row"><?
			?><div class="col"><?

				?><div class="row">
				<div class="col col-md-12 brcrtitle"><?
					?><div class="brcr"></div><?
					?><div class="ttl"></div><?
				?></div>
				<?
					?><div class="col col-md-<?if($arParams['HEAD_TYPE']=='type3'):?>6<?else:?>6<?endif;?>"><?

						?><div class="row"><?
							// general picture
							?><div class="col col-md-12 pic"><?
								if(is_array($arImages) && count($arImages)>0) {
									?><a  class="fancyajax hidden-xs changeFromSlider fancybox.ajax" href="<?=$arResult["DETAIL_PAGE_URL"]?>" title="<?=$arResult["NAME"]?>">
									<?
								}
								if(is_array($arImages[0]) && isset($arImages[0]['SRC'])>0) {
									?><img 
                                         class="main_pic"
                                        <?
										?>src="<?=$arImages[0]['SRC']?>" <?
										?>alt="<?=($arImages[0]['ALT']!='' ? $arImages[0]['ALT'] : $arResult['NAME'])?>" <?
										?>title="<?=($arImages[0]['TITLE']!='' ? $arImages[0]['TITLE'] : $arResult['NAME'])?>" <?
									?>/><?
								}
								if(is_array($arImages) && count($arImages)>0) {
									?></a>
									<a class="hidden-lg hidden-md hidden-sm"  title="<?=$arResult["NAME"]?>">
									<?
								}
								if(is_array($arImages[0]) && isset($arImages[0]['SRC'])>0) {
									?><img <?
										?>
                                         class="main_pic"
                                        src="<?=$arImages[0]['SRC']?>" <?
										?>alt="<?=($arImages[0]['ALT']!='' ? $arImages[0]['ALT'] : $arResult['NAME'])?>" <?
										?>title="<?=($arImages[0]['TITLE']!='' ? $arImages[0]['TITLE'] : $arResult['NAME'])?>" <?
									?>/><?
								}
								if(is_array($arImages) && count($arImages)>0) {
									?></a>
									<?
								}
							?>
                            <script>
                                $(".pic img").elevateZoom({});
                                $('.pic img').on('load', function () {
                                 $(".pic img").elevateZoom({});
                                });
                            </script>
                            </div><?
							// slider
							if(is_array($arImages) && count($arImages)>0) {
								?><div class="col col-md-12"><?
									?><div class="thumbs" data-changeto=".changeFromSlider img"><?
										?><div class="owlslider"><?
											$index = 0;
											foreach($arImages as $arImage) {
												?><div class="pic<?=$index?><?if($index<1):?> checked<?endif;?> thumb"><?
													?><a href="<?=$arImage['SRC']?>" data-index="<?=$index?>" style="background-image: url('<?=$arImage['RESIZE']['src']?>');"><?
														?><div class="overlay"></div><?
														/*?><i class="fa"></i><?*/
													?></a><?
												?></div><?
												$index++;
											}
										?></div><?
									?></div><?
								?></div><?
							}
						?></div><?

					?></div><?
					?><div class="col col-md-<?if($arParams['HEAD_TYPE']=='type3'):?>6<?else:?>6<?endif;?>"><?
						?><div class="row"><?
							// breaadcrumb and title
							?><?
							// prices
							/*if( isset($arResult['RS_PRICE']) ) {
								?><div class="col col-md-12 prices"><?
									?><div><?
										?><?=GetMessage('AR.CORP.PRICE')?>: <?if( IntVal($arResult['RS_PRICE']['DISCOUNT_DIFF'])>0 ) {
											?><span class="price old"><?=$arResult['RS_PRICE']['PRINT_VALUE']?></span><?
											?><div><span class="price cool new"><?=$arResult['RS_PRICE']['PRINT_DISCOUNT_VALUE']?></span><?
												?><span class="discount"><?=GetMessage('AR.CORP.DISCOUNT')?>: <?=$arResult['RS_PRICE']['PRINT_DISCOUNT_DIFF']?></span></div><?
										} else {
											?><div class="price cool"><?=$arResult['RS_PRICE']['PRINT_DISCOUNT_VALUE']?></div><?
										}
									?></div><?

								?></div><?
							}*/
							// preview text
							if( $arResult['PREVIEW_TEXT']!='' ) {
								?><div class="col col-md-12 previewtext hidden-xs hidden-sm previewtext-height"><?
									?><?=$arResult['PREVIEW_TEXT']?><?
									/*if($tabDescription){
										?><br /><a class="moretext" href="#tabs"><?=GetMessage('AR.CORP.MORE')?></a><?
									}*/
								?></div>
								<div class="previewtext__btn-wrap col-md-12 hidden-xs hidden-sm">
									<svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
										<rect width="18" height="18" rx="9" fill="#F3F3F3"/>
										<path d="M6 8L9 11L12 8" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
									<button class="previewtext__btn" type="button">Раскрыть</button>
								</div>
								<?
							}
				?><div class="buyblock"><?
					?><div class="row"><?
						if( $arParams['RSMONOPOLY_PROP_QUANTITY']!='' ) {
							?><div class="col col-md-12 quantity" style="display:none"><?
								?><?=GetMessage('RS.MONOPOLY.QUANTITY')?>:<?
								if( IntVal($arResult['PROPERTIES'][$arParams['RSMONOPOLY_PROP_QUANTITY']]['VALUE'])<1 ) {
									?><span class="empty"> <?=GetMessage('RS.MONOPOLY.QUANTITY_EMPTY')?></span><?
								} else {
									?><span class="isset"> <?=GetMessage('RS.MONOPOLY.QUANTITY_ISSET')?></span><?
								}
							?></div><?
						}
						?>
                        <?/*if ($arResult['PROPERTIES']['PRICE']['VALUE']!=''):?>
                            <div class="col col-md-12 prices" >
                                <div>
                                    <?=GetMessage('RS.MONOPOLY.PRICE')?>: 
                                        <div class="price cool"><?=$arResult['PROPERTIES']['PRICE']['VALUE']?></div>
                                </div>
                            </div>
                        <?endif;*/?>
                        <div class="col col-md-12 buybtns" ><?
							$name = '['.$arResult['ID'].'] '.$arResult['NAME'];
							?><a class="fancyajax fancybox.ajax btn btn-primary" style="display:none" <?
								?>href="<?=SITE_DIR?>forms/buy/" <?
								?>data-insertdata='{"RS_EXT_FIELD_0":"<?=CUtil::JSEscape($name)?>"}' <?
								?>title="<?=GetMessage('RS.MONOPOLY.BUY_BTN_TITLE')?>" <?
								?>><?=GetMessage('RS.MONOPOLY.BUY_BTN')?></a><?
							?><a <?/*onclick="yaCounter23828170.reachGoal('clickAskgds'); return true;" */?>class="fancyajax fancybox.ajax btn btn-default" <?
								?>href="<?=SITE_DIR?>forms/ask_us/" <?
								?>data-insertdata='{"RS_EXT_FIELD_0":"<?=CUtil::JSEscape($name)?>"}' <?
								?>title="Оставить заявку" <?
								?>>Оставить заявку</a><?
						
						/*?><div class="ask-discount"><span class="menu-img"><img src="/bitrix/templates/monop/img/dscnt-engeson.png" ></span><span>Оставьте заявку и получите  персональную скидку</span></div><?*/
						?></div><?
						/*?><div class="col col-md-12 delivery" style="display:none"><?
							?><?$APPLICATION->IncludeFile(SITE_DIR."include_areas/catalog_delivery.php",array(),array("MODE"=>"html","HIDE_ICONS"=>"Y"));?><?
						?></div><?*/
						/*?><div class="col col-md-12 yashare"><?
							?><span><?=GetMessage("RS.MONOPOLY.YASHARE")?>:</span><?
							?><div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none" data-yashareQuickServices="facebook,twitter"></div><?
						?></div><?*/
					?></div><?
							?><div class="row part2"><?
			?><div class="col"><?
				?>
				<div class="new-param">
					<div class="card-info__select color-select card-info__color-select">
						<p class="color-select__selected">Цвет:</p>
						<ul class="color-select__list">
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#45EB56" style="background-color: #45EB56;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#2890F0" style="background-color:#2890F0;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn color-select__btn--active" data-color="#28F0E4" style="background-color: #28F0E4;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#28F090" style="background-color: #28F090;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#84F84D" style="background-color: #84F84D;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#C8F028" style="background-color: #C8F028;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#F08828" style="background-color: #F08828;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#F03428" style="background-color: #F03428;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#F02870" style="background-color: #F02870;"></button>
							</li>
							<li class="color-select__item">
								<button class="color-select__btn" data-color="#9828F0" style="background-color: #9828F0;"></button>
							</li>
						</ul>
					</div>
					<div class="card-info__select size-select card-info__size-select">
          	<p class="size-select__selected">Размер:</span></p>
						<ul class="size-select__list">
							<li class="size-select__item"><button class="size-select__btn size-select__btn--active">42</button></li>
							<li class="size-select__item"><button class="size-select__btn">44</button></li>
							<li class="size-select__item"><button class="size-select__btn">46</button></li>
							<li class="size-select__item"><button class="size-select__btn">48</button></li>
							<li class="size-select__item"><button class="size-select__btn">50</button></li>
							<li class="size-select__item"><button class="size-select__btn">52</button></li>
							<li class="size-select__item"><button class="size-select__btn">54</button></li>
							<li class="size-select__item"><button class="size-select__btn">56</button></li>
							<li class="size-select__item"><button class="size-select__btn">57</button></li>
							<li class="size-select__item"><button class="size-select__btn">58</button></li>
							<li class="size-select__item"><button class="size-select__btn">65</button></li>
							<li class="size-select__item"><button class="size-select__btn">66</button></li>
							<li class="size-select__item"><button class="size-select__btn">69</button></li>
						</ul>
						<a href="#modal-size-table" class="size-select__table modal-size-table">Таблица размеров</a>
        	</div>
					<div class="buttons__wrap">
						<div class="side-basket__product-stepper stepper js-stepper">
							<button class="stepper__btn stepper__btn--minus" type="button" data-step="down">
								<svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M0.913708 1.4712C0.744147 1.4712 0.609375 1.33318 0.609375 1.16467C0.609375 0.996153 0.744147 0.862213 0.913708 0.862213H8.90936C9.07892 0.862213 9.21807 0.996153 9.21807 1.16467C9.21807 1.33318 9.07892 1.47148 8.90936 1.47148H0.913708V1.4712Z" fill="#535353" />
								</svg>
							</button>
							<input type="text" class="stepper__input" value="1">
							<button class="stepper__btn stepper__btn--plus" type="button" data-step="up">
								<svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M9.59086 4.41317H5.62891V0.475667C5.62891 0.274308 5.46467 0.111084 5.26206 0.111084C5.05945 0.111084 4.89521 0.274308 4.89521 0.475667V4.41317H0.933254C0.730644 4.41317 0.566406 4.57639 0.566406 4.77775C0.566406 4.97911 0.730644 5.14233 0.933254 5.14233H4.89521V9.07983C4.89521 9.28119 5.05945 9.44442 5.26206 9.44442C5.46467 9.44442 5.62891 9.28119 5.62891 9.07983V5.14233H9.59086C9.79347 5.14233 9.95771 4.97911 9.95771 4.77775C9.95771 4.57639 9.79347 4.41317 9.59086 4.41317Z" fill="#535353" />
								</svg>
							</button>
						</div>
						<div class="side-basket__go-to-basket">
							<a href="http://gnl.cs90176.tmweb.ru/basket/" class="side-basket__go-to-basket-link">В корзину</a>
						</div>
					</div>
					<div class="side-basket__fast-order">
						<a href="#modal-fast-wrap" class="side-basket__fast-order-link modal-fast-wrap">Купить в 1 клик</a>
					</div>
				</div>
				
				<a name="tabs"></a><?
				?><div class="tabs"><?
					?><ul class="nav nav-tabs"><?
						if($tabProperties) {
							?><li><a class="properties" href="#properties" data-toggle="tab"><?=GetMessage('AR.CORP.PROPERTIES')?></a></li><?
						}
						if($tabDescription) {
							?><li><a class="detailtext" href="#description" data-toggle="tab"><?=GetMessage('AR.CORP.DESCRIPTION')?></a></li><?
						}
					?></ul><?
					?><div class="tab-content"><?
						if($tabProperties) {
							?><div class="tab-pane fade" id="properties"><?
								?><div class="row proptable"><?
									?><div class="col col-md-12"><?
										?><table><?
											?><tbody><?
												foreach($arResult['DISPLAY_PROPERTIES'] as $code => $arProp) {
													?><tr class="prop_<?=$code?>"><?
														?><td class="name"><?=$arProp['NAME']?></td><?
														?>
                                                        <?if ($code=='PRICE'):?>
                                                        <?  $value_price =  preg_replace('~\D+~','',$arProp['DISPLAY_VALUE']); 
                                                            $eur = COption::GetOptionString("grain.customsettings","rate_euro");
                                                            $usd = COption::GetOptionString("grain.customsettings","rate_usd");
                                                            $rub = COption::GetOptionString("grain.customsettings","rate_rub");
                                                            $textcurrency = round($value_price/$usd,2).' USD<br><br>'.round($value_price/$eur,2).' EUR<br><br>'.round($value_price/$rub*100,2).' RUB';
                                                         ?>
                                                            
                                                        <?endif;?>
                                                        
                                                        <td class="val"  >
                                                        <?if ($value_price>0 && $code=='PRICE'):?>
                                                        <div class="tooltipprice"><?=$arProp['DISPLAY_VALUE']?> 
                                                          <span class="tooltiptext"><?=$textcurrency?></span>
                                                        </div>
                                                        <style>
                                                        .buyblock a.fancyajax{
                                                            border: 1px solid #464450;
                                                            color: #464450;    
                                                        }
                                                         .buyblock a.fancyajax:hover{
                                                            color: #fff;
                                                            background-color: #464450;
                                                            border: 1px solid #464450;
                                                            border-bottom-color: transparent;
                                                            cursor: default;
                                                         }
                                                        .js-detail .buyblock{
                                                                border:none;
                                                        }
                                                            .tooltipprice {
                                                                position: relative;
                                                                display: inline-block;
                                                                cursor: pointer;
                                                                border-bottom: 1px dotted black; /* If you want dots under the hoverable text */
                                                            }
                                                            
                                                            /* Tooltip text */
                                                            .tooltipprice .tooltiptext {
                                                                visibility: hidden;
                                                                width: 120px;
                                                                background-color: #555;
                                                                color: #fff;
                                                                text-align: center;
                                                                padding: 5px 0;
                                                                border-radius: 6px;
                                                            
                                                                /* Position the tooltip text */
                                                                position: absolute;
                                                                z-index: 1;
                                                                bottom: 125%;
                                                                left: 50%;
                                                                margin-left: -60px;
                                                            
                                                                /* Fade in tooltip */
                                                                opacity: 0;
                                                                transition: opacity 1s;
                                                            }
                                                            
                                                            /* Tooltip arrow */
                                                            .tooltipprice .tooltiptext::after {
                                                                content: "";
                                                                position: absolute;
                                                                top: 100%;
                                                                left: 50%;
                                                                margin-left: -5px;
                                                                border-width: 5px;
                                                                border-style: solid;
                                                                border-color: #555 transparent transparent transparent;
                                                            }
                                                            
                                                            /* Show the tooltip text when you mouse over the tooltip container */
                                                            .tooltipprice:hover .tooltiptext {
                                                                visibility: visible;
                                                                opacity: 1;
                                                            }
                                                        </style>
                                                        
                                                        <?else:?>
                                                       <?=$arProp['DISPLAY_VALUE']?> 
                                                        <?endif;?>
                                                        </td><?
													?></tr><?
												}
											?></tbody><?
										?></table><?
									?></div><?
								?></div><?
							?></div><?
						}
						if($tabDescription) {
							?><div class="tab-pane fade" id="description"><?=$arResult['DETAIL_TEXT']?></div><?
						}
					?></div><?
				?></div><?
			?></div><?
		?></div><?
				?></div><?                            
                            
							// compare
							?><?
							// properties
							/*if( is_array($arResult['DISPLAY_PROPERTIES']) && count($arResult['DISPLAY_PROPERTIES'])>0 ) {
								?><div class="col col-md-12 proptable hidden-xs hidden-sm"><?
									?><table><?
										?><tbody><?
											$cnt = 0;
											foreach($arResult['DISPLAY_PROPERTIES'] as $code => $arProp) {
												$cnt++;
												?><tr class="prop_<?=$code?>"><?
													?><td class="name"><span><?=$arProp['NAME']?></span></td><?
													?><td class="val"><span><?=$arProp['DISPLAY_VALUE']?></span></td><?
												?></tr><?
												if($cnt>4) { break; }
											}
										?></tbody><?
									?></table><?
									?><br /><a class="moreprops" href="#tabs"><?=GetMessage('AR.CORP.MORE_PROPS')?></a><?
								?></div><?
							}*/
						?></div><?
					?></div><?
				?></div><?

			?></div><?
			?><?
		?></div><?


	?></div><?
?>
<div class="print-version">
			<?/*<a href="<?=$APPLICATION->GetCurPageParam("print=y", array("print"));?>" target="_blank">Версия для печати</a>*/?>
		</div>	
<div class="col-md-12 text-center to-top">
		<a><img src="/bitrix/templates/cor/img/up.png" alt="Вверх"></a>
	</div>
</div></div><?
?><script>
if($('.js-brcrtitle').length>0 && $('.js-detail').find('.brcrtitle').length>0) {
	$('.js-detail').find('.brcrtitle').find('.brcr').html( $('.js-brcrtitle').html() );
	$('.js-detail').find('.brcrtitle').find('.ttl').html( $('.js-ttl').html() );
	$('html').addClass('detailprodpage');
}
</script>
<style>
.popupgallery .thumbs {overflow-y: auto!important;}
.zoomContainer2, .zoomLens {z-index:10000!important}
</style>


<?
if($arResult['PROPERTIES']["H1_VALUE"]['VALUE']!=''){
    
    		$APPLICATION->SetTitle($arResult['PROPERTIES']["H1_VALUE"]['VALUE']);
}
?>