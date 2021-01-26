<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_REQUEST["ID"]){
    $ID = intval($_REQUEST["ID"]);
    if(isset($_SESSION['notification']) && is_array($_SESSION['notification'])) $arNotification = $_SESSION['notification'];
        elseif($APPLICATION->get_cookie('notification')) $arNotification = explode(";", $APPLICATION->get_cookie('notification'));
        else $arNotification=[];
    $arNotification[] = $ID;
    $_SESSION['notification'] = $arNotification;
    $APPLICATION->set_cookie("notification", implode(";", $arNotification), time()+60*60*24*30);
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>