<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$ID = intval($_REQUEST["ID"]);
$rsCounter = CIBlockElement::GetProperty(19, $ID, [], ["CODE" => "COUNTER"])->GetNext();
$Counter = $rsCounter["VALUE"] + 1;
CIBlockElement::SetPropertyValuesEx($ID, 19, ["COUNTER" => $Counter]);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>