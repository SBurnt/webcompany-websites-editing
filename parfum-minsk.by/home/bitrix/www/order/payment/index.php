<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?$APPLICATION->SetTitle("Оплата заказа");?>
<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.payment",
	"",
	Array(
	)
);?>
<?
if(isset($_GET["back"])) {
    echo "Вы отменили заказ!";
    exit();
}
if(isset($_GET["ORDER_ID"])) {
    $APPLICATION->IncludeComponent("bitrix:sale.order.payment","",Array("PAY_SYSTEM_ID" => "7"));
    exit();
}
if(isset($_GET["fail"])) {
    $APPLICATION->IncludeComponent("begateway:transaction.info","fail",Array("PAY_SYSTEM_ID_NEW" => "7"));
    exit();
}
if(isset($_GET["success"])) {
    $APPLICATION->IncludeComponent("begateway:transaction.info","success",Array("PAY_SYSTEM_ID_NEW" => "7"));
    exit();
}
if(isset($_GET["error"])) {
    echo "Ошибка при оформлении заказа!";
    exit();
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>