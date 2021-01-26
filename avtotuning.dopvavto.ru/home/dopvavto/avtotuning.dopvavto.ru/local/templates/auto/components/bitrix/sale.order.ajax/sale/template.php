<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var CMain $APPLICATION
 * @var CUser $USER
 * @var SaleOrderAjax $component
 * @var string $templateFolder
 */

$context = Main\Application::getInstance()->getContext();
$request = $context->getRequest();

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
	if (!is_file(Main\Application::getDocumentRoot().'/bitrix/css/main/themes/'.$arParams['TEMPLATE_THEME'].'/style.css'))
	{
		$arParams['TEMPLATE_THEME'] = 'blue';
	}
}

$arParams['ALLOW_USER_PROFILES'] = $arParams['ALLOW_USER_PROFILES'] === 'Y' ? 'Y' : 'N';
$arParams['SKIP_USELESS_BLOCK'] = $arParams['SKIP_USELESS_BLOCK'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['SHOW_ORDER_BUTTON']))
{
	$arParams['SHOW_ORDER_BUTTON'] = 'final_step';
}

$arParams['HIDE_ORDER_DESCRIPTION'] = isset($arParams['HIDE_ORDER_DESCRIPTION']) && $arParams['HIDE_ORDER_DESCRIPTION'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_TOTAL_ORDER_BUTTON'] = $arParams['SHOW_TOTAL_ORDER_BUTTON'] === 'Y' ? 'Y' : 'N';
$arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] = $arParams['SHOW_PAY_SYSTEM_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_PAY_SYSTEM_INFO_NAME'] = $arParams['SHOW_PAY_SYSTEM_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_LIST_NAMES'] = $arParams['SHOW_DELIVERY_LIST_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_INFO_NAME'] = $arParams['SHOW_DELIVERY_INFO_NAME'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_DELIVERY_PARENT_NAMES'] = $arParams['SHOW_DELIVERY_PARENT_NAMES'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_STORES_IMAGES'] = $arParams['SHOW_STORES_IMAGES'] === 'N' ? 'N' : 'Y';

if (!isset($arParams['BASKET_POSITION']) || !in_array($arParams['BASKET_POSITION'], array('before', 'after')))
{
	$arParams['BASKET_POSITION'] = 'after';
}

$arParams['EMPTY_BASKET_HINT_PATH'] = isset($arParams['EMPTY_BASKET_HINT_PATH']) ? (string)$arParams['EMPTY_BASKET_HINT_PATH'] : '/';
$arParams['SHOW_BASKET_HEADERS'] = $arParams['SHOW_BASKET_HEADERS'] === 'Y' ? 'Y' : 'N';
$arParams['HIDE_DETAIL_PAGE_URL'] = isset($arParams['HIDE_DETAIL_PAGE_URL']) && $arParams['HIDE_DETAIL_PAGE_URL'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERY_FADE_EXTRA_SERVICES'] = $arParams['DELIVERY_FADE_EXTRA_SERVICES'] === 'Y' ? 'Y' : 'N';

$arParams['SHOW_COUPONS'] = isset($arParams['SHOW_COUPONS']) && $arParams['SHOW_COUPONS'] === 'N' ? 'N' : 'Y';

if ($arParams['SHOW_COUPONS'] === 'N')
{
	$arParams['SHOW_COUPONS_BASKET'] = 'N';
	$arParams['SHOW_COUPONS_DELIVERY'] = 'N';
	$arParams['SHOW_COUPONS_PAY_SYSTEM'] = 'N';
}
else
{
	$arParams['SHOW_COUPONS_BASKET'] = isset($arParams['SHOW_COUPONS_BASKET']) && $arParams['SHOW_COUPONS_BASKET'] === 'N' ? 'N' : 'Y';
	$arParams['SHOW_COUPONS_DELIVERY'] = isset($arParams['SHOW_COUPONS_DELIVERY']) && $arParams['SHOW_COUPONS_DELIVERY'] === 'N' ? 'N' : 'Y';
	$arParams['SHOW_COUPONS_PAY_SYSTEM'] = isset($arParams['SHOW_COUPONS_PAY_SYSTEM']) && $arParams['SHOW_COUPONS_PAY_SYSTEM'] === 'N' ? 'N' : 'Y';
}

$arParams['SHOW_NEAREST_PICKUP'] = $arParams['SHOW_NEAREST_PICKUP'] === 'Y' ? 'Y' : 'N';
$arParams['DELIVERIES_PER_PAGE'] = isset($arParams['DELIVERIES_PER_PAGE']) ? intval($arParams['DELIVERIES_PER_PAGE']) : 9;
$arParams['PAY_SYSTEMS_PER_PAGE'] = isset($arParams['PAY_SYSTEMS_PER_PAGE']) ? intval($arParams['PAY_SYSTEMS_PER_PAGE']) : 9;
$arParams['PICKUPS_PER_PAGE'] = isset($arParams['PICKUPS_PER_PAGE']) ? intval($arParams['PICKUPS_PER_PAGE']) : 5;
$arParams['SHOW_PICKUP_MAP'] = $arParams['SHOW_PICKUP_MAP'] === 'N' ? 'N' : 'Y';
$arParams['SHOW_MAP_IN_PROPS'] = $arParams['SHOW_MAP_IN_PROPS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_YM_GOALS'] = $arParams['USE_YM_GOALS'] === 'Y' ? 'Y' : 'N';
$arParams['USE_ENHANCED_ECOMMERCE'] = isset($arParams['USE_ENHANCED_ECOMMERCE']) && $arParams['USE_ENHANCED_ECOMMERCE'] === 'Y' ? 'Y' : 'N';
$arParams['DATA_LAYER_NAME'] = isset($arParams['DATA_LAYER_NAME']) ? trim($arParams['DATA_LAYER_NAME']) : 'dataLayer';
$arParams['BRAND_PROPERTY'] = isset($arParams['BRAND_PROPERTY']) ? trim($arParams['BRAND_PROPERTY']) : '';

$useDefaultMessages = !isset($arParams['USE_CUSTOM_MAIN_MESSAGES']) || $arParams['USE_CUSTOM_MAIN_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_BLOCK_NAME']))
{
	$arParams['MESS_AUTH_BLOCK_NAME'] = Loc::getMessage('AUTH_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REG_BLOCK_NAME']))
{
	$arParams['MESS_REG_BLOCK_NAME'] = Loc::getMessage('REG_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BASKET_BLOCK_NAME']))
{
	$arParams['MESS_BASKET_BLOCK_NAME'] = Loc::getMessage('BASKET_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_BLOCK_NAME']))
{
	$arParams['MESS_REGION_BLOCK_NAME'] = Loc::getMessage('REGION_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAYMENT_BLOCK_NAME']))
{
	$arParams['MESS_PAYMENT_BLOCK_NAME'] = Loc::getMessage('PAYMENT_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_BLOCK_NAME']))
{
	$arParams['MESS_DELIVERY_BLOCK_NAME'] = Loc::getMessage('DELIVERY_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BUYER_BLOCK_NAME']))
{
	$arParams['MESS_BUYER_BLOCK_NAME'] = Loc::getMessage('BUYER_BLOCK_NAME_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_BACK']))
{
	$arParams['MESS_BACK'] = Loc::getMessage('BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FURTHER']))
{
	$arParams['MESS_FURTHER'] = Loc::getMessage('FURTHER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_EDIT']))
{
	$arParams['MESS_EDIT'] = Loc::getMessage('EDIT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER']))
{
	$arParams['MESS_ORDER'] = $arParams['~MESS_ORDER'] = Loc::getMessage('ORDER_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PRICE']))
{
	$arParams['MESS_PRICE'] = Loc::getMessage('PRICE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERIOD']))
{
	$arParams['MESS_PERIOD'] = Loc::getMessage('PERIOD_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_BACK']))
{
	$arParams['MESS_NAV_BACK'] = Loc::getMessage('NAV_BACK_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NAV_FORWARD']))
{
	$arParams['MESS_NAV_FORWARD'] = Loc::getMessage('NAV_FORWARD_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ADDITIONAL_MESSAGES']) || $arParams['USE_CUSTOM_ADDITIONAL_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRICE_FREE']))
{
	$arParams['MESS_PRICE_FREE'] = Loc::getMessage('PRICE_FREE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ECONOMY']))
{
	$arParams['MESS_ECONOMY'] = Loc::getMessage('ECONOMY_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGISTRATION_REFERENCE']))
{
	$arParams['MESS_REGISTRATION_REFERENCE'] = Loc::getMessage('REGISTRATION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_1']))
{
	$arParams['MESS_AUTH_REFERENCE_1'] = Loc::getMessage('AUTH_REFERENCE_1_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_2']))
{
	$arParams['MESS_AUTH_REFERENCE_2'] = Loc::getMessage('AUTH_REFERENCE_2_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_AUTH_REFERENCE_3']))
{
	$arParams['MESS_AUTH_REFERENCE_3'] = Loc::getMessage('AUTH_REFERENCE_3_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ADDITIONAL_PROPS']))
{
	$arParams['MESS_ADDITIONAL_PROPS'] = Loc::getMessage('ADDITIONAL_PROPS_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_USE_COUPON']))
{
	$arParams['MESS_USE_COUPON'] = Loc::getMessage('USE_COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_COUPON']))
{
	$arParams['MESS_COUPON'] = Loc::getMessage('COUPON_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PERSON_TYPE']))
{
	$arParams['MESS_PERSON_TYPE'] = Loc::getMessage('PERSON_TYPE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PROFILE']))
{
	$arParams['MESS_SELECT_PROFILE'] = Loc::getMessage('SELECT_PROFILE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_REGION_REFERENCE']))
{
	$arParams['MESS_REGION_REFERENCE'] = Loc::getMessage('REGION_REFERENCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PICKUP_LIST']))
{
	$arParams['MESS_PICKUP_LIST'] = Loc::getMessage('PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_NEAREST_PICKUP_LIST']))
{
	$arParams['MESS_NEAREST_PICKUP_LIST'] = Loc::getMessage('NEAREST_PICKUP_LIST_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SELECT_PICKUP']))
{
	$arParams['MESS_SELECT_PICKUP'] = Loc::getMessage('SELECT_PICKUP_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_INNER_PS_BALANCE']))
{
	$arParams['MESS_INNER_PS_BALANCE'] = Loc::getMessage('INNER_PS_BALANCE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_ORDER_DESC']))
{
	$arParams['MESS_ORDER_DESC'] = Loc::getMessage('ORDER_DESC_DEFAULT');
}

$useDefaultMessages = !isset($arParams['USE_CUSTOM_ERROR_MESSAGES']) || $arParams['USE_CUSTOM_ERROR_MESSAGES'] != 'Y';

if ($useDefaultMessages || !isset($arParams['MESS_PRELOAD_ORDER_TITLE']))
{
	$arParams['MESS_PRELOAD_ORDER_TITLE'] = Loc::getMessage('PRELOAD_ORDER_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_SUCCESS_PRELOAD_TEXT']))
{
	$arParams['MESS_SUCCESS_PRELOAD_TEXT'] = Loc::getMessage('SUCCESS_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_FAIL_PRELOAD_TEXT']))
{
	$arParams['MESS_FAIL_PRELOAD_TEXT'] = Loc::getMessage('FAIL_PRELOAD_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TITLE']))
{
	$arParams['MESS_DELIVERY_CALC_ERROR_TITLE'] = Loc::getMessage('DELIVERY_CALC_ERROR_TITLE_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_DELIVERY_CALC_ERROR_TEXT']))
{
	$arParams['MESS_DELIVERY_CALC_ERROR_TEXT'] = Loc::getMessage('DELIVERY_CALC_ERROR_TEXT_DEFAULT');
}

if ($useDefaultMessages || !isset($arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']))
{
	$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR'] = Loc::getMessage('PAY_SYSTEM_PAYABLE_ERROR_DEFAULT');
}

$scheme = $request->isHttps() ? 'https' : 'http';
$this->addExternalJs($templateFolder.'/order_ajax.js');
\Bitrix\Sale\PropertyValueCollection::initJs();
$this->addExternalJs($templateFolder.'/script.js');
?>
	<NOSCRIPT>
		<div style="color:red"><?=Loc::getMessage('SOA_NO_JS')?></div>
	</NOSCRIPT>
<?

if (strlen($request->get('ORDER_ID')) > 0)
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/confirm.php');
}
elseif ($arParams['DISABLE_BASKET_REDIRECT'] === 'Y' && $arResult['SHOW_EMPTY_BASKET'])
{
	include(Main\Application::getDocumentRoot().$templateFolder.'/empty.php');
}
else
{
	Main\UI\Extension::load('phone_auth');
	$hideDelivery = empty($arResult['DELIVERY']);
    session_start();
//    pr($arResult);
	?>
    <h2 class="shop__title category rg">Оформление заказа</h2>
<!--	<form action="--><?//=POST_FORM_ACTION_URI?><!--" method="POST" name="ORDER_FORM" id="bx-soa-order-form" enctype="multipart/form-data">-->
	<form action="https://securesandbox.webpay.by/" method="POST" name="ORDER_FORM" id="bx-soa-order-form" enctype="multipart/form-data">
		<?
		echo bitrix_sessid_post();
        $wsb_seed = 1242649174;
        $wsb_storeid = 914014988;
        $wsb_test = 1;
        $wsb_currency_id = "BYN";
        $db_sales = CSaleOrder::GetList(array(), false);
        while ($ar_sales = $db_sales->Fetch())
        {
            $ids[] = $ar_sales['ID'];
        }
        $wsb_order_num =  $ids[count($ids)-1]+1;
        $SecretKey = "avtotuning-2";
        $wsb_total = $arResult['ORDER_DATA']['ORDER_PRICE'];

		?>
        <input type="hidden" name="*scart">
        <input type="hidden" name="wsb_version" value="2">
        <input type="hidden" name="wsb_storeid" value="<?=$wsb_storeid?>">
        <input type="hidden" name="wsb_test" value="<?=$wsb_test?>">
        <input type="hidden" name="wsb_currency_id" value="<?=$wsb_currency_id?>">
        <input type="hidden" name="wsb_seed" value="<?=$wsb_seed?>">
        <input type="hidden" name="wsb_return_url"
               value="<?=((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'].'/personal/cart/make/?ORDER_ID='.$wsb_order_num?>">
        <input type="hidden" name="wsb_order_num" value="<?=$wsb_order_num?>">
        <?foreach ($arResult['BASKET_ITEMS'] as $key_items => $items){?>
            <input type="hidden" name="wsb_invoice_item_name[<?=$key_items?>]" value="<?=$items['NAME']?>">
            <input type="hidden" name="wsb_invoice_item_quantity[<?=$key_items?>]" value="<?=$items['QUANTITY']?>">
            <input type="hidden" name="wsb_invoice_item_price[<?=$key_items?>]" value="<?=$items['BASE_PRICE']?>">
        <?}?>
        <input type="hidden" name="wsb_total" value="<?=$wsb_total?>">
        <?
        $wsb_signature = sha1($wsb_seed.$wsb_storeid.$wsb_order_num.$wsb_test.$wsb_currency_id.$wsb_total.
             $SecretKey);
       ?>
        <input type="hidden" name="wsb_signature" value="<?=$wsb_signature?>">

		<input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="saveOrderAjax">
		<input type="hidden" name="location_type" value="code">
		<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult['BUYER_STORE']?>">
<!--        <div id="bx-soa-order" style="opacity: 1">-->
            <div class="checkout-block">
                <div class="checkout-title">
                    Тип покупателя
                </div>
                <div class="checkout-buttons">
                    <?foreach ($arResult['PERSON_TYPE'] as $key => $PERSON_TYPE){?>
                        <a href="#" class="item__list--link" data-target="#ways-block">
                            <label class="checkcontainer ways-nav <? if($key==1){echo 'physical-nav';}else{echo 'juridical-nav';}?>"><?=$PERSON_TYPE['NAME']?>
                                <input type="radio" name="PERSON_TYPE" value="<?=$PERSON_TYPE['ID']?>">
                                <span class="radiobtn"></span>
                            </label>
                        </a>
                    <?}?>
                </div>
            </div>
            <div class="checkout-block ways-block" id="ways-block">
                <div class="checkout-title">
                    Способ доставки
                </div>
                <div class="checkout-buttons">
                    <div class="subtitle">
                        Доставка по Минску
                    </div>
                    <?foreach ($arResult['DELIVERY'] as $DELIVERY){?>
                        <?if($DELIVERY['ID'] == 3 || $DELIVERY['ID'] == 10){?>
                            <div class="checkout-elements">
                                <a href="#" class="item__list--link" data-target="#payment-method">
                                    <label class="checkcontainer payment-nav"><?=$DELIVERY['NAME']?>
                                        <input id="ID_DELIVERY_ID_<?=$DELIVERY['ID']?>" name="DELIVERY_ID" type="radio" value="<?=$DELIVERY['ID']?>" onclick="delivery5('ID_DELIVERY_ID_5'); deliveryID('<?=$DELIVERY['ID']?>','<?=$arResult['ORDER_DATA']['ORDER_PRICE']?>');">
                                        <span class="radiobtn"></span>
                                    </label>
                                </a>
                                <div class="info-block">
                                    <p class="price">Стоимость:
                                        <span><?if($DELIVERY['PRICE'] == 0) {echo 'бесплатно';}else{echo $DELIVERY['PRICE'].' '.$DELIVERY['CURRENCY'];}?></span>
                                    </p>
                                    <ul>
                                        <li>
                                            <?=$DELIVERY['DESCRIPTION']?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        <?}?>
                    <?}?>
                </div>
                <div class="checkout-buttons">
                    <div class="subtitle">
                        Самовывоз
                    </div>
                    <div class="checkout-elements">
                        <label class="checkcontainer payment-nav pickup-nav item__list--link" data-target="#pickup-block"><?=$arResult['DELIVERY'][5]['NAME']?>
                            <input id="ID_DELIVERY_ID_<?=$arResult['DELIVERY'][5]['ID']?>" class='ID_DELIVERY_ID_<?=$arResult['DELIVERY'][5]['ID']?>' name="DELIVERY_ID" type="radio" onclick="delivery5(this); deliveryID('<?=$arResult['DELIVERY'][5]['ID']?>','<?=$arResult['ORDER_DATA']['ORDER_PRICE']?>');" value="5">
                            <span class="radiobtn"></span>
                        </label>
                        <div class="info-block">
                            <p class="price">Стоимость:
                                <span>бесплатно</span>
                            </p>
                            <?=$arResult['DELIVERY'][5]['DESCRIPTION']?>
                        </div>
                    </div>
                </div>
                <div class="checkout-buttons">
                    <div class="subtitle">
                        Доставка по Беларуси
                    </div>
                    <?foreach ($arResult['DELIVERY'] as $DELIVERY){?>
                        <?if($DELIVERY['ID'] == 7 || $DELIVERY['ID'] == 11 || $DELIVERY['ID'] == 12 || $DELIVERY['ID'] == 8 || $DELIVERY['ID'] == 9){?>
                            <div class="checkout-elements">
                                <a href="#" class="item__list--link" data-target="#payment-method">
                                    <label class="checkcontainer payment-nav"><?=$DELIVERY['NAME']?>
                                        <input id="ID_DELIVERY_ID_<?=$DELIVERY['ID']?>" name="DELIVERY_ID" type="radio" value="<?=$DELIVERY['ID']?>" onclick="delivery5('ID_DELIVERY_ID_5'); deliveryID('<?=$DELIVERY['ID']?>','<?=$arResult['ORDER_DATA']['ORDER_PRICE']?>');">
                                        <span class="radiobtn"></span>
                                    </label>
                                </a>
                                <div class="info-block">
                                    <p class="price">Стоимость:
                                        <span><?if(CSaleDelivery::GetByID($DELIVERY['ID'])['PRICE'] == 0){echo 'бесплатно';}else{echo CSaleDelivery::GetByID($DELIVERY['ID'])['PRICE'].' '.$DELIVERY['CURRENCY'];}?></span>
                                    </p>
                                    <?=$DELIVERY['DESCRIPTION']?>
                                </div>
                            </div>
                        <?}?>
                    <?}?>
                </div>
            </div>
            <div class="checkout-block pickup-block" id="pickup-block">
                <div class="checkout-title">
                    Самовывоз
                </div>
                <div class="map-block">
                    <p class="web-title">
                        Вам подарок!
                    </p>
                    <div id="map3"></div>
                </div>
            </div>
            <div class="checkout-block payment-element" id="payment-method">
                <div class="checkout-title">Оплата</div>
                <div class="checkout-description">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.include",
                        "",
                        Array(
                            "AREA_FILE_SHOW" => "file",
                            "AREA_FILE_SUFFIX" => "inc",
                            "EDIT_TEMPLATE" => "",
                            "PATH" => SITE_TEMPLATE_PATH."/include/payment-text.php"
                        )
                    );?>
                </div>
                <div class="paySystem checkout-buttons physical">
                <? foreach ($arResult['PAY_SYSTEM'] as $PAY_SYSTEM){?>
                    <div class="payment-block">
                        <div class="img">
                            <img src="<?=$PAY_SYSTEM['PSA_LOGOTIP']['SRC']?>" alt="">
                        </div>
                        <p><?=$PAY_SYSTEM['DESCRIPTION']?></p>
                        <div class="radio-btn">
                            <label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
                                <input id="ID_PAY_SYSTEM_ID_<?=$PAY_SYSTEM['ID']?>" name="PAY_SYSTEM_ID" type="radio" value="<?=$PAY_SYSTEM['ID']?>">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    </div>
                <?}?>
                </div>
                
                   <div class="paySystem checkout-buttons juridical">
                <? foreach ($arResult['PAY_SYSTEM'] as $PAY_SYSTEM){
                       if($PAY_SYSTEM['ID']==20){?>
                                           <div class="payment-block">
                        <div class="img">
                            <img src="<?=$PAY_SYSTEM['PSA_LOGOTIP']['SRC']?>" alt="">
                        </div>
                        <p><?=$PAY_SYSTEM['DESCRIPTION']?></p>
                        <div class="radio-btn">
                            <label class="checkcontainer customer-nav item__list--link" data-target="#customer-block">
                                <input id="ID_PAY_SYSTEM_ID_<?=$PAY_SYSTEM['ID']?>" name="PAY_SYSTEM_ID" type="radio" value="<?=$PAY_SYSTEM['ID']?>">
                                <span class="radiobtn"></span>
                            </label>
                        </div>
                    </div>
                <?}
                    else{}
       }?>
                </div>
            </div>
            <div class="checkout-block customer-block" id="customer-block">

                <div class="checkout-title">Покупатель</div>
                <div class="error_div"></div>
                <div class="checkout-buttons physical">
                    <label class="customer-element">
                        <p>ФИО<span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_1" id="soa-property-1" autocomplete="name" placeholder="" class="form-element" value="<?if($arResult['AUTH']['NAME']){echo trim($arResult['AUTH']['NAME']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>E-mail</p>
                        <input type="text" size="30" name="ORDER_PROP_2" id="soa-property-2" autocomplete="email" placeholder="" class="form-element" value="<?if($arResult['AUTH']['EMAIL']){echo trim($arResult['AUTH']['EMAIL']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>Телефон <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_3" id="soa-property-3" autocomplete="tel" placeholder="" class="form-element" value="<?if($arResult['AUTH']['PERSONAL_PHONE']){echo trim($arResult['AUTH']['PERSONAL_PHONE']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>Адрес доставки <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_4" id="soa-property-4" autocomplete="address" placeholder="" class="form-element" value="">
                    </label>
                    <label class="customer-element">
                        <p>Комментрарий к заказу</p>
                        <textarea rows="2" name="ORDER_PROP_5" id="soa-property-5" placeholder="" class="form-element"></textarea>
                    </label>
<!--                    <div class="web-total-block">-->
<!--                        --><?//if($_SESSION['SAVE']){?>
<!--                            <p class="old-price">-->
<!--                                --><?//=$_SESSION['DISCOUNT_OLD_FULL'].' BYN'?>
<!--                            </p>-->
<!--                            <p class="saving">-->
<!--                                --><?//=$_SESSION['SAVE'].' BYN'?>
<!--                            </p>-->
<!--                        --><?//}?>
<!--                        <div class="price-element small-elements">-->
<!--                            <p>Заказ</p>-->
<!--                            <div class="bordered"></div>-->
<!--                            <span>--><?//=$arResult['ORDER_DATA']['ORDER_PRICE']. ' '.$arResult['ORDER_DATA']['CURRENCY']?><!--</span>-->
<!--                        </div>-->
<!--                        <div class="price-element medium-elements">-->
<!--                            <p>Доставка</p>-->
<!--                            <div class="bordered"></div>-->
<!--                            <span>--><?//=$arResult['ORDER_DATA']['PRICE_DELIVERY'].' '.$arResult['ORDER_DATA']['CURRENCY']?><!--</span>-->
<!--                        </div>-->
<!--                        <div class="price-element bold-elements">-->
<!--                            <p>ИТОГО</p>-->
<!--                            <div class="bordered"></div>-->
<!--                            <span>--><?//=$arResult['ORDER_DATA']['PRICE']. ' '.$arResult['ORDER_DATA']['CURRENCY']?><!--</span>-->
<!--                        </div>-->
<!--                        <div class="buttons-element">-->
<!--                            <button class="web-dotted-btn">вернуться</button>-->
<!--                            <button class="web-main-btn">продолжить...</button>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
                <div class="checkout-buttons juridical">
                    <label class="customer-element">
                        <p>Название организации <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_6" id="soa-property-6" placeholder="" class="form-element" value="<?if($arResult['AUTH']['NAME_COMPANY']){echo trim($arResult['AUTH']['NAME_COMPANY']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>Юридический адрес <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_7" id="soa-property-7" placeholder="" class="form-element" value="<?if($arResult['AUTH']['UR_ADDRESS']){echo trim($arResult['AUTH']['UR_ADDRESS']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>УНП <span>*</span></p>
                        <input type="text" name="ORDER_PROP_8" size="5" id="soa-property-8" placeholder="" class="form-element" value="<?if($arResult['AUTH']['UNP']){echo trim($arResult['AUTH']['UNP']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>Банковские реквизиты <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_9" id="soa-property-9" placeholder="" class="form-element" value="<?if($arResult['AUTH']['BANK']){echo trim($arResult['AUTH']['BANK']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>Контактное лицо <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_10" id="soa-property-10" placeholder="" class="form-element" value="<?if($arResult['AUTH']['CONTACT']){echo trim($arResult['AUTH']['CONTACT']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>E-mail</p>
                        <input type="text" size="30" name="ORDER_PROP_11" id="soa-property-11" autocomplete="email" placeholder="" class="form-element" value="<?if($arResult['AUTH']['EMAIL']){echo trim($arResult['AUTH']['EMAIL']);}?>">
                    </label>
                    <label class="customer-element">
                        <p>Телефон <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_12" id="soa-property-12" autocomplete="tel" placeholder="" class="form-element" value="<?if($arResult['AUTH']['PERSONAL_PHONE']){echo trim($arResult['AUTH']['PERSONAL_PHONE']);}?>">
<!--                        <textarea rows="4" name="ORDER_PROP_12" id="soa-property-12" autocomplete="tel" placeholder="" class="form-element" value="">--><?//if($arResult['AUTH']['PERSONAL_PHONE']){echo trim($arResult['AUTH']['PERSONAL_PHONE']);}?><!--</textarea>-->
                    </label>
                    <label class="customer-element">
                        <p>Адрес доставки <span>*</span></p>
                        <input type="text" size="30" name="ORDER_PROP_13" id="soa-property-13" autocomplete="address" placeholder="" class="form-element" value="">
<!--                        <textarea rows="4" name="ORDER_PROP_13" id="soa-property-13" autocomplete="address" placeholder="" class="form-element"></textarea>-->
                    </label>
                    <label class="customer-element">
                        <p>Комментрарий к заказу</p>
                        <textarea rows="2" name="ORDER_PROP_14" id="soa-property-14" placeholder="" class="form-element"></textarea>
                    </label>

                </div>
                <div class="web-total-block"></div>
            </div>

<!--		</div>-->
	</form>
<script>
   function delivery5(i){
        if(i.checked){
            $('#soa-property-4').val('Самовывоз');
            $('#soa-property-13').val('Самовывоз');
        }else{
            $('#soa-property-4').val('');
            $('#soa-property-13').val('');
        }
    }
    
    $(function() {
        $('.txt1 .all .toggler > button').click(function(){
            $(this).parent().toggleClass('active');
            $(this).parent().next('.txt-seo').slideToggle('slow');
            if ($(this).parent().hasClass('active')) {
                $(this).text('Показать меньше');
            } else {
                $(this).text('Показать больше');
            }
        });

        $('.item__list--link').click(function(e) {
            $('html, body').animate({
                scrollTop: $($(this).data('target')).offset().top - 150
            }, 200);
        });


        $('.tag > li').click(function(){
            $(this).toggleClass('active');
            $(this).parents('.order').find('div.clear').addClass('active');
        });

        $('.order__block .clear').click(function(e) {
            e.stopPropagation();
            dropdownBtn = $(".cart .order__table .dropdown .dropdown-button");
            dropdownBtn.each(function(){
                $(this).text($(this).data('text')).removeClass('active close');
            })
            $(this).parent().next('.order__table').find("input[type=checkbox]").prop('checked', false);
            $( "#slider-range" ).slider({values: [0, 870]});
            $( "#amount-min" ).val($( "#slider-range" ).slider( "values", 0 ));
            $( "#amount-max" ).val($( "#slider-range" ).slider( "values", 1 ));
            $('.tag > li').removeClass('active');
            $(this).removeClass('active');
        });

        $('.order__table .dropdown-list > li').click(function(){
            $(this).parents('.order').find('div.clear').addClass('active');
        });

        $('.order__table input').change(function(){
            $(this).parents('.order').find('div.clear').addClass('active');
        });

        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: 870,
            values: [ 0, 870 ],
            animate: true,
            step: 5,
            slide: function( event, ui ) {
                $( "#amount-min" ).val( ui.values[0]);
                $( "#amount-max" ).val( ui.values[1]);
                $(this).parents('.order').find('div.clear').addClass('active');
            }
        });

        $( "#amount-min" ).val($( "#slider-range" ).slider( "values", 0 ));
        $( "#amount-max" ).val($( "#slider-range" ).slider( "values", 1 ));

    });

</script>
	<?
	$signer = new Main\Security\Sign\Signer;
	$signedParams = $signer->sign(base64_encode(serialize($arParams)), 'sale.order.ajax');
	$messages = Loc::loadLanguageFile(__FILE__);
	if ($arParams['SHOW_PICKUP_MAP'] === 'Y' || $arParams['SHOW_MAP_IN_PROPS'] === 'Y')
	{
		if ($arParams['PICKUP_MAP_TYPE'] === 'yandex')
		{
			?>
            <script>
                    ymaps.ready(init);
                    var myMap,
                        Placemarkmain;

                    function init(){
                        myMap = new ymaps.Map("map3", {
                            center: [<?=$arResult['STORE_LIST'][1]['GPS_N']?>, <?=$arResult['STORE_LIST'][1]['GPS_S']?>],
                            zoom: 16
                        });
                        var zoomControl = new ymaps.control.ZoomControl({
                            options: {
                                size: "small",
                                position: {
                                    left: "auto",
                                    right: "40px",
                                    top: "150px"
                                }
                            }
                        });
                        myMap.controls.remove(zoomControl);
                        myMap.controls.remove('geolocationControl');
                        myMap.controls.remove('searchControl');
                        myMap.controls.remove('trafficControl');
                        myMap.controls.remove('typeSelector');
                        myMap.controls.remove('fullscreenControl');
                        myMap.controls.remove('rulerControl');
                        myMap.controls.remove('zoomControl');
                        Placemarkmain = new ymaps.Placemark([<?=$arResult['STORE_LIST'][1]['GPS_N']?>, <?=$arResult['STORE_LIST'][1]['GPS_S']?>], {}, {
                            iconLayout: 'default#image',
                            iconImageHref: '<?=SITE_TEMPLATE_PATH?>/img/pictures/map-marker.png',
                            iconImageSize: [34, 34],
                            iconImageOffset: [0, 0]
                        });
                        myMap.geoObjects.add(Placemarkmain);
                    }
            </script>
			<?
		}
	}
}