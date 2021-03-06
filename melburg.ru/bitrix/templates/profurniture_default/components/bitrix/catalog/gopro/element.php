<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader,
	Bitrix\Main\Application,
	Bitrix\Main\ModuleManager;

if (!\Bitrix\Main\Loader::includeModule('redsign.devfunc'))
	return;

$this->setFrameMode(true);

$getTemplatePathPartParams = array('SHOW_HELP' => $arParams['CACHE_GROUPS'] == 'Y' ? 'Y' : 'N');

if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__ . '/element.start.php', $getTemplatePathPartParams))) {
	include($path);
}

$actionVariableName = 'rs_action';
$productIdVariableName = 'rs_id';

$componentElementParams = array(
	'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
	'IBLOCK_ID' => $arParams['IBLOCK_ID'],
	'PROPERTY_CODE' => $arParams['DETAIL_PROPERTY_CODE'],
	'META_KEYWORDS' => $arParams['DETAIL_META_KEYWORDS'],
	'META_DESCRIPTION' => $arParams['DETAIL_META_DESCRIPTION'],
	'BROWSER_TITLE' => $arParams['DETAIL_BROWSER_TITLE'],
	'BASKET_URL' => $arParams['BASKET_URL'],
	'SET_CANONICAL_URL' => $arParams['DETAIL_SET_CANONICAL_URL'],
	'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
	'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
	'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
	'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
	'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
	'CACHE_TYPE' => $arParams['CACHE_TYPE'],
	'CACHE_TIME' => $arParams['CACHE_TIME'],
	'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
	'SET_TITLE' => $arParams['SET_TITLE'],
	'SET_LAST_MODIFIED' => $arParams['SET_LAST_MODIFIED'],
	'PRICE_CODE' => $arParams['PRICE_CODE'],
	'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
	'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
	'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
	'PRICE_VAT_SHOW_VALUE' => $arParams['PRICE_VAT_SHOW_VALUE'],
	'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
	'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
	'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
	'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
	'LINK_IBLOCK_TYPE' => $arParams['LINK_IBLOCK_TYPE'],
	'LINK_IBLOCK_ID' => $arParams['LINK_IBLOCK_ID'],
	'LINK_PROPERTY_SID' => $arParams['LINK_PROPERTY_SID'],
	'LINK_ELEMENTS_URL' => $arParams['LINK_ELEMENTS_URL'],

	'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
	'OFFERS_FIELD_CODE' => $arParams['DETAIL_OFFERS_FIELD_CODE'],
	'OFFERS_PROPERTY_CODE' => $arParams['DETAIL_OFFERS_PROPERTY_CODE'],
	'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
	'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
	'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
	'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],

	'LIST_OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
	'LIST_OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
	'LIST_OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],

	'ELEMENT_ID' => $arResult['VARIABLES']['ELEMENT_ID'],
	'ELEMENT_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
	'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
	'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
	'SECTION_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['section'],
	'DETAIL_URL' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['element'],
	'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
	'CURRENCY_ID' => $arParams['CURRENCY_ID'],
	'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
	'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
	'USE_ELEMENT_COUNTER' => $arParams['USE_ELEMENT_COUNTER'],
	'USE_COMPARE' => $arParams['USE_COMPARE'],
	// goPro params
	'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
	'HIGHLOAD' => $arParams['HIGHLOAD'],
	'PROP_ARTICLE' => $arParams['PROP_ARTICLE'],
	'PROP_PRICES_NOTE' => $arParams['PROP_PRICES_NOTE'],
	'OFF_BUY1CLICK' => $arParams['OFF_BUY1CLICK'],
	'IMPORTANT_PROPS' => $arParams['IMPORTANT_PROPS'],
	'IMPORTANT_PROPS_LINK_TO_TAB' => $arParams['IMPORTANT_PROPS_LINK_TO_TAB'],
	'USE_FAVORITE' => $arParams['USE_FAVORITE'],
	'USE_SHARE' => $arParams['USE_SHARE'],
	'SOC_SHARE_ICON' => $arParams['SOC_SHARE_ICON'],
	'OFF_MEASURE_RATION' => $arParams['OFF_MEASURE_RATION'],
	'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
	'PROP_SKU_ARTICLE' => $arParams['PROP_SKU_ARTICLE'],
	'PROPS_ATTRIBUTES' => $arParams['PROPS_ATTRIBUTES'],
	'PROPS_ATTRIBUTES_COLOR' => $arParams['PROPS_ATTRIBUTES_COLOR'],
	'STICKERS_PROPS' => $arParams['STICKERS_PROPS'],
	'STICKERS_DISCOUNT_VALUE' => $arParams['STICKERS_DISCOUNT_VALUE'],
	'LIST_SKU_VIEW' => $arParams['LIST_SKU_VIEW'],
	// rating
	'USE_RATING' => $arParams['USE_RATING'],
	'RATING_PROP_COUNT' => $arParams['RATING_PROP_COUNT'],
	'RATING_PROP_SUM' => $arParams['RATING_PROP_SUM'],
	// delivery cost
	'USE_DELIVERY_COST_BLOCK' => $arParams['USE_DELIVERY_COST_BLOCK'],
	'USE_DELIVERY_COST_TAB' => $arParams['USE_DELIVERY_COST_TAB'],
	'DELIVERY_CURRENCY_ID' => ($arParams['CONVERT_CURRENCY'] == 'Y' ? $arParams['CURRENCY_ID'] : ''),
	'DELIVERY_COST_PAY_LINK' => $arParams['DELIVERY_COST_PAY_LINK'],
	'DELIVERY_COST_DELIVERY_LINK' => $arParams['DELIVERY_COST_DELIVERY_LINK'],
	// brands
	'PROP_BRAND' => $arParams['PROP_BRAND'],
	'BRAND_DETAIL_SHOW_LOGO' => $arParams['BRAND_DETAIL_SHOW_LOGO'],
	'BRAND_DETAIL_IMG_SIZE_W' => $arParams['BRAND_DETAIL_IMG_SIZE_W'],
	'BRAND_DETAIL_IMG_SIZE_H' => $arParams['BRAND_DETAIL_IMG_SIZE_H'],
	'BRAND_IBLOCK_BRANDS' => $arParams['BRAND_IBLOCK_BRANDS'],
	'BRAND_IBLOCK_BRANDS_PROP_BRAND' => $arParams['BRAND_IBLOCK_BRANDS_PROP_BRAND'],
	'BRAND_DETAIL_ADD_DETAIL_PAGE_URL' => $arParams['BRAND_DETAIL_ADD_DETAIL_PAGE_URL'],
	// store
	'STORES_TEMPLATE' => $arParams['STORES_TEMPLATE'],
	'USE_STORE' => $arParams['USE_STORE'],
	"STORE_PATH" => $arParams['STORE_PATH'],
	'MAIN_TITLE' => $arParams['MAIN_TITLE'],
	'USE_MIN_AMOUNT' => $arParams['USE_MIN_AMOUNT'],
	'MIN_AMOUNT' => $arParams['MIN_AMOUNT'],
	"STORES" => $arParams['STORES'],
	"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
	"SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
	"USER_FIELDS" => $arParams['USER_FIELDS'],
	"FIELDS" => $arParams['FIELDS'],
	"PROP_STORE_REPLACE_SECTION" => $arParams['PROP_STORE_REPLACE_SECTION'],
	"PROP_STORE_REPLACE_DETAIL" => $arParams['PROP_STORE_REPLACE_DETAIL'],
	"STORE_REPLACE_IF_NOT_AVAILABLE" => $arParams['STORE_REPLACE_IF_NOT_AVAILABLE'],
	// ajaxpages
	"HIDE_AJAXPAGES_LINK" => $arParams['HIDE_AJAXPAGES_LINK'],
	// element
	'DETAIL_SKU_VIEW' => $arParams['DETAIL_SKU_VIEW'],
	'PROPS_TABS' => $arParams['PROPS_TABS'],
	'USE_CHEAPER' => $arParams['USE_CHEAPER'],
	'SHOW_PREVIEW_TEXT' => $arParams['SHOW_PREVIEW_TEXT'],
	// seo
	"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : ''),
	"ADD_ELEMENT_CHAIN" => (isset($arParams["ADD_ELEMENT_CHAIN"]) ? $arParams["ADD_ELEMENT_CHAIN"] : ''),
	// reviews
	'USE_REVIEW' => $arParams['USE_REVIEW'],
	'DETAIL_REVIEW_SHOW_COUNT' => $arParams['DETAIL_REVIEW_SHOW_COUNT'],
	// multiregionality
	'SITE_LOCATION_ID' => SITE_LOCATION_ID,
	// error 404
	"SET_STATUS_404" => $arParams["SET_STATUS_404"],
	"SHOW_404" => $arParams["SHOW_404"],
	"MESSAGE_404" => $arParams["MESSAGE_404"],
	"FILE_404" => $arParams["FILE_404"],
	//ya.metrika targets
	"YM_USE_TARGETS" => $arParams["YM_USE_TARGETS"],
	"YM_COUNTER_NUMBER" => $arResult["YM_COUNTER_NUMBER"],
	"YM_TARGET_NAME_ADD2BASKET" => $arParams["YM_TARGET_NAME_ADD2BASKET"],
	"YM_TARGET_NAME_ADD2COMPARE" => $arParams["YM_TARGET_NAME_ADD2COMPARE"],
	"YM_TARGET_NAME_ADD2COMPARE_IN" => $arParams["YM_TARGET_NAME_ADD2COMPARE_IN"],
	"YM_TARGET_NAME_ADD2FAVORITE" => $arParams["YM_TARGET_NAME_ADD2FAVORITE"],
	"YM_TARGET_NAME_ADD2FAVORITE_IN" => $arParams["YM_TARGET_NAME_ADD2FAVORITE_IN"],
	"YM_TARGET_PARAMETERS" => $arParams["YM_TARGET_PARAMETERS"],

	// size table
	'SHOW_SIZE_TABLE' => $arParams['DETAIL_SHOW_SIZE_TABLE'],
	'PROPS_ATTRIBUTES_SIZE' => $arParams['PROPS_ATTRIBUTES_SIZE'],
	'SIZE_TABLE_USER_FIELDS' => $arParams['SIZE_TABLE_USER_FIELDS'],
	'SIZE_TABLE_PROP' => $arParams['SIZE_TABLE_PROP'],
);

if (isset($arParams['USER_CONSENT'])) {
	$componentElementParams['USER_CONSENT'] = $arParams['USER_CONSENT'];
}

if (isset($arParams['USER_CONSENT_ID'])) {
	$componentElementParams['USER_CONSENT_ID'] = $arParams['USER_CONSENT_ID'];
}

if (isset($arParams['USER_CONSENT_IS_CHECKED'])) {
	$componentElementParams['USER_CONSENT_IS_CHECKED'] = $arParams['USER_CONSENT_IS_CHECKED'];
}

if (isset($arParams['USER_CONSENT_IS_LOADED'])) {
	$componentElementParams['USER_CONSENT_IS_LOADED'] = $arParams['USER_CONSENT_IS_LOADED'];
}

if (is_array($arParams['PRICE_CODE']) && count($arParams['PRICE_CODE']) > 1) {
	$componentElementParams['FILL_ITEM_ALL_PRICES'] = 'Y';
}

?>

<?php if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) || $_REQUEST['debug'] == 'yes') : ?>
	<?php
	$ELEMENT_ID = IntVal($_REQUEST[$productIdVariableName]);
	?>

	<?php if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST[$actionVariableName] == 'rsgppopup' && $ELEMENT_ID > 0) : ?>
		<?php
		// +++++++++++++++++++++++++++++++ get element popup +++++++++++++++++++++++++++++++ //
		global $APPLICATION;
		$APPLICATION->RestartBuffer();
		if ($ELEMENT_ID < 1) {
			$arJson = array('TYPE' => 'ERROR', 'MESSAGE' => 'Element id is empty');
			echo json_encode($arJson);
			die();
		}
		?>
		<?$ElementID = $APPLICATION->IncludeComponent(
			'bitrix:catalog.element',
			'popup',
			$componentElementParams,
			$component,
			array('HIDE_ICONS' => 'Y')
		);?>
		<?php
		die();
		?>
	<?php elseif ($arParams['USE_COMPARE'] == 'Y' && $_REQUEST['AJAX_CALL'] == 'Y' && ($_REQUEST[$actionVariableName] == 'ADD_TO_COMPARE_LIST' || $_REQUEST[$actionVariableName] == 'DELETE_FROM_COMPARE_LIST')) : ?>
		<?php
		// +++++++++++++++++++++++++++++++ add2compare +++++++++++++++++++++++++++++++ //
		global $APPLICATION, $JSON;
		?>
		<?$APPLICATION->IncludeComponent(
			'bitrix:catalog.compare.list',
			'json',
			Array(
				'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
				'IBLOCK_ID' => $arParams['IBLOCK_ID'],
				'NAME' => $arParams['COMPARE_NAME'],
				'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
				'COMPARE_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
				'IS_AJAX_REQUEST' => 'Y',
				'ACTION_VARIABLE' => $actionVariableName,
				'PRODUCT_ID_VARIABLE' => $productIdVariableName,
			),
			$component,
			array('HIDE_ICONS' => 'Y')
		);?>

		<?php
		$APPLICATION->RestartBuffer();
		if (SITE_CHARSET != 'utf-8') {
			$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
			$json_str_utf = json_encode($data);
			$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
			echo $json_str;
		} else {
			echo json_encode($JSON);
		}

		die();
		?>
	<?php elseif ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST[$actionVariableName] == 'add2favorite' && $ELEMENT_ID > 0) : ?>
		<?php if (\Bitrix\Main\Loader::includeModule('redsign.favorite')) : ?>
			<?php
			// +++++++++++++++++++++++++++++++ add2favorite +++++++++++++++++++++++++++++++ //
			global $APPLICATION, $JSON;
			?>
			<?$APPLICATION->IncludeComponent(
				'redsign:favorite.list',
				'json',
				array(
					'ACTION_VARIABLE' => $actionVariableName,
					'PRODUCT_ID_VARIABLE' => $productIdVariableName,
				),
				$component,
				array('HIDE_ICONS' => 'Y')
			);?>
			<?php
			$APPLICATION->RestartBuffer();
			$arJson = array('TYPE' => 'OK', 'MESSAGE' => 'Element add/removed from favorite', 'HTMLBYID' => $JSON['HTMLBYID']);
			?>
		<?php else : ?>
			<?php
			$APPLICATION->RestartBuffer();
			$arJson = array('TYPE' => 'ERROR', 'MESSAGE' => 'Module favorite is not installed');
			?>
		<?php endif; ?>
		<?php
		echo json_encode($arJson);
		die();
		?>
	<?php elseif ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST[$actionVariableName] == 'add2basket') : ?>
		<?php
		// +++++++++++++++++++++++++++++++ add2basket +++++++++++++++++++++++++++++++ //
		global $APPLICATION, $JSON;

		$ProductID = (int) $_REQUEST[$arParams['PRODUCT_ID_VARIABLE']];
		$QUANTITY = (float) $_REQUEST[$arParams['PRODUCT_QUANTITY_VARIABLE']];

		$params = array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
			'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
			'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
			'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
			'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
			'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
		);
		unset($_REQUEST[$arParams['ACTION_VARIABLE']]);
		$restat = RSDF_EasyAdd2Basket($ProductID, $QUANTITY, $params);
		if ($ex = $APPLICATION->GetException())
			$strError = $ex->GetString();
		else
			$strError = 'CATALOG_ERROR2BASKET';

		if (!$restat) {
			$JSON = array(
				'TYPE' => 'ERROR',
				'MESSAGE' => $strError,
			);
		} else {
			$APPLICATION->IncludeComponent(
				'bitrix:sale.basket.basket.line',
				'json',
				array(),
				$component,
				array('HIDE_ICONS' => 'Y')
			);
		}

		$APPLICATION->RestartBuffer();

		if (SITE_CHARSET != 'utf-8') {
			$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
			$json_str_utf = json_encode($data);
			$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
			echo $json_str;
		} else {
			echo json_encode($JSON);
		}
		die();
		?>
	<?php elseif ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST[$actionVariableName] == 'get_element_json') : ?>
		<?php
		global $APPLICATION, $JSON;
		$APPLICATION->RestartBuffer();

		if ($ELEMENT_ID < 1) {
			$arJson = array('TYPE' => 'ERROR', 'MESSAGE' => 'Element id is empty');
			echo json_encode($arJson);
			die();
		}
		?>
		<?$ElementID=$APPLICATION->IncludeComponent(
			'bitrix:catalog.element',
			'json',
			$componentElementParams,
			$component,
			array('HIDE_ICONS' => 'Y')
		);?>
	<?php endif; ?>
<?php endif; ?>

<?php
$ElementID = $APPLICATION->IncludeComponent(
	'bitrix:catalog.element',
	'gopro',
	$componentElementParams,
	$component,
	array()
); ?>

<?php
if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__ . '/element.tabs.nav.php', $getTemplatePathPartParams))) {
	include($path);
}

if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__ . '/element.tabs.content.php', $getTemplatePathPartParams))) {
	include($path);
}
?>

<!-- // modification -->
<?php if ($arParams['USE_BLOCK_MODS'] == 'Y') : ?>
	<?php
	$obCache = new CPHPCache();
	if ($obCache->InitCache(36000, serialize($arFilter), '/iblock/catalog')) {
		$arCurIBlock = $obCache->GetVars();
	} elseif ($obCache->StartDataCache()) {
		$arCurIBlock = CIBlockPriceTools::GetOffersIBlock($arParams['IBLOCK_ID']);
		if (defined('BX_COMP_MANAGED_CACHE')) {
			global $CACHE_MANAGER;
			$CACHE_MANAGER->StartTagCache('/iblock/catalog');
			if ($arCurIBlock) {
				$CACHE_MANAGER->RegisterTag('iblock_id_' . $arParams['IBLOCK_ID']);
			}
			$CACHE_MANAGER->EndTagCache();
		} else {
			if (!$arCurIBlock) {
				$arCurIBlock = array();
			}
		}
		$obCache->EndDataCache($arCurIBlock);
	}
	?>
	<!-- mods -->
	<div class="mods">
		<?php
		global $modFilter, $JSON;
		$modFilter = array('PROPERTY_' . $arCurIBlock['OFFERS_PROPERTY_ID'] => $ElementID);
		?>
		<?php
		global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
		?>
		<?php
		require_once(Application::getDocumentRoot() . SITE_DIR . "include/sorter/catalog_element_mods.php");
		?>
		<div class="clear"></div>
		<!-- ajaxpages_mods -->
		<div id="ajaxpages_mods" class="ajaxpages_gmci">
			<?php
			global $APPLICATION, $JSON;
			$isSorterChange = 'N';
			if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == 'ajaxpages_mods') {
				$isSorterChange = 'Y';
				$JSON['TYPE'] = 'OK';
			}
			$isAjaxpages = 'N';
			if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == 'ajaxpages_mods') {
				$isAjaxpages = 'Y';
				$JSON['TYPE'] = 'OK';
			}
			?>
			<?$APPLICATION->IncludeComponent(
				'bitrix:catalog.section',
				'gopro',
				array(
					'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
					'IBLOCK_ID' => $arCurIBlock['OFFERS_IBLOCK_ID'],
					'ELEMENT_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
					'ELEMENT_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
					'ELEMENT_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
					'ELEMENT_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
					'PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
					'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
					'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
					'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
					'INCLUDE_SUBSECTIONS' => 'N',
					'BASKET_URL' => $arParams['BASKET_URL'],
					'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
					'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
					'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
					'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
					'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
					'FILTER_NAME' => 'modFilter',
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_FILTER' => $arParams['CACHE_FILTER'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					'SET_TITLE' => 'N',
					'SET_STATUS_404' => 'N',
					'DISPLAY_COMPARE' => 'N',
					'PAGE_ELEMENT_COUNT' => (intval($arParams['MODS_ELEMENT_COUNT']) > 0 ? intval($arParams['MODS_ELEMENT_COUNT']) : 100),
					'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
					'PRICE_CODE' => $arParams['PRICE_CODE'],
					'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
					'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],

					'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
					'USE_PRODUCT_QUANTITY' => $arParams['~USE_PRODUCT_QUANTITY'],
					'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : ''),
					'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
					'PRODUCT_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],

					'DISPLAY_TOP_PAGER' => 'N',
					'DISPLAY_BOTTOM_PAGER' => 'N',
					'PAGER_TITLE' => $arParams['PAGER_TITLE'],
					'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
					'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
					'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
					'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
					'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					// ajaxpages
					'AJAXPAGESID' => 'ajaxpages_mods',
					'IS_AJAXPAGES' => $isAjaxpages,
					'IS_SORTERCHANGE' => $isSorterChange,
					// goPro params
					'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
					'HIGHLOAD' => $arParams['HIGHLOAD'],
					'PROP_ARTICLE' => $arParams['PROP_SKU_ARTICLE'],
					'PROP_ACCESSORIES' => $arParams['PROP_ACCESSORIES'],
					'USE_FAVORITE' => 'N',
					'USE_SHARE' => 'N',
                    'SOC_SHARE_ICON' => $arParams['SOC_SHARE_ICON'],
					'SHOW_ERROR_EMPTY_ITEMS' => 'N',
					'OFF_MEASURE_RATION' => $arParams['OFF_MEASURE_RATION'],
					'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
					'PROP_SKU_ARTICLE' => $arParams['PROP_MODS_ARTICLE'],
					'PROPS_ATTRIBUTES' => $arParams['PROPS_ATTRIBUTES'],
					'STICKERS_PROPS' => $arParams['STICKERS_PROPS'],
					'STICKERS_DISCOUNT_VALUE' => $arParams['STICKERS_DISCOUNT_VALUE'],
					'LIST_SKU_VIEW' => $arParams['LIST_SKU_VIEW'],
					// rating
					'USE_RATING' => $arParams['USE_RATING'],
					'RATING_PROP_COUNT' => $arParams['RATING_PROP_COUNT'],
					'RATING_PROP_SUM' => $arParams['RATING_PROP_SUM'],
                    // showcase
					'COL_XS_6' => $arParams['COL_XS_6'],
					'OFF_HOVER_POPUP' => $arParams['OFF_HOVER_POPUP'],
					'USE_LAZYLOAD' => $arParams['USE_LAZYLOAD'],
					// store
					'USE_STORE' => $arParams['USE_STORE'],
					'USE_MIN_AMOUNT' => $arParams['USE_MIN_AMOUNT'],
					'MIN_AMOUNT' => $arParams['MIN_AMOUNT'],
					'MAIN_TITLE' => $arParams['MAIN_TITLE'],
					"PROP_STORE_REPLACE_SECTION" => $arParams['PROP_STORE_REPLACE_SECTION'],
                    "PROP_STORE_REPLACE_DETAIL" => $arParams['PROP_STORE_REPLACE_DETAIL'],
                    "STORE_REPLACE_IF_NOT_AVAILABLE" => $arParams['STORE_REPLACE_IF_NOT_AVAILABLE'],
					// ajaxpages
					"HIDE_AJAXPAGES_LINK" => $arParams['HIDE_AJAXPAGES_LINK'],
					// -----
					'BY_LINK' => 'Y',
					'DONT_SHOW_LINKS' => 'Y',
					'VIEW' => $alfaCTemplate,
					'COLUMNS5' => 'Y',
					// multiregionality
					'SITE_LOCATION_ID' => SITE_LOCATION_ID,
				),
				$component,
				array('HIDE_ICONS'=>'Y')
			);?>

			<?php if ($isAjaxpages == 'Y' || $isSorterChange == 'Y') : ?>
				<?php
				$APPLICATION->RestartBuffer();
				if (SITE_CHARSET != 'utf-8') {
					$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
					$json_str_utf = json_encode($data);
					$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
					echo $json_str;
				} else {
					echo json_encode($JSON);
				}
				die();
				?>
			<?php endif; ?>

		</div>
		<!-- /ajaxpages_mods -->
	</div>
	<!-- /mods -->
	<script>
		if ($('#ajaxpages_mods').find('.js-element').length < 1) {
			$('.mods').hide();
		}
	</script>
<?php endif; ?>
<!-- // /modification -->

<!-- // collection -->
<?php if (!empty($arParams['USE_CUSTOM_COLLECTION']) && $arParams['USE_CUSTOM_COLLECTION'] == 'Y') : ?>
	<?php
	global $collectionFilter;
	$collectionElementsIds = array();
	$collectionIblockId = null;

	$obCache = new CPHPCache();

	$cacheId  = array(
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		'ELEMENT_ID' => $ElementID,
		'CODE' => $arParams['CUSTOM_COLLECTION_PROPERTY']
	);

	$cacheId  = serialize($cacheId);
	$cacheDir = "/iblock/catalog.element";

	if ($obCache->InitCache(3600, $cacheId, $cacheDir)) {
		$vars = $obCache->GetVars();
		$collectionElementsIds = $vars['COLLECTION_ELEMENTS_IDS'];
		$collectionIblockId = $vars['COLLECTION_IBLOCK_ID'];
	} else {
		$dbProperty = CIBlockElement::GetProperty($arParams['IBLOCK_ID'], $ElementID, array(), array(
			'CODE' => $arParams['CUSTOM_COLLECTION_PROPERTY']
		));
		while ($arProperty = $dbProperty->GetNext()) {
			if ($arProperty['VALUE']) {
				$collectionElementsIds[] = $arProperty['VALUE'];
			}
			if (!$collectionIblockId && $arProperty['LINK_IBLOCK_ID']) {
				$collectionIblockId = $arProperty['LINK_IBLOCK_ID'];
			}
		}

		global $CACHE_MANAGER;
		$CACHE_MANAGER->StartTagCache($cacheDir);
		$CACHE_MANAGER->RegisterTag("iblock_id_" . $arParams['IBLOCK_ID']);
		$CACHE_MANAGER->EndTagCache();

		$obCache->EndDataCache(array(
			"COLLECTION_ELEMENTS_IDS" => $collectionElementsIds,
			"COLLECTION_IBLOCK_ID" => $collectionIblockId
		));
	}
	?>

	<?php if (count($collectionElementsIds) > 0 && $collectionIblockId) : ?>
		<?php
		$collectionFilter = array(
			'ID' => $collectionElementsIds,
		);
		?>
		<div class="detailcollection">
			<?php
			global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
			?>
			<?php
			require_once(Application::getDocumentRoot() . SITE_DIR . "include/sorter/catalog_element_collection.php");
			?>
			<div class="clear"></div>
			<div id="ajaxpages_collection">
				<?php
				global $APPLICATION, $JSON;
				$isSorterChange = 'N';
				if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == 'ajaxpages_collection') {
					$isSorterChange = 'Y';
					$JSON['TYPE'] = 'OK';
				}
				$isAjaxpages = 'N';
				if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == 'ajaxpages_collection') {
					$isAjaxpages = 'Y';
					$JSON['TYPE'] = 'OK';
				}
				?>
				<?$APPLICATION->IncludeComponent(
                    'bitrix:catalog.section',
                    'collection',
                    array(
                        'IBLOCK_TYPE' => "",
                        'IBLOCK_ID' => $collectionIblockId,
                        'ELEMENT_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
                        'ELEMENT_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
                        'ELEMENT_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
                        'ELEMENT_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
                        'PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
                        'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
                        'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
                        'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
                        'INCLUDE_SUBSECTIONS' => 'N',
                        'BASKET_URL' => $arParams['BASKET_URL'],
						'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
						'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
						'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
						'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
						'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
                        'FILTER_NAME' => 'collectionFilter',
                        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                        'CACHE_TIME' => $arParams['CACHE_TIME'],
                        'CACHE_FILTER' => $arParams['CACHE_FILTER'],
                        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                        'SET_TITLE' => 'N',
                        'SET_STATUS_404' => 'N',
                        'DISPLAY_COMPARE' => 'N',
                        'PAGE_ELEMENT_COUNT' => '100',
                        'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
                        'PRICE_CODE' => $arParams['PRICE_CODE'],
                        'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                        'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],

                        'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
                        'USE_PRODUCT_QUANTITY' => $arParams['~USE_PRODUCT_QUANTITY'],
                        'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : ''),
                        'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
                        'PRODUCT_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],

                        'DISPLAY_TOP_PAGER' => 'N',
                        'DISPLAY_BOTTOM_PAGER' => 'N',
                        'PAGER_TITLE' => $arParams['PAGER_TITLE'],
                        'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
                        'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
                        'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
                        'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
                        'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],
                        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                        // ajaxpages
                        'AJAXPAGESID' => 'ajaxpages_collection',
                        'IS_AJAXPAGES' => $isAjaxpages,
                        'IS_AJAXPAGES' => $isSorterChange,
                        // goPro params
                        'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
                        'HIGHLOAD' => $arParams['HIGHLOAD'],
                        'PROP_ARTICLE' => $arParams['PROP_SKU_ARTICLE'],
                        'PROP_ACCESSORIES' => $arParams['PROP_ACCESSORIES'],
                        'USE_FAVORITE' => 'N',
                        'USE_SHARE' => 'N',
                        'SOC_SHARE_ICON' => $arParams['SOC_SHARE_ICON'],
                        'SHOW_ERROR_EMPTY_ITEMS' => 'N',
                        'OFF_MEASURE_RATION' => $arParams['OFF_MEASURE_RATION'],
                        'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
                        'PROP_SKU_ARTICLE' => $arParams['PROP_SKU_ARTICLE'],
						'PROPS_ATTRIBUTES' => $arParams['PROPS_ATTRIBUTES'],
						'STICKERS_PROPS' => $arParams['STICKERS_PROPS'],
						'STICKERS_DISCOUNT_VALUE' => $arParams['STICKERS_DISCOUNT_VALUE'],
						'LIST_SKU_VIEW' => $arParams['LIST_SKU_VIEW'],
						// rating
						'USE_RATING' => $arParams['USE_RATING'],
						'RATING_PROP_COUNT' => $arParams['RATING_PROP_COUNT'],
						'RATING_PROP_SUM' => $arParams['RATING_PROP_SUM'],
                        // showcase
						'COL_XS_6' => $arParams['COL_XS_6'],
						'OFF_HOVER_POPUP' => $arParams['OFF_HOVER_POPUP'],
						'USE_LAZYLOAD' => $arParams['USE_LAZYLOAD'],
                        // store
                        'USE_STORE' => $arParams['USE_STORE'],
                        'USE_MIN_AMOUNT' => $arParams['USE_MIN_AMOUNT'],
                        'MIN_AMOUNT' => $arParams['MIN_AMOUNT'],
                        'MAIN_TITLE' => $arParams['MAIN_TITLE'],
						"PROP_STORE_REPLACE_SECTION" => $arParams['PROP_STORE_REPLACE_SECTION'],
                        "PROP_STORE_REPLACE_DETAIL" => $arParams['PROP_STORE_REPLACE_DETAIL'],
                        "STORE_REPLACE_IF_NOT_AVAILABLE" => $arParams['STORE_REPLACE_IF_NOT_AVAILABLE'],
						// ajaxpages
						"HIDE_AJAXPAGES_LINK" => $arParams['HIDE_AJAXPAGES_LINK'],
                        // -----
                        'BY_LINK' => 'Y',
                        'DONT_SHOW_LINKS' => 'N',
                        'VIEW' => $alfaCTemplate,
                        'COLUMNS5' => 'Y',
						// multiregionality
						'SITE_LOCATION_ID' => SITE_LOCATION_ID,
                    ),
                    $component,
                    array('HIDE_ICONS'=>'Y')
                );?>
				<?php
				if ($isAjaxpages == 'Y' || $isSorterChange == 'Y') {
					$APPLICATION->RestartBuffer();
					if (SITE_CHARSET != 'utf-8') {
						$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
						$json_str_utf = json_encode($data);
						$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
						echo $json_str;
					} else {
						echo json_encode($JSON);
					}
					die();
				}
				?>
			</div>

			<?php $APPLICATION->ShowViewContent('collection_sections'); ?>

		</div>

	<?php endif; ?>
<?php endif; ?>
<!-- // /collection -->

<?php if($USER->IsAdmin()):?>
<div class="tags-bottom">
	<div class="tags-bottom__title">����:</div>
	<ul class="tags-bottom__list">
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">80�60</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">����� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">��������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">��������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">���������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">80�60</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">����� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">��������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">��������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">���������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">80�60</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">����� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">��������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">��������� �����</a></li>
		<li class="tags-bottom__item"><a href="" class="tags-bottom__link">���������� �����</a></li>
	</ul>
</div>
<?php endif; ?>

<!-- bigdata -->
<?php if ($arParams['USE_BIG_DATA'] == 'Y' && $USER->IsAdmin()) : ?>
	<!-- bigdata -->

	<div class="bigdata js-bigdata hidden-print similar-products" style="display: none;">
        <div class="nice-title">������� ������</div>
		<?php
		global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
		?>
		<?php
		require_once(Application::getDocumentRoot() . SITE_DIR . "include/sorter/catalog_element_bigdata.php");
		?>
		<div class="clear"></div>
		<!-- /ajaxpages_bigdata -->
		<div id="ajaxpages_bigdata" class="ajaxpages_bigdata">
			<?php
			global $APPLICATION, $JSON;
			$isSorterChange = 'N';
			if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == 'ajaxpages_bigdata') {
				$isSorterChange = 'Y';
				$JSON['TYPE'] = 'OK';
			}
			$isAjaxpages = 'N';
			if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == 'ajaxpages_bigdata') {
				$isAjaxpages = 'Y';
				$JSON['TYPE'] = 'OK';
			}
			?>
			<?$APPLICATION->IncludeComponent(
	'bitrix:catalog.section',
	'bigdata',
	array(
		'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID' => $arParams['IBLOCK_ID'],
		// 'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
		// 'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
		'ELEMENT_SORT_FIELD' => 'shows',
		'ELEMENT_SORT_ORDER' => 'desc',
		'ELEMENT_SORT_FIELD2' => 'sort',
		'ELEMENT_SORT_ORDER2' => 'asc',
		'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
		'PROPERTY_CODE_MOBILE' => $arParams['LIST_PROPERTY_CODE_MOBILE'],
		'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
		'BASKET_URL' => $arParams['BASKET_URL'],
		'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
		'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
		'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
		'FILTER_NAME' => 'bigdataFilter',
		'CACHE_TYPE' => $arParams['CACHE_TYPE'],
		'CACHE_TIME' => $arParams['CACHE_TIME'],
		'CACHE_FILTER' => $arParams['CACHE_FILTER'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
		'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
		'PRICE_CODE' => $arParams['PRICE_CODE'],
		'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
		'PAGE_ELEMENT_COUNT' => "8",
		'FILTER_IDS' => array($ElementID),

		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"ADD_SECTIONS_CHAIN" => "N",

		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
		'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
		'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
		'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
		'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],

		'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
		'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
		'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
		'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
		'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
		'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
		'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
		'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],

		'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
		'USE_MAIN_ELEMENT_SECTION' => $arParams['USE_MAIN_ELEMENT_SECTION'],
		'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
		'CURRENCY_ID' => $arParams['CURRENCY_ID'],
		'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
		'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],

		'LABEL_PROP' => $arParams['LABEL_PROP'],
		'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
		'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
		'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
		'PRODUCT_BLOCKS_ORDER' => $arParams['LIST_PRODUCT_BLOCKS_ORDER'],
		'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'3','BIG_DATA':false}]",
		'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
		'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
		'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
		'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

		'DISPLAY_TOP_PAGER' => 'N',
		'DISPLAY_BOTTOM_PAGER' => 'N',
		'HIDE_SECTION_DESCRIPTION' => 'Y',

		'RCM_TYPE' => isset($arParams['BIG_DATA_RCM_TYPE']) ? $arParams['BIG_DATA_RCM_TYPE'] : '',
		'RCM_PROD_ID' => $ElementID,
		'SHOW_FROM_SECTION' => 'Y',

		'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
		'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
		'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
		'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
		'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
		'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
		'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
		'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
		'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
		'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
		'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
		'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
		'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
		'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
		'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

		'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
		'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
		'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

		'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
		'ADD_TO_BASKET_ACTION' => $basketAction,
		'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
		'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
		'COMPARE_NAME' => $arParams['COMPARE_NAME'],
		'BACKGROUND_IMAGE' => '',
		'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : ''),

		// replace default params
		// "RCM_PROD_ID" => $elementId,
		// "RCM_TYPE" => "personal",
		// "USE_ENHANCED_ECOMMERCE" => "N",
		// "USE_MAIN_ELEMENT_SECTION" => "N",
		// "ENLARGE_PRODUCT" => "STRICT",
		// "LINE_ELEMENT_COUNT" => "3",
		// "PAGE_ELEMENT_COUNT" => "18",
		// 'PRODUCT_DISPLAY_MODE' => "N",
		// 'PRODUCT_ROW_VARIANTS' => "[{'VARIANT':'2','BIG_DATA':true},{'VARIANT':'2','BIG_DATA':true}]",

		// ajaxpages
		'AJAXPAGESID' => 'ajaxpages_bigdata',
		'IS_AJAXPAGES' => $isAjaxpages,
		'IS_AJAXPAGES' => $isSorterChange,
		// goPro params
		'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
		'HIGHLOAD' => $arParams['HIGHLOAD'],
		'PROP_ARTICLE' => $arParams['PROP_SKU_ARTICLE'],
		'PROP_ACCESSORIES' => $arParams['PROP_ACCESSORIES'],
		'USE_FAVORITE' => 'N',
		'USE_SHARE' => 'N',
		'SOC_SHARE_ICON' => $arParams['SOC_SHARE_ICON'],
		'SHOW_ERROR_EMPTY_ITEMS' => 'N',
		'OFF_MEASURE_RATION' => $arParams['OFF_MEASURE_RATION'],
		'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
		'PROP_SKU_ARTICLE' => $arParams['PROP_SKU_ARTICLE'],
		'PROPS_ATTRIBUTES' => $arParams['PROPS_ATTRIBUTES'],
		'PROPS_ATTRIBUTES_COLOR' => $arParams['PROPS_ATTRIBUTES_COLOR'],
		'STICKERS_PROPS' => $arParams['STICKERS_PROPS'],
		'STICKERS_DISCOUNT_VALUE' => $arParams['STICKERS_DISCOUNT_VALUE'],
		'LIST_SKU_VIEW' => $arParams['LIST_SKU_VIEW'],
		// rating
		'USE_RATING' => $arParams['USE_RATING'],
		'RATING_PROP_COUNT' => $arParams['RATING_PROP_COUNT'],
		'RATING_PROP_SUM' => $arParams['RATING_PROP_SUM'],
		// showcase
		'COL_XS_6' => $arParams['COL_XS_6'],
		'OFF_HOVER_POPUP' => $arParams['OFF_HOVER_POPUP'],
		'USE_LAZYLOAD' => $arParams['USE_LAZYLOAD'],
		// store
		'USE_STORE' => $arParams['USE_STORE'],
		'USE_MIN_AMOUNT' => $arParams['USE_MIN_AMOUNT'],
		'MIN_AMOUNT' => $arParams['MIN_AMOUNT'],
		'MAIN_TITLE' => $arParams['MAIN_TITLE'],
		"PROP_STORE_REPLACE_SECTION" => $arParams['PROP_STORE_REPLACE_SECTION'],
        "PROP_STORE_REPLACE_DETAIL" => $arParams['PROP_STORE_REPLACE_DETAIL'],
        "STORE_REPLACE_IF_NOT_AVAILABLE" => $arParams['STORE_REPLACE_IF_NOT_AVAILABLE'],
		// ajaxpages
		"HIDE_AJAXPAGES_LINK" => $arParams['HIDE_AJAXPAGES_LINK'],
		// -----
		// 'BY_LINK' => 'Y',
		'DONT_SHOW_LINKS' => 'N',
		'VIEW' => $alfaCTemplate,
		'COLUMNS5' => 'N',
		// multiregionality
		'SITE_LOCATION_ID' => SITE_LOCATION_ID,
		// bigdata
		'BIG_DATA_ELEMENT_COUNT' => $arParams['BIG_DATA_ELEMENT_COUNT'],
		// 404
		'SET_TITLE' => 'N',
		'SET_STATUS_404' => 'N',
	),
	$component,
	array("HIDE_ICONS" => "Y")
);
?>
			<?php
			if ($isAjaxpages == 'Y' || $isSorterChange == 'Y') {
				$APPLICATION->RestartBuffer();
				if (SITE_CHARSET != 'utf-8') {
					$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
					$json_str_utf = json_encode($data);
					$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
					echo $json_str;
				} else {
					echo json_encode($JSON);
				}
				die();
			}
			?>
		</div>
		<!-- /ajaxpages_bigdata -->
	</div><!-- /bigdata -->
<?php endif;
/*if($USER->IsAdmin()):?>
<div class="similar-products">
	<div class="nice-title">������� ������</div>
	<div class="list-showcase view-showcase row">
		<!-- element -->
		<div class="js-element js-elementid20307 list-element list-showcase__element  col-xs-12 col-sm-4 col-md-3 col-lg-3 mod-short" data-elementid="20307" id="bx_3966226736_20307" data-productid="20308" data-detail="/catalog/myagkaya_mebel/kukhonnye_divanchiki/fenix120/">
			<div class="list-showcase__inner js-element__shadow">
				<!-- part main -->
				<div class="list-showcase__part-main">
					<div class="list-showcase__mix">
						<div class="list-showcase__picture">
							<a href="/catalog/myagkaya_mebel/kukhonnye_divanchiki/fenix120/">
								<img class="js-list-picture js-lazy" src="/upload/resize_cache/iblock/826/198_208_140cd750bba9870f18aada2478b24840a/82672027e32718b8c6bb9fdc92b9fcc5.jpg" alt="�����-������� ������ 120" title="�����-������� ������ 120" style="">
							</a>
						</div>
						<div class="list-showcase__timer-stickers">
							<div class="list-showcase__timer">
							</div>
							<div class="list-showcase__stickers">
								<div class="c-stickers">
									<span class="c-stickers__sticker c-stickers__da2">����� ���</span>
									<span class="c-stickers__sticker c-stickers__qb">����� ������</span>
									<span class="c-stickers__sticker c-stickers__sticker-standart c-stickers__discount js-discount-value" style="display: none;">-<span class="js-discount-value">0</span>%</span>
								</div>
							</div>
						</div>
						<div class="list-showcase__compare">
							<a rel="nofollow" class="c-compare js-add2compare" href="/catalog/myagkaya_mebel/?action=ADD_TO_COMPARE_LIST&amp;id=20307">
								<svg class="svg-icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-compare-small"></use>
								</svg>
							</a>
						</div>
						<div class="list-showcase__favorite">
							<a rel="nofollow" class="c-favorite js-add2favorite" href="/catalog/myagkaya_mebel/kukhonnye_divanchiki/fenix120/">
								<svg class="svg-icon">
									<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite-small"></use>
								</svg>
							</a>
						</div>
					</div>
					<div class="list-showcase__name-rating">
						<div class="list-showcase__name">
							<a href="/catalog/myagkaya_mebel/kukhonnye_divanchiki/fenix120/">�����-������� ������ 120</a>
						</div>
						<div class="list-showcase__rating">
						</div>
					</div>
					<div class="list-showcase__prices">
						<div class="c-prices js-prices view-list page-list product-alone multyprice-no" data-page="list" data-view="list" data-maxshow="2" data-showmore="Y" data-usealone="Y" data-multiprice="N" data-productmultiprice="N">
							<span class="c-prices__price   js-prices__price js-prices__price-code_BASE" data-pricecode="BASE"><span class="c-prices__name">��������� ����:</span>
								<span class="c-prices__value js-prices_pdv_BASE">16&nbsp;300 ���.</span>
								<span class="c-prices__value-old-before">
									<span class="c-prices__value-old js-prices_pv_BASE_hide js-prices_pv_BASE c-prices__hide">16&nbsp;300 ���.</span>
								</span>
							</span>
							<div class="c-prices__more js-prices__more c-prices__hide">
								<a class="c-prices__more-link" href="/catalog/myagkaya_mebel/kukhonnye_divanchiki/fenix120/">��� (<span class="js-prices__more-count">-1</span>)</a>
							</div>
						</div>
					</div>

					<div class="list-showcase__pay hidden-xs hidden-sm hidden-print">

						<!--noindex-->
						<div class="b-pay">
							<form class="b-pay__form js-pay__form js-buyform js-synchro clearfix" name="add2basketform">
								<input type="hidden" name="action" value="ADD2BASKET">
								<input type="hidden" name="id" class="js-add2basketpid" value="20308">
								<span class="b-pay__inner">
									<span class="b-pay__quantity">
									</span>
									<span class="b-pay__buttons">
										<a rel="nofollow" class="b-pay__button b-pay__add2basket js-add2basket js-submit btn-primary waves-effect" href="#" title="� �������">� �������</a>
										<a rel="nofollow" class="b-pay__button b-pay__inbasket js-inbasket btn-primary-darken waves-effect" href="/personal/cart/" title="� �������">� �������</a>
									</span>
								</span>
								<input type="submit" name="submit" class="nonep" value="">
							</form>
						</div>
						<!--/noindex-->
					</div>

					<div class="list-showcase__pay-mobile hidden-md hidden-lg">
						<a class="btn-primary waves-effect" href="/catalog/myagkaya_mebel/kukhonnye_divanchiki/fenix120/">���������</a>
					</div>

				</div>
				<!-- /part main -->
				<!-- part extended -->
				<div class="list-showcase__part-extended">
					<div class="list-showcase__attributes">
						<div class="c-attributes view-buttons  js-attributes" data-view="buttons">
							<!-- prop -->
							<div class="c-attributes__prop js-attributes__prop js-attributes__code__COLOR_DIRECTORY close is-pic js-pic" data-code="COLOR_DIRECTORY">
								<span class="c-attributes__select js-attributes__select">
									<!-- name-current-value -->
									<span class="c-attributes__name-current-value">
										<span class="c-attributes__name">
											����:
										</span>
										<span class="c-attributes__current-value js-attributes__curent-value">
											<span class="c-attributes__current-value__pseudo-option">
												<span class="c-attributes__value-pic js-attributes__set-value-pic" style="background-image:url('/upload/uf/180/18028ae01ae9304bb0eeafc5a78994ac.jpg');" title="�������">
												</span>
												<span class="c-attributes__value js-attributes__set-value-text">�������</span>
												<svg class="c-attributes__arrow svg-icon">
													<use xlink:href="#svg-arrow-linear-down"></use>
												</svg>
											</span>
										</span>
									</span>
									<!-- /name-current-value -->
									<!-- options -->
									<span class="c-attributes__options js-attributes__options">
										<span class="c-attributes__option js-attributes__option  selected" data-value="�������" data-value-pic="/upload/uf/180/18028ae01ae9304bb0eeafc5a78994ac.jpg">
											<span class="c-attributes__value-pic js-attributes__value-pic" style="background-image:url('/upload/uf/180/18028ae01ae9304bb0eeafc5a78994ac.jpg');" title="�������"></span>
											<span class="c-attributes__value c-attributes__option__value js-attributes__value-text">�������</span>
										</span>
									</span>
									<!-- /options -->
								</span>
							</div>
							<!-- /prop -->
							<!-- prop -->
							<div class="c-attributes__prop js-attributes__prop js-attributes__code__BRANDS close" data-code="BRANDS">
								<span class="c-attributes__select js-attributes__select">
									<!-- name-current-value -->
									<span class="c-attributes__name-current-value">
										<span class="c-attributes__name">�������������:</span>
										<span class="c-attributes__current-value js-attributes__curent-value">
											<span class="c-attributes__current-value__pseudo-option">
												<span class="c-attributes__value js-attributes__set-value-text">komfortlayn</span>
											</span>
										</span>
									</span>
									<!-- /name-current-value -->
								</span>
							</div>
							<!-- /prop -->
							<!-- prop -->
							<div class="c-attributes__prop js-attributes__prop js-attributes__code__CASING_MATERIAL close" data-code="CASING_MATERIAL">
								<span class="c-attributes__select js-attributes__select">
									<!-- name-current-value -->
									<span class="c-attributes__name-current-value">
										<span class="c-attributes__name">�������� ������:</span>
										<span class="c-attributes__current-value js-attributes__curent-value">
											<span class="c-attributes__current-value__pseudo-option">
												<span class="c-attributes__value js-attributes__set-value-text">�����</span>
											</span>
										</span>
									</span>
									<!-- /name-current-value -->
								</span>
							</div>
							<!-- /prop -->
							<!-- prop -->
							<div class="c-attributes__prop js-attributes__prop js-attributes__code__DLINA close" data-code="DLINA">
								<span class="c-attributes__select js-attributes__select">
									<!-- name-current-value -->
									<span class="c-attributes__name-current-value">
										<span class="c-attributes__name">�����:</span>
										<span class="c-attributes__current-value js-attributes__curent-value">
											<span class="c-attributes__current-value__pseudo-option">
												<span class="c-attributes__value js-attributes__set-value-text">120</span>
											</span>
										</span>
									</span>
									<!-- /name-current-value -->
								</span>
							</div>
							<!-- /prop -->
							<!-- prop -->
							<div class="c-attributes__prop js-attributes__prop js-attributes__code__SHIRINA close" data-code="SHIRINA">
								<span class="c-attributes__select js-attributes__select">
									<!-- name-current-value -->
									<span class="c-attributes__name-current-value">
										<span class="c-attributes__name">������:</span>
										<span class="c-attributes__current-value js-attributes__curent-value">
											<span class="c-attributes__current-value__pseudo-option">
												<span class="c-attributes__value js-attributes__set-value-text">62</span>
											</span>
										</span>
									</span>
									<!-- /name-current-value -->
								</span>
							</div>
							<!-- /prop -->
							<!-- prop -->
							<div class="c-attributes__prop js-attributes__prop js-attributes__code__VISOTA close" data-code="VISOTA">
								<span class="c-attributes__select js-attributes__select">
									<!-- name-current-value -->
									<span class="c-attributes__name-current-value">
										<span class="c-attributes__name">������:</span>
										<span class="c-attributes__current-value js-attributes__curent-value">
											<span class="c-attributes__current-value__pseudo-option">
												<span class="c-attributes__value js-attributes__set-value-text">82</span>
											</span>
										</span>
									</span>
									<!-- /name-current-value -->
								</span>
							</div>
							<!-- /prop -->
							<!-- prop -->
							<div class="c-attributes__prop js-attributes__prop js-attributes__code__mehanizm_divana close" data-code="mehanizm_divana">
								<span class="c-attributes__select js-attributes__select">
									<!-- name-current-value -->
									<span class="c-attributes__name-current-value">
										<span class="c-attributes__name">�������� ������:</span>
										<span class="c-attributes__current-value js-attributes__curent-value">
											<span class="c-attributes__current-value__pseudo-option">
												<span class="c-attributes__value js-attributes__set-value-text">�������</span>
											</span>
										</span>
									</span>
									<!-- /name-current-value -->
								</span>
							</div>
							<!-- /prop -->
						</div>
					</div>
				</div>
				<!-- /part extended -->
			</div>
		</div>
		<!-- /element -->
	</div>
</div>
<?endif;*/?>
<?php
if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__ . '/element.finish.php', $getTemplatePathPartParams))) {
	include($path);
}
