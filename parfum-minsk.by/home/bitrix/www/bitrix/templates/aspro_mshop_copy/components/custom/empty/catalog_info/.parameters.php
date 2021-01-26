<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"BRAND_ID" => Array(
		"NAME" => "BRAND_ID",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"BRAND_NAME" => Array(
		"NAME" => "BRAND_NAME",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"SERVICE" => Array(
		"NAME" => "SERVICE",
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"SHOW_DELIVERY_PRICE" => Array(
		"NAME" => GetMessage("SHOW_DELIVERY_PRICE"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
	),
);
?>
