<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle(""); ?><?$APPLICATION->IncludeComponent(
    "nextype:forms",
    "popup",
    Array(
        "CAPTHCA" => "N",
        "DECODE_FIELDNAME" => "Y",
        "FIELDS" => "W3sibGFiZWwiOiLQmtCw0Log0LLQsNGBINC30L7QstGD0YI/IiwibmFtZSI6Ik5BTUUiLCJ0eXBlIjoidGV4dCIsInJlcXVpcmVkIjoiWSIsImRlZmF1bHQiOiIiLCJ2YWx1ZXMiOiIiLCJtYXNrIjoiIn0seyJsYWJlbCI6ItCa0L7QvdGC0LDQutGC0L3Ri9C5INGC0LXQu9C10YTQvtC9IiwibmFtZSI6IlBIT05FIiwidHlwZSI6InRleHQiLCJyZXF1aXJlZCI6IlkiLCJkZWZhdWx0IjoiIiwidmFsdWVzIjoiIiwibWFzayI6IiszNzUgKCMjKSAjIyMtIyMtIyMifV0=",
        "FORM_TYPE" => "CALLBACK",
        "MESSAGE_ERRORALL" => "",
        "MESSAGE_SUCCESS" => "Ваш заказ обратного звонка успешно отправлен!",
        "NAME" => "Заказать обратный звонок",
        "PERSONAL_PROCESSING" => "Y",
        "PERSONAL_PROCESSING_PAGE" => "",
        "SEND_EMAIL_ADDRESS" => "",
        "SEND_EMAIL_ENABLED" => "Y",
        "SEND_EMAIL_EVENT_NAME" => "",
        "SEND_IBLOCK_ENABLED" => "Y",
        "SEND_IBLOCK_ID" => "7",
        "SEND_IBLOCK_TYPE" => "nt_premium_forms"
    )
);?>