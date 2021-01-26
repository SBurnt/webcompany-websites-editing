<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$prices = array();
CModule::IncludeModule('catalog');
$res = GetCatalogGroups('NAME', 'asc');
while ($r = $res->Fetch()) $prices[$r['NAME']] = $r['NAME'];
$arTemplateParameters = array(
	"COUNT" => Array(
		"NAME" => GetMessage("COUNT"),
		"TYPE" => "STRING",
		"DEFAULT" => "8",
	),
	"WITHOUT_BUY" => Array(
		"NAME" => GetMessage("WITHOUT_BUY"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "N",
	),
	"BLOCK_HEADER" => array(
		"NAME" => GetMessage("ASTDESIGN_BLOCK_HEADER"),
      	"TYPE" => "STRING",
      	'DEFAULT_VALUE' => GetMessage("ASTDESIGN_CLIMATE_PREDLOJENIA"),
	),
	"INTERVAL" => array(
		"NAME" => GetMessage("ASTDESIGN_INTERVAL"),
      	"TYPE" => "STRING",
      	'DEFAULT_VALUE' => '6000',
	),
	"PRICES" => Array(
	  "NAME" => GetMessage("ASTDESIGN_PRICES"),
	  "TYPE" => "LIST",
	  'MULTIPLE' => 'Y',
	  "VALUES" => $prices
	),
	"MAIN_PRICES" => Array(
	  "NAME" => GetMessage("ASTDESIGN_MAIN_PRICES"),
	  "TYPE" => "LIST",
	  'MULTIPLE' => 'Y',
	  "VALUES" => $prices
	),
	"OTHER_PRICES" => Array(
	  "NAME" => GetMessage("ASTDESIGN_OTHER_PRICES"),
	  "TYPE" => "LIST",
	  'MULTIPLE' => 'Y',
	  "VALUES" => $prices
	),
);
?>