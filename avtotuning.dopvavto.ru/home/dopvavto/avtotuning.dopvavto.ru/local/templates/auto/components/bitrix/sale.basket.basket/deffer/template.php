<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\UI\Extension::load("ui.fonts.ruble");

/**
 * @var array $arParams
 * @var array $arResult
 * @var string $templateFolder
 * @var string $templateName
 * @var CMain $APPLICATION
 * @var CBitrixBasketComponent $component
 * @var CBitrixComponentTemplate $this
 * @var array $giftParameters
 */

$documentRoot = Main\Application::getDocumentRoot();

if (empty($arParams['TEMPLATE_THEME']))
{
	$arParams['TEMPLATE_THEME'] = Main\ModuleManager::isModuleInstalled('bitrix.eshop') ? 'site' : 'blue';
}

if ($arParams['TEMPLATE_THEME'] === 'site')
{
	$templateId = Main\Config\Option::get('main', 'wizard_template_id', 'eshop_bootstrap', $component->getSiteId());
	$templateId = preg_match('/^eshop_adapt/', $templateId) ? 'eshop_adapt' : $templateId;
	$arParams['TEMPLATE_THEME'] = Main\Config\Option::get('main', 'wizard_'.$templateId.'_theme_id', 'blue', $component->getSiteId());
}

if (!empty($arParams['TEMPLATE_THEME']))
{
	if (!is_file($documentRoot.'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

if (!isset($arParams['DISPLAY_MODE']) || !in_array($arParams['DISPLAY_MODE'], array('extended', 'compact')))
{
	$arParams['DISPLAY_MODE'] = 'extended';
}

$arParams['USE_DYNAMIC_SCROLL'] = isset($arParams['USE_DYNAMIC_SCROLL']) && $arParams['USE_DYNAMIC_SCROLL'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_FILTER'] = isset($arParams['SHOW_FILTER']) && $arParams['SHOW_FILTER'] === 'N' ? 'N' : 'Y';

$arParams['PRICE_DISPLAY_MODE'] = isset($arParams['PRICE_DISPLAY_MODE']) && $arParams['PRICE_DISPLAY_MODE'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['TOTAL_BLOCK_DISPLAY']) || !is_array($arParams['TOTAL_BLOCK_DISPLAY']))
{
	$arParams['TOTAL_BLOCK_DISPLAY'] = array('top');
}

if (empty($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = 'props,sku,columns';
}

if (is_string($arParams['PRODUCT_BLOCKS_ORDER']))
{
	$arParams['PRODUCT_BLOCKS_ORDER'] = explode(',', $arParams['PRODUCT_BLOCKS_ORDER']);
}

$arParams['USE_PRICE_ANIMATION'] = isset($arParams['USE_PRICE_ANIMATION']) && $arParams['USE_PRICE_ANIMATION'] === 'N' ? 'N' : 'Y';
$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

if ($arParams['USE_GIFTS'] === 'Y')
{
	$arParams['GIFTS_BLOCK_TITLE'] = isset($arParams['GIFTS_BLOCK_TITLE']) ? trim((string)$arParams['GIFTS_BLOCK_TITLE']) : Loc::getMessage('SBB_GIFTS_BLOCK_TITLE');

	CBitrixComponent::includeComponentClass('bitrix:sale.products.gift.basket');

	$giftParameters = array(
		'SHOW_PRICE_COUNT' => 1,
		'PRODUCT_SUBSCRIPTION' => 'N',
		'PRODUCT_ID_VARIABLE' => 'id',
		'USE_PRODUCT_QUANTITY' => 'N',
		'ACTION_VARIABLE' => 'actionGift',
		'ADD_PROPERTIES_TO_BASKET' => 'Y',
		'PARTIAL_PRODUCT_PROPERTIES' => 'Y',

		'BASKET_URL' => $APPLICATION->GetCurPage(),
		'APPLIED_DISCOUNT_LIST' => $arResult['APPLIED_DISCOUNT_LIST'],
		'FULL_DISCOUNT_LIST' => $arResult['FULL_DISCOUNT_LIST'],

		'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
		'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_SHOW_VALUE'],
		'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],

		'BLOCK_TITLE' => $arParams['GIFTS_BLOCK_TITLE'],
		'HIDE_BLOCK_TITLE' => $arParams['GIFTS_HIDE_BLOCK_TITLE'],
		'TEXT_LABEL_GIFT' => $arParams['GIFTS_TEXT_LABEL_GIFT'],

		'DETAIL_URL' => isset($arParams['GIFTS_DETAIL_URL']) ? $arParams['GIFTS_DETAIL_URL'] : null,
		'PRODUCT_QUANTITY_VARIABLE' => $arParams['GIFTS_PRODUCT_QUANTITY_VARIABLE'],
		'PRODUCT_PROPS_VARIABLE' => $arParams['GIFTS_PRODUCT_PROPS_VARIABLE'],
		'SHOW_OLD_PRICE' => $arParams['GIFTS_SHOW_OLD_PRICE'],
		'SHOW_DISCOUNT_PERCENT' => $arParams['GIFTS_SHOW_DISCOUNT_PERCENT'],
		'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
		'MESS_BTN_BUY' => $arParams['GIFTS_MESS_BTN_BUY'],
		'MESS_BTN_DETAIL' => $arParams['GIFTS_MESS_BTN_DETAIL'],
		'CONVERT_CURRENCY' => $arParams['GIFTS_CONVERT_CURRENCY'],
		'HIDE_NOT_AVAILABLE' => $arParams['GIFTS_HIDE_NOT_AVAILABLE'],

		'PRODUCT_ROW_VARIANTS' => '',
		'PAGE_ELEMENT_COUNT' => 0,
		'DEFERRED_PRODUCT_ROW_VARIANTS' => \Bitrix\Main\Web\Json::encode(
			SaleProductsGiftBasketComponent::predictRowVariants(
				$arParams['GIFTS_PAGE_ELEMENT_COUNT'],
				$arParams['GIFTS_PAGE_ELEMENT_COUNT']
			)
		),
		'DEFERRED_PAGE_ELEMENT_COUNT' => $arParams['GIFTS_PAGE_ELEMENT_COUNT'],

		'ADD_TO_BASKET_ACTION' => 'BUY',
		'PRODUCT_DISPLAY_MODE' => 'Y',
		'PRODUCT_BLOCKS_ORDER' => isset($arParams['GIFTS_PRODUCT_BLOCKS_ORDER']) ? $arParams['GIFTS_PRODUCT_BLOCKS_ORDER'] : '',
		'SHOW_SLIDER' => isset($arParams['GIFTS_SHOW_SLIDER']) ? $arParams['GIFTS_SHOW_SLIDER'] : '',
		'SLIDER_INTERVAL' => isset($arParams['GIFTS_SLIDER_INTERVAL']) ? $arParams['GIFTS_SLIDER_INTERVAL'] : '',
		'SLIDER_PROGRESS' => isset($arParams['GIFTS_SLIDER_PROGRESS']) ? $arParams['GIFTS_SLIDER_PROGRESS'] : '',
		'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],

		'USE_ENHANCED_ECOMMERCE' => $arParams['USE_ENHANCED_ECOMMERCE'],
		'DATA_LAYER_NAME' => $arParams['DATA_LAYER_NAME'],
		'BRAND_PROPERTY' => $arParams['BRAND_PROPERTY']
	);
}

//\CJSCore::Init(array('fx', 'popup', 'ajax'));

$this->addExternalCss($templateFolder.'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css');

$this->addExternalJs($templateFolder.'/js/mustache.js');
$this->addExternalJs($templateFolder.'/js/action-pool.js');
$this->addExternalJs($templateFolder.'/js/filter.js');
$this->addExternalJs($templateFolder.'/js/component.js');

$mobileColumns = isset($arParams['COLUMNS_LIST_MOBILE'])
	? $arParams['COLUMNS_LIST_MOBILE']
	: $arParams['COLUMNS_LIST'];
$mobileColumns = array_fill_keys($mobileColumns, true);

$displayModeClass = $arParams['DISPLAY_MODE'] === 'compact' ? ' basket-items-list-wrapper-compact' : '';
session_start();
$_SESSION['SAVE'] = $arResult['SAVING'];
$_SESSION['DISCOUNT_OLD_FULL'] = $arResult['DISCOUNT_OLD_FULL'];
if (empty($arResult['ERROR_MESSAGE']))
{
	if ($arResult['BASKET_ITEM_MAX_COUNT_EXCEEDED'])
	{
		?>
		<div id="basket-item-message">
			<?=Loc::getMessage('SBB_BASKET_ITEM_MAX_COUNT_EXCEEDED', array('#PATH#' => $arParams['PATH_TO_BASKET']))?>
		</div>
		<?
	}?>
    <input id="deffer" type="hidden" value="deffer"/>
	<div id="steps" >
		<div id="step-1" style="display: block;">
			<div class="order">
				<div class="order__table show-height" id="basket-items-list-wrapper">
                    <div id="basket-items-list-container">
						<div id="basket-item-list">
                            <table>
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Описание</th>
                                    <th>Количество</th>
                                    <th>Стоимость</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <?$i=1;
//                                pr($arResult['GRID']['ROWS']);
//                                pr($arParams);
                                foreach ($arResult['GRID']['ROWS'] as $key1 => $item) {
                                    if($item['DELAY'] =='Y'){?>
                                        <tbody class="mob-item <?if($item['PROPS_ALL']['Komplect']['VALUE']){?>kit<?}?>">
                                        <?if($item['PROPS_ALL']['Komplect']['VALUE']){?>
                                            <tr class="kit-element">
                                                <td colspan="5" style="padding: 20px 0 0 35px;color: #fff;font-size: 16px;font-weight: 700;">Комплект:</td>
                                            </tr>
                                        <?}?>
                                        <tr>
                                            <td class="nmb"><?=$i++;?></td>
                                            <td>
                                                <input type="hidden" id="nadbavka_<?=$item['ID']?>" value="<?=$item['CURRENCY']?>"/>
                                                <?if($item['PROPS_ALL']['Komplect']['VALUE']){?>
                                                    <div class="div main_flex flex__align-items_center">
                                                        <img src="<? if(CFile::GetPath($item["PREVIEW_PICTURE"])) {echo CFile::GetPath($item["PREVIEW_PICTURE"]);} else{echo $templateFolder?>/images/no_photo.png<?}?>" alt="img">
                                                        <div>
                                                            <a href="<?=$item['DETAIL_PAGE_URL']?>" class="bd"><?=$item['NAME']?></a>
                                                        </div>
                                                    </div>
                                                    <?if($item['PROPS_ALL']['Komplect']['VALUE'] != 'POD'){?>
                                                        <?foreach ($item['KIT_ITEMS'] as $KIT_ITEMS) {?>
                                                            <div class="div main_flex flex__align-items_center">
                                                                <img src="<? if(CFile::GetPath($KIT_ITEMS["PREVIEW_PICTURE"])) {echo CFile::GetPath($KIT_ITEMS["PREVIEW_PICTURE"]);} else{echo $templateFolder?>/images/no_photo.png<?}?>" alt="img">
                                                                <div>
                                                                    <a href="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' .$_SERVER['HTTP_HOST'].'/catalog/'.$KIT_ITEMS['DETAIL_PAGE_URL']?>" class="bd"><?=$KIT_ITEMS['NAME']?></a>
                                                                </div>
                                                            </div>
                                                        <?}?>
                                                    <?}else{?>
                                                        <?foreach ($item['PRODUCT_GIFT'] as $PRODUCT_GIFT) {?>
                                                            <div class="div main_flex flex__align-items_center">
                                                                <img src="<? if(CFile::GetPath($PRODUCT_GIFT["PREVIEW_PICTURE"])) {echo CFile::GetPath($PRODUCT_GIFT["PREVIEW_PICTURE"]);} else{echo $templateFolder?>/images/no_photo.png<?}?>" alt="img">
                                                                <div>
                                                                    <a href="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' .$_SERVER['HTTP_HOST'].'/catalog/'.$PRODUCT_GIFT['DETAIL_PAGE_URL']?>" class="bd"><?=$PRODUCT_GIFT['NAME']?></a>
                                                                </div>
                                                            </div>
                                                        <?}?>
                                                    <?}?>
                                                    <?if($item['PROPS_ALL']['Komplect']['VALUE'] == 'POD'){?>
                                                        <div class="div main_flex flex__align-items_center">
                                                            <img src="<? if(CFile::GetPath($item['PODAROK']["PREVIEW_PICTURE"])) {echo CFile::GetPath($item['PODAROK']["PREVIEW_PICTURE"]);} else{echo $templateFolder?>/images/no_photo.png<?}?>" alt="img">
                                                            <div>
                                                                <a href="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' .$_SERVER['HTTP_HOST'].'/catalog/'.$item['PODAROK']['DETAIL_PAGE_URL']?>" class="bd"><?=$item['PODAROK']['NAME']?></a>
                                                            </div>
                                                        </div>
                                                    <?}?>
                                                <?}else{?>
                                                    <div class="div main_flex flex__align-items_center">
                                                        <img src="<? if(CFile::GetPath($item["PREVIEW_PICTURE"])) {echo CFile::GetPath($item["PREVIEW_PICTURE"]);} else{echo $templateFolder?>/images/no_photo.png<?}?>" alt="img">
                                                        <?if($item['PROPERTY_NADBAVKA_VALUE'] || $item['PROPERTY_DISCOUNT_KIT_ACTIV_VALUE'] || $item['PROPERTY_GIFT_SET_ACTIV_VALUE']){?><div><?}?>
                                                        <a href="<?=$item['DETAIL_PAGE_URL']?>" class="bd"><?=$item['NAME']?></a>
                                                        <?if(($item['PROPERTY_DISCOUNT_KIT_ACTIV_VALUE'] || $item['PROPERTY_GIFT_SET_ACTIV_VALUE']) && !$item['PROPERTY_NADBAVKA_VALUE']){?>
                                                            <span class="toggler">
                                                                <button class="rg">Этот товар может быть ещё дешевле!</button>
                                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                                     viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 492.004 492.004;" xml:space="preserve">
                                                                    <g><g><path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                                                                c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                                                                c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                                                                c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                                                        </g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
                                                                </svg>
                                                            </span>
                                                        <?}?>
                                                        <?if(explode(',',$item['PROPERTY_NADBAVKA_VALUE'])[0]){
                                                                foreach (explode(',',$item['PROPERTY_NADBAVKA_VALUE']) as $key => $elNadbavka){
                                                                    $arFilter = Array("IBLOCK_ID"=>17, "ID"=>$elNadbavka);
                                                                    $res = CIBlockElement::GetList(Array(), $arFilter);
                                                                    if ($ob = $res->GetNextElement()){;
                                                                        $arFields = $ob->GetFields(); // поля элемента
                                                                        $arProps = $ob->GetProperties(); // свойства элемента
                                                                    }
                                                                    $nadbavka[$key]['ID'] = $arFields['ID'];
                                                                    $nadbavka[$key]['NAME'] = $arFields['NAME'];
                                                                    $nadbavka[$key]['PRICE'] = $arProps['PRICE_NADBAVKA']['VALUE'];
                                                                }
                                                                if ($nadbavka && count($nadbavka)>=3){?>
                                                                    <div class="dropdown inner-drop-down">
                                                                        <?foreach ($nadbavka as $span){
                                                                            if($span['ID'] == $item['PROPS']['0']['VALUE']){?>
                                                                                <span class="dropdown-button" data-text="<?=$span["NAME"]?> (+<?=$span["PRICE"]?>)"><?=$span["NAME"]?> (+<?=$span["PRICE"]?>)</span>
                                                                            <?}
                                                                            if(!$item['PROPS']['0']['VALUE']){?>
                                                                                <span class="dropdown-button" data-text="Выбрать надбавку">Выбрать надбавку</span>
                                                                                <?break;?>
                                                                            <?}
                                                                        }?>
                                                                        <ul class="dropdown-list">
                                                                            <li data-value="Выбрать надбавку" onclick="Basketnad('-1','0', '<?=$item["PRICE"]-$item['NADBAVKA']['PRICE']?>', '<?=$item["QUANTITY"]?>', 'nadbavka', '', '<?=$item['ID']?>')">Выбрать надбавку</li>
                                                                            <? foreach ($nadbavka as $kay => $item1) {?>
                                                                                <li data-value="<?=$item1["NAME"]?> (+<?=$item1["PRICE"]?>)" data-id="<?=$item1['ID']?>" onclick="Basketnad('<?=$kay+1?>','<?=stristr($item1["PRICE"], ' ', true)?>', '<?=$item["PRICE"]-$item['NADBAVKA']['PRICE']?>', '<?=$item["QUANTITY"]?>', 'nadbavka', '<?=$item1["ID"]?>', '<?=$item['ID']?>')" ><?=$item1["NAME"]?> (+<?=$item1["PRICE"]?>)</li>
                                                                            <?}?>
                                                                        </ul>
                                                                        <img class="svg" src="<?=SITE_TEMPLATE_PATH?>img/icon/cancel.svg" width="8">
                                                                    </div>
                                                                    <?unset ($nadbavka);?>
                                                                <?}else{?>
                                                                    <div class="checkbox-block">
                                                                        <?foreach ($nadbavka as $key=>$items){?>
                                                                            <div class="md-checkbox radio-btn" >
                                                                                <label class="checkcontainer">
                                                                                    <?=$items["NAME"]?> (+<?=$items["PRICE"]?>)
                                                                                    <input type="radio" name="checked<?=$item['ID']?>" id="checked<?=$item['ID']?><?=$key?>" <?if($items["ID"]==$item['PROPS']['0']['VALUE']){echo 'checked';}?> onclick="clickRadio(this); Basketnad('checked<?=$item['ID']?><?=$key?>','<?=stristr($items["PRICE"], ' ', true)?>', '<?=$item["PRICE"]-$item['NADBAVKA']['PRICE']?>', '<?=$item["QUANTITY"]?>', 'nadbavka', '<?=$items["ID"]?>', '<?=$item['ID']?>')">
                                                                                    <span class="radiobtn"></span>
                                                                                </label>
                                                                            </div>
                                                                        <?}?>
                                                                    </div>
                                                                    <?unset ($nadbavka);?>
                                                                <?}
                                                            }?>

                                                        <?if($item['PROPERTY_NADBAVKA_VALUE'] || $item['PROPERTY_DISCOUNT_KIT_ACTIV_VALUE'] || $item['PROPERTY_GIFT_SET_ACTIV_VALUE']){?> </div> <?}?>
                                                    </div>
                                                <?}?>

                                            </td>
                                            <td>
                                                <div class="current main_flex__nowrap flex__align-items_center flex__jcontent_around">
                                                    <span class="current__min"  field='<?=$item['ID']?>'><i class="fas fa-minus"></i></span>
                                                    <div class="current__num">
                                                        <input type="text" name="quantity<?=$item['ID']?>" class="current_value" value="<?=$item['QUANTITY']?>" id="basket-item-quantity-<?=$item['ID']?>">
                                                    </div>
                                                    <span class="current__max"  field='<?=$item['ID']?>'><i class="fas fa-plus"></i></span>
                                                </div>
                                            </td>
                                            <td class="text-center <?if($item['PROPERTY_OLD_PRICE_VALUE']) {?>low<?}?>">
                                                <?if($item['PROPERTY_OLD_PRICE_VALUE']) {?>
                                                    <span class="rg low--red" id="basket-item-sum-price-<?=$item['ID']?>"><? echo $item['PROPERTY_OLD_PRICE_VALUE']?> руб.</span>
                                                    <p class="rg" id="basket-item-sum-price-<?=$item['ID']?>"><?=$item['SUM_VALUE'].' руб.'?></p>
                                                <?}else{?>
                                                    <?=$item['SUM_VALUE'].' руб.'?>
                                                <?}?>
                                            </td>
                                            <td>
                                                <div class="has-hint remove cart__add" onclick="basket('<?=$item['ID']?>','deffer')">
                                                    <svg class="svg" width="23" height="18" viewBox="0 0 23 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M21.7756 2.4C21.5464 2.2 21.2026 2.1 20.8588 2.1H5.04278L4.81356 0.9C4.81356 0.4 4.24052 0 3.66747 0H1.14609C0.458434 0 0 0.4 0 1C0 1.6 0.458434 2 1.14609 2H2.75061L4.92817 13.2V13.3C4.92817 13.4 4.92817 13.4 5.04278 13.5C5.04278 13.6 5.15739 13.6 5.15739 13.7L5.27199 13.8C5.3866 13.9 5.3866 13.9 5.50121 13.9C5.50121 13.9 5.61582 13.9 5.61582 14C5.73043 14 5.84504 14.1 6.07425 14.1H18.6812C19.3688 14.1 19.8273 13.7 19.8273 13.1C19.8273 12.5 19.3688 12.1 18.6812 12.1H6.99112L6.76191 11.1H19.7127C20.2857 11.1 20.7442 10.7 20.8588 10.2L22.0048 3.2C22.1195 2.9 22.0048 2.6 21.7756 2.4ZM19.5981 4L19.2542 6H15.1283V4H19.5981ZM13.9822 4V6H10.544V4H13.9822ZM13.9822 7V9H10.544V7H13.9822ZM9.3979 4V6H5.95965C5.84504 6 5.84504 6 5.84504 6L5.50121 4H9.3979ZM6.07425 7H9.51251V9H6.41808L6.07425 7ZM15.1283 9V7H19.025L18.6812 9H15.1283Z" fill="white"/>
                                                        <path d="M7.79335 18C8.7428 18 9.51248 17.3284 9.51248 16.5C9.51248 15.6716 8.7428 15 7.79335 15C6.8439 15 6.07422 15.6716 6.07422 16.5C6.07422 17.3284 6.8439 18 7.79335 18Z" fill="white"/>
                                                        <path d="M18.1098 18C19.0592 18 19.8289 17.3284 19.8289 16.5C19.8289 15.6716 19.0592 15 18.1098 15C17.1603 15 16.3906 15.6716 16.3906 16.5C16.3906 17.3284 17.1603 18 18.1098 18Z" fill="white"/>
                                                    </svg>

<!--                                                    <img class="svg" src="--><?//=SITE_TEMPLATE_PATH?><!--/img/icon/cart.svg" width="16">-->
                                                    <div class="cloud">
                                                        <span class="rg">В корзину</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <b class="has-hint remove" onclick="basket('<?=$item['ID']?>','delete')">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 21.9 21.9" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                         enable-background="new 0 0 21.9 21.9">
                                                        <path d="M14.1,11.3c-0.2-0.2-0.2-0.5,0-0.7l7.5-7.5c0.2-0.2,0.3-0.5,0.3-0.7s-0.1-0.5-0.3-0.7l-1.4-1.4C20,0.1,19.7,0,19.5,0  c-0.3,0-0.5,0.1-0.7,0.3l-7.5,7.5c-0.2,0.2-0.5,0.2-0.7,0L3.1,0.3C2.9,0.1,2.6,0,2.4,0S1.9,0.1,1.7,0.3L0.3,1.7C0.1,1.9,0,2.2,0,2.4  s0.1,0.5,0.3,0.7l7.5,7.5c0.2,0.2,0.2,0.5,0,0.7l-7.5,7.5C0.1,19,0,19.3,0,19.5s0.1,0.5,0.3,0.7l1.4,1.4c0.2,0.2,0.5,0.3,0.7,0.3  s0.5-0.1,0.7-0.3l7.5-7.5c0.2-0.2,0.5-0.2,0.7,0l7.5,7.5c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3l1.4-1.4c0.2-0.2,0.3-0.5,0.3-0.7  s-0.1-0.5-0.3-0.7L14.1,11.3z" fill="#ff7676"/>
                                                    </svg>
                                                    <div class="cloud">
                                                        <span class="rg">Удалить</span>
                                                    </div>
                                                </b>
                                            </td>
                                        </tr>
                                        <?if($item['PROPERTY_DISCOUNT_KIT_ACTIV_VALUE'] || $item['PROPERTY_GIFT_SET_ACTIV_VALUE']){?>
                                            <tr class="cart__offer" style="display: none;">
                                                <td style="padding-top: 0;"></td>
                                                <td colspan="4" style="padding-top: 0;">
                                                    <?if($item['PROPERTY_DISCOUNT_KIT_ACTIV_VALUE']){?>
                                                        <div class="item__discount neon <?if(count($item['KIT_ITEMS'])>=2){echo 'four-items';}?>">
                                                            <h2 class="shop__title rg">Комплект со скидкой 5%</h2>
                                                            <div class="item__discount--list main_flex flex__jcontent_center clearfix">
                                                                <div class="item__discount--item">
                                                                    <img src="<? if(CFile::GetPath($item["PREVIEW_PICTURE"])) {
                                                                        echo CFile::GetPath($item["PREVIEW_PICTURE"]);
                                                                    }else{
                                                                        echo $templateFolder?>/images/no_photo.png<?}?>" alt="img">
                                                                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="bd"><?=$item['NAME']?></a>
                                                                    <div class="rg coral">Цена: <?=$item["PRICE"]?></div>
                                                                </div>
                                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol">
                                                                <?if(count($item['KIT_ITEMS'])>2){
                                                                    $ii = 2;
                                                                }else{
                                                                    $ii = count($item['KIT_ITEMS']);
                                                                }
                                                                $p=0;
                                                                foreach ($item['KIT_ITEMS'] as $KIT_ITEM){
                                                                    if($p<2){?>
                                                                        <div class="item__discount--item">
                                                                            <?if(CFile::GetPath($KIT_ITEM["PREVIEW_PICTURE"])){?>
                                                                                <img src="<?=CFile::GetPath($KIT_ITEM["PREVIEW_PICTURE"])?>">
                                                                            <?}else{?>
                                                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                                                                            <?}?>
                                                                            <a href="<?=SITE_DIR.$KIT_ITEM['IBLOCK_TYPE_ID']."/".$KIT_ITEM['DETAIL_PAGE_URL']?>" class="bd"><?=$KIT_ITEM["NAME"]?></a>
                                                                            <div class="rg coral">Цена: <?=$KIT_ITEM["CATALOG_PRICE_1"]?></div>
                                                                        </div>
                                                                        <?if($ii!=1){?><img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol"><?}
                                                                        $ii--;
                                                                        $price_komplect+=$KIT_ITEM["CATALOG_PRICE_1"];?>
                                                                    <?}
                                                                    $p++;?>
                                                                <?}?>
                                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/equals-symbol.svg" width="26" class="symbol">
                                                                <div class="num_bottom">
                                                                    <div class="bg-price"><? echo ($item["PRICE"]+$price_komplect)*0.95;?> <span>руб.</span></div>
                                                                    <div class="rg coral mb-1">Цена: <span><? echo $item["PRICE"]+$price_komplect;?></span></div>
                                                                    <div class="rg green">Экономия: <? echo ($item["PRICE"]+$price_komplect)*0.05;?> руб.</div>
                                                                    <input type="hidden" name="komplekt" value="<? echo ($item["PRICE"]+$price_komplect)*0.95;?>"/>
                                                                </div>
                                                            </div>
                                                            <button class="bd avalaible-is" onclick="addBasket('<?=$item["PRODUCT_ID"]?>','KOM','<?=$item["ID"]?>');">Купить комплект</button>
                                                        </div>
                                                    <?}?>
                                                    <?if(!$item['PROPERTY_DISCOUNT_KIT_ACTIV_VALUE'] && $item['PROPERTY_GIFT_SET_ACTIV_VALUE']){?>
                                                        <div class="item__discount neon four-items complect-gift">
                                                            <h2 class="shop__title rg">Комплект с подарком</h2>
                                                            <div class="item__discount--list main_flex flex__jcontent_center clearfix">
                                                                <div class="item__discount--item">
                                                                    <img src="<? if(CFile::GetPath($item["PREVIEW_PICTURE"])) {
                                                                        echo CFile::GetPath($item["PREVIEW_PICTURE"]);
                                                                    }else{
                                                                        echo $templateFolder?>/images/no_photo.png<?}?>" alt="img">
                                                                    <a href="<?=$item['DETAIL_PAGE_URL']?>" class="bd"><?=$item['NAME']?></a>
                                                                    <div class="rg coral">Цена: <?=$item["PRICE"]?></div>
                                                                </div>
                                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol">
                                                                <?if(count($item['PRODUCT_GIFT'])>2){
                                                                    $ii = 2;
                                                                }else{
                                                                    $ii = count($item['PRODUCT_GIFT']);
                                                                }
                                                                $p=0;
                                                                foreach ($item['PRODUCT_GIFT'] as $PRODUCT_GIFT){
                                                                    if($p<2){?>
                                                                        <div class="item__discount--item">
                                                                            <?if(CFile::GetPath($PRODUCT_GIFT["PREVIEW_PICTURE"])){?>
                                                                                <img src="<?=CFile::GetPath($PRODUCT_GIFT["PREVIEW_PICTURE"])?>">
                                                                            <?}else{?>
                                                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                                                                            <?}?>
                                                                            <a href="<?=SITE_DIR.$PRODUCT_GIFT['IBLOCK_TYPE_ID']."/".$PRODUCT_GIFT['DETAIL_PAGE_URL']?>" class="bd"><?=$PRODUCT_GIFT["NAME"]?></a>
                                                                            <div class="rg coral">Цена: <?=$PRODUCT_GIFT["CATALOG_PRICE_1"]?></div>
                                                                        </div>
                                                                        <?if($ii!=1){?><img src="<?=SITE_TEMPLATE_PATH?>/img/icon/plus-black-symbol.svg" width="26" class="symbol"><?}
                                                                        $ii--;
                                                                        $price_podarok+=$PRODUCT_GIFT["CATALOG_PRICE_1"];?>
                                                                    <?}
                                                                    $p++;?>
                                                                <?}?>
                                                                <img src="<?=SITE_TEMPLATE_PATH?>/img/icon/equals-symbol.svg" width="26" class="symbol">
                                                                <div class="item__discount--item four-item four-item__cart">
                                                                    <div class="four-item__wrap">
                                                                        <?if(CFile::GetPath($item['PODAROK']["PREVIEW_PICTURE"])){?>
                                                                            <img src="<?=CFile::GetPath($item['PODAROK']["PREVIEW_PICTURE"])?>">
                                                                        <?}else{?>
                                                                            <img src="<?=SITE_TEMPLATE_PATH?>/img/no_photo.png">
                                                                        <?}?>
                                                                        <p class="bd"><?=$item['PODAROK']["NAME"]?></p>
                                                                    </div>
                                                                    <div>
                                                                        <div class="free-gift">
                                                                            В подарок бесплатно
                                                                        </div>
                                                                        <div class="rg coral mb-1">
                                                                            Цена: <span><?=$item['PODAROK']["CATALOG_PRICE_1"]?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="your-price">
                                                                        <p>Ваша цена:</p>
                                                                        <? echo number_format($item["PRICE"]+$price_podarok, 2, '.',' ');?> <span>руб.</span>
                                                                        <input type="hidden" name="komplekt" value="<? echo $item["PRICE"]+$price_podarok;?>"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button class="bd avalaible-is" onclick="addBasket('<?=$item["PRODUCT_ID"]?>','POD','<?=$item["ID"]?>');">Купить комплект</button>
                                                        </div>
                                                    <?}?>
                                                </td>
                                            </tr>
                                        <?}?>
                                    </tbody>
                                    <?}?>

                                <?}?>
                            </table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script>
        $(document).ready(function() {
            $(".current__max").click( function() {
                field = "input[name=quantity" + $(this).attr("field") + "]";
                var currentVal = parseInt($(field).val());
                if ( !isNaN(currentVal)) {
                    $(field).val(currentVal + 1);
                    basket($(this).attr("field"), 'quantity');
                }
            });
            $(".current__min").click( function() {
                field = "input[name=quantity" + $(this).attr("field") + "]";
                var currentVal = parseInt($(field).val());
                if ( !isNaN(currentVal) && currentVal > 1 ) {
                    $(field).val(currentVal - 1);
                    basket($(this).attr("field"), 'quantity');
                }
            });
            $("input[name=quantity" + $('.current__min').attr("field") + "]").on('input', function(e) {
                if(e.target.value.length>0){
                    setTimeout(function(){basket ($('.current__min').attr("field"), 'quantity');},  1500);
                }
            });
            $('#step-1 .toggler').click(function(){
                $(this).toggleClass('active');
                $(this).parents('tr').next('.cart__offer').slideToggle('slow');
            });
        });
    </script>

	<?
	if (!empty($arResult['CURRENCIES']) && Main\Loader::includeModule('currency'))
	{
		CJSCore::Init('currency');

		?>
		<script>
			BX.Currency.setCurrencies(<?=CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true)?>);
		</script>
		<?
	}

	$signer = new \Bitrix\Main\Security\Sign\Signer;
	$signedTemplate = $signer->sign($templateName, 'sale.basket.basket');
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.basket.basket');
	$messages = Loc::loadLanguageFile(__FILE__);
	?>
	<script>
		BX.message(<?=CUtil::PhpToJSObject($messages)?>);
		BX.Sale.BasketComponent.init({
			result: <?=CUtil::PhpToJSObject($arResult, false, false, true)?>,
			params: <?=CUtil::PhpToJSObject($arParams)?>,
			template: '<?=CUtil::JSEscape($signedTemplate)?>',
			signedParamsString: '<?=CUtil::JSEscape($signedParams)?>',
			siteId: '<?=CUtil::JSEscape($component->getSiteId())?>',
			siteTemplateId: '<?=CUtil::JSEscape($component->getSiteTemplateId())?>',
			templateFolder: '<?=CUtil::JSEscape($templateFolder)?>'
		});
	</script>
	<?
}
elseif ($arResult['EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	ShowError($arResult['ERROR_MESSAGE']);
}