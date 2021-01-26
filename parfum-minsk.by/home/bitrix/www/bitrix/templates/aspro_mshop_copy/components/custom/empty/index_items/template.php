
<?if(SITE_ID=='s1'){?>
	<?foreach(array(1=>'PROPERTY_IS_SPECIAL', 'PROPERTY_IS_NEW', 'PROPERTY_IS_POP') as $k=>$f) {
		$GLOBALS['innerFilter'] = array('!'.$f => false);
		?>
		
		<div class="box module">
		<?if($f=="PROPERTY_IS_SPECIAL"):?>
		 <?
		 $APPLICATION->IncludeFile(
		  SITE_DIR."include/block_1.php",
		  Array(),
		  Array("MODE"=>"html")
		 );
		 ?>
		
		<?endif;?>
		<?if($f=="PROPERTY_IS_NEW"):?>
		<?
		 $APPLICATION->IncludeFile(
		  SITE_DIR."include/block_2.php",
		  Array(),
		  Array("MODE"=>"html")
		 );
		 ?>
		
		<?endif;?>
		<?if($f=="PROPERTY_IS_POP"):?>
		<?
		 $APPLICATION->IncludeFile(
		  SITE_DIR."include/block_3.php",
		  Array(),
		  Array("MODE"=>"html")
		 );
		 ?>
		
		<?endif;?>
			<div class="owl-carousel el-4">
		<?
			$APPLICATION->IncludeComponent("bitrix:catalog.section", "main", Array(
				"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"SECTION_ID" => 0,
				"SECTION_CODE" => "",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"ELEMENT_SORT_FIELD" => "RAND",
				"ELEMENT_SORT_ORDER" => "ASC",
				"FILTER_NAME" => "innerFilter",
				"INCLUDE_SUBSECTIONS" => "Y",
				"SHOW_ALL_WO_SECTION" => "Y",
				"PAGE_ELEMENT_COUNT" => $arParams['COUNT'],
				"LINE_ELEMENT_COUNT" => "6",
				"PROPERTY_CODE" => array(
					0 => "IS_NEW",
				),
		        "OFFERS_LIMIT" => "0",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				"BASKET_URL" => SITE_DIR."personal/basket.php",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"OFFERS_FIELD_CODE" => array('ID'),
				"OFFERS_PROPERTY_CODE" => array('CML2_LINK'),
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "Y",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"ADD_SECTIONS_CHAIN" => "N",
				"DISPLAY_COMPARE" => "N",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"CACHE_FILTER" => "Y",
				"PRICE_CODE" => $arParams['PRICES'],
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_PROPERTIES" => array(
					0 => "IS_NEW",
					1 => "BRAND",
					2 => "IS_POP",
					3 => "IS_SPECIAL",
				),
				"USE_PRODUCT_QUANTITY" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => GetMessage("ASTDESIGN_CLIMATE_NOVINKI1"),
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_ADDITIONAL" => "5",
				"WITHOUT_BUY" => $arParams['WITHOUT_BUY'],
				"MAIN_PRICES" => $arParams['MAIN_PRICES'],
				"OTHER_PRICES" => $arParams['OTHER_PRICES'],
				),
				$component
			);
		?>
			 </div>
	</div>
		
	<?}?>
<?}?>


<?if(SITE_ID=='s2'){?>
	<?foreach(array(1=>'PROPERTY_IS_SPECIAL', 'PROPERTY_IS_NEW', 'PROPERTY_IS_POP') as $k=>$f) {
		$GLOBALS['innerFilter'] = array('!'.$f => false);
		
		?>
		
		<div class="box module">
		<?if($f=="PROPERTY_IS_SPECIAL" AND $k==1):?>
		 <?
		 $APPLICATION->IncludeFile(
		  SITE_DIR."include/block_1.php",
		  Array(),
		  Array("MODE"=>"html")
		 );
		 ?>
		
		<?endif;?>
		<?/*if($f=="PROPERTY_IS_NEW"):?>
		<?
		 $APPLICATION->IncludeFile(
		  SITE_DIR."include/block_2.php",
		  Array(),
		  Array("MODE"=>"html")
		 );
		 ?>
		
		<?endif;?>
		<?if($f=="PROPERTY_IS_POP"):?>
		<?
		 $APPLICATION->IncludeFile(
		  SITE_DIR."include/block_3.php",
		  Array(),
		  Array("MODE"=>"html")
		 );
		 ?>
		
		<?endif;*/?>
			<div class="owl-carousel el-4">
		<?  if($k==1){
			$APPLICATION->IncludeComponent("bitrix:catalog.section", "main", Array(
				"IBLOCK_TYPE" => $arParams['IBLOCK_TYPE'],
				"IBLOCK_ID" => $arParams['IBLOCK_ID'],
				"SECTION_ID" => 0,
				"SECTION_CODE" => "",
				"SECTION_USER_FIELDS" => array(
					0 => "",
					1 => "",
				),
				"ELEMENT_SORT_FIELD" => "RAND",
				"ELEMENT_SORT_ORDER" => "ASC",
				"FILTER_NAME" => "innerFilter",
				"INCLUDE_SUBSECTIONS" => "Y",
				"SHOW_ALL_WO_SECTION" => "Y",
				"PAGE_ELEMENT_COUNT" => $arParams['COUNT'],
				"LINE_ELEMENT_COUNT" => "6",
				"PROPERTY_CODE" => array(
					0 => "IS_NEW",
				),
		        "OFFERS_LIMIT" => "0",
				"SECTION_URL" => "",
				"DETAIL_URL" => "",
				"BASKET_URL" => SITE_DIR."personal/basket.php",
				"ACTION_VARIABLE" => "action",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"SECTION_ID_VARIABLE" => "SECTION_ID",
				"AJAX_MODE" => "N",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"OFFERS_FIELD_CODE" => array('ID'),
				"OFFERS_PROPERTY_CODE" => array('CML2_LINK'),
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "Y",
				"META_KEYWORDS" => "-",
				"META_DESCRIPTION" => "-",
				"BROWSER_TITLE" => "-",
				"ADD_SECTIONS_CHAIN" => "N",
				"DISPLAY_COMPARE" => "N",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"CACHE_FILTER" => "Y",
				"PRICE_CODE" => $arParams['PRICES'],
				"USE_PRICE_COUNT" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_PROPERTIES" => array(
					0 => "IS_NEW",
					1 => "BRAND",
					2 => "IS_POP",
					3 => "IS_SPECIAL",
				),
				"USE_PRODUCT_QUANTITY" => "Y",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "N",
				"PAGER_TITLE" => GetMessage("ASTDESIGN_CLIMATE_NOVINKI1"),
				"PAGER_SHOW_ALWAYS" => "N",
				"PAGER_TEMPLATE" => "",
				"PAGER_DESC_NUMBERING" => "N",
				"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
				"PAGER_SHOW_ALL" => "N",
				"AJAX_OPTION_ADDITIONAL" => "5",
				"WITHOUT_BUY" => $arParams['WITHOUT_BUY'],
				"MAIN_PRICES" => $arParams['MAIN_PRICES'],
				"OTHER_PRICES" => $arParams['OTHER_PRICES'],
				),
				$component
			);
		}
		?>
			 </div>
	</div>
		
	<?}?>
<?}?> 
	