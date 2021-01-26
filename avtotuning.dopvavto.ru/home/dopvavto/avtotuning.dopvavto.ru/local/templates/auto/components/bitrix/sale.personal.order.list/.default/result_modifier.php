<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 */

foreach ($arResult['ORDERS'] as $key => $order){
    foreach ($order['BASKET_ITEMS'] as $key1 => $BASKET_ITEMS){
        $res = CIBlockElement::GetByID($BASKET_ITEMS['PRODUCT_ID']);
        $ar_res = $res->GetNext();
        $arResult['ORDERS'][$key]['BASKET_ITEMS'][$key1]['PREVIEW_PICTURE'] = $ar_res['PREVIEW_PICTURE'];
        $arResult['ORDERS'][$key]['BASKET_ITEMS'][$key1]['DETAIL_PICTURE'] = $ar_res['DETAIL_PICTURE'];
        $dbRes = \Bitrix\Sale\BasketPropertiesCollection::getList([
            'select' => ['*'],
            'filter' => [
                '=BASKET_ID' => $key1,
            ]
        ]);

        while ($item = $dbRes->fetch()) {
            if($item['VALUE'] == 'KOM'){
                $arResult['ORDERS'][$key]['BASKET_ITEMS'][$key1]['KOM'] = 'Y';
            }
        }
        $arFilter = Array("IBLOCK_ID"=>2, "ID"=>$BASKET_ITEMS['PRODUCT_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
//array('DISCOUNT_KIT_ACTIV','KIT_ITEMS','GIFT_SET_ACTIV','PRODUCT_GIFT','PODAROK'));
        $res = CIBlockElement::GetList(Array(), $arFilter);
        if ($ob = $res->GetNextElement()){
            $arProps = $ob->GetProperties(); // свойства элемента
            $arResult['ORDERS'][$key]['BASKET_ITEMS'][$key1]['PROPS_CART'] = $arProps;
        }
    }
//    pr($arProps);
    $db_props = CSaleOrderPropsValue::GetOrderProps($order['ORDER']['ID']);
    while ($arProps = $db_props->Fetch())
    {
        $arResult['ORDERS'][$key]['ORDER']['PROPS'][] = $arProps;
    }
}
