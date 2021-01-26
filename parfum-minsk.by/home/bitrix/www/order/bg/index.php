<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
if(isset($_GET["back"])) {
    echo "Вы отменили заказ!";
    exit();
}
if(isset($_GET["alert"])) {
	$mid = "7";
	if($_GET["ERIP"]) $mid = "8";
    $APPLICATION->IncludeComponent("bitrix:sale.order.payment.receive","",Array("PAY_SYSTEM_ID_NEW" => $mid));
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>