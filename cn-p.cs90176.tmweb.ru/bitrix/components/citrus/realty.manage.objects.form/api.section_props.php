<?php

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

\CModule::IncludeModule("iblock");

$result = null;

// init properties for section
if (!empty($_GET["IBLOCK_ID"]))
{
	$tmpPropLinks = CIBlockSectionPropertyLink::GetArray(
		$_GET["IBLOCK_ID"],
		!empty($_GET["IBLOCK_SECTION"])? $_GET["IBLOCK_SECTION"] : 0
	);
	foreach ($tmpPropLinks as $propForSection)
	{
		$result[$propForSection["PROPERTY_ID"]] = 1;
	}
}

echo json_encode($result);
