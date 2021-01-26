<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require $_SERVER["DOCUMENT_ROOT"]."/local/php_interface/ydelivery/ydelivery.php";
CModule::IncludeModule("sale");
$CityID = intval($_REQUEST["cityID"]);
$chars = htmlspecialchars($_REQUEST["chars"]);
if($chars && $CityID){
    $arLocs = CSaleLocation::GetByID($CityID, LANGUAGE_ID);
    $OptionValues = '{
        "client": {
            "id": 52306
        },
        "warehouses": [
            {
                "id": 34147,
                "name": "Горки"
            }
        ],
        "senders": [
            {
                "id": 39016,
                "name": "BERGHOFF"
            }
        ],
        "requisites": [
            {
                "id": 18805,
                "name": "ООО \"ЛЮКСТРЭЙД\""
            }
        ]
    }';
    $MethodKeys = '{
        "getPaymentMethods": "98fa9f07b9f145a7a79837ba23463ef33d354f40cca10ca36bb6b6d57049d7b0",
        "getSenderOrders": "98fa9f07b9f145a7a79837ba23463ef320fb97c30dcc8e11c890220956bff4d1",
        "getSenderOrderLabel": "98fa9f07b9f145a7a79837ba23463ef3552865598af65951847fdf7d6e9a2be9",
        "getSenderParcelDocs": "98fa9f07b9f145a7a79837ba23463ef3d166409523ebc7b5f17113bd6d293e78",
        "autocomplete": "98fa9f07b9f145a7a79837ba23463ef3a67b8e584e69453096aa0062ca74050d",
        "getIndex": "98fa9f07b9f145a7a79837ba23463ef3e6e7a77ab26e3781ec83555839d0bba6",
        "createOrder": "98fa9f07b9f145a7a79837ba23463ef366f38953c343bef5e1b685268ba8f72f",
        "updateOrder": "98fa9f07b9f145a7a79837ba23463ef375b6062df8745a8c0f264081fbecb3dc",
        "deleteOrder": "98fa9f07b9f145a7a79837ba23463ef3a5106bdf0b8fb219522caba6f7ba521b",
        "getSenderOrderStatus": "98fa9f07b9f145a7a79837ba23463ef321aa882ab7c1e37c248b44f6150c616e",
        "getSenderOrderStatuses": "98fa9f07b9f145a7a79837ba23463ef36b6bc4ecc748a33d8feea435cfdc052b",
        "getSenderInfo": "98fa9f07b9f145a7a79837ba23463ef3843fd3b61abc67402f9d2c457f6390d7",
        "getWarehouseInfo": "98fa9f07b9f145a7a79837ba23463ef39c45f843aade8e9692c02f346cbe0074",
        "getRequisiteInfo": "98fa9f07b9f145a7a79837ba23463ef324e109fcdbb47934ec705a0f61ac279e",
        "getIntervals": "98fa9f07b9f145a7a79837ba23463ef32fefa1d9917cca37d994c4a1fafdb9ca",
        "createWithdraw": "98fa9f07b9f145a7a79837ba23463ef3f8ca6aa00c9059cde7ef268247d09c0c",
        "confirmSenderOrders": "98fa9f07b9f145a7a79837ba23463ef3a727718977ca73a665dcecaa3a9c2dbf",
        "updateWithdraw": "98fa9f07b9f145a7a79837ba23463ef3ee462fa5998ac292acce65ce2e165c8c",
        "createImport": "98fa9f07b9f145a7a79837ba23463ef350bc0e78cdf3c97b76daa1d26615d2ae",
        "updateImport": "98fa9f07b9f145a7a79837ba23463ef3af2fa000d500ba20cf3d95eb2841c9f4",
        "getDeliveries": "98fa9f07b9f145a7a79837ba23463ef30900acee17e94d3faee09c3b9af86cbc",
        "getOrderInfo": "98fa9f07b9f145a7a79837ba23463ef379ecd746435174f378c9de7b3d7faf76",
        "searchDeliveryList": "98fa9f07b9f145a7a79837ba23463ef3d893969eba760ac802b09a7b2eca7559",
        "confirmSenderParcels": "98fa9f07b9f145a7a79837ba23463ef37cf6d35a2deb4b55d2a41276d3248037",
        "searchSenderOrdersStatuses": "98fa9f07b9f145a7a79837ba23463ef311ced9188e814d1d848408a483aac283",
        "getImports": "98fa9f07b9f145a7a79837ba23463ef375ff4bd14d161c6a1314e65147729f7a",
        "getWithdraws": "98fa9f07b9f145a7a79837ba23463ef3b4b527d41a74ac98a9c31d553f577f70",
        "cancelImport": "98fa9f07b9f145a7a79837ba23463ef393ca6fd67ffcadec9af5974525d7f091",
        "cancelWithdraw": "98fa9f07b9f145a7a79837ba23463ef375b8bcf71027b7a2523922ff80d5a833"
    }';
    $YSuggest = new PYDELIVERYModuleMain($MethodKeys, $OptionValues);

    $suggest = $YSuggest->autocomplete($chars, "street", $arLocs["CITY_NAME"]);

    if(is_array($suggest["data"]["suggestions"]) && !empty($suggest["data"]["suggestions"])){
        $arResult["TYPE"] = "OK";
        foreach($suggest["data"]["suggestions"] as $suggest){
            $arResult["HTML"] .= "<p>".$suggest["value"]."</p>";
        }
    }else{
        $arResult = ["TYPE"=>"ERROR", "MESSAGE"=>"empty"];
    }
}else{
    $arResult = ["TYPE"=>"ERROR", "MESSAGE"=>"uncorrect question"];
}
echo json_encode($arResult);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>