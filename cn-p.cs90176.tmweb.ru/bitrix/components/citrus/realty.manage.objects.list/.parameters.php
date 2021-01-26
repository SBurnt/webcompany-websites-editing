<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule("citrus.arealty"))
	return;

if (!CModule::IncludeModule("citrus.arealtypro"))
    return;

if (!CModule::IncludeModule("iblock"))
	return;

$siteId = !empty($_REQUEST["site"])
	? $_REQUEST["site"]
	: (!empty($_REQUEST["src_site"])
		? $_REQUEST["src_site"]
		: false
	);
$fields = new \Citrus\ArealtyPro\Meta\Iblock((int)\Citrus\Arealty\Helper::getIblock('offers', $siteId));

$arAscDesc = array(
	"asc" => GetMessage("IBLOCK_SORT_ASC"),
	"desc" => GetMessage("IBLOCK_SORT_DESC"),
);

$arComponentParameters = array(
	"GROUPS" => array(
	),
	"PARAMETERS"  =>  array(
		"IBLOCK_SECTION_ID" => array(
			"PARENT" => "DATA_SOURCE",
			"NAME" => GetMessage("P_IBLOCK_SECTION_ID"),
			"TYPE" => "LIST",
			"ADDITIONAL_VALUES" => "Y",
			"VALUES" => array(),
			"REFRESH" => "Y",
		),

		"FIELD_CODE" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("P_FIELD_CODE"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => $fields->getTitlesArray(),
			"ADDITIONAL_VALUES" => "Y",
		),
		'DEFAULT_SORT_FIELD' => array(
			"PARENT" => "BASE",
			'NAME' => GetMessage("P_DEFAULT_SORT_FIELD"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		"DEFAULT_SORT_ORDER" => array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("P_DEFAULT_SORT_ORDER"),
			"TYPE" => "LIST",
			"VALUES" => $arAscDesc,
			"ADDITIONAL_VALUES" => "Y",
		),

		'SET_TITLE' => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			'NAME' => GetMessage("P_SET_TITLE"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		'TITLE' => array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			'NAME' => GetMessage("P_TITLE"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		"CHAIN_ITEMS" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_CHAIN_ITEMS"),
			'TYPE' => 'STRING',
			'DEFAULT' => "",
		),
		"ADD_ITEM_CHAIN" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_ADD_ITEM_CHAIN"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
		),
		"SET_STATUS_404" => Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_SET_STATUS_404"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "N",
		),
		"RL_FILTER_FIELDS" => array(
			"PARENT" => "RL_SETTINGS",
			"NAME" => GetMessage("P_RL_FILTER_FIELDS"),
			"TYPE" => "LIST",
			"MULTIPLE" => "Y",
			"VALUES" => array(),
			"ADDITIONAL_VALUES" => "Y",
		),

		"SITE_FILTER_PATH"  =>  Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_SITE_FILTER_PATH"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),

		"LIST_PATH"  =>  Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_LIST_PATH"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
		"EDIT_PATH"  =>  Array(
			"PARENT" => "ADDITIONAL_SETTINGS",
			"NAME" => GetMessage("P_EDIT_PATH"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		),
	),
);
