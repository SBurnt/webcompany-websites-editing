<?php

$aMenuLinksExt = array();

$rsElement = CIBlockElement::GetList(
    $arOrder  = array("SORT" => "ASC"),
    $arFilter = array(
        "IBLOCK_ID" => 22,
        "ACTIVE"    => "Y",
        "PROPERTY_SHOW_IN_FOOTER_VALUE" => "Да"
    ),
    false,
    false,
    $arSelectFields = array("ID", "NAME", "IBLOCK_ID", "CODE", "DETAIL_PAGE_URL", "PROPERTY_*")
);

while($arElement = $rsElement->GetNextElement()) {
    $arFields = $arElement->GetFields();
    $aMenuLinksExt[] = array(
        $arFields['NAME'],
        $arFields['DETAIL_PAGE_URL']
    );
}

$aMenuLinks = array_merge($aMenuLinksExt, $aMenuLinks); 

?>