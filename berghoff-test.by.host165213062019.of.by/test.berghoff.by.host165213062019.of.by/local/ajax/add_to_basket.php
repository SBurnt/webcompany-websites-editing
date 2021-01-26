<?
use Bitrix\Sale;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");
CModule::IncludeModule("sale");
if (isset($_REQUEST['id']))$ID = intval($_REQUEST['id']);
    else $ID = 0;
if (isset($_REQUEST['quantity']))$QUANTITY = intval($_REQUEST['quantity']);
    else $QUANTITY = 1;
if($ID && $_REQUEST["actionType"] == "add")
{
    $rsProduct = CIBlockElement::GetList([], ["IBLOCK_ID"=>"4", "ID"=>$ID], false, false, ["ID", "NAME", "CATALOG_GROUP_1","DETAIL_PAGE_URL"]);
    $arProduct = $rsProduct->GetNext();
    if($arProduct["ID"])$arDiscount = CIBlockElement::GetProperty("4", $ID, [], ["CODE" => "DISCOUNT"])->Fetch();
    if($arDiscount["VALUE"]){
        $discount = preg_replace("/[^0-9]/", '', $arDiscount["VALUE"]);
        $actPrice = round($arProduct["CATALOG_PRICE_1"]*(1-$discount/100),2);
        $discountValue = $arProduct["CATALOG_PRICE_1"] - $actPrice;
        $arFields = [
            "PRODUCT_ID" => $arProduct["ID"],
            "PRODUCT_PRICE_ID" => $arProduct["CATALOG_PRICE_ID_1"],
            "PRICE" => $actPrice,
            "DISCOUNT_NAME" =>"Скидка",
            "DISCOUNT_PRICE"=>$discountValue,
            "DISCOUNT_VALUE"=>$discount,
            "CUSTOM_PRICE"=>"Y",
            "CURRENCY" => $arProduct["CATALOG_CURRENCY_1"],
            "WEIGHT" => $arProduct["CATALOG_WEIGHT"],
            "QUANTITY" => 1,
            "LID" => LANG,
            "DELAY" => "N",
            "CAN_BUY" => "Y",
            "NAME" => $arProduct["NAME"],
            "MODULE" => "catalog",
            "NOTES" => "",
            "DETAIL_PAGE_URL" => $arProduct["DETAIL_PAGE_URL"]
        ];
        CSaleBasket::Add($arFields);
    }else{
        Add2BasketByProductID($ID, $QUANTITY);
    }
}elseif($ID && $_REQUEST["actionType"] == "delete"){
    $dbBasketItems = CSaleBasket::GetList([], ["FUSER_ID" => CSaleBasket::GetBasketUserID(),"LID" => SITE_ID, "ORDER_ID" => "NULL"], false, false, ["ID", "NAME", "PRODUCT_ID"]);
    while ($arItem = $dbBasketItems->Fetch()){
        if($ID == $arItem["PRODUCT_ID"]){
            CSaleBasket::Delete($arItem["ID"]);
        }
    }
}
$BasketItems = array();
$basket = Sale\Basket::loadItemsForFUser(Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
foreach ($basket as $basketItem) {
    $BasketItems[] = $basketItem->getField('PRODUCT_ID');
    $arProduct = CIBlockElement::GetList([],["IBLOCK_ID"=>"4", "ID"=>$basketItem->getField('PRODUCT_ID')],false,false,["ID","PREVIEW_PICTURE","CATALOG_GROUP_1"])->GetNext();
//    $miniBasket[] = [
//        "ID" => $basketItem->getField('ID'),
//        "NAME" => $basketItem->getField('NAME'),
//        "QUANTITY" => $basketItem->getField('QUANTITY'),
//        "PRODUCT_ID" => $basketItem->getField('PRODUCT_ID'),
//        "DETAIL_PAGE_URL" => $basketItem->getField('DETAIL_PAGE_URL'),
//        "PRICE" => $basketItem->getField('PRICE'),
//        "OLD_PRICE" => intval($arProduct["CATALOG_PRICE_1"])>$basketItem->getField('PRICE')?intval($arProduct["CATALOG_PRICE_1"]):false,
//        "PICTURE" => $arProduct["PREVIEW_PICTURE"]?array_change_key_case(CFile::ResizeImageGet($arProduct["PREVIEW_PICTURE"], ['width'=>50, 'height'=>50], BX_RESIZE_IMAGE_PROPORTIONAL, true), CASE_UPPER):false,
//    ];
    $miniBasket[] = [
        "ID" => $basketItem->getField('ID'),
        "NAME" => $basketItem->getField('NAME'),
        "QUANTITY" => $basketItem->getField('QUANTITY'),
        "PRODUCT_ID" => $basketItem->getField('PRODUCT_ID'),
        "DETAIL_PAGE_URL" => $basketItem->getField('DETAIL_PAGE_URL'),
        "PRICE" => $basketItem->getPrice(),
//        "PRICE" => $basketItem->getField('PRICE'),
        "OLD_PRICE" => $arProduct["CATALOG_PRICE_1"]>$basketItem->getField('PRICE')?$arProduct["CATALOG_PRICE_1"]:false,
        "PICTURE" => $arProduct["PREVIEW_PICTURE"]?array_change_key_case(CFile::ResizeImageGet($arProduct["PREVIEW_PICTURE"], ['width'=>50, 'height'=>50], BX_RESIZE_IMAGE_PROPORTIONAL, true), CASE_UPPER):false,
        "PROPS" => $basketItem->getPropertyCollection()->getPropertyValues(),
    ];
}
?>
<div class="cart-top">
    <a class="summary" href="/personal/cart/">
        <span>
            <span>Корзина</span> (<?=count($BasketItems)?>)
        </span>
    </a>
</div>

<div class="details">
    <div class="details-border"></div>
    <?if($miniBasket){?>
        <ol id="cart-sidebar" class="mini-products-list">
            <?$totalPrice = 0;
            foreach($miniBasket as $bItem){
                $totalPrice += $bItem["QUANTITY"]*$bItem["PRICE"];
                ?>
                <li class="item clearfix">
                    <a href="<?=$bItem["DETAIL_PAGE_URL"]?>" title="<?=$bItem["NAME"]?>" class="product-image">
                        <?if($bItem["PICTURE"])?>
                        <img src="<?=$bItem["PICTURE"]["SRC"]?>" data-srcx2="<?=$bItem["PICTURE"]["SRC"]?>" width="50" height="50" alt="<?=$bItem["NAME"]?>">
                        <span></span>
                    </a>
                    <div class="product-details">
                        <a href="/personal/cart/?action=delete&id=<?=$bItem["ID"]?>" title="Удалить" onclick="return confirm('Вы уверены, что хотите удалить этот товар из корзины?');" class="btn-remove">Удалить</a>
                        <p class="product-name"><a href="<?=$bItem["DETAIL_PAGE_URL"]?>"><?=$bItem["NAME"]?></a></p>
                        <strong><?=floatval($bItem["QUANTITY"])?></strong> x&nbsp;<span class="price"><?=str_replace(".",",",$bItem["PRICE"])?> р.<?if($bItem["OLD_PRICE"]){?> <span class="old-price"><?=str_replace(".",",",$bItem["OLD_PRICE"])?>р.</span><?}?></span>
                    </div>
                </li>
            <?}?>
        </ol>
        <?if(false){?>
            <div class="subtotal-wrapper">
                <div class="subtotal">
                    <div class="freeshippingmessage">
                        <span>Скидка по дисконтной карте 60 р.</span>
                        <span>Скидка по промокоду 500 р.</span>
                        <span>Списано с предоплаченной карты 100 р.</span>
                    </div>

                </div>
            </div>
        <?}?>
        <div class="buttons clearfix">
            <button type="button" title="View Cart" class="button btn-continue" onclick="window.location='/personal/cart/';">
                <span><span>Корзина</span></span>
            </button>
        </div>
        <div class="totals-wrapper">
            <span class="label">Итого</span> <span class="price"><?=str_replace(".",",",$totalPrice)?> р.</span>
        </div>
    <?}else{?>
        <p class="a-center">Ваша корзина пуста.</p>
    <?}?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>