<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

$arResult = ["error" => "yes"];

if($_REQUEST["contacts-feedback-name-input"] && $_REQUEST["contacts-feedback-email-input"] && $_REQUEST["contacts-feedback-message-input"]){

    CEvent::SendImmediate
    (
       "COMPLAINT", "s1", [
          "USER_NAME" => $_REQUEST["contacts-feedback-name-input"],
          "USER_EMAIL" => $_REQUEST["contacts-feedback-email-input"],
          "COMPLAINT" => $_REQUEST["contacts-feedback-message-input"],
                ]
    );

    $arResult = ["complaint" => "yes"];
}

echo json_encode($arResult);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>