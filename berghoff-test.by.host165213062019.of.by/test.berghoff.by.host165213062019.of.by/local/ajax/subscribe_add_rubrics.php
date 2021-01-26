<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

if(isset($_SESSION['subscremail'])) $EMAIL = $_SESSION['subscremail'];
    elseif($APPLICATION->get_cookie('subscremail')) $EMAIL = $APPLICATION->get_cookie('subscremail');
if($EMAIL){
    CModule::IncludeModule("subscribe");
    $subscr = CSubscription::GetList(["ID"=>"ASC"], ["EMAIL"=>$EMAIL]);
    $arSubscr = $subscr->Fetch();
    if($arSubscr["ID"] && $_REQUEST["sf_RUB_ID"]){
        if($_REQUEST["sf_RUB_ID"] && is_array($_REQUEST["sf_RUB_ID"])){
            $obSubscr = new CSubscription;
            $obSubscr->Update($arSubscr["ID"], ["RUB_ID"=>$_REQUEST["sf_RUB_ID"]]);
        }
    }
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>