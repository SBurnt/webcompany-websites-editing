<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

/**
 * @var array $arParams
 * @var array $arResult
 */

foreach ($arResult["CATEGORIES"] as  $order) {
    foreach ($order as $key => $v) {
        $res = CIBlockElement::GetByID($v['PRODUCT_ID']);
        $ar_res = $res->GetNext();
        $arResult['CATEGORIES']['READY'][$key]['PREVIEW_PICTURE'] = CFile::GetPath($ar_res['PREVIEW_PICTURE']);
        $arResult['CATEGORIES']['READY'][$key]['PICTURE_SRC'] = CFile::GetPath($ar_res['PREVIEW_PICTURE']);
        $dbRes = \Bitrix\Sale\BasketPropertiesCollection::getList([
            'select' => ['*'],
            'filter' => [
                '=BASKET_ID' => $v['ID'],
            ]
        ]);

        while ($item = $dbRes->fetch()) {
            if ($item['VALUE'] == 'KOM') {
                $arResult['CATEGORIES']['READY'][$key]['KOM'] = 'Y';
            }
        }
        $arFilter = Array("IBLOCK_ID"=>2, "ID"=>$v['PRODUCT_ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
//array('DISCOUNT_KIT_ACTIV','KIT_ITEMS','GIFT_SET_ACTIV','PRODUCT_GIFT','PODAROK'));
        $res = CIBlockElement::GetList(Array(), $arFilter);
        if ($ob = $res->GetNextElement()){
            $arProps = $ob->GetProperties(); // свойства элемента
            $arResult['CATEGORIES']['READY'][$key]['PROPS_CART'] = $arProps;
        }

    }
//    $db_props = CSaleOrderPropsValue::GetOrderProps($order['ORDER']['ID']);
//    while ($arProps = $db_props->Fetch())
//    {
//        $arResult['CATEGORIES']['READY'][$key]['PROPS'][] = $arProps;
//    }
}
