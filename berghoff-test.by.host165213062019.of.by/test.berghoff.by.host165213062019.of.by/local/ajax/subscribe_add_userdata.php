<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

if(isset($_SESSION['subscremail'])) $EMAIL = $_SESSION['subscremail'];
    elseif($APPLICATION->get_cookie('subscremail')) $EMAIL = $APPLICATION->get_cookie('subscremail');
if($EMAIL){
    CModule::IncludeModule("subscribe");
    $subscr = CSubscription::GetList(["ID"=>"ASC"], ["EMAIL"=>$EMAIL]);
    $arSubscr = $subscr->Fetch();
    if($_REQUEST["success-subscribe-name"] && $arSubscr["ID"]){
        $el = new CIBlockElement;
        $PROPS = [
                "91" => $_REQUEST["success-subscribe-name"],
                "92" => $_REQUEST["success-subscribe-city"],
                "93" => $_REQUEST["success-subscribe-birthday"],
                "94" => $_REQUEST["success-subscribe-birthmonth"],
                "95" => $arSubscr["ID"],
            ];
        $arLoadProductArray = Array(
            "MODIFIED_BY"    => 1,
            "IBLOCK_SECTION_ID" => false,
            "IBLOCK_ID"      => 16,
            "PROPERTY_VALUES"=> $PROPS,
            "NAME"           => "Подписчик ID:".$arSubscr["ID"],
            "ACTIVE"         => "Y",
            "PREVIEW_TEXT"   => "Данные подписчика ".$EMAIL,
        );
        $el->Add($arLoadProductArray);
    }
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>