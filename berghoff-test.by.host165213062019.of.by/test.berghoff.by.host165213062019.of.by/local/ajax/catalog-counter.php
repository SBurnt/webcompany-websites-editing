<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
$apdProps = [
    "Серия" => "SERIA",
    "Объём" => "COUNTRY",
    "Диаметр" => "DIAMETR",
    "Длина" => "DLINA",
    "Материал" => "MATERIAL",
    "Материал крышки" => "COVER_MATERIAL",
    "Цвет" => "COLOR",
    "Хит" => "HIT",
    "Новинка" => "NEW",
    "Скидка" => "DISCOUNT",
    "Тип" => "GTYPES"
];
$arFilter = array(
  "IBLOCK_ID" => "4",
  "ACTIVE" => "Y",
  "GLOBAL_ACTIVE" => "Y",
  "INCLUDE_SUBSECTIONS" => "Y",
  ">=CATALOG_PRICE_1" => 0,
);
if($_REQUEST["FIND_ID"])$arFilter["ID"]=explode(",",$_REQUEST["FIND_ID"]);
if($_REQUEST["ID"])$GLOBALS["ID"] = $_REQUEST["ID"];
if($_REQUEST["MIN_PRICE"] && $_REQUEST["MIN_PRICE"]>$_REQUEST["START_PRICE"])$arFilter[">=CATALOG_PRICE_1"] = intval($_REQUEST["MIN_PRICE"]);
if($_REQUEST["MAX_PRICE"] && $_REQUEST["MAX_PRICE"]<$_REQUEST["END_PRICE"])$arFilter["<=CATALOG_PRICE_1"] = intval($_REQUEST["MAX_PRICE"]);
if($_REQUEST["MIN_DLINA"] && $_REQUEST["MIN_DLINA"]<$_REQUEST["START_DLINA"])$arFilter[">=PROPERTY_DLINA"] = intval($_REQUEST["MIN_DLINA"]);
if($_REQUEST["MAX_DLINA"] && $_REQUEST["MAX_DLINA"]>$_REQUEST["END_DLINA"])$arFilter["<=PROPERTY_DLINA"] = intval($_REQUEST["MAX_DLINA"]);
if($_REQUEST["MIN_DIAMETR"] && $_REQUEST["MIN_DIAMETR"]<$_REQUEST["START_DIAMETR"])$arFilter[">=PROPERTY_DIAMETR"] = floatval($_REQUEST["MIN_DIAMETR"]);
if($_REQUEST["MAX_DIAMETR"] && $_REQUEST["MAX_DIAMETR"]>$_REQUEST["END_DIAMETR"])$arFilter["<=PROPERTY_DIAMETR"] = floatval($_REQUEST["MAX_DIAMETR"]);
if(is_array($_REQUEST["PROPERTIES"]["GTYPES"])&&in_array("Хит",$_REQUEST["PROPERTIES"]["GTYPES"]))$arFilter["!PROPERTY_HIT"] = false;
if(is_array($_REQUEST["PROPERTIES"]["GTYPES"])&&in_array("Новинка",$_REQUEST["PROPERTIES"]["GTYPES"]))$arFilter["!PROPERTY_NEW"] = false;
if(is_array($_REQUEST["PROPERTIES"]["GTYPES"])&&in_array("Скидка",$_REQUEST["PROPERTIES"]["GTYPES"]))$arFilter["!PROPERTY_DISCOUNT"] = false;
if(is_array($_REQUEST["SECTIONS"]) && !empty($_REQUEST["SECTIONS"]))$arFilter["SECTION_ID"] = $_REQUEST["SECTIONS"];
foreach($apdProps as $propCode){
    if(in_array($propCode,["DLINA","DIAMETR","HIT","NEW","DISCOUNT","GTYPES"]))continue;
    if(is_array($_REQUEST["PROPERTIES"][$propCode])){
        if($propCode=="MATERIAL"){
            foreach($_REQUEST["PROPERTIES"][$propCode] as $key => $val){
                $_REQUEST["PROPERTIES"][$propCode][$key] = "%".$val."%";
            }
        }
        $arFilter["PROPERTY_".$propCode] = $_REQUEST["PROPERTIES"][$propCode];
    }
}
$rsElements = CIBlockElement::GetList([],$arFilter,false,false,$arSelect);
$elementsCount = $rsElements->SelectedRowsCount();
$arResult = ["countProduct" => "Найдено ".$elementsCount];
echo json_encode($arResult);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>
